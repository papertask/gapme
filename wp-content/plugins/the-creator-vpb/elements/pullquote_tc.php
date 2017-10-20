<?php

/*********** Shortcode: Pullquote ************************************************************/

$tcvpb_elements['pullquote_tc'] = array(
	'name' => esc_html__('Pullquote', 'the-creator-vpb' ),
	'type' => 'inline',
	'attributes' => array(
		'span' => array(
			'default' => '3',
			'description' => esc_html__('Span 1-11', 'the-creator-vpb'),
		),
		'align' => array(
			'default' => 'left',
			'description' => esc_html__('Align', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'left' => esc_html__('Left', 'the-creator-vpb'),
				'right' => esc_html__('Right', 'the-creator-vpb'),
			),
		),
		'id' => array(
			'description' => esc_html__('ID', 'the-creator-vpb'),
			'info' => esc_html__('Additional custom ID', 'the-creator-vpb'),
			'tab' => esc_html__('Advanced', 'the-creator-vpb'),
		),	
		'class' => array(
			'description' => esc_html__('Class', 'the-creator-vpb'),
			'info' => esc_html__('Additional custom classes for custom styling', 'the-creator-vpb'),
			'tab' => esc_html__('Advanced', 'the-creator-vpb'),
		),
	),
	'content' => array(
		'description' => esc_html__('Content', 'the-creator-vpb'),
	),
);
function tcvpb_pullquote_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('pullquote_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	return '<span '.esc_attr($id_out).' class="tcvpb_pullquote tcvpb_pullquote_'.esc_attr($align).' tcvpb_column_tc_span'.esc_attr($span).' '.esc_attr($class).'">
		'.$content.'
	</span>';
}
