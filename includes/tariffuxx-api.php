<?php
/**
 * Server-side TARIFFUXX product comparison. Credentials belong in wp-config.php.
 *
 * @package Trilacheck
 */

defined( 'ABSPATH' ) || exit;

function trilacheck_tariffuxx_enabled( $mode = 'phone' ) {
	return 'legacy' !== get_option( 'sim' === $mode ? 'trilacheck_mobile_comparison' : 'trilacheck_phone_comparison', 'api' );
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
		?><input type="password" name="trilacheck_tariffuxx_public_key" value="" autocomplete="new-password" class="regular-text"><p class="description">Public Key eintragen. Leer lassen, um den gespeicherten Schlüssel beizubehalten. Kein Private Key erforderlich. Alternativ TRILACHECK_TARIFFUXX_PUBLIC_KEY in wp-config.php setzen.</p><p><strong><?php echo trilacheck_tariffuxx_key() ? 'API-Schlüssel vorhanden.' : 'API-Schlüssel fehlt: Ohne Schlüssel wird der bisherige Vergleich verwendet.'; ?></strong></p><?php
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
	register_setting( 'reading', 'trilacheck_mobile_comparison', array(
		'type' => 'string',
		'sanitize_callback' => function ( $value ) { return 'legacy' === $value ? 'legacy' : 'api'; },
		'default' => 'api',
	) );
	add_settings_field( 'trilacheck_mobile_comparison', 'Mobilfunk / Nur SIM', function () {
		$value = get_option( 'trilacheck_mobile_comparison', 'api' );
		?><select name="trilacheck_mobile_comparison"><option value="api" <?php selected( $value, 'api' ); ?>>Trilacheck / TARIFFUXX API</option><option value="legacy" <?php selected( $value, 'legacy' ); ?>>Bisheriger CHECK24-Vergleich</option></select><?php
	}, 'reading' );
} );

/** Keep the existing CHECK24 calculators for these two specialist pages. */
function trilacheck_tariffuxx_topic_enabled( $preset ) {
	return ! in_array( $preset, array( 'unlimited', 'young' ), true ) && trilacheck_tariffuxx_enabled( 'sim' );
}

function trilacheck_tariffuxx_key() {
	return defined( 'TRILACHECK_TARIFFUXX_PUBLIC_KEY' ) ? TRILACHECK_TARIFFUXX_PUBLIC_KEY : ( getenv( 'TRILACHECK_TARIFFUXX_PUBLIC_KEY' ) ?: get_option( 'trilacheck_tariffuxx_public_key', '' ) );
}

/** One comparison per article, using the same validated affiliate links and cache. */
function trilacheck_mobile_deals_shortcode() {
	static $rendered = false;
	if ( $rendered ) { return ''; }
	$rendered = true;
	ob_start();
	echo '<div id="tarifvergleich" class="tc-mobile-deals">';
	get_template_part( 'template-parts/phone-api-comparison', null, array( 'mode' => 'sim', 'preset' => 'deals', 'special_offers' => true ) );
	echo '</div>';
	return ob_get_clean();
}
add_shortcode( 'trilacheck_mobile_deals', 'trilacheck_mobile_deals_shortcode' );

add_action( 'wp_enqueue_scripts', function () {
	$is_detail = is_page( array( 'handytarife-5gb', 'handytarife-15gb', 'handytarife-50gb', 'handytarife-unlimited', 'tarife-fur-junge-leute', 'prepaid-tarife' ) );
	$uses_api = ( is_page( 'handy-mit-vertrag' ) && trilacheck_tariffuxx_enabled() ) || ( is_page( array( 'mobilfunk', 'handytarife-5gb', 'handytarife-15gb', 'handytarife-50gb', 'prepaid-tarife' ) ) && trilacheck_tariffuxx_enabled( 'sim' ) );
	$post = get_queried_object();
	$uses_api = $uses_api || ( is_singular() && has_shortcode( $post->post_content ?? '', 'trilacheck_mobile_deals' ) );
	if ( $is_detail || $uses_api ) {
		wp_enqueue_style( 'trilacheck-phone-api', get_template_directory_uri() . '/assets/css/phone-api.css', array( 'trilacheck-base' ), filemtime( get_template_directory() . '/assets/css/phone-api.css' ) );
	}
	if ( $uses_api ) {
		wp_enqueue_script( 'trilacheck-phone-api', get_template_directory_uri() . '/assets/js/phone-api.js', array(), filemtime( get_template_directory() . '/assets/js/phone-api.js' ), true );
	}
} );

