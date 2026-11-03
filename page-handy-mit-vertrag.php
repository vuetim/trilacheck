<?php
/**
 * Phone with contract landing page.
 *
 * @package Trilacheck
 */

get_header();
?>
<article class="tc-contract-page">
	<header class="tc-contract-hero tc-comparison-hero tc-comparison-hero--plain">
		<div class="tc-container">
			<p><?php esc_html_e( 'Smartphone inklusive', 'trilacheck' ); ?></p>
			<h1><?php esc_html_e( 'Handy mit Vertrag vergleichen', 'trilacheck' ); ?></h1>
			<div class="tc-contract-hero__intro"><?php esc_html_e( 'Vergleiche Mobilfunktarife zusammen mit einem Smartphone. Prüfe Gesamtkosten, Datenvolumen, Laufzeit und einmalige Gerätekosten vor dem Abschluss.', 'trilacheck' ); ?></div>
			<ul><li><?php esc_html_e( 'Smartphone und Tarif gemeinsam vergleichen', 'trilacheck' ); ?></li><li><?php esc_html_e( 'Monatliche und einmalige Kosten beachten', 'trilacheck' ); ?></li><li><?php esc_html_e( 'Abschluss beim ausgewählten Anbieter', 'trilacheck' ); ?></li></ul>
		</div>
	<?php get_template_part( 'template-parts/comparison-trust' ); ?>
	</header>
	<div class="tc-container tc-contract-widget"><?php echo do_shortcode( '[trilacheck_phone_contract]' ); ?></div>
	<div class="tc-container tc-contract-content">
		<section><h2><?php esc_html_e( 'Was bedeutet Handy mit Vertrag?', 'trilacheck' ); ?></h2><p><?php esc_html_e( 'Bei einem Bundle werden Mobilfunktarif und Smartphone gemeinsam angeboten. Das Gerät wird je nach Angebot über eine Einmalzahlung, monatliche Raten oder eine Kombination aus beidem finanziert. Vergleiche deshalb nicht nur den monatlichen Grundpreis, sondern die Kosten über die gesamte Mindestlaufzeit.', 'trilacheck' ); ?></p></section>
		<section><h2><?php esc_html_e( 'Darauf solltest du beim Vergleich achten', 'trilacheck' ); ?></h2><div class="tc-contract-criteria"><div><h3><?php esc_html_e( 'Gesamtkosten', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Grundpreise, Anschlusskosten und Gerätezahlung zusammenrechnen.', 'trilacheck' ); ?></p></div><div><h3><?php esc_html_e( 'Datenvolumen', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Ein Volumen wählen, das zu deinem tatsächlichen Verbrauch passt.', 'trilacheck' ); ?></p></div><div><h3><?php esc_html_e( 'Laufzeit', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Mindestlaufzeit und Kündigungsbedingungen sorgfältig prüfen.', 'trilacheck' ); ?></p></div><div><h3><?php esc_html_e( 'Netz', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Die lokale Netzabdeckung vor der Bestellung kontrollieren.', 'trilacheck' ); ?></p></div></div></section>
		<section class="tc-contract-faq"><h2><?php esc_html_e( 'Häufige Fragen zu Handys mit Vertrag', 'trilacheck' ); ?></h2><details><summary><?php esc_html_e( 'Ist ein Bundle günstiger als ein separater Kauf?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Das hängt vom konkreten Angebot ab. Vergleiche die Gesamtkosten des Bundles mit dem Gerätepreis und einem separat gewählten SIM-only-Tarif.', 'trilacheck' ); ?></p></details><details><summary><?php esc_html_e( 'Wer ist mein Vertragspartner?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Der Vertrag kommt mit dem im Angebot genannten Anbieter zustande. Trilacheck unterstützt dich beim Vergleich und leitet dich zum Abschluss weiter.', 'trilacheck' ); ?></p></details></section>
	</div>
</article>
<?php get_footer(); ?>

