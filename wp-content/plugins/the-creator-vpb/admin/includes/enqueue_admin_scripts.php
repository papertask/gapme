<?php

function tcvpb_enqueue_admin_scripts($hook) {
	global $tcvpb_elements;
	$options = get_option( 'tcvpb_settings' );

	$tcvpb_disable_on = (isset($options['tcvpb_disable_on'])) ? explode(',', $options['tcvpb_disable_on'])  : array();
	$tcvpb_disable_on = array_map('trim',$tcvpb_disable_on);

	if(($hook == 'settings_page_tcvpb')){
		wp_enqueue_style('tcvpb-options_page-css', TCVPB_DIR.'admin/css/options_page.css', array(), TCVPB_VERSION);
		wp_enqueue_script('tcvpb-options_page', TCVPB_DIR.'admin/js/options_page.js', array('jquery'), TCVPB_VERSION, true);
	}

	if(in_array(tcvpb_get_current_post_type(), $tcvpb_disable_on)){
		return;
	}

	if(($hook != 'post.php' && $hook != 'post-new.php')){
		return;
	}

	$tcvpb_icons_array = array();
	// if theme has iconset include it
	$theme_icons_support_file = get_stylesheet_directory().'/css/icons/icons.php';
	$theme_icons_css_file = get_stylesheet_directory_uri().'/css/icons/icons.css';
	if(is_file($theme_icons_support_file)){
		wp_enqueue_style('tcvpb_theme_icons', $theme_icons_css_file, array(), TCVPB_VERSION);
		include $theme_icons_support_file;
	}
	// include enabled iconsets
	$fonts = array('typicons','themify','whhg','big_mug','elegant','entypo','font_awesome','google_material','icomoon','ionicon','material');
	foreach ($fonts as $font) {
		if(isset($options['tcvpb_enable_'.$font]) && $options['tcvpb_enable_'.$font]==1){
			wp_enqueue_style('tcvpb_icons_'.$font, TCVPB_DIR.'css/fonts/'.$font.'/'.$font.'.css', array(), TCVPB_VERSION);
			include dirname(dirname(dirname(__FILE__))).'/css/fonts/'.$font.'/'.$font.'.php';
		}
	}

	$element_categories=array(
		__('Content', 'the-creator-vpb' ) => __('Content', 'the-creator-vpb' ),
		__('Media', 'the-creator-vpb' ) => __('Media', 'the-creator-vpb' ),
	);
	foreach ($tcvpb_elements as $name => $element) {
		// echo '<br>'.$name.'<br>';
		if(isset($element['type']) && $element['type']=='block' && empty($element['hidden'])){
			$element_category = (isset($element['category'])) ? $element['category'] : esc_html__('Content', 'the-creator-vpb' );
			$element_categories[$element_category] = $element_category;
		}
	}
	$element_categories=array_values($element_categories);

	wp_enqueue_style('tcvpb-scripts-css', TCVPB_DIR.'admin/css/scripts.css', array(), TCVPB_VERSION);
	wp_enqueue_style('tcvpb-admin-icons', TCVPB_DIR.'admin/css/pluginicons/pluginicons.css', array(), TCVPB_VERSION);
	wp_enqueue_style('tcvpb-admin-style', TCVPB_DIR.'admin/css/admin.css', array('tcvpb-scripts-css','tcvpb-admin-icons'), TCVPB_VERSION);
	wp_enqueue_media();
	wp_enqueue_script('tcvpb-scripts', TCVPB_DIR.'admin/js/scripts.js', array(), TCVPB_VERSION,true);
	wp_enqueue_script('tcvpb-admin-script', TCVPB_DIR.'admin/js/admin.js', array('tcvpb-scripts','jquery-ui-sortable','jquery-ui-resizable','jquery-ui-draggable'), TCVPB_VERSION,true);
	wp_localize_script('tcvpb-admin-script', 'tcvpb_from_WP', array(
		'plugins_url' => plugins_url('the-creator-vpb'),
		'tcvpb_shortcode_names' => tcvpb_shortcode_names(),
		'tcvpb_3rd_party' => tcvpb_3rd_party(),
		'saved_layouts' => implode("|", array_keys(get_option('tcvpb_shortcodes_layouts',array()))),
		'save' => __('Save', 'the-creator-vpb'),
		'error_to_editor' => __('<b>Content cannot be parsed</b><br>Please use Text tab instead or Revisions option to undo recently made changes.<br><br>Check the syntax:<br>- Use double quotes for attributes<br>- Every shortcode must be closed. e.g. [gallery ids="1,20"] should be [gallery ids="1,20"][/gallery]', 'the-creator-vpb'),
		'delete_section' => __('Delete Section', 'the-creator-vpb'),
		'duplicate_section' => __('Duplicate Section', 'the-creator-vpb'),
		'edit_section' => __('Edit Section', 'the-creator-vpb'),
		'remove_column' => __('Remove Column', 'the-creator-vpb'),
		'remove' => __('Remove', 'the-creator-vpb'),
		'delete' => __('Delete', 'the-creator-vpb'),
		'load_layout' => __('Load Layout', 'the-creator-vpb'),
		'add_section' => __('Add Section', 'the-creator-vpb'),
		'add_column' => __('Add Column', 'the-creator-vpb'),
		'move_column' => __('Move Column', 'the-creator-vpb'),
		'add_element' => __('+ Element', 'the-creator-vpb'),
		'edit_column' => __('Column Properties', 'the-creator-vpb'),
		'text' => __('Text', 'the-creator-vpb'),
		'delete_element' => __('Delete Element', 'the-creator-vpb'),
		'duplicate_element' => __('Duplicate Element', 'the-creator-vpb'),
		'edit_element' => __('Edit Element', 'the-creator-vpb'),
		'drag_and_drop' => __('Drag & Drop', 'the-creator-vpb'),
		'classis_editor' => __('Classic', 'the-creator-vpb'),
		'add_edit_shortcode' => __('Add / Edit Shortcode', 'the-creator-vpb'),
		'select_icon' => __('Select Icon', 'the-creator-vpb'),
		'select_icon_info' => __('Icon sets can be enabled/disabled in Creator Settings', 'the-creator-vpb'),
		'select_element' => __('Select Element', 'the-creator-vpb'),
		'go_to_settings' => __('Go To Options Page', 'the-creator-vpb'),
		'switch_button_activate' => __('Use the Creator', 'the-creator-vpb'),
		'switch_button_deactivate' => __('Switch to Classic Editor', 'the-creator-vpb'),
		'fullscreen' => __('Fullscreen', 'the-creator-vpb'),
		'layouts' => __('Manage Layouts', 'the-creator-vpb'),
		'redo' => __('Redo', 'the-creator-vpb'),
		'undo' => __('Undo', 'the-creator-vpb'),
		'plus_section' => __('+ Section', 'the-creator-vpb'),
		'untitled_section' => __('Untitled section', 'the-creator-vpb'),
		'collapse_children' => __('Collapse and Sort Child Elements', 'the-creator-vpb'),
		'delete_image' => __('Delete Image', 'the-creator-vpb'),
		'upload_image' => __('Upload Image', 'the-creator-vpb'),
		'upload_gallery' => __('Upload Gallery', 'the-creator-vpb'),
		'upload_media' => __('Upload Media', 'the-creator-vpb'),
		'add_child' => __('Add Child', 'the-creator-vpb'),
		'spectrum_select' => __('Select', 'the-creator-vpb'),
		'spectrum_cancel' => __('cancel', 'the-creator-vpb'),
		'layout_saved' => __('Layout successfully saved', 'the-creator-vpb'),
		'layout_name_required' => __('Layout name is required', 'the-creator-vpb'),
		'back_to_list' => __('Back to list', 'the-creator-vpb'),
		'column_properties' => __('Column Properties', 'the-creator-vpb'),
		'update_column_properties' => __('Update Column Properties', 'the-creator-vpb'),
		'update_section_properties' => __('Update Section Properties', 'the-creator-vpb'),
		'section_properties' => __('Section Properties', 'the-creator-vpb'),
		'cross_margin' => __('margin', 'the-creator-vpb'),
		'cross_border' => __('border', 'the-creator-vpb'),
		'cross_padding' => __('padding', 'the-creator-vpb'),
		'cancel' => __('Cancel', 'the-creator-vpb'),
		'done' => __('Done', 'the-creator-vpb'),
		'save_layout' => __('Save Layout', 'the-creator-vpb'),
		'new_layout' => __('New Layout', 'the-creator-vpb'),
		'layout_overwrite' => __('Overwrite', 'the-creator-vpb'),
		'layout_save' => __('Save Layout', 'the-creator-vpb'),
		'layout_delete' => __('Delete Layout', 'the-creator-vpb'),
		'select_layout' => __('Add Layout to Content', 'the-creator-vpb'),
		'layout_name' => __('Enter layout name', 'the-creator-vpb'),
		'layout_name_delete' => __('Layout name to delete', 'the-creator-vpb'),
		'layout_saved' => __('Layout successfully saved', 'the-creator-vpb'),
		'layout_select_saved' => __('You have <span>no content yet.</span><br>Start by adding section or loading saved layout', 'the-creator-vpb'),
		'rearange_sections' => __('Rearrange Sections', 'the-creator-vpb'),
		'property_disabled' => __('Not available due to grid preservation', 'the-creator-vpb'),
		'are_you_sure' => __('Are you sure?', 'the-creator-vpb'),
		'dnd_content' => __("Content on this page is made with another page builder. \n\nCreator will try to parse it using as many content as it can. \n\nDepending on content, some elements or attributes can be unrecognized (e.g. icons) and will be ignored. Make sure you have backup in case you want to go back. \n\nAre you sure you want to do this?", 'the-creator-vpb'),
		'column_delete_confirm' => __("This will delete column and all elements in it. \nAre you sure?", 'the-creator-vpb'),
		'custom_column_class' => __('Custom Column Class', 'the-creator-vpb'),
		'animation' => __('Animation', 'the-creator-vpb'),
		'search' => __('search', 'the-creator-vpb'),
		'general_tab' => __('General', 'the-creator-vpb'),
		'none' => __('None', 'the-creator-vpb'),
		'animation_duration' => __('Animation Duration ms', 'the-creator-vpb'),
		'animation_delay' => __('Animation Delay ms', 'the-creator-vpb'),
		'custom_section_class' => __('Custom Section Class', 'the-creator-vpb'),
		'fullwidth' => __('Fullwidth Content', 'the-creator-vpb'),
		'no_column_margin' => __('No Margin on Columns', 'the-creator-vpb'),
		'equalize_five' => __('5 Columns Equalize', 'the-creator-vpb'),
		'equalize_five_info' => __('Check this if you want 5 columns to be equal width (out of grid, use only 2/12 and 3/12 columns)', 'the-creator-vpb'),
		'video_bg' => __('Video Background', 'the-creator-vpb'),
		'video_bg_info' => __('If checked video background will be enabled. Video files should have same name as Background Image, and same path, only different extensions (mp4,webm,ogv files required). You can use Miro Converter to convert files in required formats.', 'the-creator-vpb'),
		'background_color' => __('Background Color', 'the-creator-vpb'),
		'background_image' => __('Background Image URL', 'the-creator-vpb'),
		'parallax' => __('Background Parallax Factor', 'the-creator-vpb'),
		'parallax_info' => __('0.1 means 10% of scroll, 2 means twice of scroll', 'the-creator-vpb'),
		'flip' => __( 'Flip', 'the-creator-vpb' ),
		'flipInX' => __( 'Flip In X', 'the-creator-vpb' ),
		'flipInY' => __( 'Flip In Y', 'the-creator-vpb' ),
		'fadeIn' => __( 'Fade In', 'the-creator-vpb' ),
		'fadeInUp' => __( 'Fade In Up', 'the-creator-vpb' ),
		'fadeInDown' => __( 'Fade In Down', 'the-creator-vpb' ),
		'fadeInLeft' => __( 'Fade In Left', 'the-creator-vpb' ),
		'fadeInRight' => __( 'Fade In Right', 'the-creator-vpb' ),
		'fadeInUpBig' => __( 'Fade In Up Big', 'the-creator-vpb' ),
		'fadeInDownBig' => __( 'Fade In Down Big', 'the-creator-vpb' ),
		'fadeInLeftBig' => __( 'Fade In Left Big', 'the-creator-vpb' ),
		'fadeInRightBig' => __( 'Fade In Right Big', 'the-creator-vpb' ),
		'slideInLeft' => __( 'Slide In Left', 'the-creator-vpb' ),
		'slideInRight' => __( 'Slide In Right', 'the-creator-vpb' ),
		'bounceIn' => __( 'Bounce In', 'the-creator-vpb' ),
		'bounceInDown' => __( 'Bounce In Down', 'the-creator-vpb' ),
		'bounceInUp' => __( 'Bounce In Up', 'the-creator-vpb' ),
		'bounceInLeft' => __( 'Bounce In Left', 'the-creator-vpb' ),
		'bounceInRight' => __( 'Bounce In Right', 'the-creator-vpb' ),
		'rotateIn' => __( 'Rotate In', 'the-creator-vpb' ),
		'rotateInDownLeft' => __( 'Rotate In Down Left', 'the-creator-vpb' ),
		'rotateInDownRight' => __( 'Rotate In Down Right', 'the-creator-vpb' ),
		'rotateInUpLeft' => __( 'Rotate In Up Left', 'the-creator-vpb' ),
		'rotateInUpRight' => __( 'Rotate In Up Right', 'the-creator-vpb' ),
		'lightSpeedIn' => __( 'Light Speed In', 'the-creator-vpb' ),
		'rollIn' => __( 'Roll In', 'the-creator-vpb' ),
		'flash' => __( 'Flash', 'the-creator-vpb' ),
		'bounce' => __( 'Bounce', 'the-creator-vpb' ),
		'shake' => __( 'Shake', 'the-creator-vpb' ),
		'tada' => __( 'Tada', 'the-creator-vpb' ),
		'swing' => __( 'Swing', 'the-creator-vpb' ),
		'wobble' => __( 'Wobble', 'the-creator-vpb' ),
		'pulse' => __( 'Pulse', 'the-creator-vpb' ),
		'upload_image' => __( 'Upload Image', 'the-creator-vpb' ),
		'choose_image' => __( 'Choose Image', 'the-creator-vpb' ),
		'use_image' => __( 'Use Image', 'the-creator-vpb' ),
		'section_title' => __( 'Section Title', 'the-creator-vpb' ),
		'section_id' => __( 'Section ID', 'the-creator-vpb' ),
		'section_intro' => __( 'Section Intro', 'the-creator-vpb' ),
		'section_outro' => __( 'Section Outro', 'the-creator-vpb' ),
		'elements' => json_encode($tcvpb_elements),
		'categories' => json_encode($element_categories),
		'icons' => json_encode($tcvpb_icons_array),
		'tcvpb_history_amount' => ((isset($options['tcvpb_history_amount']) && $options['tcvpb_history_amount']>0) ? $options['tcvpb_history_amount'] : 10)
	));
}
add_action( 'admin_enqueue_scripts', 'tcvpb_enqueue_admin_scripts' );



// TinyMCE external plugins
function tcvpb_mce_external_plugins($plugins) {
	// $plugins['code'] = TCVPB_DIR . 'admin/js/mce.plugin.code.min.js';
	$plugins['link'] = TCVPB_DIR . 'admin/js/mce.plugin.link.min.js';
	$plugins['hr'] = TCVPB_DIR . 'admin/js/mce.plugin.hr.min.js';
	$plugins['charmap'] = TCVPB_DIR . 'admin/js/mce.plugin.charmap.min.js';
	$plugins['searchreplace'] = TCVPB_DIR . 'admin/js/mce.plugin.searchreplace.min.js';
	$plugins['table'] = TCVPB_DIR . 'admin/js/mce.plugin.table.min.js';
	$plugins['textcolor'] = TCVPB_DIR . 'admin/js/mce.plugin.textcolor.min.js';
	return $plugins;
}
add_filter('mce_external_plugins', 'tcvpb_mce_external_plugins');