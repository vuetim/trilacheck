<?php
/**
 * Front page foundation.
 *
 * @package Trilacheck
 */

get_header();
?>
<?php get_template_part( 'template-parts/home/hero' ); ?>
<?php get_template_part( 'template-parts/home/popular-comparisons' ); ?>
<?php get_template_part( 'template-parts/home/travel-destinations' ); ?>
<?php get_template_part( 'template-parts/home/mobile-tariffs' ); ?>
<?php get_template_part( 'template-parts/home/vehicle-insurance' ); ?>
<?php get_template_part( 'template-parts/home/phone-contracts' ); ?>
<?php get_template_part( 'template-parts/home/power-comparison' ); ?>
<?php get_template_part( 'template-parts/home/gas-comparison' ); ?>
<?php get_template_part( 'template-parts/home/dsl-comparison' ); ?>
<?php get_template_part( 'template-parts/home/service-comparisons' ); ?>
<?php get_template_part( 'template-parts/home/insurance-comparison' ); ?>
<?php get_template_part( 'template-parts/home/latest-posts' ); ?>

<div class="tc-container tc-home-intro">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
</div>
<?php get_footer(); ?>
