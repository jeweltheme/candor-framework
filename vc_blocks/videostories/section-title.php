<?php 

/**
 * The Shortcode
 */
function candor_framework_videstories_section_title_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => 'Contact Us'
			), $atts 
		) 
	);
	
	$output = '<h2 class="section-title">'. strip_tags(trim($title)) .'</h2><!-- /.section-title -->';
	
	return $output;
}
add_shortcode( 'videostories_section_title', 'candor_framework_videstories_section_title_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_videstories_section_title_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => __("Section Title", 'videstories'),
			"base" => "videostories_section_title",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'videstories'),
					"param_name" => "title",
					'holder' => 'div',
					'value' => 'Contact Us',
				)

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_videstories_section_title_shortcode_vc' );