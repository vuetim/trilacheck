<?php
/**
 * Homepage hero slider.
 *
 * @package Trilacheck
 */

defined( 'ABSPATH' ) || exit;

$defaults = array(
	1 => array( 'eyebrow' => 'Energie', 'title' => 'Stromtarife vergleichen und sparen', 'text' => 'Vergleiche verfügbare Stromtarife passend zu deinem Verbrauch und Wohnort.', 'button' => 'Strom vergleichen', 'url' => '/strom/' ),
	2 => array( 'eyebrow' => 'Energie', 'title' => 'Gastarife übersichtlich vergleichen', 'text' => 'Finde einen Gastarif, der zu deinem Haushalt und deinem Verbrauch passt.', 'button' => 'Gas vergleichen', 'url' => '/gas/' ),
	3 => array( 'eyebrow' => 'Gut abgesichert', 'title' => 'Versicherungen passend vergleichen', 'text' => 'Vergleiche Leistungen, Beiträge und wichtige Tarifdetails transparent.', 'button' => 'Versicherungen ansehen', 'url' => '/versicherungen/' ),
	4 => array( 'eyebrow' => 'Internet für Zuhause', 'title' => 'DSL-Tarife für dein Zuhause finden', 'text' => 'Vergleiche Geschwindigkeit, Verfügbarkeit und monatliche Kosten.', 'button' => 'DSL vergleichen', 'url' => '/dsl/' ),
	5 => array( 'eyebrow' => 'Mobilfunk', 'title' => 'Handytarife für deinen Alltag', 'text' => 'Wähle Datenvolumen, Netz und Laufzeit passend zu deinen Bedürfnissen.', 'button' => 'Handytarife vergleichen', 'url' => '/mobilfunk/' ),
	6 => array( 'eyebrow' => 'Reisen', 'title' => 'Reiseangebote entspannt vergleichen', 'text' => 'Plane deine nächste Reise übersichtlich und ohne unnötige Umwege.', 'button' => 'Reisen entdecken', 'url' => '/reise/' ),
	7 => array( 'eyebrow' => 'Mobil unterwegs', 'title' => 'Den passenden Mietwagen finden', 'text' => 'Vergleiche Mietwagenangebote für dein Reiseziel und deinen Zeitraum.', 'button' => 'Mietwagen vergleichen', 'url' => '/mietwagen/' ),
	8 => array( 'eyebrow' => 'Finanzen', 'title' => 'Girokonten transparent vergleichen', 'text' => 'Prüfe Konditionen und Leistungen verschiedener Kontomodelle.', 'button' => 'Konten vergleichen', 'url' => '/girokonto/' ),
);
$colors = array( '#0b5052', '#8a4b08', '#173a72', '#315b91', '#5b3b8d', '#17686e', '#7b3f27', '#255a45' );
$files  = array( 'strom', 'gas', 'versicherungen', 'dsl', 'handytarife', 'reisen', 'mietwagen', 'konto' );
?>

