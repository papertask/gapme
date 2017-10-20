<?php

/*********** Shortcode: Toggle ************************************************************/

$tcvpb_elements['toggle_tc'] = array(
	'name' => esc_html__('Toggle', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-toggle',
	'category' =>  esc_html__('Content', 'ABdev_dzen'),
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Title', 'ABdev_dzen'),
		),
		'expanded' => array(
			'description' => esc_html__('Expanded', 'ABdev_dzen'),
			'default' => '0',
			'type' => 'checkbox',
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
		'description' => esc_html__('Content', 'ABdev_dzen'),
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