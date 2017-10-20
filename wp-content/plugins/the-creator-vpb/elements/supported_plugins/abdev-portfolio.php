<?php 


/**
	abdev-portfolio plugin support
**/
if( in_array('abdev-portfolio/abdev-portfolio.php', get_option('active_plugins')) ){ //first check if plugin is installed
	$tcvpb_elements['portfolio'] = array(
		'name' => esc_html__('Portfolio', 'the-creator-vpb' ),
		'description' => esc_html__('Portfolio', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-portfolio',
		'category' =>  esc_html__('Media', 'the-creator-vpb'),
		'third_party' => '1', 
		'attributes' => array(
			'category' => array(
				'description' => esc_html__('Portfolio Category', 'the-creator-vpb'),
				'info' => esc_html__('Show only items from specific category, displays all categories if not specified (category slug string)', 'the-creator-vpb'),
				'divider' => 'true',
			),
			'style' => array(
				'default' => '1',
				'type' => 'select',
				'values' => array( 
					'1' => '3 Column Fullwidth',
					'2' => '4 Column Fullwidth',
					'3' => '5 Column Fullwidth',
					'4' => '3 Column Boxed',
					'5' => '4 Column Boxed',
				),
				'description' => esc_html__('Style', 'the-creator-vpb'),
			),
			'count' => array(
				'description' => esc_html__('Count', 'the-creator-vpb'),
				'info' => esc_html__('Number of portfolio items to be shown', 'the-creator-vpb'),
				'default' => 8,
				'divider' => 'true',
			),
			'link_text' => array(
				'description' => esc_html__('More Link Text', 'the-creator-vpb'),
				'info' => esc_html__('Enter text to be displayed below items as a link to complete portfolio', 'the-creator-vpb'),
			),
			'link_url' => array(
				'description' => esc_html__('More Link URL', 'the-creator-vpb'),
				'info' => esc_html__('Enter URL for link to complete portfolio', 'the-creator-vpb'),
				'divider' => 'true',
			),
			'carousel' => array(
				'description' => esc_html__('Carousel', 'the-creator-vpb'),
				'type' => 'checkbox',
				'default' => '0',
				'info' => esc_html__('Check this if you want the carousel enabled. Works with 3 and 4 Column Fullwidth style.', 'the-creator-vpb'),
			),
		),
	);
}
