<?php 

/**
	Native WP video shortcode support
**/
$tcvpb_elements['video'] = array(
	'name' => esc_html__('Video - HTML5', 'ABdev_dzen' ),
	'description' => esc_html__('Video - HTML5', 'ABdev_dzen'),
	'type' => 'block',
	'icon' => 'pi-video',
	'category' =>  esc_html__('Media', 'ABdev_dzen'),
	'third_party' => 1, 
	'attributes' => array(
		'mp4' => array(
			'description' => esc_html__('MP4 file', 'ABdev_dzen'),
			'type' => 'media',
		),
		'm4v' => array(
			'description' => esc_html__('M4V file', 'ABdev_dzen'),
			'type' => 'media',
		),
		'webm' => array(
			'description' => esc_html__('WEBM file', 'ABdev_dzen'),
			'type' => 'media',
		),
		'ogv' => array(
			'description' => esc_html__('OGV file', 'ABdev_dzen'),
			'type' => 'media',
		),
		'wmv' => array(
			'description' => esc_html__('WMV file', 'ABdev_dzen'),
			'type' => 'media',
		),
		'flv' => array(
			'description' => esc_html__('FLV file', 'ABdev_dzen'),
			'type' => 'media',
		),
		'poster' => array(
			'description' => esc_html__('Poster image', 'ABdev_dzen'),
			'type' => 'image',
			'info' => esc_html__('Defines image to show as placeholder before the media plays', 'ABdev_dzen'),
			'divider' => 'true',
		),
		'loop' => array(
			'description' => esc_html__('Loop', 'ABdev_dzen'),
			'default' => 'off',
			'type' => 'select',
			'values' => array( 
				'0' => 'Off',
				'1' => 'On',
			),
			'info' => esc_html__('Allows for the looping of media', 'ABdev_dzen'),
		),
		'autoplay' => array(
			'description' => esc_html__('Autoplay', 'ABdev_dzen'),
			'default' => 'off',
			'type' => 'select',
			'values' => array( 
				'0' => 'Off',
				'1' => 'On',
			),
			'info' => esc_html__('Causes the media to automatically play as soon as the media file is ready', 'ABdev_dzen'),
		),
		'preload' => array(
			'description' => esc_html__('Preload', 'ABdev_dzen'),
			'default' => 'metadata',
			'type' => 'select',
			'values' => array( 
				'metadata' => 'Metadata only',
				'none' => 'None',
				'auto' => 'Load video entirely',
			),
			'info' => esc_html__('Specifies if and how the video should be loaded when the page loads', 'ABdev_dzen'),
		),
	),
);

