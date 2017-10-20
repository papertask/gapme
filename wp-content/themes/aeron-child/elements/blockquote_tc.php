<?php

/*********** Shortcode: Blockquote ************************************************************/

$tcvpb_elements['blockquote_tc'] = array(
	'name' => esc_html__('Blockquote Block', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-blockquote',
	'category' => esc_html__('Content', 'ABdev_dzen' ),
	'attributes' => array(
		'author' => array(
			'description' => esc_html__('Author', 'ABdev_dzen'),
		),
		'url_author' => array(
			'description' => esc_html__('Author URL', 'ABdev_dzen'),
		),
		'delimiter' => array(
			'description' => esc_html__('Delimiter between author and source', 'ABdev_dzen'),
			'default' => ' ',
		),
		'source' => array(
			'description' => esc_html__('Source', 'ABdev_dzen'),
		),
		'url_source' => array(
			'description' => esc_html__('Source URL', 'ABdev_dzen'),
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
		'description' => esc_html__('Blockquote', 'ABdev_dzen'),
	),
);
function tcvpb_blockquote_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('blockquote_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$quote ='';
	if($source!='' && $url_source!='')
		$source='<cite title="'.esc_attr($source).'"><a href="'.esc_url($url_source).'">'.$source.'</a></cite>';
	if($source!='' && $url_source=='')
		$source='<cite title="'.esc_attr($source).'">'.$source.'</cite>';
	if($author!='' && $url_author!='')
		$content.='<small><a href="'.esc_url($url_author).'">'.$author.'</a> '.$delimiter.$source.'</small>';
	if($author!='' && $url_author=='')
		$content.='<small>'.$author.$delimiter.$source.'</small>';
	return '<blockquote '.esc_attr($id_out).' class="tcvpb_blockquote '.esc_attr($class).'">
		'.$quote.'
		<p>'.do_shortcode($content).'</p>
	</blockquote>';
}