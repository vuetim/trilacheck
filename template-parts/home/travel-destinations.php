<?php
/**
 * Popular package-holiday destinations.
 *
 * @package Trilacheck
 */

defined( 'ABSPATH' ) || exit;

$destinations = array(
	array(
		'name'        => 'Mallorca',
		'country'     => 'Spanien',
		'url'         => '/ferienwohnungen-mallorca/',
		'image'       => 'mallorca.webp',
		'alt'         => 'Türkisfarbene Bucht und Felsenküste auf Mallorca',
		'description' => 'Ferienwohnungen auf Mallorca vergleichen',
	),
	array(
		'name'        => 'Gardasee',
		'country'     => 'Italien',
		'url'         => '/ferienwohnungen-gardasee/',
		'image'       => 'gardasee.webp',
		'alt'         => 'Gardasee mit Berglandschaft und italienischem Uferort',
		'description' => 'Ferienwohnungen am Gardasee vergleichen',
	),
	array(
		'name'        => 'Allgäu',
		'country'     => 'Deutschland',
		'url'         => '/ferienwohnungen-allgaeu/',
		'image'       => 'allgaeu.webp',
		'alt'         => 'Grüne Alpenwiese und Bergpanorama im Allgäu',
		'description' => 'Ferienwohnungen im Allgäu vergleichen',
	),
	array(
		'name'        => 'Istrien',
		'country'     => 'Kroatien',
		'url'         => '/ferienwohnungen-istrien/',
		'image'       => 'istrien.webp',
		'alt'         => 'Türkisfarbene Adriaküste und historische Ortschaft in Istrien',
		'description' => 'Ferienwohnungen in Istrien vergleichen',
	),
);
?>

<section class="tc-destinations tc-container" aria-labelledby="tc-destinations-title">
	<div class="tc-destinations__head">
		<div>
			<p><?php esc_html_e( 'Ferienwohnungen entdecken', 'trilacheck' ); ?></p>
			<h2 id="tc-destinations-title"><?php esc_html_e( 'Beliebte Reiseziele für Ferienwohnungen', 'trilacheck' ); ?></h2>
		</div>
		<a href="<?php echo esc_url( home_url( '/reise/' ) ); ?>"><?php esc_html_e( 'Alle Reiseangebote', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
	</div>

	<div class="tc-destinations__grid">
		<?php foreach ( $destinations as $destination ) : ?>
			<a class="tc-destination-card" href="<?php echo esc_url( home_url( $destination['url'] ) ); ?>" aria-label="<?php echo esc_attr( $destination['description'] ); ?>">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/destinations/' . $destination['image'] ); ?>" alt="<?php echo esc_attr( $destination['alt'] ); ?>" width="900" height="600" loading="lazy">
				<span class="tc-destination-card__overlay">
					<strong><?php echo esc_html( $destination['name'] ); ?></strong>
					<small><?php echo esc_html( $destination['country'] ); ?></small>
					<em><?php esc_html_e( 'Ferienwohnungen vergleichen', 'trilacheck' ); ?><span aria-hidden="true">→</span></em>
				</span>
			</a>
		<?php endforeach; ?>
	</div>

	<a class="tc-destinations__mobile-link" href="<?php echo esc_url( home_url( '/reise/' ) ); ?>"><?php esc_html_e( 'Alle Reiseangebote entdecken', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
</section>
