<?php

/*********** Shortcode: Current Year ************************************************************/

$tcvpb_elements['current_year_tc'] = array(
	'name' => esc_html__('Current Year', 'ABdev_dzen' ),
	'notice' => esc_html__('This shortcode will generate current year, no matter when post was published', 'ABdev_dzen'),
	'type' => 'inline',
	'icon' => 'pi-customize',
);
function tcvpb_current_year_tc_shortcode(){
	return date('Y');
}

