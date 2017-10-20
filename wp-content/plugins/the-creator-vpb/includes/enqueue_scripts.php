<?php
function tcvpb_enqueue_frontend_script() {
	$options = get_option( 'tcvpb_settings' );

	if(isset($options['tcvpb_enable_typicons']) && $options['tcvpb_enable_typicons']==1){
		wp_enqueue_style('tcvpb_icons_typicons', TCVPB_DIR.'css/fonts/typicons/typicons.css', array(), TCVPB_VERSION);
	}
	if(isset($options['tcvpb_enable_themify']) && $options['tcvpb_enable_themify']==1){
		wp_enqueue_style('tcvpb_icons_themify', TCVPB_DIR.'css/fonts/themify/themify.css', array(), TCVPB_VERSION);
	}
	if(isset($options['tcvpb_enable_whhg']) && $options['tcvpb_enable_whhg']==1){
		wp_enqueue_style('tcvpb_icons_whhg', TCVPB_DIR.'css/fonts/whhg/whhg.css', array(), TCVPB_VERSION);
	}
	if(isset($options['tcvpb_enable_big_mug']) && $options['tcvpb_enable_big_mug']==1){
		wp_enqueue_style('tcvpb_icons_big_mug', TCVPB_DIR.'css/fonts/big_mug/big_mug.css', array(), TCVPB_VERSION);
	}
	if(isset($options['tcvpb_enable_elegant']) && $options['tcvpb_enable_elegant']==1){
		wp_enqueue_style('tcvpb_icons_elegant', TCVPB_DIR.'css/fonts/elegant/elegant.css', array(), TCVPB_VERSION);
	}
	if(isset($options['tcvpb_enable_entypo']) && $options['tcvpb_enable_entypo']==1){
		wp_enqueue_style('tcvpb_icons_entypo', TCVPB_DIR.'css/fonts/entypo/entypo.css', array(), TCVPB_VERSION);
	}
	if(isset($options['tcvpb_enable_font_awesome']) && $options['tcvpb_enable_font_awesome']==1){
		wp_enqueue_style('tcvpb_icons_font_awesome', TCVPB_DIR.'css/fonts/font_awesome/font_awesome.css', array(), TCVPB_VERSION);
	}
	if(isset($options['tcvpb_enable_google_material']) && $options['tcvpb_enable_google_material']==1){
		wp_enqueue_style('tcvpb_icons_google_material', TCVPB_DIR.'css/fonts/google_material/google_material.css', array(), TCVPB_VERSION);
	}
	if(isset($options['tcvpb_enable_icomoon']) && $options['tcvpb_enable_icomoon']==1){
		wp_enqueue_style('tcvpb_icons_icomoon', TCVPB_DIR.'css/fonts/icomoon/icomoon.css', array(), TCVPB_VERSION);
	}
	if(isset($options['tcvpb_enable_ionicon']) && $options['tcvpb_enable_ionicon']==1){
		wp_enqueue_style('tcvpb_icons_ionicon', TCVPB_DIR.'css/fonts/ionicon/ionicon.css', array(), TCVPB_VERSION);
	}
	if(isset($options['tcvpb_enable_material']) && $options['tcvpb_enable_material']==1){
		wp_enqueue_style('tcvpb_icons_material', TCVPB_DIR.'css/fonts/material/material.css', array(), TCVPB_VERSION);
	}


	// if theme has iconset include it
	$theme_icons_support_file = get_stylesheet_directory().'/css/icons/icons.php';
	$theme_icons_css_file = get_stylesheet_directory_uri().'/css/icons/icons.css';
	if(is_file($theme_icons_support_file)){
		wp_enqueue_style('tcvpb_theme_icons', $theme_icons_css_file, array(), TCVPB_VERSION);
	}


	if (!current_theme_supports('the-creator-vpb')){
		wp_enqueue_style('wp-mediaelement');
		wp_enqueue_style('tcvpb_scripts', TCVPB_DIR.'css/scripts.css', array(), TCVPB_VERSION);
		// $selected_style_file = (isset($options['tcvpb_style']) && $options['tcvpb_style']!='') ? $options['tcvpb_style'] : 'default.css';
		wp_enqueue_style('tcvpb', TCVPB_DIR.'css/themes/default.css', array('tcvpb_scripts'), TCVPB_VERSION);

		wp_enqueue_script('wp-mediaelement');
		$google_maps_api_key = '';
		if(isset($options['tcvpb_google_map_api_key']) && $options['tcvpb_google_map_api_key'] != ''){
			$google_maps_api_key = '?key='.$options['tcvpb_google_map_api_key'];
		}
		wp_enqueue_script('google_maps_api', '//maps.googleapis.com/maps/api/js'.esc_attr($google_maps_api_key).'','','', true);
		wp_register_script('chart', TCVPB_DIR.'js/chart.js', array('jquery'), TCVPB_VERSION, true);
		wp_enqueue_script('scripts', TCVPB_DIR.'js/scripts.js', array('jquery','google_maps_api'), TCVPB_VERSION, true);
		wp_enqueue_script('the-creator-vpb', TCVPB_DIR.'js/init.js', array('jquery', 'jquery-ui-accordion', 'jquery-effects-slide', 'scripts'), TCVPB_VERSION, true);
		$tcvpb_tipsy_opacity = (isset($options['tcvpb_tipsy_opacity'])) ? $options['tcvpb_tipsy_opacity'] : '0.8';
		$tcvpb_custom_map_style = (isset($options['tcvpb_custom_map_style'])) ? $options['tcvpb_custom_map_style'] : '';
		wp_localize_script( 'the-creator-vpb', 'tcvpb_options', array(
			'tcvpb_tipsy_opacity' => $tcvpb_tipsy_opacity,
			'tcvpb_custom_map_style' => preg_replace('!\s+!', ' ', str_replace(array("\n","\r","\t"), '', $tcvpb_custom_map_style)),
		) );

	}

}
add_action( 'wp_enqueue_scripts', 'tcvpb_enqueue_frontend_script' );
