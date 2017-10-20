jQuery(document).ready(function($) {
    "use strict";

    var elements = $.parseJSON( tcvpb_from_WP.elements );
    var element_categories = $.parseJSON( tcvpb_from_WP.categories );
    var icons = $.parseJSON( tcvpb_from_WP.icons );

    var tinymce_options = {
        height: 200,
        menubar : false,
        element_format : "html",
        browser_spellcheck : true,
        statusbar : false,
        relative_urls : false,
        remove_script_host : false,
        convert_urls : false,
        forced_root_block : 'p',
        forced_root_block_attrs: {
            "class": "p_tc"
        },
        toolbar: "bold italic underline fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist | indent outdent | subscript superscript | strikethrough | forecolor backcolor hr blockquote | link unlink | image | table charmap | searchreplace | removeformat undo redo",
        plugins: "paste link hr image charmap searchreplace table textcolor colorpicker",
        paste_as_text: true,
        setup: function(editor) {
            editor.on('change', tcvpb_save_button_attribute_changed);
        }   
    };

    var small_tinymce_options = {
        height: 100,
        menubar : false,
        element_format : "html",
        browser_spellcheck : true,
        statusbar : false,
        relative_urls : false,
        remove_script_host : false,
        convert_urls : false,
        forced_root_block : false,
        toolbar: "bold italic underline fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist | indent outdent | subscript superscript | strikethrough | forecolor backcolor hr blockquote | link unlink | image | table charmap | searchreplace | removeformat undo redo",
        plugins: "paste link hr image charmap searchreplace table textcolor colorpicker",
        paste_as_text: true,
        setup: function(editor) {
            editor.on('change', tcvpb_save_button_attribute_changed);
        }   
    };

    var $tc_classic_editor = $("#postdivrich").after(tcvpb_generate_main_html());
    
    var $tcvpb_wrapper = $("#tcvpb_wrapper");
    var $tcvpb_builder = $("#tcvpb_builder");
    
    $("#wp-content-media-buttons").append('<a id="tcvpb_switch_button" class="button button-primary dashicons-before dashicons-schedule tcvpb_tooltip" title="'+tcvpb_from_WP.switch_button_activate+'">'+tcvpb_from_WP.switch_button_activate+'</a>');

    var $tcvpb_content = $("#tcvpb_content");
    var $tcvpb_redo_button = $("#tcvpb_redo_button");
    var $tcvpb_undo_button = $("#tcvpb_undo_button");
    var $tcvpb_hidden_metabox = $('#tcvpb_hidden_metabox');
    var $tcvpb_popup_saved = '';
    var tcvpb_history = [];
    var tcvpb_history_current = 0;
    var max_history = tcvpb_from_WP.tcvpb_history_amount;

    $tcvpb_wrapper.hide();
    $tcvpb_builder.sortable({ 
        items: "> .tcvpb_section_wrapper", 
        handle: ".tcvpb_section_heading", 
        placeholder: "tcvpb_section_placeholder",
        forcePlaceholderSize: true,
        revert: true,
        cursor: "move", 
        tolerance: "pointer",
        stop: function(){
            tcvpb_rebuild_widths();
            tcvpb_write_from_tcvpb_to_editor();
        },
        over: tcvpb_rebuild_widths
    }).disableSelection();

    if($('#tcvpb_tc_activated').is(':checked') || ($('body').hasClass('post-new-php') && $('#tcvpb_tc_activated').hasClass('tcvpb_is_default'))){
        tcvpb_activate_tc('initial');
    }

    // ******************* switch *******************
    $(document).on('click', '#tcvpb_switch_button, #tcvpb_switch_back_button', tcvpb_switch_button)
    // ******************* popup *******************
        .on('click', '#tcvpb_elements_list h3, .tcvpb_iconset_title', tcvpb_elements_header_toggle)
        .on('keyup', '#tcvpb_element_selector_filter', tcvpb_element_selector_filter)
        .on('keyup', '#tcvpb_icon_selector_filter', tcvpb_icon_selector_filter)
        .on('click', '#tcvpb_layouts_button, #tcvpb_load_layout_empty', tcvpb_open_layout_modal)
    // ******************* sections *******************
        .on('click', '#tcvpb_add_section_top, #tcvpb_add_section_empty, .tcvpb_add_section_button', tcvpb_add_section)
        .on('click', '.tcvpb_section_edit, .tcvpb_section_heading h4', tcvpb_section_edit)
        .on('click', '#tcvpb_save_section_settings', tcvpb_save_section_settings)
        .on('click', '.tcvpb_section_duplicate', tcvpb_section_duplicate)
        .on('click', '.tcvpb_section_delete' , tcvpb_section_or_element_delete)
    // ******************* columns *******************
        .on('click', '.tcvpb_add_column', tcvpb_add_column)
        .on('click', '.tcvpb_column_edit', tcvpb_column_edit)
        .on('click', '#tcvpb_save_column_settings', tcvpb_save_column_settings)
        .on('click', '.tcvpb_remove_column', tcvpb_remove_column)
    // ******************* elements *******************
        .on('click', '.tcvpb_add_element', tcvpb_add_element)
        .on('click', '#tcvpb_elements_list li', tcvpb_popup_element_select)
        .on('click', '#tcvpb_popup_back_to_list', tcvpb_popup_back_to_list)
        .on('click', '.tcvpb_popup_tab', tcvpb_popup_tab)
        .on('click', '.tcvpb_element_edit, .tcvpb_element .element_name', tcvpb_element_edit)
        .on('click', '#tcvpb_insert_element, #tcvpb_save_changes', tcvpb_insert_element)
        .on('click', '.tcvpb_element_duplicate', tcvpb_element_duplicate)
        .on('click', '.tcvpb_element_delete' , tcvpb_section_or_element_delete)
        .on('click', '.tcvpb_add_child', tcvpb_add_child)
        .on('click', '.tcvpb_remove_child', tcvpb_remove_child)
        .on('click', '#tcvpb_collapse_children', tcvpb_collapse_children)
        .on('click', '.tcvpb_child_header', tcvpb_collapse_child)
        .on('change keyup', '.tcvpb_shortcode_attribute, #tcvpb_layout_save_input', tcvpb_save_button_attribute_changed)
    // ******************* layouts *******************
        .on('click', '#tcvpb_popup_layout_save, .tcvpb_layout_content_overwrite', tcvpb_layout_save)
        .on('click', '.tcvpb_layout_content_delete', tcvpb_layout_delete)
        .on('click', '.tcvpb_popup_layout_content', tcvpb_load_layout)
    // ******************* others *******************
    	.on('click', '.tcvpb_upload_image_button', tcvpb_upload_image_button)
        .on('click', '.tcvpb_image_delete', tcvpb_image_delete)
        .on('click', '.tcvpb_upload_gallery_button', tcvpb_upload_gallery_button)
        .on('click', '.tcvpb-icon', tcvpb_icon)
        .on('click', '#tcvpb_icon_selector_backdrop', tcvpb_icon_close)
        .on('click', '.tcvpb_icon_selector_select', tcvpb_icon_selector_select)
        .on('click', '.tcvpb-icon-remove', tcvpb_icon_remove)
        .on('keyup', '.tcvpb_cross_field', tcvpb_cross)
        .on('click', '#tcvpb_popup_close, #tcvpb_popup_layout_abort, #tcvpb_popup_backdrop', tcvpb_close_modal)
        .on('DOMMouseScroll mousewheel', '#tcvpb_popup_content, #tcvpb_popup_element_content, #tcvpb_icon_selector', prevent_body_scroll)
        .keydown(close_modal_on_esc);
    $("#tcvpb_fullscreen_button").click(tcvpb_fullscreen_button);
    $("#tcvpb_redo_button, #tcvpb_undo_button").click(tcvpb_undo_redo);

    tcvpb_init_tipsy();

    $(window).resize(function() {
        tcvpb_rebuild_widths();
    });
    
    $(window).load(function() {
        tcvpb_rebuild_widths();
    });


    /*********************************************************************************************
        functions
    *********************************************************************************************/

    function tcvpb_init_tipsy(){
        $('.tcvpb_tooltip').tipsy({
            opacity: 0.8,
            gravity: function(){
                var gravity = $(this).data("gravity");
                gravity = (gravity !== undefined) ? gravity : 's';
                return gravity;
            }
        });
    }


    function tcvpb_generate_main_html(){
        var tc_editor_html = '<div id="tcvpb_wrapper">'+
            '<div id="tcvpb_tools">'+
                '<a href="options-general.php?page=tcvpb" id="tcvpb_go_to_settings" class="tcvpb_tooltip" title="'+tcvpb_from_WP.go_to_settings+'"><i class="pi-settings"></i></a>'+
                '<a href="#" id="tcvpb_switch_back_button"><i class="pi-switch"></i> '+tcvpb_from_WP.switch_button_deactivate+'</a>'+
                '<a href="#" id="tcvpb_fullscreen_button" class="tcvpb_right_buttons tcvpb_tooltip" title="'+tcvpb_from_WP.fullscreen+'"><i class="pi-fullscreen"></i></a>'+
                '<a href="#" id="tcvpb_layouts_button" class="tcvpb_right_buttons tcvpb_tooltip" title="'+tcvpb_from_WP.layouts+'"><i class="pi-layouts"></i></a>'+
                '<a href="#" id="tcvpb_redo_button" class="tcvpb_redo_button tcvpb_right_buttons disabled tcvpb_tooltip" title="'+tcvpb_from_WP.redo+'"><i class="pi-redo"></i></a>'+
                '<a href="#" id="tcvpb_undo_button" class="tcvpb_undo_button tcvpb_right_buttons disabled tcvpb_tooltip" title="'+tcvpb_from_WP.undo+'"><i class="pi-undo"></i></a>'+
            '</div>'+
            '<div id="tcvpb_builder">'+
                '<div id="tcvpb_add_section_top"><span>'+tcvpb_from_WP.plus_section+'</span></div>'+
                '<div id="tcvpb_builder_empty">'+
                    '<p>'+tcvpb_from_WP.layout_select_saved+'</p>'+
                    '<p>'+
                        '<a href="#" id="tcvpb_add_section_empty"><i class="pi-add-box"></i>'+tcvpb_from_WP.add_section+'</a>'+
                        '<a href="#" id="tcvpb_load_layout_empty"><i class="pi-layouts"></i>'+tcvpb_from_WP.load_layout+'</a>'+
                    '</p>'+
                    '<img src="'+tcvpb_from_WP.plugins_url+'/admin/images/logo.png" alt="The Creator"/>'+
                '</div>'+
            '</div>'+
        '</div>';
        return tc_editor_html;
    }

    function tcvpb_section_html(shortcode,title,columns){
        if(title==''){
            title = tcvpb_from_WP.untitled_section;
        }
        var tc_section_html = ''+
            '<div class="tcvpb_section_wrapper">'+
                '<div class="tcvpb_content_section" data-shortcode="'+shortcode+'">'+
                    '<div class="tcvpb_section_heading">'+
                        '<h4>'+($('<div>'+title+'<div>').text())+'</h4>'+
                        '<span class="tcvpb_section_delete tcvpb_tooltip" title="'+tcvpb_from_WP.delete_section+'"><i class="pi-delete"></i></span>'+
                        '<span class="tcvpb_section_duplicate tcvpb_tooltip" title="'+tcvpb_from_WP.duplicate_section+'"><i class="pi-duplicate"></i></span>'+
                        '<span class="tcvpb_section_edit tcvpb_tooltip" title="'+tcvpb_from_WP.edit_section+'"><i class="pi-customize"></i></span>'+
                    '</div>'+
                    '<div class="tcvpb_section_row">'+
                        columns+
                    '</div>'+
                '</div>'+
                '<div class="tcvpb_add_section_button"><span>'+tcvpb_from_WP.plus_section+'</span></div>'+
            '</div>';
        return tc_section_html;
    }

    function tcvpb_column_html(shortcode,span,elements){
        var columns_add_disable = (span==1) ? '' : '';
        var column_empty = (elements=='') ? ' tcvpb_column_empty' : '';
        var tcvpb_column_html = ''+
            '<div class="tcvpb_column'+column_empty+' colspan-'+span+'" data-span="'+span+'" data-shortcode="'+shortcode+'">'+
                '<div class="column_top_fake_element">'+
                    '<span class="tcvpb_add_element"><span>'+tcvpb_from_WP.add_element+'</span></span>'+
                '</div>'+
                elements+
                '<div class="column_properties_baloon">'+
                    '<span class="tcvpb_move_column tcvpb_tooltip" title="'+tcvpb_from_WP.move_column+'"><i class="pi-move"></i></span>'+
                    '<span class="tcvpb_column_edit tcvpb_tooltip" title="'+tcvpb_from_WP.edit_column+'"><i class="pi-customize-alt"></i></span> '+
                    '<span class="tcvpb_remove_column tcvpb_tooltip" title="'+tcvpb_from_WP.remove_column+'"><i class="pi-delete"></i></span>'+
                    '<span class="tcvpb_add_column'+columns_add_disable+' tcvpb_tooltip" title="'+tcvpb_from_WP.add_column+'"><i class="pi-split"></i></span>'+
                    '<span class="tcvpb_add_column column_size tcvpb_tooltip" title="'+tcvpb_from_WP.add_column+'">'+span+'/12</span>'+
                '</div>'+
            '</div>';
        return tcvpb_column_html;
    }

    function tcvpb_element_html(shortcode,title,excerpt){
        excerpt = (excerpt!==undefined) ? $('<div>'+excerpt.replace(/</g,' <').replace(/>/g,'> ').replace(/\[/g,' <').replace(/\]/g,'> ').replace(/\*quot\*/g, '"')+'</div>').text() : '';
        var tc_element_html = ''+
            '<div class="tcvpb_element" data-shortcode="'+shortcode+'">'+
                '<div class="element_name">'+
                    '<span class="element_name_inner">'+title+'</span>'+
                    '<span class="element_excerpt">'+excerpt+'</span>'+
                '</div>'+
                '<span class="tcvpb_element_delete tcvpb_tooltip" title="'+tcvpb_from_WP.delete_element+'"><i class="pi-delete"></i></span>'+
                '<span class="tcvpb_element_duplicate tcvpb_tooltip" title="'+tcvpb_from_WP.duplicate_element+'"><i class="pi-duplicate"></i></span>'+
                '<span class="tcvpb_element_edit tcvpb_tooltip" title="'+tcvpb_from_WP.edit_element+'"><i class="pi-edit"></i></span>'+
                '<span class="tcvpb_add_element"><span>'+tcvpb_from_WP.add_element+'</span></span>'+
            '</div>';
        return tc_element_html;
    }

    function tcvpb_switch_button(e){
        if(typeof e != 'undefined'){
            $(this).disableSelection();
            e.preventDefault();
        }
        if($('#tcvpb_tc_activated').is(':checked')){
            $tcvpb_wrapper.hide();
            $tcvpb_hidden_metabox.hide();
            $('#tc_classic_and_tcvpb_tabs').hide();
            $tc_classic_editor.show();
            //scroll events fixes classic editor when initialized while display:none on it
            $(window).trigger('scroll');
            setTimeout(function(){
                $(window).trigger('scroll');
            },100);
            setTimeout(function(){
                $(window).trigger('scroll');
            },200);
            setTimeout(function(){
                $(window).trigger('scroll');
            },400);
            $('#tcvpb_tc_activated').prop('checked', false);
        }
        else{
            if(typeof tinymce !== 'undefined'){
                tinymce.triggerSave();
            }
            tcvpb_activate_tc('switch');
        }
    }

    function tcvpb_activate_tc(source){
        $tc_classic_editor.hide();
        $tcvpb_wrapper.show();
        $('#tcvpb_tc_activated').prop('checked', true);
        tcvpb_generate_tcvpb_from_content('',source);
        if($('#tcvpb_content').data('mode')==='developer'){
            $tcvpb_hidden_metabox.show();
        }
    }

    function tcvpb_make_columns_sortable(){
        $( ".tcvpb_section_row" ).sortable({
            items: "> .tcvpb_column",
            handle: ".tcvpb_move_column", 
            axis: "x", 
            revert: true,
            tolerance: "pointer",
            placeholder: "tcvpb_column_placeholder",
            forcePlaceholderSize: true,
            start: function(e,ui){
                var item_width = ui.item.width();
                var item_height = ui.item.height();
                $('.tcvpb_column_placeholder').width(item_width).height(item_height);
                ui.item.parents('.tcvpb_section_row').addClass('sorting_row');
            },
            stop: function(e,ui){
                tcvpb_make_columns_resizable();
                tcvpb_rebuild_widths();
                tcvpb_write_from_tcvpb_to_editor();
                ui.item.parents('.tcvpb_section_row').removeClass('sorting_row');
            },
            over: function(){
                tcvpb_rebuild_widths();
            }
        });
    }

    function tcvpb_make_columns_resizable(){
        $('.tcvpb_column').not( ':last-child' ).resizable({
            handles: "e", 
            containment: "parent",
            start: function( event, ui ) {
                var maxWidth = ui.element.width() + ui.element.next().width()-10;
                ui.element.resizable({maxWidth: maxWidth});
                $('.tcvpb_column').each(function(){
                    var item_width = $(this).width();
                    $(this).data("initial_width", item_width);
                });
            },
            resize: function( event, ui ) {
                tcvpb_resize_others(ui.element, ui.originalSize.width - ui.size.width);
                tcvpb_columns_spans(ui.element.parent());
            },
            stop: function( event, ui ) {
                tcvpb_write_from_tcvpb_to_editor();
            }
        }).on('resize', function (e) {
            e.stopPropagation();
        });
    }

    function tcvpb_make_elements_sortable(){
        $( ".tcvpb_column" ).sortable({
            connectWith: ".tcvpb_column",
            items: "> .tcvpb_element",
            revert: true,
            tolerance: "pointer",
            cancel: ".tcvpb_add_element",
            placeholder: "tcvpb_element_placeholder",
            forcePlaceholderSize: true,
            stop: function(){
                tcvpb_rebuild_widths();
                tcvpb_write_from_tcvpb_to_editor();
            },
            over: tcvpb_rebuild_widths
        });
    }

    function tcvpb_collapse_children(){
        var $children_wrapper = $( "#tcvpb_popup_element_content" ).find( ".tcvpb_children_wrapper" );
        if($children_wrapper.hasClass('sorting')){
            $children_wrapper.sortable("destroy").removeClass('sorting').find( ".tcvpb_child" ).removeClass('collapsed').find('.tcvpb_child_collapsable').slideDown(400);
            $('#tcvpb_collapse_children').find('i').removeClass().addClass('pi-collapse');
        }
        else{
            $children_wrapper.find( ".tcvpb_child" ).addClass('collapsed').find('.tcvpb_child_collapsable').slideUp(400,'linear');
            $('#tcvpb_collapse_children').find('i').removeClass().addClass('pi-expand');
            $children_wrapper.addClass('sorting').sortable({
                connectWith: ".tcvpb_children_wrapper",
                items: "> .tcvpb_child",
                handle: ".tcvpb_child_header", 
                cancel: ".tcvpb_remove_child",
                axis: "y", 
                tolerance: "pointer",
                placeholder: "tcvpb_child_placeholder",
                forceHelperSize: true,
                forcePlaceholderSize: true,
                stop: function(event, ui){
                    tcvpb_write_from_tcvpb_to_editor();
                    tcvpb_child_numbers();
                }
            });
        }
    }
    
    function tcvpb_collapse_child(e){
        var $this = $(this);
        if(!$this.is(e.target) && e.target.localName!='span'){
            return;
        }
        var $children_wrapper = $( "#tcvpb_popup_element_content" ).find( ".tcvpb_children_wrapper" );
        $(this).next().slideToggle(400 ,function(){
            $(this).parent().toggleClass('collapsed');
            $('#tcvpb_collapse_children').find('i').removeClass().removeClass('pi-expand').addClass('pi-collapse');

            if(!$children_wrapper.find('.tcvpb_child').not('.collapsed').length > 0){
                tcvpb_collapse_children();
            }
        });
        if($children_wrapper.hasClass('sorting')){
            $children_wrapper.sortable("destroy").removeClass('sorting');
        }
    }

    function tcvpb_save_button_attribute_changed(){
        $('#tcvpb_insert_element, #tcvpb_save_section_settings, #tcvpb_save_column_settings, #tcvpb_popup_layout_save').addClass('attributes_changed');
    }

    function tcvpb_write_from_tcvpb_to_editor(no_history_update){
        if($tcvpb_wrapper.hasClass('syntax_error')){
            return;
        }
        var output="";
        //sections output
        $tcvpb_builder.find('.tcvpb_content_section').each(function(){
            var sectionshortcode = $(this).data("shortcode").replace(/\*quot\*/g, '"');
            output += sectionshortcode+"";
            //output columns in section
            $(this).find(".tcvpb_column").each(function(){
                var columnshortcode = $(this).data("shortcode");
                var span = $(this).data("span");
                output += columnshortcode.replace(/\*quot\*/g, '"').replace(/span='(\d+)'/,"span='"+span+"'")+"";
                //output elements in column
                $(this).find(".tcvpb_element").each(function(){
                    output += $(this).data("shortcode").replace(/\n/g, '').replace(/\*quot\*/g, '"');
                });
                //end of output elements in column
                output += "[/column_tc]";
            });
            //end of output columns in section
            output += "[/section_tc]";
        });
        //end of sections output

        // if first change add initial to history
        if(tcvpb_history.length==0){
            tcvpb_history.unshift($('#tcvpb_content').val());
        }

        // output = output.replace(/<p class="p_tc">&nbsp;<\/p>/g, "[ep_tc]");

        $('#tcvpb_content').val(output);
        $('#content').val(output);
        // output = output.replace(/\r\n|\r|\n/g, "[br_tc]");
        var editor = tinymce.get('content'); 
        if(editor!==undefined && editor!==null){
            editor.setContent(output);
        }

        // add to undo/redo history array
        if(!no_history_update){
            // if changed after undo, restart pointer
            if(tcvpb_history_current!=0){
                tcvpb_history_current = 0;
                $tcvpb_redo_button.addClass('disabled');
            }
            if(tcvpb_history.length >= max_history){
                tcvpb_history.pop();
            }
            tcvpb_history.unshift(output);
            $tcvpb_undo_button.removeClass('disabled');
        }
    }

    function tcvpb_generate_tcvpb_from_content(content,source){
        if(source=='initial'){
            var $initial_content = $('#tcvpb_initial_content');
            if($initial_content.length){
                content = $initial_content.val();
                $initial_content.remove();
            }
        }

        if(source=='switch'){
            content = $('#content').val();
        }

        var force_write_to_editor = false;
        //if content is build with DnD shortcodes
        if(content.indexOf('[section_dd')>-1){
            var r = confirm(tcvpb_from_WP.dnd_content);
            if (r === true){
                if(content.indexOf('span="')<0){
                    //newer dnd version
                    content = content.replace(/_dd/g, '_tc').replace(/\*quot\*/g,'"');
                }
                else{
                    //older dnd version
                    content = content.replace(/_dd/g, '_tc').replace(/"/g,'*quot*').replace(/'/g,'"').replace(/\*quot\*/g,"'");
                }
                force_write_to_editor = true;
            }
            else{
                tcvpb_switch_button();
            }
        }

        $('.tcvpb_section_wrapper').remove();
        $("#tcvpb_builder_empty").hide();
        var output = '';
        var current_section,section_content,section_data,current_column,column_content,column_data,element_name,current_element;
        var index,column_index,no_of_sections = 0;
        var all_elements = tcvpb_from_WP.tcvpb_shortcode_names;

        //replace single quotes with double and vice versa (shortcode attributes must have double quotes for parser to work, html content single quotes, and wordpress saves html as double always)
        content = content.replace(/"/g, '*quot*').replace(/'/g, '"');

        //if there is any content not wrapped properly in section/column structure, show it in first section
        var initial_content = wp.shortcode.replace( 'section_tc', content, function(){return ' ';} ).replace(/&nbsp;/g, ' ').replace(/<p> +<\/p>/g, ' ').trim();
        if(initial_content!==''){
            var column_handler_icons= '<div class="column_properties_baloon"><span class="tcvpb_column_edit tcvpb_tooltip" title="'+tcvpb_from_WP.edit_column+'">'+tcvpb_from_WP.edit_column+'</span><span class="column_size">12/12</span></div>';
            no_of_sections++;

            var element_out = tcvpb_element_html('[text_tc]'+initial_content+'[/text_tc]','Text / HTML',initial_content);
            var column_out = tcvpb_column_html('[column_tc span=\'12\']','12',element_out);
            output += tcvpb_section_html('[section_tc]','',column_out,1);
        }
        // ******* parse sections in content ******* 
        do{
            current_section = wp.shortcode.next( 'section_tc', content, index );
            if(current_section!==undefined){
                no_of_sections++;
                var section_title = '';
                var section_shortcode='[section_tc';
                $.each(current_section.shortcode.attrs.named, function(attribute, value) {
                    section_shortcode += ' ' + attribute + "='"+ value +"'";
                    if( attribute==='section_title'){
                        section_title = value.replace(/\*quot\*/g, '"');
                    }
                });
                section_shortcode=section_shortcode+']';
                section_content = current_section.shortcode.content;
                var columns_output = '';
                column_index = 0;
                //  ******* parse columns in current section ******* 
                do{
                    current_column = wp.shortcode.next( 'column_tc', section_content, column_index );
                    if(current_column!==undefined){
                        //get column atributes
                        var column_shortcode='[column_tc';
                        $.each(current_column.shortcode.attrs.named, function(attribute, value) {
                            column_shortcode += ' ' + attribute + "='"+ value +"'";
                        });
                        column_shortcode=column_shortcode+']';
                        // ******* parse elements in current column ******* 
                        column_content = current_column.shortcode.content+'[last_tcvpb_limit v=1]'; //last_tcvpb_limit is to add dummy last shortcode, to fix WordPress wp.shortcode.next method which has problem when there is only one shortcode in string
                        var loop_exit=0;
                        var elements_output='';
                        do{
                            loop_exit++;
                            var element_shortcode=column_content.substring(column_content.indexOf("[")+1,Math.min(column_content.indexOf(" ",column_content.indexOf("[")), column_content.indexOf("]",column_content.indexOf("["))));
                            if(element_shortcode!==''){
                                current_element = wp.shortcode.next( element_shortcode, column_content );
                                if(typeof current_element !== 'undefined'){
                                    var element_name = tcvpb_from_WP.tcvpb_shortcode_names[current_element.shortcode.tag];
                                    if(element_name === undefined){
                                        element_name = '['+current_element.shortcode.tag+']';
                                    }
                                    if(element_name!=='[last_tcvpb_limit]'){
                                        var shortcode = current_element.content;
                                        shortcode = shortcode.replace(/"/g, "'").replace(/\n/g, "");
                                        
                                        var element_content = current_element.shortcode.content;

                                        elements_output += tcvpb_element_html(shortcode,element_name,element_content);
                                    }
                                    column_content = column_content.replace(current_element.content, '').trim();
                                }
                            }
                        }while(column_content.indexOf("[")>=0 && loop_exit<100);
                        // ******* end parsing elements in current column ******* 
                        columns_output += tcvpb_column_html(column_shortcode, current_column.shortcode.attrs.named.span, elements_output);
                        column_index = current_column.index + 1;
                    }
                }while(current_column!==undefined);
                // ******* end parsing columns in current section ******* 
                output += tcvpb_section_html(section_shortcode,section_title,columns_output);
                index = current_section.index + 1;
            }
        }while(current_section!==undefined);
        // ******* end parsing sections ******* 
        $tcvpb_builder.append(output);
        $('.tcvpb_content_section').each(function(){
            var count_columns = $(this).find('.tcvpb_column').length;
            if(count_columns==12){
                $(this).find('.tcvpb_add_column').addClass('tcvpb_disabled');
            }
        });
        if(no_of_sections===0){
            $("#tcvpb_builder_empty").show();
        }
        else{
            $("#tcvpb_builder_empty").hide();
        }

        tcvpb_make_columns_sortable();
        tcvpb_make_columns_resizable();
        tcvpb_make_elements_sortable();
        tcvpb_rebuild_widths();

        if(force_write_to_editor){
            tcvpb_write_from_tcvpb_to_editor();
        }

    }

    function tcvpb_element_selector_filter() {
        var value = $(this).val().toLowerCase();
        $("#tcvpb_elements_list").find("li").each(function() {
            var text = $(this).text().toLowerCase();
            if (text.search(value) > -1) {
                $(this).show();
            }
            else {
                $(this).hide();
            }
        });
    }

    function tcvpb_icon_selector_filter() {
        var value = $(this).val().toLowerCase();
        $("#tcvpb_icon_selector").find("li").each(function() {
            var text = $(this).find('i').attr('class').toLowerCase();
            if (text.search(value) > -1) {
                $(this).show();
            }
            else {
                $(this).hide();
            }
        });
    }

    function tcvpb_add_section(e){
        e.preventDefault();
        $("#tcvpb_builder_empty").hide();
        var $clicked = $(this);
        var $target = ($clicked.hasClass('tcvpb_add_section_button')) ? $clicked.parent() : $('#tcvpb_add_section_top');
        $target.after(tcvpb_section_html('[section_tc]', '', tcvpb_column_html('[column_tc span=\'12\']', '12', ''),1));
        tcvpb_make_elements_sortable();
        tcvpb_rebuild_widths();
        tcvpb_write_from_tcvpb_to_editor();
    }

    function tcvpb_section_duplicate(e) {
        e.preventDefault();
        var $parent = $(this).parents('.tcvpb_section_wrapper');
        $parent.clone().insertAfter($parent);
        var $new_section = $parent.next().find('.tcvpb_content_section');
        $new_section.find('.ui-resizable-handle').remove();
        tcvpb_out_of_grid($new_section);
        tcvpb_columns_spans($new_section);
        var grid = Math.floor(tcvpb_total_width($new_section)/12);
        tcvpb_make_columns_sortable();
        tcvpb_make_columns_resizable();
        $new_section.children('.tcvpb_column.ui-resizable').resizable("option", {
            grid: [ grid, 10 ],
            minWidth: grid
        });
        tcvpb_make_elements_sortable();
        tcvpb_rebuild_widths();
        tcvpb_write_from_tcvpb_to_editor();
    }

    function tcvpb_section_edit(e) {
        e.preventDefault();
        var offset = $(this).offset();
        var $section = $(this).parents('.tcvpb_content_section');
        $('.editing_section').removeClass('editing_section');
        $section.addClass('editing_section');
        var selected_content = $section.data('shortcode');
        selected_content = selected_content.replace('\r\n','');
        var exploded = selected_content.split(' ');
        exploded = exploded[0].split(']');
        var shortcode = exploded[0].substring(1);

        var edit_data = wp.shortcode.next( shortcode, selected_content );
        var modal_content = tcvpb_modal_content(shortcode, edit_data);
        var button_out = '<a href="#" class="button-primary" id="tcvpb_save_section_settings">'+tcvpb_from_WP.update_section_properties+'</a>';
        
        tcvpb_open_element_modal(tcvpb_from_WP.section_properties,'edit_section',modal_content,e.clientX,e.clientY,'');
    }

    function tcvpb_save_section_settings(e) {
        e.preventDefault();
        if(typeof tinymce !== 'undefined'){
            tinymce.triggerSave();
        }
        var $editing_section = $('.editing_section');
        var section_title = '';
        var section_shortcode_output = "[section_tc";
        $('#tcvpb_popup_element_content .tcvpb_shortcode_attribute').each( function() {
            if(($(this).attr('type')=='checkbox' && $(this).is(':checked')) || ($(this).attr('type')!=='checkbox' &&  $(this).val() !== '' )){
                section_shortcode_output += ' ' + $(this).attr('name') + "='" + $(this).val().replace(/'/g, '&rsquo;') + "'" ;
                if( $(this).attr('name')==='section_title'){
                    section_title = $(this).val().replace(/'/g, '&rsquo;');
                }
            }
        });
        section_shortcode_output += ']';
        section_title = (section_title!='') ? section_title : tcvpb_from_WP.untitled_section;
        $editing_section.find('.tcvpb_section_heading h4').html($('<div>'+section_title+'<div>').text());
        $editing_section.data('shortcode',section_shortcode_output).removeClass('editing_section');
        tcvpb_close_modal();
        tcvpb_write_from_tcvpb_to_editor();
    }

    function tcvpb_section_or_element_delete(e) {
        e.preventDefault();
        var r = confirm(tcvpb_from_WP.are_you_sure);
        if (r === true){
            var $parent = $(this).parent();
            if($(this).hasClass('tcvpb_section_delete')){
                $parent = $(this).parents('.tcvpb_section_wrapper');
            }
            $parent.animate({
                height:"0px", 
                minHeight:"0px", 
                padding:"0px", 
                marginTop:"0px", 
                marginBottom:"0px", 
                border:"0px", 
                opacity:"0"
            }, 400, function(){
                $parent.remove();
                tcvpb_rebuild_widths();
                tcvpb_write_from_tcvpb_to_editor();
                var no_of_sections = $(".tcvpb_section_wrapper").length;
                if(no_of_sections === 0){
                    $("#tcvpb_builder_empty").show();
                }
            });
        }
    }

    function tcvpb_add_column(e) {
        e.preventDefault();
        var $this = $(this);
        if($this.hasClass('tcvpb_disabled')){
            return;
        }
        $this.parents('.tcvpb_column').after(tcvpb_column_html('[column_tc span=\'1\']',1,''));
        var $row = $this.parents('.tcvpb_section_row');
        var count = $row.children('.tcvpb_column').length;
        if(count==12){
            $this.addClass('tcvpb_disabled');
        }
        var column_width = Math.floor($row.width()/count);
        $row.children('.tcvpb_column').each(function(){
            $(this).css("width", column_width+"px");
        });
        tcvpb_out_of_grid($row);
        tcvpb_columns_spans($row);
        var grid = Math.floor(tcvpb_total_width($row)/12);
        $row.children('.tcvpb_column.ui-resizable').resizable("option", {
            grid: [ grid, 10 ],
            minWidth: grid
        });
        tcvpb_make_columns_sortable();
        tcvpb_make_columns_resizable();
        tcvpb_make_elements_sortable();
        tcvpb_rebuild_widths();
        tcvpb_write_from_tcvpb_to_editor();
    }

    function tcvpb_remove_column(e) {
        e.preventDefault();
        var r = confirm(tcvpb_from_WP.column_delete_confirm);
        if (r !== true){
            return;
        }
        var $row = $(this).parents('.tcvpb_section_row');
        var $delete_column = $(this).parents('.tcvpb_column');
        $delete_column.remove();
        $row.find('.tcvpb_add_column').removeClass('tcvpb_disabled');
        var count = $row.children('.tcvpb_column').length;
        if(count==0){
            $row.append(tcvpb_column_html('[column_tc span=\'1\']',12,''));
            count=1;
        }
        var column_width = Math.floor($row.width()/count);
        $row.children('.tcvpb_column').each(function(){
            $(this).css("width", column_width+"px");
        });
        var $last_column_child = $row.children('.tcvpb_column:last-child');
        if($last_column_child.hasClass('ui-resizable')){
            $last_column_child.resizable("destroy");
        }
        tcvpb_out_of_grid($row);
        tcvpb_columns_spans($row);
        tcvpb_rebuild_widths();
        tcvpb_write_from_tcvpb_to_editor();
    }

    function tcvpb_column_edit(e) {
        e.preventDefault();
        var offset = $(this).offset();
        var $column = $(this).parent().parent();
        $('.editing_column').removeClass('editing_column');
        $column.addClass('editing_column');
        var selected_content = $column.data('shortcode');
        selected_content = selected_content.replace('\r\n','');
        var exploded = selected_content.split(' ');
        exploded = exploded[0].split(']');
        var shortcode = exploded[0].substring(1);

        var edit_data = wp.shortcode.next( shortcode, selected_content );
        var modal_content = tcvpb_modal_content(shortcode, edit_data);
        var button_out = '<a href="#" class="button-primary" id="tcvpb_save_column_settings">'+tcvpb_from_WP.update_column_properties+'</a>';

        tcvpb_open_element_modal(tcvpb_from_WP.column_properties,'edit_column',modal_content,e.clientX,e.clientY,'');
    }

    function tcvpb_save_column_settings(e) {
        e.preventDefault();
        var $editing_column = $('.editing_column');
        var current_span = $editing_column.data('span');
        var column_shortcode_output = "[column_tc span='"+current_span+"'";
        $('#tcvpb_popup_element_content .tcvpb_shortcode_attribute').each( function() {
            if(($(this).attr('type')=='checkbox' && $(this).is(':checked')) || ($(this).attr('type')!=='checkbox' &&  $(this).val() !== '' )){
                column_shortcode_output += ' ' + $(this).attr('name') + "='" + $(this).val().replace(/'/g, '&rsquo;') + "'" ;
            }
        });
        column_shortcode_output += ']';
        $editing_column.data('shortcode',column_shortcode_output).removeClass('editing_column');
        tcvpb_close_modal();
        tcvpb_write_from_tcvpb_to_editor();
    }

    function tcvpb_open_element_modal(name,action,content,x,y,child){
        var button_id = 'tcvpb_insert_element';
        if(action=='edit_section'){
            button_id = 'tcvpb_save_section_settings';
            action = 'edit';
        }
        if(action=='edit_column'){
            button_id = 'tcvpb_save_column_settings';
            action = 'edit';
        }

        var position = ' style="top:'+y+'px;left:'+x+'px;"';
        var popup_html = ((action=='edit') ? '<div id="tcvpb_popup" class="tcvpb_modal_'+action+'">' : '')+
            '<div id="tcvpb_popup_window_element"'+position+'>'+
                '<div id="tcvpb_popup_element_content">'+
                    '<div class="tcvpb_popup_header">'+
                        '<h2>'+name+'</h2>'+
                    '</div>'+
                    content+
                '</div>'+
                '<div id="tcvpb_popup_element_footer">'+
                    ((action=='new') ? '<a href="#" id="tcvpb_popup_back_to_list"><i class="pi-undo"></i>'+tcvpb_from_WP.back_to_list+'</a>' : '')+
                    ((child!='')?'<a href="#" id="tcvpb_collapse_children" class="tcvpb_tooltip" title="'+tcvpb_from_WP.collapse_children+'"><i class="pi-collapse"></i></a>':'')+
                    '<a href="#" id="'+button_id+'" class="tcvpb_tooltip" title="'+tcvpb_from_WP.done+'"><i class="pi-done"></i></a>'+
                    '<a href="#" id="tcvpb_popup_close" class="tcvpb_tooltip" title="'+tcvpb_from_WP.cancel+'"><i class="pi-abort"></i></a>'+
                '</div>'+
            '</div>'+
            ((action=='edit') ? '<div id="tcvpb_popup_backdrop"></div>' : '')+
        ((action=='edit') ? '</div>' : '');

        if(action=='edit'){
            $('body').append(popup_html);
        }
        else{
            $('#tcvpb_popup').append(popup_html);
        }
        var $tcvpb_popup_window_element = $('#tcvpb_popup_window_element').draggable({handle:".tcvpb_popup_header, #tcvpb_popup_element_footer"});
        tcvpb_fields_init_js();
        tcvpb_popup_position($tcvpb_popup_window_element);
    }

    function tcvpb_open_select_modal(type,content,footer,x,y){
        var position = ' style="top:'+y+'px;left:'+x+'px;"';
        var popup_html ='<div id="tcvpb_popup" class="tcvpb_modal_'+type+'">'+
            '<div id="tcvpb_popup_window_select"'+position+'>'+
                '<div id="tcvpb_popup_content">'+
                    '<div class="tcvpb_popup_header">'+
                        '<h2>'+tcvpb_from_WP.select_element+'</h2>'+
                        '<input type="text" id="tcvpb_element_selector_filter" class="popup_search" placeholder="'+tcvpb_from_WP.search+'" autofocus>'+
                    '</div>'+
                    content+
                '</div>'+
            '</div>'+
            '<div id="tcvpb_popup_backdrop"></div>'+
        '</div>';
        $('body').append(popup_html);
        var $tcvpb_popup_window_select = $('#tcvpb_popup_window_select').draggable({handle:".tcvpb_popup_header"});
        tcvpb_popup_position($tcvpb_popup_window_select);
    }

    function tcvpb_open_layout_modal(){
        var popup_html ='<div id="tcvpb_popup" class="">'+
            '<div id="tcvpb_popup_window_select">'+
                '<div id="tcvpb_popup_content" class="layouts_manager_content">'+
                    '<div class="tcvpb_popup_header">'+
                        '<h2>'+tcvpb_from_WP.select_layout+'</h2>'+
                    '</div>'+
                    '<div class="tcvpb_loader"></div>'+
                '</div>'+
                '<div id="tcvpb_popup_element_footer">'+
                    '<input type="text" id="tcvpb_layout_save_input" placeholder="'+tcvpb_from_WP.new_layout+'">'+
                    '<a href="#" id="tcvpb_popup_layout_save" class="tcvpb_tooltip" title="'+tcvpb_from_WP.save_layout+'"><i class="pi-save"></i></a>'+
                    '<a href="#" id="tcvpb_popup_layout_abort" class="tcvpb_tooltip" title="'+tcvpb_from_WP.cancel+'"><i class="pi-abort"></i></a>'+
                '</div>'+
            '</div>'+
            '<div id="tcvpb_popup_backdrop"></div>'+
        '</div>';
        $('body').append(popup_html);
        var $tcvpb_popup_window_select = $('#tcvpb_popup_window_select').draggable({handle:".tcvpb_popup_header, #tcvpb_popup_element_footer"});

        var data = {
            action: 'tcvpb_layouts_list'
        };
        tcvpb_init_tipsy();
        $.post(ajaxurl, data, function(response) {
            var layouts = response.split('|');
            var layouts_out = '';
            $.each(layouts,function(index,val){
                if(val!=''){
                    layouts_out += '<div class="tcvpb_popup_layout_content">'+
                        '<span>'+val+'</span>'+
                        '<a class="tcvpb_layout_content_delete">'+tcvpb_from_WP.delete+'</a>'+
                        '<a class="tcvpb_layout_content_overwrite">'+tcvpb_from_WP.layout_overwrite+'</a>'+
                    '</div>';
                }
            });
            var $loader = $tcvpb_popup_window_select.find('.tcvpb_loader');
            $loader.after(layouts_out);
            $loader.remove();
        });
    }

    function tcvpb_icon(e) {
        e.preventDefault();
        var $this = $(this);
        var selected = $this.find('i').attr('class');
        if(!$this.hasClass('active')){
            var icons_out='<div id="tcvpb_icon_selector_wrapper">'+
                '<div id="tcvpb_icon_selector" style="display:none;top:'+e.clientY+'px;left:'+e.clientX+'px;">'+
                    '<div class="tcvpb_popup_header">'+
                        '<h2>'+tcvpb_from_WP.select_icon+'</h2>'+
                        '<input type="text" id="tcvpb_icon_selector_filter" class="popup_search" placeholder="'+tcvpb_from_WP.search+'" autofocus>'+
                    '</div>';
                    $.each(icons, function(index, icon_pack) {
                        icons_out += '<div class="tcvpb_iconset_title">'+icon_pack.name+'<span class="dashicons dashicons-arrow-up"></span></div>'+
                        '<ul>';
                            $.each(icon_pack.icons, function(index, icon_name) {
                                icons_out += '<li class="tcvpb_icon_selector_select'+((selected==icon_name)?' selected':'')+'"><i class="'+icon_name+'"></i></li>';
                            });
                        icons_out += '</ul>';
                    });
                    icons_out += '<div class="select_icon_info">'+tcvpb_from_WP.select_icon_info+'</div>';
                icons_out += '</div>';
                icons_out += '<div id="tcvpb_icon_selector_backdrop"></div>';
            icons_out += '</div>';
            $('body').append(icons_out);
            $('#tcvpb_icon_selector').show().draggable({handle:'.tcvpb_popup_header'});
            $('#tcvpb_icon_selector_filter').focus();
        }
        else{
            tcvpb_icon_close();
        }
        $this.toggleClass('active');
        tcvpb_popup_position($('#tcvpb_icon_selector'));
    }

    function tcvpb_icon_selector_select(){
        var $this = $(this);
        var selected_icon = $this.find('i').attr('class');
        var $icon_field = $('.tcvpb-icon.active');
        var $input_field = $icon_field.find('input');
        $icon_field.find('i').removeClass().addClass(selected_icon);
        $input_field.val(selected_icon).trigger('change');
        $input_field.parent().next().removeClass('hidden');
        tcvpb_icon_close();
    }

    function tcvpb_icon_remove(){
        var $this = $(this).addClass('hidden');
    	$this.prev().find('i').removeClass();
    	$this.prev().find('input').val('').trigger('change');
    }

    function tcvpb_icon_close(){
        $('#tcvpb_icon_selector_wrapper').remove();
        $('.tcvpb-icon.active').removeClass('active');
    }

    function tcvpb_popup_position($popup){
        if($popup.position() !== undefined){
            var position_top = $popup.position().top;
            if(position_top<0){
               $popup.css('top', '10px');
               position_top = 10;
            }
            var position_right = $popup.position().left + $popup.width();
            var position_bottom = $popup.position().top + $popup.height();
            var diff_width = $(window).width()-position_right;
            var diff_height = $(window).height()-position_bottom;
            if(diff_width<0){
                var new_left = $popup.position().left+diff_width-10;
                new_left = (new_left>0) ? new_left : 0;
                $popup.css('left',new_left+'px');
            }
            if(diff_height<0){
                var new_top = $popup.position().top+diff_height-10;
                new_top = (new_top>0) ? new_top : 0;
                $popup.css('top',new_top+'px');
            }
        }
    }

    function tcvpb_close_modal(e){
        if(e!==undefined) e.preventDefault();

        $('body > .tipsy').remove();
        $('#tcvpb_popup').remove();
        tcvpb_icon_close();
        $('.active_add_element').removeClass('active_add_element');
        $('.editing_element').removeClass('editing_element');
        tcvpb_rebuild_widths();
    }

    function close_modal_on_esc(e) {
        if (e.keyCode == 27) {
            tcvpb_close_modal();
        }
    }

    function tcvpb_add_element(e) {
        e.preventDefault();
        $('.after_element').removeClass('after_element');
        $(this).addClass('active_add_element').parent().addClass('after_element');
        var out_elements='<div id="tcvpb_elements_list">';
        $.each(element_categories, function(cat_index,category){
            var cat_out_elements = '';
            $.each(elements, function(index,element){
                if(element.type=='block' && element.category==category){
                    cat_out_elements += '<li data-element="'+index+'" data-category="'+element.category+'"><i class="'+element.icon+'"></i><span>'+element.name+'</span></li>';
                }
            });
            if(cat_out_elements!=''){
                out_elements += '<h3>'+category+'<span class="dashicons dashicons-arrow-up"></span></h3><ul>'+cat_out_elements+'</ul>';
            }
        });
        out_elements+='</div>';
        tcvpb_open_select_modal('select',out_elements,'',e.clientX,e.clientY-100);
        $('#tcvpb_element_selector_filter').focus();
    }

    function tcvpb_attribute_fields(attribute_name, attribute, value){
        var class_out = (attribute.divider=='true') ? ' before_divider' : '';
        class_out += (attribute.tab!==undefined && attribute.tab!=tcvpb_from_WP.general_tab) ? ' hidden_tab_content' : '';
        var tab_out = ' data-tab="'+((attribute.tab!==undefined) ? attribute.tab : tcvpb_from_WP.general_tab)+'"';
        var attribute_fields = '<div class="tcvpb_shortcode_attribute_row'+((attribute.type=='hidden')?' hidden':'')+class_out+'"'+tab_out+'><label for="tcvpb_shortcode_attribute_'+attribute_name+'">'+attribute.description+'</label><div class="attribute attribute-'+attribute.type+'">';
        var set_value = '';
        if(attribute.default!==undefined){
            set_value = attribute.default;
        }
        if(value!==undefined){
            set_value = value;
        }
        set_value = set_value.replace(/\*quot\*/g,'"');
        switch (attribute.type) {
            case "checkbox":
                var checked = (set_value=='1') ? ' checked' : '';
                attribute_fields += '<input type="checkbox" name="'+attribute_name+'" value="1" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute"'+checked+'>';
            break;
            case "textarea":
                attribute_fields += '<textarea name="'+attribute_name+'" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute">'+set_value+'</textarea>';
            break;
            case "small_tinymce":
                attribute_fields += '<textarea name="'+attribute_name+'" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute textarea_small_tinymce">'+set_value+'</textarea>';
            break;
            case "select":
                attribute_fields += '<select name="'+attribute_name+'" value="" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute">';
                $.each(attribute.values, function(value, label){
                    attribute_fields += '<option value="'+value+'"'+((set_value==value) ? ' selected' :'')+'>'+label+'</option>';
                });
                attribute_fields += '</select>';
            break;
            case "color":
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute tcvpb-colorpicker">';
            break;
            case "coloralpha":
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute tcvpb-colorpicker" data-show-alpha="true" data-local-storage-key="spectrum.tcvpb-alpha" data-preferred-format="rgb" data-max-selection-size="10">';
            break;
            case "icon":
                attribute_fields += '<div class="tcvpb-icon"><i class="'+set_value+'"></i><div class="is-dd">▼</div><input type="hidden" name="'+attribute_name+'" value="'+set_value+'" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute"></div><span class="tcvpb-icon-remove'+((set_value=='')?' hidden' : '')+'">'+tcvpb_from_WP.remove+'</span>';
            break;
            case "gallery":
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute">';
                attribute_fields += '<input type="button" value="'+tcvpb_from_WP.upload_gallery+'" class="button tcvpb_upload_gallery_button">';
            break;
            case "image":
                attribute_fields += '<div class="tcvpb_image_upload_image">'+((set_value!='')?'<img src="'+set_value+'">':'')+'</div>';
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute">';
                attribute_fields += '<input type="button" value="'+tcvpb_from_WP.upload_image+'" class="button tcvpb_upload_image_button">';
                attribute_fields += '<span class="tcvpb_image_delete'+((set_value=='')?' display_none':'')+' tcvpb_tooltip" title="'+tcvpb_from_WP.delete_image+'"><i class="pi-delete"></i></span>';
            break;
            case "media":
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute">';
                attribute_fields += '<input type="button" value="'+tcvpb_from_WP.upload_media+'" class="button tcvpb_upload_image_button">';
            break;
            case "padding":
                attribute_fields += '<div class="tcvpb-cross-wrapper">';
                    attribute_fields += '<input type="hidden" name="'+attribute_name+'" value="'+set_value+'" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute tcvpb-cross">';
                    attribute_fields += '<div class="tcvpb-cross-margin">';
                        attribute_fields += '<span>'+tcvpb_from_WP.cross_margin+'</span>';
                        attribute_fields += '<input type="text" value="" placeholder="-" data-prop="margin-top" class="tcvpb_cross_field tcvpb-margin-top">';
                        attribute_fields += '<input type="text" value="" placeholder="x" data-prop="margin-right" class="tcvpb_cross_field tcvpb-margin-right" title="'+tcvpb_from_WP.property_disabled+'" disabled>';
                        attribute_fields += '<input type="text" value="" placeholder="-" data-prop="margin-bottom" class="tcvpb_cross_field tcvpb-margin-bottom">';
                        attribute_fields += '<input type="text" value="" placeholder="x" data-prop="margin-left" class="tcvpb_cross_field tcvpb-margin-left" title="'+tcvpb_from_WP.property_disabled+'" disabled>';
                    attribute_fields += '</div>';
                    attribute_fields += '<div class="tcvpb-cross-border">';
                        attribute_fields += '<span>'+tcvpb_from_WP.cross_border+'</span>';
                        attribute_fields += '<input type="text" value="" placeholder="-" data-prop="border-top" class="tcvpb_cross_field tcvpb-border-top">';
                        attribute_fields += '<input type="text" value="" placeholder="-" data-prop="border-right" class="tcvpb_cross_field tcvpb-border-right">';
                        attribute_fields += '<input type="text" value="" placeholder="-" data-prop="border-bottom" class="tcvpb_cross_field tcvpb-border-bottom">';
                        attribute_fields += '<input type="text" value="" placeholder="-" data-prop="border-left" class="tcvpb_cross_field tcvpb-border-left">';
                    attribute_fields += '</div>';
                    attribute_fields += '<div class="tcvpb-cross-padding">';
                        attribute_fields += '<span>'+tcvpb_from_WP.cross_padding+'</span>';
                        attribute_fields += '<input type="text" value="" placeholder="-" data-prop="padding-top" class="tcvpb_cross_field tcvpb-padding-top">';
                        attribute_fields += '<input type="text" value="" placeholder="-" data-prop="padding-right" class="tcvpb_cross_field tcvpb-padding-right">';
                        attribute_fields += '<input type="text" value="" placeholder="-" data-prop="padding-bottom" class="tcvpb_cross_field tcvpb-padding-bottom">';
                        attribute_fields += '<input type="text" value="" placeholder="-" data-prop="padding-left" class="tcvpb_cross_field tcvpb-padding-left">';
                    attribute_fields += '</div>';
                attribute_fields += '</div>';
            break;
            case "url":
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute tcvpb-url-attr">';
            break;
            case "hidden":
                attribute_fields += '<input type="hidden" name="'+attribute_name+'" value="'+set_value+'" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute">';
            break;
            default:
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="tcvpb_shortcode_attribute_'+attribute_name+'" class="tcvpb_shortcode_attribute">';
        }
        if(attribute.info!==undefined){
            attribute_fields += '<span class="tcvpb_attribute_info">'+attribute.info+'</span>';
        }
        attribute_fields += '</div>';
        attribute_fields += '</div>';
        
        if(attribute.divider=='true'){
            attribute_fields += '<div class="divider'+class_out+'"'+tab_out+'></div>';
        }

        return attribute_fields;
    }

    function tcvpb_fields_init_js(){
        $('.tcvpb-url-attr').each(function(){
            var $this = $(this);
            var $url_row = $this.parents('.tcvpb_shortcode_attribute_row');
            var $target_row = $url_row.next();
            if($target_row.hasClass('before_divider')){
                $url_row.addClass('before_divider');
            }
            $target_row.addClass('hidden').find('select').detach().insertAfter($this).addClass('tcvpb-target');
        });
        $('.tcvpb-colorpicker').each(function(){
            $(this).spectrum({
                showAlpha: false,
                showInput: true,
                showPalette: true,
                appendTo: $(this).parent(),
                showSelectionPalette: true,
                palette: [ ],
                localStorageKey: "spectrum.tcvpb",
                maxSelectionSize: 9,
                showInitial: true,
                allowEmpty: true,
                preferredFormat: "hex",
                chooseText: "Select",
                cancelText: "cancel"
            });
        });
        if(typeof tinymce !== 'undefined'){
            $('.textarea_tinymce').each(function(){
                $(this).uniqueId();
                tinymce_options.selector = '#'+$(this).attr('id');
                tinymce.init(tinymce_options);
            });
            $('.textarea_small_tinymce').each(function(){
                var $this = $(this);
                $this.uniqueId();
                $this.attr('id', $this.attr('id')+Math.floor((Math.random() * 10000000) + 1));
                small_tinymce_options.selector = '#'+$this.attr('id');
                tinymce.init(small_tinymce_options);
            });
        }
        $('.tcvpb-cross').each(function(){
            var $this = $(this);
            var $parent = $this.parent('.tcvpb-cross-wrapper');
            var value = $this.val();
            var values = value.split(';');
            if($.isArray(values) && values.length>0){
                $.each(values,function(i,val){
                    val = val.split(':');
                    var property = val[0].trim();
                    var prop_val = parseInt(val[1]);
                    $parent.find('.tcvpb-'+property).val(prop_val);
                });
            }
        });
        $('#tcvpb_popup_element_content').scrollTop(0);
        tcvpb_init_tipsy();
    }

    function tcvpb_modal_content(selected_element, edit_data){
        var tabs_out = {};
        tabs_out[tcvpb_from_WP.general_tab] = '';
        var action_value = 'new';
        if(edit_data!==undefined){
            action_value = 'edit';
        }

        var main_content_out = '<input type="hidden" id="tcvpb_action" value="'+action_value+'"><input type="hidden" id="tcvpb_selected_element" value="'+selected_element+'">';

        var attributes_table_content = '';
        //if element has attributes
        if(elements[selected_element].attributes!==undefined){
            attributes_table_content += '<div class="tcvpb_main_attributes">';
            $.each(elements[selected_element].attributes, function(attribute_name, attribute){
                var tab_name = (attribute.tab!==undefined) ? attribute.tab : tcvpb_from_WP.general_tab;
                tabs_out[tab_name] = '<a href="#" class="tcvpb_popup_tab'+((tab_name==tcvpb_from_WP.general_tab)?' active':'')+'" data-name="'+tab_name+'">'+tab_name+'</a>';
                if(action_value=='edit'){
                    var field_value = edit_data.shortcode.attrs.named[attribute_name];
                    if( !(selected_element=='column_tc' && attribute_name=='span') ){
                        attributes_table_content += tcvpb_attribute_fields(attribute_name, attribute, field_value);
                    }
                }
                else{
                    attributes_table_content += tcvpb_attribute_fields(attribute_name, attribute);
                }
            });
            attributes_table_content += '</div>';
        }

        //if element has child elements and action is new
        if(action_value=='new' && elements[selected_element].child!==undefined){
            attributes_table_content += '<div class="tcvpb_children_wrapper">';
                attributes_table_content += '<div class="tcvpb_child"><div class="tcvpb_child_header"><span class="number">1</span>. <span class="title">'+elements[selected_element].child_title+'</span><a class="tcvpb_remove_child">'+tcvpb_from_WP.delete+'</a></div>';
                    attributes_table_content += '<div class="tcvpb_child_collapsable">';
                var child_name = elements[selected_element].child;
                    //if child has attributes
                    if(elements[child_name].attributes!==undefined){
                        $.each(elements[child_name].attributes, function(attribute_name, attribute){
                            attributes_table_content += tcvpb_attribute_fields(attribute_name, attribute);
                        });
                    }
                    //if child has content
                    if(elements[child_name].content!==undefined){
                        attributes_table_content += '<label for="tcvpb_child_content">'+elements[child_name].content.description+'</label>';
                        attributes_table_content += '<textarea name="tcvpb_child_content" class="tcvpb_child_content textarea_tinymce"></textarea>';
                    }

                    attributes_table_content += '<div class="tcvpb_child_button">';
                    var button_text = (elements[selected_element].child_button != undefined) ? elements[selected_element].child_button : tcvpb_from_WP.add_child;
                    attributes_table_content += '<a href="#" class="tcvpb_add_child"><span>+ '+button_text+'</span></a>';
                    attributes_table_content += '</div>';

                attributes_table_content += '</div>';
                attributes_table_content += '</div>';
            attributes_table_content += '</div>';
        }

        //if element has child elements and action is edit
        else if(action_value=='edit' && elements[selected_element].child!==undefined && edit_data.shortcode.content!==undefined){
            attributes_table_content += '<div class="tcvpb_children_wrapper">';
                var child_content = edit_data.shortcode.content;
                child_content = child_content+'[last_tcvpb_limit v=1]'; //last_tcvpb_limit is to add dummy last shortcode, to fix WordPress wp.shortcode.next method which has problem when there is only one shortcode in string
                var loop_exit=0;
                do{
                    loop_exit++;
                    var child_shortcode=elements[selected_element].child;

                    if(child_shortcode!==''){
                        var current_element = wp.shortcode.next( child_shortcode, child_content );
                        if(typeof current_element !== 'undefined'){
                            var element_name = current_element.name;
                            if(element_name!=='[last_tcvpb_limit]'){
                                attributes_table_content += '<div class="tcvpb_child"><div class="tcvpb_child_header"><span class="number">'+loop_exit+'</span>. <span class="title">'+elements[selected_element].child_title+'</span><a class="tcvpb_remove_child">'+tcvpb_from_WP.delete+'</a></div>';
                                attributes_table_content += '<div class="tcvpb_child_collapsable">';

                                var child_name = elements[selected_element].child;
                                //if child has attributes
                                if(elements[child_name].attributes!==undefined){
                                    $.each(elements[child_name].attributes, function(attribute_name, attribute){
                                        var child_att_value_out = (current_element.shortcode.attrs.named[attribute_name]!==undefined) ? current_element.shortcode.attrs.named[attribute_name] : '';
                                        attributes_table_content += tcvpb_attribute_fields(attribute_name, attribute, child_att_value_out);
                                    });
                                }
                                //if child has content
                                if(elements[child_name].content!==undefined){
                                    var child_content_out = (current_element.shortcode.content!==undefined) ? current_element.shortcode.content : '';
                                    attributes_table_content += '<label for="tcvpb_child_content">'+elements[child_name].content.description+'</label>';
                                    attributes_table_content += '<textarea name="tcvpb_child_content" class="tcvpb_child_content textarea_tinymce">'+child_content_out.replace(/\[br_tc\]/g, '<br>').replace(/\[nbsp_tc\]/g, '&nbsp;')+'</textarea>';
                                }


                                attributes_table_content += '<div class="tcvpb_child_button">';
                                var button_text = (elements[selected_element].child_button != undefined) ? elements[selected_element].child_button : tcvpb_from_WP.add_child;
                                attributes_table_content += '<a href="#" class="tcvpb_add_child"><span>+ '+button_text+'</span></a>';
                                attributes_table_content += '</div>';


                                attributes_table_content += '</div>';
                                attributes_table_content += '</div>';
                            }
                            child_content = child_content.replace(current_element.content, '').trim();
                        }
                    }
                }while(child_content.indexOf("[")>=0 && loop_exit<100);
            attributes_table_content += '</div>';

        }

        //if element has content
        else if(elements[selected_element].content!==undefined && selected_element!='section_tc' && selected_element!='column_tc'){
            var content_value = (action_value=='edit' && edit_data.shortcode.content!==undefined) ? edit_data.shortcode.content : '';
            attributes_table_content += '<div class="tcvpb_main_content">';
            attributes_table_content += '<label for="tcvpb_element_content">'+elements[selected_element].content.description+'</label>';
            attributes_table_content += '<textarea name="tcvpb_element_content" class="tcvpb_element_content textarea_tinymce">'+content_value.replace(/\[br_tc\]/g, '<br>').replace(/\[nbsp_tc\]/g, '&nbsp;')+'</textarea>';
            attributes_table_content += '</div>';
        }
        

        var tabs_content_out = '<div id="tcvpb_popup_tabs">';
        var tabs_no = 0;
        $.each(tabs_out, function(i,value){
            tabs_no++;
            tabs_content_out += value;
        });
        tabs_content_out += '</div>';
        
        if(tabs_no>1){
            main_content_out += tabs_content_out;
        }

        main_content_out += '<div class="tcvpb_attributes_table'+((tabs_no>1) ? '' : ' tcvpb_attributes_table_no_tabs')+'">';
        if(elements[selected_element].notice!==undefined){
            main_content_out += '<div class="tcvpb_popup_element_description">'+elements[selected_element].notice+'</div>';
        }
        main_content_out += attributes_table_content;
        main_content_out += '</div>';
        

        return main_content_out;
    }

    function tcvpb_popup_element_select(e){
        e.preventDefault();
        var $tcvpb_popup_window_select = $('#tcvpb_popup_window_select');
        var position = $tcvpb_popup_window_select.position();
        $tcvpb_popup_window_select.hide();
        var selected_element = $(this).data('element');
        var main_content_out = tcvpb_modal_content(selected_element);
        var child = (elements[selected_element].child!=undefined) ? elements[selected_element].child : '';
        tcvpb_open_element_modal(elements[selected_element].name,'new',main_content_out,position.left,position.top,child);
    }

    function tcvpb_popup_back_to_list(e){
        e.preventDefault();
        $('#tcvpb_popup_window_element').remove();
        $('#tcvpb_popup_window_select').show();
        $('#tcvpb_element_selector_filter').focus();
    }

    function tcvpb_popup_tab(e){
        e.preventDefault();
        $('.tcvpb_popup_tab').removeClass('active');
        var $selected_tab = $(this);
        var selected_tab_name = $selected_tab.data('name');
        $selected_tab.addClass('active');

        var $children = $('#tcvpb_popup_element_content').find('.tcvpb_child');
        if(selected_tab_name!=tcvpb_from_WP.general_tab){
            $children.addClass('hidden_tab_content');
            $('.tcvpb_main_content').addClass('hidden_tab_content');
            $('#tcvpb_collapse_children').addClass('hidden_tab_content');
        }
        else{
            $children.removeClass('hidden_tab_content');
            $('.tcvpb_main_content').removeClass('hidden_tab_content');
            $('#tcvpb_collapse_children').removeClass('hidden_tab_content');
        }

        $('#tcvpb_popup_element_content').find('.tcvpb_shortcode_attribute_row, .divider').addClass('hidden_tab_content').each(function(){
            if($(this).data('tab')==selected_tab_name){
                $(this).removeClass('hidden_tab_content');
            }
        });
    }

    function tcvpb_element_edit(e) {
        var $this = $(this);
        var $parent = $this.parent();
        var offset = $this.offset();
        var selected_content = $parent.data('shortcode').replace(/\*quot\*/g, '"');
        var exploded = selected_content.split(' ');
        exploded = exploded[0].split(']');
        var shortcode = exploded[0].substring(1);
        $('.editing_element').removeClass('editing_element');
        $parent.addClass('editing_element');

        var selected_content = selected_content+'[last_tcvpb_limit v=1]';
        var edit_data = wp.shortcode.next( shortcode, selected_content );

        var main_content_out = tcvpb_modal_content(shortcode, edit_data);
        var child = (elements[shortcode].child!=undefined) ? elements[shortcode].child : '';

        tcvpb_open_element_modal(elements[shortcode].name,'edit',main_content_out,e.clientX,e.clientY,child);
    }

    function tcvpb_insert_element(e) {
        e.preventDefault();
        if(typeof tinymce !== 'undefined'){
            tinymce.triggerSave();
        }
        var action = $('#tcvpb_action').val();
        var selected_shortcode = $('#tcvpb_selected_element').val();
        var shortcode_title = elements[selected_shortcode].name;
        var tcvpb_shortcode_child_name = elements[selected_shortcode].child;
        var output = '[' + selected_shortcode;
        $('.tcvpb_main_attributes .tcvpb_shortcode_attribute').each( function() {
            if( ( $(this).attr('type') == 'checkbox' && $(this).is(':checked') ) || ($(this).attr('type') !== 'checkbox' &&  $(this).val() !== '' )){
                output += ' ' + $(this).attr('name') + "='" + $(this).val().replace(/'/g, '&rsquo;') + "'" ;
            }
        });
        output += ']';
        // children
        var count_children=0;
        var element_content_print = '';
        var children_element_content = '';

        $('.tcvpb_child').each(function() {
            output += '[' + tcvpb_shortcode_child_name;
            $(this).find('.tcvpb_shortcode_attribute').each(function() {
                if( ( $(this).attr('type') == 'checkbox' && $(this).is(':checked') ) || ($(this).attr('type') !== 'checkbox' &&  $(this).val() !== '' )){
                    output += ' ' + $(this).attr('name') + "='" + $(this).val().replace(/'/g, '&rsquo;')  + "'" ;
                }
            });
            children_element_content += ($(this).find('.tcvpb_child_content').val()!==undefined) ? $(this).find('.tcvpb_child_content').val()+' ' : '';
            output += ']';
            output += (($(this).find('.tcvpb_child_content').val()!==undefined) ? $(this).find('.tcvpb_child_content').val().replace(/<br\s*\/?>/ig, '[br_tc]').replace(/&nbsp;/g, "[nbsp_tc]") : '') + '[/' + tcvpb_shortcode_child_name + ']';
            count_children++;
        });
        // content and wrap shortcode
        if (count_children === 0){
            var tcvpb_element_content = (($('.tcvpb_element_content').val()!==undefined) ? $('.tcvpb_element_content').val().replace(/<br\s*\/?>/ig, '[br_tc]').replace(/&nbsp;/g, "[nbsp_tc]") : '') + '[/' + selected_shortcode + ']';
            output += tcvpb_element_content;
            element_content_print += tcvpb_element_content;
        }
        else{
            output += '[/' + selected_shortcode + ']';
        }
        output=output.replace(/"/g, '*quot*');

        if($tcvpb_wrapper.is(':visible')){
            if(action==='new'){
                $('.after_element').after(tcvpb_element_html(output,shortcode_title,children_element_content+element_content_print));
                $('.after_element').removeClass('after_element');
                tcvpb_rebuild_widths();
            }
            else if(action==='edit'){
                element_content_print = $('<div>' +children_element_content+element_content_print.replace(/</g,' <').replace(/>/g,'> ').replace(/\[/g,' <').replace(/\]/g,'> ')+'</div>').text();
                $('.editing_element').find('.element_excerpt').html(element_content_print);
                $('.editing_element').data('shortcode',output).removeClass('editing_element');
            }
            tcvpb_write_from_tcvpb_to_editor();
        }
        else{
            window.send_to_editor(output);
        }
        tcvpb_close_modal();
    }

    function tcvpb_element_duplicate(e) {
        e.preventDefault();
        var $parent = $(this).parent();
        $parent.clone().insertAfter($parent);
        tcvpb_rebuild_widths();
        tcvpb_write_from_tcvpb_to_editor();
    }

    function tcvpb_add_child(e) {
        e.preventDefault();
        var $after_child = $(this).parents('.tcvpb_child');
        var $new_child = $after_child.clone().hide().detach().insertAfter($after_child).slideDown(800);
        
        $new_child.find('.tcvpb-colorpicker').each(function(){
        	$(this).show().siblings().remove();
        }).spectrum({
            showAlpha: true,
            showInput: true,
            showPalette: true,
            showSelectionPalette: true,
            palette: [ ],
            localStorageKey: "spectrum.tcvpb",
            maxSelectionSize: 10,
            showInitial: true,
            allowEmpty: true,
            preferredFormat: "hex",
            chooseText: tcvpb_from_WP.spectrum_select,
            cancelText: tcvpb_from_WP.spectrum_cancel
        });

        if(typeof tinymce !== 'undefined'){
            var $cloned_editor = $new_child.find(".mce-tinymce");
            var $textarea = $cloned_editor.next("textarea");
            $textarea.insertBefore($cloned_editor).show().attr('id', '').uniqueId();
            var textarea_id = $textarea.attr('id');
            $cloned_editor.remove();

            tinymce_options.selector = '#'+textarea_id;
            tinymce.init(tinymce_options);
        }
        tcvpb_child_numbers();
    }

    function tcvpb_remove_child(e) {
        e.preventDefault();
        var $parent = $(this).parents('.tcvpb_child').addClass('disabled');
        var $children_wrapper = $parent.parent();
        if($children_wrapper.children('.tcvpb_child').length > 1){
            if($children_wrapper.hasClass('sorting')){
                $parent.remove();
            }
            else{
                $parent.slideUp(800,function(){
                    $(this).remove();
                    tcvpb_child_numbers();
                });
            }
        }
        else{
            $parent.removeClass('disabled').find('input,textarea').val('');
        }
        if(!$children_wrapper.hasClass('sorting') && !$children_wrapper.find('.tcvpb_child').not('.disabled').not('.collapsed').length > 0){
            tcvpb_collapse_children();
        }
        tcvpb_child_numbers();
    }

    function tcvpb_child_numbers() {
        var order_no = 0;
        $('#tcvpb_popup_element_content').find('.tcvpb_child_header').each(function(){
            order_no++;
            $(this).find('.number').text(order_no);
        });
    }

    function tcvpb_resize_others($item,diff){
        var $sibling = $item.next();
        var new_width = $sibling.data("initial_width") + diff;
        $sibling.css("width", new_width);
    }

    function tcvpb_out_of_grid($item){
        var count = $item.children('.tcvpb_column').length;
        var i = 0;
        var grid = Math.floor(tcvpb_total_width($item)/12);
        if(count==5){
            $item.children('.tcvpb_column').each(function(){
                var col_width = (i<2) ? grid*3 : grid*2;
                i++;
                $(this).css("width", col_width+"px");
            });
        }
        else if(count>6){
            $item.children('.tcvpb_column').each(function(){
                var col_width = (i<1) ? grid*(12-count+1) : grid*1;
                i++;
                $(this).css("width", col_width+"px");
            });
        }
    }

    function tcvpb_columns_spans($item){
        var total_width=0;
        $item.children('.tcvpb_column').each(function(){
            total_width += $(this).width();
        }).each(function(){
            var span = Math.round($(this).width() / (total_width / 12));
            $(this).find('.column_properties_baloon .column_size').html(span + '/12');
            $(this).data("span",span).attr('class', $(this).get(0).className.replace(/(^|\s)colspan-\S+/g, '')).addClass('colspan-'+span);
        });
    }

    function tcvpb_total_width($item){
        var total_width=0;
        $item.children('.tcvpb_column').each(function(){
            total_width += $(this).width();
        });
        return total_width;
    }

    function tcvpb_rebuild_widths(){
        tcvpb_init_tipsy();
        $tcvpb_builder.find('.tcvpb_content_section').each(function(){
            var $current_section = $(this);
            var resize_sectionWidth = $current_section.width();
            var resize_grid = Math.floor(resize_sectionWidth/12);
            var $columns = $current_section.find('.tcvpb_column');
            if($columns.length>=12){
                $columns.find('.tcvpb_add_column').addClass('tcvpb_disabled');
            }
            $columns.each(function(){
                var $current_column = $(this);
                var elements_no = $current_column.find('.tcvpb_element').length;
                if(elements_no==0){
                    $current_column.addClass('tcvpb_column_empty');
                }
                else{
                    $current_column.removeClass('tcvpb_column_empty');
                }
                var resize_col_width = $current_column.data("span")*resize_grid;
                $current_column.css("width", resize_col_width+"px");
                var max_width = $current_column.width() + $current_column.next().width();
                if($current_column.hasClass('ui-resizable')){
                    if($current_column.is(":last-child")){
                        $current_column.resizable("destroy");
                    }
                    else{
                        $current_column.resizable( "option", {
                            grid: [ resize_grid, 10 ],
                            minWidth: resize_grid,
                            maxWidth: max_width
                        });
                    }
                }
            });
        });
    }

    function tcvpb_layout_save(e){
        e.preventDefault();
        $('#tcvpb_popup_content').append('<div id="tcvpb_popup_content_loader"></div>');
        if($(this).hasClass('tcvpb_layout_content_overwrite')){
        	var name = $(this).parent().find('span').text();
        	var source = 'overwrite';
        }
        else{
        	var name = $('#tcvpb_layout_save_input').val();
        	var source = 'new';
        }
        if (name!=null && name!=''){
            var data = {
                action: 'tcvpb_save_layout',
                source: source,
                name: name,
                layout: $('#tcvpb_content').val()
            };
            $.post(ajaxurl, data, function(response) {
                alert(tcvpb_from_WP.layout_saved);
            	tcvpb_close_modal();
            });
        }
        else{
        	alert(tcvpb_from_WP.layout_name_required);
        	$('#tcvpb_popup_content_loader').remove();
        }
    }

    function tcvpb_layout_delete(e){
        e.preventDefault();
        $('#tcvpb_popup_content').append('<div id="tcvpb_popup_content_loader"></div>');

        var r = confirm(tcvpb_from_WP.are_you_sure);
       	$('#tcvpb_popup_content_loader').remove();
        if (r !== true){
            return;
        }
        $('#tcvpb_popup_content').append('<div id="tcvpb_popup_content_loader"></div>');

        var $parent = $(this).parent();
        var name = $parent.find('span').text();
        if (name!=null && name!=''){
            var data = {
                action: 'tcvpb_delete_layout',
                name: name,
            };
            $.post(ajaxurl, data, function(response) {
                $parent.slideUp();
        		$('#tcvpb_popup_content_loader').remove();
            });
        }
    }

    function tcvpb_load_layout(e){
        var $select = $(this);
        if(!$select.is(e.target) && e.target.localName!='span'){
        	return;
        }
        $('#tcvpb_popup_content').append('<div id="tcvpb_popup_content_loader"></div>');
        var selected_layout = $select.find('span').text();
        if(selected_layout!=''){
            var data = {
                action: 'tcvpb_load_layout',
                selected_layout: selected_layout,
            };
            $.post(ajaxurl, data, function(response) {
                tcvpb_generate_tcvpb_from_content($('#tcvpb_content').val()+response);
                tcvpb_write_from_tcvpb_to_editor();
                tcvpb_close_modal();
            });
        }
    }

    function tcvpb_cross(e) {
        var $parent = $(this).parents('.tcvpb-cross-wrapper');
        var $hidden_field = $parent.find('.tcvpb-cross');
        var $input_fields = $parent.find('.tcvpb_cross_field');

        var output = '';
        $input_fields.each(function(){
            var $field = $(this);
            if($field.val()!=''){
                output += $field.data('prop')+':'+parseInt($field.val(),10)+'px;';
            }
        });
        $hidden_field.val(output).trigger('change');
    }

    function tcvpb_upload_image_button(e) {
        e.preventDefault();
        var $input_field = $(this).prev();
        var custom_uploader = wp.media.frames.file_frame = wp.media({
            title: tcvpb_from_WP.choose_image,
            button: {
                text: tcvpb_from_WP.use_image
            },
            multiple: false
        }).on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $input_field.val(attachment.url).trigger('change');
            $input_field.next().next().removeClass('display_none');
            $input_field.prev().html('<img class="" src="'+attachment.url+'">');
        }).open();
    }

    function tcvpb_image_delete(e) {
        e.preventDefault();
        var $this = $(this);
        $this.addClass('display_none');
        $this.prev().prev().val('').trigger('change').prev().html('');
    }

    function tcvpb_upload_gallery_button(e) {
        e.preventDefault();
        var $input_field = $(this).prev();
        var ids = $input_field.val();
        ids = ids.replace(/,\s*$/, "");
        var gallerysc = '[gallery ids="' + $input_field.val() + '"]';
        wp.media.gallery.edit(gallerysc).on('update', function(g) {
            var id_array = [];
            $.each(g.models, function(id, img) { id_array.push(img.id); });
            var ids = id_array.join(",");
            ids = ids.replace(/,\s*$/, "");
            $input_field.val(ids).trigger('change');
        });
    }

    function tcvpb_elements_header_toggle(e){
        e.preventDefault();
        var $this = $(this);
        $this.next().slideToggle();
        $this.find('span').toggleClass('dashicons-arrow-up dashicons-arrow-down');
    }

    function tcvpb_fullscreen_button(e){
        e.preventDefault();
        var gravity = ($('#tcvpb_wrapper').hasClass('fullscreen')) ? 's' : 'n';
        $('#tcvpb_tools').find('.tcvpb_tooltip').data('gravity', gravity);
        $tcvpb_wrapper.toggleClass('fullscreen');
        tcvpb_rebuild_widths();
    }

    function tcvpb_undo_redo(e){
        e.preventDefault();
        var $this=$(this);
        if($this.hasClass('disabled')){
            return;
        }
        if($this.hasClass('tcvpb_undo_button')){
            tcvpb_history_current++;
            $tcvpb_redo_button.removeClass('disabled');
        }
        else{
            tcvpb_history_current--;
            $tcvpb_undo_button.removeClass('disabled');
        }
        if(tcvpb_history_current<=0){
            $tcvpb_redo_button.addClass('disabled');
        }
        if(tcvpb_history_current>=tcvpb_history.length-1){
            $tcvpb_undo_button.addClass('disabled');
        }
        tcvpb_generate_tcvpb_from_content(tcvpb_history[tcvpb_history_current]);
        tcvpb_write_from_tcvpb_to_editor(true);
    }

    function prevent_body_scroll(ev) {
        var $this = $(this),
            scrollTop = this.scrollTop,
            scrollHeight = this.scrollHeight,
            height = $this.height(),
            delta = (ev.type == 'DOMMouseScroll' ?
                ev.originalEvent.detail * -40 :
                ev.originalEvent.wheelDelta),
            up = delta > 0;
        var prevent = function() {
            ev.stopPropagation();
            ev.preventDefault();
            ev.returnValue = false;
            return false;
        }
        if (!up && -delta > scrollHeight - height - scrollTop) {
            // Scrolling down, but this will take us past the bottom.
            $this.scrollTop(scrollHeight);
            return prevent();
        } else if (up && delta > scrollTop) {
            // Scrolling up, but this will take us past the top.
            $this.scrollTop(0);
            return prevent();
        }
    }

});    