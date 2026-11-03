<?php
/**
 * Mobile tariff comparison cards.
 *
 * @package Trilacheck
 */

defined( 'ABSPATH' ) || exit;

$tariffs = array(
	array(
		'amount' => '5',
		'unit'   => 'GB',
		'label'  => __( 'Für Wenignutzer', 'trilacheck' ),
		'text'   => __( 'Passende Tarife mit 5 GB Datenvolumen vergleichen.', 'trilacheck' ),
		'url'    => '/handytarife-5gb/',
	),
	array(
		'amount' => '15',
		'unit'   => 'GB',
		'label'  => __( 'Für den Alltag', 'trilacheck' ),
		'text'   => __( 'Tarife mit 15 GB für Messaging, Navigation und mehr.', 'trilacheck' ),
		'url'    => '/handytarife-15gb/',
	),
	array(
		'amount' => '50',
		'unit'   => 'GB',
		'label'  => __( 'Für Vielnutzer', 'trilacheck' ),
		'text'   => __( 'Großzügige 50-GB-Tarife für Streaming und unterwegs.', 'trilacheck' ),
		'url'    => '/handytarife-50gb/',
	),
);
?>

<section class="tc-mobile-tariffs tc-container" aria-labelledby="tc-mobile-tariffs-title">
	<div class="tc-mobile-tariffs__head">
		<div>
			<p><?php esc_html_e( 'Passendes Datenvolumen wählen', 'trilacheck' ); ?></p>
			<h2 id="tc-mobile-tariffs-title"><?php esc_html_e( 'Handytarife ohne Smartphone vergleichen', 'trilacheck' ); ?></h2>
		</div>
		<a href="<?php echo esc_url( home_url( '/mobilfunk/' ) ); ?>"><?php esc_html_e( 'Alle Handytarife', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
	</div>

	<div class="tc-mobile-tariffs__grid">
		<?php foreach ( $tariffs as $tariff ) : ?>
			<a class="tc-tariff-card" href="<?php echo esc_url( home_url( $tariff['url'] ) ); ?>">
				<span class="tc-tariff-card__volume"><small><?php esc_html_e( 'ab', 'trilacheck' ); ?></small><strong><?php echo esc_html( $tariff['amount'] ); ?> <b><?php echo esc_html( $tariff['unit'] ); ?></b></strong><em><?php esc_html_e( 'Datenvolumen', 'trilacheck' ); ?></em></span>
				<span class="tc-tariff-card__content"><small><?php echo esc_html( $tariff['label'] ); ?></small><strong><?php esc_html_e( 'Tarife vergleichen', 'trilacheck' ); ?></strong><em><?php echo esc_html( $tariff['text'] ); ?></em></span>
				<span class="tc-tariff-card__arrow" aria-hidden="true">→</span>
			</a>
		<?php endforeach; ?>
	</div>

	<a class="tc-mobile-tariffs__mobile-link" href="<?php echo esc_url( home_url( '/mobilfunk/' ) ); ?>"><?php esc_html_e( 'Alle Handytarife ansehen', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
</section>

