<?php
/** DSL comparison page. @package Trilacheck */
get_header();
?>
<div class="tc-dsl-page">
	<header class="tc-dsl-hero tc-comparison-hero">
		<div class="tc-container tc-dsl-hero__inner">
			<div class="tc-dsl-hero__content">
				<p class="tc-dsl-eyebrow"><?php esc_html_e('Internet für Zuhause', 'trilacheck'); ?></p>
				<h1><?php esc_html_e('DSL-Tarife vergleichen', 'trilacheck'); ?></h1>
				<p class="tc-dsl-lead">
					<?php esc_html_e('Internetangebote für deine Adresse nach Geschwindigkeit, Kosten und Vertragsbedingungen vergleichen.', 'trilacheck'); ?>
				</p>
				<div class="tc-dsl-bonus"><span><?php esc_html_e('Bis zu', 'trilacheck'); ?></span><strong>370
						€</strong><b><?php esc_html_e('Sofortbonus', 'trilacheck'); ?><sup>1</sup></b></div>
				<ul>
					<li><?php esc_html_e('Mehr als 350 Anbieter vergleichen', 'trilacheck'); ?></li>
					<li><?php esc_html_e('Über 2.500 Tarife im Vergleich', 'trilacheck'); ?></li>
					<li><?php esc_html_e('DSL, Kabel und weitere Anschlussarten prüfen', 'trilacheck'); ?></li>
				</ul><a href="#dslvergleich"><?php esc_html_e('Internettarife vergleichen', 'trilacheck'); ?><span
						aria-hidden="true">→</span></a>
			</div>
			<div class="tc-dsl-hero__media" aria-hidden="true"><img
					src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/heroes/trilacheck-hero-dsl.webp'); ?>"
					alt="" width="1792" height="1024" fetchpriority="high"></div>
		</div>
	<?php get_template_part( 'template-parts/comparison-trust' ); ?>
	</header>
	<section id="dslvergleich" class="tc-container tc-dsl-widget" aria-labelledby="tc-dsl-widget-title">
		<div class="tc-dsl-heading">
			<p><?php esc_html_e('Verfügbarkeit prüfen', 'trilacheck'); ?></p>
			<h2 id="tc-dsl-widget-title"><?php esc_html_e('DSL- und Internettarife vergleichen', 'trilacheck'); ?>
			</h2>
			<span><?php esc_html_e('Adresse eingeben, verfügbare Geschwindigkeiten prüfen und passende Angebote vergleichen.', 'trilacheck'); ?></span>
		</div><?php echo do_shortcode('[trilacheck_dsl]'); ?>
	</section>
	<section class="tc-container tc-dsl-providers" aria-labelledby="tc-dsl-providers-title">
		<div>
			<p><?php esc_html_e('Anbieterauswahl', 'trilacheck'); ?></p>
			<h2 id="tc-dsl-providers-title">
				<?php esc_html_e('Zahlreiche Internetanbieter vergleichen', 'trilacheck'); ?></h2>
		</div>
		<div class="tc-dsl-providers__track" role="list"><span role="listitem">swb</span><span
				role="listitem">Vodafone</span><span role="listitem">Telekom</span><span
				role="listitem">1&amp;1</span><span role="listitem">O2</span><span role="listitem">PYUR</span></div>
	</section>
	<div class="tc-container tc-dsl-content">
		<section>
			<p class="tc-dsl-eyebrow"><?php esc_html_e('Anbieterwechsel planen', 'trilacheck'); ?></p>
			<h2><?php esc_html_e('DSL-Anbieter wechseln – schnell und gut vorbereitet', 'trilacheck'); ?></h2>
			<p><?php esc_html_e('Ein günstiger Monatspreis allein reicht für die Tarifwahl nicht aus. Einmalige Bereitstellungsgebühren, Routerkosten, Rabatte mit begrenzter Dauer und der Preis nach Aktionsende beeinflussen die Gesamtkosten. Der DSL-Vergleich hilft dir, verfügbare Angebote für deine Adresse übersichtlich gegenüberzustellen.', 'trilacheck'); ?>
			</p>
			<p><?php esc_html_e('Welche Geschwindigkeit sinnvoll ist, hängt von Haushaltsgröße und Nutzung ab. Streaming in hoher Auflösung, Videokonferenzen, Gaming und parallele Geräte benötigen in der Regel mehr Bandbreite als einfaches Surfen und E-Mail.', 'trilacheck'); ?>
			</p>
		</section>
		<section aria-labelledby="tc-dsl-costs-title">
			<h2 id="tc-dsl-costs-title">
				<?php esc_html_e('DSL-Kosten berechnen – den tatsächlichen Vertragspreis verstehen', 'trilacheck'); ?>
			</h2>
			<p><?php esc_html_e('Beim Vergleich von DSL- und Internettarifen zählt nicht nur der beworbene Monatspreis. Auch Anschlussgebühren, Routerkosten und zeitlich begrenzte Rabatte können die Gesamtkosten beeinflussen.', 'trilacheck'); ?>
			</p>
			<p><strong><?php esc_html_e('Worauf es bei den Gesamtkosten ankommt:', 'trilacheck'); ?></strong><br><?php esc_html_e('Monatliche Grundgebühren über die betrachtete Vertragsdauer + einmalige Kosten − anrechenbare Rabatte und Boni = Gesamtkosten.', 'trilacheck'); ?>
			</p>
			<p><?php esc_html_e('Achte besonders darauf, ob sich der monatliche Preis nach einer Aktionsphase erhöht und welche Kosten für Router, Bereitstellung oder Versand entstehen.', 'trilacheck'); ?>
			</p>
			<p><strong><?php esc_html_e('DSL-Tarife für deine Adresse vergleichen', 'trilacheck'); ?></strong><br><?php esc_html_e('Prüfe über den integrierten CHECK24-Tarifvergleich, welche Internetangebote und Geschwindigkeiten an deiner Adresse verfügbar sind. Vergleiche dabei Preise, Vertragslaufzeiten und mögliche Bonusbedingungen.', 'trilacheck'); ?>
			</p>
		</section>
		<section>
			<h2><?php esc_html_e('Worauf du beim Anbieterwechsel achten solltest', 'trilacheck'); ?></h2>
			<div class="tc-dsl-criteria">
				<article>
					<h3><?php esc_html_e('Verfügbarkeit', 'trilacheck'); ?></h3>
					<p><?php esc_html_e('Prüfe, welche Anschlussart und Geschwindigkeit an deiner genauen Adresse verfügbar sind.', 'trilacheck'); ?>
					</p>
				</article>
				<article>
					<h3><?php esc_html_e('Gesamtkosten', 'trilacheck'); ?></h3>
					<p><?php esc_html_e('Berücksichtige Grundpreis, Anschlussgebühr, Hardware, Versand und spätere Preisänderungen.', 'trilacheck'); ?>
					</p>
				</article>
				<article>
					<h3><?php esc_html_e('Laufzeit', 'trilacheck'); ?></h3>
					<p><?php esc_html_e('Kontrolliere Mindestlaufzeit, Kündigungsfrist und den frühestmöglichen Vertragsbeginn.', 'trilacheck'); ?>
					</p>
				</article>
				<article>
					<h3><?php esc_html_e('Router & Telefonie', 'trilacheck'); ?></h3>
					<p><?php esc_html_e('Prüfe, ob Hardware und Telefon-Flat enthalten, optional oder zusätzlich kostenpflichtig sind.', 'trilacheck'); ?>
					</p>
				</article>
			</div>
		</section>
		<section class="tc-dsl-note">
			<div class="tc-dsl-note__icon" aria-hidden="true">↔</div>
			<div class="tc-dsl-note__content">
				<h2><?php esc_html_e('Wechsel rechtzeitig einleiten', 'trilacheck'); ?></h2>
				<p><?php esc_html_e('Prüfe zuerst die Kündigungsfrist deines aktuellen Vertrags. Beim regulären Anbieterwechsel übernimmt der neue Anbieter häufig die Kündigung. Bei einer Sonderkündigung solltest du selbst handeln und die geltende Frist beachten.', 'trilacheck'); ?>
				</p>
			</div>
		</section>
		<section class="tc-dsl-faq">
			<h2><?php esc_html_e('Häufige Fragen zum DSL-Vergleich', 'trilacheck'); ?></h2>
			<details>
				<summary><?php esc_html_e('Welche Internetgeschwindigkeit brauche ich?', 'trilacheck'); ?></summary>
				<p><?php esc_html_e('Das hängt von Personenanzahl, parallelen Geräten und Anwendungen ab. Für Streaming, Homeoffice und Gaming ist meist mehr Bandbreite sinnvoll.', 'trilacheck'); ?>
				</p>
			</details>
			<details>
				<summary><?php esc_html_e('Kündigt TrilaCheck meinen alten Vertrag?', 'trilacheck'); ?></summary>
				<p><?php esc_html_e('Nein. Trilacheck stellt den Vergleich bereit. Der konkrete Wechselprozess erfolgt über den ausgewählten Anbieter oder Vergleichspartner.', 'trilacheck'); ?>
				</p>
			</details>
			<details>
				<summary><?php esc_html_e('Ist die angezeigte Geschwindigkeit garantiert?', 'trilacheck'); ?>
				</summary>
				<p><?php esc_html_e('Die tatsächlich verfügbare Geschwindigkeit hängt vom Anschluss und Standort ab. Maßgeblich sind die Verfügbarkeitsprüfung und Vertragsinformationen des Anbieters.', 'trilacheck'); ?>
				</p>
			</details>
			<details>
				<summary><?php esc_html_e('Was kostet ein DSL-Vertrag über 24 Monate?', 'trilacheck'); ?></summary>
				<p><?php esc_html_e('Addiere die monatlichen Grundgebühren für alle 24 Monate sowie einmalige Kosten für Anschluss, Router und Versand. Ziehe nur Rabatte und Boni ab, deren Voraussetzungen du erfüllst. Berücksichtige Preisänderungen nach einer Aktionsphase. Die Gesamtsumme geteilt durch 24 ergibt den durchschnittlichen Monatspreis.', 'trilacheck'); ?>
				</p>
			</details>
			<details>
				<summary>
					<?php esc_html_e('Was ist der Unterschied zwischen DSL, Kabel und Glasfaser?', 'trilacheck'); ?>
				</summary>
				<p><?php esc_html_e('DSL nutzt die Telefonleitung, Kabelinternet das TV-Kabelnetz. Bei einem Glasfaseranschluss bis in die Wohnung werden die Daten durchgehend über Glasfaser übertragen. Verfügbarkeit sowie Download- und Uploadgeschwindigkeiten hängen von deiner Adresse und dem gewählten Tarif ab.', 'trilacheck'); ?>
				</p>
			</details>
			<details>
				<summary><?php esc_html_e('Kann ich meine Festnetznummer beim Wechsel behalten?', 'trilacheck'); ?>
				</summary>
				<p><?php esc_html_e('In der Regel kannst du deine Festnetznummer beim Anbieterwechsel am selben Standort mitnehmen. Beauftrage die Rufnummernmitnahme beim neuen Anbieter und achte darauf, dass deine Vertragsdaten mit denen beim bisherigen Anbieter übereinstimmen. Kläre bei einem Umzug vorab, ob die Nummer übernommen werden kann.', 'trilacheck'); ?>
				</p>
			</details>
		</section>
		<p class="tc-dsl-disclaimer"><sup>1</sup>
			<?php esc_html_e('Ein möglicher Bonus hängt vom gewählten Angebot und dessen Bedingungen ab.', 'trilacheck'); ?>
		</p>
	</div>
</div>
<?php get_footer(); ?>