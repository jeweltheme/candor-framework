<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_section_title_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => 'Welcome to Shopaholic',
				'subtitle' => 'There was a tray of drinks on a table beside him, from which he filled himself a stiff whisky and soda. He drank it off in three gulps, and cracked the glass as he set it down.'
			), $atts 
		) 
	);
	
	$output = '<div class="section-heading-title text-center">
					<div class="section-top">
						<h3 class="section-title text-center">'. strip_tags(trim($title)) .'<span></span></h3><!-- /.section-title -->
					</div><!-- /.section-top -->
					<p class="section-description">'. strip_tags(trim($subtitle)) .'</p><!-- /.section-description -->
				</div>';
	
	return $output;
}
add_shortcode( 'section_title', 'candor_framework_shopaholic_section_title_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_section_title_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Section Title", 'shopaholic-wp'),
			"base" => "section_title",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => esc_html__('Section Title and Description.', 'shopaholic-wp'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'shopaholic-wp'),
					"param_name" => "title",
					'holder' => 'div',
					'value' => 'Welcome to Shopaholic',
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'shopaholic-wp'),
					"param_name" => "subtitle",
					'value' => 'There was a tray of drinks on a table beside him, from which he filled himself a stiff whisky and soda. He drank it off in three gulps, and cracked the glass as he set it down.',
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_section_title_shortcode_vc' );