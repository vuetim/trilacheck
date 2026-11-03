<?php
/**
 * Popular comparison categories.
 *
 * @package Trilacheck
 */

defined( 'ABSPATH' ) || exit;

$comparisons = array(
	array(
		'label' => __( 'Strom', 'trilacheck' ),
		'url'   => '/strom/',
		'icon'  => '<path d="M13.2 2 6.5 13h4.7L10.8 22l6.7-11h-4.7L13.2 2Z"/>',
	),
	array(
		'label' => __( 'Gas', 'trilacheck' ),
		'url'   => '/gas/',
		'icon'  => '<path d="M13.5 2.5c.5 4-2.5 5.2-2.5 8.2 0 1.5 1 2.4 2.2 2.4 1.8 0 2.8-1.6 2.3-3.6 2.5 2 3.5 4.1 3.5 6.2A7 7 0 0 1 5 15.7c0-4.1 3.1-7.6 8.5-13.2Z"/><path d="M9.5 18.5c0-2 1-3.5 2.5-4.8 0 2.2 2.5 2.6 2.5 4.8"/>',
	),
	array(
		'label' => __( 'Versicherungen', 'trilacheck' ),
		'url'   => '/versicherungen/',
		'icon'  => '<path d="M12 2.5 20 6v5.7c0 4.8-3.2 8.1-8 9.8-4.8-1.7-8-5-8-9.8V6l8-3.5Z"/><path d="m8.5 12 2.2 2.2 4.8-5"/>',
	),
	array(
		'label' => __( 'DSL', 'trilacheck' ),
		'url'   => '/dsl/',
		'icon'  => '<rect x="4" y="13" width="16" height="7" rx="2"/><path d="M8 13a5.7 5.7 0 0 1 8 0M5.5 10.5a9.2 9.2 0 0 1 13 0M9 17h.01M13 17h3"/>',
	),
	array(
		'label' => __( 'Handytarife', 'trilacheck' ),
		'url'   => '/mobilfunk/',
		'icon'  => '<rect x="5" y="2.5" width="10" height="19" rx="2"/><path d="M8.5 5h3M9 18.5h2"/><rect x="15" y="10" width="6" height="9" rx="1.2"/><path d="M17 13h2M17 16h.01M19 16h.01"/>',
	),
	array(
		'label' => __( 'Reisen', 'trilacheck' ),
		'url'   => '/reise/',
		'icon'  => '<path d="M3 19.5c2.3-1.2 4.7-1.2 7 0s4.7 1.2 7 0 3.5-.7 4-.5"/><path d="M7.5 16V8.5M4 9c2-3.3 5.5-4.7 10-3-2.5.2-4.5 1.2-6.5 3Z"/><path d="M7.5 8.5c2.7-.8 5.2 0 7.5 2-2.7-.3-5 .2-7.5 1.5"/>',
	),
	array(
		'label' => __( 'Mietwagen', 'trilacheck' ),
		'url'   => '/mietwagen/',
		'icon'  => '<path d="m5 10 1.8-4h10.4l1.8 4"/><rect x="3" y="10" width="18" height="8" rx="2"/><path d="M6 18v2M18 18v2M6.5 14h.01M17.5 14h.01M9 14h6"/>',
	),
	array(
		'label' => __( 'Konto', 'trilacheck' ),
		'url'   => '/girokonto/',
		'icon'  => '<path d="m3 9 9-5 9 5M5 10v7M9.5 10v7M14.5 10v7M19 10v7M3 20h18"/>',
	),
);
?>

<section class="tc-popular tc-container" aria-labelledby="tc-popular-title">
	<div class="tc-section-heading">
		<div>
			<p><?php esc_html_e( 'Schnell zum passenden Angebot', 'trilacheck' ); ?></p>
			<h2 id="tc-popular-title"><?php esc_html_e( 'Beliebteste Vergleiche', 'trilacheck' ); ?></h2>
		</div>
		<a href="<?php echo esc_url( home_url( '/vergleiche/' ) ); ?>"><?php esc_html_e( 'Alle Vergleiche', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
	</div>

	<nav class="tc-popular__grid" aria-label="<?php esc_attr_e( 'Beliebteste Vergleiche', 'trilacheck' ); ?>">
		<?php foreach ( $comparisons as $comparison ) : ?>
			<a class="tc-popular-card" href="<?php echo esc_url( home_url( $comparison['url'] ) ); ?>">
				<span class="tc-popular-card__icon" aria-hidden="true">
					<svg viewBox="0 0 24 24"><?php echo $comparison['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG paths defined above. ?></svg>
				</span>
				<span><?php echo esc_html( $comparison['label'] ); ?></span>
			</a>
		<?php endforeach; ?>
	</nav>
</section>

