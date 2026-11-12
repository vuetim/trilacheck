<?php
/** Mobile tariff detail pages. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
$slug = get_post_field( 'post_name', get_queried_object_id() );
$pages = array(
	'handytarife-5gb' => array( 'widget'=>'5gb', 'eyebrow'=>'Kompakter Datentarif', 'title'=>'Handytarife mit 5 GB vergleichen', 'lead'=>'Tarife mit 5 GB für Messaging, Navigation und gelegentliches Surfen vergleichen.', 'who'=>'5 GB können passen, wenn du unterwegs vor allem Nachrichten sendest, E-Mails liest, navigierst und nur selten Videos streamst.' ),
	'handytarife-15gb' => array( 'widget'=>'15gb', 'eyebrow'=>'Für den digitalen Alltag', 'title'=>'Handytarife mit 15 GB vergleichen', 'lead'=>'15-GB-Tarife nach Preis, Netz, Laufzeit, 5G und weiteren Leistungen vergleichen.', 'who'=>'15 GB bieten vielen Nutzerinnen und Nutzern Reserve für Social Media, Musik, Navigation und gelegentliches Streaming.' ),
	'handytarife-50gb' => array( 'widget'=>'50gb', 'eyebrow'=>'Mehr Daten unterwegs', 'title'=>'Handytarife mit 50 GB vergleichen', 'lead'=>'Tarife mit 50 GB Datenvolumen für intensive Smartphone-Nutzung übersichtlich prüfen.', 'who'=>'50 GB eignen sich eher für regelmäßiges Streaming, Videotelefonie oder die häufige Nutzung des Smartphones als Hotspot.' ),
	'handytarife-unlimited' => array( 'widget'=>'unlimited', 'eyebrow'=>'Ohne festes Datenlimit', 'title'=>'Unlimited-Handytarife vergleichen', 'lead'=>'Tarife mit unbegrenztem Datenvolumen nach Geschwindigkeit, Netz und Gesamtkosten vergleichen.', 'who'=>'Unlimited-Tarife können interessant sein, wenn du sehr viel streamst, große Dateien mobil überträgst oder häufig einen Hotspot verwendest.' ),
	'tarife-fur-junge-leute' => array( 'widget'=>'young', 'eyebrow'=>'Young-Tarife', 'title'=>'Tarife für junge Leute vergleichen', 'lead'=>'Mobilfunktarife mit möglichen Young-Vorteilen nach Datenvolumen, Laufzeit, Netz und Preis vergleichen.', 'who'=>'Young-Tarife richten sich je nach Anbieter an bestimmte Altersgruppen. Prüfe die Altersgrenze und benötigte Nachweise direkt im Angebot.' ),
	'prepaid-tarife' => array( 'widget'=>'prepaid', 'eyebrow'=>'Flexibel mobil', 'title'=>'Prepaid-Tarife vergleichen', 'lead'=>'Prepaid-Angebote nach Kosten, Datenvolumen und Netz vergleichen.', 'who'=>'Prepaid kann passen, wenn dir Kostenkontrolle und Flexibilität wichtig sind. Prüfe Guthaben, Abrechnungsintervall und automatische Aufladung vor der Auswahl.' ),
);
if ( ! isset( $pages[ $slug ] ) ) { get_template_part( 'page' ); return; }
$tariff_page = $pages[ $slug ];
$editorial_pages = require __DIR__ . '/includes/mobile-editorial.php';
$editorial = $editorial_pages[ $slug ];
get_header();
?>
<div class="tc-mobile-detail">
	<header class="tc-mobile-detail__hero tc-comparison-hero tc-comparison-hero--plain"><div class="tc-container"><p><?php echo esc_html( $tariff_page['eyebrow'] ); ?></p><h1><?php echo esc_html( $tariff_page['title'] ); ?></h1><div class="tc-mobile-detail__lead"><?php echo esc_html( $tariff_page['lead'] ); ?></div><?php get_template_part( 'template-parts/comparison-service' ); ?><a href="#tarifvergleich"><?php esc_html_e( 'Tarife vergleichen', 'trilacheck' ); ?><span aria-hidden="true">→</span></a></div><?php get_template_part( 'template-parts/comparison-trust' ); ?>
	</header>
	<section id="tarifvergleich" class="tc-container tc-mobile-detail__widget" aria-labelledby="tc-detail-widget-title"><h2 id="tc-detail-widget-title"><?php echo esc_html( $tariff_page['title'] ); ?></h2><?php if ( trilacheck_tariffuxx_enabled( 'sim' ) ) { get_template_part( 'template-parts/phone-api-comparison', null, array( 'mode' => 'sim', 'preset' => $tariff_page['widget'] ) ); } else { echo do_shortcode( '[trilacheck_mobile data="' . esc_attr( $tariff_page['widget'] ) . '"]' ); } ?></section>
	<div class="tc-container tc-mobile-detail__content">
		<section><h2><?php esc_html_e( 'Für wen passt dieser Tarif?', 'trilacheck' ); ?></h2><p><?php echo esc_html( $tariff_page['who'] ); ?></p><p><?php echo esc_html( $editorial['usage'] ); ?></p></section>
		<section><h2><?php esc_html_e( 'Wichtige Punkte vor der Tarifwahl', 'trilacheck' ); ?></h2><div class="tc-mobile-detail__criteria"><?php foreach ( $editorial['criteria'] as $criterion_title => $criterion_text ) : ?><article><h3><?php echo esc_html( $criterion_title ); ?></h3><p><?php echo esc_html( $criterion_text ); ?></p></article><?php endforeach; ?></div></section>
		<section class="tc-mobile-detail__faq"><h2><?php esc_html_e( 'Häufige Fragen', 'trilacheck' ); ?></h2><details><summary><?php echo esc_html( $editorial['question'] ); ?></summary><p><?php echo esc_html( $editorial['answer'] ); ?></p></details><details><summary><?php esc_html_e( 'Wo wird der Vertrag abgeschlossen?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Trilacheck unterstützt beim Vergleich. Für den Abschluss wirst du zum Partner oder Anbieter weitergeleitet.', 'trilacheck' ); ?></p></details></section>
		<nav class="tc-mobile-detail__more" aria-label="<?php esc_attr_e( 'Weitere Handytarife', 'trilacheck' ); ?>"><strong><?php esc_html_e( 'Weitere Vergleiche', 'trilacheck' ); ?></strong><a href="<?php echo esc_url( home_url( '/mobilfunk/' ) ); ?>"><?php esc_html_e( 'Alle Handytarife', 'trilacheck' ); ?></a><a href="<?php echo esc_url( home_url( '/handytarife-unlimited/' ) ); ?>">Unlimited</a><a href="<?php echo esc_url( home_url( '/tarife-fur-junge-leute/' ) ); ?>">Young-Tarife</a><a href="<?php echo esc_url( home_url( '/prepaid-tarife/' ) ); ?>">Prepaid</a></nav>
	</div>
</div>
<?php get_footer(); ?>
