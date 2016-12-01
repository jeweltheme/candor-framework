<?php 

/**
 * The Shortcode
 */
function candor_framework_nord_contact_details_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'contact_email' 		=> 'hello@nord.tld',
		
			), $atts 
		) 
	);
	
	$output = '<div class="container add-top-half"><h3 class="dark font2 font2ultralight">
	            <span class="black font3">'. esc_attr($contact_email) .'</span> '. wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content, true ))) .'</h3></div>';
	
	return $output;
}
add_shortcode( 'nord_contact_info', 'candor_framework_nord_contact_details_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_nord_contact_details_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => __("Contact Info", 'nord'),
			"base" => "nord_contact_info",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => 'Show Counter Parts on Contact Section.',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Email", 'nord'),
					"param_name" => "contact_email",
					'holder' => 'div',
					'value' => 'hello@nord.tld',
				),					
				array(
					"type" => "textarea_html",
					"heading" => __("Counter Details", 'nord'),
					"param_name" => "content",
					'holder' => 'div',
					'value' => 'NORD STUDIO. #6 POSIDON ENCLAVE.<br>
								VANCOUVER. CANADA<br>
								+123.456.789',
				),


			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_nord_contact_details_shortcode_vc' );