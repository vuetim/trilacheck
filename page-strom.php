<?php
/**
 * Electricity comparison landing page.
 *
 * @package Trilacheck
 */

get_header();
?>

<div class="tc-power-page">
	<header class="tc-power-hero tc-comparison-hero">
		<div class="tc-container tc-power-hero__inner">
			<div class="tc-power-hero__content">
				<p class="tc-power-eyebrow"><?php esc_html_e( 'Energie vergleichen', 'trilacheck' ); ?></p>
				<h1><?php esc_html_e( 'Stromtarife vergleichen', 'trilacheck' ); ?></h1>
				<p class="tc-power-lead"><?php esc_html_e( 'Finde Stromtarife für deinen Wohnort und vergleiche Preise, Laufzeiten und Tarifbedingungen übersichtlich.', 'trilacheck' ); ?></p>
				<p class="tc-power-saving"><span><?php esc_html_e( 'Bis zu', 'trilacheck' ); ?></span><strong>850 €</strong><b><?php esc_html_e( 'sparen', 'trilacheck' ); ?><sup>1</sup></b></p>
				<ul class="tc-power-benefits">
					<li><?php esc_html_e( 'Tarife passend zu Postleitzahl und Verbrauch', 'trilacheck' ); ?></li>
					<li><?php esc_html_e( 'Kosten und Vertragsdetails im Blick behalten', 'trilacheck' ); ?></li>
					<li><?php esc_html_e( 'Auch Ökostrom-Angebote vergleichen', 'trilacheck' ); ?></li>
				</ul>
				<a class="tc-power-hero__cta" href="#stromvergleich"><?php esc_html_e( 'Stromtarife vergleichen', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
				<div class="tc-power-banner">
					<a href="https://a.check24.net/misc/click.php?pid=262971&amp;aid=306&amp;deep=stromanbieter-wechseln&amp;cat=1" target="_blank" rel="sponsored noopener" aria-label="<?php esc_attr_e( 'Stromtarife beim Vergleichspartner finden (öffnet in einem neuen Tab)', 'trilacheck' ); ?>">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/heroes/trilacheck-hero-strom.webp' ); ?>" alt="" width="1792" height="1024" decoding="async">
						<strong class="tc-power-banner__title"><?php esc_html_e( 'Stromtarife vergleichen', 'trilacheck' ); ?></strong>
						<span class="tc-power-banner__saving"><span><?php esc_html_e( 'Bis zu', 'trilacheck' ); ?></span><strong>850 €</strong><span><?php esc_html_e( 'sparen', 'trilacheck' ); ?><sup>1</sup></span></span>
						<span class="tc-power-banner__button"><?php esc_html_e( 'Tarif finden', 'trilacheck' ); ?></span>
					</a>
				</div>
			</div>
			<div class="tc-power-hero__media tc-power-hero-offer">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/heroes/trilacheck-hero-strom.webp' ); ?>" alt="" width="1792" height="1024" fetchpriority="high">
				<div class="tc-power-hero-offer__calculator" role="region" aria-label="<?php esc_attr_e( 'CHECK24 Strom-Kurzrechner', 'trilacheck' ); ?>">
					<div id="c24pp-power-widget63313" style="width: 300px; max-width: 100%; min-height: 220px;" data-target="_self" data-whitelabel="yes" data-form="https://www.check24.net/strom-vergleich/"></div>
					<noscript><p><a href="https://a.check24.net/misc/click.php?pid=262971&amp;aid=305&amp;deep=stromanbieter-wechseln&amp;cat=1" rel="sponsored"><?php esc_html_e( 'Stromtarife direkt bei CHECK24 vergleichen', 'trilacheck' ); ?></a></p></noscript>
				</div>
			</div>
		</div>
	<?php get_template_part( 'template-parts/comparison-trust' ); ?>
	</header>

	<section id="stromvergleich" class="tc-container tc-power-widget" aria-labelledby="tc-power-widget-title">
		<div class="tc-power-heading">
			<p><?php esc_html_e( 'In wenigen Schritten', 'trilacheck' ); ?></p>
			<h2 id="tc-power-widget-title"><?php esc_html_e( 'Stromvergleich starten', 'trilacheck' ); ?></h2>
			<span><?php esc_html_e( 'Postleitzahl und Jahresverbrauch eingeben, Angebote prüfen und den passenden Tarif auswählen.', 'trilacheck' ); ?></span>
		</div>
		<?php echo do_shortcode( '[trilacheck_power]' ); ?>
	</section>

	<div class="tc-container tc-power-content">
		<section aria-labelledby="tc-power-costs-title">
			<h2 id="tc-power-costs-title"><?php esc_html_e( 'Stromkosten berechnen – so setzt sich der Strompreis zusammen', 'trilacheck' ); ?></h2>
			<p><?php esc_html_e( 'Die jährlichen Stromkosten ergeben sich aus dem Verbrauch, dem Arbeitspreis pro Kilowattstunde (kWh) und dem festen Grundpreis.', 'trilacheck' ); ?></p>
			<p><strong><?php esc_html_e( 'Die einfache Formel:', 'trilacheck' ); ?></strong><br><?php esc_html_e( 'Jahresverbrauch (kWh) × Arbeitspreis (€/kWh) + jährlicher Grundpreis = jährliche Stromkosten.', 'trilacheck' ); ?></p>
			<p><?php esc_html_e( 'Je nach Tarif können zusätzlich Boni und weitere Vertragsbedingungen den effektiven Preis im ersten Jahr beeinflussen.', 'trilacheck' ); ?></p>
			<p><strong><?php esc_html_e( 'Stromtarife für deinen Wohnort vergleichen', 'trilacheck' ); ?></strong><br><?php esc_html_e( 'Gib deine Postleitzahl und deinen Jahresverbrauch in den Stromvergleich ein. Über den integrierten CHECK24-Tarifvergleich kannst du verfügbare Angebote und ihre Konditionen prüfen.', 'trilacheck' ); ?></p>
			<p><?php esc_html_e( 'Die angezeigten Preise hängen unter anderem von deinem Wohnort, deinem Verbrauch und den verfügbaren Tarifen ab.', 'trilacheck' ); ?></p>
		</section>

		<section class="tc-power-intro">
			<p class="tc-power-eyebrow"><?php esc_html_e( 'Bewusst vergleichen', 'trilacheck' ); ?></p>
			<h2><?php esc_html_e( 'Stromanbieter wechseln und laufende Kosten prüfen', 'trilacheck' ); ?></h2>
			<p><?php esc_html_e( 'Ein Stromvergleich kann zeigen, ob für deinen Wohnort günstigere oder passendere Tarife verfügbar sind. Wie groß ein möglicher Preisunterschied ist, hängt unter anderem von Region, Verbrauch, Vertragsbedingungen und dem gewählten Tarif ab.', 'trilacheck' ); ?></p>
			<p><?php esc_html_e( 'Vor einem Wechsel solltest du die Laufzeit, Kündigungsfrist und Preisgarantie deines aktuellen Vertrags prüfen. Berücksichtige beim neuen Angebot nicht nur den monatlichen Abschlag, sondern die Gesamtkosten über die vorgesehene Vertragsdauer.', 'trilacheck' ); ?></p>
		</section>

		<section aria-labelledby="tc-power-how-title">
			<h2 id="tc-power-how-title"><?php esc_html_e( 'So funktioniert der Stromvergleich', 'trilacheck' ); ?></h2>
			<div class="tc-power-steps">
				<div><span>1</span><h3><?php esc_html_e( 'Daten eingeben', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Trage deine Postleitzahl und deinen ungefähren Jahresverbrauch ein.', 'trilacheck' ); ?></p></div>
				<div><span>2</span><h3><?php esc_html_e( 'Tarife prüfen', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Vergleiche Gesamtpreis, Laufzeit, Kündigungsfrist, Preisgarantie und Bonusbedingungen.', 'trilacheck' ); ?></p></div>
				<div><span>3</span><h3><?php esc_html_e( 'Angebot wählen', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Für den Abschluss wirst du zum Vergleichspartner oder Anbieter weitergeleitet.', 'trilacheck' ); ?></p></div>
			</div>
		</section>

		<section>
			<h2><?php esc_html_e( 'Worauf du bei Stromtarifen achten solltest', 'trilacheck' ); ?></h2>
			<div class="tc-power-criteria">
				<article><h3><?php esc_html_e( 'Gesamtkosten', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Vergleiche Grundpreis und Arbeitspreis zusammen. Ein niedriger Abschlag allein sagt wenig über die tatsächlichen Jahreskosten aus.', 'trilacheck' ); ?></p></article>
				<article><h3><?php esc_html_e( 'Laufzeit & Kündigung', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Kurze Laufzeiten und faire Kündigungsfristen sorgen dafür, dass du auf Marktveränderungen flexibler reagieren kannst.', 'trilacheck' ); ?></p></article>
				<article><h3><?php esc_html_e( 'Preisgarantie', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Prüfe genau, wie lange die Garantie gilt und welche Preisbestandteile davon ausgenommen sind.', 'trilacheck' ); ?></p></article>
				<article><h3><?php esc_html_e( 'Bonusbedingungen', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Achte darauf, wann ein Bonus ausgezahlt wird und welche Voraussetzungen dafür erfüllt sein müssen.', 'trilacheck' ); ?></p></article>
			</div>
		</section>

		<section class="tc-power-note">
			<div class="tc-power-note__icon" aria-hidden="true">↗</div>
			<div><h2><?php esc_html_e( 'Flexibler Wechsel bei Preisänderungen', 'trilacheck' ); ?></h2><p><?php esc_html_e( 'Bei einer Preisänderung besteht grundsätzlich ein Sonderkündigungsrecht; gesetzlich geregelte Ausnahmen können gelten. Die Kündigung muss rechtzeitig beim Lieferanten eingehen. Prüfe deshalb das Schreiben deines Anbieters und die dort genannte Frist genau.', 'trilacheck' ); ?></p></div>
		</section>

		<section class="tc-power-faq" aria-labelledby="tc-power-faq-title">
			<h2 id="tc-power-faq-title"><?php esc_html_e( 'Häufige Fragen zum Stromanbieterwechsel', 'trilacheck' ); ?></h2>
			<details><summary><?php esc_html_e( 'Welche Angaben brauche ich für den Vergleich?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'In der Regel genügen zunächst deine Postleitzahl und der jährliche Stromverbrauch. Den Verbrauch findest du auf deiner letzten Jahresabrechnung.', 'trilacheck' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Wird der Strom beim Wechsel unterbrochen?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Der Lieferantenwechsel ist ein organisatorischer Vorgang. Das örtliche Stromnetz und der gesetzlich geregelte Versorgungsrahmen bleiben bestehen.', 'trilacheck' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Wer kündigt den alten Vertrag?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Beim regulären Wechsel übernimmt dies häufig der neue Lieferant. Bei einer Sonderkündigung, etwa wegen einer Preisänderung, solltest du die Kündigung vorsorglich selbst und fristgerecht erklären.', 'trilacheck' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Schließe ich den Stromvertrag bei TrilaCheck ab?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Nein. Trilacheck stellt den Vergleich bereit. Für einen Abschluss wirst du zum jeweiligen Vergleichspartner oder Anbieter weitergeleitet.', 'trilacheck' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Was ist der Unterschied zwischen Grundpreis und Arbeitspreis?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Der Grundpreis ist ein fester Betrag, der unabhängig vom Verbrauch anfällt. Der Arbeitspreis wird pro verbrauchter Kilowattstunde (kWh) berechnet. Zusammen ergeben beide die Stromkosten vor möglichen Boni.', 'trilacheck' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Ist der Stromvergleich kostenlos?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Ja. Die Nutzung des Stromvergleichs ist für dich kostenlos und unverbindlich. Bei einem erfolgreichen Abschluss können wir eine Provision erhalten; dadurch entstehen dir keine zusätzlichen Kosten.', 'trilacheck' ); ?></p></details>
		</section>

		<div class="tc-power-final-cta">
			<div><strong><?php esc_html_e( 'Bereit für deinen Stromvergleich?', 'trilacheck' ); ?></strong><p><?php esc_html_e( 'Prüfe verfügbare Tarife für deinen Wohnort.', 'trilacheck' ); ?></p></div>
			<a href="#stromvergleich"><?php esc_html_e( 'Vergleich starten', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
		</div>
		<p class="tc-power-disclaimer"><sup>1</sup> <?php esc_html_e( 'Die tatsächliche Ersparnis hängt unter anderem von Wohnort, Verbrauch, bisherigem Tarif und gewähltem Angebot ab.', 'trilacheck' ); ?></p>
	</div>
</div>

<?php get_footer(); ?>
