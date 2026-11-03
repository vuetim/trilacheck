<?php
/** Homepage vehicle insurance links. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
?>
<section class="tc-home-vehicle tc-container" aria-labelledby="tc-home-vehicle-title">
	<div class="tc-home-vehicle__head"><p><?php esc_html_e( 'Direkt zum Vergleich', 'trilacheck' ); ?></p><h2 id="tc-home-vehicle-title"><?php esc_html_e( 'Fahrzeug versichern und Tarife vergleichen', 'trilacheck' ); ?></h2></div>
	<div class="tc-home-vehicle__grid">
		<a class="tc-home-vehicle-card tc-home-vehicle-card--car" href="<?php echo esc_url( home_url( '/auto-fahrzeuge/#kfz-versicherung' ) ); ?>"><span><strong><?php esc_html_e( 'Kfz-Versicherung', 'trilacheck' ); ?></strong><small><?php esc_html_e( 'Beiträge und Leistungen vergleichen', 'trilacheck' ); ?></small></span><svg viewBox="0 0 180 90" aria-hidden="true"><path d="M31 59h119l-8-28c-2-7-8-11-15-11H72c-7 0-13 4-17 10L41 48H27c-7 0-12 5-12 12v7h12"/><path d="M49 48h86M62 48l12-19h47l8 19"/><circle cx="48" cy="66" r="12"/><circle cx="132" cy="66" r="12"/></svg><b aria-hidden="true">→</b></a>
		<a class="tc-home-vehicle-card tc-home-vehicle-card--motorcycle" href="<?php echo esc_url( home_url( '/auto-fahrzeuge/#motorradversicherung' ) ); ?>"><span><strong><?php esc_html_e( 'Motorradversicherung', 'trilacheck' ); ?></strong><small><?php esc_html_e( 'Passenden Schutz fürs Motorrad finden', 'trilacheck' ); ?></small></span><svg viewBox="0 0 180 90" aria-hidden="true"><circle cx="43" cy="64" r="20"/><circle cx="139" cy="64" r="20"/><path d="M43 64l31-31h34l31 31M74 33l18 31H43l34-18h42M103 22h23M119 46l9-24"/></svg><b aria-hidden="true">→</b></a>
	</div>
</section>
