<?php 

/**
 * The Shortcode
 */
function candor_framework_inventory_pricing_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' 			=> '4',
				'pricing_category' 	=> 'Basic',
				'layout' 			=> 'inv-pricing-row',
				'filter' 			=> 'all'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	// $query_args = array(
	// 	'post_type' => 'pricing',
	// 	'posts_per_page' => $pppage,
	// 	'order'			=>"ASC"
	// );
	

	$query_args = array(
			'post_type' 		=> 'pricing',
			'posts_per_page'	=> $pppage,

			'tax_query' => array(
				array(
					'taxonomy' => 'pricing_category',
					'terms' => $pricing_category,
					'field' => 'name',
					)
				),
			'orderby' => 'title',
			'order' => 'ASC'
		);


	$block_query = new WP_Query( $query_args );

	ob_start();
?>

<div class="bg8 padding-lg-t170 padding-lg-b160 padding-sm-t0 padding-sm-b0">
</div>


<div class="bg7 inv-pricing-body2 padding-lg-b145">
    <div class="container padd-only-xs">

    <?php if( $layout =="inv-pricing-row" ){ ?>

        <div class="bg8 margin-lg-t-180  margin-sm-t50  inv-shadow">
            <div class="row">
				
				<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post(); 
						$pricing_currency = candor_framework_meta( '_inventory_pricing_currency' );
						$pricing_price = candor_framework_meta( '_inventory_pricing_price' );
						$pricing_color = candor_framework_meta( '_inventory_pricing_color' );
						$pricing_bg_color = candor_framework_meta( '_inventory_pricing_bg_color' );
						$pricing_elements = candor_framework_meta( '_inventory_pricing_elements' );
						$pricing_duration = candor_framework_meta( '_inventory_pricing_duration' );
						$pricing_button = candor_framework_meta( '_inventory_pricing_button' );
						$pricing_button_link = candor_framework_meta( '_inventory_pricing_button_link' );
					?>
		                <div class="col-lg-3 col-sm-6">
		                    <div class="inv-pricing inv-pricing-row">
		                        <div class="inv-pricing-head">
		                            <h5><?php the_title();?></h5>
		                            <?php if(empty($pricing_price)){ ?>
		                            	<h3 style="color:<?php echo esc_attr($pricing_color);?>"><?php echo esc_html__('Free', 'inventory');?> <span>/ <?php echo esc_attr( $pricing_duration );?></span></h3>
		                            <?php } else{ ?>
		                            	<h3 style="color:<?php echo esc_attr($pricing_color);?>"><sup><?php echo esc_attr( $pricing_currency );?></sup><?php echo esc_attr( $pricing_price );?> <span>/ <?php echo esc_attr( $pricing_duration );?></span></h3>
		                            <?php } ?>
		                            
		                        </div>
		                        <div class="inv-pricing-body">
		                            <nav>
		                                <ul>
		                                	<?php 
		                                	$el_parts = explode("\n", $pricing_elements);
		                                	foreach ($el_parts as $el) {
		                                		$el = do_shortcode($el);
		                                		echo '<li><i class="fa fa-check"></i><span>' . $el .'</span></li>';
		                                	}
		                                	?>  
		                                </ul>
		                            </nav>
		                            <a class="bg3-hv" href="<?php echo esc_attr( $pricing_button_link );?>"><?php echo esc_attr( $pricing_button );?></a>
		                        </div>
		                    </div>
		                </div>
                <?php wp_reset_postdata(); } } ?>

            </div>
        </div>
	
	<?php } ?>


	<?php if( $layout =="inv-pricing2" ){ ?>
	    
	        <div class="row">
				<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post(); 
						$pricing_currency = candor_framework_meta( '_inventory_pricing_currency' );
						$pricing_price = candor_framework_meta( '_inventory_pricing_price' );
						$pricing_color = candor_framework_meta( '_inventory_pricing_color' );
						$pricing_bg_color = candor_framework_meta( '_inventory_pricing_bg_color' );
						$pricing_elements = candor_framework_meta( '_inventory_pricing_elements' );
						$pricing_duration = candor_framework_meta( '_inventory_pricing_duration' );
						$pricing_button = candor_framework_meta( '_inventory_pricing_button' );
						$pricing_button_link = candor_framework_meta( '_inventory_pricing_button_link' );
					?>
		            <div class="col-md-4">
		                <div class="inv-pricing inv-pricing2 margin-lg-t120">
		                    <div class="inv-pricing-head" style="background-color:<?php echo esc_attr( $pricing_bg_color );?>"> 
		                        <span><?php echo esc_attr( $pricing_currency );?><?php echo esc_attr( $pricing_price );?></span>
		                        <p><?php echo esc_attr( $pricing_duration );?></p>
		                    </div>
		                    <div class="inv-pricing-body">
		                        <h5><?php the_title();?></h5>
		                        <nav>
		                            <ul>
	                                	<?php 
	                                	$el_parts = explode("\n", $pricing_elements);
	                                	foreach ($el_parts as $el) {
	                                		$el = do_shortcode($el);
	                                		echo '<li><i class="fa fa-check"></i><span>' . $el .'</span></li>';
	                                	}
	                                	?>  
		                            </ul>
		                        </nav>
		                        <a class="bg10-hv" href="<?php echo esc_attr( $pricing_button_link );?>"><?php echo esc_attr( $pricing_button );?></a>
		                    </div>
		                </div>
		            </div>
	            <?php wp_reset_postdata(); } } ?>
	        </div>
		<?php } ?>

    </div>
</div>




<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'inventory_pricing', 'candor_framework_inventory_pricing_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_inventory_pricing_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'inventory-vc-block',
			"name" => __("Pricing Table", 'inventory'),
			"base" => "inventory_pricing",
			"category" => esc_html__('Inventory WP Theme', 'inventory'),
			'description' => 'Show Pricing Table with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'inventory'),
					"param_name" => "pppage",
					"value" => '4'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Pricing Layout", 'inventory'),
					"param_name" => "layout",
					"value" => array(
						'Layout 1' => 'inv-pricing-row',
						'Layout 2' => 'inv-pricing2'
						),
					),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Pricing Category', 'inventory' ),
					'param_name' => 'pricing_category',
					'value'		  => '',
					'description' => esc_html__( 'List of Pricing categories', 'inventory' ),
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_inventory_pricing_shortcode_vc');