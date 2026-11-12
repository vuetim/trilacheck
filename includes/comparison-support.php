<?php
/** Share theme notices with comparisons still rendered by Core. @package Trilacheck */
defined( 'ABSPATH' ) || exit;

/** Replace only the existing cost notice; leave the calculator output intact. */
function trilacheck_comparison_support_shortcode( $output, $tag ) {
	if ( 0 !== strpos( $tag, 'trilacheck_' ) || false === strpos( $output, 'tc-affiliate-notice' ) ) {
		return $output;
	}
	ob_start();
	get_template_part( 'template-parts/comparison-support' );
	$notice = ob_get_clean();
	$updated = preg_replace_callback( '/<p\b[^>]*class="tc-affiliate-notice"[^>]*>.*?<\/p>/s', static function () use ( $notice ) {
		return $notice;
	}, $output, 1, $replaced );
	if ( ! $replaced ) { return $output; }
	ob_start();
	get_template_part( 'template-parts/comparison-disclosure' );
	return $updated . ob_get_clean();
}
add_filter( 'do_shortcode_tag', 'trilacheck_comparison_support_shortcode', 10, 2 );
