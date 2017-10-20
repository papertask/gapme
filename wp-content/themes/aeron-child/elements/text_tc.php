<?php

/*********** Shortcode: Text Box ************************************************************/

$tcvpb_elements['text_tc'] = array(
	'name' => esc_html__('Text Box', 'ABdev_dzen' ),
	'description' => esc_html__('You can place any HTML content in this box and animate it.', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-text',
	'category' => esc_html__('Content', 'ABdev_dzen' ),
	'attributes' => array(
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
		),
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'ABdev_dzen'),
			'info' => esc_html__('Amount of pixels from bottom to start animation', 'ABdev_dzen'),
			'default' => '0',
		),		
		'duration' => array(
			'description' => esc_html__('Animation Duration (in ms)', 'ABdev_dzen'),
			'default' => '1000',
		),		
		'delay' => array(
			'description' => esc_html__('Animation Delay (in ms)', 'ABdev_dzen'),
			'default' => '0',
		),
		'members' => array(
			'description' => esc_html__( 'Hide Content Only to Members', 'ABdev_dzen' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'ABdev_dzen'),
		),
		'non_members' => array(
			'description' => esc_html__( 'Hide Content Only to Non Members', 'ABdev_dzen' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'ABdev_dzen'),
		),
		'desktop' => array(
			'description' => esc_html__( 'Hide on Desktop', 'ABdev_dzen' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'ABdev_dzen'),
		),
		'tablet' => array(
			'description' => esc_html__( 'Hide on Tablet', 'ABdev_dzen' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'ABdev_dzen'),
		),
		'phablet' => array(
			'description' => esc_html__( 'Hide on Phablet', 'ABdev_dzen' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'ABdev_dzen'),
		),
		'phone' => array(
			'description' => esc_html__( 'Hide on Phone', 'ABdev_dzen' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'ABdev_dzen'),
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
function tcvpb_text_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('text_tc'), $attributes));

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

	if($desktop==1){
		$classes[] = 'hidden-desktop';
	}

	if($tablet==1){
		$classes[] = 'hidden-tablet';
	}

	if($phablet==1){
		$classes[] = 'hidden-phablet';
	}

	if($phone==1){
		$classes[] = 'hidden-phone';
	}

	$classes = implode(' ', $classes);

	$id_out = ($id!='') ? 'id='.$id.'' : '';

	if ( ($members==1 && is_user_logged_in() && !is_null( $content ) && !is_feed()) || ($non_members==1 && !is_user_logged_in() && !is_null( $content ) && !is_feed()) ){
		return '';
	}
	else{
		return '<div '.esc_attr($id_out).' class="'.esc_attr($classes).'" '.$animation_out.'>'.do_shortcode($content).'</div>';
	}

}
