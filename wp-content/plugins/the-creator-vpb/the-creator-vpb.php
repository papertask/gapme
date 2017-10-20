<?php
/*
Plugin Name: The Creator - Visual Page Builder
Plugin URI: http://themeforest.net/user/ab-themes?ref=ab-themes
Description: Visual page builder (drag and drop) containing great collection of animated elements with paralax effects and video backgrounds
Version: 1.3.0
Author: ab-themes
Author URI: http://themeforest.net/user/ab-themes?ref=ab-themes
*/

define('TCVPB_DIR', plugin_dir_url( __FILE__ ));
define('TCVPB_VERSION', '1.3.0');

global $tcvpb_elements;
$tcvpb_elements = array();


require_once 'admin/includes/options_page.php';
require_once 'includes/functions.php';
require_once 'admin/includes/hidden_metabox.php';
require_once 'includes/enqueue_scripts.php';
require_once 'admin/includes/enqueue_admin_scripts.php';


if (!function_exists('tcvpb_include_elements')){
	function tcvpb_include_elements(){
		global $tcvpb_elements;

		$core_shortcodes_path = get_stylesheet_directory().'/inc/core_shortcodes.php';
		if(current_theme_supports('the-creator-vpb') && is_file($core_shortcodes_path)){
			require_once $core_shortcodes_path;
		}
		else{
			require_once 'includes/core_shortcodes.php';
		}

		if (!current_theme_supports('the-creator-vpb')) {
			$files = scandir(dirname( __FILE__ ) . '/elements');
			foreach($files as $file) {
				if(is_file(dirname( __FILE__ ) . '/elements/'.$file)){
			  		include_once (dirname( __FILE__ ) . '/elements/'.$file);
				}
			}
		}
		
		$files = scandir(dirname( __FILE__ ) . '/elements/supported_plugins');
		foreach($files as $file) {
			if(is_file(dirname( __FILE__ ) . '/elements/supported_plugins/'.$file)){
		  		include_once (dirname( __FILE__ ) . '/elements/supported_plugins/'.$file);
			}
		}

	}
}
add_action('init', 'tcvpb_include_elements');


if (!function_exists('tcvpb_register_elements')){
	function tcvpb_register_elements() {
		global $tcvpb_elements;
		add_filter('widget_text', 'do_shortcode');
		load_plugin_textdomain('the-creator-vpb', false, dirname(plugin_basename( __FILE__ )).'/languages/');

		foreach (tcvpb_shortcodes() as $shortcode=>$params) {
			if (empty($params['third_party']) || $params['third_party']!=1){
				add_shortcode( $shortcode, 'tcvpb_'.$shortcode.'_shortcode');
			}
			if (isset($params['nesting']) && $params['nesting']!=''){
				add_shortcode( $shortcode.'_child', 'tcvpb_'.$shortcode.'_shortcode');
			}
		}

	}
}
add_action('init', 'tcvpb_register_elements', 50);


if (!function_exists('tcvpb_add_sidebars')){
	function tcvpb_add_sidebars() {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_sidebars = (isset($options['tcvpb_sidebars'])) ? explode(',', $options['tcvpb_sidebars'])  : array();
		$tcvpb_sidebars = array_map('trim',$tcvpb_sidebars);
		$tcvpb_sidebars = array_filter($tcvpb_sidebars);

		if(is_array($tcvpb_sidebars)){
			foreach($tcvpb_sidebars as $sidebar){
				register_sidebar(array(
					'name'=>$sidebar,
					'id'            => 'tc_'.tcvpb_name_to_id($sidebar),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<div class="sidebar-widget-heading"><h3>',
					'after_title' => '</h3></div>',
				));
			}
		}
	}
}
add_action('widgets_init', 'tcvpb_add_sidebars');



if (!function_exists('tcvpb_save_layout')){
	function tcvpb_save_layout(){
		global $wpdb; 
		add_option( 'tcvpb_shortcodes_layouts', '', '', 'no' );
		$layouts = get_option( 'tcvpb_shortcodes_layouts', array() );
		$name = $_POST['name'];
		if($_POST['source']=='new'){
			$i = 1;
			while(isset($layouts[$name])){
				$i++;
				$name = $_POST['name'] . '_' . $i;
			}
		}
		$layouts[$name]=$_POST['layout'];
		update_option('tcvpb_shortcodes_layouts', $layouts);
		die(__('Layout Saved', 'the-creator-vpb'));
	}
}
add_action('wp_ajax_tcvpb_save_layout', 'tcvpb_save_layout');

if (!function_exists('tcvpb_delete_layout')){
	function tcvpb_delete_layout(){
		global $wpdb; 
		$name = $_POST['name'];
		$layouts = get_option('tcvpb_shortcodes_layouts', '');
		if(isset($layouts[$name])){
			unset($layouts[$name]);
			update_option('tcvpb_shortcodes_layouts', $layouts);
			$out=__('Layout Deleted', 'the-creator-vpb');
		}
		else{
			$out=__('Layout doesn\'t exist', 'the-creator-vpb');
		}
		die($out);
	}
}
add_action('wp_ajax_tcvpb_delete_layout', 'tcvpb_delete_layout');

if (!function_exists('tcvpb_load_layout')){
	function tcvpb_load_layout(){
		global $wpdb; 
		$layouts = get_option('tcvpb_shortcodes_layouts', '');
		$out = str_replace("\'", "'", $layouts[$_POST['selected_layout']]);
		die($out);
	}
}
add_action('wp_ajax_tcvpb_load_layout', 'tcvpb_load_layout');

if (!function_exists('tcvpb_layouts_list')){
	function tcvpb_layouts_list(){
		global $wpdb; 
		$layouts = get_option('tcvpb_shortcodes_layouts', '');
		$out = array();
		if(is_array($layouts)){
			foreach ($layouts as $name => $value) {
				$out[] = $name;
			}
		}
		natcasesort($out);
		$out = implode('|', $out);
		die($out);
	}
}
add_action('wp_ajax_tcvpb_layouts_list', 'tcvpb_layouts_list');

