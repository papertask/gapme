<?php

/*********** Shortcode: RSS feed ************************************************************/

$tcvpb_elements['rss_tc'] = array(
	'name' => esc_html__('RSS', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-rss',
	'category' =>  esc_html__('Social', 'ABdev_dzen'),
	'attributes' => array(
		'feed' => array(
			'description' => esc_html__('Feed URL', 'ABdev_dzen'),
		),
		'num' => array(
			'default' => '5',
			'description' => esc_html__('Number of Posts', 'ABdev_dzen'),
		),
		'target' => array(
			'description' => esc_html__('Target', 'ABdev_dzen'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__('Self', 'ABdev_dzen'),
				'_blank' => esc_html__('Blank', 'ABdev_dzen'),
			),
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
include_once(ABSPATH.WPINC.'/feed.php');
function tcvpb_rss_tc_shortcode($attributes) {
    extract(shortcode_atts(tcvpb_extract_attributes('rss_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$maxitems = $rss_items = '';
	$rss = fetch_feed($feed);
	if (!is_wp_error( $rss ) ) {
		$maxitems = $rss->get_item_quantity($num);
		$rss_items = $rss->get_items(0, $maxitems);
	}

	if($target!='')
		$target_output=' target="'.esc_attr($target).'"';

	$return='<ul '.esc_attr($id_out).' class="tcvpb_rss '.esc_attr($class).'">';
	if ($maxitems == 0){
		$return .= '<li>'.esc_html__('No RSS items loaded','ABdev_dzen').'</li>';
	}
	else{
		foreach ( $rss_items as $item )
			$return.='<li><a href="'. esc_url( $item->get_permalink() ).'" title="'.esc_attr__('Posted','ABdev_dzen').' '.$item->get_date('j F Y | g:i a').'"'.$target_output.'>'.esc_html( $item->get_title() ).'</a></li>';
	}
	$return.='</ul>';

	return $return;
}

