<?php
/**
 * Trilacheck phone comparison: server-rendered, with optional JS enhancements.
 *
 * @package Trilacheck
 */
defined( 'ABSPATH' ) || exit;

$mode = isset( $args['mode'] ) && 'sim' === $args['mode'] ? 'sim' : 'phone';
$is_sim = 'sim' === $mode;
$preset = $is_sim ? ( $args['preset'] ?? '' ) : '';
$defaults = array( '5gb' => array( 'daten' => '5000' ), '15gb' => array( 'daten' => '15000' ), '50gb' => array( 'daten' => '50000' ), 'prepaid' => array( 'tarifart' => 'prepaid' ), 'young' => array( 'zielgruppe' => 'young' ), 'unlimited' => array( 'daten' => 'unlimited' ) );
$read = static function ( $name ) use ( $defaults, $preset ) {
	return isset( $_GET[ $name ] ) && is_string( $_GET[ $name ] ) ? sanitize_text_field( wp_unslash( $_GET[ $name ] ) ) : ( $defaults[ $preset ][ $name ] ?? '' );
};
$phone        = $is_sim ? '' : $read( 'telefon' );
$manufacturer = $read( 'hersteller' );
$network      = $read( 'netz' );
$data         = $read( 'daten' );
$upfront      = $read( 'anzahlung' );
$budget       = $read( 'budget' );
$duration     = $read( 'laufzeit' );
$sort         = 'monthly' === $read( 'sortierung' ) ? 'monthly' : 'effective';
$esim         = '1' === $read( 'esim' );
$five_g       = '1' === $read( '5g' );
$page         = max( 1, min( 100, absint( $read( 'angebote_seite' ) ) ) );
$catalogue    = $is_sim ? array() : trilacheck_tariffuxx_devices();
$brands       = array();
foreach ( $catalogue as $device ) {
	if ( $device['brand'] ) {
		$brands[ sanitize_title( $device['brand'] ) ] = $device['brand'];
	}
}
asort( $brands, SORT_NATURAL | SORT_FLAG_CASE );
$unknown_brand = $manufacturer && ! isset( $brands[ $manufacturer ] );
if ( ! isset( $brands[ $manufacturer ] ) ) {
	$manufacturer = '';
}
$params = array( 'type' => 1, 'incl_bundles' => $is_sim ? 0 : 1, 'filter' => 0, 'count' => 12, 'from' => ( $page - 1 ) * 12, 'subid' => $is_sim ? 'trilacheck-mobilfunk' : 'trilacheck-handy', 'com_only' => 1, 'average_price_calculation_months' => 24 );
if ( $phone && preg_match( '/^[a-z0-9-]{1,120}$/', $phone ) && 'simonly' !== $phone ) {
	$params['phone'] = array( $phone );
} else {
	$phone = '';
}
if ( $manufacturer ) {
	$brand_models = array_keys( array_filter( $catalogue, static function ( $device ) use ( $manufacturer ) { return sanitize_title( $device['brand'] ) === $manufacturer; } ) );
	if ( ! $phone || ! in_array( $phone, $brand_models, true ) ) {
		$phone = '';
		$params['phone'] = $brand_models;
	}
}
$networks = array( 'd1' => 'Telekom-Netz', 'd2' => 'Vodafone-Netz', 'o2' => 'Telefónica (o2)', '1u1' => '1&1-Netz' );
if ( isset( $networks[ $network ] ) ) {
	$params['networks'] = array( $network => 1 );
} else {
	$network = '';
}
$data_choices = array( '5000' => 'Ab 5 GB', '15000' => 'Ab 15 GB', '30000' => 'Ab 30 GB', '50000' => 'Ab 50 GB', '100000' => 'Ab 100 GB', 'unlimited' => 'Unlimited' );
if ( ! $is_sim ) { unset( $data_choices['unlimited'] ); }
if ( isset( $data_choices[ $data ] ) ) {
	if ( 'unlimited' !== $data ) { $params['data_units'] = (int) $data; }
} else {
	$data = '';
}
$upfront_choices = array( '0' => '0 € Gerätepreis', '1' => 'Bis 1 €', '50' => 'Bis 50 €', '100' => 'Bis 100 €', '200' => 'Bis 200 €', '500' => 'Bis 500 €' );
if ( ! $is_sim && isset( $upfront_choices[ $upfront ] ) ) {
	$params['max_phone_price'] = (float) $upfront;
} else {
	$upfront = '';
}
$budget_choices = array( '20' => 'Bis 20 €', '30' => 'Bis 30 €', '40' => 'Bis 40 €', '50' => 'Bis 50 €', '70' => 'Bis 70 €', '100' => 'Bis 100 €' );
if ( isset( $budget_choices[ $budget ] ) ) {
	$params['price_filter_type'] = 'max_price_monthly';
	$params['price_filter_value'] = (float) $budget;
} else {
	$budget = '';
}
$duration_choices = array( '30' => 'Max. 1 Monat', '360' => 'Max. 12 Monate', '720' => 'Max. 24 Monate' );
if ( isset( $duration_choices[ $duration ] ) ) {
	$params['contract_period'] = (int) $duration;
} else {
	$duration = '';
}
$params['sort_prop'] = 'monthly' === $sort ? 'MONTHLY_FEES' : 'EFFECTIVE_COSTS';
if ( $esim ) {
	$params['esim_req'] = 1;
}
if ( $five_g ) {
	$params['technologies'] = array( '5g' => 1 );
}
$payment = $is_sim ? $read( 'tarifart' ) : '';
if ( in_array( $payment, array( 'postpaid', 'prepaid' ), true ) ) { $params['payment'] = $payment; }
$audience = $is_sim && 'young' === $read( 'zielgruppe' ) ? 'young' : '';
$topic_ids = null;
if ( $is_sim && ( 'unlimited' === $data || $audience ) ) {
	$master = trilacheck_tariffuxx_request( 'get-by-params', array( 'type' => 1 ) );
	if ( ! is_wp_error( $master ) ) {
		$topic_ids = array();
		foreach ( $master as $product ) {
			if ( $audience && 'young' !== ( $product['restricted_customer_group_code'] ?? '' ) ) { continue; }
			if ( 'unlimited' === $data && ! preg_match( '/unlimited|unbegrenzt/iu', $product['internet_data_volume'] ?? '' ) ) { continue; }
			if ( ! empty( $product['product_id'] ) ) { $topic_ids[] = (int) $product['product_id']; }
		}
		$params['products'] = $topic_ids;
	}
}
$unknown_model = $phone && $catalogue && ! isset( $catalogue[ $phone ] );
// The upstream silently ignores unknown filter values. Never show unrelated
// phones as if they matched a removed or mistyped model deep link.
$offers = isset( $master ) && is_wp_error( $master ) ? $master : ( $unknown_brand || $unknown_model || array() === $topic_ids ? array() : trilacheck_tariffuxx_request( 'get-offers-by-params', $params ) );
$catalogue = $is_sim ? array() : trilacheck_tariffuxx_devices( is_array( $offers ) ? $offers : array() );
foreach ( $catalogue as $device ) {
	if ( $device['brand'] ) {
		$brands[ sanitize_title( $device['brand'] ) ] = $device['brand'];
	}
}
asort( $brands, SORT_NATURAL | SORT_FLAG_CASE );
$cards = array();
if ( ! is_wp_error( $offers ) ) {
	foreach ( $offers as $offer ) {
		$view = trilacheck_tariffuxx_offer( $offer, $mode );
		if ( $view ) {
			$cards[] = array( 'offer' => $offer, 'view' => $view );
		}
	}
}
$fields = array(
	'hersteller' => array( 'label' => 'Hersteller', 'all' => 'Alle Hersteller', 'choices' => $brands, 'value' => $manufacturer ),
	'netz' => array( 'label' => 'Netz', 'all' => 'Alle Netze', 'choices' => $networks, 'value' => $network ),
	'daten' => array( 'label' => 'Datenvolumen', 'all' => 'Alle Datenpakete', 'choices' => $data_choices, 'value' => $data ),
	'budget' => array( 'label' => 'Monatliche Tarif-Grundgebühr', 'all' => 'Alle Preise', 'choices' => $budget_choices, 'value' => $budget ),
	'anzahlung' => array( 'label' => 'Einmaliger Gerätepreis', 'all' => 'Alle Gerätepreise', 'choices' => $upfront_choices, 'value' => $upfront ),
	'laufzeit' => array( 'label' => 'Laufzeit', 'all' => 'Alle Laufzeiten', 'choices' => $duration_choices, 'value' => $duration ),
);
if ( $is_sim ) {
 unset( $fields['hersteller'], $fields['anzahlung'] );
 $fields['zielgruppe'] = array( 'label' => 'Zielgruppe', 'all' => 'Alle', 'choices' => array( 'young' => 'Young-Tarife' ), 'value' => $audience );
 $fields['tarifart'] = array( 'label' => 'Tarifart', 'all' => 'Vertrag und Prepaid', 'choices' => array( 'postpaid' => 'Vertrag', 'prepaid' => 'Prepaid' ), 'value' => $payment );
}
?>
<section class="tc-phone-api" data-api-state="<?php echo is_wp_error( $offers ) ? 'error' : 'ready'; ?>" aria-label="<?php echo $is_sim ? 'SIM-only-Tarife vergleichen' : 'Handys mit Vertrag vergleichen'; ?>">
	<nav class="tc-phone-api__tabs" aria-label="Vergleich auswählen">
		<a href="<?php echo esc_url( home_url( '/handy-mit-vertrag/' ) ); ?>#tarifvergleich" <?php if ( ! $is_sim ) : ?>class="is-current" aria-current="page"<?php endif; ?>><?php echo trilacheck_tariffuxx_icon( 'phone' ); ?> Handy mit Vertrag</a>
		<a href="<?php echo esc_url( home_url( '/mobilfunk/' ) ); ?>#tarifvergleich" <?php if ( $is_sim ) : ?>class="is-current" aria-current="page"<?php endif; ?>><?php echo trilacheck_tariffuxx_icon( 'sim' ); ?> Nur SIM</a>
	</nav>
	<?php if ( is_wp_error( $offers ) ) : ?>
		<div class="tc-phone-api__unavailable" role="status"><h2><?php echo $is_sim ? 'Handytarife vergleichen' : 'Handys mit Vertrag vergleichen'; ?></h2><p>Unser eigener Vergleich ist vorübergehend nicht erreichbar. Der bisherige Vergleich steht dir weiterhin zur Verfügung.</p>
		<?php if ( current_user_can( 'manage_options' ) ) : ?><p><a href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>">API-Einstellungen prüfen</a> · <?php echo 'tx_config' === $offers->get_error_code() ? 'API-Schlüssel fehlt auf diesem Server.' : 'Die API-Anfrage konnte nicht abgeschlossen werden.'; ?></p><?php endif; ?>
		</div>
		<?php if ( $is_sim ) { wp_enqueue_script( 'trilacheck-mobile-comparison-fallback', 'https://files.check24.net/widgets/auto/262971/c24pp-mobileservice-iframe/sim-only-iframe.js', array(), null, true ); get_template_part( 'template-parts/direct-comparison', null, array( 'type' => 'mobile' ) ); } else { echo do_shortcode( '[trilacheck_phone_contract]' ); } ?>
	<?php else : ?>
		<div class="tc-phone-api__layout">
			<div class="tc-phone-api__mobile-controls"><button type="button" class="tc-phone-api__filter-toggle" aria-expanded="true" aria-controls="tc-phone-filters"><?php echo trilacheck_tariffuxx_icon( 'filter' ); ?> Filter <?php echo trilacheck_tariffuxx_icon( 'chevron' ); ?></button><button type="button" class="tc-phone-api__sort-toggle"><?php echo trilacheck_tariffuxx_icon( 'sort' ); ?> Sortieren</button></div>
			<form id="tc-phone-filters" method="get" action="<?php echo esc_url( get_permalink() ); ?>#tarifvergleich" class="tc-phone-api__filters">
				<h2 class="screen-reader-text">Dein Wunschhandy und Tarif</h2>
				<?php if ( ! $is_sim ) : ?><label for="tc-phone-model">Smartphone</label>
				<select id="tc-phone-model" name="telefon"><option value="">Alle Smartphones</option>
					<?php if ( $phone && ! isset( $catalogue[ $phone ] ) ) : ?><option value="<?php echo esc_attr( $phone ); ?>" selected><?php echo esc_html( ucwords( str_replace( '-', ' ', $phone ) ) ); ?></option><?php endif; ?>
					<?php foreach ( $catalogue as $slug => $device ) : ?><option value="<?php echo esc_attr( $slug ); ?>" data-brand="<?php echo esc_attr( sanitize_title( $device['brand'] ) ); ?>" <?php selected( $phone, $slug ); ?>><?php echo esc_html( $device['name'] ); ?></option><?php endforeach; ?>
				</select>
				<?php endif; ?>
