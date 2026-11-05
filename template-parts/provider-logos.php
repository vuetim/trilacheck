<?php
/** Local provider logos for the existing comparison lists. @package Trilacheck */
defined( 'ABSPATH' ) || exit;
$provider_groups = array(
	'gas' => array(
		'vattenfall.png' => 'Vattenfall',
		'eon.png' => 'E.ON',
		'eprimo.png' => 'eprimo',
		'montana.png' => 'MONTANA',
		'simmplygreen-logo-gross.png' => 'SimplyGreen',
		'suedwag.png' => 'Süwag',
	),
	'dsl' => array(
		'tonlinedsl.jpg' => 'Telekom',
		'o2dsl.png' => 'O₂',
		'pyur-logo.png' => 'PŸUR',
		'vodafonedsl.png' => 'Vodafone',
		'mnet.png' => 'M-net',
		'ewedsl.png' => 'EWE',
		'congstardsl.png' => 'congstar',
		'swbdsl.png' => 'swb',
	),
);
foreach ( $provider_groups[ $args['group'] ?? '' ] ?? array() as $provider_file => $provider_name ) :
	?>
	<span role="listitem"><img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/providers/' . $provider_file ) ); ?>" alt="<?php echo esc_attr( $provider_name ); ?>" width="164" height="55" loading="lazy" decoding="async"></span>
<?php endforeach; ?>
