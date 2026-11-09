<?php
/**
 * Template Name: Ökostromvergleich
 * Dedicated renewable electricity comparison.
 * @package Trilacheck
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<div class="tc-power-page tc-eco-page">
	<header class="tc-power-hero tc-comparison-hero">
		<div class="tc-container tc-power-hero__inner">
			<div class="tc-power-hero__content">
				<p class="tc-power-eyebrow">Erneuerbare Energie vergleichen</p>
				<h1>Ökostromtarife vergleichen</h1>
				<p class="tc-power-lead">Finde Ökostromangebote für deinen Wohnort und vergleiche Preis, Herkunft und Vertragsbedingungen.</p><?php get_template_part( 'template-parts/comparison-service' ); ?>
				<ul class="tc-power-benefits">
					<li>Ökostromtarife nach Postleitzahl und Verbrauch prüfen</li>
					<li>Herkunftsnachweise und zusätzliche Umweltkriterien unterscheiden</li>
					<li>Grundpreis, Arbeitspreis und Bonusbedingungen vergleichen</li>
				</ul>
				<a class="tc-power-hero__cta" href="#oekostromvergleich">Ökostrom vergleichen <span aria-hidden="true">→</span></a>
				<div class="tc-power-banner">
					<a href="https://a.check24.net/misc/click.php?pid=262971&amp;aid=122&amp;deep=oekostrom" target="_blank" rel="sponsored noopener" aria-label="Ökostrom beim Vergleichspartner finden (öffnet in einem neuen Tab)">
						<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/heroes/trilacheck-oekostrom-solar-wind-900.jpg' ) ); ?>" alt="" width="900" height="450" decoding="async">
						<strong class="tc-power-banner__title">Ökostrom vergleichen</strong>
						<span class="tc-power-banner__saving"><span>Bis zu</span><strong>850 €</strong><span>sparen<sup>1</sup></span></span>
						<span class="tc-power-banner__button">Tarif finden</span>
					</a>
				</div>
			</div>
			<div class="tc-power-hero__media tc-power-hero-offer">
				<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/heroes/trilacheck-oekostrom-solar-wind.jpg' ) ); ?>" srcset="<?php echo esc_url( get_theme_file_uri( '/assets/images/heroes/trilacheck-oekostrom-solar-wind-900.jpg' ) ); ?> 900w, <?php echo esc_url( get_theme_file_uri( '/assets/images/heroes/trilacheck-oekostrom-solar-wind.jpg' ) ); ?> 1774w" sizes="(max-width: 759px) 100vw, 50vw" alt="Solarmodule und Windkraftanlagen zur Stromerzeugung aus erneuerbaren Energien" width="1774" height="887" fetchpriority="high" decoding="async">
				<div class="tc-power-hero-offer__calculator" role="region" aria-label="Ökostrom-Kurzrechner">
					<div id="c24pp-power-widget36586" style="width:300px;max-width:100%;min-height:220px" data-target="_self" data-whitelabel="yes" data-form="https://www.check24.net/oekostrom-vergleich/" data-eco="yes"></div>
					<noscript><p><a href="https://a.check24.net/misc/click.php?pid=262971&amp;aid=122&amp;deep=oekostrom" rel="sponsored">Ökostrom direkt beim Partner vergleichen</a></p></noscript>
				</div>
			</div>
		</div>
		<?php get_template_part( 'template-parts/comparison-trust' ); ?>
	</header>
	<section id="oekostromvergleich" class="tc-container tc-power-widget" aria-labelledby="tc-eco-widget-title">
		<div class="tc-power-heading"><p>Tarife für deinen Haushalt</p><h2 id="tc-eco-widget-title">Deinen Ökostromvergleich starten</h2><span>Postleitzahl und Jahresverbrauch eingeben und die Ökostromauswahl sowie die Tarifdetails im Rechner prüfen.</span></div>
		<?php get_template_part( 'template-parts/comparison-support' ); ?>
		<div style="width:100%" id="c24pp-power-iframe" data-scrollto="begin" data-eco="yes"></div>
		<noscript><p>Bitte aktiviere JavaScript für den Vergleichsrechner oder nutze den <a href="https://a.check24.net/misc/click.php?pid=262971&amp;aid=122&amp;deep=oekostrom" rel="sponsored">Ökostromvergleich beim Partner</a>.</p></noscript>
	</section>
	<div class="tc-container tc-power-content">
		<section><h2>Was unterscheidet Ökostrom von anderen Stromtarifen?</h2><p>Ökostrom wird aus erneuerbaren Energiequellen wie Wind, Sonne oder Wasserkraft erzeugt. Für die Auswahl eines Tarifs ist neben dem Preis wichtig, wie der Anbieter die Herkunft belegt und welche zusätzlichen Umweltkriterien das konkrete Angebot erfüllt.</p><p>Über das gemeinsame Stromnetz erhältst du keinen getrennten Stromfluss nur aus einer bestimmten Anlage. Der Unterschied liegt in der bilanziellen Beschaffung und Kennzeichnung des verkauften Stroms. Herkunftsnachweise dokumentieren die erneuerbare Herkunft; sie sind nicht mit einem zusätzlichen Förderbeitrag für neue Anlagen gleichzusetzen.</p><p>Das <a href="https://www.umweltbundesamt.de/themen/klima-energie/erneuerbare-energien/hintergrundwissen-oekostrom-stromkennzeichen" target="_blank" rel="noopener">Umweltbundesamt erklärt Stromkennzeichnung und Herkunftsnachweise</a> ausführlich.</p></section>
		<section><h2>Darauf kommt es bei der Ökostromauswahl an</h2><div class="tc-power-criteria">
			<article><h3>Herkunft und Nachweise</h3><p>Lies die Stromkennzeichnung und die Angaben zur Beschaffung. Eine grüne Produktbezeichnung allein erklärt noch nicht, aus welchen Quellen der Strom stammt.</p></article>
			<article><h3>Zusätzliche Umweltkriterien</h3><p>Wenn dir ein zusätzlicher Beitrag zur Energiewende wichtig ist, prüfe die Kriterien des jeweiligen Labels. Das Umweltbundesamt führt unter anderem Grüner Strom und ok-power als Umweltzeichen auf. Entscheidend ist die Zertifizierung des konkreten Tarifs.</p></article>
			<article><h3>Vergleichbare Jahreskosten</h3><p>Nutze für alle Angebote denselben Verbrauch. Rechne Grundpreis und verbrauchsabhängigen Arbeitspreis zusammen und prüfe, an welche Voraussetzungen ein Bonus gebunden ist.</p></article>
			<article><h3>Laufzeit und Preisgarantie</h3><p>Vergleiche Bindungsdauer, Kündigungsfrist und den Umfang einer Preisgarantie. Prüfe auch die Kosten nach einer Rabattphase und die Bedingungen für eine Verlängerung.</p></article>
		</div><p>Weitere Orientierung bietet die <a href="https://www.umweltbundesamt.de/oekostrom-0" target="_blank" rel="noopener">Übersicht des Umweltbundesamtes zu Ökostrom und Umweltzeichen</a>.</p></section>
		<section><h2>Den Wechsel zu Ökostrom vorbereiten</h2><div class="tc-power-steps">
			<div><span>1</span><h3>Verbrauch nachsehen</h3><p>Nimm deine letzte Jahresabrechnung zur Hand und prüfe, ob sich der Verbrauch durch neue Geräte oder einen veränderten Haushalt voraussichtlich ändert.</p></div>
			<div><span>2</span><h3>Tarif und Umweltkriterien prüfen</h3><p>Vergleiche die Kosten für deinen Wohnort und lies die Produktinformationen zur Herkunft und zu gegebenenfalls vorhandenen Labels.</p></div>
			<div><span>3</span><h3>Vertragsunterlagen kontrollieren</h3><p>Prüfe den gewünschten Lieferbeginn, die Laufzeit und die Kündigungsbedingungen vor dem Abschluss beim Vergleichspartner oder Anbieter.</p></div>
		</div></section>
		<section class="tc-power-faq"><h2>Häufige Fragen zu Ökostrom</h2>
			<details><summary>Ist Ökostrom immer teurer?</summary><p>Das lässt sich nicht pauschal sagen. Vergleiche die verfügbaren Angebote für deine Postleitzahl und deinen Verbrauch. Berücksichtige dabei Gesamtkosten und Bedingungen statt nur einen beworbenen Monatsbetrag.</p></details>
			<details><summary>Reicht ein Herkunftsnachweis für einen zusätzlichen Umweltnutzen?</summary><p>Er belegt die Herkunft des Stroms. Wenn du darüber hinaus die Förderung erneuerbarer Energien unterstützen möchtest, prüfe zusätzliche, nachvollziehbare Anforderungen des Tarifs oder eines Umweltlabels.</p></details>
			<details><summary>Ändert sich durch den Tarifwechsel meine Steckdose?</summary><p>Nein. Du nutzt weiter das vorhandene Stromnetz. Ein Ökostromvertrag betrifft die Beschaffung und Kennzeichnung der gelieferten Strommenge, nicht eine separate Leitung zu deinem Haushalt.</p></details>
			<details><summary>Wo schließe ich den Ökostromvertrag ab?</summary><p>TrilaCheck stellt den Vergleich bereit. Den konkreten Vertrag schließt du über den Vergleichspartner oder Anbieter ab; dort erhältst du die verbindlichen Tarif- und Vertragsinformationen.</p></details>
		</section>
		<div class="tc-power-final-cta"><div><h2>Passenden Ökostromtarif finden</h2><p>Preise und Umweltkriterien gemeinsam betrachten.</p></div><a href="#oekostromvergleich">Zum Ökostromvergleich <span aria-hidden="true">→</span></a></div>
		<p>Für einen breiteren Überblick kannst du auch <a href="<?php echo esc_url( home_url( '/strom/' ) ); ?>">alle Stromtarife vergleichen</a>.</p>
		<p class="tc-power-disclaimer"><sup>1</sup> Die beworbene Ersparnis ist ein mögliches Vergleichsbeispiel, keine Zusage für deinen Haushalt. Die tatsächliche Ersparnis hängt von Wohnort, Verbrauch, bisherigem Tarif und gewähltem Angebot ab.</p>
	</div>
</div>
<?php get_footer(); ?>
