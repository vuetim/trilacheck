<?php
/** Homepage rental car and current account cards. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
?>
<section class="tc-home-services tc-container" aria-labelledby="tc-home-services-title">
	<h2 id="tc-home-services-title" class="screen-reader-text"><?php esc_html_e( 'Weitere Vergleiche', 'trilacheck' ); ?></h2>
	<article class="tc-service-card tc-service-card--car">
		<div class="tc-service-card__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="m5 16-1.5-1v-3L5 8h14l1.5 4v3L19 16M7 8l1-3h8l1 3M6 16v2M18 16v2M7.5 12h.01M16.5 12h.01" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
		<div class="tc-service-card__copy"><p><?php esc_html_e( 'Mobil am Reiseziel', 'trilacheck' ); ?></p><h3><?php esc_html_e( 'Mietwagen vergleichen', 'trilacheck' ); ?></h3><span><?php esc_html_e( 'Fahrzeugklasse, Versicherung und Mietbedingungen übersichtlich prüfen.', 'trilacheck' ); ?></span></div>
		<div class="tc-service-card__facts"><span><small><?php esc_html_e( 'Abholung', 'trilacheck' ); ?></small><b><?php esc_html_e( 'Ort wählen', 'trilacheck' ); ?></b></span><span><small><?php esc_html_e( 'Zeitraum', 'trilacheck' ); ?></small><b><?php esc_html_e( 'Flexibel', 'trilacheck' ); ?></b></span></div>
		<a href="<?php echo esc_url( home_url( '/mietwagen/' ) ); ?>"><?php esc_html_e( 'Mietwagen finden', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
	</article>
	<article class="tc-service-card tc-service-card--account">
		<div class="tc-service-card__icon" aria-hidden="true">€</div>
		<div class="tc-service-card__copy"><p><?php esc_html_e( 'Bankkonto', 'trilacheck' ); ?></p><h3><?php esc_html_e( 'Girokonten vergleichen', 'trilacheck' ); ?></h3><span><?php esc_html_e( 'Kontogebühren, Karten, Bargeldversorgung und Bonusbedingungen vergleichen.', 'trilacheck' ); ?></span></div>
		<div class="tc-service-card__facts"><span><small><?php esc_html_e( 'Kontomodell', 'trilacheck' ); ?></small><b><?php esc_html_e( 'Passend wählen', 'trilacheck' ); ?></b></span><span><small><?php esc_html_e( 'Bonus', 'trilacheck' ); ?></small><b><?php esc_html_e( 'bis zu 125 €', 'trilacheck' ); ?><sup>1</sup></b></span></div>
		<a href="<?php echo esc_url( home_url( '/girokonto/' ) ); ?>"><?php esc_html_e( 'Girokonto vergleichen', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
	</article>
	<p class="tc-home-services__note"><sup>1</sup> <?php esc_html_e( 'Ein möglicher Bonus hängt vom gewählten Angebot und den genannten Voraussetzungen ab.', 'trilacheck' ); ?></p>
</section>
