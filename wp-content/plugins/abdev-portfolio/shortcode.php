<?php
// Usage: [portfolio category="" count=""]
function ABp_portfolio_shortcode($atts, $content){
	extract(shortcode_atts(array( 
		'category' 		=> '',
		'count' 		=> '8',
		'nav_link' 		=> '',
	), $atts));


	$cat = ($category!='') ? '&portfolio-category='.$category : '';

	$query='post_type=portfolio&posts_per_page='.$count.$cat;

	$post = new WP_Query( $query );
	$out = $error = '';
	if ($post->have_posts()){
		while ($post->have_posts()){
			$post->the_post();
			$slugs=$in_category='';		
			$terms = get_the_terms( get_the_ID() , 'portfolio-category' );
			foreach ( $terms as $term ) {
				if(is_object($term)){
					$slugs.=' '.$term->slug;
					$filter_slugs[$term->slug] = $term->name;
					$in_category = $term->name;
				}
			}

			$thumbnail_id = get_post_thumbnail_id(get_the_ID());
			$thumbnail_object = get_post($thumbnail_id);
			$thumbnail_src=$thumbnail_object->guid;

			$out.= '<li class="portfolio_item overlayed_animated_highlight portfolio_item_4' . $slugs . '">
				<div class="overlayed">
					' . get_the_post_thumbnail() . '
					<div class="overlay">
						<p>
							<a href="'.get_permalink().'"><i class="ci_icon-share"></i></a>
							<a href="'.$thumbnail_src.'" class="fancybox" data-fancybox-group="portfolio"><i class="ci_icon-search"></i></a>
						</p>
					</div>
				</div>
				<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>
				<span>' . get_the_date() . ' // ' . $in_category . '</span>
			</li>';
		}
	}
	wp_reset_postdata();
	return '<ul id="ABp_latest_portfolio" class="clearfix">' . $out . '</ul><div class="portfolio_navigation"><a href="#" id="portfolio_prev"><i class="ci_icon-chevron-left"></i></a><a href="' . $nav_link . '"><i class="ci_icon-paragraph-justify2"></i></a><a href="#" id="portfolio_next"><i class="ci_icon-chevron-right"></i></a></div>';

}
add_shortcode( 'portfolio', 'ABp_portfolio_shortcode');
add_shortcode( 'ABs_portfolio', 'ABp_portfolio_shortcode');


function ABp_scripts() {
	wp_enqueue_script( 'carouFredSel', plugins_url().'/abdev-portfolio/js/jquery.carouFredSel-6.2.1.js', array('jquery'));
	wp_enqueue_script( 'carouFredSel_ABp_init', plugins_url().'/abdev-portfolio/js/init.js', array('carouFredSel'));
	
	wp_enqueue_style('ABp_portfolio_shortcode', plugins_url().'/abdev-portfolio/css/portfolio_shortcode.css');
}
add_action( 'wp_enqueue_scripts', 'ABp_scripts' );

