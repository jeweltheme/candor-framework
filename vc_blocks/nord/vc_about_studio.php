<?php 

/**
 * The Shortcode
 */
function candor_nord_about_studio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' 			=> '999',
				'filter' 			=> 'all',
			), $atts 
		) 
	);
	
	// Fix for pagination
	if( is_front_page() ) { 
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 
	} else { 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
	}
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $pppage,
		'paged' => $paged
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'portfolio_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}


	if( $filter == 'all' ){
		$cats = get_categories('taxonomy=portfolio_category');
	} else {
		$cats = get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
	}

	
	$block_query = new WP_Query( $query_args );

	ob_start();
?>


<div id="works-container" class="works-container works-masonry-container clearfix white-bg">
	    	
		<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();

			global $post;
			$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
			$portfolio_categories = get_the_term_list( $post->ID, 'portfolio_category', ' ', ' ' );
			$portfolio_cat = get_the_term_list( $post->ID, 'portfolio_category', ' ', ', ' );

			$terms = wp_get_post_terms(get_the_ID(), 'portfolio_category' );
			$t = array();
			foreach($terms as $term) $t[] = $term->slug;
		?>


			<!-- start : works-item -->
			<div class="works-item works-item-one-half <?php echo implode(' ', $t); $t = array(); ?>">
				<img data-no-retina alt="<?php the_title_attribute();?>" title="<?php the_title_attribute();?>" class="img-responsive" src="<?php echo $url[0];?>"/>
			</div>
			<!-- end : works-item -->	 

		<?php } } ?>

	</div>
	<!-- end : works-container -->



<?php

	wp_reset_postdata();
	wp_reset_query();
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'nord_about_studio', 'candor_nord_about_studio_shortcode' );

/**
 * The VC Functions
 */
function candor_nord_about_studio_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => esc_html__("About Studio", 'nord'),
			"base" => "nord_about_studio",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => 'Show Nord About Studio Posts.',
			"params" => array(
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__("Show How Many Posts?", 'nord'),
					"param_name" 	=> "pppage",
					"value" 		=> '6'
				),

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_nord_about_studio_shortcode_vc');