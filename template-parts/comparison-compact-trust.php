<?php
/** Compact service indicators, not a customer review or aggregate rating. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
?>
<div class="tc-compact-trust">
	<span><?php echo trilacheck_tariffuxx_icon( 'shield' ); ?> HTTPS-geschützt</span>
	<span>100 % kostenlos vergleichen</span>
	<span class="tc-compact-trust__service">Vertrauen & Service <span class="tc-compact-trust__stars" aria-hidden="true"><?php for ( $star = 0; $star < 5; ++$star ) { echo trilacheck_tariffuxx_icon( 'star' ); } ?></span></span>
</div>
