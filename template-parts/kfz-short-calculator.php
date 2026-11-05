<?php
/** Official TARIFCHECK Kfz short calculator. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
?>
<div class="tc-kfz-short-card" role="region" aria-label="<?php esc_attr_e( 'Kfz-Versicherung Kurzrechner', 'trilacheck' ); ?>">
	<div style="width:300px;max-width:100%" id="tcpp-widget-kfz" data-form="https://www.tarifcheck.de/kfz-versicherung/ergebnis/"></div>
	<noscript><p><?php esc_html_e( 'Bitte aktiviere JavaScript für den Kfz-Kurzrechner. Den vollständigen Vergleich findest du weiter unten.', 'trilacheck' ); ?></p></noscript>
</div>
