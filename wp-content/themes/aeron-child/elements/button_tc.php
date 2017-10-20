<?php

/*********** Shortcode: Buttons ************************************************************/

$tcvpb_elements['button_tc'] = array(
	'name' => esc_html__('Button', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-button',
	'category' => esc_html__('Navigation', 'ABdev_dzen' ),
	'attributes' => array(
		'text' => array(
			'description' => esc_html__( 'Button Text', 'ABdev_dzen' ),
			'default' => esc_html__( 'Click Here', 'ABdev_dzen' ),
			'divider' => 'true',
		),
		'style' => array(
			'description' => esc_html__( 'Style', 'ABdev_dzen' ),
			'default' => 'normal',
			'type' => 'select',
			'values' => array(
				'normal' =>  esc_html__( 'Normal', 'ABdev_dzen' ),
				'rounded' =>  esc_html__( 'Rounded', 'ABdev_dzen' ),
			),
		),
		'size' => array(
			'description' => esc_html__( 'Size', 'ABdev_dzen' ),
			'default' => 'medium',
			'type' => 'select',
			'values' => array(
				'small' =>  esc_html__( 'Small', 'ABdev_dzen' ),
				'medium' => esc_html__( 'Medium', 'ABdev_dzen' ),
				'large' => esc_html__( 'Large', 'ABdev_dzen' ),
				'xlarge' => esc_html__( 'Extra Large', 'ABdev_dzen' ),
			),
		),
		'color' => array(
			'description' => esc_html__( 'Color', 'ABdev_dzen' ),
			'default' => 'light',
			'type' => 'select',
			'values' => array(
				'light' =>  __( 'Light', 'ABdev_dzen' ),
				'dark' =>  __( 'Dark', 'ABdev_dzen' ),
				'yellow' =>  __( 'Yellow', 'ABdev_dzen' ),
				'green' =>  __( 'Green', 'ABdev_dzen' ),
				'red' =>  __( 'Red', 'ABdev_dzen' ),
				'blue' =>  __( 'Blue', 'ABdev_dzen' ),
				'gray' =>  __( 'Gray', 'ABdev_dzen' ),
				'cyan' =>  __( 'Cyan', 'ABdev_dzen' ),
				'aquamarine' =>  __( 'Aquamarine', 'ABdev_dzen' ),
			),
		),
		'url' => array(
			'description' => esc_html__( 'URL', 'ABdev_dzen' ),
			'type' => 'url',
		),
		'target' => array(
			'description' => esc_html__( 'Target', 'ABdev_dzen' ),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__( 'Self', 'ABdev_dzen' ),
				'_blank' => esc_html__( 'Blank', 'ABdev_dzen' ),
			),
			'divider' => 'true',
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'ABdev_dzen'),
			'info' => esc_html__('Optional icon after button text', 'ABdev_dzen'),
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
	)
);

function tcvpb_button_tc_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( tcvpb_extract_attributes('button_tc'), $atts ) );
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$class_out = 'tcvpb-button';
	$class_out .= ' tcvpb-button_'.$color;
	$class_out .= ' tcvpb-button_'.$style;
	$class_out .= ' tcvpb-button_'.$size;
	$class_out .= ' '.$class;

	$icon_out = ($icon!='') ? '<i class="'.esc_attr($icon).'"></i>' : '';

	return '<a '.esc_attr($id_out).' href="'. esc_url($url) .'" target="' . esc_attr($target) . '" class="'.esc_attr($class_out).'">' . esc_html($text) . $icon_out . '</a>';
}