<?php foreach ( $fields as $name => $field ) : ?>
					<label for="tc-phone-<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
					<select id="tc-phone-<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>"><option value=""><?php echo esc_html( $field['all'] ); ?></option><?php foreach ( $field['choices'] as $value => $label ) : ?><option value="<?php echo esc_attr( $value ); ?>" <?php selected( $field['value'], $value ); ?>><?php echo esc_html( $label ); ?></option><?php endforeach; ?></select>
				<?php endforeach; ?>
				<details class="tc-phone-api__more"><summary>Weitere Filter</summary><label><input type="checkbox" name="5g" value="1" <?php checked( $five_g ); ?>> Nur 5G-Tarife</label><label><input type="checkbox" name="esim" value="1" <?php checked( $esim ); ?>> eSIM verfügbar</label></details>
				<button type="submit">Angebote anzeigen <?php echo trilacheck_tariffuxx_icon( 'arrow' ); ?></button>
				<a class="tc-phone-api__reset" href="<?php echo esc_url( get_permalink() ); ?>#tarifvergleich">Filter zurücksetzen</a>
			</form>
			<div class="tc-phone-api__results">
				<div class="tc-phone-api__toolbar"><p><strong><?php echo count( $cards ); ?></strong> Angebote auf dieser Seite</p><label for="tc-phone-sort">Sortieren nach:<select id="tc-phone-sort" name="sortierung" form="tc-phone-filters"><option value="effective" <?php selected( $sort, 'effective' ); ?>>Bestes Preisangebot</option><option value="monthly" <?php selected( $sort, 'monthly' ); ?>>Tarif-Grundgebühr</option></select></label></div>
				<div class="tc-phone-api__selection" hidden><span class="tc-phone-api__selection-count" aria-live="polite"></span><button type="button" class="tc-phone-api__compare-open">Angebote vergleichen</button><button type="button" class="tc-phone-api__compare-clear">Auswahl löschen</button></div>
				<p class="tc-phone-api__source"><?php echo trilacheck_tariffuxx_icon( 'info' ); ?> <?php if ( 'effective' === $sort ) : ?>Beste Preisangebote zuerst: aufsteigend nach Gesamtkosten über 24 Monate, inklusive Einmalkosten und angerechneter Boni. Die Reihenfolge gilt für deine gewählten Filter.<?php else : ?>Sortiert nach Tarif-Grundgebühr. Wähle „Bestes Preisangebot“, um nach Gesamtkosten inklusive Einmalkosten und angerechneter Boni zu sortieren.<?php endif; ?> Bedingungen und mögliche Preisphasen findest du in den Tarifdetails.</p>
				<?php foreach ( $cards as $index => $card ) : $offer = $card['offer']; $view = $card['view']; $benefits = trilacheck_tariffuxx_benefits( $offer ); ?>
					<article class="tc-phone-api__card">
						<div class="tc-phone-api__visual<?php echo $is_sim ? ' tc-phone-api__visual--sim' : ''; ?>"><?php if ( $view['image'] ) : ?><img src="<?php echo esc_url( $view['image'] ); ?>" alt="<?php echo esc_attr( $view['phone'] ); ?>" width="130" height="170" loading="lazy"><?php else : ?><span class="tc-phone-api__phone-placeholder" aria-hidden="true"><?php echo trilacheck_tariffuxx_icon( $is_sim ? 'sim' : 'phone' ); ?></span><?php endif; ?></div>
						<div class="tc-phone-api__identity"><?php if ( 1 === $page && 'effective' === $sort && $index < 3 ) : ?><span class="tc-phone-api__rank<?php echo 0 === $index ? ' tc-phone-api__rank--first' : ''; ?>"><?php echo trilacheck_tariffuxx_icon( 'star' ); ?> <?php echo esc_html( array( 'Bestes Preisangebot', 'Zweitbestes Preisangebot', 'Drittbestes Preisangebot' )[ $index ] ); ?></span><?php endif; ?><h3><?php echo esc_html( $view['phone'] ); ?></h3><p><?php echo esc_html( $is_sim ? $view['provider'] : $view['provider'] . ' · ' . $view['tariff'] ); ?></p><ul class="tc-phone-api__features"><li class="tc-phone-api__network tc-phone-api__network--<?php echo esc_attr( $view['network_code'] ); ?>"><?php echo esc_html( $view['network'] ); ?></li><?php foreach ( array( $view['data'], $view['five_g'] ? '5G' : '', $view['esim'] ? 'eSIM' : '', $view['term'] ) as $feature ) : ?><?php if ( $feature ) : ?><li><?php echo esc_html( $feature ); ?></li><?php endif; ?><?php endforeach; ?></ul></div>
						<div class="tc-phone-api__price">
							<div><span>Tarif-Grundgebühr</span><strong><?php echo esc_html( $view['monthly'] ); ?></strong><small><?php echo esc_html( $view['billing'] ); ?><?php if ( $view['phases'] ) : ?> · Preisphasen beachten<?php endif; ?></small></div>
							<?php if ( $is_sim ) : ?><div><span>Einmalige Kosten</span><strong><?php echo esc_html( $view['extra_price'] ); ?></strong><small>Details und Bedingungen beachten</small></div><?php else : ?><div><span>Einmaliger Gerätepreis</span><strong><?php echo esc_html( $view['device_price'] ); ?></strong><small>Weitere Einmalkosten: <?php echo esc_html( $view['extra_price'] ); ?></small></div>
							<?php endif; ?><div class="tc-phone-api__average"><span>Ø pro Monat</span><strong><?php echo esc_html( $view['average'] ); ?></strong><small>inkl. Einmalkosten und angerechneter Vorteile</small></div>
						</div>
						<?php if ( $benefits || ! empty( $offer['product_voucher']['code'] ) ) : ?>
						<div class="tc-phone-api__benefits" aria-label="Boni und Vorteile">
							<?php foreach ( $benefits as $benefit ) : ?><details><summary><span><?php echo esc_html( $benefit['label'] ); ?></span><strong><?php echo esc_html( $benefit['amount'] ); ?></strong><?php echo trilacheck_tariffuxx_icon( 'info' ); ?></summary><p><?php echo esc_html( $benefit['info'] ); ?></p></details><?php endforeach; ?>
							<?php if ( ! empty( $offer['product_voucher']['code'] ) ) : ?><details><summary><span>Gutscheincode</span><strong><?php echo esc_html( trilacheck_tariffuxx_text( $offer['product_voucher']['code'] ) ); ?></strong><?php echo trilacheck_tariffuxx_icon( 'info' ); ?></summary><p><?php echo esc_html( trilacheck_tariffuxx_text( ( $offer['product_voucher']['benefit'] ?? '' ) . ' ' . ( $offer['product_voucher']['conditions'] ?? '' ) ) ); ?></p></details><?php endif; ?>
							<small>Nur bei erfüllten Bedingungen. Im Durchschnitt angerechnete Vorteile sind bereits berücksichtigt.</small>
						</div>
						<?php endif; ?>
						<div class="tc-phone-api__actions">
							<label class="tc-phone-api__compare-label"><input type="checkbox" class="tc-phone-api__compare" data-offer="<?php echo esc_attr( wp_json_encode( $view ) ); ?>"> Vergleichen</label>
							<a class="tc-phone-api__detail-link" href="#tc-phone-details-<?php echo esc_attr( $index ); ?>">Tarifdetails</a>
							<a class="tc-phone-api__offer" href="<?php echo esc_url( $view['link'] ); ?>" target="_blank" rel="sponsored noopener">Zum Angebot <?php echo trilacheck_tariffuxx_icon( 'arrow' ); ?><span class="screen-reader-text"> (öffnet in neuem Tab)</span></a>
						</div>
						<details id="tc-phone-details-<?php echo esc_attr( $index ); ?>" class="tc-phone-api__details"><summary>Kosten & Vertragsbedingungen</summary>
							<section class="tc-tariff-detail-panel" data-tc-detail="prices" aria-label="Preise und Leistungen"><p>Gesamtkosten über 24 Monate: <strong><?php echo esc_html( $view['total'] ); ?></strong></p>
							<?php foreach ( array( 'one_time_product_charges' => 'Einmalige Kosten', 'recurring_product_charges' => 'Laufende Tarifkosten' ) as $field => $label ) : ?>
								<h4><?php echo esc_html( $label ); ?></h4><ul><?php foreach ( trilacheck_tariffuxx_charges( $offer[ $field ] ?? array() ) as $charge ) : ?><li><?php echo esc_html( trilacheck_tariffuxx_text( $charge['description'] ?? '' ) . ': ' . trilacheck_tariffuxx_money( $charge['value'] ?? 0 ) . ' ' . trilacheck_tariffuxx_text( $charge['period_description'] ?? '' ) ); ?><?php if ( ! empty( $charge['from_period'] ) ) : ?> · ab Periode <?php echo esc_html( $charge['from_period'] ); ?><?php endif; ?><?php if ( ! empty( $charge['to_period'] ) ) : ?> bis <?php echo esc_html( $charge['to_period'] ); ?><?php endif; ?><?php if ( ! empty( $charge['info'] ) ) : ?> — <?php echo esc_html( trilacheck_tariffuxx_text( $charge['info'] ) ); ?><?php endif; ?></li><?php endforeach; ?></ul>
							<?php endforeach; ?>
							<?php if ( $benefits ) : ?><h4>Boni und Vorteile</h4><ul><?php foreach ( $benefits as $benefit ) : ?><li><?php echo esc_html( $benefit['label'] . ': ' . $benefit['amount'] . ' — ' . $benefit['info'] ); ?></li><?php endforeach; ?></ul><?php endif; ?>
							<p>Die Gesamtkosten enthalten auch ausgewählte Geräte- und Optionskosten, die nicht immer Teil der Tarif-Grundgebühr sind. Angerechnete Boni und Cashback gelten nur bei Erfüllung ihrer Bedingungen.</p>
							<?php if ( ! empty( $offer['warning_info_text'] ) ) : ?><p><?php echo esc_html( trilacheck_tariffuxx_text( $offer['warning_info_text'] ) ); ?></p><?php endif; ?>
							<?php if ( ! empty( $offer['product_voucher'] ) ) : ?><p>Gutscheincode: <strong><?php echo esc_html( trilacheck_tariffuxx_text( $offer['product_voucher']['code'] ?? '' ) ); ?></strong> — <?php echo esc_html( trilacheck_tariffuxx_text( ( $offer['product_voucher']['benefit'] ?? '' ) . ' ' . ( $offer['product_voucher']['conditions'] ?? '' ) ) ); ?></p><?php endif; ?>
							</section>
							<section class="tc-tariff-detail-panel" data-tc-detail="specifications" aria-label="Tarifinformationen">
								<div class="tc-tariff-specifications">
								<?php foreach ( trilacheck_tariffuxx_specifications( $offer ) as $group => $rows ) : ?><section><h4><?php echo esc_html( $group ); ?></h4><dl><?php foreach ( $rows as $label => $value ) : ?><div><dt><?php echo esc_html( $label ); ?></dt><dd><?php echo esc_html( $value ); ?></dd></div><?php endforeach; ?></dl></section><?php endforeach; ?>
								</div>
								<h4>Dokumente des Anbieters</h4>
							<?php foreach ( (array) ( $offer['product_documents'] ?? array() ) as $document ) : ?><p><a href="<?php echo esc_url( $document['url'] ?? '' ); ?>" target="_blank" rel="noopener"><?php echo esc_html( trilacheck_tariffuxx_text( $document['description'] ?? 'Produktinformationen' ) ); ?></a></p><?php endforeach; ?>
							</section>
						</details>
					</article>
				<?php endforeach; ?>
				<?php if ( ! $cards ) : ?><div class="tc-phone-api__empty" role="status"><h3>Keine passenden Angebote gefunden</h3><p>Erweitere deine Filter für Netz, Preis, Datenvolumen oder Laufzeit.</p><a href="<?php echo esc_url( get_permalink() ); ?>#tarifvergleich">Alle Angebote anzeigen →</a></div><?php endif; ?>
				<nav class="tc-phone-api__pagination" aria-label="Angebotsseiten"><?php if ( $page > 1 ) : ?><a href="<?php echo esc_url( add_query_arg( 'angebote_seite', $page - 1 ) . '#tarifvergleich' ); ?>">← Zurück</a><?php endif; ?><?php if ( count( $offers ) >= 12 && $page < 100 ) : ?><a href="<?php echo esc_url( add_query_arg( 'angebote_seite', $page + 1 ) . '#tarifvergleich' ); ?>">Weitere Angebote →</a><?php endif; ?></nav>
				<p class="tc-phone-api__disclosure">Tarifdaten: TARIFFUXX · Kostenloser Vergleich. Bei einem Vertragsabschluss können wir eine Provision erhalten. Für dich entstehen keine zusätzlichen Gebühren durch Trilacheck.</p>
			</div>
		</div>
	<?php endif; ?>
</section>
