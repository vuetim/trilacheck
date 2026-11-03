<?php
/** Blog posts archive. @package Trilacheck */
get_header();
global $wp_query;
$featured_id = 0;
?>
<div class="tc-blog-archive">
	<header class="tc-blog-hero"><div class="tc-container"><p><?php esc_html_e( 'Ratgeber & Wissen', 'trilacheck' ); ?></p><h1><?php esc_html_e( 'Besser vergleichen und bewusst entscheiden', 'trilacheck' ); ?></h1><span><?php esc_html_e( 'Verständliche Ratgeber zu Energie, Internet, Mobilfunk, Reisen, Finanzen und Versicherungen.', 'trilacheck' ); ?></span></div></header>
	<div class="tc-container tc-blog-archive__body">
		<?php if ( have_posts() ) : ?>
			<?php the_post(); $featured_id=get_the_ID(); $categories=get_the_category(); ?>
			<article class="tc-blog-featured"><a class="tc-blog-featured__media" href="<?php echo esc_url( get_permalink() ); ?>"><?php if(has_post_thumbnail()) the_post_thumbnail('large',array('fetchpriority'=>'high','alt'=>'')); else echo '<span>TrilaCheck Ratgeber</span>'; ?></a><div class="tc-blog-featured__copy"><p><?php echo $categories ? esc_html($categories[0]->name) : esc_html__('Ratgeber','trilacheck'); ?> · <time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time></p><h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2><span><?php echo esc_html(wp_trim_words(get_the_excerpt(),28)); ?></span><a href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e('Artikel lesen','trilacheck'); ?><b aria-hidden="true">→</b></a></div></article>
			<div class="tc-blog-grid">
			<?php while ( have_posts() ) : the_post(); $categories=get_the_category(); ?><article class="tc-blog-card"><a class="tc-blog-card__media" href="<?php echo esc_url( get_permalink() ); ?>"><?php if(has_post_thumbnail()) the_post_thumbnail('medium_large',array('loading'=>'lazy','alt'=>'')); else echo '<span>TrilaCheck</span>'; ?></a><div class="tc-blog-card__copy"><p><?php echo $categories ? esc_html($categories[0]->name) : esc_html__('Ratgeber','trilacheck'); ?> · <time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time></p><h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2><span><?php echo esc_html(wp_trim_words(get_the_excerpt(),20)); ?></span><a href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e('Weiterlesen','trilacheck'); ?><b aria-hidden="true">→</b></a></div></article><?php endwhile; ?>
			</div>
			<?php the_posts_pagination(array('mid_size'=>1,'prev_text'=>'←','next_text'=>'→')); ?>
		<?php else : ?><p><?php esc_html_e('Noch keine Ratgeber veröffentlicht.','trilacheck'); ?></p><?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>
