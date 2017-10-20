<?php

/*********** Shortcode: Progress Bar Vertical ************************************************************/

$tcvpb_elements['progress_bar_vertical_tc'] = array(
	'name' => esc_html__('Progress Bar Vertical', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-progress-bar-vertical',
	'category' => esc_html__('Charts', 'the-creator-vpb' ),
	'attributes' => array(
		'complete' => array(
			'default' => '60',
			'description' => esc_html__('Percentage', 'the-creator-vpb'),
		),
		'text' => array(
			'description' => esc_html__('Text', 'the-creator-vpb'),
		),
		'choose_height' => array(
			'default' => '150',
			'description' => esc_html__('Height of Progress Bar in Pixels', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'background_color' => array(
			'description' => esc_html__('Background Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
		),
		'text_color' => array(
			'description' => esc_html__('Text Color', 'the-creator-vpb'),
			'type' => 'color',
		),
		'bar_color_start' => array(
			'description' => esc_html__('Bar Color Start', 'the-creator-vpb'),
			'type' => 'color',
		),
		'bar_color_end' => array(
			'description' => esc_html__('Bar Color End', 'the-creator-vpb'),
			'type' => 'color',
		),
		'id' => array(
			'description' => esc_html__('ID', 'the-creator-vpb'),
			'info' => esc_html__('Additional custom ID', 'the-creator-vpb'),
			'tab' => esc_html__('Advanced', 'the-creator-vpb'),
		),	
		'class' => array(
			'description' => esc_html__('Class', 'the-creator-vpb'),
			'info' => esc_html__('Additional custom classes for custom styling', 'the-creator-vpb'),
			'tab' => esc_html__('Advanced', 'the-creator-vpb'),
		),
	),
);
function tcvpb_progress_bar_vertical_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('progress_bar_vertical_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$bar_color_output = ($bar_color_start!='') ? 'background:linear-gradient(to top,' .$bar_color_start.',' .$bar_color_end.');' : 'background:' .$bar_color_start.'; ';
	$text_color_output = ($text_color!='') ? 'color: '.$text_color.';' : '';
	$background_color_output = ($background_color!='') ? 'background: '.$background_color.';' : '';
	$choose_height_output = ($choose_height!='') ? 'height: '.$choose_height.'px;' : '';

	if($bar_color_start!='' && $bar_color_end!=''){
		$bar_color_output= 'background:linear-gradient(to top,' .$bar_color_start.',' .$bar_color_end.');';
	}
	else if($bar_color_start!='' || $bar_color_end!=''){
		$bar_color_output= 'background:' .(($bar_color_start!='') ? $bar_color_start : $bar_color_end).'; ';
	}

	return '
		<div '.esc_attr($id_out).' class="tcvpb_progress_bar_vertical '.esc_attr($class).'">
			<div class="tcvpb_meter_vertical" style="'.$choose_height_output.' '.esc_attr($background_color_output).'">
				<div class="tcvpb_meter_percentage_vertical" data-percentage="'.esc_attr($complete).'" style=" height: '.esc_attr($complete).'%;'.esc_attr($bar_color_output).';"><span style="'.esc_attr($text_color_output).'">'.esc_attr($complete).'%</span></div>
			</div>
			<span class="tcvpb_meter_label" style="'.esc_attr($text_color_output).'">'.esc_html($text).'</span>
		</div>';
}

