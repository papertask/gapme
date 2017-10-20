<?php

/********** Shortcode: Abbreviation *************************************************************/

$tcvpb_elements['abbr_dd'] = array(
	'name' => esc_html__('Abbreviation', 'ABdev_dzen' ),
	'type' => 'inline',
	'attributes' => array(
		'fullword' => array(
			'info' => esc_html__('e.g. Abbreviation', 'ABdev_dzen'),
			'description' => esc_html__('Full Word', 'ABdev_dzen'),
		),
		'abbr' => array(
			'info' => esc_html__('e.g. abbr', 'ABdev_dzen'),
			'description' => esc_html__('Abbreviation', 'ABdev_dzen'),
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
function tcvpb_abbr_tc_shortcode ( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('abbr_dd'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	return '<abbr '.esc_attr($id_out).' '.esc_attr($class_out).' class="tcvpb-abbr tcvpb_tooltip" data-gravity="s" title="' . esc_attr( $fullword ) . '">' . $abbr . '</abbr>';
}

