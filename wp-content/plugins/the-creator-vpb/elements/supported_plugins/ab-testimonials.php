<?php 

/**
	ab-testimonials plugin support
**/
if( in_array('ab-testimonials/ab-testimonials.php', get_option('active_plugins')) ){ //first check if plugin is installed
	$tcvpb_elements['AB_testimonials'] = array(
		'name' => esc_html__('Testimonials Slider', 'the-creator-vpb' ),
		'description' => esc_html__('Testimonials Slider', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-testimonials',
		'category' =>  esc_html__('Social', 'the-creator-vpb'),
		'third_party' => '1', 
		'attributes' => array(
			'category' => array(
				'description' => esc_html__('Testimonial Category', 'the-creator-vpb'),
				'info' => esc_html__('Show only testimonials from specific category, displays all categories if not specified (category slug string)', 'the-creator-vpb'),
			),
			'count' => array(
				'description' => esc_html__('Count', 'the-creator-vpb'),
				'info' => esc_html__('Number of testimonials to show', 'the-creator-vpb'),
				'default' => '8',
			),
			'style' => array(
				'default' => '1',
				'type' => 'select',
				'values' => array( 
					'1' => 'Testimonial Big',
					'2' => 'Testimonial Small with Image',
				),
				'description' => esc_html__('Style', 'the-creator-vpb'),
				'divider' => 'true',
			),
			'show_arrows' => array(
				'description' => esc_html__('Show Arrows', 'the-creator-vpb'),
				'type' => 'checkbox',
				'default' => '0',
			),
			'show_pagination' => array(
				'description' => esc_html__('Show Pagination', 'the-creator-vpb'),
				'type' => 'checkbox',
				'default' => '0',
				'divider' => 'true',
			),
			'delimiter' => array(
				'description' => esc_html__('Delimiter', 'the-creator-vpb'),
				'info' => esc_html__('Delimiter between author and company', 'the-creator-vpb'),
				'default' => '',
			),
			'fx' => array(
				'default' => 'crossfade',
				'type' => 'select',
				'values' => array( 
					'crossfade' => 'Crossfade',
					'cover-fade' => 'Cover-Fade',
					'fade' => 'Fade',
					'none' => 'None',
				),
				'description' => esc_html__('Slide Effect Name', 'the-creator-vpb'),
				'tab' => esc_html__('Animation', 'the-creator-vpb'),
			),
			'easing' => array(
				'default' => 'quadratic',
				'type' => 'select',
				'values' => array( 
					'linear' => 'linear',
					'swing' => 'swing',
					'quadratic' => 'quadratic',
					'cubic' => 'cubic',
					'elastic' => 'elastic',
				),
				'description' => esc_html__('Slide Effect Easing', 'the-creator-vpb'),
				'tab' => esc_html__('Animation', 'the-creator-vpb'),
			),
			'duration' => array(
				'description' => esc_html__('Duration', 'the-creator-vpb'),
				'default' => '1000',
				'info' => esc_html__('Duration of slide effect in milliseconds', 'the-creator-vpb'),
				'tab' => esc_html__('Animation', 'the-creator-vpb'),
			),
			'pauseOnHover' => array(
				'default' => 'immediate',
				'type' => 'select',
				'values' => array( 
					'false' => 'false',
					'resume' => 'resume',
					'immediate' => 'immediate',
				),
				'description' => esc_html__('Pause on Hover', 'the-creator-vpb'),
				'info' => esc_html__('Determines whether the timeout between transitions should be paused onMouseOver (only applies when play=true)', 'the-creator-vpb'),
				'tab' => esc_html__('Animation', 'the-creator-vpb'),
			),
			'timeoutduration' => array(
				'description' => esc_html__('Slide Duration', 'the-creator-vpb'),
				'default' => '5000',
				'info' => esc_html__('Pause between two slide animations in milliseconds', 'the-creator-vpb'),
				'tab' => esc_html__('Animation', 'the-creator-vpb'),
			),
			'direction' => array(
				'default' => 'left',
				'type' => 'select',
				'values' => array( 
					'left' => 'left',
					'right' => 'right',
				),
				'description' => esc_html__('Slide Direction', 'the-creator-vpb'),
				'tab' => esc_html__('Animation', 'the-creator-vpb'),
			),
			'play' => array(
				'description' => esc_html__('Autoplay Slider', 'the-creator-vpb'),
				'type' => 'checkbox',
				'default' => '1',
				'tab' => esc_html__('Animation', 'the-creator-vpb'),
			),
			'class' => array(
				'description' => esc_html__('Class', 'the-creator-vpb'),
				'info' => esc_html__('Additional custom classes for custom styling', 'the-creator-vpb'),
				'tab' => esc_html__('Advanced', 'the-creator-vpb'),
			),

		),
	);

	$tcvpb_elements['AB_testimonials_submit_form'] = array(
		'name' => esc_html__('Testimonials Submit Form', 'the-creator-vpb' ),
		'description' => esc_html__('Testimonials Submit Form', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-testimonials',
		'category' =>  esc_html__('Social', 'the-creator-vpb'),
		'third_party' => '1', 
		'attributes' => array(
			'client_placeholder' => array(
				'description' => esc_html__('Name field placeholder', 'the-creator-vpb'),
				'default' => esc_html__('Your Name', 'the-creator-vpb'),
			),
			'client_url_placeholder' => array(
				'description' => esc_html__('Profile field placeholder', 'the-creator-vpb'),
				'default' => esc_html__('Your Profile Link', 'the-creator-vpb'),
			),
			'client_image_placeholder' => array(
				'description' => esc_html__('Image upload field label', 'the-creator-vpb'),
				'default' => esc_html__('Your Image', 'the-creator-vpb'),
			),
			'company_placeholder' => array(
				'description' => esc_html__('Company name field placeholder', 'the-creator-vpb'),
				'default' => esc_html__('Your Company', 'the-creator-vpb'),
			),
			'company_url_placeholder' => array(
				'description' => esc_html__('Company link field placeholder', 'the-creator-vpb'),
				'default' => esc_html__('Your Company Link', 'the-creator-vpb'),
			),
			'text_placeholder' => array(
				'description' => esc_html__('Testimonial textarea placeholder', 'the-creator-vpb'),
				'default' => esc_html__('Your Testimonial', 'the-creator-vpb'),
			),
			'button_text_placeholder' => array(
				'description' => esc_html__('Submit button text', 'the-creator-vpb'),
				'default' => esc_html__('Submit Testimonial', 'the-creator-vpb'),
			),
			'class' => array(
				'description' => esc_html__('Class', 'the-creator-vpb'),
				'info' => esc_html__('Additional custom classes for custom styling', 'the-creator-vpb'),
				'tab' => esc_html__('Advanced', 'the-creator-vpb'),
			),
		),
	);
}
