<?php

/*********** Shortcode: Price Box ************************************************************/

$tcvpb_elements['pricing_box_tc'] = array(
	'name' => esc_html__('Pricing box', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-pricing-box',
	'category' =>  esc_html__('Content', 'ABdev_dzen'),
	'child' => 'pricing_feature_tc',
	'child_title' => esc_html__('Pricing Feature', 'ABdev_dzen'),
	'child_button' => esc_html__('Add Pricing Feature', 'ABdev_dzen'),
	'attributes' => array(
		'name' => array(
			'description' => esc_html__('Name', 'tcvpb-shortcodes'),
			'divider' => 'true',
		),
		'price' => array(
			'description' => esc_html__('Price', 'tcvpb-shortcodes'),
		),
		'currency' => array(
			'description' => esc_html__('Currency Sign', 'tcvpb-shortcodes'),
		),
		'monthly' => array(
			'description' => esc_html__('Monthly Text', 'tcvpb-shortcodes'),
			'divider' => 'true',
		),
		'description' => array(
			'description' => esc_html__('Description', 'tcvpb-shortcodes'),
		),
		'style' => array(
			'default' => '1',
			'type' => 'select',
			'values' => array(
				'1' => esc_html__('Style 1', 'tcvpb-shortcodes'),
				'2' => esc_html__('Style 2', 'tcvpb-shortcodes'),
			),
			'description' => esc_html__('Style', 'tcvpb-shortcodes'),
			'tab' => esc_html__('Style', 'ABdev_dzen'),
		),
		'featured' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Is Featured?', 'tcvpb-shortcodes'),
			'tab' => esc_html__('Featured', 'ABdev_dzen'),
		),
		'featured_text' => array(
			'description' => esc_html__('Featured Info', 'tcvpb-shortcodes'),
			'tab' => esc_html__('Featured', 'ABdev_dzen'),
		),
		'button_text' => array(
			'description' => esc_html__( 'Button Text', 'tcvpb-shortcodes' ),
			'tab' => esc_html__('Button', 'ABdev_dzen'),
		),
		'button_size' => array(
			'description' => esc_html__( 'Size', 'tcvpb-shortcodes' ),
			'default' => 'medium',
			'type' => 'select',
			'values' => array(
				'small' =>  esc_html__( 'Small', 'tcvpb-shortcodes' ),
				'medium' => esc_html__( 'Medium', 'tcvpb-shortcodes' ),
				'large' => esc_html__( 'Large', 'tcvpb-shortcodes' ),
				'xlarge' => esc_html__( 'Extra Large', 'tcvpb-shortcodes' ),
			),
			'tab' => esc_html__('Button', 'ABdev_dzen'),
		),
		'button_color' => array(
			'description' => __( 'Color', 'tcvpb-shortcodes' ),
			'default' => 'light',
			'type' => 'select',
			'values' => array(
				'light' =>  __( 'Light', 'tcvpb-shortcodes' ),
				'dark' =>  __( 'Dark', 'tcvpb-shortcodes' ),
				'yellow' =>  __( 'Yellow', 'tcvpb-shortcodes' ),
				'green' =>  __( 'Green', 'tcvpb-shortcodes' ),
				'red' =>  __( 'Red', 'tcvpb-shortcodes' ),
				'blue' =>  __( 'Blue', 'tcvpb-shortcodes' ),
				'gray' =>  __( 'Gray', 'tcvpb-shortcodes' ),
				'cyan' =>  __( 'Cyan', 'tcvpb-shortcodes' ),
				'aquamarine' =>  __( 'Aquamarine', 'tcvpb-shortcodes' ),
			),
			'tab' => esc_html__('Button', 'ABdev_dzen'),
		),
		'button_style' => array(
			'description' => esc_html__( 'Style', 'tcvpb-shortcodes' ),
			'default' => 'normal',
			'type' => 'select',
			'values' => array(
				'normal' =>  esc_html__( 'Normal', 'tcvpb-shortcodes' ),
				'rounded' =>  esc_html__( 'Rounded', 'tcvpb-shortcodes' ),
			),
			'tab' => esc_html__('Button', 'ABdev_dzen'),
		),
		'button_url' => array(
			'description' => esc_html__( 'URL', 'tcvpb-shortcodes' ),
			'tab' => esc_html__('Button', 'ABdev_dzen'),
		),
		'button_target' => array(
			'description' => esc_html__( 'Target', 'tcvpb-shortcodes' ),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__( 'Self', 'tcvpb-shortcodes' ),
				'_blank' => esc_html__( 'Blank', 'tcvpb-shortcodes' ),
			),
			'tab' => esc_html__('Button', 'ABdev_dzen'),
		),
		'button_icon' => array(
			'description' => esc_html__('Button Icon', 'tcvpb-shortcodes'),
			'info' => esc_html__('Optional icon after button text', 'tcvpb-shortcodes'),
			'type' => 'icon',
			'tab' => esc_html__('Button', 'ABdev_dzen'),
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
);
function tcvpb_pricing_box_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('pricing_box_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$featured_output=($featured=='1')?' tcvpb_popular-plan':'';
	$description_output=($description!='')?'<span class="tcvpb_pricebox_description">'.wp_kses($description, ABdev_allowed_tags()).'</span>':'';
	$featured_text_output=($featured_text!='')?'<div class="tcvpb_pricebox_featured_text">'.wp_kses($featured_text, ABdev_allowed_tags()).'</div>':'';

	$button_out='';
	if($button_text != ''){
		$class_out = 'tcvpb-button';
		$class_out .= ' tcvpb-button_'.$button_color;
		$class_out .= ' tcvpb-button_'.$button_style;
		$class_out .= ' tcvpb-button_'.$button_size;
		$button_color = ($button_color!='') ? 'color: '.$button_color.';' : '';
		$icon_out = ($button_icon!='') ? '<i class="'.esc_attr($button_icon).'"></i>' : '';
		$button_out = '<div class="tcvpb_pricebox_feature tcvpb_pricebox_feature_button"><a href="'. esc_url($button_url) .'" target="' . esc_attr($button_target) . '" class="'.esc_attr($class_out).'" >' . $button_text . $icon_out . '</a></div>';
	}

	static $count_priceboxes;
	$count_priceboxes++;
	return '
	<div '.esc_attr($id_out).' class="tcvpb_pricing-table-'.esc_attr($style).' '.esc_attr($class).'">
		<div class="tcvpb_plan tcvpb_plan'.esc_attr($count_priceboxes.$featured_output).'">
			'.$featured_text_output.'
			<div class="tcvpb_pricebox_header">
				<span class="tcvpb_pricebox_name">'.esc_attr($name).'</span>
				<span class="tcvpb_pricebox_currency">'.esc_attr($currency).'</span>
				<span class="tcvpb_pricebox_price">'.esc_attr($price).'</span>
				<span class="tcvpb_pricebox_monthly">'.esc_attr($monthly).'</span>
				'.$description_output.'
			</div>
			'.do_shortcode($content).'
			'.$button_out.'
		</div>
	</div>';
}

$tcvpb_elements['pricing_feature_tc'] = array(
	'name' => esc_html__('Pricing feature', 'ABdev_dzen' ),
	'type' => 'child',
	'attributes' => array(
		'name' => array(
			'description' => esc_html__('Feature Name', 'tcvpb-shortcodes'),
		),
		'value' => array(
			'description' => esc_html__('Value', 'tcvpb-shortcodes'),
		),
		'yes' => array(
			'type' => 'icon',
			'description' => esc_html__('Avaliable Icon', 'tcvpb-shortcodes'),
		),
		'no' => array(
			'type' => 'icon',
			'description' => esc_html__('Not Avaliable Icon', 'tcvpb-shortcodes'),
		),
	),
);
function tcvpb_pricing_feature_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('pricing_feature_tc'), $attributes));
	$yes_output = ($yes!='')?'<i class="'.esc_attr($yes).'"></i>':'';
	$no_output = ($no!='')?'<i class="'.esc_attr($no).'"></i>':'';
	return '<span class="tcvpb_pricebox_feature">'.$yes_output.$no_output.'<strong>'.esc_attr($value).'</strong> '.esc_attr($name).'</span>';
}