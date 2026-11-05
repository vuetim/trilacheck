<?php
/** First-party imagery with supplied CHECK24 affiliate destinations. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
$banners = array(
	'dsl' => array( 'aid' => 332, 'cat' => 4, 'deep' => 'dsl-anbieterwechsel', 'title' => 'DSL-Tarife vergleichen', 'photo' => 'dsl' ),
	'mobile' => array( 'aid' => 177, 'cat' => 7, 'deep' => 'handytarife', 'title' => 'Handytarife vergleichen', 'photo' => 'handytarife' ),
);
$banner = $banners[ $args['type'] ?? '' ] ?? null;
if ( ! $banner ) { return; }
$url = add_query_arg( array( 'pid' => 262971, 'aid' => $banner['aid'], 'deep' => $banner['deep'], 'cat' => $banner['cat'] ), 'https://a.check24.net/misc/click.php' );
?>
<div class="tc-power-banner tc-service-banner">
	<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="sponsored noopener" aria-label="<?php echo esc_attr( $banner['title'] . ' (öffnet in einem neuen Tab)' ); ?>">
		<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/heroes/trilacheck-hero-' . $banner['photo'] . '.webp' ) ); ?>" alt="" width="1792" height="1024" decoding="async">
		<strong class="tc-power-banner__title"><?php echo esc_html( $banner['title'] ); ?></strong>
		<span class="tc-power-banner__button"><?php esc_html_e( 'Tarif finden', 'trilacheck' ); ?></span>
	</a>
</div>
