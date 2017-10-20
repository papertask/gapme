<?php

/*********** Shortcode: Date ************************************************************/

$tcvpb_elements['date_tc'] = array(
	'name' => __('Date', 'the-creator-vpb' ),
	'type' => 'inline',
	'attributes' => array(
		'format' => array(
			'default' => 'd.m.Y',
			'description' => __('PHP Date Format', 'the-creator-vpb'),
		),
		'target' => array(
			'description' => __('Target Date', 'the-creator-vpb'),
			'info' => __('PHP strtotime acceptable string, e.g. yesterday, last Monday, 2 days ago...', 'the-creator-vpb'),
		),
	)
);
function tcvpb_date_tc_shortcode($attributes, $content = null){
	extract(shortcode_atts(tcvpb_extract_attributes('date_tc'), $attributes));
	
	if($target=='')
		return date($format);
	else 
		return date($format,strtotime($target));
}
