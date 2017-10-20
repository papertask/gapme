<?php

/*********** Shortcode: Tabs ************************************************************/

$tcvpb_elements['tabs_tc'] = array(
	'name' => esc_html__('Tabs', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-tab',
	'category' =>  esc_html__('Content', 'ABdev_dzen'),
	'child' => 'tab_tc',
	'child_button' => esc_html__('New Tab', 'ABdev_dzen'),
	'child_title' => esc_html__('Tab no.', 'ABdev_dzen'),
	'attributes' => array(
		'tabs_position' => array(
			'default' => 'top',
			'description' => esc_html__('Tabs Position', 'ABdev_dzen'),
			'type' => 'select',
			'values' => array(
				'top' => esc_html__('Top', 'ABdev_dzen'),
				'bottom' => esc_html__('Bottom', 'ABdev_dzen'),
				'left' => esc_html__('Left', 'ABdev_dzen'),
				'right' => esc_html__('Right', 'ABdev_dzen'),
			),
			'tab' => esc_html__('Style', 'ABdev_dzen'),
		),
		'effect' => array(
			'default' => '',
			'description' => esc_html__('Transition Effect', 'ABdev_dzen'),
			'type' => 'select',
			'values' => array(
				'' => esc_html__('None', 'ABdev_dzen'),
				'slide' => esc_html__('Slide', 'ABdev_dzen'),
				'fade' => esc_html__('Fade', 'ABdev_dzen'),
			),
			'tab' => esc_html__('Style', 'ABdev_dzen'),
		),
		'selected' => array(
			'description' => esc_html__('Selected Tab', 'ABdev_dzen'),
			'info' => esc_html__('Initially selected tab, order number', 'ABdev_dzen'),
			'default' => '1',
		),
		'break_point' => array(
			'description' => esc_html__('Break Point', 'ABdev_dzen'),
			'info' => esc_html__('Width in px. Below this width tabs will be stacked on each other.', 'ABdev_dzen'),
			'tab' => esc_html__('Break Point', 'ABdev_dzen'),
		),
		'id' => array(
			'description' => esc_html__('ID', 'ABdev_dzen'),
			'info' => esc_html__('Additional custom ID', 'ABdev_dzen'),
			'tab' => esc_html__('Advanced', 'ABdev_dzen'),
		),
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_dzen'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_dzen'),
			'tab' => esc_html__('Advanced', 'ABdev_dzen'),
		),
	)
);
function tcvpb_tabs_tc_shortcode( $attributes, $content = null ) {
	global $tabs_navigation,$tabs_content,$tabs_counter,$tabs_selected;
	extract(shortcode_atts(tcvpb_extract_attributes('tabs_tc'), $attributes));
	static $i = 0;
    $i++;

    $tabs_counter = $i;

    $tabs_selected = $selected;

	$id_out = ($id!='') ? 'id='.$id.'' : '';

	do_shortcode($content);

	$slide_direction = ( $tabs_position == 'top' || $tabs_position == 'bottom' ) ? 'horizontal' : 'vertical';

	$return = '
		<div '.esc_attr($id_out).' class="tcvpb-tabs tcvpb-tabs-'.esc_attr($slide_direction).' tcvpb-tabs-position-'.esc_attr($tabs_position).' '.esc_attr($class).'" data-selected="'.esc_attr($selected).'" role="tabpane'.$i.'" data-break_point="'.esc_attr($break_point).'" data-effect="'.esc_attr($effect).'">
			<ul class="nav nav-tabs tab-helper-reset tab-helper-clearfix" role="tablist">
				'.$tabs_navigation.'
			</ul>
			<div class="tab-content">
			'.$tabs_content.'
			</div>
		</div>';

	$tabs_navigation = $tabs_content = '';

	return $return;
}


$tcvpb_elements['tab_tc'] = array(
	'name' => esc_html__('Tab', 'ABdev_dzen' ),
	'type' => 'child',
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Tab Title', 'ABdev_dzen'),
		),
		'icon' => array(
			'type' => 'icon',
			'description' => esc_html__('Icon', 'ABdev_dzen'),
		),
	),
	'content' => array(
		'description' => esc_html__('Tab Content', 'ABdev_dzen'),
	)
);
function tcvpb_tab_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('tab_tc'), $attributes));

	static $tab_count = 0;
	static $tabs_counter_static=0;
	global $tabs_navigation,$tabs_content,$tabs_counter,$tabs_selected;

	$active_class = false;
	if($tabs_counter!=$tabs_counter_static){
		$tabs_counter_static = $tabs_counter;
		$tab_count = 0;
	}
    $tab_count++;
	if($tabs_selected==$tab_count){
		$active_class = true;
	}

	$icon_output = ( $icon!='' ) ? '<i class="'.esc_attr($icon).' tab-icon"></i> ' : '';

	$tabs_navigation.='<li role="presentation"'.(($active_class)?' class="active"':'').'><a class="tcvpb-tabs-tab" data-href="#tab-'.$tabs_counter.'-'.$tab_count.'" aria-controls="tab-'.$tabs_counter.'-'.$tab_count.'" role="tab" data-toggle="tab">'.$icon_output . $title . '</a></li>';
	$tabs_content.='
		<div id="tab-'.$tabs_counter.'-'.$tab_count.'" class="tab-pane'.(($active_class)?' active_pane':'').'" role="tabpanel">
			<p>' . do_shortcode($content) . '</p>
		</div>';

	$return = '';
	return $return;
}
