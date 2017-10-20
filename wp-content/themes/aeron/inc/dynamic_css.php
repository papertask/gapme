<?php 

if ( ! function_exists( 'ABdev_colors_css_hex2rgb' ) ){
	function ABdev_colors_css_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); 
	} 
}

if ( ! function_exists( 'ABdev_colors_css_adjustBrightness' ) ){
	function ABdev_colors_css_adjustBrightness($hex, $steps) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max(-255, min(255, $steps));
		$hex = str_replace('#', '', $hex);
		if (strlen($hex) == 3) {
			$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
		}
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
		$r = max(0,min(255,$r + $steps));
		$g = max(0,min(255,$g + $steps));  
		$b = max(0,min(255,$b + $steps));
		$r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
		$g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
		$b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
		return '#'.$r_hex.$g_hex.$b_hex;
	}
}

$main_color = get_theme_mod('main_color', '#093d71');
	$custom_css.= '
	h2{color: '.$main_color.';}
	h3{color: '.$main_color.';}
	h4{color: '.$main_color.';}
	#topbar{background: '.$main_color.';}
	.tp-leftarrow.tparrows:hover,.tp-rightarrow.tparrows:hover {background: '.$main_color.' !important;}
	.ABdev_overlayed .ABdev_overlay {background:'.$main_color.';}
	.ABdev_overlayed:hover .ABdev_overlay{background:rgba('. ABdev_colors_css_hex2rgb($main_color) .', 0.75);}
	.timeline_postmeta a:hover{color: '.$main_color.';}
	.timeline_postmeta h2 a{color: '.$main_color.';}
	.timeline_postmeta h2{color: '.$main_color.';}
	.post_wrapper h2 a{color: '.$main_color.';}
	.post_content .post_badges .post_type{color: '.$main_color.';}
	#blog_pagination .page-numbers.current,#blog_pagination .page-numbers:hover{background: '.$main_color.';}
	.widget_nav_menu ul li:hover a,.widget_nav_menu .current-menu-item a{color: '.$main_color.';}
	.portfolio_item h4 a{color: '.$main_color.';}
	.portfolio_item .overlayed .overlay {background:'.$main_color.';}
	.portfolio_item:hover .overlayed .overlay{background:rgba('. ABdev_colors_css_hex2rgb($main_color) .', 0.75);}
	.coming_soon_text header p{color: '.$main_color.';}
	#cs_countdown .cs_text{color: '.$main_color.';}
	.tribe-events-list h2.tribe-events-list-event-title a{color: '.$main_color.';}
	.tribe-events-calendar div[id*=tribe-events-daynum-], .tribe-events-calendar div[id*=tribe-events-daynum-] a{background-color: '.$main_color.';}
	header h3{color: '.$main_color.';}
	.tcvpb-event-tabs .nav-tabs li.active a{color: '.$main_color.';}
	.tcvpb-event-tabs .tab-content .tcvpb_event_content h1{color:  '.$main_color.';}
	.tcvpb-event-tabs .tab-content .tcvpb_event_content h1 a{color: '.$main_color.';}
	.tcvpb-accordion .ui-accordion-header {color:'.$main_color.';}
	.tcvpb-tabs .nav-tabs li:hover a {color: '.$main_color.';}
	.tcvpb-tabs-position-left .nav-tabs li.active {color: '.$main_color.';}
	.tcvpb-tabs.tcvpb-tabs-style1 .nav-tabs li.active a {color: '.$main_color.';}
	.tcvpb_stats_excerpt{color: '.$main_color.';}
	.tcvpb_latest_news_shortcode_content h5 a{color: '.$main_color.' !important;}
	.tcvpb_team_member .tcvpb_overlayed .tcvpb_overlay {background:'.$main_color.';}
	.tcvpb_team_member .tcvpb_team_member_name{color: '.$main_color.';}
	.tcvpb_team_member_social_under a{color: '.$main_color.';}
	.tcvpb-teaser i{color: '.$main_color.';}
	.tcvpb_pricing-table-1 .tcvpb_pricebox_header{color: '.$main_color.';}
	.tcvpb_pricing-table-1.with_link:hover .tcvpb_pricebox_header{background: '.$main_color.';}
	.tcvpb_pricing-table-2 .tcvpb_pricebox_header{color: '.$main_color.';}
	.tcvpb_pricing-table-2:hover .tcvpb_pricebox_header{background: '.$main_color.';}
	.tcvpb_service_box .tcvpb_icon_boxed i{color: '.$main_color.';}
	.tcvpb_service_box:hover .tcvpb_icon_boxed{background: '.$main_color.';}
	.tcvpb_service_box:hover .tcvpb_icon_boxed:after{border-top: 9px solid '.$main_color.';}
	.tcvpb-button_main{background: '.$main_color.';}
	.tcvpb-button_light i{color: '.$main_color.';}
	#bbpress-forums div.bbp-forum-header a,
	#bbpress-forums div.bbp-topic-header a,
	#bbpress-forums div.bbp-reply-header a,li.bbp-body li.bbp-forum-topic-count,
	li.bbp-body li.bbp-forum-reply-count,
	li.bbp-body li.bbp-topic-voice-count,
	li.bbp-body li.bbp-topic-reply-count,
	#bbpress-forums fieldset.bbp-form legend{color: '.$main_color.';}
	.bbp-pagination-links a:hover,
	.bbp-pagination-links span.current {background: '.$main_color.';border: 1px solid '.$main_color.';}
	';

