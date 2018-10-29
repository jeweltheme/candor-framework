<?php 

/**
 * The Shortcode
 */
function candor_framework_content_button_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'btn_title' => 'Learn More',
				'btn_link' => '#'
			), $atts 
		) 
	);
	
	$output = '<div class="btn-container">
                  <a href="'. $btn_link .'" class="btn read-more">'. $btn_title .'</a>
                </div><!-- /.btn-container -->';
	
	return $output;
}
add_shortcode( 'polmo_content_button', 'candor_framework_content_button_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_content_button_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'polmo-pro-vc-block',
			"name" => __("Button", 'polmo-pro'),
			"base" => "polmo_content_button",
			"category" => esc_html__('Polmo Pro WP Theme', 'polmo-pro'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Button Text", 'polmo-pro'),
					"param_name" => "btn_title",
					'holder' => 'div',
					'value' => 'Learn More',
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Link", 'polmo-pro'),
					"param_name" => "btn_link",
					'holder' => 'div',
					'value' => '#',
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_content_button_shortcode_vc' );