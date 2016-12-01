<?php 

/**
 * The Shortcode
 */
function candor_vc_content_image_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' 			=> 'Let\'s make a difference',
				'learn_more_title' 	=> 'Learn More',
				'learn_more_url' 	=> '#',
				'donate_title' 		=> 'Donate',
				'donate_url' 		=> '#',
				'right_image' 		=> ELEVATION_THEME_DIRECTORY . '/images/difference.jpg'
			), $atts 
		) 
	);
	
	$right_img = wp_get_attachment_image_src( $right_image, 'full' );

	$output = '<section id="about-bottom" class="about-bottom tab3 clearfix">
          <div class="about-bottom-details">
            <div class="col-md-6">
              <div class="section-padding">
                
                <h3 class="section-sub-title">'. esc_attr($title) .'</h3>
                <p class="description">'. wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</p>

                <div class="btn-container">
                  <a href="'. esc_attr($learn_more_url) .'" class="btn btn-sm more-btn">'. esc_attr($learn_more_title) .'</a>
                  <a href="'. esc_attr($donate_url) .'" class="btn btn-sm donate-btn">'. esc_attr($donate_title) .'</a>
                </div><!-- /.btn-container -->
              </div><!-- /.section-padding -->
            </div>

            <div class="col-md-6">
              <img src="'. $right_img[0] .'" alt="'. get_the_title() .'">
            </div>
          </div><!-- /.about-bottom-details -->
        </section><!-- /#about-bottom -->';
	
	return $output;
}
add_shortcode( 'elevation_content_image_box', 'candor_vc_content_image_block_shortcode' );



/**
 * The VC Functions
 */
function candor_vc_content_image_block_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => esc_html__("Left Content, Right Image", 'elevation'),
			"base" => "elevation_content_image_box",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'elevation'),
					"param_name" => "title",
					'holder' => 'div',
					'value'	=> 'Let\'s make a difference'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'elevation'),
					"param_name" => "content",
					'holder' => 'div',
					'value'	=> '<span>Patriotism express our character and work. We don’t know that we love to sacrifice our life for decrease poverty and help children. </span>
				                  He was born in Thebes, was a disciple of Diogenes, and also knew Alexander. His father, Ascondas, was rich and left him two hundred talents. One day he went to see a tragedy of Euripides, he felt inspired to the emergence of Telephus.'
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Images', 'elevation' ),
					'param_name' => 'right_image',
					'value' => ELEVATION_THEME_DIRECTORY . '/images/difference.jpg',
					"admin_label" => true,
					'description' => esc_html__( 'Select image from media library.', 'elevation' )
				),

				array(
			    	"type" => "textfield",
			    	"heading" => esc_html__("Learn More Button", 'elevation'),
			    	"param_name" => "learn_more_title",
			    	'value' => 'Learn More',
			    	'description' => 'Type Learn More Title'
			    	),
			    array(
			    	"type" => "textfield",
			    	'heading'      => esc_html__( 'Learn More Button URL', 'elevation' ),
			    	"param_name" => "learn_more_url",
			    	"value" => "#",
			    	'description' => 'Type URL of Learn More.'
			    	),		    	
			    array(
			    	"type" => "textfield",
			    	"heading" => esc_html__("Donate Button", 'elevation'),
			    	"param_name" => "donate_title",
			    	'value' => 'Help by Donate for Causes',
			    	'description' => 'Type Donate Title'
			    	),
			    array(
			    	"type" => "textfield",
			    	'heading'      => esc_html__( 'Donate Button URL', 'elevation' ),
			    	"param_name" => "donate_url",
			    	"value" => "#",
			    	'description' => 'Type URL of Donate.'
			    	)
				

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_vc_content_image_block_shortcode_vc' );