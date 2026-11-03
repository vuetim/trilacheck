<?php
/** Direct site searches to comparison pages. @package Trilacheck */
defined( 'ABSPATH' ) || exit;

function trilacheck_search_page_slug( $query ) {
	$query = strtolower( remove_accents( trim( $query ) ) );
	$routes = array(
		'strom' => 'strom(?:vergleich|anbieter|tarife?|preise?|kosten)?|oekostrom|elektrizitaet',
		'gas' => 'gas(?:vergleich|anbieter|tarife?|preise?|kosten)?|erdgas',
		'dsl' => 'dsl|internet(?:vergleich|anbieter|tarife?)?|wlan|wi-?fi|glasfaser|breitband',
		'mobilfunk' => 'mobilfunk|handy(?:tarife?|vergleich)?|sim(?:karte)?|sim-only',
		'reise' => 'reise[n]?|reisevergleich|urlaub|pauschalreise[n]?|ferien',
		'mietwagen' => 'mietwagen|autovermietung|leihwagen|rental',
		'girokonto' => 'girokonto|konto|kontovergleich|bankkonto',
		'versicherungen' => 'versicherung(?:en)?|versicherungsvergleich',
	);
	$matches = array();
	foreach ( $routes as $slug => $terms ) {
		if ( preg_match( '/\b(?:' . $terms . ')\b/u', $query ) ) {
			$matches[] = $slug;
		}
	}
	return 1 === count( $matches ) ? $matches[0] : 'vergleiche';
}

function trilacheck_route_site_search() {
	if ( is_admin() || is_feed() || is_preview() || ! is_search() ) {
		return;
	}
	$slug = trilacheck_search_page_slug( get_search_query( false ) );
	$page = get_page_by_path( $slug );
	$url = $page && 'publish' === $page->post_status
		? get_permalink( $page )
		: home_url( '/vergleiche/' );
	if ( wp_safe_redirect( $url, 302, 'Trilacheck Search' ) ) {
		exit;
	}
}
add_action( 'template_redirect', 'trilacheck_route_site_search' );
