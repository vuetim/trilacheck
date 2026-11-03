<?php
/** Metadata and robots regressions without touching WordPress content. */
define( 'ABSPATH', __DIR__ );
class WP_Query { public $found_posts = 0; }
$wp_query = new WP_Query();
$context = array( 'singular' => false, 'category' => false, 'slug' => '' );
function add_filter( ...$args ) {}
function is_singular() { global $context; return $context['singular']; }
function is_category( $slug = '' ) { global $context; return $context['category'] && ( '' === $slug || $slug === $context['slug'] ); }
function get_queried_object() { global $context; return (object) array( 'post_name' => $context['slug'] ); }
function check( $result, $message ) { if ( ! $result ) { throw new RuntimeException( $message ); } }
require dirname( __DIR__, 2 ) . '/includes/technical-seo.php';

foreach ( array( 'cookies', 'vertrag-kuendigen', 'gasvergleich-2026-worauf-sollte-man-beim-gastarif-achten' ) as $slug ) {
	$context = array( 'singular' => true, 'category' => false, 'slug' => $slug );
	check( '' !== trilacheck_missing_seo_description( '' ), 'Missing description: ' . $slug );
	check( 'Editor description' === trilacheck_missing_seo_description( 'Editor description' ), 'Existing description overwritten' );
}
$context = array( 'singular' => true, 'category' => false, 'slug' => 'strom' );
check( '' === trilacheck_missing_seo_description( '' ), 'Unrelated page changed' );
$context = array( 'singular' => false, 'category' => true, 'slug' => 'auto-fahrzeuge' );
check( '' !== trilacheck_missing_seo_description( '' ), 'Auto category description missing' );
check( 'noindex, follow, max-image-preview:large' === trilacheck_empty_category_robots( 'noindex, follow, max-image-preview:large' ), 'Existing restrictive robots changed' );
$robots = trilacheck_empty_category_robots( 'index, follow, max-image-preview:large' );
check( str_contains( $robots, 'noindex' ) && str_contains( $robots, 'follow' ) && str_contains( $robots, 'max-image-preview:large' ), 'Empty archive directives incorrect' );
check( false === trilacheck_empty_category_robots( false ), 'Explicitly disabled Yoast tag re-enabled' );
$wp_query->found_posts = 2;
check( 'index, follow' === trilacheck_empty_category_robots( 'index, follow' ), 'Non-empty category noindexed' );
$context['category'] = false;
$wp_query->found_posts = 0;
check( 'index, follow' === trilacheck_empty_category_robots( 'index, follow' ), 'Normal page noindexed' );
echo "PASS: missing descriptions, editor overrides, scoped empty-category noindex and preserved robots directives.\n";
