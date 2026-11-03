<?php
/**
 * Helpful not-found page; WordPress retains the real HTTP 404 status.
 *
 * @package Trilacheck
 */

defined( 'ABSPATH' ) || exit;
get_header();
?>
<div class="tc-container tc-content-layout">
	<h1 class="tc-entry__title"><?php esc_html_e( 'Seite nicht gefunden', 'trilacheck' ); ?></h1>
	<p><?php esc_html_e( 'Diese Seite ist nicht verfügbar. In unserer Übersicht findest du die aktuellen Vergleiche.', 'trilacheck' ); ?></p>
	<a href="<?php echo esc_url( home_url( '/vergleiche/' ) ); ?>"><?php esc_html_e( 'Alle Vergleiche ansehen', 'trilacheck' ); ?></a>
</div>
<?php get_footer(); ?>
