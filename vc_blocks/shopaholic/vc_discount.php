<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_discount_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(

				'discount_img_1'		=> SHOPAHOLIC_PATH . '/images/home01/1.png',
				'discount_img_text_1'	=> '<span>45%</span> discount',
				'discount_img_link_1'	=> '#',

				'discount_img_2'		=> SHOPAHOLIC_PATH . '/images/home01/2.png',
				'discount_img_text_2'	=> '<span>New</span> collection',
				'discount_img_link_2'	=> '#',

			), $atts 
		) 
	);
	
	$discount_img_1 = wp_get_attachment_image_src( $discount_img_1, 'full' );
	$discount_img_2 = wp_get_attachment_image_src( $discount_img_2, 'full' );

	ob_start();
?>
	
    <section class="discount">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 left-content">
					<div class="item">
						<a href="<?php echo esc_url_raw( $discount_img_link_1 ); ?>">
							<div class="item-thumbnail text-right">
							<img src="<?php echo esc_url_raw( $discount_img_1[0] ); ?>" alt="<?php echo get_the_title();?>">
							</div><!-- /.item-thumbnail -->
							<div class="item-details">
								<h3 class="item-title text-center">
									<?php echo htmlspecialchars_decode($discount_img_text_1);?>
								</h3><!-- /.item-title -->
							</div><!-- /.item-details -->
						</a>
					</div><!-- /.item -->
				</div>

				<div class="col-sm-6 right-content">
					<div class="item">
						<a href="<?php echo esc_url_raw( $discount_img_link_2 ); ?>">
							<div class="item-thumbnail text-right">
								<img src="<?php echo esc_url_raw( $discount_img_2[0] ); ?>" alt="<?php echo get_the_title();?>">
							</div><!-- /.item-thumbnail -->
							<div class="item-details">
								<h3 class="item-title text-left">
									<?php echo htmlspecialchars_decode($discount_img_text_2);?>
								</h3><!-- /.item-title -->
							</div><!-- /.item-details -->
						</a>
					</div><!-- /.item -->
				</div>
			</div><!-- /.row -->
		</div><!-- /.container -->
    </section><!-- /.discount -->
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_discount', 'candor_framework_shopaholic_discount_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_shopaholic_discount_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Discount Image", 'shopaholic-wp'),
			"base" => "shopaholic_discount",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Discount Images Section',
			"params" => array(
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Discount Image 1', 'shopaholic-wp' ),
					'param_name' => 'discount_img_1',
					'value' => SHOPAHOLIC_PATH . '/images/home01/1.png',
					"admin_label" => true,
					'description' => esc_html__( 'Select images from media library.', 'shopaholic-wp' )
				),
				array(
					"type" => "textfield",
					"heading" => __("Discount Image 1 Text", 'shopaholic-wp'),
					"param_name" => "discount_img_text_1",
					'holder' => 'div',
					'value' => '<span>45%</span> discount',
				),
				array(
					"type" => "textfield",
					"heading" => __("Discount Image 1 Link", 'shopaholic-wp'),
					"param_name" => "discount_img_link_1",
					'value' => '#',
				),


				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Discount Image 2', 'shopaholic-wp' ),
					'param_name' => 'discount_img_2',
					'value' => SHOPAHOLIC_PATH . '/images/home01/2.png',
					"admin_label" => true,
					'description' => esc_html__( 'Select images from media library.', 'shopaholic-wp' )
				),
				array(
					"type" => "textfield",
					"heading" => __("Discount Image 2 Text", 'shopaholic-wp'),
					"param_name" => "discount_img_text_2",
					'holder' => 'div',
					'value' => '<span>New</span> collection',
				),
				array(
					"type" => "textfield",
					"heading" => __("Discount Image 2 Link", 'shopaholic-wp'),
					"param_name" => "discount_img_link_2",
					'value' => '#',
				),



			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_discount_shortcode_vc');