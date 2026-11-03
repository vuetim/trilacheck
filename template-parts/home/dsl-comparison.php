<?php
/** Homepage DSL comparison banner. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
?>
<section class="tc-home-dsl tc-container" aria-labelledby="tc-home-dsl-title">
	<div class="tc-home-dsl__card">
		<div class="tc-home-dsl__copy"><span class="tc-home-dsl__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 10.5a11.3 11.3 0 0 1 16 0M7.2 13.7a6.8 6.8 0 0 1 9.6 0M10.4 16.9a2.3 2.3 0 0 1 3.2 0M12 20h.01" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/></svg></span><div><p><?php esc_html_e( 'Internet für Zuhause', 'trilacheck' ); ?></p><h2 id="tc-home-dsl-title"><?php esc_html_e( 'DSL-Tarife an deiner Adresse prüfen', 'trilacheck' ); ?></h2><span><?php esc_html_e( 'Verfügbarkeit, Geschwindigkeit und Gesamtkosten vergleichen.', 'trilacheck' ); ?></span></div></div>
		<div class="tc-home-dsl__action"><div class="tc-home-dsl__address" aria-hidden="true"><small><?php esc_html_e( 'Verfügbarkeitscheck', 'trilacheck' ); ?></small><b><?php esc_html_e( 'Adresse eingeben', 'trilacheck' ); ?></b></div><div class="tc-home-dsl__speeds" aria-hidden="true"><span>50</span><span class="is-active">100</span><span>250</span><small>Mbit/s</small></div><a href="<?php echo esc_url( home_url( '/dsl/' ) ); ?>"><?php esc_html_e( 'DSL vergleichen', 'trilacheck' ); ?><span aria-hidden="true">→</span></a></div>
	</div>
</section>
