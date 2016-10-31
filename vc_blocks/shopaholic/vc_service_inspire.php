<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_service_inspire_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(

				'title'			=> 'Credibly envisioneer cooperative leadership',
				'subtitle'		=> 'Be Inspired & Start Work With Us',
				'btn_1_text'	=> 'Buy Theme',
				'btn_1_link'	=> '#',
				'btn_2_text'	=> 'Contact Us',
				'btn_2_link'	=> '#',
				'bg_image'		=> SHOPAHOLIC_PATH . '/images/service/parallax.jpg',
			), $atts 
		) 
	);
	

	$bg_image = wp_get_attachment_image_src( $bg_image, 'full' );

	ob_start();
?>
	
	  <section class="inspire parallax-style background-bg text-center" data-image-src="<?php echo esc_url_raw( $bg_image[0] ); ?>">
	    <div class="overlay">
	      <div class="section-padding">
	        <div class="container">
	          <h3 class="sub-title"><?php echo esc_html__($subtitle);?></h3><!-- /.sub-title -->
	          <h2 class="main-title"><?php echo esc_html__($title);?></h2><!-- /.main-title -->
	          <div class="buttons">
	            <a href="<?php echo esc_url_raw($btn_1_link);?>" class="btn"><?php echo esc_html__($btn_1_text);?></a>
	            <a href="<?php echo esc_url_raw($btn_2_link);?>" class="btn"><?php echo esc_html__($btn_2_text);?></a>
	          </div><!-- /.buttons -->
	        </div><!-- /.container -->
	      </div><!-- /.section-padding -->
	    </div><!-- /.overlay -->
	  </section><!-- /.inspire -->
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_service_inspire', 'candor_framework_shopaholic_service_inspire_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_service_inspire_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Service Inspire", 'shopaholic-wp'),
			"base" => "shopaholic_service_inspire",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Services Inspire Section',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Title", 'shopaholic-wp'),
					"param_name" => "title",
					'holder' => 'div',
					'value' => 'Credibly envisioneer cooperative leadership',
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'shopaholic-wp'),
					"param_name" => "subtitle",
					'value' => 'Be Inspired & Start Work With Us',
				),

				array(
					"type" => "textfield",
					"heading" => __("Button 1 Text", 'shopaholic-wp'),
					"param_name" => "btn_1_text",
					'holder' => 'a',
					'value' => 'Buy Theme',
				),
				array(
					"type" => "textfield",
					"heading" => __("Button 1 Link", 'shopaholic-wp'),
					"param_name" => "btn_1_link",
					'holder' => 'a',
					'value' => '#',
				),
				array(
					"type" => "textfield",
					"heading" => __("Button 2 Text", 'shopaholic-wp'),
					"param_name" => "btn_2_text",
					'holder' => 'a',
					'value' => 'Contact Us',
				),
				array(
					"type" => "textfield",
					"heading" => __("Button 2 Link", 'shopaholic-wp'),
					"param_name" => "btn_2_link",
					'holder' => 'a',
					'value' => '#',
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Background Image', 'shopaholic-wp' ),
					'param_name' => 'bg_image',
					'value' => SHOPAHOLIC_PATH . '/images/service/parallax.jpg',
					"admin_label" => true,
					'description' => esc_html__( 'Select images from media library.', 'shopaholic-wp' )
					),


			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_service_inspire_shortcode_vc');