<?php

/*********** Shortcode: PayPal Donate ************************************************************/

$tcvpb_elements['donate_tc'] = array(
	'name' => esc_html__('Donate PayPal Button', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-paypal',
	'category' =>  esc_html__('E-Commerce', 'ABdev_dzen'),
	'attributes' => array(
		'email' => array(
			'description' => esc_html__('Your Email', 'ABdev_dzen'),
		),
		'lc' => array(
			'default' => 'US',
			'description' => esc_html__('Locale', 'ABdev_dzen'),
		),
		'name' => array(
			'description' => esc_html__('Donation Name', 'ABdev_dzen'),
		),
		'amount' => array(
			'description' => esc_html__('Amount', 'ABdev_dzen'),
		),
		'currency' => array(
			'default' => 'USD',
			'description' => esc_html__('Currency', 'ABdev_dzen'),
		),
		'creditcard' => array(
			'default' => '0',
			'description' => esc_html__('Show Credit Cards', 'ABdev_dzen'),
			'type' => 'checkbox',
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
function tcvpb_donate_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('donate_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	$amount_return=($amount!='')?'<input type="hidden" name="amount" value="'.esc_attr($amount).'">':'';
	$creditcard_return=($creditcard=='1')?'CC':'';

	return '
	<form '.esc_attr($id_out).' '.esc_attr($class_out).' action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_donations">
		<input type="hidden" name="business" value="'.esc_attr($email).'">
		<input type="hidden" name="lc" value="'.esc_attr($lc).'">
		<input type="hidden" name="item_name" value="'.esc_attr($name).'">
		'.$amount_return.'
		<input type="hidden" name="currency_code" value="'.esc_attr($currency).'">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
		<input type="image" src="'.esc_url('https://www.paypalobjects.com/en_US/i/btn/btn_donate'.$creditcard_return.'_LG.gif').'" style="border:0px;" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" style="border:0px;" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	';
}
