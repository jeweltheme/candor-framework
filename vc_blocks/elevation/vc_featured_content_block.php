<?php 

/**
 * The Shortcode
 */
function candor_vc_featured_content_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title_1' 			=> 'Give Food For Africa',
				'title_2' 			=> 'Education For Every Child',
				'image_1' 			=> ELEVATION_THEME_DIRECTORY . '/images/banner/1.jpg',
				'image_2' 			=> ELEVATION_THEME_DIRECTORY . '/images/banner/2.jpg'
			), $atts 
		) 
	);
	
	$image_1 = wp_get_attachment_image_src( $image_1, 'full' );
	$image_2 = wp_get_attachment_image_src( $image_2, 'full' );

	$output = '<div id="featured" class="featured text-center clearfix">
          <div class="featured-items">
            <div class="row">
              <div class="col-sm-6">
                <div class="item">
                  <a href="'. $image_1[0] .'" class="image-popup-vertical-fit"><img src="'. $image_1[0] .'" alt="' . get_the_title() . '">
                    <div class="item-text">
                      <p>'. esc_attr($title_1) .'</p>
                    </div>
                  </a>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="item">
                  <a href="'. $image_2[0] .'" class="image-popup-vertical-fit"><img src="'. $image_2[0] .'" alt="' . get_the_title() . '">
                    <div class="item-text">
                      <p>'. esc_attr($title_2) .'</p>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div><!-- /.featured-items -->
        </div><!-- /#featured -->';
	
	return $output;
}
add_shortcode( 'elevation_featured_content', 'candor_vc_featured_content_block_shortcode' );



/**
 * The VC Functions
 */
function candor_vc_featured_content_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => esc_html__("featured Content", 'elevation'),
			"base" => "elevation_featured_content",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title 1", 'elevation'),
					"param_name" => "title_1",
					'holder' => 'div',
					'value'	=> 'Give Food For Africa'
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image 1', 'elevation' ),
					'param_name' => 'image_1',
					'value' => ELEVATION_THEME_DIRECTORY . '/images/banner/1.jpg',
					"admin_label" => true,
					'description' => esc_html__( 'Select image from media library.', 'elevation' )
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title 2", 'elevation'),
					"param_name" => "title_2",
					'holder' => 'div',
					'value'	=> 'Education For Every Child'
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image 2', 'elevation' ),
					'param_name' => 'image_2',
					'value' => ELEVATION_THEME_DIRECTORY . '/images/banner/2.jpg',
					"admin_label" => true,
					'description' => esc_html__( 'Select image from media library.', 'elevation' )
				),

				

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_vc_featured_content_shortcode_vc' );