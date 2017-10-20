<?php

/*********** Shortcode: H1 - H6 headings ************************************************************/

$tcvpb_elements['h_tc'] = array(
	'name' => esc_html__('H1-H6 Headings', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-headings',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'attributes' => array(
		'type' => array(
			'default' => '3',
			'type' => 'select',
			'values' => array(
				'1' => 'H1',
				'2' => 'H2',
				'3' => 'H3',
				'4' => 'H4',
				'5' => 'H5',
				'6' => 'H6',
			),
			'description' => esc_html__('Type', 'the-creator-vpb'),
		),
		'title' => array(
			'type' => 'small_tinymce',
			'description' => esc_html__('Title', 'the-creator-vpb'),
		),
		'subtitle' => array(
			'type' => 'small_tinymce',
			'description' => esc_html__('SubTitle', 'the-creator-vpb'),
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
	)
);
function tcvpb_h_tc_shortcode( $attributes ) {
	extract(shortcode_atts(tcvpb_extract_attributes('h_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = (isset($class) && $class!='') ? ' class="'.esc_attr($class).'"' : '';
	$type = (in_array($type,array('1', '2', '3', '4', '5', '6'))) ? $type : '3';
    return '<h'.$type.' '.esc_attr($id_out).' '.$class_out.'><span>' . do_shortcode($title) . '</span></h' . $type . '>';
}
