<?php

/*********** Shortcode: Email Link ************************************************************/

$tcvpb_elements['email_tc'] = array(
	'name' => esc_html__('Email Link', 'ABdev_dzen'),
	'description' => esc_html__('This shortcode will hide email address form spam bots using JavaScript method', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => ' pi-email-link',
	'category' =>  esc_html__('Social', 'ABdev_dzen'),
	'attributes' => array(
		'email' => array(
			'description' => esc_html__('Email Address', 'ABdev_dzen'),
		),
		'cloak' => array(
			'default' => '1',
			'type' => 'checkbox',
			'description' => esc_html__('Cloak Email from Spam Bots', 'ABdev_dzen'),
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'ABdev_dzen'),
			'type' => 'icon',
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
function tcvpb_email_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('email_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	$icon_output = ($icon!='') ? '<i class="'.esc_attr($icon).'"></i> ':'';

	if ($cloak!='1'){
		return '<a href="'.esc_url('mailto:'.$email).'" '.esc_attr($id_out).' '.esc_attr($class_out).' >'.$icon_output.''.$email.'</a>';
	}
	else{
		$email=explode('@',esc_attr($email));
		return $icon_output.'<script>
			document.write (\'<A HREF="mai\')
			document.write (\'lto:'.$email[0].'\')
			document.write (\'&#64;\')
			document.write (\''.$email[1].'">'.$email[0].'\')
			document.write (\'&#64;\')
			document.write (\''.$email[1].'</A>\')
		</script>';
	}
}


