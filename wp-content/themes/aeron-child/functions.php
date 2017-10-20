<?php

function aeron_child_theme_scripts() {

	$deps = array();
	if( in_array('the-creator-vpb/the-creator-vpb.php', get_option('active_plugins')) ){
		$deps[] = 'tcvpb_css';
	}

	wp_enqueue_style( 'main_css', get_template_directory_uri().'/style.css', $deps );
    wp_enqueue_style( 'aeron-child-style', get_stylesheet_uri(), array( 'main_css' ) );
}

add_action( 'wp_enqueue_scripts', 'aeron_child_theme_scripts' );

function aeron_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'ABdev_aeron', $lang );
}
add_action( 'after_setup_theme', 'aeron_lang_setup' );



// added by WANG Xi
function wp_enqueue_fa_stylesheet(){
	wp_register_style( 'fontawesome',  get_stylesheet_directory_uri().'/css/font-awesome.min.css' );
	//wp_register_style( 'hovercss',  get_stylesheet_directory_uri().'/css/hover-min.css' );
	wp_enqueue_style( 'fontawesome');
	//wp_enqueue_style( 'hovercss');
}
add_action('wp_enqueue_scripts', 'wp_enqueue_fa_stylesheet' );

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( "thumbnail");

add_image_size( 'category-thumb', 300, 9999 );

// posts limit per category page
add_filter('pre_get_posts', 'limit_category_posts');
function limit_category_posts($query){
    if ($query->is_category) {
        $query->set('posts_per_page', 10);
    }
    return $query;
}

function db_displaydate($attributes){
	$args = shortcode_atts( array('date' => '1970-01-01 00:00:00') ,$attributes);
	$db_date = $args['date'];
	$year_number = substr($db_date,0,4);
	$month_number = substr($db_date,5,2);
	$day_number = substr($db_date,8,2);
	$hour_number = substr($db_date,11,2);
	$minute_number = substr($db_date,14,2);
	$seconds_number = substr($db_date,17,2);

	$timestamp = mktime($hour_number,$minute_number,$seconds_number,$month_number,$day_number,$year_number);

return strftime('%B %d %Y',$timestamp);
}
add_shortcode('db_date', 'db_displaydate');

//END added by WANG Xi