<?php

/*********** Shortcode: Stats Excerpt ************************************************************/

$tcvpb_elements['stats_excerpt_tc'] = array(
	'name' => esc_html__('Stats Excerpt', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-stats',
	'category' =>  esc_html__('Content', 'ABdev_dzen'),
	'attributes' => array(
		'icon' => array(
			'description' => esc_html__('Icon', 'ABdev_dzen'),
			'type' => 'icon',
		),
		'number' => array(
			'description' => esc_html__('Stats Number', 'ABdev_dzen'),
		),
		'number_sign' => array(
			'description' => esc_html__('Stats Number Sign', 'ABdev_dzen'),
		),
		'duration' => array(
			'default' => '1500',
			'description' => esc_html__('Animation duration (ms)', 'ABdev_dzen'),
		),
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'ABdev_dzen'),
			'info' => esc_html__('Amount of pixels from bottom to start animation', 'ABdev_dzen'),
			'default' => '0',
			'divider' => 'true',
		),
		'description' => array(
			'description' => esc_html__('Description', 'ABdev_dzen'),
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
	)
);
function tcvpb_stats_excerpt_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('stats_excerpt_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$icon_out = ($icon!='') ? '<i class="'.esc_attr($icon).'"></i>' : '';
	$number_sign_out = ($number_sign!='') ? '<span class="tcvpb_stats_number_sign">'.esc_html($number_sign).'</span>' : '';

	return '
		<div '.esc_attr($id_out).' class="tcvpb_stats_excerpt '.esc_attr($class).'">
			'.$icon_out.'
			<span class="tcvpb_stats_number" data-number="'.esc_attr($number).'" data-duration="'.esc_attr($duration).'" data-trigger_pt="'.esc_attr($trigger_pt).'"></span>
			'.$number_sign_out.'
			<p>'.do_shortcode($description).'</p>
		</div>';
}


