<?php 

/**
 * The Shortcode
 */
function candor_framework_section_title_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => 'Volunteers',
				'subtitle' => 'Meet our chairman, vice chairman, secretary,  and other member who helps to run our organization. This non profit organization is stand for all volunteers hard work.'
			), $atts 
		) 
	);
	
	$output = '<div class="text-center ">
					<div class="section-top">
						<h2 class="section-title">'. strip_tags(trim($title)) .'</h2>
						<p class="section-description">'. strip_tags(trim($subtitle)) .'</p>
					</div>

					<div class="section-border">
						<div class="border-style">
							<span></span>
						</div>
					</div>
				</div>';
	
	return $output;
}
add_shortcode( 'elevation_section_title', 'candor_framework_section_title_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_section_title_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => __("Section Title", 'elevation'),
			"base" => "elevation_section_title",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'elevation'),
					"param_name" => "title",
					'holder' => 'div',
					'value' => 'Volunteers',
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'elevation'),
					"param_name" => "subtitle",
					'value' => 'Meet our chairman, vice chairman, secretary,  and other member who helps to run our organization. This non profit organization is stand for all volunteers hard work.',
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_section_title_shortcode_vc' );