$secondary_color = get_theme_mod('secondary_color', '#1e6d81');
	$custom_css.= '
	a{color: '.$secondary_color.';}
	button,input[type="submit"] {background: '.$secondary_color.' !important;}
	input[type="submit"]{border: 1px solid '.$secondary_color.';}
	.title_bar .breadcrumbs a:hover{color: '.$secondary_color.';}
	.timeline_postmeta{color: '.$secondary_color.';}
	.timeline_postmeta a{color: '.$secondary_color.';}
	.timeline_postmeta h2 a:hover{color: '.$secondary_color.';}
	.post_wrapper h2 a:hover{color: '.$secondary_color.';}
	.post_content .post_badges .post_comments .text{color: '.$secondary_color.';}
	.comment .reply a:hover,.comment .edit-link a:hover{color: '.$secondary_color.';}
	#post_pagination a,#blog_pagination a{color: '.$secondary_color.';}
	.wpcf7-submit{background: '.$secondary_color.' !important;}
	.cf7-transparent-button i{color: '.$secondary_color.';}
	.widget ul li:before{color: '.$secondary_color.';}
	.tagcloud a:hover{color: '.$secondary_color.';}
	.portfolio_navigation a:hover{color: '.$secondary_color.';}
	.tribe-events-cal-links a i{color: '.$secondary_color.';}
	.tribe-events-sub-nav li a{color: '.$secondary_color.';}
	.tribe-events-sub-nav li a:hover{color: '.$secondary_color.';}
	.tribe-events-notices {color: '.$secondary_color.';}
	a.tribe-events-ical,a.tribe-events-gcal{background: '.$secondary_color.' !important;}
	.tribe-events-list h2.tribe-events-list-event-title a:hover{color: '.$secondary_color.';}
	.tribe-events-list .tribe-events-list-event-description.tribe-events-content a.tribe-events-read-more i{color: '.$secondary_color.';}
	.tribe-events-list .tribe-events-list-event-description.tribe-events-content a.tribe-events-read-more:hover{color: '.$secondary_color.';}
	.tcvpb-image-carousel .owl-theme .owl-dots .owl-dot span:hover,.tcvpb-image-carousel .owl-theme .owl-dots .owl-dot.active span{background: '.$secondary_color.';}
	.tcvpb-image-carousel .owl-theme .owl-nav .owl-prev:hover,.tcvpb-image-carousel .owl-theme .owl-nav .owl-next:hover{background: '.$secondary_color.';}
	.tcvpb-event-tabs i{color: '.$secondary_color.';}
	.tcvpb-event-tabs .tcvpb_event_content_meta_info i{color: '.$secondary_color.';}
	.tcvpb-accordion .ui-icon-triangle-1-e{color: '.$secondary_color.';}
	.tcvpb-accordion .ui-icon-triangle-1-s{background: '.$secondary_color.';}
	.tcvpb-accordion .ui-icon-triangle-1-s:after{border-top: 4px solid '.$secondary_color.';border-left: 15px inset rgba(255,255,255,0);border-right: 15px inset rgba(255,255,255,0);}
	.tcvpb_latest_news_shortcode_content .tcvpb_latest_news_categories a:hover{color: '.$secondary_color.';}
	.tcvpb-teaser{color: '.$secondary_color.';}
	.tcvpb-teaser .tcvpb_teaser_title{color: '.$secondary_color.';}
	.tcvpb_pricing-table-2 .tcvpb_popular-plan .tcvpb_pricebox_name{background: '.$secondary_color.';}
	.tcvpb_meter .tcvpb_meter_percentage {background: '.$secondary_color.';}
	.tcvpb_dropcap{background: '.$secondary_color.';}
	.tcvpb-callout_box{color: '.$secondary_color.';}
	.tcvpb-button_striped i{color: '.$secondary_color.' !important;}
	.tcvpb-button_accent{background: '.$secondary_color.';}
	.tcvpb-button_dark i{color: '.$secondary_color.';}
	.tcvpb-button_white i{color: '.$secondary_color.';}
	div.bbp-template-notice.info,.bbp-breadcrumb a:hover{color: '.$secondary_color.';}
	';

