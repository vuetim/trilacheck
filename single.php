<?php
/** Single blog article. @package Trilacheck */
get_header();
while (have_posts()):
	the_post();
	$categories = get_the_category();
	$comparison = function_exists('trilacheck_article_comparison')
		? trilacheck_article_comparison(get_the_ID())
		: array('url' => home_url('/vergleiche/'), 'label' => __('Alle Vergleiche', 'trilacheck'));
	?>
	<main class="tc-article-page">
		<article <?php post_class('tc-article'); ?>>
			<header class="tc-article__header">
				<div class="tc-container tc-article__header-inner">
					<nav class="tc-breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumb', 'trilacheck'); ?>"><a
							href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Startseite', 'trilacheck'); ?></a><span>›</span><a
							href="<?php echo esc_url(home_url('/blog/')); ?>"><?php esc_html_e('Ratgeber', 'trilacheck'); ?></a>
					</nav>
					<p><?php echo $categories ? esc_html($categories[0]->name) : esc_html__('Ratgeber', 'trilacheck'); ?></p>
					<h1><?php the_title(); ?></h1>
					<div class="tc-article__meta"><time
							datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time><span>·</span><span><?php printf(esc_html__('%s Min. Lesezeit', 'trilacheck'), esc_html(max(1, (int) ceil(str_word_count(wp_strip_all_tags(get_the_content())) / 200)))); ?></span>
					</div>
				</div>
			</header>
			<?php if (has_post_thumbnail()): ?>
				<div class="tc-container tc-article__image"><?php the_post_thumbnail('large', array('fetchpriority' => 'high')); ?>
				</div><?php endif; ?>
			<div class="tc-container tc-article__layout">
				<div class="tc-article__content"><?php the_content();
				wp_link_pages(); ?></div>
				<aside class="tc-article__aside"><strong><?php esc_html_e('Tarife vergleichen', 'trilacheck'); ?></strong>
					<p><?php esc_html_e('Nutze unsere Übersichten und finde den Vergleich, der zu deinem Thema passt.', 'trilacheck'); ?>
					</p><a
						href="<?php echo esc_url($comparison['url']); ?>"><?php echo esc_html($comparison['label']); ?><span
							aria-hidden="true">→</span></a>
				</aside>
			</div>
		</article>
		<?php $related = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'orderby' => array( 'date' => 'DESC', 'ID' => 'DESC' ), 'no_found_rows' => true, 'posts_per_page' => 3, 'post__not_in' => array(get_the_ID()), 'category__in' => wp_list_pluck($categories, 'term_id') ?: array( 0 ), 'ignore_sticky_posts' => true));
		if ($related->have_posts()): ?>
			<section class="tc-related-posts tc-container">
				<div>
					<p><?php esc_html_e('Mehr entdecken', 'trilacheck'); ?></p>
					<h2><?php esc_html_e('Ähnliche Ratgeber', 'trilacheck'); ?></h2>
				</div>
				<div class="tc-related-posts__grid"><?php while ($related->have_posts()):
					$related->the_post(); ?>
						<article><a
								href="<?php echo esc_url( get_permalink() ); ?>"><?php if (has_post_thumbnail())
									  the_post_thumbnail('medium', array('loading' => 'lazy', 'alt' => '')); ?><strong><?php the_title(); ?></strong><span><?php esc_html_e('Artikel lesen', 'trilacheck'); ?>
									→</span></a></article><?php endwhile; ?>
				</div>
			</section><?php wp_reset_postdata(); endif; ?>
	</main>
<?php endwhile;
get_footer(); ?>