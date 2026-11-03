<?php
/**
 * Homepage Customizer settings.
 *
 * @package Trilacheck
 */

defined( 'ABSPATH' ) || exit;

function trilacheck_customize_home( $wp_customize ) {
	$wp_customize->add_section( 'tc_whatsapp', array(
		'title'    => __( 'Header: WhatsApp', 'trilacheck' ),
		'priority' => 29,
	) );
	$wp_customize->add_setting( 'tc_whatsapp_number', array(
		'default'           => '4915207415547',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'tc_whatsapp_number', array(
		'section'     => 'tc_whatsapp',
		'label'       => __( 'WhatsApp-Nummer', 'trilacheck' ),
		'description' => __( 'Mit internationaler Vorwahl, z. B. +49. Der Button wird nach Eingabe der Nummer aktiviert.', 'trilacheck' ),
		'type'        => 'tel',
	) );

	$wp_customize->add_section(
		'tc_home_hero',
		array(
			'title'       => __( 'Startseite: Hero-Slider', 'trilacheck' ),
			'description' => __( 'Inhalte der drei Startseiten-Slides. Kurze, konkrete Texte funktionieren am besten.', 'trilacheck' ),
			'priority'    => 30,
		)
	);

	$defaults = array(
		1 => array(
			'eyebrow' => __( 'Energie', 'trilacheck' ),
			'title'   => __( 'Stromtarife vergleichen und sparen', 'trilacheck' ),
			'text'    => __( 'Vergleiche verfügbare Stromtarife passend zu deinem Verbrauch und Wohnort.', 'trilacheck' ),
			'button'  => __( 'Strom vergleichen', 'trilacheck' ),
			'url'     => '/strom/',
		),
		2 => array(
			'eyebrow' => __( 'Energie', 'trilacheck' ),
			'title'   => __( 'Gastarife übersichtlich vergleichen', 'trilacheck' ),
			'text'    => __( 'Finde einen Gastarif, der zu deinem Haushalt und deinem Verbrauch passt.', 'trilacheck' ),
			'button'  => __( 'Gas vergleichen', 'trilacheck' ),
			'url'     => '/gas/',
		),
		3 => array(
			'eyebrow' => __( 'Gut abgesichert', 'trilacheck' ),
			'title'   => __( 'Versicherungen passend vergleichen', 'trilacheck' ),
			'text'    => __( 'Vergleiche Leistungen, Beiträge und wichtige Tarifdetails transparent.', 'trilacheck' ),
			'button'  => __( 'Versicherungen ansehen', 'trilacheck' ),
			'url'     => '/versicherungen/',
		),
		4 => array(
			'eyebrow' => __( 'Internet für Zuhause', 'trilacheck' ),
			'title'   => __( 'DSL-Tarife für dein Zuhause finden', 'trilacheck' ),
			'text'    => __( 'Vergleiche Geschwindigkeit, Verfügbarkeit und monatliche Kosten.', 'trilacheck' ),
			'button'  => __( 'DSL vergleichen', 'trilacheck' ),
			'url'     => '/dsl/',
		),
		5 => array(
			'eyebrow' => __( 'Mobilfunk', 'trilacheck' ),
			'title'   => __( 'Handytarife für deinen Alltag', 'trilacheck' ),
			'text'    => __( 'Wähle Datenvolumen, Netz und Laufzeit passend zu deinen Bedürfnissen.', 'trilacheck' ),
			'button'  => __( 'Handytarife vergleichen', 'trilacheck' ),
			'url'     => '/mobilfunk/',
		),
		6 => array(
			'eyebrow' => __( 'Reisen', 'trilacheck' ),
			'title'   => __( 'Reiseangebote entspannt vergleichen', 'trilacheck' ),
			'text'    => __( 'Plane deine nächste Reise übersichtlich und ohne unnötige Umwege.', 'trilacheck' ),
			'button'  => __( 'Reisen entdecken', 'trilacheck' ),
			'url'     => '/reise/',
		),
		7 => array(
			'eyebrow' => __( 'Mobil unterwegs', 'trilacheck' ),
			'title'   => __( 'Den passenden Mietwagen finden', 'trilacheck' ),
			'text'    => __( 'Vergleiche Mietwagenangebote für dein Reiseziel und deinen Zeitraum.', 'trilacheck' ),
			'button'  => __( 'Mietwagen vergleichen', 'trilacheck' ),
			'url'     => '/mietwagen/',
		),
		8 => array(
			'eyebrow' => __( 'Finanzen', 'trilacheck' ),
			'title'   => __( 'Girokonten transparent vergleichen', 'trilacheck' ),
			'text'    => __( 'Prüfe Konditionen und Leistungen verschiedener Kontomodelle.', 'trilacheck' ),
			'button'  => __( 'Konten vergleichen', 'trilacheck' ),
			'url'     => '/girokonto/',
		),
	);
	$colors = array( '#0b5052', '#8a4b08', '#173a72', '#315b91', '#5b3b8d', '#17686e', '#7b3f27', '#255a45' );

	foreach ( $defaults as $slide => $values ) {
		foreach ( array( 'eyebrow', 'title', 'text', 'button' ) as $field ) {
			$id = "tc_hero_{$slide}_{$field}";
			$wp_customize->add_setting(
				$id,
				array(
					'default'           => $values[ $field ],
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => 'refresh',
				)
			);
			$wp_customize->add_control(
				$id,
				array(
					'label'   => sprintf( __( 'Slide %1$d: %2$s', 'trilacheck' ), $slide, ucfirst( $field ) ),
					'section' => 'tc_home_hero',
					'type'    => 'text',
				)
			);
		}

		$url_id = "tc_hero_{$slide}_url";
		$wp_customize->add_setting(
			$url_id,
			array(
				'default'           => $values['url'],
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			$url_id,
			array(
				'label'   => sprintf( __( 'Slide %d: Link', 'trilacheck' ), $slide ),
				'section' => 'tc_home_hero',
				'type'    => 'url',
			)
		);

		$image_id = "tc_hero_{$slide}_image";
		$wp_customize->add_setting(
			$image_id,
			array(
				'default'           => 0,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				$image_id,
				array(
					'label'     => sprintf( __( 'Slide %d: Bild', 'trilacheck' ), $slide ),
					'section'   => 'tc_home_hero',
					'mime_type' => 'image',
				)
			)
		);

		$color_id = "tc_hero_{$slide}_color";
		$wp_customize->add_setting(
			$color_id,
			array(
				'default'           => $colors[ $slide - 1 ],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color_id,
				array(
					'label'   => sprintf( __( 'Slide %d: Farbe', 'trilacheck' ), $slide ),
					'section' => 'tc_home_hero',
				)
			)
		);
	}
}
add_action( 'customize_register', 'trilacheck_customize_home' );