$light_color = get_theme_mod('light_color', '#cee6e6');
	$custom_css.= '
	.section_border_top:before,.section_border_top_pattern:before{border-top: 6px solid '.$light_color.';}
	.section_color_background{background: '.$light_color.';}
	.leading_line:after,.leading_line_bottom:after{background: '.$light_color.';}
	header#aeron_header{border-bottom: 4px solid '.$light_color.';}
	nav > ul ul{border-bottom: 4px solid '.$light_color.';}
	nav > ul ul li.has_children:hover:after{border-left: 5px solid '.$light_color.';}
	nav > ul ul li:hover{background: '.$light_color.';}
	#magic-line {border-bottom: 5px solid '.$light_color.';}
	.ABdev_overlayed .ABdev_overlay p a:hover{color: '.$light_color.';}
	#topbar_menu li a:hover {color: '.$light_color.';}
	#topbar.announcement_bar_style_1{border-bottom: 2px solid '.$light_color.';}
	#topbar.announcement_bar_style_2{border-bottom: 1px solid '.$light_color.';}
	#topbar.announcement_bar_style_3{border-bottom: 1px solid '.$light_color.';}
	.testimonial_small p{border-bottom: 5px solid '.$light_color.' !important;}
	.testimonial_small p:after{border-left: 16px solid '.$light_color.' !important;}
	.timeline_postmeta{background: '.$light_color.';}
	.timeline_post_left:after{border-right: 7px solid '.$light_color.';}
	.timeline_post_right:after{border-left: 7px solid '.$light_color.';}
	.post_content .post_badges .post_type{background: '.$light_color.';}
	.post_content .post_badges .post_comments .text{background: '.$light_color.';}
	.post_content .post_badges .post_type:after,.post_content .post_badges .post_comments .text:after{border-top: 5px solid '.$light_color.';}
	#post_pagination,#blog_pagination{background: '.$light_color.';}
	.tagcloud a:hover{background: '.$light_color.';border-color: '.$light_color.';}
	.widget_nav_menu ul li:hover,.widget_nav_menu .current-menu-item{background: '.$light_color.';}
	.widget_nav_menu ul li:hover:after,.widget_nav_menu .current-menu-item:after{border-right: 6px solid '.$light_color.';}
	.sidebar_left .widget_nav_menu ul li:hover:after,.sidebar_left .widget_nav_menu .current-menu-item:after{border-left: 6px solid '.$light_color.';}
	.portfolio_item .overlayed .overlay p a:hover{color: '.$light_color.';}
	.overlayed_animated_highlight .overlayed_after{background: '.$light_color.';}
	#page404 .big_404{color: '.$light_color.';}
	#under_maintenance i{color: '.$light_color.';}
	#tribe-events-footer{background: '.$light_color.';}
	#tribe-events .tribe-events-button,.tribe-events-button{background: '.$light_color.';}
	.tribe-events-notices {background: '.$light_color.';}
	footer{border-top: 10px solid '.$light_color.';}
	.title_with_after header h3:after{background: '.$light_color.';}
	.tcvpb-event-tabs .nav-tabs li.active:after{border-top: 6px solid '.$light_color.';}
	.tcvpb-accordion .ui-icon-triangle-1-e{background: '.$light_color.';}
	.tcvpb-accordion .ui-icon-triangle-1-e:after{border-left: 4px solid '.$light_color.';}
	.tcvpb-tabs-position-left .nav-tabs li.active {background: '.$light_color.';}
	.tcvpb-tabs-position-left .nav-tabs li.active:after {border-left: 7px solid '.$light_color.';}
	.tcvpb-tabs.tcvpb-tabs-style1 .nav-tabs li.active:after {border-top: 5px solid '.$light_color.';}
	.tcvpb_team_member .tcvpb_overlayed .tcvpb_overlay p a:hover{color: '.$light_color.';}
	.tcvpb_team_member .tcvpb_overlayed .tcvpb_overlay_after{background: '.$light_color.';}
	.tcvpb_pricing-table-1 .tcvpb_pricebox_header{background: '.$light_color.';}
	.tcvpb_pricing-table-2 .tcvpb_pricebox_header{background: '.$light_color.';}
	.tcvpb_pricing-table-2 .tcvpb_pricebox_feature:last-of-type{border-bottom: 4px solid '.$light_color.';}
	.tcvpb_service_box .tcvpb_icon_boxed{background: '.$light_color.';}
	.tcvpb_service_box .tcvpb_icon_boxed:after{border-top: 9px solid '.$light_color.';}
	.tcvpb-button i{color: '.$light_color.';}
	.tcvpb-button_light{background: '.$light_color.';}
	.tcvpb-button_accent{color: '.$light_color.';}
	.tcvpb-button_accent:hover{color: '.$light_color.';}
	div.bbp-template-notice.info{background: '.$light_color.';}
	#bbpress-forums div.bbp-forum-header,#bbpress-forums div.bbp-topic-header,#bbpress-forums div.bbp-reply-header{background-color: '.$light_color.';}
	#favorite-toggle a:hover,#favorite-toggle span.is-favorite a:hover,#subscription-toggle a:hover,#subscription-toggle span.is-subscribed a:hover{color: '.$light_color.';}
	';

