<?php
/**
 * Travel comparison landing page.
 *
 * @package Trilacheck
 */

get_header();
?>

<article class="tc-reise">
	<header class="tc-reise-hero tc-comparison-hero tc-comparison-hero--plain">
		<div class="tc-container tc-reise-hero__inner">
			<div>
				<p class="tc-reise-eyebrow"><?php esc_html_e( 'Reisen vergleichen', 'trilacheck' ); ?></p>
				<h1><?php esc_html_e( 'Pauschalreisen vergleichen und Urlaub finden', 'trilacheck' ); ?></h1>
				<p><?php esc_html_e( 'Vergleiche Reiseangebote für unterschiedliche Ziele, Reisezeiträume und Budgets. Die Buchung erfolgt anschließend beim jeweiligen Anbieter.', 'trilacheck' ); ?></p>
			</div>
			<ul aria-label="<?php esc_attr_e( 'Vorteile des Reisevergleichs', 'trilacheck' ); ?>">
				<li><?php esc_html_e( 'Reiseangebote übersichtlich vergleichen', 'trilacheck' ); ?></li>
				<li><?php esc_html_e( 'Filter passend zu deinen Reisewünschen', 'trilacheck' ); ?></li>
				<li><?php esc_html_e( 'Kostenloser Vergleich über unseren Partner', 'trilacheck' ); ?></li>
			</ul>
		</div>
	<?php get_template_part( 'template-parts/comparison-trust' ); ?>
	</header>

	<div class="tc-container tc-reise-widget">
		<?php echo do_shortcode( '[trilacheck_package destination="allgemein"]' ); ?>
	</div>

	<section class="tc-container tc-operators" aria-labelledby="tc-operators-title">
		<div class="tc-reise-heading">
			<p><?php esc_html_e( 'Große Auswahl', 'trilacheck' ); ?></p>
			<h2 id="tc-operators-title"><?php esc_html_e( 'Bekannte Reiseveranstalter im Vergleich', 'trilacheck' ); ?></h2>
		</div>
		<div class="tc-operators__track" role="list" aria-label="<?php esc_attr_e( 'Auswahl bekannter Reiseveranstalter', 'trilacheck' ); ?>">
			<?php foreach ( array( 'TUI', 'DERTOUR', 'alltours', 'schauinsland-reisen', 'ITS', 'FTI', 'Vtours', 'ANEX Tour' ) as $operator ) : ?>
				<div class="tc-operator" role="listitem"><span aria-hidden="true"><?php echo esc_html( substr( $operator, 0, 1 ) ); ?></span><strong><?php echo esc_html( $operator ); ?></strong></div>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="tc-container tc-reise-benefits" aria-labelledby="tc-reise-benefits-title">
		<div class="tc-reise-heading tc-reise-heading--center">
			<p><?php esc_html_e( 'Einfach vergleichen', 'trilacheck' ); ?></p>
			<h2 id="tc-reise-benefits-title"><?php esc_html_e( 'Deine Vorteile mit Trilacheck', 'trilacheck' ); ?></h2>
		</div>
		<div class="tc-reise-benefits__grid">
			<div><span>✓</span><strong><?php esc_html_e( 'Viele bekannte Reiseveranstalter', 'trilacheck' ); ?></strong><p><?php esc_html_e( 'Angebote verschiedener Veranstalter übersichtlich an einem Ort vergleichen.', 'trilacheck' ); ?></p></div>
			<div><span>✓</span><strong><?php esc_html_e( 'Sicher weitergeleitet', 'trilacheck' ); ?></strong><p><?php esc_html_e( 'Die Buchung und Zahlungsabwicklung erfolgen direkt beim ausgewählten Anbieter.', 'trilacheck' ); ?></p></div>
			<div><span>✓</span><strong><?php esc_html_e( 'Große Auswahl an Reisezielen', 'trilacheck' ); ?></strong><p><?php esc_html_e( 'Von Strandurlaub bis Städtereise passende Angebote und Unterkünfte entdecken.', 'trilacheck' ); ?></p></div>
		</div>
	</section>

	<div class="tc-container tc-reise-content">
		<section>
			<h2><?php esc_html_e( 'Pauschalreisen für unterschiedliche Urlaubswünsche', 'trilacheck' ); ?></h2>
			<p><?php esc_html_e( 'Ob Badeurlaub, Städtereise oder aktive Auszeit: Mit dem Reisevergleich kannst du Angebote anhand von Ziel, Zeitraum, Abflughafen und weiteren Kriterien eingrenzen. Prüfe vor der Buchung immer die Leistungen, Gepäckbestimmungen, Transferinformationen und Stornierungsbedingungen des jeweiligen Veranstalters.', 'trilacheck' ); ?></p>
		</section>

		<section>
			<h2><?php esc_html_e( 'So findest du ein passendes Reiseangebot', 'trilacheck' ); ?></h2>
			<p><?php esc_html_e( 'Gib dein gewünschtes Reiseziel, den Reisezeitraum und die Anzahl der Reisenden ein. Anschließend kannst du die Ergebnisse nach Preis, Verpflegung, Hotelkategorie oder Bewertung filtern. Ein günstiger Preis allein ist nicht entscheidend: Achte auch auf enthaltene Leistungen und die Lage der Unterkunft.', 'trilacheck' ); ?></p>
		</section>

		<section>
			<h2><?php esc_html_e( 'Pauschalreise, Hotel oder Ferienunterkunft?', 'trilacheck' ); ?></h2>
			<p><?php esc_html_e( 'Eine Pauschalreise kombiniert üblicherweise mehrere Reiseleistungen, beispielsweise Flug und Hotel. Wer flexibler planen möchte, kann Unterkunft und Anreise getrennt vergleichen. Ferienwohnungen und Ferienhäuser eignen sich besonders für Familien, Gruppen oder längere Aufenthalte. Welche Variante besser passt, hängt von deinen persönlichen Anforderungen ab.', 'trilacheck' ); ?></p>
		</section>

		<section>
			<h2><?php esc_html_e( 'Wichtige Hinweise vor der Buchung', 'trilacheck' ); ?></h2>
			<p><?php esc_html_e( 'Trilacheck stellt den Vergleich und redaktionelle Informationen bereit. Vertragspartner für die Reise wird der Anbieter, zu dem du für den Abschluss weitergeleitet wirst. Lies dessen Buchungsbedingungen, Datenschutzinformationen und Angaben zu möglichen Zusatzkosten sorgfältig durch.', 'trilacheck' ); ?></p>
		</section>

		<section class="tc-reise-faq" aria-labelledby="tc-reise-faq-title">
			<h2 id="tc-reise-faq-title"><?php esc_html_e( 'Häufige Fragen zu Pauschalreisen', 'trilacheck' ); ?></h2>
			<details><summary><?php esc_html_e( 'Was ist bei einer Pauschalreise enthalten?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Der genaue Leistungsumfang unterscheidet sich je nach Angebot. Häufig werden mindestens zwei Reiseleistungen kombiniert. Maßgeblich sind immer die Angaben des jeweiligen Veranstalters.', 'trilacheck' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Buche ich direkt bei Trilacheck?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Nein. Trilacheck unterstützt dich beim Vergleich. Für die Buchung wirst du zum ausgewählten Anbieter weitergeleitet.', 'trilacheck' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Entstehen durch den Vergleich zusätzliche Kosten?', 'trilacheck' ); ?></summary><p><?php esc_html_e( 'Für die Nutzung des Vergleichs berechnet Trilacheck dir keine Gebühr. Preise und mögliche Zusatzkosten werden vom jeweiligen Anbieter festgelegt.', 'trilacheck' ); ?></p></details>
		</section>
	</div>
</article>

<?php get_footer(); ?>

