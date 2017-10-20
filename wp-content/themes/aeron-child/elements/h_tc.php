<?php

/*********** Shortcode: H1 - H6 headings ************************************************************/

$tcvpb_elements['h_tc'] = array(
	'name' => esc_html__('H1-H6 Headings', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-headings',
	'category' =>  esc_html__('Content', 'ABdev_dzen'),
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
			'description' => esc_html__('Type', 'ABdev_dzen'),
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
		'description' => esc_html__('Title', 'ABdev_dzen'),
	),
);
function tcvpb_h_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('h_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = (isset($class) && $class!='') ? ' class="'.esc_attr($class).'"' : '';
	$type = (in_array($type,array('1', '2', '3', '4', '5', '6'))) ? $type : '3';
    return '<h'.$type.' '.esc_attr($id_out).' '.$class_out.'><span>' . do_shortcode($content) . '</span></h' . $type . '>';
}
