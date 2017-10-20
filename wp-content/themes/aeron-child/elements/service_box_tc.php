<?php

/*********** Shortcode: Service box ************************************************************/

$tcvpb_elements['service_box_tc'] = array(
	'name' => esc_html__('Service box', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-service-box',
	'category' =>  esc_html__('Content', 'ABdev_dzen'),
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Title', 'ABdev_dzen'),
		),
		'type' => array(
			'description' => esc_html__('Type', 'ABdev_dzen'),
			'default' => 'round',
			'type' => 'select',
			'values' => array(
				'round' => esc_html__('Round', 'ABdev_dzen'),
				'square' =>  esc_html__('Square', 'ABdev_dzen'),
				'round_stroke' => esc_html__('Round Stroke', 'ABdev_dzen'),
				'round_aside' => esc_html__('Round Aside', 'ABdev_dzen'),
			),
		),
		'link' => array(
			'description' => esc_html__('Link', 'ABdev_dzen'),
		),
		'target' => array(
			'description' => esc_html__('Target', 'ABdev_dzen'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__('Self', 'ABdev_dzen'),
				'_blank' => esc_html__('Blank', 'ABdev_dzen'),
			),
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'ABdev_dzen'),
			'type' => 'icon',
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
	),
);
function tcvpb_service_box_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('service_box_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$class = ' tcvpb_service_box_'.$type . ' ' . $class;

	$return = '
		<div '.esc_attr($id_out).' class="tcvpb_service_box '.esc_attr($class).'">
			<div class="tcvpb_service_box_header">';
			$title_out = ($title !='') ? '<h3>'.esc_html($title).'</h3>' : '';
			$return .= ($link!='') ? '<a href="'.esc_url($link).'" target="'.esc_attr($target).'" class="tcvpb_icon_boxed scroll"><i class="'.esc_attr($icon).'"></i></a>' : '<div class="tcvpb_icon_boxed"><i class="'.esc_attr($icon).'"></i></div>';
			$return .= ($link!='') ? '<a href="'.esc_url($link).'" target="'.esc_attr($target).'" class="scroll">'.$title_out.'</a>' : $title_out;
			$return .= '</div>';
			$return .= ($content != '') ?'<p>'.do_shortcode($content).'</p>' : '';
			$return .= '</div>';

	return $return;
}

