<?php

/*********** Shortcode: Highlight Color ************************************************************/

$tcvpb_elements['highlight_tc'] = array(
	'name' => esc_html__('Highlighted text', 'ABdev_dzen' ),
	'type' => 'inline',
	'attributes' => array(
		'color' => array(
			'type' => 'coloralpha',
			'description' => esc_html__('Highlight Color', 'ABdev_dzen'),
		),
		'text_color' => array(
			'type' => 'color',
			'description' => esc_html__('Text Color', 'ABdev_dzen'),
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
	'content' => array(
		'description' => esc_html__('Highlighted Content', 'ABdev_dzen'),
	),
);
function tcvpb_highlight_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('highlight_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	$text_color_out = ($text_color != '') ? ' color:'.esc_attr($text_color) : '';
	return '<span '.esc_attr($id_out).' '.esc_attr($class_out).' style="background-color:'.esc_attr($color).';'.$text_color_out.'">' . do_shortcode( $content ) . '</span>';
}
