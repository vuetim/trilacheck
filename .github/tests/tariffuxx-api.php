<?php
/** Integration contracts for the API response, filtering and tracked links. */
define( 'ABSPATH', __DIR__ );
define( 'MB_IN_BYTES', 1048576 );
define( 'HOUR_IN_SECONDS', 3600 );
define( 'MINUTE_IN_SECONDS', 60 );
define( 'TRILACHECK_TARIFFUXX_PUBLIC_KEY', 'test-server-only-key' );
class WP_Error {}
function add_action( ...$args ) {}
function wp_next_scheduled( $hook ) { return true; }
function get_option( $key, $default = false ) { return $default; }
function get_transient( $key ) { return false; }
function set_transient( ...$args ) {}
function wp_json_encode( $value ) { return json_encode( $value ); }
function is_wp_error( $value ) { return $value instanceof WP_Error; }
function wp_remote_retrieve_response_code( $value ) { return $value['status']; }
function wp_remote_retrieve_body( $value ) { return json_encode( array( 'products' => $value['products'] ) ); }
function wp_strip_all_tags( $value ) { return strip_tags( $value ); }
function wp_parse_url( $value ) { return parse_url( $value ); }
function sanitize_title( $value ) { return strtolower( str_replace( ' ', '-', $value ) ); }
function sanitize_text_field( $value ) { return strip_tags( $value ); }
function wp_unslash( $value ) { return $value; }
function absint( $value ) { return abs( (int) $value ); }
function esc_html( $value ) { return htmlspecialchars( (string) $value, ENT_QUOTES, 'UTF-8' ); }
function esc_attr( $value ) { return esc_html( $value ); }
function esc_url( $value ) { return esc_html( $value ); }
function get_permalink() { return 'https://trilacheck.de/handy-mit-vertrag/'; }
function selected( $a, $b ) { if ( (string) $a === (string) $b ) { echo 'selected'; } }
function number_format_i18n( $value, $decimals ) { return number_format( $value, $decimals, ',', '.' ); }
function add_query_arg( $name, $value ) { return get_permalink() . '?' . $name . '=' . $value; }
function do_shortcode( $value ) { return '<div>LEGACY_FALLBACK</div>'; }
function wp_remote_get( $url, $options ) {
	parse_str( parse_url( $url, PHP_URL_QUERY ), $params );
	if ( str_contains( $url, 'get-by-params' ) ) {
		return array( 'status' => 200, 'products' => array( array( 'product_hardware_items' => array( array( 'brand' => 'Samsung', 'model' => 'Galaxy A17 5G', 'name' => 'Samsung Galaxy A17 5G 128GB' ) ) ) ) );
	}
	$GLOBALS['request'] = $params;
	if ( ! empty( $GLOBALS['simulate_error'] ) ) { return new WP_Error(); }
	$offer = array(
		'product_link' => 'https://www.tariffuxx.de/handytarife/angebot/123?r=1111811&subid=trilacheck-handy',
		'product_hardware_items' => array( 'model' => 'Galaxy A17 5G', 'description' => 'Samsung <script>unsafe</script>', 'brand' => 'Samsung', 'product_images' => array() ),
		'provider' => array( 'name' => 'Test' ), 'name' => 'Tarif',
		'one_time_product_charges' => array( array( 'description' => 'Gerätepreis', 'value' => 0 ) ),
		'recurring_product_charges' => array( 'description' => 'Grundgebühr', 'value' => 21.99, 'period_description' => 'pro Monat', 'from_period' => 1 ),
		'total_product_charges' => 567.66, 'effective_product_charges' => 23.65,
	);
	$foreign = $offer;
	$foreign['product_link'] = 'https://www.tariffuxx.de/handytarife/angebot/123?r=9999999';
	return array( 'status' => 200, 'products' => array( $offer, $foreign ) );
}
require dirname( __DIR__, 2 ) . '/includes/tariffuxx-api.php';
function check( $condition, $message ) { if ( ! $condition ) { throw new RuntimeException( $message ); } }
$_GET = array( 'telefon' => 'samsung-galaxy-a17-5g', 'anzahlung' => '0', 'daten' => '15000', 'netz' => 'd1', 'laufzeit' => '720' );
ob_start();
include dirname( __DIR__, 2 ) . '/template-parts/phone-api-comparison.php';
$html = ob_get_clean();
check( 1 === substr_count( $html, 'class="tc-phone-api__card"' ), 'Object-shaped phone must render; foreign partner must be excluded.' );
check( ! str_contains( $html, '<script>' ) && ! str_contains( $html, TRILACHECK_TARIFFUXX_PUBLIC_KEY ), 'Output must not contain injected HTML or API credentials.' );
check( 0.0 === $GLOBALS['request']['max_phone_price'] || '0' === $GLOBALS['request']['max_phone_price'], 'Zero down payment must not disappear.' );
check( array( 'samsung-galaxy-a17-5g' ) === $GLOBALS['request']['phone'], 'Deep-linked model must reach upstream.' );
check( '15000' === $GLOBALS['request']['data_units'] && '1' === $GLOBALS['request']['networks']['d1'], 'Data and network filters must reach upstream.' );
check( str_contains( $html, '21,99 €' ) && str_contains( $html, '23,65 €' ), 'Recurring charge and average must remain distinct.' );
check( '' === trilacheck_tariffuxx_link( 'https://evil.example/?r=1111811' ), 'Off-domain links must be excluded.' );
check( '' === trilacheck_tariffuxx_link( 'https://www.tariffuxx.de/untracked' ), 'Untracked links must be excluded.' );
check( '720' === $GLOBALS['request']['contract_period'], 'Contract duration filter must reach upstream.' );
check( '' === trilacheck_tariffuxx_link( 'https://www.tariffuxx.de/angebot?r=999&r=1111811' ), 'Ambiguous duplicate partner IDs must be excluded.' );
$tracked = 'https://www.tariffuxx.de/handytarife/angebot/123?phi%5B%5D=1188&r=1111811&subid=trilacheck-handy';
check( $tracked === trilacheck_tariffuxx_link( $tracked ), 'Selected phone, partner, SubID and all upstream tracking parameters must remain unchanged.' );
check( $tracked === trilacheck_tariffuxx_link( str_replace( '&', '&amp;', $tracked ) ), 'HTML-escaped tracking links must decode correctly.' );
$GLOBALS['simulate_error'] = true;
ob_start();
include dirname( __DIR__, 2 ) . '/template-parts/phone-api-comparison.php';
$html = ob_get_clean();
check( str_contains( $html, 'LEGACY_FALLBACK' ), 'API failure must preserve working legacy comparison.' );
echo "PASS: API rendering, model and zero-price filters, partner tracking, output safety and legacy fallback.\n";
