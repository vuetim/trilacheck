<?php
/** Optional comparison reassurance strip; separate from existing page content.
 * @package Trilacheck
 */
defined( 'ABSPATH' ) || exit;
$tc_page = get_queried_object();
$tc_topics = array(
	'gas' => 'Gastarife und Preise vergleichen',
	'strom' => 'Stromtarife und Preise vergleichen',
	'dsl' => 'Internetangebote transparent vergleichen',
	'mobilfunk' => 'Passende Handytarife vergleichen',
	'handy-mit-vertrag' => 'Handys und Vertragskosten vergleichen',
	'reise' => 'Reiseangebote und Leistungen vergleichen',
	'mietwagen' => 'Mietwagenpreise und Bedingungen vergleichen',
	'girokonto' => 'Kontogebühren und Leistungen vergleichen',
	'auto-fahrzeuge' => 'Kfz-Versicherungen und Leistungen vergleichen',
	'versicherungen' => 'Versicherungsleistungen und Beiträge vergleichen',
	'krankenversicherungen' => 'Krankenversicherungen und Leistungen vergleichen',
	'vorsorge-versicherungen' => 'Vorsorgeangebote und Leistungen vergleichen',
	'sachversicherungen' => 'Sachversicherungen und Leistungen vergleichen',
);
$tc_topic = $tc_topics[ $tc_page->post_name ] ?? 'Passende Handytarife vergleichen';
?>
<div class="tc-comparison-trust" role="region" aria-label="<?php esc_attr_e( 'Hinweise zum Vergleich', 'trilacheck' ); ?>">
	<div class="tc-container tc-comparison-trust__inner">
		<ul>
			<li><span aria-hidden="true">✓</span><?php echo esc_html( $tc_topic ); ?></li>
			<li><span aria-hidden="true">✓</span><?php esc_html_e( '100 % kostenlos vergleichen', 'trilacheck' ); ?></li>
			<?php if ( is_ssl() ) : ?>
				<li><span aria-hidden="true">✓</span><?php esc_html_e( 'SSL-geschützte Verbindung', 'trilacheck' ); ?></li>
			<?php endif; ?>
		</ul>
		<img class="tc-comparison-trust__badge" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/trilacheck-vergleich-badge.svg' ); ?>" width="106" height="106" alt="<?php esc_attr_e( 'trilacheck.de – Tarifvergleich', 'trilacheck' ); ?>">
	</div>
</div>
