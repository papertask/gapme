<?php

/*********** Shortcode: Vimeo ************************************************************/

$tcvpb_elements['vimeo_tc'] = array(
	'name' => esc_html__('Vimeo', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-vimeo',
	'category' =>  esc_html__('Media', 'ABdev_dzen'),
	'attributes' => array(
		'id' => array(
			'description' => esc_html__('Video ID or URL', 'ABdev_dzen'),
			'divider' => 'true',
		),
		'title' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show Title', 'ABdev_dzen'),
		),
		'byline' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show By Line', 'ABdev_dzen'),
		),
		'portrait' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show Portrait', 'ABdev_dzen'),
			'divider' => 'true',
		),
		'autoplay' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Autoplay', 'ABdev_dzen'),
		),
		'loop' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Loop Playing', 'ABdev_dzen'),
			'divider' => 'true',
		),
		'color' => array(
			'type' => 'color',
			'default' => '#00ADEF',
			'description' => esc_html__('Controls Color', 'ABdev_dzen'),
		),
		'ids' => array(
			'description' => esc_html__('ID', 'ABdev_dzen'),
			'info' => esc_html__('Additional custom ID', 'ABdev_dzen'),
			'tab' => esc_html__('Advanced', 'ABdev_dzen'),
		),
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_dzen'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_dzen'),
			'tab' => esc_html__('Advanced', 'ABdev_dzen'),
		),
	)
);
function tcvpb_vimeo_tc_shortcode($attributes) {
	extract(shortcode_atts(tcvpb_extract_attributes('vimeo_tc'), $attributes));
	$ids_out = ($ids!='') ? 'id='.$ids.'' : '';

	$color = trim($color, '#');

	if (strpos($id,'http') !== false)
		$id = strtok(basename($id), '_');

	$video_src='http://player.vimeo.com/video/'.$id.'?title='.$title.'&amp;byline='.$byline.'&amp;portrait='.$portrait.'&amp;autoplay='.$autoplay.'&amp;loop='.$loop.'&amp;color='.$color;

	return '<div '.esc_attr($ids_out).' class="tcvpb-videoWrapper-vimeo '.esc_attr($class).'"><iframe src="'.esc_url($video_src).'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
}



