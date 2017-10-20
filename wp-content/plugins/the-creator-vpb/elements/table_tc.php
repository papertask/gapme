<?php

/*********** Shortcode: Table ************************************************************/

$tcvpb_elements['table_tc'] = array(
	'name' => esc_html__('Table', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-table',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'attributes' => array(
		'dummy' => array(
			'type' => 'hidden',
		),
		'alternative_style' => array(
			'default' => '0',
			'description' => esc_html__('Alternative Styling', 'the-creator-vpb'),
			'type' => 'checkbox',
			'tab' => esc_html__('Style', 'the-creator-vpb'),
		),
		'hover' => array(
			'default' => '0',
			'description' => esc_html__('Rows with Hover', 'the-creator-vpb'),
			'type' => 'checkbox',
			'tab' => esc_html__('Style', 'the-creator-vpb'),
		),
		'striped' => array(
			'default' => '0',
			'description' => esc_html__('Striped Rows', 'the-creator-vpb'),
			'type' => 'checkbox',
			'tab' => esc_html__('Style', 'the-creator-vpb'),
		),
		'condensed' => array(
			'default' => '0',
			'description' => esc_html__('Condensed Table', 'the-creator-vpb'),
			'type' => 'checkbox',
			'tab' => esc_html__('Style', 'the-creator-vpb'),
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
		'default' => 'HTML table source here',
		'description' => esc_html__('Content', 'the-creator-vpb'),
	)
);
function tcvpb_table_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('table_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$classes[] = 'tcvpb-table';

	if($alternative_style==1){
		$classes[] = 'tcvpb-table-alternative';
	}
	if($hover==1){
		$classes[] = 'tcvpb-table-hover';
	}
	if($striped==1){
		$classes[] = 'tcvpb-table-striped';
	}
	if($condensed==1){
		$classes[] = 'tcvpb-table-condensed';
	}
	$classes = implode(' ', $classes).' '.$class;

	return '<div '.esc_attr($id_out).' class="'.esc_attr($classes).'">'.do_shortcode($content).'</div>';
}


