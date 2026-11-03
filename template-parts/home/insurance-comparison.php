<?php
/** Homepage insurance category strip. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
$items = array(
	array( 'label'=>__( 'Auto & Fahrzeuge', 'trilacheck' ), 'url'=>'/auto-fahrzeuge/', 'mark'=>'A' ),
	array( 'label'=>__( 'Vorsorge', 'trilacheck' ), 'url'=>'/vorsorge-versicherungen/', 'mark'=>'V' ),
	array( 'label'=>__( 'Krankenversicherung', 'trilacheck' ), 'url'=>'/krankenversicherungen/', 'mark'=>'K' ),
	array( 'label'=>__( 'Sachversicherung', 'trilacheck' ), 'url'=>'/sachversicherungen/', 'mark'=>'S' ),
);
?>
<section class="tc-home-insurance tc-container" aria-labelledby="tc-home-insurance-title">
	<div class="tc-home-insurance__head"><div><p><?php esc_html_e( 'Risiken passend absichern', 'trilacheck' ); ?></p><h2 id="tc-home-insurance-title"><?php esc_html_e( 'Versicherungen nach Bereich vergleichen', 'trilacheck' ); ?></h2></div><a href="<?php echo esc_url( home_url( '/versicherungen/' ) ); ?>"><?php esc_html_e( 'Alle Versicherungen', 'trilacheck' ); ?><span aria-hidden="true">→</span></a></div><div class="tc-home-insurance__grid"><?php foreach($items as $item): ?><a href="<?php echo esc_url(home_url($item['url'])); ?>"><span aria-hidden="true"><?php echo esc_html($item['mark']); ?></span><strong><?php echo esc_html($item['label']); ?></strong><b aria-hidden="true">→</b></a><?php endforeach; ?></div>
</section>
