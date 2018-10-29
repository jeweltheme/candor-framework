<?php 

/**
 * The Shortcode
 */
function cast_recent_projects_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'style' 			=> 'style1',
				'pppage' 			=> '4',
				'title' 			=> 'Recent Projects',
				'filter'	 		=> 'all'
			), $atts 
		) 
	);


	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' 		=> 'portfolio',
		'posts_per_page' 	=> $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'testimonial_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'portfoliol_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}


	ob_start();

	$block_query = new WP_Query( $query_args );
?>

    <section class="portfolio">
        <div class="section-padding">
            <div class="container">
                <div class="inner-bg">
                    <div class="section-title"><?php echo esc_attr( $title );?></div><!-- /.section-title -->
                    <div class="padding">
                        <div class="items">

                        	<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
                        		
                        		global $post;
                        		$terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));  
                        		$t = array();                    
                        		foreach($terms as $term)
                        			$t[] = $term->name;
                        		?>

	                        		<div class="col-sm-3">
		                                <div class="item">
		                                    <?php if ( has_post_thumbnail() ) { ?>
		                                		<?php the_post_thumbnail('cast-portfolio-thumbs'); ?>
		                                	<?php } ?>
		                                    <div class="item-hover">
		                                        <div class="hover-details">
		                                            <h3 class="item-title">
		                                            	<a href="<?php the_permalink();?>"><?php the_title();?></a>
		                                            </h3><!-- /.item-title -->
		                                            <span class="category"><?php echo implode(' ', $t); $t = array(); ?></span><!-- /.category -->
		                                        </div><!-- /.hover-details -->
		                                    </div><!-- /.item-hover -->
		                                </div><!-- /.item -->
		                            </div>
		                    <?php } } ?>

                        </div><!-- /.items -->
                    </div><!-- /.padding -->
                </div><!-- /.inner-bg -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.portfolio -->




<?php
	wp_reset_postdata();
	wp_reset_query();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'cast_recent_projects', 'cast_recent_projects_shortcode' );



/**
 * The VC Functions
 */
function cast_recent_projects_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'cast-vc-block',
			"name" => esc_html__("Recent Projects", 'cast'),
			"base" => "cast_recent_projects",
			"category" => esc_html__('CAST WP Theme', 'cast'),
			'description' => 'Show Recent Projects',
			'wrapper_class'   => 'clearfix',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Title", 'cast'),
					"param_name" => "title",
					'holder' => 'div',
					'value' => 'Recent Projects',
					),	
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'elevation'),
					"param_name" => "pppage",
					"value" => '4'
				)
	
				

			)
		) 
	);
}
add_action( 'vc_before_init', 'cast_recent_projects_shortcode_vc' );