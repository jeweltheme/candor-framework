<?php 

/**
 * The Shortcode
 */
function candor_framework_elevation_page_title_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => 'Our Blog',
				'subtitle' => 'Latin poetry begins where all poetry begins in the rude ceremonial of a primitive people placating and dreaded spiritual world.'
			), $atts 
		) 
	);
	
	$output = elevation_page_title( strip_tags(trim($title)), strip_tags(trim($subtitle)) );
	
	return $output;
}
add_shortcode( 'elevation_page_title', 'candor_framework_elevation_page_title_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_elevation_page_title_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => esc_html__("Page Title", 'elevation'),
			"base" => "elevation_page_title",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'elevation'),
					"param_name" => "title",
					'holder' => 'div',
					"value" => esc_html__('Our Blog', 'elevation')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'elevation'),
					"param_name" => "subtitle",
					"value" => esc_html__('Latin poetry begins where all poetry begins in the rude ceremonial of a primitive people placating and dreaded spiritual world.', 'elevation')
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_elevation_page_title_shortcode_vc' );