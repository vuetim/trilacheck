<?php
/** Homepage electricity comparison teaser. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
?>
<section class="tc-home-power tc-container" aria-labelledby="tc-home-power-title">
	<div class="tc-home-power__card">
		<div class="tc-home-power__content">
			<div class="tc-home-power__title-row">
				<span class="tc-home-power__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M9.6 21h4.8M9 17h6M8.3 13.7A6 6 0 1 1 15.7 13.7C14.6 14.5 14 15.5 14 17h-4c0-1.5-.6-2.5-1.7-3.3Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
				<div><p><?php esc_html_e( 'Stromvergleich', 'trilacheck' ); ?></p><h2 id="tc-home-power-title"><?php esc_html_e( 'Stromkosten prüfen', 'trilacheck' ); ?></h2></div>
			</div>
			<div class="tc-home-power__saving"><small><?php esc_html_e( 'Mögliche Ersparnis', 'trilacheck' ); ?></small><strong><?php esc_html_e( 'bis zu 850 € sparen', 'trilacheck' ); ?><sup>1</sup></strong></div>
			<p class="tc-home-power__lead"><?php esc_html_e( 'Tarife für deinen Wohnort vergleichen – passend zu Haushaltsgröße und Jahresverbrauch.', 'trilacheck' ); ?></p>
		</div>
		<div class="tc-home-power__action">
			<div class="tc-home-power__inputs" aria-hidden="true"><span><small><?php esc_html_e( 'Postleitzahl', 'trilacheck' ); ?></small><b><?php esc_html_e( 'z. B. 10115', 'trilacheck' ); ?></b></span><span><small><?php esc_html_e( 'Jahresverbrauch', 'trilacheck' ); ?></small><b>2.500 kWh</b></span></div>
			<a class="tc-home-power__button" href="<?php echo esc_url( home_url( '/strom/' ) ); ?>"><?php esc_html_e( 'Stromtarife vergleichen', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
			<ul><li><?php esc_html_e( 'Tarife übersichtlich vergleichen', 'trilacheck' ); ?></li><li><?php esc_html_e( 'Kostenlos und unverbindlich', 'trilacheck' ); ?></li></ul>
		</div>
	</div>
	<p class="tc-home-power__disclaimer"><sup>1</sup> <?php esc_html_e( 'Die tatsächliche Ersparnis hängt unter anderem von Wohnort, Verbrauch, bisherigem Tarif und gewähltem Angebot ab.', 'trilacheck' ); ?></p>
</section>
