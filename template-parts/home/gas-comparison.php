<?php
/** Homepage gas comparison module. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
?>
<section class="tc-home-gas tc-container" aria-labelledby="tc-home-gas-title">
	<div class="tc-home-gas__card">
		<div class="tc-home-gas__summary">
			<div class="tc-home-gas__heading">
				<span aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M13.2 2.5c.5 3-1.2 4.2-2.7 5.9-1.3 1.4-2.5 2.9-2.5 5.3a4.5 4.5 0 0 0 9 0c0-1.9-.8-3.6-2.2-5.1.1 2.1-1 3.1-2 3.8.4-2.6-.8-4.3.4-9.9Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
				<div><p><?php esc_html_e( 'Gasvergleich', 'trilacheck' ); ?></p><h2 id="tc-home-gas-title"><?php esc_html_e( 'Gastarife für deinen Haushalt vergleichen', 'trilacheck' ); ?></h2></div>
			</div>
			<p class="tc-home-gas__intro"><?php esc_html_e( 'Vergleiche verfügbare Gastarife nach Jahreskosten, Laufzeit, Preisgarantie und Bonusbedingungen.', 'trilacheck' ); ?></p>
			<div class="tc-home-gas__saving"><small><?php esc_html_e( 'Mögliche Ersparnis', 'trilacheck' ); ?></small><strong><?php esc_html_e( 'bis zu 1.250 € sparen', 'trilacheck' ); ?><sup>1</sup></strong></div>
		</div>

		<div class="tc-home-gas__compare">
			<div class="tc-home-gas__meter" aria-hidden="true">
				<div><span><?php esc_html_e( 'Wohnfläche', 'trilacheck' ); ?></span><b>100 m²</b></div>
				<div><span><?php esc_html_e( 'Verbrauch', 'trilacheck' ); ?></span><b>12.000 kWh</b></div>
			</div>
			<ul>
				<li><?php esc_html_e( 'Mehr als 850 Anbieter vergleichen', 'trilacheck' ); ?></li>
				<li><?php esc_html_e( 'Gesamtkosten statt nur Abschlag prüfen', 'trilacheck' ); ?></li>
				<li><?php esc_html_e( 'Kostenlos und unverbindlich', 'trilacheck' ); ?></li>
			</ul>
			<a href="<?php echo esc_url( home_url( '/gas/' ) ); ?>"><?php esc_html_e( 'Gasvergleich starten', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
		</div>
	</div>
	<p class="tc-home-gas__disclaimer"><sup>1</sup> <?php esc_html_e( 'Die tatsächliche Ersparnis hängt unter anderem von Wohnort, Verbrauch, bisherigem Tarif und gewähltem Angebot ab.', 'trilacheck' ); ?></p>
</section>
