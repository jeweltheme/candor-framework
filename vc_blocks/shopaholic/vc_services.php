<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_services_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' 		=> '2',
				'filter' 		=> 'all',
				'pagination' 	=> 'no'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'service',
		'posts_per_page' => $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'pricing_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'pricing_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	$block_query = new WP_Query( $query_args );

	ob_start();
?>
	

  <section class="more-services">
    <div class="section-padding">
      <div class="container">
			<?php 
				$i = 0;
				if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					global $post;
					$service_desc = get_post_meta( $post->ID,'_shopaholic_service_desc',true );
				?>


							<div class="item">
								<div class="col-sm-6 <?php echo (($i % 2) == 0)? "pull-left":"pull-right";?>">
									<div class="item-details">
										<h3 class="item-title"><?php the_title();?></h3><!-- /.item-title -->
										<p class="description">
											<?php echo strip_tags(trim($service_desc)); ?>
										</p><!-- /.description -->
										<?php echo shopaholic_read_more();?>
									</div><!-- /.item-details -->
								</div>

								<div class="col-sm-6 <?php echo (($i % 2) == 0)? "pull-right":"pull-left";?>">
									<div class="item-image">
										<?php the_post_thumbnail('shopaholic_blog-masonry');?>

									</div><!-- /.item-image -->
								</div>
							</div><!-- /.item -->

						<?php 
						$i++;
					}
				}
			?>
 		</div><!-- /.container -->
    </div><!-- /.section-padding -->
  </section><!-- /.more-services -->
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_services', 'candor_framework_shopaholic_services_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_services_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Services", 'shopaholic-wp'),
			"base" => "shopaholic_services",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Services Feed.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'shopaholic-wp'),
					"param_name" => "pppage",
					"value" => '2'
				),
				array(
					"type" 			=> "dropdown",
					"heading" 		=> __("Show Pagination?", 'shopaholic-wp'),
					"param_name" 	=> "pagination",
					"value" => array(
							'No' 	=> 'no',
							'Yes' 	=> 'yes',						
						),
					),	
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_services_shortcode_vc');