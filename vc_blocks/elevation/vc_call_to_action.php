<?php 

/**
 * The Shortcode
 */

function candor_vc_call_to_action_shortcode( $atts, $feature_right_box_content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'call_to_action_volunteer_title' 	=> 'Help by Become a Volunteer',
				'call_to_action_volunteer_url' 		=> '#',
				'call_to_action_causes_title' 		=> 'Help by Donate for Causes',
				'call_to_action_causes_url' 		=> '#'
			), $atts 
		) 
	);

	$output = '<div id="action" class="action text-center" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="0.4">
		<div class="container">
			<a href="'. esc_attr($call_to_action_volunteer_url) .'" class="btn">'. esc_attr($call_to_action_volunteer_title) .'</a>
			<span class="">or</span> 
			<a href="'. esc_attr($call_to_action_causes_url) .'" class="btn">'. esc_attr($call_to_action_causes_title) .'</a>
		</div>
    </div>';
	
	return $output;
}
add_shortcode( 'elevation_call_to_action', 'candor_vc_call_to_action_shortcode' );


/**
 * The VC Functions
 */
function candor_vc_call_to_action_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => esc_html__("Call To Action", 'elevation'),
			"base" => "elevation_call_to_action",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			'description' => 'Show Call to Action options.',
			"params" => array(
		    	array(
			    	"type" => "textfield",
			    	"heading" => esc_html__("Volunteer Title", 'elevation'),
			    	"param_name" => "call_to_action_volunteer_title",
			    	'value' => 'Help by Become a Volunteer',
			    	'description' => 'Type Volunteer Title'
			    	),
			    array(
			    	"type" => "textfield",
			    	'heading'      => esc_html__( 'Volunteer URL', 'elevation' ),
			    	"param_name" => "call_to_action_volunteer_url",
			    	"value" => "#",
			    	'description' => 'Type URL of Volunteer.'
			    	),		    	
			    array(
			    	"type" => "textfield",
			    	"heading" => esc_html__("Causes Title", 'elevation'),
			    	"param_name" => "call_to_action_causes_title",
			    	'value' => 'Help by Donate for Causes',
			    	'description' => 'Type Causes Title'
			    	),
			    array(
			    	"type" => "textfield",
			    	'heading'      => esc_html__( 'Causes URL', 'elevation' ),
			    	"param_name" => "call_to_action_causes_url",
			    	"value" => "#",
			    	'description' => 'Type URL of Causes.'
			    	)

			)
		)

	);
	}
	
add_action( 'vc_before_init', 'candor_vc_call_to_action_shortcode_vc');