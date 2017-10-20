<?php

/*********** Shortcode: Sidebar ************************************************************/

$sidebars_array = $GLOBALS['wp_registered_sidebars'];
$sidebars = array();
if(is_array($sidebars_array)){
	foreach ($sidebars_array as $key => $value) {
		$sidebars[$key] = $value['name'];
	}
}

$tcvpb_elements['sidebar_tc'] = array(
	'name' => esc_html__('Sidebar', 'ABdev_dzen' ),
	'notice' => esc_html__('Display sidebar and all its widgets anywhere inside content. You can create unlimited number of sidebars in Creator\'s options.', 'ABdev_dzen'),
	'type' => 'block',
	'icon' => 'pi-sidebar',
	'category' =>  esc_html__('Content', 'ABdev_dzen'),
	'attributes' => array(
		'name' => array(
			'default' => '',
			'type' => 'select',
			'values' => $sidebars,
			'description' => esc_html__('Select Sidebar', 'ABdev_dzen'),
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
function tcvpb_sidebar_tc_shortcode( $attributes ) {
    extract(shortcode_atts(tcvpb_extract_attributes('sidebar_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

    $name = trim($name);
    $content='';

        ob_start();  
        dynamic_sidebar($name);
        $content = ob_get_clean();

    return '<div '.esc_attr($id_out).' '.esc_attr($class_out).' >'.$content.'</div>';
}

