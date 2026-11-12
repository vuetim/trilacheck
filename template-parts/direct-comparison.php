<?php
/** Direct CHECK24 containers; scripts are enqueued only on their matching page. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
$comparisons = array(
	'gas' => array( 'id' => 'c24pp-gas-iframe', 'label' => 'Gastarife vergleichen' ),
	'dsl' => array( 'id' => 'c24pp-dsl-iframe', 'label' => 'DSL-Tarife vergleichen' ),
	'mobile' => array( 'id' => 'c24pp-mobileservice-iframe', 'label' => 'Handytarife vergleichen' ),
	'rentalcar' => array( 'id' => 'c24pp-rentalcar-iframe', 'label' => 'Mietwagen vergleichen' ),
	'package' => array( 'id' => 'c24pp-package-iframe', 'label' => 'Pauschalreisen vergleichen' ),
);
$type = $args['type'] ?? '';
if ( ! isset( $comparisons[ $type ] ) ) {
	return;
}
$comparison = $comparisons[ $type ];
?>
<section class="tc-comparison-widget tc-comparison-widget--<?php echo esc_attr( $type ); ?>" aria-label="<?php echo esc_attr( $comparison['label'] ); ?>">
	<?php get_template_part( 'template-parts/comparison-support' ); ?>
	<div class="tc-comparison-widget__frame"><div style="width:100%" id="<?php echo esc_attr( $comparison['id'] ); ?>"<?php if ( in_array( $type, array( 'gas', 'rentalcar', 'package' ), true ) ) : ?> data-scrollto="begin"<?php endif; ?><?php if ( 'package' === $type ) : ?> data-offer="allgemein" data-forward-url="no"<?php endif; ?>></div></div>
	<?php get_template_part( 'template-parts/comparison-disclosure' ); ?>
	<noscript><p><?php esc_html_e( 'Bitte aktiviere JavaScript, um den Vergleich zu verwenden.', 'trilacheck' ); ?></p></noscript>
</section>
