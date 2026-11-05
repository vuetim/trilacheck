	<?php if ( function_exists( 'trilacheck_landing_articles' ) ) { trilacheck_landing_articles(); } ?>
	<?php if ( ! is_page( array( 'dsl', 'strom', 'gas' ) ) && function_exists( 'trilacheck_page_faq' ) ) { trilacheck_page_faq(); } ?>
	<?php if ( function_exists( 'trilacheck_contextual_links' ) ) { trilacheck_contextual_links(); } ?>
	</main>

	<section class="tc-trust-strip" aria-labelledby="tc-trust-strip-title">
		<div class="tc-container">
			<div class="tc-trust-strip__heading"><p><?php esc_html_e( 'Einfach besser orientieren', 'trilacheck' ); ?></p><h2 id="tc-trust-strip-title"><?php esc_html_e( 'Vergleichen mit einem klaren Überblick', 'trilacheck' ); ?></h2></div>
			<div class="tc-trust-strip__grid">
				<article><span aria-hidden="true">01</span><h3><?php esc_html_e( 'Transparent', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Wir bündeln Vergleichsmöglichkeiten aus verschiedenen Bereichen. Preise, Leistungen und Bedingungen prüfst du im jeweiligen Vergleich und beim Anbieter.', 'trilacheck' ); ?></p></article>
				<article><span aria-hidden="true">02</span><h3><?php esc_html_e( 'Kostenlos für Nutzer', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Die Nutzung unserer Übersichten und Vergleichsrechner ist für dich kostenlos. Bei einem erfolgreichen Abschluss können wir eine Provision erhalten.', 'trilacheck' ); ?></p></article>
				<article><span aria-hidden="true">03</span><h3><?php esc_html_e( 'Sorgfältig aufbereitet', 'trilacheck' ); ?></h3><p><?php esc_html_e( 'Unsere Seiten erklären wichtige Vergleichskriterien verständlich und führen dich direkt zum passenden Rechner oder Vergleichspartner.', 'trilacheck' ); ?></p></article>
			</div>
		</div>
	</section>

	<footer class="tc-site-footer">
		<div class="tc-container tc-footer-main">
			<div class="tc-footer-brand">
				<div class="tc-footer-brand__logo">
					<?php if ( has_custom_logo() ) : ?><?php the_custom_logo(); ?><?php else : ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">trila<span>check</span></a><?php endif; ?>
				</div>
				<h2><?php esc_html_e( 'Wir sind TrilaCheck.de', 'trilacheck' ); ?></h2>
				<p class="tc-footer-brand__claim"><?php esc_html_e( 'Vergleichen. Wechseln. Clever sparen.', 'trilacheck' ); ?></p>
				<p><?php esc_html_e( 'Vergleiche Tarife für Strom, Gas, Internet, Mobilfunk, Reisen, Mietwagen, Konten und Versicherungen – übersichtlich an einem Ort.', 'trilacheck' ); ?></p>
				<p class="tc-footer-brand__team"><?php esc_html_e( 'Mit ♥ vom Trila Team.', 'trilacheck' ); ?></p>
			</div>

			<div class="tc-footer-column">
				<h2><?php esc_html_e( 'Vergleiche', 'trilacheck' ); ?></h2>
				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<?php wp_nav_menu( array( 'theme_location'=>'footer', 'container'=>'nav', 'container_aria_label'=>__( 'Vergleiche im Footer', 'trilacheck' ), 'depth'=>1 ) ); ?>
				<?php else : ?>
					<nav aria-label="<?php esc_attr_e( 'Vergleiche im Footer', 'trilacheck' ); ?>"><ul><li><a href="<?php echo esc_url(home_url('/vergleiche/')); ?>">Alle Vergleiche</a></li><li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Ratgeber &amp; Blog</a></li><li><a href="<?php echo esc_url(home_url('/strom/')); ?>">Strom</a></li><li><a href="<?php echo esc_url(home_url('/oekostrom/')); ?>">Ökostrom</a></li><li><a href="<?php echo esc_url(home_url('/gas/')); ?>">Gas</a></li><li><a href="<?php echo esc_url(home_url('/dsl/')); ?>">DSL</a></li><li><a href="<?php echo esc_url(home_url('/mobilfunk/')); ?>">Handytarife</a></li><li><a href="<?php echo esc_url(home_url('/reise/')); ?>">Reisen</a></li><li><a href="<?php echo esc_url(home_url('/versicherungen/')); ?>">Versicherungen</a></li></ul></nav>
				<?php endif; ?>
			</div>

			<div class="tc-footer-column tc-footer-column--legal">
				<h2><?php esc_html_e( 'Rechtliches', 'trilacheck' ); ?></h2>
				<?php if ( has_nav_menu( 'legal' ) ) : ?>
					<?php wp_nav_menu( array( 'theme_location'=>'legal', 'container'=>'nav', 'container_aria_label'=>__( 'Rechtliches', 'trilacheck' ), 'depth'=>1 ) ); ?>
				<?php else : ?>
					<nav aria-label="<?php esc_attr_e( 'Rechtliches', 'trilacheck' ); ?>"><ul><li><a href="<?php echo esc_url(home_url('/impressum/')); ?>">Impressum</a></li><li><a href="<?php echo esc_url(home_url('/datenschutz/')); ?>">Datenschutz</a></li><li><a href="<?php echo esc_url(home_url('/agb/')); ?>">AGB</a></li><li><a href="<?php echo esc_url(home_url('/vertrag-kuendigen/')); ?>">Vertrag kündigen</a></li><li><a href="<?php echo esc_url(home_url('/cookies/')); ?>">Cookie-Richtlinie</a></li></ul></nav>
				<?php endif; ?>
				<p class="tc-footer-cookie-settings"><a href="#" class="cmplz-show-banner"><?php esc_html_e( 'Cookie-Einstellungen', 'trilacheck' ); ?></a></p>
			</div>
		</div>

		<div class="tc-footer-bottom"><div class="tc-container"><p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Alle Rechte vorbehalten.', 'trilacheck' ); ?></p><a href="#top" aria-label="<?php esc_attr_e( 'Zum Seitenanfang', 'trilacheck' ); ?>">↑</a></div></div>
	</footer>

	<?php wp_footer(); ?>
	<script>
	document.addEventListener('click', function (event) {
		var trigger = event.target.closest('.cmplz-show-banner');
		if (!trigger) return;
		event.preventDefault();
		var manageButton = document.querySelector('#cmplz-manage-consent .cmplz-manage-consent');
		if (manageButton) manageButton.click();
	});
	</script>
</body>
</html>
