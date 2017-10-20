<?php

/*********** Shortcode: Progress Bar ************************************************************/

$tcvpb_elements['progress_bar_tc'] = array(
	'name' => esc_html__('Progress bar', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-progress-bar',
	'category' =>  esc_html__('Charts', 'ABdev_dzen'),
	'attributes' => array(
		'complete' => array(
			'default' => '60',
			'description' => esc_html__('Percentage', 'ABdev_dzen'),
		),
		'text' => array(
			'description' => esc_html__('Text', 'ABdev_dzen'),
		),
		'style' => array(
			'description' => esc_html__('Style', 'ABdev_dzen'),
			'default' => 'default',
			'type' => 'select',
			'values' => array(
				'default' => esc_html__('Default', 'ABdev_dzen'),
				'thick' => esc_html__('Thick', 'ABdev_dzen'),
				'thin' => esc_html__('Thin', 'ABdev_dzen'),
			),
			'divider' => 'true',
		),
		'bar_color' => array(
			'description' => esc_html__('Bar Color', 'ABdev_dzen'),
			'type' => 'color',
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
	'description' => esc_html__('Progress Bar', 'ABdev_dzen' )
);
function tcvpb_progress_bar_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('progress_bar_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$bar_color_out = ($bar_color!='') ? 'background:'.$bar_color.';' : '';

	$class .= ($style!='') ? 'tcvpb_progress_bar_' .esc_attr($style) : '';

	return '
		<div '.esc_attr($id_out).' class="tcvpb_progress_bar '.esc_attr($class).'">
			<span class="tcvpb_meter_label">'.$text.'</span>
			<div class="tcvpb_meter">
				<div class="tcvpb_meter_percentage" data-percentage="'.esc_attr($complete).'" style="width: '.esc_attr($complete).'%;'.esc_attr($bar_color_out).'"><span>'.esc_html($complete).'%</span></div>
			</div>
		</div>';
}

