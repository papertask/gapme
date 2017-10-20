<?php

/*********** Shortcode: Youtube ************************************************************/

$tcvpb_elements['youtube_tc'] = array(
	'name' => esc_html__('Youtube', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-youtube',
	'category' =>  esc_html__('Media', 'ABdev_dzen'),
	'attributes' => array(
		'url' => array(
			'description' => esc_html__('Video ID or URL', 'ABdev_dzen'),
		),
		'fullscreen_button' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Fullscreen Button', 'ABdev_dzen'),
		),
		'autoplay' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Autoplay', 'ABdev_dzen'),
		),
		'modestbranding' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Modest Branding', 'ABdev_dzen'),
		),
		'controls' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Controls', 'ABdev_dzen'),
			'divider' => 'true',
		),
		'showinfo' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show Info Before Play', 'ABdev_dzen'),
		),
		'related' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show Related When Video Ends', 'ABdev_dzen'),
			'divider' => 'true',
		),
		'start' => array(
			'description' => esc_html__('Start Playing at (in seconds)', 'ABdev_dzen'),
		),
		'end' => array(
			'description' => esc_html__('Stop Playing at (in seconds)', 'ABdev_dzen'),
		),
		'id' => array(
			'description' => esc_html__('ID', 'ABdev_dzen'),
			'info' => esc_html__('Additional custom ID', 'ABdev_dzen'),
			'tab' => esc_html__('Advanced', 'ABdev_dzen'),
		),
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_dzen'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_dzen'),
			'tab' => esc_html__('Advanced', 'ABdev_dzen'),
		),
	),
);
function tcvpb_youtube_tc_shortcode($attributes) {
	extract(shortcode_atts(tcvpb_extract_attributes('youtube_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$options_output = '?autoplay='.$autoplay.'&amp;modestbranding='.$modestbranding.'&amp;controls='.$controls.'&amp;fs='.$fullscreen_button.'&amp;start='.$start.'&amp;end='.$end.'&amp;showinfo='.$showinfo.'&amp;rel='.$related;

	if(strlen($id)==11){
		$video_src='http://www.youtube.com/embed/'.$url.$options_output;
	}
	else{
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$video_src='http://www.youtube.com/embed/'.$my_array_of_vars['v'].$options_output;
	}

	return '<div '.esc_attr($id_out).' class="tcvpb-videoWrapper-youtube '.esc_attr($class).'"><iframe src="'.esc_url($video_src).'" frameborder="0" allowfullscreen></iframe></div>';
}


