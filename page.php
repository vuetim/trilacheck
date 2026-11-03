<?php
/**
 * Default page.
 *
 * @package Trilacheck
 */

get_header();
?>
<div class="tc-container tc-content-layout">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'tc-entry' ); ?>>
			<h1 class="tc-entry__title"><?php the_title(); ?></h1>
			<div class="tc-entry__content"><?php the_content(); ?><?php get_template_part( 'template-parts/destination-guide' ); ?></div>
		</article>
	<?php endwhile; ?>
</div>
<?php get_footer(); ?>

