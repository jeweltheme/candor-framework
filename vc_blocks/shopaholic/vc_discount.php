<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_discount_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(

				'type' => "style1",
				
				// Style 2				
				'discount_img_style_2'		=> SHOPAHOLIC_PATH . '/images/home01/1.png',
				'discount_mini_title'		=> 'End of the season',
				'discount_title'			=> 'Don\'t be late',
				'discount_btn_text'			=> 'Shop Now',
				'discount_btn_link'			=> '#',


				// Style 1
				'discount_img_1'		=> SHOPAHOLIC_PATH . '/images/home01/1.png',
				'discount_img_text_1'	=> '<span>45%</span> discount',
				'discount_img_link_1'	=> '#',

				'discount_img_2'		=> SHOPAHOLIC_PATH . '/images/home01/2.png',
				'discount_img_text_2'	=> '<span>New</span> collection',
				'discount_img_link_2'	=> '#',

			), $atts 
		) 
	);
	
	$discount_img_style_2 = wp_get_attachment_image_src( $discount_img_style_2, 'full' );

	$discount_img_1 = wp_get_attachment_image_src( $discount_img_1, 'full' );
	$discount_img_2 = wp_get_attachment_image_src( $discount_img_2, 'full' );

	ob_start();
?>


	<?php if($type=="style1"){ ?>

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
	<?php } ?>



	<?php if($type=="style2"){ ?>
	    <section class="discount discount-02 text-center">
	    	<div class="container">
	    		<!-- <img src="images/home05/discount.jpg" alt="Banner Image"> -->

	    		<div class="discount-details background-bg" data-image-src="<?php echo esc_url_raw( $discount_img_style_2[0] ); ?>">
	    			<div class="discount-content">
	    				<h4 class="mini-title"><?php echo esc_attr( $discount_mini_title ); ?></h4>
	    				<h2 class="title"><?php echo esc_attr( $discount_title ); ?></h2>
	    				<a href="<?php echo esc_url_raw( $discount_btn_link ); ?>" class="btn"><?php echo esc_attr( $discount_btn_text ); ?></a>
	    			</div><!-- /.discount-content -->
	    		</div><!-- /.discount-details -->
	    	</div><!-- /.container -->
	    </section><!-- /.discount -->
	<?php } ?>


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
						'param_name' => 'type', 
						'heading' => __( 'Discount Type', 'shopaholic-wp'), 
						'type' => 'dropdown', 
						'admin_label' => true, 
						'std' => 'style1', 
						'value' => array( 
								__( 'Style 1', 'shopaholic-wp') 	=> 'style1', 
								__( 'Style 2', 'shopaholic-wp') 	=> 'style2' 
							) 
						), 

						// Discount Style 2
						array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Discount Image', 'shopaholic-wp' ),
							'param_name' => 'discount_img_style_2',
							'value' => SHOPAHOLIC_PATH . '/images/home01/1.png',
							"admin_label" => true,
							'dependency' => array( 
								'element' => "type", 
								'value' => array( 'style2')
								), 
							'description' => esc_html__( 'Select images from media library.', 'shopaholic-wp' )
							),
						array(
							"type" => "textfield",
							"heading" => __("Discount Mini Title", 'shopaholic-wp'),
							"param_name" => "discount_mini_title",
							'holder' => 'div',
							'dependency' => array( 
								'element' => "type", 
								'value' => array( 'style2')
								), 
							'value' => 'End of the season',
						),
						array(
							"type" => "textfield",
							"heading" => __("Discount Title", 'shopaholic-wp'),
							"param_name" => "discount_title",
							'holder' => 'div',
							'dependency' => array( 
								'element' => "type", 
								'value' => array( 'style2')
								), 
							'value' => 'Don\'t be late',
						),
						array(
							"type" => "textfield",
							"heading" => __("Button Text", 'shopaholic-wp'),
							"param_name" => "discount_btn_text",
							'holder' => 'div',
							'dependency' => array( 
								'element' => "type", 
								'value' => array( 'style2')
								), 
							'value' => 'Shop Now',
						),
						array(
							"type" => "textfield",
							"heading" => __("Button Link", 'shopaholic-wp'),
							"param_name" => "discount_btn_link",
							'holder' => 'div',
							'dependency' => array( 
								'element' => "type", 
								'value' => array( 'style2')
								), 
							'value' => '#',
						),




						// Discount Style 1
						array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Discount Image 1', 'shopaholic-wp' ),
							'param_name' => 'discount_img_1',
							'value' => SHOPAHOLIC_PATH . '/images/home01/1.png',
							"admin_label" => true,
							'dependency' => array( 
								'element' => "type", 
								'value' => array( 'style1')
								), 
							'description' => esc_html__( 'Select images from media library.', 'shopaholic-wp' )
						),
						array(
							"type" => "textfield",
							"heading" => __("Discount Image 1 Text", 'shopaholic-wp'),
							"param_name" => "discount_img_text_1",
							'holder' => 'div',
							'dependency' => array( 
								'element' => "type", 
								'value' => array( 'style1')
								), 
							'value' => '<span>45%</span> discount',
						),
						array(
							"type" => "textfield",
							"heading" => __("Discount Image 1 Link", 'shopaholic-wp'),
							"param_name" => "discount_img_link_1",
							'value' => '#',
							'dependency' => array( 
								'element' => "type", 
								'value' => array( 'style1')
								), 
						),
						array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Discount Image 2', 'shopaholic-wp' ),
							'param_name' => 'discount_img_2',
							'value' => SHOPAHOLIC_PATH . '/images/home01/2.png',
							"admin_label" => true,
							'dependency' => array( 
								'element' => "type", 
								'value' => array( 'style1')
								), 
							'description' => esc_html__( 'Select images from media library.', 'shopaholic-wp' )
						),
						array(
							"type" => "textfield",
							"heading" => __("Discount Image 2 Text", 'shopaholic-wp'),
							"param_name" => "discount_img_text_2",
							'holder' => 'div',
							'dependency' => array( 
								'element' => "type", 
								'value' => array( 'style1')
								), 
							'value' => '<span>New</span> collection',
						),
						array(
							"type" => "textfield",
							"heading" => __("Discount Image 2 Link", 'shopaholic-wp'),
							"param_name" => "discount_img_link_2",
							'dependency' => array( 
								'element' => "type", 
								'value' => array( 'style1')
								), 
							'value' => '#',
						),



			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_discount_shortcode_vc');