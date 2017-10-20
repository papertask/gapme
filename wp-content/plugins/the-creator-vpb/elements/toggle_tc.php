<?php

/*********** Shortcode: Toggle ************************************************************/

$tcvpb_elements['toggle_tc'] = array(
	'name' => esc_html__('Toggle', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-toggle',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Title', 'the-creator-vpb'),
		),
		'expanded' => array(
			'description' => esc_html__('Expanded', 'the-creator-vpb'),
			'default' => '0',
			'type' => 'checkbox',
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
	)
);
function tcvpb_toggle_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('toggle_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	
	$return = '
		<div '.esc_attr($id_out).' class="tcvpb-accordion tcvpb-toggle '.esc_attr($class).'" data-expanded="'.esc_attr($expanded).'">
			<h3>' . esc_html($title) . '</h3>
			<div class="tcvpb-accordion-body">
				<p>' . do_shortcode($content) . '</p>
			</div>
		</div>
		';
  
	return $return;
}

