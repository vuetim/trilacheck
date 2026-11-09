<?php
/** Direct vehicle insurance comparisons. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
?>
<section class="tc-insurance-calculators" aria-label="<?php esc_attr_e( 'Fahrzeugversicherungen vergleichen', 'trilacheck' ); ?>">
	<?php get_template_part( 'template-parts/comparison-support' ); ?>
	<details id="kfz-versicherung" class="tc-insurance-calculator tc-insurance-calculator--car">
		<summary><span><?php esc_html_e( 'Kfz-Versicherung', 'trilacheck' ); ?></span><small><?php esc_html_e( 'Autoversicherung vergleichen', 'trilacheck' ); ?></small></summary>
		<div class="tc-comparison-widget__frame"><div style="width:100%" id="tcpp-iframe-kfz"></div></div>
	</details>
	<details id="motorradversicherung" class="tc-insurance-calculator tc-insurance-calculator--motorcycle">
		<summary><span><?php esc_html_e( 'Motorradversicherung', 'trilacheck' ); ?></span><small><?php esc_html_e( 'Tarife für Motorräder vergleichen', 'trilacheck' ); ?></small></summary>
		<div class="tc-comparison-widget__frame"><div style="width:100%" id="tcpp-iframe-mot"></div></div>
	</details>
	<noscript><p><?php esc_html_e( 'Bitte aktiviere JavaScript, um die Versicherungsvergleiche zu verwenden.', 'trilacheck' ); ?></p></noscript>
</section>
