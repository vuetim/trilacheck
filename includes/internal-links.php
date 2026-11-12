<?php
/**
 * Category-based links using the existing article cards and sidebar.
 *
 * @package Trilacheck
 */

defined( 'ABSPATH' ) || exit;

/** Include the published eco comparison in configured navigation, once. */
function trilacheck_eco_menu_link( $items, $args ) {
	if ( ! in_array( $args->theme_location ?? '', array( 'primary', 'quick_links', 'footer' ), true ) ) {
		return $items;
	}
	$page = get_page_by_path( 'oekostrom' );
	if ( ! $page || 'publish' !== $page->post_status ) {
		return $items;
	}
	$url = get_permalink( $page->ID );
	$path = untrailingslashit( wp_parse_url( $url, PHP_URL_PATH ) ?? '' );
	preg_match_all( '/\bhref=([\'"])(.*?)\1/i', $items, $links );
	foreach ( $links[2] as $link ) {
		$link_path = wp_parse_url( html_entity_decode( $link, ENT_QUOTES, 'UTF-8' ), PHP_URL_PATH );
		if ( untrailingslashit( $link_path ?? '' ) === $path ) {
			return $items;
		}
	}
	$active = is_page( $page->ID );
	return $items . sprintf(
		'<li class="menu-item%1$s"><a href="%2$s"%3$s>%4$s</a></li>',
		$active ? ' current-menu-item' : '',
		esc_url( $url ),
		$active ? ' aria-current="page"' : '',
		esc_html__( 'Ökostrom', 'trilacheck' )
	);
}
add_filter( 'wp_nav_menu_items', 'trilacheck_eco_menu_link', 10, 2 );

/** Category candidates are ordered from specific to broader existing topics. */
function trilacheck_comparison_categories() {
	return array(
		'gas'                       => array( 'gas' ),
		'strom'                     => array( 'strom' ),
		'oekostrom'                 => array( 'oekostrom', 'strom' ),
		'dsl'                       => array( 'dsl' ),
		'mobilfunk'                 => array( 'mobilfunk', 'internet-mobilfunk' ),
		'handy-mit-vertrag'          => array( 'handy-mit-vertrag', 'mobilfunk', 'internet-mobilfunk' ),
		'handytarife-5gb'            => array( 'handytarife-5gb', 'mobilfunk', 'internet-mobilfunk' ),
		'handytarife-15gb'           => array( 'handytarife-15gb', 'mobilfunk', 'internet-mobilfunk' ),
		'handytarife-50gb'           => array( 'handytarife-50gb', 'mobilfunk', 'internet-mobilfunk' ),
		'handytarife-unlimited'      => array( 'handytarife-unlimited', 'mobilfunk', 'internet-mobilfunk' ),
		'tarife-fur-junge-leute'     => array( 'tarife-fur-junge-leute', 'mobilfunk', 'internet-mobilfunk' ),
		'prepaid-tarife'             => array( 'prepaid-tarife', 'mobilfunk', 'internet-mobilfunk' ),
		'reise'                     => array( 'reise', 'reise-mietwagen' ),
		'mietwagen'                 => array( 'mietwagen', 'reise-mietwagen' ),
		'girokonto'                 => array( 'girokonto', 'konto-finanzen' ),
		'auto-fahrzeuge'             => array( 'auto-fahrzeuge' ),
		'krankenversicherungen'      => array( 'krankenversicherungen' ),
		'vorsorge-versicherungen'    => array( 'vorsorge-versicherungen' ),
		'sachversicherungen'        => array( 'sachversicherungen' ),
		'versicherungen'            => array( 'versicherungen' ),
	);
}

/** Resolve slugs against the current database; never create or modify terms. */
function trilacheck_comparison_category( $page_slug ) {
	$mapping = trilacheck_comparison_categories();
	foreach ( $mapping[ $page_slug ] ?? array() as $slug ) {
		$term = get_term_by( 'slug', $slug, 'category' );
		if ( $term instanceof WP_Term ) {
			return $term;
		}
	}
	return null;
}

/** Fill the existing footer article slot, once, only for mapped comparisons. */
function trilacheck_landing_articles() {
	static $rendered = false;
	if ( $rendered || ! is_page() || is_front_page() ) {
		return;
	}
	$page = get_queried_object();
	$term = trilacheck_comparison_category( $page->post_name );
	if ( ! $term ) {
		return;
	}
	$rendered = true;
	get_template_part( 'template-parts/home/latest-posts', null, array(
		'category_id' => $term->term_id,
		'title'       => sprintf( __( 'Passende Ratgeber: %s', 'trilacheck' ), $term->name ),
		'section_id'  => 'tc-comparison-posts-title',
	) );
}

