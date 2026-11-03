<?php
/** Latest advice posts on the homepage. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
$query_args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 3,
	'ignore_sticky_posts' => true,
	'orderby'             => array( 'date' => 'DESC', 'ID' => 'DESC' ),
	'no_found_rows'       => true,
);
if ( ! empty( $args['category_id'] ) ) {
	$query_args['cat'] = absint( $args['category_id'] );
}
$latest_posts = new WP_Query( $query_args );
$section_id = $args['section_id'] ?? 'tc-home-posts-title';
$section_title = $args['title'] ?? __( 'Wissen für deine nächste Entscheidung', 'trilacheck' );
if ( ! $latest_posts->have_posts() ) {
	wp_reset_postdata();
	return;
}
?>
<section class="tc-home-posts tc-container" aria-labelledby="<?php echo esc_attr( $section_id ); ?>">
	<div class="tc-home-posts__head"><div><p><?php esc_html_e( 'Ratgeber', 'trilacheck' ); ?></p><h2 id="<?php echo esc_attr( $section_id ); ?>"><?php echo esc_html( $section_title ); ?></h2></div><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Alle Ratgeber', 'trilacheck' ); ?><span aria-hidden="true">→</span></a></div>
	<div class="tc-home-posts__track">
		<?php while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); $categories=get_the_category(); ?>
			<article class="tc-home-post-card"><a class="tc-home-post-card__media" href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1" aria-hidden="true"><?php if ( has_post_thumbnail() ) the_post_thumbnail( 'medium_large', array( 'loading'=>'lazy', 'alt'=>'' ) ); else echo '<span>TrilaCheck</span>'; ?></a><div class="tc-home-post-card__body"><p><?php echo $categories ? esc_html( $categories[0]->name ) : esc_html__( 'Ratgeber', 'trilacheck' ); ?> · <time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></p><h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3><span><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></span><a class="tc-home-post-card__more" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Artikel lesen', 'trilacheck' ); ?><b aria-hidden="true">→</b></a></div></article>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>
</section>
