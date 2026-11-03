<?php
/**
 * Phone with contract comparison cards.
 *
 * @package Trilacheck
 */

defined( 'ABSPATH' ) || exit;

$phones = array(
	array( 'brand' => 'Apple', 'name' => 'iPhone', 'class' => 'tc-phone-art--apple' ),
	array( 'brand' => 'Samsung', 'name' => 'Galaxy', 'class' => 'tc-phone-art--samsung' ),
	array( 'brand' => 'Google', 'name' => 'Pixel', 'class' => 'tc-phone-art--pixel' ),
);
?>

<section class="tc-phone-contracts tc-container" aria-labelledby="tc-phone-contracts-title">
	<div class="tc-phone-contracts__head">
		<div>
			<p><?php esc_html_e( 'Smartphone und Tarif zusammen', 'trilacheck' ); ?></p>
			<h2 id="tc-phone-contracts-title"><?php esc_html_e( 'Handy mit Vertrag vergleichen', 'trilacheck' ); ?></h2>
		</div>
		<a href="<?php echo esc_url( home_url( '/handy-mit-vertrag/' ) ); ?>"><?php esc_html_e( 'Alle Angebote', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
	</div>

	<div class="tc-phone-contracts__grid">
		<?php foreach ( $phones as $phone ) : ?>
			<a class="tc-phone-card" href="<?php echo esc_url( home_url( '/handy-mit-vertrag/' ) ); ?>">
				<span class="tc-phone-card__visual" aria-hidden="true"><span class="tc-phone-art <?php echo esc_attr( $phone['class'] ); ?>"><i></i></span></span>
				<span class="tc-phone-card__content"><small><?php echo esc_html( $phone['brand'] ); ?></small><strong><?php echo esc_html( $phone['name'] ); ?> <?php esc_html_e( 'mit Vertrag', 'trilacheck' ); ?></strong><em><?php esc_html_e( 'Tarife und Geräte vergleichen', 'trilacheck' ); ?></em></span>
				<span class="tc-phone-card__arrow" aria-hidden="true">→</span>
			</a>
		<?php endforeach; ?>
	</div>

	<a class="tc-phone-contracts__mobile-link" href="<?php echo esc_url( home_url( '/handy-mit-vertrag/' ) ); ?>"><?php esc_html_e( 'Handys mit Vertrag vergleichen', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
</section>

