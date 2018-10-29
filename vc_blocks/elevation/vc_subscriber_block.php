<?php 

/**
 * The Shortcode
 */

function candor_vc_subscribe_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'subscribe_title' 	=> 'Subscribe newsletter',
				'mailchimp_form_id' => '1977'
			), $atts 
		) 
	);

	$output = '<section id="subscribe">
          <div class="parallax-style">
            <div class="section-padding">
              <div class="container">
                <div class="section-details">
                  <div class="col-md-4">
                    <h4 class="section-sub-title">' . esc_attr( $subscribe_title ) . '</h4>
                  </div>
                  <div class="col-md-8">' . do_shortcode('[mc4wp_form id="' . esc_attr( $mailchimp_form_id ) . '"]') . '</div>
                </div><!-- /.section-details -->
              </div><!-- /.container -->
            </div><!-- /.section-padding -->
          </div><!-- /.parallax-style -->
        </section><!-- /#subscribe -->';
	
	return $output;
}
add_shortcode( 'elevation_subscribe_block', 'candor_vc_subscribe_block_shortcode' );


/**
 * The VC Functions
 */
function candor_subscribe_block_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => esc_html__("Subscribe Box", 'elevation'),
			"base" => "elevation_subscribe_block",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			'description' => 'Show Subscribe Options.',
			"params" => array(
		    	array(
			    	"type" => "textfield",
			    	"heading" => esc_html__("Subscribe Title", 'elevation'),
			    	"param_name" => "subscribe_title",
			    	'value' => 'Subscribe newsletter',
			    	'description' => 'Type Subscribe Title here'
			    	),
			    array(
			    	"type" => "textfield",
			    	'heading'      => esc_html__( 'Mailchimp Form ID', 'elevation' ),
			    	"param_name" => "mailchimp_form_id",
			    	"value" => "1977",
			    	'description' => 'Type Mailchimp Form ID.'
			    	)

				)
			)
		);
	}
	
add_action( 'vc_before_init', 'candor_subscribe_block_shortcode_vc');