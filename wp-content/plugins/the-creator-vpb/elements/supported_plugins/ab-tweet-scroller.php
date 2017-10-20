<?php 


/**
	ab-tweet-scroller plugin support
**/
if( in_array('ab-tweet-scroller/ab-tweet-scroller.php', get_option('active_plugins')) ){ //first check if plugin is installed
	$tcvpb_elements['ab_tweet_scroller'] = array(
		'name' => esc_html__('AB Tweet Scroller', 'the-creator-vpb' ),
		'description' => esc_html__('AB Tweet Scroller', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-tweet',
		'category' =>  esc_html__('Social', 'the-creator-vpb'),
		'third_party' => '1', 
		'attributes' => array(
			'user' => array(
				'description' => esc_html__('User', 'the-creator-vpb'),
				'info' => esc_html__('Displays different user than the one specified in API settings', 'the-creator-vpb'),
			),
			'limit' => array(
				'description' => esc_html__('Limit', 'the-creator-vpb'),
				'info' => esc_html__('Number of tweets to show', 'the-creator-vpb'),
				'default' => '5',
			),
			'link_target' => array(
				'description' => esc_html__('External Link Target', 'the-creator-vpb'),
				'default' => '_blank',
				'type' => 'select',
				'values' => array(
					'_blank' => esc_html__('Blank', 'the-creator-vpb'),
					'_self' =>  esc_html__('Self', 'the-creator-vpb'),
				),
				'divider' => 'true',
			),
			'hide_image' => array(
				'default' => '0',
				'type' => 'checkbox',
				'description' => esc_html__('Hide Image', 'the-creator-vpb'),
			),
			'hide_reply' => array(
				'default' => '0',
				'type' => 'checkbox',
				'description' => esc_html__('Hide Reply Link', 'the-creator-vpb'),
			),
			'hide_retweet' => array(
				'default' => '0',
				'type' => 'checkbox',
				'description' => esc_html__('Hide Retweet Link', 'the-creator-vpb'),
			),
			'hide_favorite' => array(
				'default' => '0',
				'type' => 'checkbox',
				'description' => esc_html__('Hide Favorite Link', 'the-creator-vpb'),
				'divider' => 'true',
			),
			'date_format' => array(
				'description' => esc_html__('Date Format', 'the-creator-vpb'),
				'info' => esc_html__('Specifies date format to be used, or to hide the date. Possible values are human, hide or PHP date format string', 'the-creator-vpb'),
				'default' => 'human',
			),
			'show_arrows' => array(
				'default' => '1',
				'type' => 'checkbox',
				'description' => esc_html__('Show Arrows', 'the-creator-vpb'),
			),
			'fx' => array(
				'description' => esc_html__('Effect', 'the-creator-vpb'),
				'default' => 'fade',
				'type' => 'select',
				'values' => array(
					'none' => esc_html__('none', 'the-creator-vpb'),
					'scroll' =>  esc_html__('scroll', 'the-creator-vpb'),
					'fade' =>  esc_html__('fade', 'the-creator-vpb'),
					'crossfade' =>  esc_html__('crossfade', 'the-creator-vpb'),
					'cover-fade' =>  esc_html__('cover-fade', 'the-creator-vpb'),
					'uncover-fade' =>  esc_html__('uncover-fade', 'the-creator-vpb'),
				),
				'tab' => esc_html__('Animation', 'the-creator-vpb'),
			),
			'easing' => array(
				'description' => esc_html__('Easing', 'the-creator-vpb'),
				'default' => 'swing',
				'type' => 'select',
				'values' => array(
					'linear' => esc_html__('linear', 'the-creator-vpb'),
					'swing' =>  esc_html__('swing', 'the-creator-vpb'),
					'cubic' =>  esc_html__('cubic', 'the-creator-vpb'),
					'elastic' =>  esc_html__('elastic', 'the-creator-vpb'),
				),
				'tab' => esc_html__('Animation', 'the-creator-vpb'),
			),
			'duration' => array(
				'description' => esc_html__('Transition Duration', 'the-creator-vpb'),
				'info' => esc_html__('Duration of transition in seconds', 'the-creator-vpb'),
				'default' => '1000',
				'tab' => esc_html__('Animation', 'the-creator-vpb'),
			),
			'pauseonhover' => array(
				'description' => esc_html__('Pause on Hover', 'the-creator-vpb'),
				'default' => 'immediate',
				'type' => 'select',
				'values' => array(
					'false' => esc_html__('false', 'the-creator-vpb'),
					'resume' =>  esc_html__('resume', 'the-creator-vpb'),
					'immediate' =>  esc_html__('immediate', 'the-creator-vpb'),
				),
				'tab' => esc_html__('Animation', 'the-creator-vpb'),
			),
			'timeoutduration' => array(
				'description' => esc_html__('Transition Duration', 'the-creator-vpb'),
				'info' => esc_html__('How long is each slide displayed, in seconds', 'the-creator-vpb'),
				'default' => '5000',
				'tab' => esc_html__('Animation', 'the-creator-vpb'),
			),
			'play' => array(
				'default' => '1',
				'type' => 'checkbox',
				'description' => esc_html__('Autoplay', 'the-creator-vpb'),
				'tab' => esc_html__('Animation', 'the-creator-vpb'),
			),
			'class' => array(
				'description' => esc_html__('Class', 'the-creator-vpb'),
				'info' => esc_html__('Additional custom classes for custom styling', 'the-creator-vpb'),
				'tab' => esc_html__('Advanced', 'the-creator-vpb'),
			),
		),
	);
}