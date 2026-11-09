<?php
/**
 * Main mobile tariff comparison page.
 *
 * @package Trilacheck
 */

get_header();
?>

<article class="tc-mobile-page">
	<header class="tc-mobile-hero tc-comparison-hero">
		<div class="tc-container tc-mobile-hero__inner">
			<div class="tc-mobile-hero__content">
				<p class="tc-mobile-eyebrow"><?php esc_html_e( 'Mobilfunk', 'trilacheck' ); ?></p>
				<h1><?php esc_html_e( 'Handytarife im Vergleich', 'trilacheck' ); ?></h1>
				<p><?php esc_html_e( 'Vergleiche SIM-only-Tarife nach Datenvolumen, Netz, Laufzeit und weiteren Leistungen.', 'trilacheck' ); ?></p><?php get_template_part( 'template-parts/comparison-service' ); ?>
				<ul>
					<li><?php esc_html_e( 'Tarife verschiedener Mobilfunkanbieter vergleichen', 'trilacheck' ); ?></li>
					<li><?php esc_html_e( '5G, Laufzeit und Datenvolumen passend auswählen', 'trilacheck' ); ?></li>
					<li><?php esc_html_e( 'Tarifdetails vor dem Abschluss transparent prüfen', 'trilacheck' ); ?></li>
				</ul>
				<?php get_template_part( 'template-parts/service-banner', null, array( 'type' => 'mobile' ) ); ?>
			</div>
			<div class="tc-mobile-hero__media" aria-hidden="true">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/heroes/trilacheck-hero-handytarife.webp' ); ?>" alt="" width="1792" height="1024" fetchpriority="high">
			</div>
		</div>
	<?php get_template_part( 'template-parts/comparison-trust' ); ?>
	</header>

	<div class="tc-container tc-mobile-widget">
		<?php get_template_part( 'template-parts/direct-comparison', null, array( 'type' => 'mobile' ) ); ?>
	</div>

	<section class="tc-container tc-data-shortcuts" aria-labelledby="tc-data-shortcuts-title">
		<div class="tc-mobile-heading">
			<p><?php esc_html_e( 'Direkt zum passenden Vergleich', 'trilacheck' ); ?></p>
			<h2 id="tc-data-shortcuts-title"><?php esc_html_e( 'Handytarife nach Datenvolumen', 'trilacheck' ); ?></h2>
		</div>
		<div class="tc-data-shortcuts__grid">
			<a href="<?php echo esc_url( home_url( '/handytarife-5gb/' ) ); ?>"><strong>5 GB</strong><span><?php esc_html_e( 'Für Wenignutzer', 'trilacheck' ); ?></span><em><?php esc_html_e( 'Vergleichen', 'trilacheck' ); ?> →</em></a>
			<a href="<?php echo esc_url( home_url( '/handytarife-15gb/' ) ); ?>"><strong>15 GB</strong><span><?php esc_html_e( 'Für den Alltag', 'trilacheck' ); ?></span><em><?php esc_html_e( 'Vergleichen', 'trilacheck' ); ?> →</em></a>
			<a href="<?php echo esc_url( home_url( '/handytarife-50gb/' ) ); ?>"><strong>50 GB</strong><span><?php esc_html_e( 'Für Vielnutzer', 'trilacheck' ); ?></span><em><?php esc_html_e( 'Vergleichen', 'trilacheck' ); ?> →</em></a>
			<a href="<?php echo esc_url( home_url( '/handytarife-unlimited/' ) ); ?>"><strong>∞ GB</strong><span><?php esc_html_e( 'Unlimited-Tarife', 'trilacheck' ); ?></span><em><?php esc_html_e( 'Vergleichen', 'trilacheck' ); ?> →</em></a>
			<a href="<?php echo esc_url( home_url( '/tarife-fur-junge-leute/' ) ); ?>"><strong>Young</strong><span><?php esc_html_e( 'Tarife für junge Leute', 'trilacheck' ); ?></span><em><?php esc_html_e( 'Vergleichen', 'trilacheck' ); ?> →</em></a>
			<a href="<?php echo esc_url( home_url( '/prepaid-tarife/' ) ); ?>"><strong>Prepaid</strong><span><?php esc_html_e( 'Flexibel ohne Laufzeit', 'trilacheck' ); ?></span><em><?php esc_html_e( 'Vergleichen', 'trilacheck' ); ?> →</em></a>
		</div>
	</section>

	<div class="tc-container tc-mobile-content">
		<section>
			<h2><?php esc_html_e( 'Welcher Handytarif passt zu dir?', 'trilacheck' ); ?></h2>
			<p><?php esc_html_e( 'Ob Allnet-Flat, 5G, großes Datenvolumen oder ein monatlich kündbarer Tarif: Die passende Auswahl hängt davon ab, wie du dein Smartphone nutzt. Wer hauptsächlich Nachrichten schreibt und gelegentlich unterwegs surft, benötigt meist weniger Daten als Personen, die regelmäßig Videos streamen oder das Smartphone als Hotspot verwenden.', 'trilacheck' ); ?></p>
			<p><?php esc_html_e( 'Mobilfunkangebote nutzen in Deutschland in der Regel die Netze von Telekom, Vodafone oder Telefónica. Auch kleinere Marken können interessante Konditionen anbieten. Entscheidend sind neben dem Preis deshalb die Netzabdeckung an deinen häufigsten Aufenthaltsorten und die konkreten Vertragsbedingungen.', 'trilacheck' ); ?></p>
		</section>

		<section>
			<h2><?php esc_html_e( 'So funktioniert der Handytarifvergleich', 'trilacheck' ); ?></h2>
			<ol>
				<li><?php esc_html_e( 'Wähle das gewünschte Datenvolumen, die Laufzeit und weitere Tarifmerkmale.', 'trilacheck' ); ?></li>
				<li><?php esc_html_e( 'Filtere die Ergebnisse beispielsweise nach 5G, Netz oder monatlichen Kosten.', 'trilacheck' ); ?></li>
				<li><?php esc_html_e( 'Vergleiche Grundpreis, Anschlusskosten, Aktionen und Vertragsdetails.', 'trilacheck' ); ?></li>
				<li><?php esc_html_e( 'Für den Abschluss wirst du zum jeweiligen Anbieter oder Vergleichspartner weitergeleitet.', 'trilacheck' ); ?></li>
			</ol>
		</section>

		<section>
			<h2><?php esc_html_e( 'Wichtige Kriterien bei der Tarifwahl', 'trilacheck' ); ?></h2>
			<div class="tc-mobile-criteria">
				<div><h3><?php esc_html_e( 'Datenvolumen', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Orientiere dich an deinem tatsächlichen Verbrauch und plane etwas Reserve ein.', 'trilacheck' ); ?></p></div>
				<div><h3><?php esc_html_e( 'Netzabdeckung', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Prüfe die Netzabdeckung zu Hause, am Arbeitsplatz und auf häufigen Strecken.', 'trilacheck' ); ?></p></div>
				<div><h3><?php esc_html_e( 'Laufzeit', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Kurze Laufzeiten bieten Flexibilität, längere Verträge können andere Konditionen haben.', 'trilacheck' ); ?></p></div>
				<div><h3><?php esc_html_e( 'Gesamtkosten', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Berücksichtige Grundpreis, einmalige Kosten, Rabatte und den Preis nach Aktionsende.', 'trilacheck' ); ?></p></div>
			</div>
		</section>

		<section class="tc-mobile-faq" aria-labelledby="tc-mobile-faq-title">
			<h2 id="tc-mobile-faq-title"><?php esc_html_e( 'Häufige Fragen zu Handytarifen', 'trilacheck' ); ?></h2>
			<details><summary><?php esc_html_e( 'Wie viel Datenvolumen brauche ich?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Das hängt von deiner Nutzung ab. Messaging und Navigation benötigen meist weniger Daten als regelmäßiges Video-Streaming oder die Nutzung als Hotspot.', 'trilacheck' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Kann ich meine Rufnummer mitnehmen?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Eine Rufnummernmitnahme ist bei vielen Anbieterwechseln möglich. Prüfe die Bedingungen und Fristen beim bisherigen und beim neuen Anbieter.', 'trilacheck' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Schließe ich den Vertrag bei Trilacheck ab?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Nein. Trilacheck unterstützt dich beim Vergleich. Für den Abschluss wirst du zum ausgewählten Anbieter oder Vergleichspartner weitergeleitet.', 'trilacheck' ); ?></p></details>
		</section>

		<div class="tc-mobile-final-cta">
			<div><strong><?php esc_html_e( 'Bereit für den Tarifvergleich?', 'trilacheck' ); ?></strong><p><?php esc_html_e( 'Vergleiche jetzt verfügbare SIM-only-Tarife.', 'trilacheck' ); ?></p></div>
			<a href="#c24pp-mobileservice-iframe"><?php esc_html_e( 'Handytarife vergleichen', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
		</div>
	</div>
</article>

<?php get_footer(); ?>
