<?php
/**
 * Template Name: Rechtliche Seite
 * Template Post Type: page
 *
 * @package Trilacheck
 */
get_header();
?>
<div class="tc-legal-page">
	<header class="tc-legal-hero">
		<div class="tc-container">
			<p><?php esc_html_e( 'TrilaCheck.de', 'trilacheck' ); ?></p>
			<h1><?php the_title(); ?></h1>
		</div>
	</header>
	<div class="tc-container tc-legal-layout">
		<article class="tc-legal-content">
			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
		</article>
	</div>
</div>
<?php get_footer(); ?>
