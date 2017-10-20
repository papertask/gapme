<?php

/*********** Shortcode: Latest Post ************************************************************/

$tcvpb_elements['posts_tc'] = array(
	'name' => esc_html__('Posts', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-posts',
	'category' =>  esc_html__('Social', 'ABdev_aeron'),
	'attributes' => array(
		'category' => array(
			'description' => esc_html__( 'Category', 'ABdev_aeron' ),
		),
		'ids' => array(
			'description' => esc_html__( 'Posts IDs', 'ABdev_aeron' ),
			'divider' => 'true',
		),
		'order' => array(
			'default' => 'DESC',
			'type' => 'select',
			'description' => esc_html__( 'Order', 'ABdev_aeron' ),
			'values' => array(
				'ASC' =>  esc_html__( 'ASC', 'ABdev_aeron' ),
				'DESC' =>  esc_html__( 'DESC', 'ABdev_aeron' ),
			),  
			'tab' => esc_html__('Order By', 'ABdev_aeron'),    
		),
		'orderby' => array(
			'default' => 'date',
			'type' => 'select',
			'description' => esc_html__( 'Order by', 'ABdev_aeron' ),
			'values' => array(
				'ID' =>  esc_html__( 'ID', 'ABdev_aeron' ),
				'none' =>  esc_html__( 'none', 'ABdev_aeron' ),
				'author' =>  esc_html__( 'author', 'ABdev_aeron' ),
				'title' =>  esc_html__( 'title', 'ABdev_aeron' ),
				'name' =>  esc_html__( 'name', 'ABdev_aeron' ),
				'date' =>  esc_html__( 'date', 'ABdev_aeron' ),
				'modified' =>  esc_html__( 'modified', 'ABdev_aeron' ),
				'parent' =>  esc_html__( 'parent', 'ABdev_aeron' ),
				'rand' =>  esc_html__( 'rand', 'ABdev_aeron' ),
				'menu_order' =>  esc_html__( 'menu_order', 'ABdev_aeron' ),
				'post__in' =>  esc_html__( 'post__in', 'ABdev_aeron' ),
			),
			'tab' => esc_html__('Order By', 'ABdev_aeron'),  
		),
		'post_parent' => array(
			'description' => esc_html__( 'Post Parent', 'ABdev_aeron' ),
			'tab' => esc_html__('Custom', 'ABdev_aeron'),
		),
		'post_type' => array(
			'default' => 'post',
			'description' => esc_html__( 'Post Type', 'ABdev_aeron' ),
			'tab' => esc_html__('Custom', 'ABdev_aeron'),
		),
		'posts_no' => array(
			'default' => '4',
			'description' => esc_html__( 'Number of Posts', 'ABdev_aeron' ),
		),
		'offset' => array(
			'default' => '0',
			'description' => esc_html__( 'Offset', 'ABdev_aeron' ),
		),
		'tag' => array(
			'description' => esc_html__( 'Tag', 'ABdev_aeron' ),
			'tab' => esc_html__('Custom', 'ABdev_aeron'),
		),
		'tax_operator' => array(
			'default' => 'IN',
			'description' => esc_html__( 'Tax Operator', 'ABdev_aeron' ),
			'tab' => esc_html__('Custom', 'ABdev_aeron'),
		),
		'tax_term' => array(
			'description' => esc_html__( 'Tax Term', 'ABdev_aeron' ),
			'tab' => esc_html__('Custom', 'ABdev_aeron'),
		),
		'taxonomy' => array(
			'description' => esc_html__( 'Taxonomy', 'ABdev_aeron' ),
			'tab' => esc_html__('Custom', 'ABdev_aeron'),
		),
		'excerpt' => array(
			'description' => esc_html__( 'Custom Excerpt Limit Words', 'ABdev_aeron' ),
			'info' => esc_html__( 'How many words you want to display? If left empty default WordPress excerpt will be used.', 'ABdev_aeron' ),
		),
		'id' => array(
			'description' => esc_html__('ID', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom ID', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),	
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
	),
	'description' => esc_html__( 'Posts Excerpts', 'ABdev_aeron' )
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
		

		$output = '<div class="tcvpb_container">';
		$count = 0;
		while ( $listing->have_posts() && $count<4): $listing->the_post(); 
			$count += 1;
			global $post;

			$thumbnail = get_the_post_thumbnail($post->ID, array( 270, 200));
			$thumb_id = get_post_thumbnail_id();

			$img_url = wp_get_attachment_image_src($thumb_id, 'full');

			if ($img_url != '') {
			$arrayKeys = array_keys($img_url);

			$url = $img_url[$arrayKeys[0]];
			}

			$hasthumb_class = ($thumbnail!='') ? ' has_thumbnail' : ' without_thumbnail';

			$cat_out = '';
			$categories = get_the_category();

			

			if ( ! empty( $categories ) ) {
			    $cat_out .= '<a class="" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
			} 

				$output .= '<div class="db-rp-bloc tcvpb_column_tc_span3 hvr-bounce-to-bottom">';


				$output .= '<a class="" href="' . get_permalink() . '"><div class="db_post_thumbnail_container">';

				 $output .= ($thumbnail!='') ?  get_the_post_thumbnail($post->ID) : '<img src="'. wp_get_attachment_image_src( $attachment_id = 1269 )[0] .'"/>';

				 $output .= '</div><div class=" db_overlayed_after" style="height: 5px;"></div>';
				

				//$output .= ($thumbnail!='') ? '<a class="" href="' . get_permalink() . '"><div class="db_post_thumbnail_container">' . get_the_post_thumbnail($post->ID) . '</div><div class=" db_overlayed_after" style="height: 5px;"></div>' :'<a>';

				$output .= '<div class="db_rp_title">';
					$output .= '<h5>'. get_the_title() . '</h5>';	
				$output .= '</div>';

				$output .= '<div class="db_rp_date">';
					$output .= '<span class="month">'.get_the_date('M').'</span>';
					$output .= '<span class="day"> '.get_the_date('d').'</span>';
					$output .= '<span class="year">, '.get_the_date('Y') .'</span>';
				$output .= '</div>';

			 $output .= '</a></div>';


			// $output .= '<div '.esc_attr($id_out).' class=" tcvpb_column_tc_span3 clearfix'.esc_attr($hasthumb_class).' '.esc_attr($class).'">';
			
			// $output .= ($thumbnail!='') ? '<a class="" href="' . get_permalink() . '"><div class="db_post_thumbnail_container">' . get_the_post_thumbnail($post->ID, array( 270, 200)) . '</div><div class=" db_overlayed_after" style="height: 5px;"></div></a>' :'';
			
			// $output .= '<div class="db_rp_title">';
			// $output .= '<h5><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h5></div>';			
			 // $output .= '<div class="db_rp_date"><p ><span class="month">'.get_the_date('M').'</span> <span class="day">'.get_the_date('d').'</span><span class="year">, '.get_the_date('Y') . '</div>';
			
			
			// $output .= '</div>';
			
		endwhile; 
		$output .= '</div>';
		wp_reset_postdata();
		
		return $output;
	}
}

