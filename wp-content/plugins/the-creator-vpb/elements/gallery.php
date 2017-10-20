<?php

/**
 Native Gallery shortcode support
**/
$tcvpb_elements['gallery'] = array(
	'name' => esc_html__('Gallery', 'the-creator-vpb' ),
	'description' => esc_html__('Gallery shortcode', 'the-creator-vpb'),
	'type' => 'block',
	'icon' => 'pi-image-gallery',
	'category' =>  esc_html__('Media', 'the-creator-vpb'),
	'third_party' => 1,
	'attributes' => array(
		'ids' => array(
			'description' => esc_html__('Gallery IDs', 'the-creator-vpb'),
			'type' => 'gallery',
			),
		),
	);