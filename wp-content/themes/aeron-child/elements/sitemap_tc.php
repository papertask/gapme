<?php

/*********** Shortcode: Sitemap ************************************************************/

$tcvpb_elements['sitemap_tc'] = array(
	'name' => esc_html__('Sitemap', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-sitemap',
	'category' =>  esc_html__('Navigation', 'ABdev_dzen'),
	'attributes' => array(
		'hide_pages' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Hide Pages', 'ABdev_dzen'),
		),
		'hide_categories' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Hide Categories', 'ABdev_dzen'),
		),
		'hide_authors' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Hide Authors', 'ABdev_dzen'),
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
function tcvpb_sitemap_tc_shortcode($attributes){
	extract(shortcode_atts(tcvpb_extract_attributes('sitemap_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$return = '';
	$return .= ($hide_pages != 1) ? '<h4>'.esc_html__('Pages', 'ABdev_dzen').'</h4><ul '.esc_attr($id_out).' class="tcvpb_sitemap '.esc_attr($class).'">'.wp_list_pages('title_li=&echo=0').'</ul>' : '';
	$return .= ($hide_categories != 1) ? '<h4>'.esc_html__('Categories', 'ABdev_dzen').'</h4><ul '.esc_attr($id_out).' class="tcvpb_sitemap '.esc_attr($class).'">'.wp_list_categories('title_li=&echo=0').'</ul>' : '';
	$return .= ($hide_authors != 1) ? '<h4>'.esc_html__('Authors', 'ABdev_dzen').'</h4><ul '.esc_attr($id_out).' class="tcvpb_sitemap '.esc_attr($class).'">'.wp_list_authors('echo=0&hide_empty=0').'</ul>' : '';
	return $return;
}

