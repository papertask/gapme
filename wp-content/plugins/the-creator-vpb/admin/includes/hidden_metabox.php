<?php  
$post_id_post = isset($_POST['post_ID']) ? $_POST['post_ID'] : '' ;
$post_id = isset($_GET['post']) ? $_GET['post'] : $post_id_post ;


if ( ! function_exists( 'tcvpb_add_meta_box' ) ){
	function tcvpb_add_meta_box(){ 
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_disable_on = (isset($options['tcvpb_disable_on'])) ? explode(',', $options['tcvpb_disable_on'])  : array();
		$tcvpb_disable_on = array_map('trim',$tcvpb_disable_on);
		$default_types = array( 'post', 'page');
		$custom_post_types = get_post_types( array('_builtin' => false) ); 
		$activate_on = array_merge($default_types, $custom_post_types);
		$activate_on = array_diff($activate_on, $tcvpb_disable_on);
		foreach ( $activate_on as $page ){
			if(post_type_supports( $page, 'editor' )){
				add_meta_box( 'tcvpb_hidden_metabox', esc_attr__('The Creator Content', 'the-creator-vpb' ), 'tcvpb_construct_hidden_meta_box', $page, 'normal', 'high' ); 
			}
		} 
	}
}
add_action( 'add_meta_boxes', 'tcvpb_add_meta_box' );  



if ( ! function_exists( 'tcvpb_construct_hidden_meta_box' ) ){
	function tcvpb_construct_hidden_meta_box( $post ){ 
		$options = get_option( 'tcvpb_settings' );
		$tcvpb_developer_mode = (isset($options['tcvpb_developer'])) ? $options['tcvpb_developer'] : 0;
		$values = get_post_custom( $post->ID );
		$tcvpb_content = (isset($values['tcvpb_content'][0])) ? $values['tcvpb_content'][0] : '';
		$tcvpb_tc_activated = (isset($values["tcvpb_tc_activated"][0]) && $values["tcvpb_tc_activated"][0]==1) ? 1 : 0;
		$tcvpb_is_default = (isset($options["tcvpb_is_default"]) && $options["tcvpb_is_default"]==1) ? ' class="tcvpb_is_default"' : '';
		wp_nonce_field( 'my_meta_box_sidebar_nonce', 'meta_box_sidebar_nonce' );
		?>  
		<p>  
			<textarea name="tcvpb_content" id="tcvpb_content" data-mode="<?php echo ($tcvpb_developer_mode==1) ? 'developer' : 'standard'; ?>"><?php echo $tcvpb_content;?></textarea>  
			<textarea id="tcvpb_initial_content"><?php echo $post->post_content;?></textarea>  
		</p>
		<p>  
			<label><input type="checkbox" name="tcvpb_tc_activated" id="tcvpb_tc_activated"<?php echo $tcvpb_is_default; ?> value="1" <?php checked( $tcvpb_tc_activated, 1); ?>>  
				<?php _e('The Creator Activated', 'the-creator-vpb' );?>
			</label>
			<?php echo ($tcvpb_tc_activated==1) ? '<style type="text/css">#postdivrich{display:none;}</style>' : ''; ?>
		</p>
		<?php
	}
}

if ( ! function_exists( 'tcvpb_save_hidden_meta_box' ) ){
	function tcvpb_save_hidden_meta_box( $post_id ){ 
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){ 
			return; 
		}
		if( !isset( $_POST['tcvpb_content'] ) || !wp_verify_nonce( $_POST['meta_box_sidebar_nonce'], 'my_meta_box_sidebar_nonce' ) ) {
			return; 
		}
		if( !current_user_can( 'edit_pages' ) ) {
			return;  
		}
		if( isset( $_POST['tcvpb_content'] ) ){
			update_post_meta( $post_id, 'tcvpb_content', $_POST['tcvpb_content'] );  
		}

		$tcvpb_tc_activated = (isset($_POST["tcvpb_tc_activated"]) && $_POST["tcvpb_tc_activated"]==1) ? 1 : 0;
		update_post_meta($post_id, "tcvpb_tc_activated", $tcvpb_tc_activated); 
	}
}

add_action( 'save_post', 'tcvpb_save_hidden_meta_box' );  


