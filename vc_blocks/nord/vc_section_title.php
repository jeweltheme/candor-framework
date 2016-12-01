<?php 

/**
 * The Shortcode
 */
function candor_nord_section_title_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' 			=> 'Services'
			), $atts 
		) 
	);
	
	$output = '<div class="container">
					<div class="row">
						<div class="row add-top-half">
	                      	<div class="text-left">
	                        	<h4 class="font2 silver">'. esc_attr($title) .'</h4><br/>
	                      	</div>
		                </div>
		            </div>
		        </div>';


	return $output;
}
add_shortcode( 'nord_section_title', 'candor_nord_section_title_shortcode' );



/**
 * The VC Functions
 */
function candor_nord_section_title_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => esc_html__("Section Title", 'nord'),
			"base" => "nord_section_title",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => esc_html__('Section Title of Content Block', 'nord'),
			"params" => array(
				
				// params group
				array(
						"type" => "textfield",
						"heading" => __("Section Title", 'nord'),
						"param_name" => "title",
						'holder' => 'div',
						'value' => 'Services',
					)

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_nord_section_title_shortcode_vc' );