/** Reuse the existing card stylesheet on mapped comparison pages. */
function trilacheck_internal_link_assets() {
	if ( ! is_page() || is_front_page() ) {
		return;
	}
	$page = get_queried_object();
	if ( ! isset( trilacheck_comparison_categories()[ $page->post_name ] ) ) {
		return;
	}
	wp_enqueue_style( 'trilacheck-blog', get_template_directory_uri() . '/assets/css/blog.css', array( 'trilacheck-base' ), (string) filemtime( get_template_directory() . '/assets/css/blog.css' ) );
	wp_enqueue_style( 'trilacheck-comparison-trust', get_template_directory_uri() . '/assets/css/comparison-trust.css', array( 'trilacheck-base' ), (string) filemtime( get_template_directory() . '/assets/css/comparison-trust.css' ) );
	wp_enqueue_style( 'trilacheck-comparison-mobile', get_template_directory_uri() . '/assets/css/comparison-mobile.css', array( 'trilacheck-comparison-trust' ), (string) filemtime( get_template_directory() . '/assets/css/comparison-mobile.css' ) );
}
add_action( 'wp_enqueue_scripts', 'trilacheck_internal_link_assets', 20 );

/** Point the existing article sidebar at its most specific matching comparison. */
function trilacheck_article_comparison( $post_id ) {
	$categories = get_the_category( $post_id );
	$slugs      = wp_list_pluck( $categories, 'slug' );
	$aliases    = array( 'internet-mobilfunk' => 'mobilfunk', 'reise-mietwagen' => 'reise', 'konto-finanzen' => 'girokonto' );
	foreach ( $aliases as $category_slug => $page_slug ) {
		if ( in_array( $category_slug, $slugs, true ) ) {
			$slugs[] = $page_slug;
		}
	}
	$targets    = array(
		'gas' => 'Gastarife vergleichen', 'strom' => 'Stromtarife vergleichen',
		'dsl' => 'DSL-Tarife vergleichen', 'handy-mit-vertrag' => 'Handys mit Vertrag vergleichen',
		'auto-fahrzeuge' => 'Kfz-Versicherungen vergleichen',
		'krankenversicherungen' => 'Krankenversicherungen vergleichen',
		'vorsorge-versicherungen' => 'Vorsorge-Versicherungen vergleichen',
		'sachversicherungen' => 'Sachversicherungen vergleichen',
		'mobilfunk' => 'Handytarife vergleichen', 'reise' => 'Reiseangebote vergleichen',
		'mietwagen' => 'Mietwagen vergleichen', 'girokonto' => 'Girokonten vergleichen',
		'versicherungen' => 'Versicherungen vergleichen',
	);
	foreach ( $targets as $slug => $label ) {
		if ( ! in_array( $slug, $slugs, true ) ) {
			continue;
		}
		$page = get_page_by_path( $slug, OBJECT, 'page' );
		if ( $page && 'publish' === $page->post_status ) {
			return array( 'url' => get_permalink( $page ), 'label' => $label );
		}
	}
	return array( 'url' => home_url( '/vergleiche/' ), 'label' => __( 'Alle Vergleiche', 'trilacheck' ) );
}

/** Prioritize phone comparison in the configured quick menu without duplicates. */
function trilacheck_phone_quick_links( $items, $args ) {
	if ( 'quick_links' !== ( $args->theme_location ?? '' ) ) { return $items; }
	$iphone = trilacheck_tariffuxx_phone_entry( 'Apple' );
	$links = array(
		'Handy mit Vertrag' => home_url( '/handy-mit-vertrag/' ),
		'iPhone' => $iphone['url'],
		'eSIM' => home_url( '/mobilfunk/?esim=1#tarifvergleich' ),
		'5 GB' => home_url( '/handytarife-5gb/' ),
		'15 GB' => home_url( '/handytarife-15gb/' ),
		'50 GB' => home_url( '/handytarife-50gb/' ),
		'DSL' => home_url( '/dsl/' ),
	);
	$prefix = '';
	foreach ( $links as $label => $url ) {
		$items = preg_replace( '~<li\b[^>]*>\s*<a\b[^>]*href=[\'"]' . preg_quote( esc_url( $url ), '~' ) . '[\'"][^>]*>.*?</a>\s*</li>~is', '', $items );
		$prefix .= '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
	}
	return $prefix . $items;
}
add_filter( 'wp_nav_menu_items', 'trilacheck_phone_quick_links', 20, 2 );
