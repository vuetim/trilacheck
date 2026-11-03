<?php
/**
 * Fill verified metadata gaps through Yoast without duplicating its output.
 *
 * @package Trilacheck
 */

defined( 'ABSPATH' ) || exit;

/** Preserve all existing descriptions; provide defaults only where absent. */
function trilacheck_missing_seo_description( $description ) {
	if ( '' !== trim( (string) $description ) ) {
		return $description;
	}
	if ( is_singular() ) {
		$page = get_queried_object();
		$defaults = array(
			'cookies' => 'Informationen zu Cookies und ähnlichen Technologien auf TrilaCheck.de. Erfahre, wie du deine Cookie-Einstellungen verwalten kannst.',
			'vertrag-kuendigen' => 'Verträge kündigen: Hinweise zu Laufzeiten, Fristen und Kündigungswegen. Prüfe vor dem Anbieterwechsel die Bedingungen deines Vertrags.',
			'gasvergleich-2026-worauf-sollte-man-beim-gastarif-achten' => 'Gastarife vergleichen: Arbeitspreis, Grundpreis, Preisgarantie und Bonusbedingungen prüfen. Ratgeber zum Gasvergleich und Anbieterwechsel.',
		);
		return $defaults[ $page->post_name ?? '' ] ?? $description;
	}
	if ( is_category( 'auto-fahrzeuge' ) ) {
		return 'Ratgeber rund um Auto und Fahrzeuge: Reifen, Öl, Bremsen und Kfz-Versicherungen. Tipps lesen und passende Vergleiche auf TrilaCheck.de finden.';
	}
	return $description;
}
add_filter( 'wpseo_metadesc', 'trilacheck_missing_seo_description' );
add_filter( 'wpseo_opengraph_desc', 'trilacheck_missing_seo_description' );
add_filter( 'wpseo_twitter_description', 'trilacheck_missing_seo_description' );

/** Empty archives remain accessible, but are not useful search landing pages. */
function trilacheck_is_empty_category_archive() {
	global $wp_query;
	return is_category() && $wp_query instanceof WP_Query && 0 === (int) $wp_query->found_posts;
}

/** Modify Yoast's existing robots tag, preserving other directives. */
function trilacheck_empty_category_robots( $robots ) {
	if ( false === $robots || ! trilacheck_is_empty_category_archive() ) {
		return $robots;
	}
	$directives = array_filter( array_map( 'trim', explode( ',', (string) $robots ) ) );
	$directives = array_diff( $directives, array( 'index' ) );
	if ( ! in_array( 'noindex', $directives, true ) ) {
		$directives[] = 'noindex';
	}
	return implode( ', ', $directives );
}
add_filter( 'wpseo_robots', 'trilacheck_empty_category_robots' );

/** Use WordPress's existing tag when Yoast is not active. */
function trilacheck_empty_category_wp_robots( $robots ) {
	if ( ! defined( 'WPSEO_VERSION' ) && trilacheck_is_empty_category_archive() ) {
		unset( $robots['index'] );
		$robots['noindex'] = true;
	}
	return $robots;
}
add_filter( 'wp_robots', 'trilacheck_empty_category_wp_robots' );

/** Exclude the verified migration-only author profile from public schema. */
function trilacheck_public_author_profiles( $profiles ) {
	if ( ! is_array( $profiles ) ) {
		return $profiles;
	}
	return array_values(
		array_filter(
			$profiles,
			static function ( $url ) {
				return ! is_string( $url ) || 'trilacheck.local' !== strtolower( (string) wp_parse_url( $url, PHP_URL_HOST ) );
			}
		)
	);
}
add_filter( 'wpseo_schema_person_social_profiles', 'trilacheck_public_author_profiles' );

/** Keep the brand while identifying the legal publisher confirmed by its owner. */
function trilacheck_schema_legal_publisher( $organization ) {
	if ( is_array( $organization ) ) {
		$organization['legalName'] = 'TRILA GROUP L.L.C';
	}
	return $organization;
}
add_filter( 'wpseo_schema_organization', 'trilacheck_schema_legal_publisher' );
