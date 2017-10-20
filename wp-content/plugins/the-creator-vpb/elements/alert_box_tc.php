<?php

/*********** Shortcode: Alert Box ************************************************************/

$tcvpb_elements['alert_box_tc'] = array(
	'name' => esc_html__('Alert Box', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-alert-box',
	'category' => esc_html__('Content', 'the-creator-vpb' ),
	'attributes' => array(
		'style' => array(
			'default' => 'info',
			'type' => 'select',
			'values' => array( 
				'info' => 'Info',
				'warning' => 'Warning',
				'error' => 'Error',
				'success' => 'Success',
			),
			'description' => esc_html__('Style', 'the-creator-vpb'),
		),
		'icon_out' => array(
			'description' => esc_html__('Name of the Icon', 'the-creator-vpb'),
			'type' => 'icon',
		),
		'icon_color' => array(
			'description' => esc_html__('Icon Color', 'the-creator-vpb'),
			'type' => 'color',
		),
		'no_close' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('No Close Button', 'the-creator-vpb'),
		),
		'animation' => array(
			'default'     => '',
			'description' => esc_html__('Entrance Animation', 'the-creator-vpb'),
			'type'        => 'select',
			'tab'         => esc_html__('Animation', 'the-creator-vpb'),
			'values'      => array(
				''                  => esc_html__('None', 'the-creator-vpb'),
				'animate_fade'      => esc_html__('Fade', 'the-creator-vpb'),
				'animate_afc'       => esc_html__('Zoom', 'the-creator-vpb'),
				'animate_afl'       => esc_html__('Fade to Right', 'the-creator-vpb'),
				'animate_afr'       => esc_html__('Fade to Left', 'the-creator-vpb'),
				'animate_aft'       => esc_html__('Fade Down', 'the-creator-vpb'),
				'animate_afb'       => esc_html__('Fade Up', 'the-creator-vpb'),
			),
		),
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'the-creator-vpb'),
			'info'        => esc_html__('Amount of pixels from bottom to start animation', 'the-creator-vpb'),
			'default'     => '0',
			'tab'         => esc_html__('Animation', 'the-creator-vpb'),
		),
		'duration' => array(
			'description' => esc_html__('Animation Duration (in ms)', 'the-creator-vpb'),
			'default'     => '1000',
			'tab'         => esc_html__('Animation', 'the-creator-vpb'),
		),
		'delay' => array(
			'description' => esc_html__('Animation Delay (in ms)', 'the-creator-vpb'),
			'default'     => '0',
			'tab'         => esc_html__('Animation', 'the-creator-vpb'),
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
		'description' => esc_html__('Message', 'the-creator-vpb'),
	),
);
function tcvpb_alert_box_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('alert_box_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	$allowed_styles = array('warning','error','info','success');
	$style = (in_array($style, $allowed_styles)) ? $style : 'info';
	$style_out = 'tcvpb_alert_' . $style;

	$icon_out = ($icon_out != '1') ? '<i class="'.esc_attr($icon_out).'" style="color:'.esc_attr($icon_color).';"></i> ' : '';
	$close_button = ( $no_close != 1 ) ? '<a class="tcvpb_alert_box_close" title="' . esc_attr__('Close', 'the-creator-vpb' ) . '">&#10005;</a>' : '';
	return  '<div '.esc_attr($id_out).' class="'.esc_attr($style_out).' '.esc_attr($class).' '.$animation_classes.'" '.$animation_out.'>
		' . $icon_out . $content . $close_button . '
	</div>';
}