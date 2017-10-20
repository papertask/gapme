<?php 

/**
	Real3D Flipbook support
**/
if( in_array('real3d-flipbook/real3d-flipbook.php', get_option('active_plugins')) ){ //first check if plugin is installed

	$flipbooks = get_option("flipbooks");

	$books = array();
	if(is_array($flipbooks)){
		foreach ($flipbooks as $flipbook) {
			$books[ $flipbook['id'] ] = $flipbook['name'];
		}
	}

	$tcvpb_elements['real3dflipbook'] = array(
		'name' => esc_html__('Real3D Flipbook', 'ABdev_dzen' ),
		'description' => esc_html__('Real3D Flipbook', 'ABdev_dzen'),
		'type' => 'block',
		'icon' => 'pi-flipbook',
		'category' =>  esc_html__('Media', 'ABdev_dzen'),
		'third_party' => 1, 
		'attributes' => array(
			'id' => array(
				'description' => esc_html__('Select Flipbook', 'ABdev_dzen'),
				'default' => '',
				'type' => 'select',
				'values' => $books,

			),
		),
	);
}

