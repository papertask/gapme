(function($){

	function dynamic_css_targets(){
		var css_styles_targets = '<style id="customizer_dynamic_main_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_secondary_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_light_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_section_bg_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_body_text_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_header_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_menu_items_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_menu_items_hover_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_footer_background_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_footer_borders_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_footer_links_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_bg_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_breadcrumbs_bg_color_css" type="text/css"></style>';
		if(!$('#customizer_dynamic_main_color_css').length){
			$('#main_css-inline-css').after(css_styles_targets);
		}
	}

	wp.customize('custom_css', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			$('#customizer_custom_css').text(newval);
		});
	});

	wp.customize('header_logo', function(value){
		value.bind(function(newval){
			$('#main_logo').attr('src', newval);
		});
	});

	wp.customize('header_retina_logo', function(value){
		value.bind(function(newval){
			$('#retina_logo').attr('src', newval);
		});
	});

	wp.customize('sidebars', function(value){
		value.bind(function(newval){
		});
	});

	wp.customize('main_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
			var matches = patt.exec(newval);
			var rgba = "rgba("+parseInt(matches[1], 16)+","+parseInt(matches[2], 16)+","+parseInt(matches[3], 16)+", 0.75)";
			var new_colors = 'h2{color: '+newval+';}h3{color: '+newval+';}h4{color: '+newval+';}#topbar{background: '+newval+';}.tp-leftarrow.tparrows:hover,.tp-rightarrow.tparrows:hover {background: '+newval+' !important;}.ABdev_overlayed .ABdev_overlay {background:'+newval+';}.ABdev_overlayed:hover .ABdev_overlay{background:'+rgba+';}.timeline_postmeta a:hover{color: '+newval+';}.timeline_postmeta h2 a{color: '+newval+';}.timeline_postmeta h2{color: '+newval+';}.post_wrapper h2 a{color: '+newval+';}.post_content .post_badges .post_type{color: '+newval+';}#blog_pagination .page-numbers.current,#blog_pagination .page-numbers:hover{background: '+newval+';}.widget_nav_menu ul li:hover a,.widget_nav_menu .current-menu-item a{color: '+newval+';}.portfolio_item h4 a{color: '+newval+';}.portfolio_item .overlayed .overlay {background:'+newval+';}.portfolio_item:hover .overlayed .overlay{background:'+rgba+';}.coming_soon_text header p{color: '+newval+';}#cs_countdown .cs_text{color: '+newval+';}.tribe-events-list h2.tribe-events-list-event-title a{color: '+newval+';}.tribe-events-calendar div[id*=tribe-events-daynum-], .tribe-events-calendar div[id*=tribe-events-daynum-] a{background-color: '+newval+';}header h3{color: '+newval+';}.tcvpb-event-tabs .nav-tabs li.active a{color: '+newval+';}.tcvpb-event-tabs .tab-content .tcvpb_event_content h1{color:  '+newval+';}.tcvpb-event-tabs .tab-content .tcvpb_event_content h1 a{color: '+newval+';}.tcvpb-accordion .ui-accordion-header {color:'+newval+';}.tcvpb-tabs .nav-tabs li:hover a {color: '+newval+';}.tcvpb-tabs-position-left .nav-tabs li.active {color: '+newval+';}.tcvpb-tabs.tcvpb-tabs-style1 .nav-tabs li.active a {color: '+newval+';}.tcvpb_stats_excerpt{color: '+newval+';}.tcvpb_latest_news_shortcode_content h5 a{color: '+newval+' !important;}.tcvpb_team_member .tcvpb_overlayed .tcvpb_overlay {background:'+newval+';}.tcvpb_team_member .tcvpb_team_member_name{color: '+newval+';}.tcvpb_team_member_social_under a{    color: '+newval+';}.tcvpb-teaser i{color: '+newval+';}.tcvpb_pricing-table-1 .tcvpb_pricebox_header{color: '+newval+';}.tcvpb_pricing-table-1.with_link:hover .tcvpb_pricebox_header{background: '+newval+';}.tcvpb_pricing-table-2 .tcvpb_pricebox_header{color: '+newval+';}.tcvpb_pricing-table-2:hover .tcvpb_pricebox_header{background: '+newval+';}.tcvpb_service_box .tcvpb_icon_boxed i{color: '+newval+';}.tcvpb_service_box:hover .tcvpb_icon_boxed{background: '+newval+';}.tcvpb_service_box:hover .tcvpb_icon_boxed:after{border-top: 9px solid '+newval+';}.tcvpb-button_main{background: '+newval+';}.tcvpb-button_light i{color: '+newval+';}#bbpress-forums div.bbp-forum-header a,#bbpress-forums div.bbp-topic-header a,#bbpress-forums div.bbp-reply-header a,li.bbp-body li.bbp-forum-topic-count,li.bbp-body li.bbp-forum-reply-count,li.bbp-body li.bbp-topic-voice-count,li.bbp-body li.bbp-topic-reply-count,#bbpress-forums fieldset.bbp-form legend{color: '+newval+';}.bbp-pagination-links a:hover,.bbp-pagination-links span.current {background: '+newval+';border: 1px solid '+newval+';}';
			$('#customizer_dynamic_main_color_css').text(new_colors);
		});
	});

	wp.customize('secondary_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'a{color: '+newval+';}button,input[type="submit"] {background: '+newval+' !important;}input[type="submit"]{border: 1px solid '+newval+';}.title_bar .breadcrumbs a:hover{color: '+newval+';}.timeline_postmeta{color: '+newval+';}.timeline_postmeta a{color: '+newval+';}.timeline_postmeta h2 a:hover{color: '+newval+';}.post_wrapper h2 a:hover{color: '+newval+';}.post_content .post_badges .post_comments .text{color: '+newval+';}.comment .reply a:hover,.comment .edit-link a:hover{color: '+newval+';}#post_pagination a,#blog_pagination a{color: '+newval+';}.wpcf7-submit{background: '+newval+' !important;}.cf7-transparent-button i{color: '+newval+';}.widget ul li:before{color: '+newval+';}.tagcloud a:hover{color: '+newval+';}.portfolio_navigation a:hover{color: '+newval+';}.tribe-events-cal-links a i{color: '+newval+';}.tribe-events-sub-nav li a{color: '+newval+';}.tribe-events-sub-nav li a:hover{color: '+newval+';}.tribe-events-notices {color: '+newval+';}a.tribe-events-ical,a.tribe-events-gcal{background: '+newval+' !important;}.tribe-events-list h2.tribe-events-list-event-title a:hover{color: '+newval+';}.tribe-events-list .tribe-events-list-event-description.tribe-events-content a.tribe-events-read-more i{color: '+newval+';}.tribe-events-list .tribe-events-list-event-description.tribe-events-content a.tribe-events-read-more:hover{color: '+newval+';}.tcvpb-image-carousel .owl-theme .owl-dots .owl-dot span:hover,.tcvpb-image-carousel .owl-theme .owl-dots .owl-dot.active span{background: '+newval+';}.tcvpb-image-carousel .owl-theme .owl-nav .owl-prev:hover,.tcvpb-image-carousel .owl-theme .owl-nav .owl-next:hover{background: '+newval+';}.tcvpb-event-tabs i{color: '+newval+';}.tcvpb-event-tabs .tcvpb_event_content_meta_info i{color: '+newval+';}.tcvpb-accordion .ui-icon-triangle-1-e{color: '+newval+';}.tcvpb-accordion .ui-icon-triangle-1-s{background: '+newval+';}.tcvpb-accordion .ui-icon-triangle-1-s:after{border-top: 4px solid '+newval+';border-left: 15px inset rgba(255,255,255,0);border-right: 15px inset rgba(255,255,255,0);}.tcvpb_latest_news_shortcode_content .tcvpb_latest_news_categories a:hover{color: '+newval+';}.tcvpb-teaser{color: '+newval+';}.tcvpb-teaser .tcvpb_teaser_title{color: '+newval+';}.tcvpb_pricing-table-2 .tcvpb_popular-plan .tcvpb_pricebox_name{background: '+newval+';}.tcvpb_meter .tcvpb_meter_percentage {background: '+newval+';}.tcvpb_dropcap{background: '+newval+';}.tcvpb-callout_box{color: '+newval+';}.tcvpb-button_striped i{color: '+newval+' !important;}.tcvpb-button_accent{background: '+newval+';}.tcvpb-button_dark i{color: '+newval+';}.tcvpb-button_white i{color: '+newval+';}';
			$('#customizer_dynamic_secondary_color_css').text(new_colors);
		});
	});

	wp.customize('light_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = '.section_border_top:before,.section_border_top_pattern:before{border-top: 6px solid '+newval+';}.section_color_background{background: '+newval+';}.leading_line:after,.leading_line_bottom:after{background: '+newval+';}header#aeron_header{border-bottom: 4px solid '+newval+';}nav > ul ul{border-bottom: 4px solid '+newval+';}nav > ul ul li.has_children:hover:after{border-left: 5px solid '+newval+';}nav > ul ul li:hover{background: '+newval+';}#magic-line {border-bottom: 5px solid '+newval+';}.ABdev_overlayed .ABdev_overlay p a:hover{color: '+newval+';}#topbar_menu li a:hover {color: '+newval+';}#topbar.announcement_bar_style_1{border-bottom: 2px solid '+newval+';}#topbar.announcement_bar_style_2{border-bottom: 1px solid '+newval+';}#topbar.announcement_bar_style_3{border-bottom: 1px solid '+newval+';}.testimonial_small p{border-bottom: 5px solid '+newval+' !important;}.testimonial_small p:after{border-left: 16px solid '+newval+' !important;}.timeline_postmeta{background: '+newval+';}.timeline_post_left:after{border-right: 7px solid '+newval+';}.timeline_post_right:after{border-left: 7px solid '+newval+';}.post_content .post_badges .post_type{background: '+newval+';}.post_content .post_badges .post_comments .text{background: '+newval+';}.post_content .post_badges .post_type:after,.post_content .post_badges .post_comments .text:after{border-top: 5px solid '+newval+';}#post_pagination,#blog_pagination{background: '+newval+';}.tagcloud a:hover{background: '+newval+';border-color: '+newval+';}.widget_nav_menu ul li:hover,.widget_nav_menu .current-menu-item{background: '+newval+';}.widget_nav_menu ul li:hover:after,.widget_nav_menu .current-menu-item:after{border-right: 6px solid '+newval+';}.sidebar_left .widget_nav_menu ul li:hover:after,.sidebar_left .widget_nav_menu .current-menu-item:after{border-left: 6px solid '+newval+';}.portfolio_item .overlayed .overlay p a:hover{color: '+newval+';}.overlayed_animated_highlight .overlayed_after{background: '+newval+';}#page404 .big_404{color: '+newval+';}#under_maintenance i{color: '+newval+';}#tribe-events-footer{background: '+newval+';}#tribe-events .tribe-events-button,.tribe-events-button{background: '+newval+';}.tribe-events-notices {background: '+newval+';}footer{border-top: 10px solid '+newval+';}.title_with_after header h3:after{background: '+newval+';}.tcvpb-event-tabs .nav-tabs li.active:after{border-top: 6px solid '+newval+';}.tcvpb-accordion .ui-icon-triangle-1-e{background: '+newval+';}.tcvpb-accordion .ui-icon-triangle-1-e:after{border-left: 4px solid '+newval+';}.tcvpb-tabs-position-left .nav-tabs li.active {background: '+newval+';}.tcvpb-tabs-position-left .nav-tabs li.active:after {border-left: 7px solid '+newval+';}.tcvpb-tabs.tcvpb-tabs-style1 .nav-tabs li.active:after {border-top: 5px solid '+newval+';}.tcvpb_team_member .tcvpb_overlayed .tcvpb_overlay p a:hover{color: '+newval+';}.tcvpb_team_member .tcvpb_overlayed .tcvpb_overlay_after{background: '+newval+';}.tcvpb_pricing-table-1 .tcvpb_pricebox_header{background: '+newval+';}.tcvpb_pricing-table-2 .tcvpb_pricebox_header{background: '+newval+';}.tcvpb_pricing-table-2 .tcvpb_pricebox_feature:last-of-type{border-bottom: 4px solid '+newval+';}.tcvpb_service_box .tcvpb_icon_boxed{background: '+newval+';}.tcvpb_service_box .tcvpb_icon_boxed:after{border-top: 9px solid '+newval+';}.tcvpb-button i{color: '+newval+';}.tcvpb-button_light{background: '+newval+';}.tcvpb-button_accent{color: '+newval+';}.tcvpb-button_accent:hover{color: '+newval+';}div.bbp-template-notice.info{background: '+newval+';}#bbpress-forums div.bbp-forum-header,#bbpress-forums div.bbp-topic-header,#bbpress-forums div.bbp-reply-header{background-color: '+newval+';}#favorite-toggle a:hover,#favorite-toggle span.is-favorite a:hover,#subscription-toggle a:hover,#subscription-toggle span.is-subscribed a:hover{color: '+newval+';}';
			$('#customizer_dynamic_light_color_css').text(new_colors);
		});
	});

	wp.customize('section_bg_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'section{background: '+newval+';}.tcvpb_section_tc{background: '+newval+';}.boxed_body_wrapper{background: '+newval+';}#ABdev_sticky_header_content{background: '+newval+';}nav > ul ul{background: '+newval+';}#blog_pagination .page-numbers{background: '+newval+';}.tcvpb-tabs .nav-tabs li.active:after{background: '+newval+';}.tcvpb-tabs.tcvpb-tabs-position-top .nav-tabs li.active{background: '+newval+';}.tcvpb-tabs-position-left .nav-tabs li.active:after{background: '+newval+';}.tcvpb-tabs-position-right .nav-tabs li.active:after{background: '+newval+';}.tcvpb-event-tabs .tab-content{background: '+newval+';}.tcvpb-event-tabs .tab-pane.active_pane{background: '+newval+';}.tcvpb_team_member_modal{background: '+newval+';}.tcvpb-callout_box.tcvpb-callout_box_style_3{background: '+newval+';}.tcvpb-tabs-position-left .nav-tabs{border-right: 1px solid'+newval+';}.ABt_testimonials_slide li{background: '+newval+';}.ABt_testimonials_slide	.testimonial_small p:after,.testimonial_small p:after{border-bottom:22px solid '+newval+' !important;}.tcvpb-event-tabs .tcvpb_event_content_meta_info{background-color: '+newval+';}.tcvpb-event-tabs .tcvpb_event_content_meta_share .tcvpb_event_content_meta_share_icons{background: '+newval+';}#bbpress-forums div.odd, #bbpress-forums ul.odd,#bbpress-forums div.even, #bbpress-forums ul.even{background-color: '+newval+';}';
			$('#customizer_dynamic_section_bg_color_css').text(new_colors);
		});
	});

	wp.customize('body_text', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'body{color: '+newval+';}a:hover{color: '+newval+';}h5{color: '+newval+';}h6{color: '+newval+';}nav > ul ul li a{color: '+newval+';}nav > ul ul li:hover a{color: '+newval+';}.post_main .postmeta-under a:hover{color: '+newval+';}#blog_pagination .page-numbers.prev:hover,#blog_pagination .page-numbers.next:hover,#blog_pagination .page-numbers.dots:hover{color: '+newval+';}.cf7-transparent-button input.wpcf7-submit{color: '+newval+' !important;}.widget_nav_menu ul li a{color: '+newval+';}.portfolio_navigation a{color: '+newval+';}.tribe-events-list .tribe-events-list-event-description.tribe-events-content a.tribe-events-read-more{color: '+newval+';}.tcvpb-event-tabs .tab-content .tcvpb_event_content p{color:'+newval+';}.tcvpb-tabs .nav-tabs li a {color: '+newval+';}.tcvpb-callout_box_4{color: '+newval+';}.placeholder{color: '+newval+';}::-webkit-input-placeholder {  color: '+newval+';}:-moz-placeholder {  color: '+newval+';}::-moz-placeholder {  color: '+newval+';}:-ms-input-placeholder {  color: '+newval+';}.title_bar .breadcrumbs{color: '+newval+';}.title_bar .breadcrumbs a{color: '+newval+';}.post_main .postmeta-under{color: '+newval+';}.post_main .postmeta-under a{color: '+newval+';}.comment .comment-author,.comment time,.comment .reply,.comment .edit-link,.comment .reply a,.comment .edit-link a{color: '+newval+';}.tagcloud a{color: '+newval+';}footer .tagcloud a:hover{border-color: '+newval+';}.portfolio_item{color: '+newval+';}.single_portfolio_meta{color: '+newval+';}footer{color: '+newval+';}footer #footer_copyright .footer_social_links a{color: '+newval+';}.tcvpb-event-tabs .nav-tabs li a{color: '+newval+';}.tcvpb_latest_news_shortcode_content .tcvpb_latest_news_time,.tcvpb_latest_news_shortcode_content .tcvpb_latest_news_categories a{color: '+newval+';}.tcvpb_team_member .tcvpb_team_member_position{color: '+newval+';}.ABt_testimonials_slide	.testimonial_small .source{color: '+newval+';}.ABt_testimonials_slide	.testimonial_big p{color: '+newval+';}.ABt_testimonials_slide	.testimonial_big .source{color: '+newval+';}';
			$('#customizer_dynamic_body_text_color_css').text(new_colors);
		});
	});

	wp.customize('header_background', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
			var matches = patt.exec(newval);
			var rgba = "rgba("+parseInt(matches[1], 16)+","+parseInt(matches[2], 16)+","+parseInt(matches[3], 16)+", 0.7)";
			var rgba_thick = "rgba("+parseInt(matches[1], 16)+","+parseInt(matches[2], 16)+","+parseInt(matches[3], 16)+", 0.9)";
			var new_colors = 'header#aeron_header{background:'+rgba+';}header#aeron_header.full_opacity{background:'+rgba_thick+';}';
			$('#customizer_dynamic_header_color_css').text(new_colors);
		});
	});

	wp.customize('main_menu_items', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'nav>ul>li>a{color:'+newval+';}';
			$('#customizer_dynamic_menu_items_color_css').text(new_colors);
		});
	});

	wp.customize('main_menu_items_hover', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'nav>ul>li a:hover,nav>ul>.current-menu-item>a{color:'+newval+';}';
			$('#customizer_dynamic_menu_items_hover_color_css').text(new_colors);
		});
	});

	wp.customize('footer_background', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = '#topbar.announcement_bar_style_3, footer,.tcvpb_pricing-table-1 .tcvpb_popular-plan .tcvpb_pricebox_featured_text{background:'+newval+';}footer .tagcloud a:hover{color:'+newval+';}';
			$('#customizer_dynamic_footer_background_color_css').text(new_colors);
		});
	});

	wp.customize('footer_borders', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'footer .tagcloud a{border-color:'+newval+';}footer #footer_copyright{border-top-color:'+newval+';}';
			$('#customizer_dynamic_footer_borders_color_css').text(new_colors);
		});
	});

	wp.customize('footer_links', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'footer a{color:'+newval+';}';
			$('#customizer_dynamic_footer_links_color_css').text(new_colors);
		});
	});

	wp.customize('bg_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'body{background-color: '+newval+';}';
			$('#customizer_dynamic_bg_color_css').text(new_colors);
		});
	});

	wp.customize('aeron_title_breadcrumbs_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = '.title_bar{ background: '+newval+';} ';
			$('#customizer_dynamic_breadcrumbs_bg_color_css').text(new_colors);
		});
	});

	wp.customize('blogname', function(value){
		value.bind(function(newval){
			$('#main_logo_textual').html(newval);
		});
	});

	wp.customize('blogdescription', function(value){
		value.bind(function(newval){
			$('#main_logo_tagline').html(newval);
		});
	});

	wp.customize('copyright', function(value){
		value.bind(function(newval){
			$('.footer_copyright').html(newval);
		});
	});

	wp.customize('social_links_label', function(value){
		value.bind(function(newval){
			$('.footer_social_links').html(newval);
		});
	});


})(jQuery);