<?php
/**
 * Trilacheck phone comparison: server-rendered, with optional JS enhancements.
 *
 * @package Trilacheck
 */
defined( 'ABSPATH' ) || exit;

$read = static function ( $name ) {
	return isset( $_GET[ $name ] ) && is_string( $_GET[ $name ] ) ? sanitize_text_field( wp_unslash( $_GET[ $name ] ) ) : '';
};
$phone        = $read( 'telefon' );
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
$catalogue    = trilacheck_tariffuxx_devices();
$brands       = array();
foreach ( $catalogue as $device ) {
	if ( $device['brand'] ) {
		$brands[ sanitize_title( $device['brand'] ) ] = $device['brand'];
	}
}
asort( $brands, SORT_NATURAL | SORT_FLAG_CASE );
if ( ! isset( $brands[ $manufacturer ] ) ) {
	$manufacturer = '';
}
$params = array( 'type' => 1, 'incl_bundles' => 1, 'filter' => 0, 'count' => 12, 'from' => ( $page - 1 ) * 12, 'subid' => 'trilacheck-handy', 'com_only' => 1, 'average_price_calculation_months' => 24 );
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
$data_choices = array( '5000' => 'Ab 5 GB', '15000' => 'Ab 15 GB', '30000' => 'Ab 30 GB', '50000' => 'Ab 50 GB', '100000' => 'Ab 100 GB' );
if ( isset( $data_choices[ $data ] ) ) {
	$params['data_units'] = (int) $data;
} else {
	$data = '';
}
$upfront_choices = array( '0' => '0 € Gerätepreis', '1' => 'Bis 1 €', '50' => 'Bis 50 €', '100' => 'Bis 100 €', '200' => 'Bis 200 €', '500' => 'Bis 500 €' );
if ( isset( $upfront_choices[ $upfront ] ) ) {
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
$unknown_model = $phone && $catalogue && ! isset( $catalogue[ $phone ] );
// The upstream silently ignores unknown filter values. Never show unrelated
// phones as if they matched a removed or mistyped model deep link.
$offers = $unknown_model ? array() : trilacheck_tariffuxx_request( 'get-offers-by-params', $params );
$catalogue = trilacheck_tariffuxx_devices( is_array( $offers ) ? $offers : array() );
foreach ( $catalogue as $device ) {
	if ( $device['brand'] ) {
		$brands[ sanitize_title( $device['brand'] ) ] = $device['brand'];
	}
}
asort( $brands, SORT_NATURAL | SORT_FLAG_CASE );
$cards = array();
if ( ! is_wp_error( $offers ) ) {
	foreach ( $offers as $offer ) {
		$view = trilacheck_tariffuxx_offer( $offer );
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
?>
<section class="tc-phone-api" data-api-state="<?php echo is_wp_error( $offers ) ? 'error' : 'ready'; ?>" aria-label="Handys mit Vertrag vergleichen">
	<nav class="tc-phone-api__tabs" aria-label="Vergleich auswählen">
		<a class="is-current" href="<?php echo esc_url( get_permalink() ); ?>#tarifvergleich" aria-current="page">Handy mit Vertrag</a>
		<a href="<?php echo esc_url( home_url( '/mobilfunk/' ) ); ?>">Nur SIM</a>
	</nav>
	<?php if ( is_wp_error( $offers ) ) : ?>
		<div class="tc-phone-api__unavailable" role="status"><h2>Handys mit Vertrag vergleichen</h2><p>Unser eigener Vergleich ist vorübergehend nicht erreichbar. Der bisherige Vergleich steht dir weiterhin zur Verfügung.</p>
		<?php if ( current_user_can( 'manage_options' ) ) : ?><p><a href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>">API-Einstellungen prüfen</a> · <?php echo 'tx_config' === $offers->get_error_code() ? 'API-Schlüssel fehlt auf diesem Server.' : 'Die API-Anfrage konnte nicht abgeschlossen werden.'; ?></p><?php endif; ?>
		</div>
		<?php echo do_shortcode( '[trilacheck_phone_contract]' ); ?>
	<?php else : ?>
		<div class="tc-phone-api__layout">
			<div class="tc-phone-api__mobile-controls"><button type="button" class="tc-phone-api__filter-toggle" aria-expanded="true" aria-controls="tc-phone-filters"><span aria-hidden="true">☷</span> Filter <span aria-hidden="true">⌄</span></button><button type="button" class="tc-phone-api__sort-toggle">↕ Sortieren</button></div>
			<form id="tc-phone-filters" method="get" action="<?php echo esc_url( get_permalink() ); ?>#tarifvergleich" class="tc-phone-api__filters">
				<h2 class="screen-reader-text">Dein Wunschhandy und Tarif</h2>
				<label for="tc-phone-model">Smartphone</label>
				<select id="tc-phone-model" name="telefon"><option value="">Alle Smartphones</option>
					<?php if ( $phone && ! isset( $catalogue[ $phone ] ) ) : ?><option value="<?php echo esc_attr( $phone ); ?>" selected><?php echo esc_html( ucwords( str_replace( '-', ' ', $phone ) ) ); ?></option><?php endif; ?>
					<?php foreach ( $catalogue as $slug => $device ) : ?><option value="<?php echo esc_attr( $slug ); ?>" data-brand="<?php echo esc_attr( sanitize_title( $device['brand'] ) ); ?>" <?php selected( $phone, $slug ); ?>><?php echo esc_html( $device['name'] ); ?></option><?php endforeach; ?>
				</select>
				<?php foreach ( $fields as $name => $field ) : ?>
					<label for="tc-phone-<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
					<select id="tc-phone-<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>"><option value=""><?php echo esc_html( $field['all'] ); ?></option><?php foreach ( $field['choices'] as $value => $label ) : ?><option value="<?php echo esc_attr( $value ); ?>" <?php selected( $field['value'], $value ); ?>><?php echo esc_html( $label ); ?></option><?php endforeach; ?></select>
				<?php endforeach; ?>
				<details class="tc-phone-api__more"><summary>Weitere Filter</summary><label><input type="checkbox" name="5g" value="1" <?php checked( $five_g ); ?>> Nur 5G-Tarife</label><label><input type="checkbox" name="esim" value="1" <?php checked( $esim ); ?>> eSIM verfügbar</label></details>
				<button type="submit">Angebote anzeigen <span aria-hidden="true">→</span></button>
				<a class="tc-phone-api__reset" href="<?php echo esc_url( get_permalink() ); ?>#tarifvergleich">Filter zurücksetzen</a>
			</form>
			<div class="tc-phone-api__results">
				<div class="tc-phone-api__toolbar"><p><strong><?php echo count( $cards ); ?></strong> Angebote auf dieser Seite</p><label for="tc-phone-sort">Sortieren nach:<select id="tc-phone-sort" name="sortierung" form="tc-phone-filters"><option value="effective" <?php selected( $sort, 'effective' ); ?>>Ø Gesamtkosten</option><option value="monthly" <?php selected( $sort, 'monthly' ); ?>>Tarif-Grundgebühr</option></select></label></div>
				<div class="tc-phone-api__selection" hidden><span class="tc-phone-api__selection-count" aria-live="polite"></span><button type="button" class="tc-phone-api__compare-open">Angebote vergleichen</button><button type="button" class="tc-phone-api__compare-clear">Auswahl löschen</button></div>
				<p class="tc-phone-api__source"><span aria-hidden="true">ⓘ</span> Durchschnittskosten über 24 Monate inklusive Einmalkosten und angerechneter Boni. Bedingungen und mögliche Preisphasen findest du in den Tarifdetails.</p>
				<?php foreach ( $cards as $index => $card ) : $offer = $card['offer']; $view = $card['view']; ?>
					<article class="tc-phone-api__card">
						<div class="tc-phone-api__visual"><?php if ( $view['image'] ) : ?><img src="<?php echo esc_url( $view['image'] ); ?>" alt="<?php echo esc_attr( $view['phone'] ); ?>" width="130" height="170" loading="lazy"><?php else : ?><span class="tc-phone-api__phone-placeholder" aria-hidden="true">▯</span><?php endif; ?></div>
						<div class="tc-phone-api__identity"><h3><?php echo esc_html( $view['phone'] ); ?></h3><p><?php echo esc_html( $view['provider'] . ' · ' . $view['tariff'] ); ?></p><ul class="tc-phone-api__features"><li class="tc-phone-api__network tc-phone-api__network--<?php echo esc_attr( $view['network_code'] ); ?>"><?php echo esc_html( $view['network'] ); ?></li><?php foreach ( array( $view['data'], $view['five_g'] ? '5G' : '', $view['term'] ) as $feature ) : ?><?php if ( $feature ) : ?><li><?php echo esc_html( $feature ); ?></li><?php endif; ?><?php endforeach; ?></ul></div>
						<div class="tc-phone-api__price">
							<div><span>Tarif-Grundgebühr</span><strong><?php echo esc_html( $view['monthly'] ); ?></strong><small><?php echo esc_html( $view['billing'] ); ?><?php if ( $view['phases'] ) : ?> · Preisphasen beachten<?php endif; ?></small></div>
							<div><span>Einmaliger Gerätepreis</span><strong><?php echo esc_html( $view['device_price'] ); ?></strong><small>Weitere Einmalkosten: <?php echo esc_html( $view['extra_price'] ); ?></small></div>
							<div class="tc-phone-api__average"><span>Ø pro Monat</span><strong><?php echo esc_html( $view['average'] ); ?></strong><small>inkl. Einmalkosten und angerechneter Vorteile</small></div>
						</div>
						<div class="tc-phone-api__actions">
							<label class="tc-phone-api__compare-label"><input type="checkbox" class="tc-phone-api__compare" data-offer="<?php echo esc_attr( wp_json_encode( $view ) ); ?>"> Vergleichen</label>
							<a class="tc-phone-api__detail-link" href="#tc-phone-details-<?php echo esc_attr( $index ); ?>">Tarifdetails</a>
							<a class="tc-phone-api__offer" href="<?php echo esc_url( $view['link'] ); ?>" target="_blank" rel="sponsored noopener">Zum Angebot <span aria-hidden="true">→</span><span class="screen-reader-text"> (öffnet in neuem Tab)</span></a>
						</div>
						<details id="tc-phone-details-<?php echo esc_attr( $index ); ?>" class="tc-phone-api__details"><summary>Kosten & Vertragsbedingungen</summary>
							<p>Gesamtkosten über 24 Monate: <strong><?php echo esc_html( $view['total'] ); ?></strong></p>
							<?php foreach ( array( 'one_time_product_charges' => 'Einmalige Kosten', 'recurring_product_charges' => 'Laufende Tarifkosten', 'bonus_product_charges' => 'Boni und Vorteile' ) as $field => $label ) : ?>
								<h4><?php echo esc_html( $label ); ?></h4><ul><?php foreach ( trilacheck_tariffuxx_charges( $offer[ $field ] ?? array() ) as $charge ) : ?><li><?php echo esc_html( trilacheck_tariffuxx_text( $charge['description'] ?? '' ) . ': ' . trilacheck_tariffuxx_money( $charge['value'] ?? 0 ) . ' ' . trilacheck_tariffuxx_text( $charge['period_description'] ?? '' ) ); ?><?php if ( ! empty( $charge['from_period'] ) ) : ?> · ab Periode <?php echo esc_html( $charge['from_period'] ); ?><?php endif; ?><?php if ( ! empty( $charge['to_period'] ) ) : ?> bis <?php echo esc_html( $charge['to_period'] ); ?><?php endif; ?><?php if ( ! empty( $charge['info'] ) ) : ?> — <?php echo esc_html( trilacheck_tariffuxx_text( $charge['info'] ) ); ?><?php endif; ?></li><?php endforeach; ?></ul>
							<?php endforeach; ?>
							<p>Die Gesamtkosten enthalten auch ausgewählte Geräte- und Optionskosten, die nicht immer Teil der Tarif-Grundgebühr sind. Angerechnete Boni und Cashback gelten nur bei Erfüllung ihrer Bedingungen.</p>
							<?php if ( ! empty( $offer['warning_info_text'] ) ) : ?><p><?php echo esc_html( trilacheck_tariffuxx_text( $offer['warning_info_text'] ) ); ?></p><?php endif; ?>
							<?php if ( ! empty( $offer['product_voucher'] ) ) : ?><p>Gutscheincode: <strong><?php echo esc_html( trilacheck_tariffuxx_text( $offer['product_voucher']['code'] ?? '' ) ); ?></strong> — <?php echo esc_html( trilacheck_tariffuxx_text( ( $offer['product_voucher']['benefit'] ?? '' ) . ' ' . ( $offer['product_voucher']['conditions'] ?? '' ) ) ); ?></p><?php endif; ?>
							<?php foreach ( (array) ( $offer['product_documents'] ?? array() ) as $document ) : ?><p><a href="<?php echo esc_url( $document['url'] ?? '' ); ?>" target="_blank" rel="noopener"><?php echo esc_html( trilacheck_tariffuxx_text( $document['description'] ?? 'Produktinformationen' ) ); ?></a></p><?php endforeach; ?>
						</details>
					</article>
				<?php endforeach; ?>
				<?php if ( ! $cards ) : ?><div class="tc-phone-api__empty" role="status"><h3>Keine passenden Angebote gefunden</h3><p>Wähle ein anderes Smartphone oder erweitere Gerätepreis, Datenvolumen oder Laufzeit.</p><a href="<?php echo esc_url( get_permalink() ); ?>#tarifvergleich">Alle Angebote anzeigen →</a></div><?php endif; ?>
				<nav class="tc-phone-api__pagination" aria-label="Angebotsseiten"><?php if ( $page > 1 ) : ?><a href="<?php echo esc_url( add_query_arg( 'angebote_seite', $page - 1 ) . '#tarifvergleich' ); ?>">← Zurück</a><?php endif; ?><?php if ( count( $offers ) >= 12 && $page < 100 ) : ?><a href="<?php echo esc_url( add_query_arg( 'angebote_seite', $page + 1 ) . '#tarifvergleich' ); ?>">Weitere Angebote →</a><?php endif; ?></nav>
				<p class="tc-phone-api__disclosure">Tarifdaten: TARIFFUXX · Kostenloser Vergleich. Bei einem Vertragsabschluss können wir eine Provision erhalten. Für dich entstehen keine zusätzlichen Gebühren durch Trilacheck.</p>
			</div>
		</div>
	<?php endif; ?>
</section>
