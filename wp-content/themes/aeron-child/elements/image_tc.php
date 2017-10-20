<?php

/*********** Shortcode: Image ************************************************************/

$tcvpb_elements['image_tc'] = array(
	'name' => esc_html__('Image', 'ABdev_dzen' ),
	'type' =>  'block',
	'icon' => 'pi-image',
	'category' =>  esc_html__('Media', 'ABdev_dzen'),
	'attributes' => array(
		'url' => array(
			'type' => 'image',
			'description' => esc_html__('Select Image', 'ABdev_dzen'),
			'divider' => 'true',
		),
		'animation' => array(
			'default' => '',
			'description' => esc_html__('Entrance Animation', 'ABdev_dzen'),
			'type' => 'select',
			'values' => array(
				'' => esc_html__('None', 'ABdev_dzen'),
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
		'timing' => array(
			'default' => 'linear',
			'description' => esc_html__('Timing Function', 'ABdev_dzen'),
			'type' => 'select',
			'values' => array(
				'linear' => esc_html__('Linear', 'ABdev_dzen'),
				'ease' => esc_html__('Ease', 'ABdev_dzen'),
				'ease-in' => esc_html__('Ease-in', 'ABdev_dzen'),
				'ease-out' => esc_html__('Ease-out', 'ABdev_dzen'),
				'ease-in-out' => esc_html__('Ease-in-out', 'ABdev_dzen'),
			),
			'tab' => esc_html__('Animation', 'ABdev_dzen'),
		),
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'ABdev_dzen'),
			'info' => esc_html__('Amount of pixels from bottom to start animation', 'ABdev_dzen'),
			'default' => '0',
			'tab' => esc_html__('Animation', 'ABdev_dzen'),
		),		
		'duration' => array(
			'description' => esc_html__('Animation Duration (in ms)', 'ABdev_dzen'),
			'default' => '1000',
			'tab' => esc_html__('Animation', 'ABdev_dzen'),
		),		
		'delay' => array(
			'description' => esc_html__('Animation Delay (in ms)', 'ABdev_dzen'),
			'default' => '0',
			'tab' => esc_html__('Animation', 'ABdev_dzen'),
		),
		'link' => array(
			'description' => esc_html__('Link', 'ABdev_dzen'),
			'type' => 'url',
		),
		'target' => array(
			'description' => esc_html__('Target', 'ABdev_dzen'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__('Self', 'ABdev_dzen'),
				'_blank' => esc_html__('Blank', 'ABdev_dzen'),
			),
			'divider' => 'true',
		),
		'lightbox' => array(
			'description' => esc_html__( 'Lightbox', 'ABdev_dzen' ),
			'default' => '0',
			'type' => 'checkbox',
		),
		'lightbox_icon' => array(
			'description' => esc_html__( 'Lightbox Icon', 'ABdev_dzen' ),
			'info' => esc_html__('Choose Lightbox Icon that will be shown on hover', 'ABdev_dzen'),
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
);
function tcvpb_image_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('image_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$classes=array();
	$animation_out='';

	if($animation!=''){
		$classes[] = 'tcvpb-animo';
		$duration = ($duration!='') ? $duration : '1000';
		$animation_out = 'data-animation="'.esc_attr($animation).'" data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	if($class!=''){
		$classes[] = $class;
	}

	$classes = implode(' ', $classes);

	$lightbox_icon = ($lightbox_icon!='') ? '<i class="'.esc_attr($lightbox_icon).'"></i>' : '';
	
              
	$return = '<div '.esc_attr($id_out).' class="tcvpb-image '.esc_attr($classes).'" '.$animation_out.'>';

	if($lightbox == '1') {
		$return .= '<a href="'.esc_url($url).'" class="lightbox" data-lightbox="image"><img src="'.esc_url($url).'">
			<canvas class="grey-effect"></canvas>
			'.$lightbox_icon.'
		</a>';
	}
	else if($link != '') {
		$return .= '<a href="'.esc_url($link).'" target="'.esc_attr($target).'"><img src="'.esc_url($url).'"></a>';
			// $return .= ($overlay_text !='') ? '<canvas class="grey-effect"></canvas><span>'.$overlay_text.'</span>' :'';
		// $return .= '</a>';
	}
	else{
		$return .= '<img src="'.esc_url($url).'">';
	}

	$return .= '</div>';

	return $return;
}