$section_bg_color = get_theme_mod('section_bg_color', '#ffffff');
	$custom_css.= '
	section{background: '.$section_bg_color.';}
	.tcvpb_section_tc{background: '.$section_bg_color.';}
	.boxed_body_wrapper{background: '.$section_bg_color.';}
	#ABdev_sticky_header_content{background: '.$section_bg_color.';}
	nav > ul ul{background: '.$section_bg_color.';}
	#blog_pagination .page-numbers{background: '.$section_bg_color.';}
	.tcvpb-tabs .nav-tabs li.active:after{background: '.$section_bg_color.';}
	.tcvpb-tabs.tcvpb-tabs-position-top .nav-tabs li.active{background: '.$section_bg_color.';}
	.tcvpb-tabs-position-left .nav-tabs li.active:after{background: '.$section_bg_color.';}
	.tcvpb-tabs-position-right .nav-tabs li.active:after{background: '.$section_bg_color.';}
	.tcvpb-event-tabs .tab-content{background: '.$section_bg_color.';}
	.tcvpb-event-tabs .tab-pane.active_pane{background: '.$section_bg_color.';}
	.tcvpb_team_member_modal{background: '.$section_bg_color.';}
	.tcvpb-callout_box.tcvpb-callout_box_style_3{background: '.$section_bg_color.';}
	.tcvpb-tabs-position-left .nav-tabs{border-right: 1px solid'.$section_bg_color.';}
	.ABt_testimonials_slide li{background: '.$section_bg_color.';}
	.ABt_testimonials_slide	.testimonial_small p:after,.testimonial_small p:after{border-bottom:22px solid '.$section_bg_color.' !important;}
	.tcvpb-event-tabs .tcvpb_event_content_meta_info{background-color: '.$section_bg_color.';}
	.tcvpb-event-tabs .tcvpb_event_content_meta_share .tcvpb_event_content_meta_share_icons{background: '.$section_bg_color.';}
	#bbpress-forums div.odd, #bbpress-forums ul.odd,#bbpress-forums div.even, #bbpress-forums ul.even{background-color: '.$section_bg_color.';}
	';

