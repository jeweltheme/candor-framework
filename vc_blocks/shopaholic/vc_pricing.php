<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_pricing_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' 		=> '4',
				'filter' 		=> 'all',
				'pricing_type' 	=> 'no'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'pricing',
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
	

	<div class="pricing-table text-center">
		<div class="pricing-table-<?php echo ($pricing_type == "yes")? "2 bg-gray":"1";?>">


						<?php 
							if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
								
								/**
								 * Get blog posts by blog layout.
								 */
								global $post;
								$pricing_currency = get_post_meta( $post->ID,'_shopaholic_pricing_currency',true );
								$pricing_price = get_post_meta( $post->ID,'_shopaholic_pricing_price',true );
								$pricing_duration = get_post_meta( $post->ID,'_shopaholic_pricing_duration',true );  
								$pricing_elements = get_post_meta( $post->ID,'_shopaholic_pricing_elements',true );
								$pricing_button = get_post_meta( $post->ID,'_shopaholic_pricing_button',true );
								$pricing_button_link = get_post_meta( $post->ID,'_shopaholic_pricing_button_link',true );
								$pricing_active = get_post_meta( $post->ID,'_shopaholic_pricing_active',true );

								$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(366,270));

								$pricing_thumb = "data-image-src='" . esc_url_raw($image_thumb['0']) ."'";								
							?>

										<div class="col-md-3 col-sm-6">
											<div class="item">
												<div class="item-top background-bg" <?php if($pricing_type == "yes"){ echo strip_tags($pricing_thumb); }?>>
													<h3 class="item-title"><?php the_title();?></h3><!-- /.item-title -->
													<div class="item-price">
														<span class="currency"><?php echo esc_html__( $pricing_currency );?></span>
														<span class="price"><?php echo esc_html__( $pricing_price );?></span>
														<span class="duration"><?php echo esc_html__( $pricing_duration );?></span>
													</div><!-- /.item-price -->
													<div class="top-bottom"></div><!-- /.top-botom -->
												</div><!-- /.item-top -->
												<div class="item-middle">
													<?php 
													foreach ($pricing_elements as $pe) {
														echo '<span>' . $pe . '</span>';
													}
													?>          
												</div><!-- /.item-middle -->
												<div class="item-bottom">
													<a href="<?php echo esc_html__( $pricing_button_link );?>" class="btn"><?php echo esc_html__( $pricing_button );?></a>
												</div><!-- /.item-bottom -->
											</div><!-- /.item -->
										</div>


									<?php 

								}
							}
						?>

		</div><!-- /.pricing-->
	</div>
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_pricing', 'candor_framework_shopaholic_pricing_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_pricing_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Pricing Table", 'shopaholic-wp'),
			"base" => "shopaholic_pricing",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Pricing Tables with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'shopaholic-wp'),
					"param_name" => "pppage",
					"value" => '4'
				),
				array(
					"type" 			=> "dropdown",
					"heading" 		=> __("Show Image?", 'shopaholic-wp'),
					"param_name" 	=> "pricing_type",
					"value" => array(
							'No' 	=> 'no',
							'Yes' 	=> 'yes',						
						),
					),	
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_pricing_shortcode_vc');