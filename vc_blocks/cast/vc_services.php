<?php 

/**
 * The Shortcode
 */
function cast_services_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'style' 			=> 'style1',
				'pppage' 			=> '4',
				'title' 			=> 'PROJECT PLANING',
				'filter'	 		=> 'all'
			), $atts 
		) 
	);


	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' 		=> 'service',
		'posts_per_page' 	=> $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'service_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'service_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}


	ob_start();

	$block_query = new WP_Query( $query_args );
?>

<?php if( $style =="style1" ){ ?>


    <section class="portfolio">
        <div class="section-padding">
            <div class="container">
                <div class="inner-bg">
                    <div class="padding">
                        <div class="items">

                        	<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
                        		
                        		global $post;

                        		$service_title 				= cast_meta( '_cast_service_title');
                        		$service_desc 				= cast_meta( '_cast_service_desc');

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
		                                            	<a href="<?php the_permalink();?>"><?php echo esc_attr( $service_title );?></a>
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



<?php } elseif( $style =="style2" ){ ?>

    <section class="we-do text-center">
        <div class="section-padding">
            <div class="container">
                <div class="inner-bg">
                    <div class="items">
                        <div class="padding">

                        	<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
                        		
                        		global $post;
                        		
                        		$service_title 				= cast_meta( '_cast_service_title');
                        		$service_desc 				= cast_meta( '_cast_service_desc');

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
		                                    <h3 class="item-title"><?php echo esc_attr( $service_title );?></h3><!-- /.item-title -->
		                                    <p class="description">
		                                        <?php echo esc_attr( $service_desc ); ?>
		                                    </p><!-- /.description -->
		                                    <?php cast_read_more();?>
		                                </div><!-- /.item -->
		                            </div>

		                    <?php } } ?>

                        </div><!-- /.padding -->
                    </div><!-- /.items -->
                </div><!-- /.inner-bg -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.we-do -->

<?php } elseif( $style =="style3" ){ ?>
	

    <section class="services">
        <div class="section-padding">
            <div class="container">
                <div class="items">

                	<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
                		
                		global $post;
                		
                		$service_title 				= cast_meta( '_cast_service_title');
                		$service_desc 				= cast_meta( '_cast_service_desc');

                		$terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));  
                		$t = array();                    
                		foreach($terms as $term)
                			$t[] = $term->name;
                		?>       

		                    <div class="col-sm-4">
		                        <div class="item">
		                            <div class="item-image">
		                            	<?php if ( has_post_thumbnail() ) { ?>
		                            		<?php the_post_thumbnail('cast-service-thumb'); ?>
		                            	<?php } ?>
		                            </div><!-- /.item-image -->
		                            <div class="item-details">
		                                <div class="padding">
		                                    <h3 class="item-title"><?php echo esc_attr( $service_title );?></h3><!-- /.item-title -->
		                                    <p class="description">
		                                        <?php echo esc_attr( $service_desc ); ?>
		                                    </p><!-- /.description -->
		                                    <?php cast_read_more();?>
		                                </div><!-- /.padding -->
		                            </div><!-- /.item-details -->
		                        </div><!-- /.item -->
		                    </div>

		                <?php } } ?>

                </div><!-- /.items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.services -->
    



<?php } ?>


<?php
	wp_reset_postdata();
	wp_reset_query();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'cast_services', 'cast_services_shortcode' );



/**
 * The VC Functions
 */
function cast_services_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'cast-vc-block',
			"name" => esc_html__("Service Block", 'cast'),
			"base" => "cast_services",
			"category" => esc_html__('CAST WP Theme', 'cast'),
			'description' => 'Show Services with Layout Options',
			'wrapper_class'   => 'clearfix',
			"params" => array(

				array(
					"type" => "dropdown",
					"heading" => __("Style", 'cast'),
					"param_name" => "style",
					"value" => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2',
						'Style 3' => 'style3',
						),
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
add_action( 'vc_before_init', 'cast_services_shortcode_vc' );