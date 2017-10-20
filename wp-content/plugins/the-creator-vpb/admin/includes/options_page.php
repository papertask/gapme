<?php

add_action( 'admin_menu', 'tcvpb_add_admin_menu' );
add_action( 'admin_init', 'tcvpb_settings_init' );

function tcvpb_add_admin_menu(  ) {
	add_options_page( __( 'The Creator', 'the-creator-vpb' ), __( 'The Creator', 'the-creator-vpb' ), 'manage_options', 'tcvpb', 'tcvpb_options_page');
}

function tcvpb_options_page(  ) {
	?>
	<div id="tcvpb_options_page_form">
		<h2><?php _e( 'The Creator - Visual Page Builder', 'the-creator-vpb' ) ?></h2>
		<form action='options.php' method='post'>
			<?php
			settings_fields( 'tcvpb_options_page' );
			do_settings_sections( 'tcvpb_options_page' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}


function tcvpb_settings_init(  ) {
	register_setting( 'tcvpb_options_page', 'tcvpb_settings' );

	/**
		----------------------------------------------------------
		SECTION : General
		----------------------------------------------------------
	**/
	add_settings_section(
		'tcvpb_shortcodes_settings',
		__( 'General', 'the-creator-vpb' ),
		'',
		'tcvpb_options_page'
	);

	/**
		Default Editor
	**/
	add_settings_field(
		'tcvpb_is_default',
		__( 'Default Editor', 'the-creator-vpb' ),
		'tcvpb_is_default_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_settings'
	);
	function tcvpb_is_default_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_is_default = (isset($options['tcvpb_is_default'])) ? $options['tcvpb_is_default'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_is_default]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_is_default]' id='tcvpb_settings[tcvpb_is_default]' <?php checked( $tcvpb_is_default, 1 ); ?> value='1'>
			<?php _e( 'Use the Creator as Default Editor', 'the-creator-vpb' ) ?>
		</label>
		<p class="description"><?php _e( 'When creating new page or post activate the Creator immediately instead default WordPress WYSIWYG editor.', 'the-creator-vpb' ) ?></p>
		<?php
	}

	/**
		Select Theme
	**/
	/*
	if(!is_file(get_stylesheet_directory().'/css/tcvpb-shortcodes.css')){
		add_settings_field(
			'tcvpb_style',
			__( "Select Theme", 'the-creator-vpb' ),
			'tcvpb_theme_render',
			'tcvpb_options_page',
			'tcvpb_shortcodes_settings'
		);
		function tcvpb_theme_render(  ) {
			$options = get_option( 'tcvpb_settings' );
			$tcvpb_style = (isset($options['tcvpb_style'])) ? $options['tcvpb_style'] : '';
			?>
			<select name="tcvpb_settings[tcvpb_style]">
				<?php
				echo '<option value="default.css" '.selected('default.css',$tcvpb_style).'>'.__( 'Default Style', 'the-creator-vpb' ).'</option>';
				$styles_directory = realpath(dirname(__FILE__) . '/..') . '/css/themes';
				$files = scandir($styles_directory);
				foreach($files as $file) {
					if($file!='default.css' && is_file($styles_directory . '/'.$file)){
						$style_metadata = get_file_data( $styles_directory . '/'.$file, array('style' => 'Style Name') );
						$option_name_out = (!empty($style_metadata['style'])) ? $style_metadata['style'] : $file;
						echo '<option value="'.$file.'" '.selected($file,$tcvpb_style).'>'.$option_name_out.'</option>';
					}
				}
				?>
			</select>
			<p class="description"><?php _e( 'Select global elements theme', 'the-creator-vpb' ) ?></p>
			<?php
		}
	}
	*/

	/**
		Disable D'n'D Tab on
	**/
	add_settings_field(
		'tcvpb_disable_on',
		__( "Disable Creator on", 'the-creator-vpb' ),
		'tcvpb_disable_on_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_settings'
	);
	function tcvpb_disable_on_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_disable_on = (isset($options['tcvpb_disable_on'])) ? $options['tcvpb_disable_on'] : '';
		?>
		<input type='text' name='tcvpb_settings[tcvpb_disable_on]' value='<?php echo esc_attr($tcvpb_disable_on); ?>'>
		<p class="description"><?php _e( 'Coma-separated list of post types for which you want to disable the Creator<br><small>(e.g. post, page, forum)</small>', 'the-creator-vpb' ) ?></p>
		<?php
	}

	/**
		Excerpt content
	**/
	add_settings_field(
		'tcvpb_excerpt',
		__( 'Excerpt content', 'the-creator-vpb' ),
		'tcvpb_excerpt_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_settings'
	);
	function tcvpb_excerpt_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_excerpt = (isset($options['tcvpb_excerpt'])) ? $options['tcvpb_excerpt'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_excerpt]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_excerpt]' id='tcvpb_settings[tcvpb_excerpt]' <?php checked( $tcvpb_excerpt, 1 ); ?> value='1'>
			<?php _e( 'Show shortcode content in excerpt', 'the-creator-vpb' ) ?>
		</label>
		<p class="description"><?php _e( 'Content inside shortcode is not visible in excerpt by default. To enable it use this option. It will use custom function for excerpt output.', 'the-creator-vpb' ) ?></p>
		<?php
	}

	/**
		Developer Mode
	**/
	add_settings_field(
		'tcvpb_developer',
		__( 'Developer Mode', 'the-creator-vpb' ),
		'tcvpb_developer_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_settings'
	);
	function tcvpb_developer_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_developer = (isset($options['tcvpb_developer'])) ? $options['tcvpb_developer'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_developer]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_developer]' id='tcvpb_settings[tcvpb_developer]' <?php checked( $tcvpb_developer, 1 ); ?> value='1'>
			<?php _e( 'Enable', 'the-creator-vpb' ) ?>
		</label>
		<p class="description"><?php _e( 'Enable developer mode and show content holder meta box.', 'the-creator-vpb' ) ?></p>
		<?php
	}

	/**
		Additional Sidebars
	**/
	add_settings_field(
		'tcvpb_sidebars',
		__( 'Additional Sidebars', 'the-creator-vpb' ),
		'tcvpb_sidebars_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_settings'
	);
	function tcvpb_sidebars_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_sidebars = (isset($options['tcvpb_sidebars'])) ? $options['tcvpb_sidebars'] : '';
		?>
		<input type='text' name='tcvpb_settings[tcvpb_sidebars]' value='<?php echo esc_attr($tcvpb_sidebars); ?>'>
		<p class="description"><?php _e( 'Coma-separated list of sidebars to add. You can add widgets in created sidebars and use sidebars in Sidebar element - this way all widgets are supported by The Creator plugin.<br><small>(e.g. My First Sidebar, My Second Sidebar)</small>', 'the-creator-vpb' ) ?></p>
		<?php
	}

	/**
		Tooltip Opacity
	**/
	add_settings_field(
		'tcvpb_tipsy_opacity',
		__( 'Tooltip Opacity', 'the-creator-vpb' ),
		'tcvpb_tipsy_opacity_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_settings'
	);
	function tcvpb_tipsy_opacity_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_tipsy_opacity = (isset($options['tcvpb_tipsy_opacity'])) ? $options['tcvpb_tipsy_opacity'] : '0.8';
		?>
		<input type='text' name='tcvpb_settings[tcvpb_tipsy_opacity]' value='<?php echo esc_attr($tcvpb_tipsy_opacity); ?>'>
		<p class="description"><?php _e( 'Balloon tooltip opacity. Values from 0.0 to 1.0, default is 0.8.', 'the-creator-vpb' ) ?></p>
		<?php
	}

	/**
		History Amount
	**/
	add_settings_field(
		'tcvpb_history_amount',
		__( 'History Amount', 'the-creator-vpb' ),
		'tcvpb_history_amount_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_settings'
	);
	function tcvpb_history_amount_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_history_amount = (isset($options['tcvpb_history_amount'])) ? $options['tcvpb_history_amount'] : '10';
		?>
		<input type='text' name='tcvpb_settings[tcvpb_history_amount]' value='<?php echo esc_attr($tcvpb_history_amount); ?>'>
		<p class="description"><?php _e( 'Set the amount of states stored for undo feature.<br><small>(default 10)</small>', 'the-creator-vpb' ) ?></p>
		<?php
	}

	/**
		Custom Map Styling
	**/
	add_settings_field(
		'tcvpb_custom_map_style',
		__( 'Custom Map Styling', 'the-creator-vpb' ),
		'tcvpb_custom_map_style_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_settings'
	);
	function tcvpb_custom_map_style_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_custom_map_style = (isset($options['tcvpb_custom_map_style'])) ? $options['tcvpb_custom_map_style'] : '';
		?>
		<textarea class='large-text code' name='tcvpb_settings[tcvpb_custom_map_style]' cols='50' rows='10'><?php echo esc_textarea($tcvpb_custom_map_style); ?></textarea>
		<p class="description"><?php _e( 'For more details please check <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">Google Maps API v3</a> documentation. To create custom map style JSON you can use <a href="http://googlemaps.github.io/js-samples/styledmaps/wizard/index.html">Maps API style Wizard</a> or use some template from <a href="http://snazzymaps.com/">Snazzy Maps</a>', 'the-creator-vpb' ) ?></p>
		<?php
	}

	/**
		Google Map API Key
	**/
	add_settings_field(
		'tcvpb_google_map_api_key',
		__( 'Google Map API Key', 'the-creator-vpb' ),
		'tcvpb_google_map_api_key_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_settings'
	);
	function tcvpb_google_map_api_key_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_google_map_api_key = (isset($options['tcvpb_google_map_api_key'])) ? $options['tcvpb_google_map_api_key'] : '';
		?>
		<input type='text' name='tcvpb_settings[tcvpb_google_map_api_key]' value='<?php echo esc_attr($tcvpb_google_map_api_key); ?>' size="45">
		<p class="description"><?php _e( 'For more details please check <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">Google Maps API v3</a> documentation.', 'the-creator-vpb' ) ?></p>
		<?php
	}


	/**
		----------------------------------------------------------
		SECTION : Font Icons
		----------------------------------------------------------
	**/
	add_settings_section(
		'tcvpb_shortcodes_icons',
		__( 'Font Icons', 'the-creator-vpb' ),
		'tcvpb_icons_section_render',
		'tcvpb_options_page'
	);
	function tcvpb_icons_section_render(  ) {
		echo '<p class="tcvpb_options_section_intro">'.__('Here you can enable font icon packs that you wish to use and see complete list of icons with their names. You can also use icon name of any similar icon pack that is bundled with theme.', 'the-creator-vpb' ).'</p>';
	}



	/**
		BigMug
	**/
	add_settings_field(
		'tcvpb_enable_big_mug',
		__( 'BigMug', 'the-creator-vpb' ),
		'tcvpb_enable_big_mug_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_icons'
	);
	function tcvpb_enable_big_mug_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_enable_big_mug = (isset($options['tcvpb_enable_big_mug'])) ? $options['tcvpb_enable_big_mug'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_enable_big_mug]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_enable_big_mug]' id='tcvpb_settings[tcvpb_enable_big_mug]' <?php checked( $tcvpb_enable_big_mug, 1 ); ?> value='1'>
			<?php _e( 'Enable BigMug Icons', 'the-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e( 'Check this to enable BigMug icons. Complete list of icons and their names can be found', 'the-creator-vpb' ) ?> <a href="<?php echo TCVPB_DIR.'css/fonts/big_mug/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Big Mug (font: big_mug)"  class="thickbox" ><?php _e( 'here', 'the-creator-vpb' ) ?></a>.</p>
		<?php
	}


	/**
		Entypo
	**/
	add_settings_field(
		'tcvpb_enable_entypo',
		__( 'Entypo', 'the-creator-vpb' ),
		'tcvpb_enable_entypo_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_icons'
	);
	function tcvpb_enable_entypo_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_enable_entypo = (isset($options['tcvpb_enable_entypo'])) ? $options['tcvpb_enable_entypo'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_enable_entypo]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_enable_entypo]' id='tcvpb_settings[tcvpb_enable_entypo]' <?php checked( $tcvpb_enable_entypo, 1 ); ?> value='1'>
			<?php _e( 'Enable Entypo Icons', 'the-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e( 'Check this to enable Entypo icons. Complete list of icons and their names can be found', 'the-creator-vpb' ) ?> <a href="<?php echo TCVPB_DIR.'css/fonts/entypo/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Entypo (font: entypo)"  class="thickbox" ><?php _e( 'here', 'the-creator-vpb' ) ?></a>.</p>
		<?php
	}


	/**
		Elegant
	**/
	add_settings_field(
		'tcvpb_enable_elegant',
		__( 'Elegant', 'the-creator-vpb' ),
		'tcvpb_enable_elegant_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_icons'
	);
	function tcvpb_enable_elegant_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_enable_elegant = (isset($options['tcvpb_enable_elegant'])) ? $options['tcvpb_enable_elegant'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_enable_elegant]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_enable_elegant]' id='tcvpb_settings[tcvpb_enable_elegant]' <?php checked( $tcvpb_enable_elegant, 1 ); ?> value='1'>
			<?php _e( 'Enable Elegant Icons', 'the-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e( 'Check this to enable Elegant icons. Complete list of icons and their names can be found', 'the-creator-vpb' ) ?> <a href="<?php echo TCVPB_DIR.'css/fonts/elegant/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Elegant (font: elegant)"  class="thickbox" ><?php _e( 'here', 'the-creator-vpb' ) ?></a>.</p>
		<?php
	}


	/**
		FontAwesome
	**/
	add_settings_field(
		'tcvpb_enable_font_awesome',
		__( 'FontAwesome', 'the-creator-vpb' ),
		'tcvpb_enable_font_awesome_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_icons'
	);
	function tcvpb_enable_font_awesome_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_enable_font_awesome = (isset($options['tcvpb_enable_font_awesome'])) ? $options['tcvpb_enable_font_awesome'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_enable_font_awesome]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_enable_font_awesome]' id='tcvpb_settings[tcvpb_enable_font_awesome]' <?php checked( $tcvpb_enable_font_awesome, 1 ); ?> value='1'>
			<?php _e( 'Enable FontAwesome Icons', 'the-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e( 'Check this to enable FontAwesome icons. Complete list of icons and their names can be found', 'the-creator-vpb' ) ?> <a href="<?php echo TCVPB_DIR.'css/fonts/font_awesome/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Font Awesome (font: font_awesome)"  class="thickbox" ><?php _e( 'here', 'the-creator-vpb' ) ?></a>.</p>
		<?php
	}


	/**
		Google Material
	**/
	add_settings_field(
		'tcvpb_enable_google_material',
		__( 'Google Material', 'the-creator-vpb' ),
		'tcvpb_enable_google_material_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_icons'
	);
	function tcvpb_enable_google_material_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_enable_google_material = (isset($options['tcvpb_enable_google_material'])) ? $options['tcvpb_enable_google_material'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_enable_google_material]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_enable_google_material]' id='tcvpb_settings[tcvpb_enable_google_material]' <?php checked( $tcvpb_enable_google_material, 1 ); ?> value='1'>
			<?php _e( 'Enable Google Material Icons', 'the-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e( 'Check this to enable Google Material icons. Complete list of icons and their names can be found', 'the-creator-vpb' ) ?> <a href="<?php echo TCVPB_DIR.'css/fonts/google_material/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Google Material (font: google_material)"  class="thickbox" ><?php _e( 'here', 'the-creator-vpb' ) ?></a>.</p>
		<?php
	}


	/**
		Icomoon
	**/
	add_settings_field(
		'tcvpb_enable_icomoon',
		__( 'Icomoon', 'the-creator-vpb' ),
		'tcvpb_enable_icomoon_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_icons'
	);
	function tcvpb_enable_icomoon_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_enable_icomoon = (isset($options['tcvpb_enable_icomoon'])) ? $options['tcvpb_enable_icomoon'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_enable_icomoon]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_enable_icomoon]' id='tcvpb_settings[tcvpb_enable_icomoon]' <?php checked( $tcvpb_enable_icomoon, 1 ); ?> value='1'>
			<?php _e( 'Enable Icomoon Icons', 'the-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e( 'Check this to enable Icomoon icons. Complete list of icons and their names can be found', 'the-creator-vpb' ) ?> <a href="<?php echo TCVPB_DIR.'css/fonts/icomoon/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Icomoon (font: icomoon)"  class="thickbox" ><?php _e( 'here', 'the-creator-vpb' ) ?></a>.</p>
		<?php
	}


	/**
		Ionicon
	**/
	add_settings_field(
		'tcvpb_enable_ionicon',
		__( 'Ionicon', 'the-creator-vpb' ),
		'tcvpb_enable_ionicon_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_icons'
	);
	function tcvpb_enable_ionicon_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_enable_ionicon = (isset($options['tcvpb_enable_ionicon'])) ? $options['tcvpb_enable_ionicon'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_enable_ionicon]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_enable_ionicon]' id='tcvpb_settings[tcvpb_enable_ionicon]' <?php checked( $tcvpb_enable_ionicon, 1 ); ?> value='1'>
			<?php _e( 'Enable Ionicon Icons', 'the-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e( 'Check this to enable Ionicon icons. Complete list of icons and their names can be found', 'the-creator-vpb' ) ?> <a href="<?php echo TCVPB_DIR.'css/fonts/ionicon/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Ionicon (font: ionicon)"  class="thickbox" ><?php _e( 'here', 'the-creator-vpb' ) ?></a>.</p>
		<?php
	}


	/**
		Material Icons
	**/
	add_settings_field(
		'tcvpb_enable_material',
		__( 'Material', 'the-creator-vpb' ),
		'tcvpb_enable_material_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_icons'
	);
	function tcvpb_enable_material_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_enable_material = (isset($options['tcvpb_enable_material'])) ? $options['tcvpb_enable_material'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_enable_material]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_enable_material]' id='tcvpb_settings[tcvpb_enable_material]' <?php checked( $tcvpb_enable_material, 1 ); ?> value='1'>
			<?php _e( 'Enable Material Icons', 'the-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e( 'Check this to enable Material icons. Complete list of icons and their names can be found', 'the-creator-vpb' ) ?> <a href="<?php echo TCVPB_DIR.'css/fonts/material/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Material (font: material)"  class="thickbox" ><?php _e( 'here', 'the-creator-vpb' ) ?></a>.</p>
		<?php
	}


	/**
		Themify
	**/
	add_settings_field(
		'tcvpb_enable_themify',
		__( 'Themify', 'the-creator-vpb' ),
		'tcvpb_enable_themify_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_icons'
	);
	function tcvpb_enable_themify_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_enable_themify = (isset($options['tcvpb_enable_themify'])) ? $options['tcvpb_enable_themify'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_enable_themify]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_enable_themify]' id='tcvpb_settings[tcvpb_enable_themify]' <?php checked( $tcvpb_enable_themify, 1 ); ?> value='1'>
			<?php _e( 'Enable Themify Icons', 'the-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e( 'Check this to enable Themify icons. Complete list of icons and their names can be found', 'the-creator-vpb' ) ?> <a href="<?php echo TCVPB_DIR.'css/fonts/themify/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Themify (font: themify)"  class="thickbox" ><?php _e( 'here', 'the-creator-vpb' ) ?></a>.</p>
		<?php
	}


	/**
		Typicons
	**/
	add_settings_field(
		'tcvpb_enable_typicons',
		__( 'Typicons', 'the-creator-vpb' ),
		'tcvpb_enable_typicons_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_icons'
	);
	function tcvpb_enable_typicons_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_enable_typicons = (isset($options['tcvpb_enable_typicons'])) ? $options['tcvpb_enable_typicons'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_enable_typicons]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_enable_typicons]' id='tcvpb_settings[tcvpb_enable_typicons]' <?php checked( $tcvpb_enable_typicons, 1 ); ?> value='1'>
			<?php _e( 'Enable Typicons Icons', 'the-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e( 'Check this to enable Typicons icons. Complete list of icons and their names can be found', 'the-creator-vpb' ) ?> <a href="<?php echo TCVPB_DIR.'css/fonts/typicons/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Typicons (font: typicons)"  class="thickbox" ><?php _e( 'here', 'the-creator-vpb' ) ?></a>.</p>
		<?php
	}


	/**
		WebHostingHubGlyphs
	**/
	add_settings_field(
		'tcvpb_enable_whhg',
		__( 'WebHostingHubGlyphs', 'the-creator-vpb' ),
		'tcvpb_enable_whhg_render',
		'tcvpb_options_page',
		'tcvpb_shortcodes_icons'
	);
	function tcvpb_enable_whhg_render(  ) {
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_enable_whhg = (isset($options['tcvpb_enable_whhg'])) ? $options['tcvpb_enable_whhg'] : 0;
		?>
		<label for="tcvpb_settings[tcvpb_enable_whhg]">
			<input type='checkbox' name='tcvpb_settings[tcvpb_enable_whhg]' id='tcvpb_settings[tcvpb_enable_whhg]' <?php checked( $tcvpb_enable_whhg, 1 ); ?> value='1'>
			<?php _e( 'Enable WebHostingHubGlyphs Icons', 'the-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e( 'Check this to enable WebHostingHubGlyphs icons. Complete list of icons and their names can be found', 'the-creator-vpb' ) ?> <a href="<?php echo TCVPB_DIR.'css/fonts/whhg/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Web Hosting Hub Glyphs (font: whhg)"  class="thickbox" ><?php _e( 'here', 'the-creator-vpb' ) ?></a>.</p>
		<?php
	}


}