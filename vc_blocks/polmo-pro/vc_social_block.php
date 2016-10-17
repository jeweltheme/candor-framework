<?php 

/**
* The Shortcode
*/


function candor_framework_polmo_pro_social_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'social_icon' 		=> 'fa fa-facebook',
				'social_network' 	=> 'twitter',
				'social_follower' 	=> 'Followers',
				'social_bg_color'	=> '#3b5998'
			), $atts 
		) 
	);

          $output = '<div class="social-item wow animated fadeInRight" data-wow-delay=".75s" style="background-color:'. esc_attr($social_bg_color) .'">
            <div class="section-padding">
              <div class="social-icon">
                <i class="fa '. esc_attr($social_icon) .'"></i>
              </div><!-- /.social-icon -->
              <div class="countdown">
                <span class="count-number counter">'. wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode('[scp code="'. esc_attr($social_network) .'"]'))) .'</span>
              </div><!-- /.coundown -->
              <span class="about-item">'. strip_tags(trim($social_follower)) .'</span>
            </div><!-- /.section-padding -->
          </div><!-- /.social-item -->';

	return $output;
}
add_shortcode( 'polmo_social', 'candor_framework_polmo_pro_social_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_polmo_pro_social_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'polmo-pro-vc-block',
			"name" => esc_html__("Social Followers", 'polmo-pro'),
			"base" => "polmo_social",
			"category" => esc_html__('Polmo Pro WP Theme', 'polmo-pro'),
			'description' => 'Show Social Followers layout options.',
			"params" => array(
				array(
					'type'         => 'iconpicker',
					'heading'      => esc_html__( 'Icon', 'polmo-pro' ),
					'param_name'   => 'social_icon',
					'value'        => 'fa fa-facebook',
					'settings'     => array(
							           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
							           'iconsPerPage' => 100, // default 100, how many icons per/page to display
							           ),
					'description'  => esc_html__( 'Select icon from library.', 'polmo-pro' ),
					),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Social Website Name", 'elevation'),
					"param_name" => "social_network",
					'value' => array(
						__( 'Facebook', 'polmo-pro' ) 		=> 'facebook',
						__( 'Twitter', 'polmo-pro' ) 		=> 'twitter',
						__( 'Github', 'polmo-pro' ) 		=> 'github',
						__( 'Google Plus', 'polmo-pro' ) 	=> 'googleplus',
						__( 'Instagram', 'polmo-pro' ) 		=> 'instagram',
						__( 'Linkedin', 'polmo-pro' ) 		=> 'linkedin',
						__( 'Pinterest', 'polmo-pro' ) 		=> 'pinterest',
						__( 'Posts', 'polmo-pro' ) 			=> 'posts',
						__( 'Soundcloud', 'polmo-pro' ) 	=> 'soundcloud',
						__( 'Steam', 'polmo-pro' ) 			=> 'steam',
						__( 'Tumblr', 'polmo-pro' ) 		=> 'tumblr',
						__( 'Twitch', 'polmo-pro' ) 		=> 'twitch',
						__( 'Users', 'polmo-pro' ) 			=> 'users',
						__( 'Vimeo', 'polmo-pro' ) 			=> 'vimeo',
						__( 'Youtube', 'polmo-pro' ) 		=> 'youtube'
						),
					'save_always' => true,
					'description' => __( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'polmo-pro' )
					),
				array(
					"type" => "textfield",
					"heading" => __("Follower Text", 'elevation'),
					"param_name" => "social_follower",
					"value" => 'Followers'
					),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Background Color", 'polmo-pro'),
					"param_name" => "social_bg_color",
					'value'	=> '#3b5998'					
					)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_polmo_pro_social_shortcode_vc');