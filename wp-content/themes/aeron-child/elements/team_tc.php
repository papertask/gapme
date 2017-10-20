<?php

/*********** Shortcode: Team ************************************************************/
$tcvpb_elements['team_tc'] = array(
	'name' => esc_html__('Team', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-team',
	'attributes' => array(
		'name' => array(
			'description' => esc_html__('Name', 'ABdev_dzen'),
		),
		'position' => array(
			'description' => esc_html__('Position', 'ABdev_dzen'),
		),
		'image' => array(
			'type' => 'image',
			'description' => esc_html__('Image URL', 'ABdev_dzen'),
			'divider' => 'true',
		),
		'link' => array(
			'description' => esc_html__('Profile URL', 'ABdev_dzen'),
			'info' => esc_html__('Link to about page', 'ABdev_dzen'),
		),
		'modal' => array(
			'type' => 'checkbox',
			'description' => esc_html__('Use Modal Instead Link', 'ABdev_dzen'),
			'info' => esc_html__('Modal window will appear on click instead of following a link. Use content to add modal window content', 'ABdev_dzen'),
		),
		'mail' => array(
			'description' => esc_html__('E-mail address', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'facebook' => array(
			'description' => esc_html__('Facebook URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'twitter' => array(
			'description' => esc_html__('Twitter URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'linkedin' => array(
			'description' => esc_html__('Linkedin URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'googleplus' => array(
			'description' => esc_html__('Google+ URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'youtube' => array(
			'description' => esc_html__('Youtube URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'pinterest' => array(
			'description' => esc_html__('Pinterest URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'github' => array(
			'description' => esc_html__('Github URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'feed' => array(
			'description' => esc_html__('Feed URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'behance' => array(
			'description' => esc_html__('Behance URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'blogger_blog' => array(
			'description' => esc_html__('Blogger URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'delicious' => array(
			'description' => esc_html__('Delicious URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'designcontest' => array(
			'description' => esc_html__('DesignContest URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'deviantart' => array(
			'description' => esc_html__('DeviantART URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'digg' => array(
			'description' => esc_html__('Digg URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'dribbble' => array(
			'description' => esc_html__('Dribbble URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'dropbox' => array(
			'description' => esc_html__('Dropbox URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'flickr' => array(
			'description' => esc_html__('Flickr URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'forrst' => array(
			'description' => esc_html__('Forrst URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'instagram' => array(
			'description' => esc_html__('Instagram URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'lastfm' => array(
			'description' => esc_html__('Last.fm URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'myspace' => array(
			'description' => esc_html__('Myspace URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'picasa' => array(
			'description' => esc_html__('Picasa URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'skype' => array(
			'description' => esc_html__('Skype URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'stumbleupon' => array(
			'description' => esc_html__('StumbleUpon URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'vimeo' => array(
			'description' => esc_html__('Vimeo URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'zerply' => array(
			'description' => esc_html__('Zerply URL', 'ABdev_dzen'),
			'tab' => esc_html__('Social', 'ABdev_dzen'),
		),
		'social_target' => array(
			'description' => esc_html__('Social Link Target', 'ABdev_dzen'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__('Self', 'ABdev_dzen'),
				'_blank' => esc_html__('Blank', 'ABdev_dzen'),
			),
		),
		'social_under' => array(
			'type' => 'checkbox',
			'description' => esc_html__('Social icons under position', 'ABdev_dzen'),
			'info' => esc_html__('If enabled social icons will appear under position instead on image overlay.', 'ABdev_dzen'),
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
		'description' => esc_html__('Content', 'ABdev_dzen'),
	),
	'description' => esc_html__('Team Member', 'ABdev_dzen' )
);
function tcvpb_team_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('team_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$return = '
		<div '.esc_attr($id_out).' class="tcvpb_team_member '.esc_attr($class).'">';

	$social_links = '';
	if($twitter!='') $social_links .= '<a href="'.$twitter.'" target="'.$social_target.'"><i class="ci_icon-twitter"></i></a>';
	if($linkedin!='') $social_links .= '<a href="'.$linkedin.'" target="'.$social_target.'"><i class="ci_icon-linkedin"></i></a>';
	if($mail!='') $social_links .= '<a href="mailto:'.$mail.'"><i class="ci_icon-emailalt"></i></a>';
	if($facebook!='') $social_links .= '<a href="'.$facebook.'" target="'.$social_target.'"><i class="ci_icon-facebook"></i></a>';
	if($googleplus!='') $social_links.='<a href="'.$googleplus.'" target="'.$social_target.'"><i class="ci_icon-googleplus"></i></a>';
	if($youtube!='') $social_links.='<a href="'.$youtube.'" target="'.$social_target.'"><i class="ci_icon-youtube"></i></a>';
	if($pinterest!='') $social_links.='<a href="'.$pinterest.'" target="'.$social_target.'"><i class="ci_icon-pinterest"></i></a>';
	if($github!='') $social_links.='<a href="'.$github.'" target="'.$social_target.'"><i class="ci_icon-github"></i></a>';
	if($feed!='') $social_links.='<a href="'.$feed.'" target="'.$social_target.'"><i class="ci_icon-rss"></i></a>';
	if($behance!='') $social_links.='<a href="'.$behance.'" target="'.$social_target.'"><i class="ci_icon-behance"></i></a>';
	if($blogger_blog!='') $social_links.='<a href="'.$blogger_blog.'" target="'.$social_target.'"><i class="ci_icon-blogger-blog"></i></a>';
	if($delicious!='') $social_links.='<a href="'.$delicious.'" target="'.$social_target.'"><i class="ci_icon-delicious"></i></a>';
	if($designcontest!='') $social_links.='<a href="'.$designcontest.'" target="'.$social_target.'"><i class="ci_icon-designcontest"></i></a>';
	if($deviantart!='') $social_links.='<a href="'.$deviantart.'" target="'.$social_target.'"><i class="ci_icon-deviantart"></i></a>';
	if($digg!='') $social_links.='<a href="'.$digg.'" target="'.$social_target.'"><i class="ci_icon-digg"></i></a>';
	if($dribbble!='') $social_links.='<a href="'.$dribbble.'" target="'.$social_target.'"><i class="ci_icon-dribbble"></i></a>';
	if($dropbox!='') $social_links.='<a href="'.$dropbox.'" target="'.$social_target.'"><i class="ci_icon-dropbox"></i></a>';
	if($flickr!='') $social_links.='<a href="'.$flickr.'" target="'.$social_target.'"><i class="ci_icon-flickr"></i></a>';
	if($forrst!='') $social_links.='<a href="'.$forrst.'" target="'.$social_target.'"><i class="ci_icon-forrst"></i></a>';
	if($instagram!='') $social_links.='<a href="'.$instagram.'" target="'.$social_target.'"><i class="ci_icon-instagram"></i></a>';
	if($lastfm!='') $social_links.='<a href="'.$lastfm.'" target="'.$social_target.'"><i class="ci_icon-lastfm"></i></a>';
	if($myspace!='') $social_links.='<a href="'.$myspace.'" target="'.$social_target.'"><i class="ci_icon-myspace"></i></a>';
	if($picasa!='') $social_links.='<a href="'.$picasa.'" target="'.$social_target.'"><i class="ci_icon-picasa"></i></a>';
	if($skype!='') $social_links.='<a href="'.$skype.'" target="'.$social_target.'"><i class="ci_icon-skype"></i></a>';
	if($stumbleupon!='') $social_links.='<a href="'.$stumbleupon.'" target="'.$social_target.'"><i class="ci_icon-stumbleupon"></i></a>';
	if($vimeo!='') $social_links.='<a href="'.$vimeo.'" target="'.$social_target.'"><i class="ci_icon-vimeo"></i></a>';
	if($zerply!='') $social_links.='<a href="'.$zerply.'" target="'.$social_target.'"><i class="ci_icon-zerply"></i></a>';


		if(($social_links!='' && $social_under!=1) || $link!=''){
			$return .= '<div class="tcvpb_overlayed">
				<img src="'.$image.'" alt="'.$name.'">
				<div class="tcvpb_overlay">
					<p>';
						if($social_under==1 || $social_links==''){
							if ($modal==1){
								$return .='<a class="tcvpb_team_member_link tcvpb_team_member_modal_link" href="'.$link.'"><i class="ci_icon-zoom-in"></i></a>';
							}else{
								$return .='<a href="'.$link.'"><i class="ci_icon-linkalt"></i></a>';
							}
						}
						else{
							$return .= $social_links;
						}
					$return .= '</p>
				</div>
			</div>';
		}
		else{
			$return.= '<img src="'.$image.'" alt="'.$name.'">';
		}
		$return .= '<a class="tcvpb_team_member_link'.(($modal==1)?' tcvpb_team_member_modal_link':'').'" href="'.$link.'">
			<span class="tcvpb_team_member_name">'.$name.'</span>
			<span class="tcvpb_team_member_position">'.$position.'</span>
		</a>';

		if($modal == 1){
			$return .= '
				<div class="tcvpb_team_member_modal">
					<h4 class="tcvpb_team_member_name">'.$name.'</h4>
					<p class="tcvpb_team_member_position">'.$position.'</p>
					<div class="tcvpb_container">
						<div class="tcvpb_column_tc_span6">
							<img src="'.$image.'" alt="'.$name.'">
						</div>
						<div class="tcvpb_column_tc_span6">
							'.do_shortcode($content).'
						</div>
					</div>
					<div class="tcvpb_team_member_modal_close">X</div>
				</div>';
		}
		else{
			$return .= '
				<p>'.$content.'</p>
			';
		}

		if($social_under==1){
			$return .= '<div class="tcvpb_team_member_social_under">'.$social_links.'</div>';
		}

		$return .= '</div>';

	return $return;
}



