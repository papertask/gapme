jQuery(document).ready(function($) {
    "use strict";

    var $i=0;
    $('#tcvpb_options_page_form form h2').each(function(){
    	$i++;
    	var active_class = ($i==1) ? 'active' : '';
		$(this).addClass('tcvpb_options_page_tab').data('tab', $i).addClass(active_class);
    	$(this).nextAll('table').first().wrap('<div class="tcvpb_settings_tab" id="tab_content_'+$i+'"></div>');
    	$('#tab_content_'+$i).addClass(active_class);
    	$('#tab_content_'+$i).prev('.tcvpb_options_section_intro').detach().prependTo($('#tab_content_'+$i));
    })
    .wrapAll( "<div id='tcvpb_settings_tabs'></div>");

    $(document).on('click', '.tcvpb_options_page_tab', function(e){
    	e.preventDefault();
    	$('#tcvpb_options_page_form').find('.active').removeClass('active');
    	$(this).addClass('active');
    	var current_tab = $(this).data('tab');
    	$('#tab_content_'+current_tab).addClass('active');

    });

});