<?php
/**
 * Trilacheck theme bootstrap.
 *
 * @package Trilacheck
 */

defined( 'ABSPATH' ) || exit;

define( 'TRILACHECK_VERSION', '0.1.0' );

require_once get_template_directory() . '/includes/home-customizer.php';
require_once get_template_directory() . '/includes/search-routing.php';
require_once get_template_directory() . '/includes/internal-links.php';
require_once get_template_directory() . '/includes/technical-seo.php';

function trilacheck_setup() {
	load_theme_textdomain( 'trilacheck', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 56,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	register_nav_menus(
		array(
			'primary'     => __( 'Hauptmenü', 'trilacheck' ),
			'quick_links' => __( 'Vergleichs-Kategorien', 'trilacheck' ),
			'footer'      => __( 'Footer-Menü', 'trilacheck' ),
			'legal'       => __( 'Rechtliches Menü', 'trilacheck' ),
		)
	);
}
add_action( 'after_setup_theme', 'trilacheck_setup' );

function trilacheck_assets() {
	$theme_uri = get_template_directory_uri();
	$version   = static function ( $relative_path ) {
		$file = get_template_directory() . $relative_path;
		return file_exists( $file ) ? (string) filemtime( $file ) : TRILACHECK_VERSION;
	};

	wp_enqueue_style( 'trilacheck-settings', $theme_uri . '/assets/css/settings.css', array(), $version( '/assets/css/settings.css' ) );
	wp_enqueue_style( 'trilacheck-base', $theme_uri . '/assets/css/base.css', array( 'trilacheck-settings' ), $version( '/assets/css/base.css' ) );
	wp_enqueue_style( 'trilacheck-header', $theme_uri . '/assets/css/header.css', array( 'trilacheck-base' ), $version( '/assets/css/header.css' ) );
	wp_enqueue_style( 'trilacheck-footer', $theme_uri . '/assets/css/footer.css', array( 'trilacheck-base' ), $version( '/assets/css/footer.css' ) );
	wp_enqueue_style( 'trilacheck-style', get_stylesheet_uri(), array( 'trilacheck-header' ), $version( '/style.css' ) );

	wp_enqueue_script( 'trilacheck-header', $theme_uri . '/assets/js/header.js', array(), $version( '/assets/js/header.js' ), true );

	if ( is_front_page() ) {
		wp_enqueue_style( 'trilacheck-home', $theme_uri . '/assets/css/home.css', array( 'trilacheck-base' ), $version( '/assets/css/home.css' ) );
		wp_enqueue_style( 'trilacheck-travel-destinations', $theme_uri . '/assets/css/travel-destinations.css', array( 'trilacheck-base' ), $version( '/assets/css/travel-destinations.css' ) );
		wp_enqueue_style( 'trilacheck-mobile-tariffs', $theme_uri . '/assets/css/mobile-tariffs.css', array( 'trilacheck-base' ), $version( '/assets/css/mobile-tariffs.css' ) );
		wp_enqueue_style( 'trilacheck-phone-contracts', $theme_uri . '/assets/css/phone-contracts.css', array( 'trilacheck-base' ), $version( '/assets/css/phone-contracts.css' ) );
		wp_enqueue_style( 'trilacheck-home-power', $theme_uri . '/assets/css/home-power.css', array( 'trilacheck-base' ), $version( '/assets/css/home-power.css' ) );
		wp_enqueue_style( 'trilacheck-home-gas', $theme_uri . '/assets/css/home-gas.css', array( 'trilacheck-base' ), $version( '/assets/css/home-gas.css' ) );
		wp_enqueue_style( 'trilacheck-home-dsl', $theme_uri . '/assets/css/home-dsl.css', array( 'trilacheck-base' ), $version( '/assets/css/home-dsl.css' ) );
		wp_enqueue_style( 'trilacheck-home-services', $theme_uri . '/assets/css/home-services.css', array( 'trilacheck-base' ), $version( '/assets/css/home-services.css' ) );
		wp_enqueue_style( 'trilacheck-home-insurance', $theme_uri . '/assets/css/home-insurance.css', array( 'trilacheck-base' ), $version( '/assets/css/home-insurance.css' ) );
		wp_enqueue_style( 'trilacheck-blog', $theme_uri . '/assets/css/blog.css', array( 'trilacheck-base' ), $version( '/assets/css/blog.css' ) );
		wp_enqueue_script( 'trilacheck-hero', $theme_uri . '/assets/js/hero.js', array(), $version( '/assets/js/hero.js' ), true );
	}
	if ( is_home() || is_archive() || is_single() || is_search() ) {
		wp_enqueue_style( 'trilacheck-blog', $theme_uri . '/assets/css/blog.css', array( 'trilacheck-base' ), $version( '/assets/css/blog.css' ) );
	}

	if ( is_page( 'reise' ) ) {
		wp_enqueue_style( 'trilacheck-reise', $theme_uri . '/assets/css/reise.css', array( 'trilacheck-base' ), $version( '/assets/css/reise.css' ) );
	}

	if ( is_page( 'mobilfunk' ) ) {
		wp_enqueue_style( 'trilacheck-mobilfunk', $theme_uri . '/assets/css/mobilfunk.css', array( 'trilacheck-base' ), $version( '/assets/css/mobilfunk.css' ) );
	}
	if ( is_page( array( 'handytarife-5gb', 'handytarife-15gb', 'handytarife-50gb', 'handytarife-unlimited', 'tarife-fur-junge-leute', 'prepaid-tarife' ) ) ) {
		wp_enqueue_style( 'trilacheck-mobile-detail', $theme_uri . '/assets/css/mobile-detail.css', array( 'trilacheck-base' ), $version( '/assets/css/mobile-detail.css' ) );
		wp_enqueue_style( 'trilacheck-mobile-detail-colors', $theme_uri . '/assets/css/mobile-detail-colors.css', array( 'trilacheck-mobile-detail' ), $version( '/assets/css/mobile-detail-colors.css' ) );
	}

	if ( is_page( 'handy-mit-vertrag' ) ) {
		wp_enqueue_style( 'trilacheck-handy-vertrag', $theme_uri . '/assets/css/handy-vertrag.css', array( 'trilacheck-base' ), $version( '/assets/css/handy-vertrag.css' ) );
	}

	if ( is_page( array( 'strom', 'oekostrom' ) ) ) {
		wp_enqueue_style( 'trilacheck-strom', $theme_uri . '/assets/css/strom.css', array( 'trilacheck-base' ), $version( '/assets/css/strom.css' ) );
		wp_enqueue_style( 'trilacheck-check24-power-short', 'https://files.check24.net/widgets/power.css', array(), null );
		wp_enqueue_style( 'trilacheck-power-hero-offer', $theme_uri . '/assets/css/power-hero-offer.css', array( 'trilacheck-strom', 'trilacheck-check24-power-short' ), $version( '/assets/css/power-hero-offer.css' ) );
		$power_widget = is_page( 'oekostrom' ) ? '36586' : '63313';
		wp_enqueue_script( 'trilacheck-check24-power-short', 'https://files.check24.net/widgets/262971/c24pp-power-widget' . $power_widget . '/power.js', array(), null, array( 'in_footer' => true, 'strategy' => 'async' ) );
		if ( is_page( 'oekostrom' ) ) {
			wp_enqueue_style( 'trilacheck-oekostrom', $theme_uri . '/assets/css/oekostrom.css', array( 'trilacheck-power-hero-offer' ), $version( '/assets/css/oekostrom.css' ) );
			wp_enqueue_script( 'trilacheck-eco-comparison', 'https://files.check24.net/widgets/auto/262971/c24pp-power-iframe/power-iframe.js', array(), null, true );
		}
	}
	if ( is_page( 'gas' ) ) {
		wp_enqueue_style( 'trilacheck-gas', $theme_uri . '/assets/css/gas.css', array( 'trilacheck-base' ), $version( '/assets/css/gas.css' ) );
		wp_enqueue_style( 'trilacheck-check24-gas-short', 'https://files.check24.net/widgets/gas.css', array(), null );
		wp_enqueue_style( 'trilacheck-power-hero-offer', $theme_uri . '/assets/css/power-hero-offer.css', array( 'trilacheck-gas', 'trilacheck-check24-gas-short' ), $version( '/assets/css/power-hero-offer.css' ) );
		wp_enqueue_style( 'trilacheck-gas-hero-offer', $theme_uri . '/assets/css/gas-hero-offer.css', array( 'trilacheck-power-hero-offer' ), $version( '/assets/css/gas-hero-offer.css' ) );
		wp_enqueue_script( 'trilacheck-check24-gas-short', 'https://files.check24.net/widgets/262971/c24pp-gas-widget95444/gas.js', array(), null, array( 'in_footer' => true, 'strategy' => 'async' ) );
	}
	if ( is_page( 'dsl' ) ) {
		wp_enqueue_style( 'trilacheck-dsl', $theme_uri . '/assets/css/dsl.css', array( 'trilacheck-base' ), $version( '/assets/css/dsl.css' ) );
	}
	if ( is_page( 'mietwagen' ) ) {
		wp_enqueue_style( 'trilacheck-rentalcar', $theme_uri . '/assets/css/rentalcar.css', array( 'trilacheck-base' ), $version( '/assets/css/rentalcar.css' ) );
	}
	if ( is_page( 'girokonto' ) ) {
		wp_enqueue_style( 'trilacheck-giro', $theme_uri . '/assets/css/girokonto.css', array( 'trilacheck-base' ), $version( '/assets/css/girokonto.css' ) );
	}
	if ( is_page( array( 'versicherungen', 'auto-fahrzeuge', 'vorsorge-versicherungen', 'krankenversicherungen', 'sachversicherungen' ) ) ) {
		wp_enqueue_style( 'trilacheck-insurance', $theme_uri . '/assets/css/insurance.css', array( 'trilacheck-base' ), $version( '/assets/css/insurance.css' ) );
		wp_enqueue_style( 'trilacheck-insurance-accordion', $theme_uri . '/assets/css/insurance-accordion.css', array( 'trilacheck-insurance' ), $version( '/assets/css/insurance-accordion.css' ) );
		wp_enqueue_script( 'trilacheck-insurance', $theme_uri . '/assets/js/insurance.js', array(), $version( '/assets/js/insurance.js' ), true );
	}
	if ( is_page( 'versicherungen' ) ) {
		wp_enqueue_style( 'trilacheck-insurance-hub', $theme_uri . '/assets/css/insurance-hub.css', array( 'trilacheck-insurance' ), $version( '/assets/css/insurance-hub.css' ) );
	}
	if ( is_page( 'vorsorge-versicherungen' ) ) {
		wp_enqueue_style( 'trilacheck-provision', $theme_uri . '/assets/css/provision-insurance.css', array( 'trilacheck-base' ), $version( '/assets/css/provision-insurance.css' ) );
		wp_enqueue_style( 'trilacheck-insurance-accordion', $theme_uri . '/assets/css/insurance-accordion.css', array( 'trilacheck-provision' ), $version( '/assets/css/insurance-accordion.css' ) );
		wp_enqueue_script( 'trilacheck-insurance', $theme_uri . '/assets/js/insurance.js', array(), $version( '/assets/js/insurance.js' ), true );
	}
	if ( is_page( 'krankenversicherungen' ) ) {
		wp_enqueue_style( 'trilacheck-health-insurance', $theme_uri . '/assets/css/health-insurance.css', array( 'trilacheck-base' ), $version( '/assets/css/health-insurance.css' ) );
		wp_enqueue_style( 'trilacheck-insurance-accordion', $theme_uri . '/assets/css/insurance-accordion.css', array( 'trilacheck-health-insurance' ), $version( '/assets/css/insurance-accordion.css' ) );
		wp_enqueue_script( 'trilacheck-insurance', $theme_uri . '/assets/js/insurance.js', array(), $version( '/assets/js/insurance.js' ), true );
	}
	if ( is_page( 'sachversicherungen' ) ) {
		wp_enqueue_style( 'trilacheck-property-insurance', $theme_uri . '/assets/css/property-insurance.css', array( 'trilacheck-base' ), $version( '/assets/css/property-insurance.css' ) );
		wp_enqueue_style( 'trilacheck-insurance-accordion', $theme_uri . '/assets/css/insurance-accordion.css', array( 'trilacheck-property-insurance' ), $version( '/assets/css/insurance-accordion.css' ) );
		wp_enqueue_script( 'trilacheck-insurance', $theme_uri . '/assets/js/insurance.js', array(), $version( '/assets/js/insurance.js' ), true );
	}
	if ( is_page_template( 'page-legal.php' ) || is_page( array( 'impressum', 'datenschutz', 'agb', 'cookies', 'vertrag-kuendigen' ) ) ) {
		wp_enqueue_style( 'trilacheck-legal', $theme_uri . '/assets/css/legal.css', array( 'trilacheck-base' ), $version( '/assets/css/legal.css' ) );
	}
	if ( is_page( 'vergleiche' ) ) {
		wp_enqueue_style( 'trilacheck-comparisons-hub', $theme_uri . '/assets/css/comparisons-hub.css', array( 'trilacheck-base' ), $version( '/assets/css/comparisons-hub.css' ) );
	}
}
add_action( 'wp_enqueue_scripts', 'trilacheck_assets' );

function trilacheck_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		return array_values(
			array_filter(
				$urls,
				static function ( $url ) {
					return false === strpos( (string) $url, 'fonts.googleapis.com' ) && false === strpos( (string) $url, 'fonts.gstatic.com' );
				}
			)
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'trilacheck_resource_hints', 10, 2 );

function trilacheck_page_slug_body_class( $classes ) {
	if ( is_page() ) {
		$page = get_queried_object();
		if ( $page instanceof WP_Post ) {
			$classes[] = 'page-' . sanitize_html_class( $page->post_name );
		}
	}
	return $classes;
}
add_filter( 'body_class', 'trilacheck_page_slug_body_class' );

function trilacheck_mobile_detail_template( $template ) {
	if ( is_page( array( 'handytarife-5gb', 'handytarife-15gb', 'handytarife-50gb', 'handytarife-unlimited', 'tarife-fur-junge-leute', 'prepaid-tarife' ) ) ) {
		$custom_template = get_template_directory() . '/page-mobile-detail.php';
		return file_exists( $custom_template ) ? $custom_template : $template;
	}
	return $template;
}
add_filter( 'template_include', 'trilacheck_mobile_detail_template' );

function trilacheck_menu_fallback() {
	$links = array(
		__( 'Strom', 'trilacheck' )          => '/strom/',
		__( 'Ökostrom', 'trilacheck' )       => '/oekostrom/',
		__( 'Gas', 'trilacheck' )            => '/gas/',
		__( 'Versicherungen', 'trilacheck' ) => '/versicherungen/',
		__( 'DSL', 'trilacheck' )            => '/dsl/',
		__( 'Handytarife', 'trilacheck' )    => '/mobilfunk/',
		__( 'Reisen', 'trilacheck' )         => '/reise/',
		__( 'Mietwagen', 'trilacheck' )      => '/mietwagen/',
		__( 'Konto', 'trilacheck' )          => '/girokonto/',
	);

	echo '<ul class="tc-quick-menu">';
	foreach ( $links as $label => $path ) {
		$active = is_page( trim( $path, '/' ) );
		printf(
			'<li%1$s><a href="%2$s"%3$s>%4$s</a></li>',
			$active ? ' class="current-menu-item"' : '',
			esc_url( home_url( $path ) ),
			$active ? ' aria-current="page"' : '',
			esc_html( $label )
		);
	}
	echo '</ul>';
}

function trilacheck_primary_menu_fallback() {
	$groups = array(
		__( 'Energie', 'trilacheck' ) => array( 'Strom'=>'/strom/', 'Ökostrom'=>'/oekostrom/', 'Gas'=>'/gas/' ),
		__( 'Internet & Mobilfunk', 'trilacheck' ) => array( 'DSL'=>'/dsl/', 'Alle Handytarife'=>'/mobilfunk/', '5 GB Tarife'=>'/handytarife-5gb/', '15 GB Tarife'=>'/handytarife-15gb/', '50 GB Tarife'=>'/handytarife-50gb/', 'Unlimited Tarife'=>'/handytarife-unlimited/', 'Tarife für junge Leute'=>'/tarife-fur-junge-leute/', 'Prepaid-Tarife'=>'/prepaid-tarife/', 'Handy mit Vertrag'=>'/handy-mit-vertrag/' ),
		__( 'Reisen & Mobilität', 'trilacheck' ) => array( 'Reisen'=>'/reise/', 'Mietwagen'=>'/mietwagen/' ),
		__( 'Finanzen', 'trilacheck' ) => array( 'Girokonto'=>'/girokonto/' ),
		__( 'Versicherungen', 'trilacheck' ) => array( 'Alle Versicherungen'=>'/versicherungen/', 'Auto & Fahrzeuge'=>'/auto-fahrzeuge/', 'Vorsorge-Versicherungen'=>'/vorsorge-versicherungen/', 'Krankenversicherungen'=>'/krankenversicherungen/', 'Sachversicherungen'=>'/sachversicherungen/' ),
	);
	echo '<ul class="tc-primary-menu">';
	echo '<li><a href="' . esc_url( home_url( '/vergleiche/' ) ) . '">' . esc_html__( 'Alle Vergleiche', 'trilacheck' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/blog/' ) ) . '">' . esc_html__( 'Ratgeber & Blog', 'trilacheck' ) . '</a></li>';
	foreach ( $groups as $group => $links ) {
		echo '<li class="menu-item-has-children"><a href="' . esc_url( home_url( '/vergleiche/' ) ) . '">' . esc_html( $group ) . '</a><ul class="sub-menu">';
		foreach ( $links as $label => $path ) echo '<li><a href="' . esc_url( home_url( $path ) ) . '">' . esc_html( $label ) . '</a></li>';
		echo '</ul></li>';
	}
	echo '</ul>';
}

add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );

add_filter( 'comments_array', '__return_empty_array', 10, 2 );
