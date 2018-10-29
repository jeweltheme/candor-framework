<?php 

/**
 * The Shortcode
 */
function candor_framework_content_title_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'content_title' => 'We are Polmo Limited Creative Web Agency'
			), $atts 
		) 
	);
	
	$output = '<h2 class="section-title">'. $content_title .'</h2>';
	
	return $output;
}
add_shortcode( 'polmo_content_title', 'candor_framework_content_title_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_content_title_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'polmo-pro-vc-block',
			"name" => __("Content Title", 'polmo-pro'),
			"base" => "polmo_content_title",
			"category" => esc_html__('Polmo Pro WP Theme', 'polmo-pro'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'polmo-pro'),
					"param_name" => "content_title",
					'holder' => 'div',
					'value' => 'We are Polmo Limited Creative Web Agency',
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_content_title_shortcode_vc' );