$body_text = get_theme_mod('body_text', '#656565');
	$custom_css.= '
	body{color: '.$body_text.';}
	a:hover{color: '.$body_text.';}
	h5{color: '.$body_text.';}
	h6{color: '.$body_text.';}
	nav > ul ul li a{color: '.$body_text.';}
	nav > ul ul li:hover a{color: '.$body_text.';}
	.post_main .postmeta-under a:hover{color: '.$body_text.';}
	#blog_pagination .page-numbers.prev:hover,#blog_pagination .page-numbers.next:hover,#blog_pagination .page-numbers.dots:hover{color: '.$body_text.';}
	.cf7-transparent-button input.wpcf7-submit{color: '.$body_text.' !important;}
	.widget_nav_menu ul li a{color: '.$body_text.';}
	.portfolio_navigation a{color: '.$body_text.';}
	.tribe-events-list .tribe-events-list-event-description.tribe-events-content a.tribe-events-read-more{color: '.$body_text.';}
	.tcvpb-event-tabs .tab-content .tcvpb_event_content p{color:'.$body_text.';}
	.tcvpb-tabs .nav-tabs li a {color: '.$body_text.';}
	.tcvpb-callout_box_4{color: '.$body_text.';}
	.placeholder{color: '.$body_text.';}
	::-webkit-input-placeholder {  color: '.$body_text.';}
	:-moz-placeholder {  color: '.$body_text.';}
	::-moz-placeholder {  color: '.$body_text.';}
	:-ms-input-placeholder {  color: '.$body_text.';}
	.title_bar .breadcrumbs{color: '.$body_text.';}
	.title_bar .breadcrumbs a{color: '.$body_text.';}
	.post_main .postmeta-under{color: '.$body_text.';}
	.post_main .postmeta-under a{color: '.$body_text.';}
	.comment .comment-author,.comment time,.comment .reply,.comment .edit-link,.comment .reply a,.comment .edit-link a{color: '.$body_text.';}
	.tagcloud a{color: '.$body_text.';}
	footer .tagcloud a:hover{border-color: '.$body_text.';}
	.portfolio_item{color: '.$body_text.';}
	.single_portfolio_meta{color: '.$body_text.';}
	footer{color: '.$body_text.';}
	footer #footer_copyright .footer_social_links a{color: '.$body_text.';}
	.tcvpb-event-tabs .nav-tabs li a{color: '.$body_text.';}
	.tcvpb_latest_news_shortcode_content .tcvpb_latest_news_time,.tcvpb_latest_news_shortcode_content .tcvpb_latest_news_categories a{color: '.$body_text.';}
	.tcvpb_team_member .tcvpb_team_member_position{color: '.$body_text.';}
	.ABt_testimonials_slide	.testimonial_small .source{color: '.$body_text.';}
	.ABt_testimonials_slide	.testimonial_big p{color: '.$body_text.';}
	.ABt_testimonials_slide	.testimonial_big .source{color: '.$body_text.';}
	';

$header_background = get_theme_mod('header_background', '');
	$custom_css.= '
		
		header#aeron_header.full_opacity{background:rgba('. ABdev_colors_css_hex2rgb($header_background) .', 0.9);}
	';

$main_menu_items = get_theme_mod('main_menu_items', '');
	$custom_css.= '
		nav>ul>li>a{
			color:'. $main_menu_items.';
		}
	';

$main_menu_items_hover = get_theme_mod('main_menu_items_hover', '');
	$custom_css.= '
		nav>ul>li a:hover,
		nav>ul>.current-menu-item>a{
			color:'. $main_menu_items_hover.';
		}
	';

$footer_background = get_theme_mod('footer_background', '');
	$custom_css.= '
		#topbar.announcement_bar_style_3, 
		footer,
		.tcvpb_pricing-table-1 .tcvpb_popular-plan .tcvpb_pricebox_featured_text{
			background:'. $footer_background.';
		}

		footer .tagcloud a:hover{
			color:'. $footer_background.';
		}
	';

$footer_borders = get_theme_mod('footer_borders', '');
	$custom_css.= '
		footer .tagcloud a{
			border-color:'. $footer_borders.';
		}
	
		footer #footer_copyright{
			border-top-color:'. $footer_borders.';
		}
	';

$footer_links = get_theme_mod('footer_links', '');
	$custom_css.= '
		footer a{
			color:'. $footer_links.';
		}
	';

// Header Logo
	if(get_theme_mod('header_retina_logo', '') !='' ){
		$custom_css.= '
		#aeron_header #main_logo{display:inline;}
		#aeron_header #retina_logo{display:none;}
		@media only screen and (-webkit-min-device-pixel-ratio: 1.3), 
		only screen and (-o-min-device-pixel-ratio: 13/10), 
		only screen and (min-resolution: 120dpi) {
			#aeron_header #main_logo{display:none;}
			#aeron_header #retina_logo{display:inline;}
		}';
	}

