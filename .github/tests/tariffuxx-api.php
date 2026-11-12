<?php
/** Integration contracts for the API response, filtering and tracked links. */
define( 'ABSPATH', __DIR__ );
define( 'MB_IN_BYTES', 1048576 );
define( 'HOUR_IN_SECONDS', 3600 );
define( 'MINUTE_IN_SECONDS', 60 );
define( 'TRILACHECK_TARIFFUXX_PUBLIC_KEY', 'test-server-only-key' );
class WP_Error { public function get_error_code() { return 'tx_unavailable'; } }
function add_action( ...$args ) {}
function wp_next_scheduled( $hook ) { return true; }
function get_option( $key, $default = false ) { return $GLOBALS['options'][ $key ] ?? $default; }
function get_transient( $key ) { return false; }
function set_transient( ...$args ) {}
function wp_json_encode( $value ) { return json_encode( $value ); }
function is_wp_error( $value ) { return $value instanceof WP_Error; }
function wp_remote_retrieve_response_code( $value ) { return is_array( $value ) ? $value['status'] : 0; }
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
function home_url( $path ) { return 'https://trilacheck.de' . $path; }
function current_user_can( $capability ) { return false; }
function checked( $value ) { if ( $value ) { echo 'checked'; } }
function selected( $a, $b ) { if ( (string) $a === (string) $b ) { echo 'selected'; } }
function number_format_i18n( $value, $decimals ) { return number_format( $value, $decimals, ',', '.' ); }
function add_query_arg( $name, $value ) { return get_permalink() . '?' . $name . '=' . $value; }
function wp_enqueue_script( ...$args ) { $GLOBALS['fallback_script'] = $args[1]; }
function get_template_part( ...$args ) { echo 'CHECK24_FALLBACK'; }
function do_shortcode( $value ) { return '<div>LEGACY_FALLBACK</div>'; }
function wp_remote_get( $url, $options ) {
	parse_str( parse_url( $url, PHP_URL_QUERY ), $params );
	if ( str_contains( $url, 'get-by-params' ) ) {
		return array( 'status' => 200, 'products' => array( array( 'product_hardware_items' => array( array( 'brand' => 'Samsung', 'model' => 'Galaxy A17 5G', 'name' => 'Samsung Galaxy A17 5G 128GB' ) ) ) ) );
	}
	$GLOBALS['request'] = $params;
	if ( ! empty( $GLOBALS['simulate_error'] ) ) { return new WP_Error(); }
	if ( isset( $GLOBALS['response_offers'] ) ) { return array( 'status' => 200, 'products' => $GLOBALS['response_offers'] ); }
	$offer = array(
		'product_link' => 'https://www.tariffuxx.de/handytarife/angebot/123?r=1111811&subid=trilacheck-handy',
		'product_hardware_items' => array( 'model' => 'Galaxy A17 5G', 'description' => 'Samsung <script>unsafe</script>', 'brand' => 'Samsung', 'brand_modal_identifier' => 'samsung-galaxy-a17-5g', 'product_images' => array() ),
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
check( str_contains( $html, 'value="samsung-galaxy-a17-5g"' ), 'Smartphone picker must include models from real offers even before the cron catalogue is ready.' );
$GLOBALS['options']['trilacheck_tariffuxx_models'] = array( array( 'product_hardware_items' => array(
	array( 'brand_modal_identifier' => 'samsung-galaxy-a17-5g', 'name' => 'Samsung Galaxy A17 5G', 'brand' => 'Samsung' ),
	array( 'brand_modal_identifier' => 'apple-iphone-18', 'name' => 'Apple iPhone 18', 'brand' => 'Apple' ),
) ) );
$_GET = array( 'hersteller' => 'samsung', 'esim' => '1', '5g' => '1', 'sortierung' => 'monthly' );
ob_start();
include dirname( __DIR__, 2 ) . '/template-parts/phone-api-comparison.php';
$html = ob_get_clean();
check( array( 'samsung-galaxy-a17-5g' ) === $GLOBALS['request']['phone'], 'Manufacturer must filter real device IDs at the API, not only hide cards locally.' );
check( '1' === $GLOBALS['request']['esim_req'] && '1' === $GLOBALS['request']['technologies']['5g'], 'eSIM and 5G filters must reach the API.' );
check( 'MONTHLY_FEES' === $GLOBALS['request']['sort_prop'], 'Sort must reach the API.' );
check( str_contains( $html, 'class="tc-phone-api__compare"' ), 'Comparison control must carry a validated offer.' );
$_GET = array( 'telefon' => 'phone-no-longer-available' );
ob_start();
include dirname( __DIR__, 2 ) . '/template-parts/phone-api-comparison.php';
$html = ob_get_clean();
check( ! str_contains( $html, 'class="tc-phone-api__card"' ) && str_contains( $html, 'Keine passenden Angebote gefunden' ), 'Unknown models must not silently show unrelated offers.' );
$_GET = array();
$GLOBALS['simulate_error'] = true;
ob_start();
include dirname( __DIR__, 2 ) . '/template-parts/phone-api-comparison.php';
$html = ob_get_clean();
check( str_contains( $html, 'LEGACY_FALLBACK' ), 'API failure must preserve working legacy comparison.' );
check( ! str_contains( $html, 'id="tc-phone-model"' ), 'API failures must not leave an empty, misleading smartphone picker above the fallback widget.' );
$GLOBALS['simulate_error'] = false;
$args = array( 'mode' => 'sim' );
$_GET = array( 'telefon' => 'ignored-phone', 'anzahlung' => '0', 'esim' => '1', 'tarifart' => 'prepaid' );
$GLOBALS['response_offers'] = array( array(
 'name' => 'SIM Test', 'provider' => array( 'name' => 'Provider', 'logo' => 'provider.png' ),
 'product_link' => 'https://www.tariffuxx.de/angebot?r=1111811&tool_id=655&subid=trilacheck-mobilfunk',
 'one_time_product_charges' => array( 'description' => 'Anschlussgebühr', 'value' => 9.99 ),
 'recurring_product_charges' => array( 'value' => 10, 'period_description' => 'pro Monat' ),
 'effective_product_charges' => 10.42, 'total_product_charges' => 249.99, 'is_esim' => true,
) );
ob_start();
include dirname( __DIR__, 2 ) . '/template-parts/phone-api-comparison.php';
$html = ob_get_clean();
check( '0' === $GLOBALS['request']['incl_bundles'] && 'trilacheck-mobilfunk' === $GLOBALS['request']['subid'], 'SIM mode must request only SIM offers with its own SubID.' );
check( ! isset( $GLOBALS['request']['phone'], $GLOBALS['request']['max_phone_price'] ) && 'prepaid' === $GLOBALS['request']['payment'], 'SIM must ignore phone filters and pass payment type.' );
check( str_contains( $html, 'class="tc-phone-api__card"' ) && str_contains( $html, 'SIM Test' ) && str_contains( $html, '9,99 €' ), 'SIM offers without hardware must render with activation costs.' );
check( ! str_contains( $html, 'id="tc-phone-model"' ) && ! str_contains( $html, '<span>Einmaliger Gerätepreis</span>' ), 'SIM UI must not display irrelevant device controls or costs.' );
check( str_contains( $html, 'tool_id=655' ) && str_contains( $html, 'eSIM' ), 'SIM tracking parameters and eSIM availability must survive rendering.' );
$GLOBALS['simulate_error'] = true;
ob_start();
include dirname( __DIR__, 2 ) . '/template-parts/phone-api-comparison.php';
$html = ob_get_clean();
check( str_contains( $html, 'CHECK24_FALLBACK' ) && str_contains( $GLOBALS['fallback_script'], '/262971/' ), 'SIM errors must activate CHECK24 with the existing partner ID.' );
$GLOBALS['options']['trilacheck_mobile_comparison'] = 'legacy';
check( ! trilacheck_tariffuxx_enabled( 'sim' ) && trilacheck_tariffuxx_enabled(), 'SIM legacy switch must not disable the phone API.' );
echo "PASS: API rendering, model and zero-price filters, partner tracking, output safety and legacy fallback.\n";
