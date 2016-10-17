<?php 

/**
 * The Shortcode
 */
function candor_framework_section_title_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => 'Polmo Core Services',
				'subtitle' => 'Matter is made up of atoms having dimensions approximately determined to be in the neighbourhood of the one fifty-millionth of an inch in diameter.'
			), $atts 
		) 
	);
	
	$output = '<div class="section-top wow animated fadeInUp text-center" data-wow-delay=".5s">
				<h2 class="section-title">'. strip_tags(trim($title)) .'</h2><!-- /.section-title -->
                <p class="section-description">'. strip_tags(trim($subtitle)) .'</p><!-- /.description -->
               </div>';
	
	return $output;
}
add_shortcode( 'polmo_section_title', 'candor_framework_section_title_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_section_title_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'polmo-pro-vc-block',
			"name" => __("Section Title", 'polmo-pro'),
			"base" => "polmo_section_title",
			"category" => esc_html__('Polmo Pro WP Theme', 'polmo-pro'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'polmo-pro'),
					"param_name" => "title",
					'holder' => 'h2',
					'value' => 'Polmo Core Services',
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'polmo-pro'),
					"param_name" => "subtitle",
					'value' => 'Matter is made up of atoms having dimensions approximately determined to be in the neighbourhood of the one fifty-millionth of an inch in diameter.',
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_section_title_shortcode_vc' );