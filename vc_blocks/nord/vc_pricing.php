<?php 

/**
 * The Shortcode
 */
function candor_framework_nord_pricing_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '3',
				'filter' => 'all'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'pricing',
		'posts_per_page' => $pppage,
		//'order'			=>"ASC"
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'team_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'team_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	$block_query = new WP_Query( $query_args );

	ob_start();
?>


<div id="ws" class="container add-top-quarter">
          <div class="row">
          <div class="row">

				<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post(); 

						$pricing_currency = candor_framework_meta( '_nord_pricing_currency' );
						$pricing_price = candor_framework_meta( '_nord_pricing_price' );
						$pricing_elements = candor_framework_meta( '_nord_pricing_elements' );
						$pricing_button = candor_framework_meta( '_nord_pricing_button' );
						$pricing_button_link = candor_framework_meta( '_nord_pricing_button_link' );

						

					?>

					<div class="col-md-4 no-pad white-bg">
						<div class="price custom-bordered">
							<i class="ion-ios7-bookmarks-outline color"></i>
							<h5 class="font2 whitegray-bg black "><?php the_title();?></h5>
							<div class="price-specs ">
								<h1 class="font2 black"><?php echo esc_attr( $pricing_currency );?><?php echo esc_attr( $pricing_price );?></h1>
								<?php 
									$el_parts = explode("\n", $pricing_elements);
									foreach ($el_parts as $el) {
										$el = do_shortcode($el);
										echo "{$el}</br>";
									}
								?>  
							</div>
							<div class="pricing-button"><a href="<?php echo esc_attr( $pricing_button_link );?>" class="btn btn-nord btn-nord-dark"><?php echo esc_attr( $pricing_button );?></a></div>
						</div>
					</div>

				<?php } } ?>

	    </div>
	    </div>
	</div>    



<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'nord_pricing', 'candor_framework_nord_pricing_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_nord_pricing_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => __("Pricing Table", 'nord'),
			"base" => "nord_pricing",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => 'Show Pricing Table with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'nord'),
					"param_name" => "pppage",
					"value" => '3'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_nord_pricing_shortcode_vc');