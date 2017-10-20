<?php

/*********** Shortcode: Dropcap Letter ************************************************************/

$tcvpb_elements['dropcap_tc'] = array(
	'name' => esc_html__('Dropcap Letter', 'ABdev_dzen' ),
	'type' => 'inline',
	'attributes' => array(
		'letter' => array(
			'description' => esc_html__('Dropcap letter', 'ABdev_dzen'),
		),
		'color' => array(
			'description' => esc_html__('Letter Color', 'ABdev_dzen'),
			'type' => 'color',
		),
		'background' => array(
			'description' => esc_html__('Background Color', 'ABdev_dzen'),
			'type' => 'coloralpha',
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
function tcvpb_dropcap_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('dropcap_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$color = ($color!='') ? 'color: '.$color.';' : '';
	$background = ($background!='') ? 'background:'.$background.';' : '';

	return '<span '.esc_attr($id_out).' class="tcvpb_dropcap '.esc_attr($class).'" style="'.esc_attr($color.$background).'">'.esc_attr($letter).'</span>';
}
