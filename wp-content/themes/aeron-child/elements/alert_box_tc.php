<?php

/*********** Shortcode: Alert Box ************************************************************/

$tcvpb_elements['alert_box_tc'] = array(
	'name' => esc_html__('Alert Box', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-alert-box',
	'category' => esc_html__('Content', 'ABdev_dzen' ),
	'attributes' => array(
		'style' => array(
			'default' => 'info',
			'type' => 'select',
			'values' => array( 
				'info' => 'Info',
				'warning' => 'Warning',
				'error' => 'Error',
				'success' => 'Success',
			),
			'description' => esc_html__('Style', 'ABdev_dzen'),
		),
		'icon_out' => array(
			'description' => esc_html__('Name of the Icon', 'ABdev_dzen'),
			'type' => 'icon',
		),
		'icon_color' => array(
			'description' => esc_html__('Icon Color', 'ABdev_dzen'),
			'type' => 'color',
		),
		'no_close' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('No Close Button', 'ABdev_dzen'),
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
	),
	'content' => array(
		'description' => esc_html__('Message', 'ABdev_dzen'),
	),
);
function tcvpb_alert_box_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('alert_box_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$allowed_styles = array('warning','error','info','success');
	$style = (in_array($style, $allowed_styles)) ? $style : 'info';
	$style_out = 'tcvpb_alert_' . $style;

	$icon_out = ($icon_out != '1' && $icon_color != '') ? '<i class="'.esc_attr($icon_out).'" style="color:'.esc_attr($icon_color).';"></i> ' : '';
	$close_button = ( $no_close != 1 ) ? '<a class="tcvpb_alert_box_close" title="' . esc_attr__('Close', 'ABdev_dzen' ) . '">&#10005;</a>' : '';
	return  '<div '.esc_attr($id_out).' class="'.esc_attr($style_out).' '.esc_attr($class).'">
		' . $icon_out . $content . $close_button . '
	</div>';
}