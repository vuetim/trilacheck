<?php
/**
 * Server-side TARIFFUXX product comparison. Credentials belong in wp-config.php.
 *
 * @package Trilacheck
 */

defined( 'ABSPATH' ) || exit;

function trilacheck_tariffuxx_enabled() {
	return 'legacy' !== get_option( 'trilacheck_phone_comparison', 'api' );
}

add_action( 'admin_init', function () {
	register_setting( 'reading', 'trilacheck_tariffuxx_public_key', array(
		'type' => 'string',
		'sanitize_callback' => function ( $value ) {
			$value = trim( (string) $value );
			return preg_match( '/^[a-f0-9]{40}$/i', $value ) ? $value : get_option( 'trilacheck_tariffuxx_public_key', '' );
		},
	) );
	add_settings_field( 'trilacheck_tariffuxx_public_key', 'TARIFFUXX Products API', function () {
		?><input type="password" name="trilacheck_tariffuxx_public_key" value="" autocomplete="new-password" class="regular-text"><p class="description">Public Key eintragen. Leer lassen, um den gespeicherten Schlüssel beizubehalten. Kein Private Key erforderlich. Alternativ TRILACHECK_TARIFFUXX_PUBLIC_KEY in wp-config.php setzen.</p><?php
	}, 'reading' );
	register_setting( 'reading', 'trilacheck_phone_comparison', array(
		'type' => 'string',
		'sanitize_callback' => function ( $value ) { return 'legacy' === $value ? 'legacy' : 'api'; },
		'default' => 'api',
	) );
	add_settings_field( 'trilacheck_phone_comparison', 'Handy-Vergleich', function () {
		$value = get_option( 'trilacheck_phone_comparison', 'api' );
		?><select name="trilacheck_phone_comparison"><option value="api" <?php selected( $value, 'api' ); ?>>Trilacheck / TARIFFUXX API</option><option value="legacy" <?php selected( $value, 'legacy' ); ?>>Bisheriges TARIFFUXX Widget</option></select><?php
	}, 'reading' );
} );

add_action( 'wp_enqueue_scripts', function () {
	if ( is_page( 'handy-mit-vertrag' ) && trilacheck_tariffuxx_enabled() ) {
		wp_enqueue_style( 'trilacheck-phone-api', get_template_directory_uri() . '/assets/css/phone-api.css', array( 'trilacheck-base' ), filemtime( get_template_directory() . '/assets/css/phone-api.css' ) );
	}
} );

/** Fixed upstream; credentials never leave the server in rendered output. */
function trilacheck_tariffuxx_request( $endpoint, $params ) {
	$key = defined( 'TRILACHECK_TARIFFUXX_PUBLIC_KEY' ) ? TRILACHECK_TARIFFUXX_PUBLIC_KEY : ( getenv( 'TRILACHECK_TARIFFUXX_PUBLIC_KEY' ) ?: get_option( 'trilacheck_tariffuxx_public_key', '' ) );
	if ( ! $key ) {
		return new WP_Error( 'tx_config', 'API nicht eingerichtet.' );
	}
	$cache_key = 'tc_tx_' . md5( $endpoint . wp_json_encode( $params ) . $key );
	$cached = get_transient( $cache_key );
	if ( false !== $cached ) {
		return $cached;
	}
	$params['v']   = '2.2';
	$params['key'] = $key;
	$response = wp_remote_get( 'https://www.tariffuxx.de/api/products/' . $endpoint . '.json?' . http_build_query( $params, '', '&', PHP_QUERY_RFC3986 ), array( 'timeout' => 'get-by-params' === $endpoint ? 45 : 20, 'redirection' => 0, 'limit_response_size' => 32 * MB_IN_BYTES ) );
	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
		return new WP_Error( 'tx_unavailable', 'Angebote momentan nicht erreichbar.' );
	}
	$data = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( ! is_array( $data ) || ! isset( $data['products'] ) || ! is_array( $data['products'] ) ) {
		return new WP_Error( 'tx_response', 'Angebote momentan nicht erreichbar.' );
	}
	if ( 'get-by-params' === $endpoint ) {
		// Store only model metadata; the full upstream catalogue is several MB.
		$models = array();
		foreach ( $data['products'] as $product ) {
			foreach ( (array) ( $product['product_hardware_items'] ?? array() ) as $device ) {
				$model = sanitize_title( trim( ( $device['brand'] ?? '' ) . ' ' . ( $device['model'] ?? '' ) ) );
				if ( $model ) {
					$models[ $model ] = array( 'brand_modal_identifier' => $model, 'name' => trim( ( $device['brand'] ?? '' ) . ' ' . ( $device['model'] ?? '' ) ) );
				}
			}
		}
		$data['products'] = array( array( 'product_hardware_items' => array_values( $models ) ) );
	}
	set_transient( $cache_key, $data['products'], 'get-by-params' === $endpoint ? HOUR_IN_SECONDS : 5 * MINUTE_IN_SECONDS );
	return $data['products'];
}

