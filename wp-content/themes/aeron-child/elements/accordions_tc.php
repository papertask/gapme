<?php

/*********** Shortcode: Accordions ************************************************************/

$tcvpb_elements['accordions_tc'] = array(
	'name' => esc_html__('Accordion', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-accordion',
	'category' => esc_html__('Content', 'ABdev_dzen' ),
	'child' => 'accordion_tc',
	'child_button' => esc_html__('New Accordion', 'ABdev_dzen'),
	'child_title' => esc_html__('Accordion Section', 'ABdev_dzen'),
	'attributes' => array(
		'expanded' => array(
			'description' => esc_html__('Expanded accordion no.', 'ABdev_dzen'),
			'info' => esc_html__('Which accordion section will be expanded on load, 0 for none', 'ABdev_dzen'),
			'default' => '1',
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
function tcvpb_accordions_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('accordions_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	return '<div '.esc_attr($id_out).' class="tcvpb-accordion '.esc_attr($class).'" data-expanded="'.esc_attr($expanded).'">'.do_shortcode($content).'</div>';
}

$tcvpb_elements['accordion_tc'] = array(
	'name' => esc_html__('Single accordion section', 'ABdev_dzen' ),
	'type' => 'child',
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Title', 'ABdev_dzen'),
		),
	),
	'content' => array(
		'description' => esc_html__('Content', 'ABdev_dzen'),
	),
);
function tcvpb_accordion_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('accordion_tc'), $attributes));
	$return = '
		<h3>' . esc_html($title) . '</h3>
		<div class="tcvpb-accordion-body">
			<p>' . do_shortcode($content) . '</p>
		</div>';
  
	return $return;
}
