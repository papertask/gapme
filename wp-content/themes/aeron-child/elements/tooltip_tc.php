<?php

/*********** Shortcode: Tooltip ************************************************************/

$tcvpb_elements['tooltip_tc'] = array(
	'name' => esc_html__('Tooltip', 'ABdev_dzen' ),
	'type' => 'inline',
	'attributes' => array(
		'text' => array(
			'description' => esc_html__('Text', 'ABdev_dzen'),
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
		'gravity' => array(
			'description' => esc_html__('Tooltip Gravity', 'ABdev_dzen'),
			'default' => 's',
			'type' => 'select',
			'values' => array(
				's' =>  esc_html__('South', 'ABdev_dzen'),
				'n' => esc_html__('North', 'ABdev_dzen'),
				'e' => esc_html__('East', 'ABdev_dzen'),
				'w' => esc_html__('West', 'ABdev_dzen'),
				'nw' =>  esc_html__('Northwest', 'ABdev_dzen'),
				'ne' => esc_html__('Northeast', 'ABdev_dzen'),
				'sw' => esc_html__('Southwest', 'ABdev_dzen'),
				'se' => esc_html__('Southeast', 'ABdev_dzen'),
			),
		),
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_dzen'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_dzen'),
			'tab' => esc_html__('Advanced', 'ABdev_dzen'),
		),
	),
	'content' => array(
		'description' => esc_html__('Tooltip Content', 'ABdev_dzen'),
	)
);
function tcvpb_tooltip_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('tooltip_tc'), $attributes));

	$link_output=($link!='')?' href="'.esc_url($link).'"':'';
	$target_output=($target!='')?' target="'.esc_attr($target).'"':'';

	return '<a'.$link_output.' class="tcvpb_tooltip '.esc_attr($class).'" data-gravity="'.esc_attr($gravity).'" title="'.esc_attr($text).'"'.$target_output.'><p>'.do_shortcode($content).'</p></a>';
}