function trilacheck_tariffuxx_text( $value ) {
	return wp_strip_all_tags( html_entity_decode( (string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8' ) );
}

/** Use only tracked links issued for our partner account. Never use real_link. */
function trilacheck_tariffuxx_link( $link ) {
	$parts = wp_parse_url( html_entity_decode( (string) $link, ENT_QUOTES, 'UTF-8' ) );
	if ( ! is_array( $parts ) || 'https' !== ( $parts['scheme'] ?? '' ) || ! in_array( strtolower( $parts['host'] ?? '' ), array( 'www.tariffuxx.de', 'tariffuxx.de' ), true ) ) {
		return '';
	}
	parse_str( $parts['query'] ?? '', $query );
	return '1111811' === (string) ( $query['r'] ?? '' ) ? $link : '';
}

function trilacheck_tariffuxx_money( $value ) {
	return number_format_i18n( (float) $value, 2 ) . ' €';
}

/** Accept singleton objects as well as arrays from upstream versions. */
function trilacheck_tariffuxx_charges( $charges ) {
	if ( ! is_array( $charges ) ) {
		return array();
	}
	return isset( $charges['description'] ) ? array( $charges ) : $charges;
}

/** Fetch the large model catalogue in the background, never during a page view. */
add_action( 'trilacheck_tariffuxx_sync_models', function () {
	$products = trilacheck_tariffuxx_request( 'get-by-params', array( 'type' => 1, 'is_bundle_data_only' => 1 ) );
	if ( ! is_wp_error( $products ) ) {
		update_option( 'trilacheck_tariffuxx_models', $products, false );
	}
} );

function trilacheck_tariffuxx_models( $offers ) {
	if ( ! wp_next_scheduled( 'trilacheck_tariffuxx_sync_models' ) ) {
		wp_schedule_event( time() + 10, 'hourly', 'trilacheck_tariffuxx_sync_models' );
	}
	$models = array();
	foreach ( get_option( 'trilacheck_tariffuxx_models', array() ) as $product ) {
		foreach ( (array) ( $product['product_hardware_items'] ?? array() ) as $device ) {
			$models[ $device['brand_modal_identifier'] ] = trilacheck_tariffuxx_text( $device['name'] );
		}
	}
	foreach ( is_array( $offers ) ? $offers : array() as $offer ) {
		$device = $offer['product_hardware_items'] ?? array();
		if ( isset( $device[0] ) ) {
			$device = $device[0];
		}
		if ( ! empty( $device['brand_modal_identifier'] ) ) {
			$models[ $device['brand_modal_identifier'] ] = trilacheck_tariffuxx_text( trim( ( $device['brand'] ?? '' ) . ' ' . ( $device['model'] ?? '' ) ) );
		}
	}
	asort( $models, SORT_NATURAL | SORT_FLAG_CASE );
	return $models;
}
