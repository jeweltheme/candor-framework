<?php 

/**
 * The Shortcode
 */
function candor_nord_parallax_image_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'bg_image' 			=> NORD_PATH . '/images/bg/01.jpg',
				'title' 			=> 'Hello, I am Lucas',
				'subtitle' 			=> 'I am a young web designer from the heart of Berlin, Germany.',				
			), $atts 
		) 
	);

	ob_start();	
	$bg_image = wp_get_attachment_image_src( $bg_image, 'full' );
?>

<div class="container">
    <div class="about about-bg parallax" data-stellar-background-ratio="0.5" style="background: url('<?php echo esc_url_raw( $bg_image[0] );?>') no-repeat fixed center top;">
      <div class="about-overlay fullheight">
          <div class="valign">
              <div class="container">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2 text-center">
                        <h2 class="featured-title-caption dark"><span class="dark"><?php echo esc_attr( $title );?></span></h2>
                        <h4 class="featured-title-subtext dark font2"><?php echo esc_attr( $subtitle );?></h4>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>

<?php
  	$output = ob_get_contents();
  	ob_end_clean();

  	return $output;
}
add_shortcode( 'nord_parallax_image', 'candor_nord_parallax_image_shortcode' );



/**
 * The VC Functions
 */
function candor_nord_parallax_image_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => esc_html__("Parallax", 'nord'),
			"base" => "nord_parallax_image",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => 'Parallax Image and Description',
			'wrapper_class'   => 'clearfix',
			"params" => array(
		
						array( 
							'type' => 'attach_image', 
							'heading' => __( 'Background', 'nord'), 
							'param_name' => 'bg_image',
							'value' => NORD_PATH . '/images/bg/01.jpg',
							'description' => __( 'Select Parallax Background from media library', 'nord') 
							), 

						array(
							"type" => "textfield",
							"heading" => __("Title", 'nord'),
							"param_name" => "title",
							'holder' => 'div',
							'value' => 'Hello, I am Lucas',
						),				
						array(
							"type" => "textfield",
							"heading" => __("Subtitle", 'nord'),
							"param_name" => "subtitle",
							'holder' => 'div',
							'value' => 'I am a young web designer from the heart of Berlin, Germany.',
						),
	                

				

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_nord_parallax_image_shortcode_vc' );