/** Fixed upstream; credentials never leave the server in rendered output. */
function trilacheck_tariffuxx_request( $endpoint, $params ) {
	$key = trilacheck_tariffuxx_key();
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
		return new WP_Error( 'tx_unavailable', 'Angebote momentan nicht erreichbar.', array( 'status' => wp_remote_retrieve_response_code( $response ) ) );
	}
	$data = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( ! is_array( $data ) || ! isset( $data['products'] ) || ! is_array( $data['products'] ) ) {
		return new WP_Error( 'tx_response', 'Angebote momentan nicht erreichbar.' );
	}
	if ( 'get-by-params' === $endpoint && empty( $params['is_bundle_data_only'] ) ) {
		// SIM master data: retain only the metadata needed for topic-specific filters.
		$data['products'] = array_map( static function ( $product ) {
			return array( 'product_id' => $product['id'] ?? $product['product_id'] ?? 0, 'restricted_customer_group_code' => $product['restricted_customer_group_code'] ?? '', 'internet_data_volume' => $product['internet_data_volume'] ?? '' );
		}, $data['products'] );
	} elseif ( 'get-by-params' === $endpoint ) {
		// Store only model metadata; the full upstream catalogue is several MB.
		$models = array();
		foreach ( $data['products'] as $product ) {
			foreach ( (array) ( $product['product_hardware_items'] ?? array() ) as $device ) {
				$model = sanitize_title( trim( ( $device['brand'] ?? '' ) . ' ' . ( $device['model'] ?? '' ) ) );
				if ( $model ) {
					$models[ $model ] = array( 'brand_modal_identifier' => $model, 'name' => trim( ( $device['brand'] ?? '' ) . ' ' . ( $device['model'] ?? '' ) ), 'brand' => $device['brand'] ?? '', 'model' => $device['model'] ?? '', 'image' => $device['images'][0]['file_uri'] ?? '' );
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
	$link  = html_entity_decode( (string) $link, ENT_QUOTES, 'UTF-8' );
	$parts = wp_parse_url( $link );
	if ( ! is_array( $parts ) || 'https' !== ( $parts['scheme'] ?? '' ) || ! in_array( strtolower( $parts['host'] ?? '' ), array( 'www.tariffuxx.de', 'tariffuxx.de' ), true ) ) {
		return '';
	}
	parse_str( $parts['query'] ?? '', $query );
	if ( isset( $parts['user'] ) || isset( $parts['pass'] ) || ! is_string( $query['r'] ?? null ) || 1 !== preg_match_all( '/(?:^|&)r=/', $parts['query'] ?? '' ) ) {
		return '';
	}
	return '1111811' === $query['r'] ? $link : '';
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
	$catalogue = trilacheck_tariffuxx_devices( $offers );
	$models = array();
	foreach ( $catalogue as $slug => $device ) {
		$models[ $slug ] = $device['name'];
	}
	return $models;
}

/** Normalized device metadata, with offers as a cold-cache fallback. */
function trilacheck_tariffuxx_devices( $offers = array() ) {
	if ( ! wp_next_scheduled( 'trilacheck_tariffuxx_sync_models' ) ) {
		wp_schedule_event( time() + 10, 'hourly', 'trilacheck_tariffuxx_sync_models' );
	}
	$models = array();
	foreach ( get_option( 'trilacheck_tariffuxx_models', array() ) as $product ) {
		foreach ( (array) ( $product['product_hardware_items'] ?? array() ) as $device ) {
			$slug = $device['brand_modal_identifier'] ?? '';
			if ( $slug ) {
				$models[ $slug ] = array(
					'name' => trilacheck_tariffuxx_text( $device['name'] ?? $slug ),
					'brand' => trilacheck_tariffuxx_text( $device['brand'] ?? ucfirst( strtok( $slug, '-' ) ) ),
					'image' => $device['image'] ?? '',
				);
			}
		}
	}
	foreach ( is_array( $offers ) ? $offers : array() as $offer ) {
		$device = $offer['product_hardware_items'] ?? array();
		if ( isset( $device[0] ) ) {
			$device = $device[0];
		}
		if ( ! empty( $device['brand_modal_identifier'] ) ) {
			$models[ $device['brand_modal_identifier'] ] = array( 'name' => trilacheck_tariffuxx_text( trim( ( $device['brand'] ?? '' ) . ' ' . ( $device['model'] ?? '' ) ) ), 'brand' => trilacheck_tariffuxx_text( $device['brand'] ?? '' ), 'image' => trilacheck_tariffuxx_image( $device ) );
		}
	}
	uasort( $models, function ( $a, $b ) { return strnatcasecmp( $a['name'], $b['name'] ); } );
	return $models;
}

function trilacheck_tariffuxx_image( $device ) {
	if ( empty( $device['product_images'][0]['file_name'] ) ) {
		return '';
	}
	return 'https://assets.tariffuxx.de/img/hardware/' . rawurlencode( strtolower( str_replace( ' ', '-', $device['brand'] ?? '' ) ) ) . '/' . rawurlencode( strtolower( str_replace( ' ', '-', $device['model'] ?? '' ) ) ) . '/' . rawurlencode( $device['product_images'][0]['file_name'] ) . '.png';
}

/** Shared validation for display and comparison: no untracked offer is buyable. */
function trilacheck_tariffuxx_offer( $offer, $mode = 'phone' ) {
	$link = trilacheck_tariffuxx_link( $offer['product_link'] ?? '' );
	$device = $offer['product_hardware_items'] ?? array();
	if ( isset( $device[0] ) ) {
		$device = $device[0];
	}
	if ( ! $link || ( 'phone' === $mode && empty( $device ) ) || ! is_numeric( $offer['effective_product_charges'] ?? null ) || ! is_numeric( $offer['total_product_charges'] ?? null ) ) {
		return false;
	}
	$one_time = trilacheck_tariffuxx_charges( $offer['one_time_product_charges'] ?? array() );
	$recurring = trilacheck_tariffuxx_charges( $offer['recurring_product_charges'] ?? array() );
	$device_price = null;
	$extra_price = 0;
	foreach ( $one_time as $charge ) {
		if ( ! is_numeric( $charge['value'] ?? null ) ) {
			continue;
		}
		if ( preg_match( '/Gerätepreis|Gerätezuzahlung|Anzahlung/ui', $charge['description'] ?? '' ) ) {
			$device_price = ( $device_price ?? 0 ) + (float) $charge['value'];
		} else {
			$extra_price += (float) $charge['value'];
		}
	}
	return array(
		'kind' => $mode,
		'link' => $link,
		'phone' => trilacheck_tariffuxx_text( 'sim' === $mode ? ( $offer['name'] ?? 'Mobilfunktarif' ) : ( $device['description'] ?? $device['model'] ?? 'Smartphone' ) ),
		'image' => 'sim' === $mode ? ( empty( $offer['provider']['logo'] ) ? '' : 'https://assets.tariffuxx.de/img/providers/' . rawurlencode( $offer['provider']['logo'] ) ) : trilacheck_tariffuxx_image( $device ),
		'provider' => trilacheck_tariffuxx_text( $offer['provider']['name'] ?? '' ),
		'network' => trilacheck_tariffuxx_text( $offer['mobile_network_name'] ?? '' ),
		'network_code' => sanitize_title( $offer['network_code'] ?? '' ),
		'tariff' => trilacheck_tariffuxx_text( $offer['name'] ?? '' ),
		'data' => trilacheck_tariffuxx_text( $offer['internet_data_volume'] ?? '' ),
		'term' => trilacheck_tariffuxx_text( $offer['contract_period_text'] ?? '' ),
		'five_g' => ! empty( $offer['is_5g'] ),
		'esim' => ! empty( $offer['is_esim'] ),
		'monthly' => isset( $recurring[0]['value'] ) && is_numeric( $recurring[0]['value'] ) ? trilacheck_tariffuxx_money( $recurring[0]['value'] ) : 'Siehe Details',
		'billing' => trilacheck_tariffuxx_text( $recurring[0]['period_description'] ?? '' ),
		'phases' => count( $recurring ) > 1,
		'device_price' => null !== $device_price ? trilacheck_tariffuxx_money( $device_price ) : 'Siehe Details',
		'extra_price' => trilacheck_tariffuxx_money( $extra_price ),
		'average' => trilacheck_tariffuxx_money( $offer['effective_product_charges'] ),
		'total' => trilacheck_tariffuxx_money( $offer['total_product_charges'] ),
	);
}

/** Small, theme-native SVG icons; no font icons or external icon libraries. */
function trilacheck_tariffuxx_icon( $name ) {
	$paths = array(
		'filter' => '<path d="M4 7h16M4 17h16"/><circle cx="9" cy="7" r="2" fill="white"/><circle cx="15" cy="17" r="2" fill="white"/>',
		'chevron' => '<path d="m6 9 6 6 6-6"/>',
		'sort' => '<path d="M8 4v16m-4-4 4 4 4-4M16 20V4m-4 4 4-4 4 4"/>',
		'shield' => '<path d="m12 3 8 3v6c0 4-4 7-8 9-4-2-8-5-8-9V6l8-3Z"/><path d="m8 12 3 3 5-6"/>',
		'star' => '<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.6l6.2-.9L12 3Z"/>',
		'sim' => '<path d="M7 3h7l5 5v11a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/><rect x="8" y="10" width="8" height="7" rx="1"/><path d="M12 10v7M8 13.5h8"/>',
		'phone' => '<rect x="6" y="2" width="12" height="20" rx="3"/><path d="M10 5h4M11 19h2"/>',
		'arrow' => '<path d="M4 12h16m-6-6 6 6-6 6"/>',
		'info' => '<circle cx="12" cy="12" r="9"/><path d="M12 11v6M12 7h.01"/>',
	);
	return '<svg class="tc-tariff-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . ( $paths[ $name ] ?? $paths['info'] ) . '</svg>';
}

/** Link to an actual catalogue model, with a brand filter when the cache is cold. */
function trilacheck_tariffuxx_phone_entry( $brand ) {
	$devices = array_filter( trilacheck_tariffuxx_devices(), static function ( $device ) use ( $brand ) { return strtolower( $device['brand'] ) === strtolower( $brand ); } );
	// Prefer the numbered flagship families, not alphabetically later SE/A/Xcover models.
	$families = array( 'apple' => '/iphone[ -]+[0-9]+/i', 'samsung' => '/galaxy[ -]+s[0-9]+/i', 'google' => '/pixel[ -]+[0-9]+/i' );
	$family = $families[ strtolower( $brand ) ] ?? '';
	$flagships = $family ? array_filter( $devices, static function ( $device ) use ( $family ) { return preg_match( $family, $device['name'] ); } ) : array();
	if ( $flagships ) { $devices = $flagships; }
	uksort( $devices, 'strnatcasecmp' );
	$devices = array_reverse( $devices, true );
	$slug = key( $devices );
	$device = $slug ? $devices[ $slug ] : null;
	$query = $slug ? array( 'telefon' => $slug ) : array( 'hersteller' => sanitize_title( $brand ) );
	return array( 'url' => add_query_arg( $query, home_url( '/handy-mit-vertrag/' ) ) . '#tarifvergleich', 'name' => $device ? $device['name'] : '', 'image' => $device ? $device['image'] : '' );
}

/** Customer benefits, not publisher commissions; never subtract these twice. */
function trilacheck_tariffuxx_benefits( $offer ) {
	$benefits = array();
	$has_cashback = false;
	foreach ( trilacheck_tariffuxx_charges( $offer['bonus_product_charges'] ?? array() ) as $charge ) {
		if ( ! is_numeric( $charge['value'] ?? null ) || (float) $charge['value'] <= 0 ) { continue; }
		$label = trilacheck_tariffuxx_text( $charge['description'] ?? 'Bonus' );
		$info = trilacheck_tariffuxx_text( $charge['info'] ?? '' );
		$has_cashback = $has_cashback || (bool) preg_match( '/cashback/iu', $label );
		if ( ! $info ) {
			$info = preg_match( '/wechsel|portier|rufnummer/iu', $label ) ? 'Die Voraussetzungen für den Wechselbonus, mögliche Rufnummernmitnahme und Fristen im Angebot prüfen.' : 'Prüfe im Angebot, wann der Vorteil gutgeschrieben wird und welche Voraussetzungen dafür gelten.';
		}
		$benefits[] = array( 'label' => $label, 'amount' => trilacheck_tariffuxx_money( $charge['value'] ), 'info' => $info );
	}
	if ( ! $has_cashback && is_numeric( $offer['cashback_value'] ?? null ) && (float) $offer['cashback_value'] > 0 ) {
		$benefits[] = array( 'label' => 'Cashback', 'amount' => trilacheck_tariffuxx_money( $offer['cashback_value'] ), 'info' => 'Cashback gemäß Angebotsbedingungen. Prüfe Antrag, Nachweise und Fristen beim Abschluss. Im berechneten Durchschnitt bereits berücksichtigt.' );
	}
	return $benefits;
}

/** Render only specifications supplied by the API; missing does not mean "Nein". */
function trilacheck_tariffuxx_specifications( $offer ) {
	$groups = array();
	$add = static function ( $group, $label, $key, $unit = '' ) use ( &$groups, $offer ) {
		if ( ! array_key_exists( $key, $offer ) || null === $offer[ $key ] || '' === $offer[ $key ] || ! is_scalar( $offer[ $key ] ) ) { return; }
		$value = is_bool( $offer[ $key ] ) ? ( $offer[ $key ] ? 'Ja' : 'Nein' ) : trilacheck_tariffuxx_text( $offer[ $key ] ) . $unit;
		$groups[ $group ][ $label ] = $value;
	};
	foreach ( array( 'Tarifart' => 'payment_text', 'Mindestlaufzeit' => 'contract_period_text', 'Kündigungsfrist' => 'termination_period_text', 'Vertragsverlängerung' => 'extension_period_text', 'Mobilfunknetz' => 'mobile_network_name', 'Netztechnologie' => 'best_network_technology' ) as $label => $key ) { $add( 'Vertrag & Netz', $label, $key ); }
	foreach ( array( 'Datenvolumen' => 'internet_data_volume', 'Telefon-Flat in alle deutschen Netze' => 'is_phone_allnet_flat', 'SMS-Flat' => 'is_sms_allnet_flat', 'Datenautomatik' => 'is_data_automatic_fixed' ) as $label => $key ) { $add( 'Internet, Telefonie & SMS', $label, $key ); }
	$add( 'Internet, Telefonie & SMS', 'Download maximal', 'download_speed_mbits', ' Mbit/s' );
	$add( 'Internet, Telefonie & SMS', 'Upload maximal', 'upload_speed_mbits', ' Mbit/s' );
	$add( 'Internet, Telefonie & SMS', 'Nach Drosselung maximal', 'download_throttle_speed_kbits', ' kbit/s' );
	foreach ( array( 'SIM-Formate' => 'sim_card_text', 'eSIM verfügbar' => 'is_esim', 'Bestellung' => 'sim_card_ordering_text', 'Versand' => 'sim_card_delivery_text', 'Bereitstellung' => 'sim_card_delivery_time_text', 'Rufnummernmitnahme möglich' => 'is_mnp', 'Hinweis zur Rufnummernmitnahme' => 'mnp_info_text' ) as $label => $key ) { $add( 'SIM & Rufnummer', $label, $key ); }
	foreach ( array( 'EU-Roaming inklusive' => 'is_eu_roaming_incl', 'Datenvolumen im EU-Ausland' => 'eu_roaming_data_volume', 'VoLTE' => 'is_volte_incl', 'Wi-Fi Calling' => 'is_wifi_calling_incl', 'Hotspot / Tethering' => 'is_tethering_incl', 'Multi-SIM verfügbar' => 'is_multi_sim' ) as $label => $key ) { $add( 'Ausland & Funktionen', $label, $key ); }
	foreach ( array( 'Zielgruppe' => 'restricted_customer_group_info', 'Voraussetzungen' => 'restricted_customer_group_footnote', 'Rufnummernmitnahme' => 'restricted_mnp_providers_text', 'Unlimited on Demand' => 'unlimited_on_demand_info', 'EU-Roaming' => 'eu_roaming_data_volume_footnote', 'Datenvolumen' => 'growing_data_volume_footnote' ) as $label => $key ) { $add( 'Weitere Hinweise', $label, $key ); }
	return $groups;
}
