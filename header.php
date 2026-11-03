<?php
/**
 * Site header.
 *
 * @package Trilacheck
 */

defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="tc-skip-link" href="#main-content"><?php esc_html_e( 'Zum Inhalt springen', 'trilacheck' ); ?></a>

<header id="top" class="tc-site-header <?php echo is_front_page() ? 'tc-site-header--home' : 'tc-site-header--inner'; ?>" data-tc-header>
	<?php $tc_whatsapp_number = preg_replace( '/[^0-9]/', '', (string) get_theme_mod( 'tc_whatsapp_number', '4915207415547' ) ); ?>
	<div class="tc-whatsapp-bar">
		<div class="tc-whatsapp-bar__inner">
			<p>Schreib uns &ndash; wir finden das <strong>passende Angebot</strong> f&uuml;r dich!</p>
			<a class="tc-whatsapp-bar__button" <?php if ( $tc_whatsapp_number ) : ?>href="<?php echo esc_url( 'https://wa.me/' . $tc_whatsapp_number ); ?>" target="_blank" rel="noopener noreferrer"<?php else : ?>aria-disabled="true"<?php endif; ?> aria-label="<?php esc_attr_e( 'Trilacheck auf WhatsApp kontaktieren', 'trilacheck' ); ?>">
				WhatsApp <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
			</a>
		</div>
	</div>
	<div class="tc-header-shell">
		<div class="tc-header-top">
			<button class="tc-menu-toggle" type="button" aria-expanded="false" aria-controls="tc-mobile-menu">
				<span class="tc-menu-toggle__icon" aria-hidden="true"><span></span><span></span><span></span></span>
				<span class="screen-reader-text"><?php esc_html_e( 'Menü öffnen', 'trilacheck' ); ?></span>
			</button>

			<div class="tc-brand">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a class="tc-brand__text" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">trila<span>check</span></a>
				<?php endif; ?>
			</div>

			<a class="tc-all-comparisons" href="<?php echo esc_url( home_url( '/vergleiche/' ) ); ?>" aria-label="<?php esc_attr_e( 'Alle Vergleiche', 'trilacheck' ); ?>">
				<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
				<span><?php esc_html_e( 'Alle Vergleiche', 'trilacheck' ); ?></span>
			</a>
		</div>

		<form class="tc-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="tc-site-search"><?php esc_html_e( 'Website durchsuchen', 'trilacheck' ); ?></label>
			<svg class="tc-search__icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
			<input id="tc-site-search" name="s" type="search" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Was möchtest du vergleichen?', 'trilacheck' ); ?>">
			<button type="submit"><?php esc_html_e( 'Suchen', 'trilacheck' ); ?><span aria-hidden="true">→</span></button>
		</form>

		<nav class="tc-quick-nav" aria-label="<?php esc_attr_e( 'Vergleichs-Kategorien', 'trilacheck' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'quick_links',
					'container'      => false,
					'menu_class'     => 'tc-quick-menu',
					'depth'          => 1,
					'fallback_cb'    => 'trilacheck_menu_fallback',
				)
			);
			?>
		</nav>
	</div>

	<div id="tc-mobile-menu" class="tc-drawer" hidden>
		<button class="tc-drawer__backdrop" type="button" data-tc-menu-close tabindex="-1" aria-label="<?php esc_attr_e( 'Menü schließen', 'trilacheck' ); ?>"></button>
		<div class="tc-drawer__panel" role="dialog" aria-modal="true" aria-labelledby="tc-drawer-title">
			<div class="tc-drawer__head">
				<strong id="tc-drawer-title"><?php esc_html_e( 'Menü', 'trilacheck' ); ?></strong>
				<button class="tc-drawer__close" type="button" data-tc-menu-close aria-label="<?php esc_attr_e( 'Menü schließen', 'trilacheck' ); ?>">×</button>
			</div>
			<nav aria-label="<?php esc_attr_e( 'Hauptmenü', 'trilacheck' ); ?>">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'tc-primary-menu', 'fallback_cb' => 'trilacheck_primary_menu_fallback', 'depth' => 2 ) ); ?>
			</nav>
		</div>
	</div>
</header>

<main id="main-content" class="tc-site-main">
