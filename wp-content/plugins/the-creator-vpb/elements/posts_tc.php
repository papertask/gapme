<?php

/*********** Shortcode: Latest Post ************************************************************/

$tcvpb_elements['posts_tc'] = array(
	'name' => esc_html__('Posts', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-posts',
	'category' =>  esc_html__('Social', 'the-creator-vpb'),
	'attributes' => array(
		'category' => array(
			'description' => esc_html__( 'Category', 'the-creator-vpb' ),
		),
		'ids' => array(
			'description' => esc_html__( 'Posts IDs', 'the-creator-vpb' ),
			'divider' => 'true',
		),
		'style' => array(
			'default' => '1',
			'type' => 'select',
			'values' => array(
				'1' => __('Style 1', 'the-creator-vpb'),
				'2' => __('Style 2', 'the-creator-vpb'),
			),
			'description' => __('Style', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'order' => array(
			'default' => 'DESC',
			'type' => 'select',
			'description' => esc_html__( 'Order', 'the-creator-vpb' ),
			'values' => array(
				'ASC' =>  esc_html__( 'ASC', 'the-creator-vpb' ),
				'DESC' =>  esc_html__( 'DESC', 'the-creator-vpb' ),
			),  
			'tab' => esc_html__('Order By', 'the-creator-vpb'),    
		),
		'orderby' => array(
			'default' => 'date',
			'type' => 'select',
			'description' => esc_html__( 'Order by', 'the-creator-vpb' ),
			'values' => array(
				'ID' =>  esc_html__( 'ID', 'the-creator-vpb' ),
				'none' =>  esc_html__( 'none', 'the-creator-vpb' ),
				'author' =>  esc_html__( 'author', 'the-creator-vpb' ),
				'title' =>  esc_html__( 'title', 'the-creator-vpb' ),
				'name' =>  esc_html__( 'name', 'the-creator-vpb' ),
				'date' =>  esc_html__( 'date', 'the-creator-vpb' ),
				'modified' =>  esc_html__( 'modified', 'the-creator-vpb' ),
				'parent' =>  esc_html__( 'parent', 'the-creator-vpb' ),
				'rand' =>  esc_html__( 'rand', 'the-creator-vpb' ),
				'menu_order' =>  esc_html__( 'menu_order', 'the-creator-vpb' ),
				'post__in' =>  esc_html__( 'post__in', 'the-creator-vpb' ),
			),
			'tab' => esc_html__('Order By', 'the-creator-vpb'),  
		),
		'post_parent' => array(
			'description' => esc_html__( 'Post Parent', 'the-creator-vpb' ),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'post_type' => array(
			'default' => 'post',
			'description' => esc_html__( 'Post Type', 'the-creator-vpb' ),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'posts_no' => array(
			'default' => '4',
			'description' => esc_html__( 'Number of Posts', 'the-creator-vpb' ),
		),
		'offset' => array(
			'default' => '0',
			'description' => esc_html__( 'Offset', 'the-creator-vpb' ),
		),
		'tag' => array(
			'description' => esc_html__( 'Tag', 'the-creator-vpb' ),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'tax_operator' => array(
			'default' => 'IN',
			'description' => esc_html__( 'Tax Operator', 'the-creator-vpb' ),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'tax_term' => array(
			'description' => esc_html__( 'Tax Term', 'the-creator-vpb' ),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'taxonomy' => array(
			'description' => esc_html__( 'Taxonomy', 'the-creator-vpb' ),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'lightbox' => array(
			'description' => __( 'Lightbox on Images', 'the-creator-vpb' ),
			'type' => 'checkbox',
			'default' => 0,
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'excerpt' => array(
			'description' => esc_html__( 'Custom Excerpt Limit Words', 'the-creator-vpb' ),
			'info' => esc_html__( 'How many words you want to display? If left empty default WordPress excerpt will be used.', 'the-creator-vpb' ),
		),
		'id' => array(
			'description' => esc_html__('ID', 'the-creator-vpb'),
			'info' => esc_html__('Additional custom ID', 'the-creator-vpb'),
			'tab' => esc_html__('Advanced', 'the-creator-vpb'),
		),	
		'class' => array(
			'description' => esc_html__('Class', 'the-creator-vpb'),
			'info' => esc_html__('Additional custom classes for custom styling', 'the-creator-vpb'),
			'tab' => esc_html__('Advanced', 'the-creator-vpb'),
		),
	),
	'description' => esc_html__( 'Posts Excerpts', 'the-creator-vpb' )
);

if ( ! function_exists( 'tcvpb_posts_tc_shortcode' ) ){
	function tcvpb_posts_tc_shortcode( $attributes ) {
		extract(shortcode_atts(tcvpb_extract_attributes('posts_tc'), $attributes));
		$id_out = ($id!='') ? 'id='.$id.'' : '';

		$args = array(
			'category_name'  => $category,
			'order'          => $order,
			'orderby'        => $orderby,
			'post_type'      => explode( ',', $post_type ),
			'posts_per_page' => $posts_no,
			'offset'         => $offset,
			'tag'            => $tag,
		);
		if( $ids ) {
			$posts_in = array_map( 'intval', explode( ',', $ids ) );
			$args['post__in'] = $posts_in;
		}
		if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {
			$tax_term = explode( ', ', $tax_term );
			if( !in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ){
				$tax_operator = 'IN';
			}
			$tax_args = array(
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $tax_term,
						'operator' => $tax_operator
					)
				)
			);
			$args = array_merge( $args, $tax_args );
		}
		if( $post_parent ) {
			if( 'current' == $post_parent ) {
				global $post;
				$post_parent = $post->ID;
			}
			$args['post_parent'] = $post_parent;
		}
		$listing = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $attributes ) );
		if ( ! $listing->have_posts() ){
			return apply_filters( 'display_posts_shortcode_no_results', false );
		}
		$output = '';
		while ( $listing->have_posts() ): $listing->the_post(); 
			global $post;

			$thumbnail = get_the_post_thumbnail($post->ID,'thumbnail');
			$hasthumb_class = ($thumbnail!='') ? ' has_thumbnail' : ' without_thumbnail';

			$output .= '<div class="wx-test-class"></div>'; 
			$output .= '<div '.esc_attr($id_out).' class="tcvpb_posts_shortcode tcvpb_posts_shortcode-'.esc_attr($style).' clearfix'.esc_attr($hasthumb_class).' '.esc_attr($class).'">';
			$output .= ($thumbnail!='') ? ( ($lightbox == 1) ? '<a data-lightbox="post-images" href="'.esc_url($url).'">' . get_the_post_thumbnail($post->ID,'full') . '</a>' : '<a class="tcvpb_latest_news_shortcode_thumb" href="' . esc_url(get_permalink()) . '">' . get_the_post_thumbnail($post->ID,'full') . '</a>' ) : '';
			$output .= '<div class="tcvpb_latest_news_shortcode_content">';
			$output .= '<h5><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h5>';
			$date = get_the_date();
			$output .= '<p class="tcvpb_latest_news_time"><span class="month">'.get_the_date('M').'</span> <span class="day">'.get_the_date('d').'</span><span class="year">, '.get_the_date('Y').'</span></p>';
			if($excerpt > 0){
				$text = do_shortcode(get_the_content());
				$text = apply_filters('the_content', $text);
				$text = str_replace(']]>', ']]&gt;', $text);
				$text = strip_tags($text);
				$words = preg_split("/[\n\r\t ]+/", $text, $excerpt+1, PREG_SPLIT_NO_EMPTY);
				$ending = (count($words) > $excerpt) ? '...':'';
				$words = array_slice($words, 0, $excerpt);
				$text = implode(' ', $words).$ending;
			}
			else{
				$text = get_the_excerpt();
			}
			$output .= '<p>' . $text . '</p>';
			$output .= '</div>';
			$output .= '</div>';
		endwhile; 
		wp_reset_postdata();
		return $output;
	}
}

