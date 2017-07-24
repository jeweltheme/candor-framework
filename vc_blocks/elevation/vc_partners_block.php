<?php 

/**
 * The Shortcode
 */
function candor_framework_partners_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'title' 			=> 'Our Partners',
				'description' 		=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore',
				'images'	 		=> ''
			), $atts 
		) 
	);



        $output = '<div class="partners text-center">
          <div class="parallax-style">
            <div class="section-padding">
              <div class="container">
                <h4 class="section-sub-title">'. strip_tags($title) .'</h4><!-- /.section-sub-title -->

                <p class="description">'. strip_tags($description) .'</p><!-- /.description -->
                <div class="section-details">
                  <div id="logo-list" class="logo-list owl-carousel owl-theme">';
					$images = explode(',', $images);
					$i = 0;

	                  if( is_array($images) ){
	                  	foreach( $images as $ID ){ 
	                  		$partners_url = get_post_meta( $ID,'_partners_url',true );

	                  		$output .= '<div class="item"><a href="' . $partners_url  . '" target="_blank">'. wp_get_attachment_image( $ID, 'full' ) .'</a></div>';
	                  		$i++;	
	                  	}
	                  } 
                  $output .= '</div><!-- /.logo-list -->
                </div><!-- /.section-details -->
              </div><!-- /.container -->
            </div><!-- /.section-padding -->
          </div><!-- /.parallax-style -->
        </div><!-- /#partners -->';



	return $output;
}
add_shortcode( 'elevation_partners', 'candor_framework_partners_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_partners_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => __("Partners", 'elevation'),
			"base" => "elevation_partners",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			'description' => 'Show Partners Logo Image.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'elevation'),
					"param_name" => "title",
					'holder' => 'div',
					'value'	=> 'Our Partners'
					),				
				array(
					"type" => "textfield",
					"heading" => esc_html__("Description", 'elevation'),
					"param_name" => "description",
					'holder' => 'p',
					'value'	=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore'
					),
				array(
					'type' => 'attach_images',
					'heading' => esc_html__( 'Images', 'elevation' ),
					'param_name' => 'images',
					'value' => get_template_directory_uri() . '/images/difference.jpg',
					"admin_label" => true,
					'description' => esc_html__( 'Select images from media library.', 'elevation' )
					),


			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_partners_shortcode_vc');