<section class="tc-hero" aria-roledescription="carousel" aria-label="<?php esc_attr_e( 'Aktuelle Vergleiche', 'trilacheck' ); ?>" data-tc-hero style="--tc-hero-color: <?php echo esc_attr( get_theme_mod( 'tc_hero_1_color', $colors[0] ) ); ?>">
	<div class="tc-hero__viewport">
		<?php foreach ( $defaults as $number => $default ) : ?>
			<?php
			$image_id = absint( get_theme_mod( "tc_hero_{$number}_image", 0 ) );
			$title    = get_theme_mod( "tc_hero_{$number}_title", $default['title'] );
			?>
			<article class="tc-hero__slide<?php echo 1 === $number ? ' is-active' : ''; ?>" data-tc-slide data-color="<?php echo esc_attr( get_theme_mod( "tc_hero_{$number}_color", $colors[ $number - 1 ] ) ); ?>" aria-hidden="<?php echo 1 === $number ? 'false' : 'true'; ?>">
				<div class="tc-hero__content">
					<p class="tc-hero__eyebrow"><?php echo esc_html( get_theme_mod( "tc_hero_{$number}_eyebrow", $default['eyebrow'] ) ); ?></p>
					<?php if ( 1 === $number ) : ?>
						<h1><?php echo esc_html( $title ); ?></h1>
					<?php else : ?>
						<h2><?php echo esc_html( $title ); ?></h2>
					<?php endif; ?>
					<p class="tc-hero__text"><?php echo esc_html( get_theme_mod( "tc_hero_{$number}_text", $default['text'] ) ); ?></p>
					<a class="tc-button" href="<?php echo esc_url( get_theme_mod( "tc_hero_{$number}_url", home_url( $default['url'] ) ) ); ?>">
						<?php echo esc_html( get_theme_mod( "tc_hero_{$number}_button", $default['button'] ) ); ?><span aria-hidden="true">→</span>
					</a>
				</div>

				<div class="tc-hero__media<?php echo $image_id ? '' : ' tc-hero__media--empty'; ?>" aria-hidden="true">
					<?php
					if ( $image_id ) {
						echo wp_get_attachment_image(
							$image_id,
							'large',
							false,
							array(
								'class'         => 'tc-hero__image',
								'loading'       => 1 === $number ? 'eager' : 'lazy',
								'fetchpriority' => 1 === $number ? 'high' : 'auto',
								'alt'           => '',
							)
						);
					} else {
						printf(
							'<img class="tc-hero__image" src="%1$s" alt="" width="1792" height="1024" loading="%2$s" fetchpriority="%3$s">',
							esc_url( get_template_directory_uri() . '/assets/images/heroes/trilacheck-hero-' . $files[ $number - 1 ] . '.webp' ),
							1 === $number ? 'eager' : 'lazy',
							1 === $number ? 'high' : 'auto'
						);
					}
					?>
				</div>
			</article>
		<?php endforeach; ?>

	<button class="tc-hero__arrow tc-hero__arrow--prev" type="button" data-tc-prev aria-label="<?php esc_attr_e( 'Vorheriger Slide', 'trilacheck' ); ?>">‹</button>
	<button class="tc-hero__arrow tc-hero__arrow--next" type="button" data-tc-next aria-label="<?php esc_attr_e( 'Nächster Slide', 'trilacheck' ); ?>">›</button>

	<div class="tc-hero__dots" role="group" aria-label="<?php esc_attr_e( 'Slide auswählen', 'trilacheck' ); ?>">
		<?php for ( $dot = 0; $dot < count( $defaults ); $dot++ ) : ?>
			<button type="button" data-tc-dot="<?php echo esc_attr( $dot ); ?>" class="<?php echo 0 === $dot ? 'is-active' : ''; ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Slide %d anzeigen', 'trilacheck' ), $dot + 1 ) ); ?>" aria-current="<?php echo 0 === $dot ? 'true' : 'false'; ?>"></button>
		<?php endfor; ?>
	</div>
	</div>

	<div class="tc-hero-cards" aria-label="<?php esc_attr_e( 'Alle Vergleiche', 'trilacheck' ); ?>">
		<?php foreach ( $defaults as $number => $default ) : ?>
			<?php $card_image = absint( get_theme_mod( "tc_hero_{$number}_image", 0 ) ); ?>
			<a class="tc-hero-card" href="<?php echo esc_url( get_theme_mod( "tc_hero_{$number}_url", home_url( $default['url'] ) ) ); ?>">
				<strong><?php echo esc_html( get_theme_mod( "tc_hero_{$number}_button", $default['button'] ) ); ?></strong>
				<span class="tc-hero-card__media" aria-hidden="true">
					<?php if ( $card_image ) : ?>
						<?php echo wp_get_attachment_image( $card_image, 'medium', false, array( 'loading' => 'lazy', 'alt' => '' ) ); ?>
					<?php else : ?>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/heroes/trilacheck-hero-' . $files[ $number - 1 ] . '.webp' ); ?>" alt="" width="448" height="256" loading="lazy">
					<?php endif; ?>
				</span>
				<small><?php esc_html_e( 'Jetzt vergleichen', 'trilacheck' ); ?><span aria-hidden="true">→</span></small>
			</a>
		<?php endforeach; ?>
	</div>
</section>
