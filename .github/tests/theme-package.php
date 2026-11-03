<?php
/** Basic theme contracts before packaging or deployment. */
$root = dirname( __DIR__, 2 );
foreach ( array( 'style.css', 'index.php', 'functions.php', 'header.php', 'footer.php', 'includes/internal-links.php', 'template-parts/comparison-trust.php', 'assets/images/trilacheck-vergleich-badge.svg' ) as $file ) {
	if ( ! is_file( $root . '/' . $file ) ) {
		throw new RuntimeException( 'Missing theme file: ' . $file );
	}
}
if ( ! preg_match( '/^Theme Name:\s*Trilacheck\s*$/m', file_get_contents( $root . '/style.css' ) ) ) {
	throw new RuntimeException( 'WordPress theme header missing.' );
}
json_decode( file_get_contents( $root . '/theme.json' ), true, 512, JSON_THROW_ON_ERROR );
foreach ( glob( $root . '/page-*.php' ) as $file ) {
	$source = file_get_contents( $file );
	if ( ! str_contains( $source, 'template-parts/comparison-trust' ) ) {
		continue;
	}
	if ( 1 !== substr_count( $source, 'template-parts/comparison-trust' ) ) {
		throw new RuntimeException( 'Duplicate trust strip: ' . basename( $file ) );
	}
	$header_start = strpos( $source, '<header' );
	$header_end   = strpos( $source, '</header>', $header_start );
	$strip        = strpos( $source, 'template-parts/comparison-trust' );
	if ( $strip < $header_start || $strip > $header_end ) {
		throw new RuntimeException( 'Trust strip must remain inside hero: ' . basename( $file ) );
	}
}
echo "PASS: theme structure, JSON and comparison hero placement.\n";
