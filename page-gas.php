<?php
/** Gas comparison page. @package Trilacheck */
get_header();
?>
<div class="tc-gas-page">
	<header class="tc-gas-hero tc-comparison-hero">
		<div class="tc-container tc-gas-hero__inner">
			<div class="tc-gas-hero__content">
				<p class="tc-gas-eyebrow"><?php esc_html_e( 'Energie vergleichen', 'trilacheck' ); ?></p>
				<h1><?php esc_html_e( 'Gastarife vergleichen', 'trilacheck' ); ?></h1>
				<p class="tc-gas-lead"><?php esc_html_e( 'Gasangebote für deinen Wohnort vergleichen und Tarifdetails transparent prüfen.', 'trilacheck' ); ?></p>
				<div class="tc-gas-saving"><span><?php esc_html_e( 'Bis zu', 'trilacheck' ); ?></span><strong>1.250 €</strong><b><?php esc_html_e( 'sparen', 'trilacheck' ); ?><sup>1</sup></b></div>
				<ul><li><?php esc_html_e( 'Mehr als 850 Gasanbieter im Vergleich', 'trilacheck' ); ?></li><li><?php esc_html_e( 'Bis zu 290 € Sofortbonus möglich', 'trilacheck' ); ?><sup>1</sup></li><li><?php esc_html_e( 'Laufzeit und Preisgarantie vergleichen', 'trilacheck' ); ?></li></ul>
				<a href="#gasvergleich"><?php esc_html_e( 'Gastarife vergleichen', 'trilacheck' ); ?><span aria-hidden="true">→</span></a>
				<div class="tc-power-banner">
					<a href="https://a.check24.net/misc/click.php?pid=262971&amp;aid=317&amp;deep=gasanbieter-wechseln&amp;cat=3" target="_blank" rel="sponsored noopener" aria-label="<?php esc_attr_e( 'Gastarife beim Vergleichspartner finden (öffnet in einem neuen Tab)', 'trilacheck' ); ?>">
						<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/heroes/trilacheck-hero-gas.webp' ) ); ?>" alt="" width="1792" height="1024" decoding="async">
						<strong class="tc-power-banner__title"><?php esc_html_e( 'Gastarife vergleichen', 'trilacheck' ); ?></strong>
						<span class="tc-power-banner__saving"><span><?php esc_html_e( 'Bis zu', 'trilacheck' ); ?></span><strong>1.250 €</strong><span><?php esc_html_e( 'sparen', 'trilacheck' ); ?><sup>1</sup></span></span>
						<span class="tc-power-banner__button"><?php esc_html_e( 'Tarif finden', 'trilacheck' ); ?></span>
					</a>
				</div>
			</div>
			<div class="tc-gas-hero__media tc-gas-hero-offer">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/heroes/trilacheck-hero-gas.webp' ); ?>" alt="" width="1792" height="1024" fetchpriority="high">
				<div class="tc-power-hero-offer__calculator" role="region" aria-label="<?php esc_attr_e( 'Gas-Kurzrechner', 'trilacheck' ); ?>">
					<div id="c24pp-gas-widget95444" style="width:300px;max-width:100%;min-height:220px" data-target="_self" data-whitelabel="yes" data-form="https://www.check24.net/gasanbieter-vergleich/"></div>
					<noscript><p><a href="https://a.check24.net/misc/click.php?pid=262971&amp;aid=317&amp;deep=gasanbieter-wechseln&amp;cat=3" rel="sponsored"><?php esc_html_e( 'Gastarife direkt beim Partner vergleichen', 'trilacheck' ); ?></a></p></noscript>
				</div>
			</div>
		</div>
	<?php get_template_part( 'template-parts/comparison-trust' ); ?>
	</header>
	<section id="gasvergleich" class="tc-container tc-gas-widget" aria-labelledby="tc-gas-widget-title">
		<div class="tc-gas-heading"><p><?php esc_html_e( 'Kostenlos vergleichen', 'trilacheck' ); ?></p><h2 id="tc-gas-widget-title"><?php esc_html_e( 'Gasvergleich starten', 'trilacheck' ); ?></h2><span><?php esc_html_e( 'Postleitzahl, Wohnfläche oder Jahresverbrauch eingeben und verfügbare Tarife prüfen.', 'trilacheck' ); ?></span></div>
		<?php echo do_shortcode( '[trilacheck_gas]' ); ?>
	</section>
	<section class="tc-container tc-gas-providers" aria-labelledby="tc-gas-providers-title">
		<div><p><?php esc_html_e( 'Anbieterauswahl', 'trilacheck' ); ?></p><h2 id="tc-gas-providers-title"><?php esc_html_e( 'Zahlreiche Gasanbieter vergleichen', 'trilacheck' ); ?></h2></div>
		<div class="tc-gas-providers__track" role="list"><?php get_template_part( 'template-parts/provider-logos', null, array( 'group' => 'gas' ) ); ?></div>
	</section>
	<div class="tc-container tc-gas-content">
		<section aria-labelledby="tc-gas-costs-title">
			<h2 id="tc-gas-costs-title"><?php esc_html_e( 'Gaskosten berechnen – so setzt sich der Gaspreis zusammen', 'trilacheck' ); ?></h2>
			<p><?php esc_html_e( 'Die jährlichen Gaskosten setzen sich aus deinem Gasverbrauch in Kilowattstunden (kWh), dem Arbeitspreis und dem festen Grundpreis zusammen.', 'trilacheck' ); ?></p>
			<p><strong><?php esc_html_e( 'Die einfache Formel:', 'trilacheck' ); ?></strong><br><?php esc_html_e( 'Jahresverbrauch (kWh) × Arbeitspreis (€/kWh) + jährlicher Grundpreis = jährliche Gaskosten.', 'trilacheck' ); ?></p>
			<p><?php esc_html_e( 'Auch Bonuszahlungen, Preisgarantien und Vertragslaufzeiten können beeinflussen, welcher Gastarif langfristig günstiger ist.', 'trilacheck' ); ?></p>
			<p><strong><?php esc_html_e( 'Gastarife für deinen Wohnort vergleichen', 'trilacheck' ); ?></strong><br><?php esc_html_e( 'Gib deine Postleitzahl und deinen Jahresverbrauch in den Gasvergleich ein. Über den integrierten CHECK24-Tarifvergleich kannst du verfügbare Angebote, Preise und Vertragsbedingungen prüfen.', 'trilacheck' ); ?></p>
		</section>
		<section><p class="tc-gas-eyebrow"><?php esc_html_e( 'Tarife bewusst prüfen', 'trilacheck' ); ?></p><h2><?php esc_html_e( 'Gasanbieter wechseln und mögliche Ersparnis nutzen', 'trilacheck' ); ?></h2><p><?php esc_html_e( 'Die Preise von Gasanbietern können sich selbst innerhalb derselben Region unterscheiden. Ein Vergleich kann deshalb zeigen, ob ein anderer Tarif besser zu deinem Verbrauch und deinen gewünschten Vertragsbedingungen passt.', 'trilacheck' ); ?></p><p><?php esc_html_e( 'Prüfe vor einem Wechsel die Mindestvertragslaufzeit und Kündigungsfrist deines bisherigen Vertrags. Beim neuen Angebot zählen neben dem Preis auch Preisgarantie, Vertragslaufzeit, Bonusbedingungen und Zahlungsweise.', 'trilacheck' ); ?></p></section>
		<section><h2><?php esc_html_e( 'So funktioniert der Gasvergleich', 'trilacheck' ); ?></h2><div class="tc-gas-steps"><article><span>1</span><h3><?php esc_html_e( 'Verbrauch angeben', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Nutze den Jahresverbrauch aus deiner Abrechnung oder eine passende Schätzung.', 'trilacheck' ); ?></p></article><article><span>2</span><h3><?php esc_html_e( 'Angebote vergleichen', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Prüfe Gesamtpreis, Laufzeit, Kündigungsfrist, Preisgarantie und Boni.', 'trilacheck' ); ?></p></article><article><span>3</span><h3><?php esc_html_e( 'Tarif auswählen', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Für den Abschluss wirst du zum Vergleichspartner oder Anbieter weitergeleitet.', 'trilacheck' ); ?></p></article></div></section>
		<section class="tc-gas-note"><div class="tc-gas-note__icon" aria-hidden="true">↗</div><div class="tc-gas-note__content"><h2><?php esc_html_e( 'Bei einer Preiserhöhung Wechsel prüfen', 'trilacheck' ); ?></h2><p><?php esc_html_e( 'Bei einer Preisänderung besteht grundsätzlich ein Sonderkündigungsrecht; gesetzlich geregelte Ausnahmen können gelten. Achte auf die Mitteilung deines Anbieters und darauf, dass deine Kündigung rechtzeitig eingeht.', 'trilacheck' ); ?></p></div></section>
		<section class="tc-gas-faq"><h2><?php esc_html_e( 'Häufige Fragen zum Gasvergleich', 'trilacheck' ); ?></h2><details><summary><?php esc_html_e( 'Welche Daten brauche ich?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Für den ersten Vergleich benötigst du meist Postleitzahl und Jahresverbrauch. Den Verbrauch findest du auf der letzten Abrechnung.', 'trilacheck' ); ?></p></details><details><summary><?php esc_html_e( 'Schließe ich bei TrilaCheck ab?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Nein. Trilacheck unterstützt beim Vergleich. Der Abschluss erfolgt beim Vergleichspartner oder ausgewählten Anbieter.', 'trilacheck' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Wie kann ich meinen Gasverbrauch ermitteln?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Deinen Jahresverbrauch in Kilowattstunden (kWh) findest du auf der letzten Gasabrechnung. Zeigt dein Zähler Kubikmeter (m³) an, werden diese mit Brennwert und Zustandszahl in kWh umgerechnet. Beide Werte findest du ebenfalls auf der Abrechnung.', 'trilacheck' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Was ist der Unterschied zwischen Grundpreis und Arbeitspreis?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Der Grundpreis fällt unabhängig von deinem Verbrauch an. Der Arbeitspreis wird für jede verbrauchte Kilowattstunde (kWh) berechnet. Für den Vergleich solltest du beide Preisbestandteile zusammen betrachten.', 'trilacheck' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Wird die Gasversorgung beim Anbieterwechsel unterbrochen?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Bei einem regulären Anbieterwechsel wird die Gasversorgung nicht unterbrochen. Es wechselt der Lieferant; der bestehende Gasanschluss bleibt erhalten.', 'trilacheck' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Wann lohnt sich ein Gasanbieterwechsel?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Ein Vergleich kann sich lohnen, wenn dein Vertrag ausläuft, dein Anbieter die Preise ändert oder sich dein Verbrauch verändert. Prüfe die Gesamtkosten über die geplante Vertragsdauer sowie Kündigungsfrist, Preisgarantie und Bonusbedingungen.', 'trilacheck' ); ?></p></details>
		</section>
		<p class="tc-gas-disclaimer"><sup>1</sup> <?php esc_html_e( 'Mögliche Ersparnis und Boni hängen unter anderem von Wohnort, Verbrauch, bisherigem Tarif und gewähltem Angebot ab.', 'trilacheck' ); ?></p>
	</div>
</div>
<?php get_footer(); ?>
