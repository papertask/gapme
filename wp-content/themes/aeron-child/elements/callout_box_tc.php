<?php

/*********** Shortcode: Callout box ************************************************************/

$tcvpb_elements['callout_box_tc'] = array(
	'name' => esc_html__('Callout Box', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-callout-box',
	'category' => esc_html__('Content', 'ABdev_dzen' ),
	'attributes' => array(
		'title' => array(
			'description' => esc_html__( 'Title', 'ABdev_dzen' ),
		),
		'no_button' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__( 'No Button', 'ABdev_dzen' ),
		),
		'inverted' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__( 'Inverted (White) Text', 'ABdev_dzen' ),
			'divider' => 'true',
		),
		'button_text' => array(
			'description' => esc_html__( 'Button Text', 'ABdev_dzen' ),
			'default' => esc_html__( 'Click Here', 'ABdev_dzen' ),
		),
		'button_size' => array(
			'description' => esc_html__( 'Button Size', 'ABdev_dzen' ),
			'default' => 'medium',
			'type' => 'select',
			'values' => array(
				'small' =>  esc_html__( 'Small', 'ABdev_dzen' ),
				'medium' => esc_html__( 'Medium', 'ABdev_dzen' ),
				'large' => esc_html__( 'Large', 'ABdev_dzen' ),
				'xlarge' => esc_html__( 'Extra Large', 'ABdev_dzen' ),
			),
		),
		'button_color' => array(
			'description' => esc_html__( 'Button Background Color', 'ABdev_dzen' ),
			'default' => 'light',
			'type' => 'select',
			'values' => array(
				'light' => esc_html__( 'Light', 'ABdev_dzen' ),
				'dark' => esc_html__( 'Dark', 'ABdev_dzen' ),
				'yellow' => esc_html__( 'Yellow', 'ABdev_dzen' ),
				'green' => esc_html__( 'Green', 'ABdev_dzen' ),
				'red' => esc_html__( 'Red', 'ABdev_dzen' ),
				'blue' => esc_html__( 'Blue', 'ABdev_dzen' ),
				'gray' => esc_html__( 'Gray', 'ABdev_dzen' ),
				'cyan' => esc_html__( 'Cyan', 'ABdev_dzen' ),
				'aquamarine' => esc_html__( 'Aquamarine', 'ABdev_dzen' ),
			),
		),
		'button_style' => array(
			'description' => esc_html__( 'Button Style', 'ABdev_dzen' ),
			'default' => 'normal',
			'type' => 'select',
			'values' => array(
				'normal' =>  esc_html__( 'Normal', 'ABdev_dzen' ),
				'rounded' =>  esc_html__( 'Rounded', 'ABdev_dzen' ),
			),
		),
		'button_url' => array(
			'description' => esc_html__( 'Button URL', 'ABdev_dzen' ),
			'type' => 'url',
		),
		'button_target' => array(
			'default' => '_self',
			'type' => 'select',
			'description' => esc_html__( 'Button Target', 'ABdev_dzen' ),
			'values' => array(
				'_self' =>  esc_html__( 'Self', 'ABdev_dzen' ),
				'_blank' => esc_html__( 'Blank', 'ABdev_dzen' ),
			),
		),
		'button_icon' => array(
			'description' => esc_html__('Button Icon', 'ABdev_dzen'),
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
	),
	'content' => array(
		'description' => esc_html__( 'Content', 'ABdev_dzen' ),
	),

);

function tcvpb_callout_box_tc_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( tcvpb_extract_attributes('callout_box_tc'), $atts ) );
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$button_class_out = 'tcvpb-button';
	$button_class_out .= ' tcvpb-button_'.$button_color;
	$button_class_out .= ' tcvpb-button_'.$button_style;
	$button_class_out .= ' tcvpb-button_'.$button_size;

	$button_icon_out = ($button_icon!='') ? '<i class="'.esc_attr($button_icon).'"></i>' : '';


	$content_out = ($content!='') ? '<p>'.do_shortcode($content).'</p>' : '';

	$inverted = ($inverted=='1') ? 'color_white' : '';

	$class = 'tcvpb-callout_box '.$class;

	$return = '<div '.esc_attr($id_out).' class="tcvpb-callout_box '.esc_attr($inverted).' '.esc_attr($class).'">';

	if ( $no_button != '1' ){
		$return .= '<div class="tcvpb_container"><div class="tcvpb_column_tc_span9">';
	}

	$return .= '<span class="tcvpb-callout_box_title">'.wp_kses($title, ABdev_allowed_tags()).'</span>';
	$return .= $content_out;

	if ( $no_button != '1' ){
		$return .= '</div>
				<div class="tcvpb_column_tc_span3">
					<a href="'. $button_url .'" target="' . $button_target . '" class="'.$button_class_out.'">'.$button_text.$button_icon_out.'</a>
				</div>
			</div>';
	}

	$return .= '</div>';

	return $return;
}



