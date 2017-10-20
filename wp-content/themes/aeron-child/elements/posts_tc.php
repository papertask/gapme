<?php

/*********** Shortcode: Latest Post ************************************************************/

$tcvpb_elements['posts_tc'] = array(
	'name' => esc_html__('Posts', 'ABdev_dzen' ),
	'type' => 'block',
	'icon' => 'pi-posts',
	'category' =>  esc_html__('Social', 'ABdev_dzen'),
	'attributes' => array(
		'category' => array(
			'description' => esc_html__( 'Category', 'ABdev_dzen' ),
		),
		'ids' => array(
			'description' => esc_html__( 'Posts IDs', 'ABdev_dzen' ),
			'divider' => 'true',
		),
		'order' => array(
			'default' => 'DESC',
			'type' => 'select',
			'description' => esc_html__( 'Order', 'ABdev_dzen' ),
			'values' => array(
				'ASC' =>  esc_html__( 'ASC', 'ABdev_dzen' ),
				'DESC' =>  esc_html__( 'DESC', 'ABdev_dzen' ),
			),
			'tab' => esc_html__('Order By', 'ABdev_dzen'),
		),
		'orderby' => array(
			'default' => 'date',
			'type' => 'select',
			'description' => esc_html__( 'Order by', 'ABdev_dzen' ),
			'values' => array(
				'ID' =>  esc_html__( 'ID', 'ABdev_dzen' ),
				'none' =>  esc_html__( 'none', 'ABdev_dzen' ),
				'author' =>  esc_html__( 'author', 'ABdev_dzen' ),
				'title' =>  esc_html__( 'title', 'ABdev_dzen' ),
				'name' =>  esc_html__( 'name', 'ABdev_dzen' ),
				'date' =>  esc_html__( 'date', 'ABdev_dzen' ),
				'modified' =>  esc_html__( 'modified', 'ABdev_dzen' ),
				'parent' =>  esc_html__( 'parent', 'ABdev_dzen' ),
				'rand' =>  esc_html__( 'rand', 'ABdev_dzen' ),
				'menu_order' =>  esc_html__( 'menu_order', 'ABdev_dzen' ),
				'post__in' =>  esc_html__( 'post__in', 'ABdev_dzen' ),
			),
			'tab' => esc_html__('Order By', 'ABdev_dzen'),
		),
		'post_parent' => array(
			'description' => esc_html__( 'Post Parent', 'ABdev_dzen' ),
			'tab' => esc_html__('Custom', 'ABdev_dzen'),
		),
		'post_type' => array(
			'default' => 'post',
			'description' => esc_html__( 'Post Type', 'ABdev_dzen' ),
			'tab' => esc_html__('Custom', 'ABdev_dzen'),
		),
		'posts_no' => array(
			'default' => '4',
			'description' => esc_html__( 'Number of Posts', 'ABdev_dzen' ),
		),
		'offset' => array(
			'default' => '0',
			'description' => esc_html__( 'Offset', 'ABdev_dzen' ),
		),
		'tag' => array(
			'description' => esc_html__( 'Tag', 'ABdev_dzen' ),
			'tab' => esc_html__('Custom', 'ABdev_dzen'),
		),
		'tax_operator' => array(
			'default' => 'IN',
			'description' => esc_html__( 'Tax Operator', 'ABdev_dzen' ),
			'tab' => esc_html__('Custom', 'ABdev_dzen'),
		),
		'tax_term' => array(
			'description' => esc_html__( 'Tax Term', 'ABdev_dzen' ),
			'tab' => esc_html__('Custom', 'ABdev_dzen'),
		),
		'taxonomy' => array(
			'description' => esc_html__( 'Taxonomy', 'ABdev_dzen' ),
			'tab' => esc_html__('Custom', 'ABdev_dzen'),
		),
		'excerpt' => array(
			'description' => esc_html__( 'Custom Excerpt Limit Words', 'ABdev_dzen' ),
			'info' => esc_html__( 'How many words you want to display? If left empty default WordPress excerpt will be used.', 'ABdev_dzen' ),
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
	'description' => esc_html__( 'Posts Excerpts', 'ABdev_dzen' )
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
			print_r($thumbnail,true);
			$hasthumb_class = ($thumbnail!='') ? ' has_thumbnail' : ' without_thumbnail';


			
			$output .= '<div '.esc_attr($id_out).' class="tcvpb_posts_shortcode clearfix'.esc_attr($hasthumb_class).' '.esc_attr($class).'">';
			$output .= ($thumbnail!='') ? ( '<a class="tcvpb_latest_news_shortcode_thumb" href="' . esc_url(get_permalink()) . '">' . get_the_post_thumbnail($post->ID,'thumbnail') . '</a>' ) : '';
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