// Boxed Body Background
	if (get_theme_mod('boxed_body', false)) {
		$bg_color = get_theme_mod('bg_color', '#ffffff');
		$bg_color = ($bg_color!='') ? ' background-color:'.$bg_color : '';

		$custom_bg_image = get_theme_mod('custom_bg_image', '');
		$custom_bg_image = ($custom_bg_image!='') ? ' background-image:url("'.$custom_bg_image.'")' : '';

		$revelance_background_repeat = get_theme_mod('revelance_background_repeat', 'no-repeat');
		$revelance_background_repeat = ($revelance_background_repeat!='' && get_theme_mod('custom_bg_image', '') != '') ? ' background-repeat:'.$revelance_background_repeat : '';

		$revelance_background_size = get_theme_mod('revelance_background_size', 'cover');
		$revelance_background_size = ($revelance_background_size!='' && get_theme_mod('custom_bg_image', '') != '') ? ' background-size:'.$revelance_background_size : '';

		$revelance_background_position = get_theme_mod('revelance_background_position', 'center center');
		$revelance_background_position = ($revelance_background_position!='' && get_theme_mod('custom_bg_image', '') != '') ? ' background-position:'.$revelance_background_position : '';

		$revelance_background_attachment = get_theme_mod('revelance_background_attachment', 'fixed');
		$revelance_background_attachment = ($revelance_background_attachment!='' && get_theme_mod('custom_bg_image', '') != '') ? ' background-attachment:'.$revelance_background_attachment : '';

		$custom_css.= 'body{'.$bg_color.'; '.$custom_bg_image.'; '.$revelance_background_repeat.'; '.$revelance_background_size.'; '.$revelance_background_position.'; '.$revelance_background_attachment.';}';
	}

// Title Breadcrumbs Bar Background
	$aeron_title_breadcrumbs_color = get_theme_mod('aeron_title_breadcrumbs_color', '#d9d9d9');
	$aeron_title_breadcrumbs_color = ($aeron_title_breadcrumbs_color != '') ? ' background-color:'.$aeron_title_breadcrumbs_color : '';

	$aeron_title_breadcrumbs_image = get_theme_mod('aeron_title_breadcrumbs_image', '');
	$featured_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
	
	if($featured_image!='' && is_page()){
		$aeron_title_breadcrumbs_image = ($featured_image != '') ? ' background-image:url("'.$featured_image.'")' : '';
	}
	else{
		$aeron_title_breadcrumbs_image = ($aeron_title_breadcrumbs_image != '') ? ' background-image:url("'.$aeron_title_breadcrumbs_image.'")' : '';
	}


	$aeron_background_repeat_breadcrumbs_image = get_theme_mod('aeron_title_breadcrumbs_bar_background_repeat', 'no-repeat');
	$aeron_background_repeat_breadcrumbs_image = ($aeron_background_repeat_breadcrumbs_image!='' && $aeron_title_breadcrumbs_image!= '') ? ' background-repeat:'.$aeron_background_repeat_breadcrumbs_image : '';
	$aeron_background_size_breadcrumbs_image = get_theme_mod('aeron_title_breadcrumbs_bar_background_size', 'cover');
	$aeron_background_size_breadcrumbs_image = ($aeron_background_size_breadcrumbs_image!='' && $aeron_title_breadcrumbs_image!= '') ? ' background-size:'.$aeron_background_size_breadcrumbs_image : '';

	$aeron_background_position_breadcrumbs_image = get_theme_mod('aeron_title_breadcrumbs_bar_background_position', 'center center');
	$aeron_background_position_breadcrumbs_image = ($aeron_background_position_breadcrumbs_image!='' && $aeron_title_breadcrumbs_image!= '') ? ' background-position:'.$aeron_background_position_breadcrumbs_image : '';

	$custom_css.= '.title_bar{'.$aeron_title_breadcrumbs_color.'; '.$aeron_title_breadcrumbs_image.'; '.$aeron_background_repeat_breadcrumbs_image.'; '.$aeron_background_size_breadcrumbs_image.'; '.$aeron_background_position_breadcrumbs_image.';}';