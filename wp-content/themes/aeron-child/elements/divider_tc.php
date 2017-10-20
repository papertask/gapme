<?php

/*********** Shortcode: Content Divider ************************************************************/

$tcvpb_elements['divider_tc'] = array(
	'name' => esc_html__('Content Divider', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-divider',
	'category' =>  esc_html__('Content', 'ABdev_dzen'),
	'attributes' => array(
		'style' => array(
			'default' => 'style1',
			'description' => esc_html__('Divider Style', 'ABdev_dzen'),
			'type' => 'select',
			'values' => array(
				'solid' => 'Solid Line',
				'dashed' => 'Dashed Line',
				'dotted' => 'Dotted Line',
			),
		),
		'text' => array(
			'description' => esc_html__('Text', 'ABdev_dzen'),
			'info' => esc_html__('e.g. Go to top', 'ABdev_dzen'),
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'ABdev_dzen'),
			'type' => 'icon',
		),
		'animation' => array(
			'default' => 'none',
			'description' => esc_html__('Entrance Animation', 'ABdev_dzen'),
			'type' => 'select',
			'values' => array(
				'none' => esc_html__('None', 'ABdev_dzen'),
				'flip' => esc_html__('Flip', 'ABdev_dzen'),
				'flipInX' => esc_html__('Flip In X', 'ABdev_dzen'),
				'flipInY' => esc_html__('Flip In Y', 'ABdev_dzen'),
				'fadeIn' => esc_html__('Fade In', 'ABdev_dzen'),
				'fadeInUp' => esc_html__('Fade In Up', 'ABdev_dzen'),
				'fadeInDown' => esc_html__('Fade In Down', 'ABdev_dzen'),
				'fadeInLeft' => esc_html__('Fade In Left', 'ABdev_dzen'),
				'fadeInRight' => esc_html__('Fade In Right', 'ABdev_dzen'),
				'fadeInUpBig' => esc_html__('Fade In Up Big', 'ABdev_dzen'),
				'fadeInDownBig' => esc_html__('Fade In Down Big', 'ABdev_dzen'),
				'fadeInLeftBig' => esc_html__('Fade In Left Big', 'ABdev_dzen'),
				'fadeInRightBig' => esc_html__('Fade In Right Big', 'ABdev_dzen'),
				'slideInLeft' => esc_html__('Slide In Left', 'ABdev_dzen'),
				'slideInRight' => esc_html__('Slide In Right', 'ABdev_dzen'),
				'bounceIn' => esc_html__('Bounce In', 'ABdev_dzen'),
				'bounceInDown' => esc_html__('Bounce In Down', 'ABdev_dzen'),
				'bounceInUp' => esc_html__('Bounce In Up', 'ABdev_dzen'),
				'bounceInLeft' => esc_html__('Bounce In Left', 'ABdev_dzen'),
				'bounceInRight' => esc_html__('Bounce In Right', 'ABdev_dzen'),
				'rotateIn' => esc_html__('Rotate In', 'ABdev_dzen'),
				'rotateInDownLeft' => esc_html__('Rotate In Down Left', 'ABdev_dzen'),
				'rotateInDownRight' => esc_html__('Rotate In Down Right', 'ABdev_dzen'),
				'rotateInUpLeft' => esc_html__('Rotate In Up Left', 'ABdev_dzen'),
				'rotateInUpRight' => esc_html__('Rotate In Up Right', 'ABdev_dzen'),
				'lightSpeedIn' => esc_html__('Light Speed In', 'ABdev_dzen'),
				'rollIn' => esc_html__('Roll In', 'ABdev_dzen'),
				'flash' => esc_html__('Flash', 'ABdev_dzen'),
				'bounce' => esc_html__('Bounce', 'ABdev_dzen'),
				'shake' => esc_html__('Shake', 'ABdev_dzen'),
				'tada' => esc_html__('Tada', 'ABdev_dzen'),
				'swing' => esc_html__('Swing', 'ABdev_dzen'),
				'wobble' => esc_html__('Wobble', 'ABdev_dzen'),
				'pulse' => esc_html__('Pulse', 'ABdev_dzen'),
			),
			'tab' => esc_html__('Animation', 'ABdev_dzen'),
		),
		'duration' => array(
			'description' => esc_html__('Animation Duration (ms)', 'ABdev_dzen'),
			'default' => '1100',
			'tab' => esc_html__('Animation', 'ABdev_dzen'),
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
function tcvpb_divider_tc_shortcode( $attributes ) {
    extract(shortcode_atts(tcvpb_extract_attributes('divider_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$icon_output = ($icon != '')?' <i class="'.$icon.'"></i>':'';
	$divider_style = ($style != '') ? 'tcvpb_divider_'.$style.'' : '';

	$animation_class = $animation_animation = $animation_duration = '';
	if (!empty($animation) && $animation!='none'){
		$animation_class = ' tcvpb-animo';
		$animation_animation = ' data-animation="'.esc_attr($animation).'"';
		$animation_duration = ($duration!='') ? ' data-duration="'.esc_attr($duration).'"' : ' data-duration="1"';
	}

	return '<div '.esc_attr($id_out).' class="tcvpb_divider '.esc_attr($divider_style).' '.esc_attr($class).'"><a href="#" class="backtotop'.esc_attr($animation_class).'"'.$animation_animation.$animation_duration.'>'.$text.$icon_output.'</a></div>';
}
