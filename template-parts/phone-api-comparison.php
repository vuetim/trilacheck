<?php
/** Phone bundle comparison, rendered on the server. @package Trilacheck */
defined( 'ABSPATH' ) || exit;

$read = function ( $name ) {
	return isset( $_GET[ $name ] ) && is_string( $_GET[ $name ] ) ? sanitize_text_field( wp_unslash( $_GET[ $name ] ) ) : '';
};
$phone   = $read( 'telefon' );
$network = $read( 'netz' );
$data    = $read( 'daten' );
$upfront = $read( 'anzahlung' );
$budget  = $read( 'budget' );
$sort    = $read( 'sortierung' );
$page    = max( 1, min( 100, absint( $read( 'angebote_seite' ) ) ) );
$params  = array( 'type' => 1, 'incl_bundles' => 1, 'filter' => 0, 'count' => 12, 'from' => ( $page - 1 ) * 12, 'subid' => 'trilacheck-handy', 'com_only' => 1 );
if ( $phone && preg_match( '/^[a-z0-9-]{1,120}$/', $phone ) ) {
	$params['phone'] = array( $phone );
} else {
	$phone = '';
}
if ( in_array( $network, array( 'd1', 'd2', 'o2', '1u1' ), true ) ) {
	$params['networks'] = array( $network => 1 );
} else {
	$network = '';
}
if ( in_array( $data, array( '5000', '15000', '30000', '50000', '100000' ), true ) ) {
	$params['data_units'] = (int) $data;
} else {
	$data = '';
}
if ( in_array( $upfront, array( '0', '1', '50', '100', '200' ), true ) ) {
	$params['max_phone_price'] = (float) $upfront;
} else {
	$upfront = '';
}
if ( in_array( $budget, array( '20', '30', '40', '50', '70' ), true ) ) {
	$params['price_filter_type']  = 'max_price_monthly';
	$params['price_filter_value'] = (float) $budget;
} else {
	$budget = '';
}
$params['sort_prop'] = 'monthly' === $sort ? 'MONTHLY_FEES' : 'EFFECTIVE_COSTS';
$offers = trilacheck_tariffuxx_request( 'get-offers-by-params', $params );
$devices = trilacheck_tariffuxx_models( $offers );
?>
<section class="tc-phone-api" aria-labelledby="tc-phone-api-title">
	<h2 id="tc-phone-api-title">Smartphone und passenden Tarif finden</h2>
	<p>Wähle dein Wunschhandy und vergleiche Gerätepreis, Tarif und Gesamtkosten.</p>
	<form method="get" action="<?php echo esc_url( get_permalink() ); ?>#tarifvergleich" class="tc-phone-api__filters">
		<label>Smartphone<select name="telefon"><option value="">Alle Smartphones</option><?php if ( $phone && ! isset( $devices[ $phone ] ) ) : ?><option value="<?php echo esc_attr( $phone ); ?>" selected><?php echo esc_html( ucwords( str_replace( '-', ' ', $phone ) ) ); ?></option><?php endif; ?><?php foreach ( $devices as $slug => $name ) : ?><option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $phone, $slug ); ?>><?php echo esc_html( $name ); ?></option><?php endforeach; ?></select></label>
		<label>Netz<select name="netz"><option value="">Alle Netze</option><?php foreach ( array( 'd1' => 'Telekom-Netz', 'd2' => 'Vodafone-Netz', 'o2' => 'Telefónica (o2)', '1u1' => '1&1' ) as $value => $label ) : ?><option value="<?php echo esc_attr( $value ); ?>" <?php selected( $network, $value ); ?>><?php echo esc_html( $label ); ?></option><?php endforeach; ?></select></label>
		<label>Datenvolumen<select name="daten"><option value="">Alle</option><?php foreach ( array( '5000', '15000', '30000', '50000', '100000' ) as $value ) : ?><option value="<?php echo esc_attr( $value ); ?>" <?php selected( $data, $value ); ?>>Ab <?php echo esc_html( $value / 1000 ); ?> GB</option><?php endforeach; ?></select></label>
		<label>Gerätepreis einmalig<select name="anzahlung"><option value="">Alle</option><?php foreach ( array( '0', '1', '50', '100', '200' ) as $value ) : ?><option value="<?php echo esc_attr( $value ); ?>" <?php selected( $upfront, $value ); ?>>Bis <?php echo esc_html( $value ); ?> €</option><?php endforeach; ?></select></label>
		<label>Monatliche Grundgebühr<select name="budget"><option value="">Alle</option><?php foreach ( array( '20', '30', '40', '50', '70' ) as $value ) : ?><option value="<?php echo esc_attr( $value ); ?>" <?php selected( $budget, $value ); ?>>Bis <?php echo esc_html( $value ); ?> €</option><?php endforeach; ?></select></label>
		<label>Sortieren nach<select name="sortierung"><option value="effective" <?php selected( $sort, 'effective' ); ?>>Ø Gesamtkosten / Monat</option><option value="monthly" <?php selected( $sort, 'monthly' ); ?>>Monatliche Grundgebühr</option></select></label>
		<button type="submit">Angebote vergleichen →</button>
		<a href="<?php echo esc_url( get_permalink() ); ?>#tarifvergleich">Filter zurücksetzen</a>
	</form>
	<?php if ( is_wp_error( $offers ) ) : ?>
		<p role="status">Der neue Vergleich ist momentan nicht verfügbar. Nutze bitte unseren bisherigen Vergleich:</p>
		<?php echo do_shortcode( '[trilacheck_phone_contract]' ); ?>
	<?php else : ?>
		<p class="tc-phone-api__source">Tarifdaten: TARIFFUXX · Durchschnittskosten über 24 Monate inklusive Einmalkosten, angerechneter Boni und Cashback. Bedingungen beachten.</p>
		<?php
		$shown = 0;
		foreach ( $offers as $offer ) :
			$link = trilacheck_tariffuxx_link( $offer['product_link'] ?? '' );
			$hardware = $offer['product_hardware_items'] ?? null;
			if ( is_array( $hardware ) && isset( $hardware[0] ) ) {
				$hardware = $hardware[0];
			}
			if ( ! $link || ! is_array( $hardware ) ) {
				continue;
			}
			++$shown;
			$one_time = trilacheck_tariffuxx_charges( $offer['one_time_product_charges'] ?? array() );
			$recurring = trilacheck_tariffuxx_charges( $offer['recurring_product_charges'] ?? array() );
			$image = '';
			if ( ! empty( $hardware['product_images'][0]['file_name'] ) ) {
				$brand = strtolower( str_replace( ' ', '-', $hardware['brand'] ?? '' ) );
				$model = strtolower( str_replace( ' ', '-', $hardware['model'] ?? '' ) );
				$image = 'https://assets.tariffuxx.de/img/hardware/' . rawurlencode( $brand ) . '/' . rawurlencode( $model ) . '/' . rawurlencode( $hardware['product_images'][0]['file_name'] ) . '.png';
			}
			?>
			<article class="tc-phone-api__card">
				<?php if ( $image ) : ?><img class="tc-phone-api__image" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( trilacheck_tariffuxx_text( $hardware['description'] ?? $hardware['model'] ?? '' ) ); ?>" width="120" height="160" loading="lazy"><?php endif; ?>
				<div class="tc-phone-api__body">
					<h3><?php echo esc_html( trilacheck_tariffuxx_text( $hardware['description'] ?? $hardware['model'] ?? 'Smartphone' ) ); ?></h3>
					<p><?php echo esc_html( trilacheck_tariffuxx_text( ( $offer['provider']['name'] ?? '' ) . ' · ' . ( $offer['name'] ?? '' ) ) ); ?></p>
					<ul class="tc-phone-api__features"><?php foreach ( array( $offer['mobile_network_name'] ?? '', $offer['internet_data_volume'] ?? '', ! empty( $offer['is_5g'] ) ? '5G' : '', $offer['contract_period_text'] ?? '' ) as $feature ) : ?><?php if ( $feature ) : ?><li><?php echo esc_html( trilacheck_tariffuxx_text( $feature ) ); ?></li><?php endif; ?><?php endforeach; ?></ul>
					<ul class="tc-phone-api__costs"><?php foreach ( $recurring as $charge ) : ?><li><?php echo esc_html( trilacheck_tariffuxx_text( $charge['description'] ?? 'Tarifkosten' ) . ': ' . trilacheck_tariffuxx_money( $charge['value'] ?? 0 ) . ' ' . trilacheck_tariffuxx_text( $charge['period_description'] ?? '' ) ); ?><?php if ( ! empty( $charge['from_period'] ) ) : ?> · ab Periode <?php echo esc_html( $charge['from_period'] ); ?><?php endif; ?><?php if ( ! empty( $charge['to_period'] ) ) : ?> bis <?php echo esc_html( $charge['to_period'] ); ?><?php endif; ?></li><?php endforeach; ?><?php foreach ( $one_time as $charge ) : ?><li><?php echo esc_html( trilacheck_tariffuxx_text( $charge['description'] ?? 'Einmalkosten' ) . ': ' . trilacheck_tariffuxx_money( $charge['value'] ?? 0 ) . ' einmalig' ); ?></li><?php endforeach; ?></ul>
					<div class="tc-phone-api__price"><span>Ø pro Monat über 24 Monate<strong><?php echo esc_html( trilacheck_tariffuxx_money( $offer['effective_product_charges'] ?? 0 ) ); ?></strong></span><span>Gesamtkosten über 24 Monate<strong><?php echo esc_html( trilacheck_tariffuxx_money( $offer['total_product_charges'] ?? 0 ) ); ?></strong></span></div>
					<details><summary>Kosten & Tarifdetails</summary>
						<?php foreach ( array( 'one_time_product_charges' => 'Einmalige Kosten', 'recurring_product_charges' => 'Laufende Tarifkosten', 'bonus_product_charges' => 'Boni und Vorteile' ) as $field => $label ) : ?>
							<p><strong><?php echo esc_html( $label ); ?></strong></p><ul><?php foreach ( trilacheck_tariffuxx_charges( $offer[ $field ] ?? array() ) as $charge ) : ?><li><?php echo esc_html( trilacheck_tariffuxx_text( $charge['description'] ?? '' ) . ': ' . trilacheck_tariffuxx_money( $charge['value'] ?? 0 ) . ' ' . trilacheck_tariffuxx_text( $charge['period_description'] ?? '' ) ); ?><?php if ( ! empty( $charge['from_period'] ) ) : ?> · ab Periode <?php echo esc_html( $charge['from_period'] ); ?><?php endif; ?><?php if ( ! empty( $charge['to_period'] ) ) : ?> bis <?php echo esc_html( $charge['to_period'] ); ?><?php endif; ?><?php if ( ! empty( $charge['info'] ) ) : ?> — <?php echo esc_html( trilacheck_tariffuxx_text( $charge['info'] ) ); ?><?php endif; ?></li><?php endforeach; ?></ul>
						<?php endforeach; ?>
						<p>Die Gesamtkosten enthalten auch ausgewählte Geräte- und Optionskosten; diese sind nicht immer Teil der laufenden Tarifkosten oben.</p>
						<?php if ( ! empty( $offer['warning_info_text'] ) ) : ?><p><?php echo esc_html( trilacheck_tariffuxx_text( $offer['warning_info_text'] ) ); ?></p><?php endif; ?>
						<?php if ( ! empty( $offer['product_voucher'] ) ) : ?><p>Gutscheincode: <strong><?php echo esc_html( trilacheck_tariffuxx_text( $offer['product_voucher']['code'] ?? '' ) ); ?></strong> — <?php echo esc_html( trilacheck_tariffuxx_text( ( $offer['product_voucher']['benefit'] ?? '' ) . ' ' . ( $offer['product_voucher']['conditions'] ?? '' ) ) ); ?></p><?php endif; ?>
						<?php foreach ( (array) ( $offer['product_documents'] ?? array() ) as $document ) : ?><p><a href="<?php echo esc_url( $document['url'] ?? '' ); ?>" target="_blank" rel="noopener"><?php echo esc_html( trilacheck_tariffuxx_text( $document['description'] ?? 'Produktinformationen' ) ); ?></a></p><?php endforeach; ?>
					</details>
				</div>
				<a class="tc-phone-api__offer" href="<?php echo esc_url( $link ); ?>" rel="sponsored noopener" target="_blank">Zum Angebot <span class="screen-reader-text">(öffnet in neuem Tab)</span> →</a>
			</article>
		<?php endforeach; ?>
		<?php if ( ! $shown ) : ?><p role="status">Keine passenden Angebote gefunden. Bitte wähle ein anderes Smartphone oder erweitere die Filter.</p><?php endif; ?>
		<nav class="tc-phone-api__pagination" aria-label="Angebotsseiten"><?php if ( $page > 1 ) : ?><a href="<?php echo esc_url( add_query_arg( 'angebote_seite', $page - 1 ) . '#tarifvergleich' ); ?>">← Zurück</a><?php endif; ?><?php if ( count( $offers ) >= 12 && $page < 100 ) : ?><a href="<?php echo esc_url( add_query_arg( 'angebote_seite', $page + 1 ) . '#tarifvergleich' ); ?>">Weitere Angebote →</a><?php endif; ?></nav>
		<p>Bei einem Vertragsabschluss können wir eine Provision erhalten. Für dich entstehen keine zusätzlichen Gebühren durch Trilacheck.</p>
	<?php endif; ?>
</section>
