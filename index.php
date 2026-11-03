<?php
/**
 * Default index.
 *
 * @package Trilacheck
 */

get_header();
?>
<div class="tc-container tc-content-layout">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'tc-entry' ); ?>>
				<h1 class="tc-entry__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<div class="tc-entry__content"><?php the_excerpt(); ?></div>
			</article>
		<?php endwhile; ?>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Keine Inhalte gefunden.', 'trilacheck' ); ?></p>
	<?php endif; ?>
</div>
<?php get_footer(); ?>

