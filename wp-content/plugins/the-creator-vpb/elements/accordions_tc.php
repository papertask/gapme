<?php

/*********** Shortcode: Accordions ************************************************************/

$tcvpb_elements['accordions_tc'] = array(
	'name' => esc_html__('Accordion', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-accordion',
	'category' => esc_html__('Content', 'the-creator-vpb' ),
	'child' => 'accordion_tc',
	'child_button' => esc_html__('New Accordion', 'the-creator-vpb'),
	'child_title' => esc_html__('Accordion Section', 'the-creator-vpb'),
	'attributes' => array(
		'expanded' => array(
			'description' => esc_html__('Expanded accordion no.', 'the-creator-vpb'),
			'info' => esc_html__('Which accordion section will be expanded on load, 0 for none', 'the-creator-vpb'),
			'default' => '1',
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
);
function tcvpb_accordions_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('accordions_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	return '<div '.esc_attr($id_out).' class="tcvpb-accordion '.esc_attr($class).'" data-expanded="'.esc_attr($expanded).'">'.do_shortcode($content).'</div>';
}

$tcvpb_elements['accordion_tc'] = array(
	'name' => esc_html__('Single accordion section', 'the-creator-vpb' ),
	'type' => 'child',
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Title', 'the-creator-vpb'),
		),
	),
	'content' => array(
		'description' => esc_html__('Content', 'the-creator-vpb'),
	),
);
function tcvpb_accordion_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('accordion_tc'), $attributes));
	$return = '
		<h3>' . esc_html($title) . '</h3>
		<div class="tcvpb-accordion-body">
			' . do_shortcode($content) . '
		</div>';
  
	return $return;
}
