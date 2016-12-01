<?php 

/**
 * The Shortcode
 */
function candor_service_box_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => 'Volunteering',
				'service_icon' => 'fa fa-bullhorn',
				'bg_color' => '#f39c12',
			), $atts 
		) 
	);
	
	$output = '<div class="about-details">
	                <div class="item text-center ' . str_replace("fa ", "", $service_icon) . '" style="background-color:' . $bg_color . '">
	                  <div class="item-icon"><i class="'. esc_attr($service_icon) .'"></i></div>
	                  <h4 class="item-title">'. strip_tags(trim($title)) .'</h4>
	                  <p class="description">'. wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</p>
	                </div>
		        </div>';
	
	return $output;
}
add_shortcode( 'elevation_service_box', 'candor_service_box_shortcode' );



/**
 * The VC Functions
 */
function candor_service_box_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => esc_html__("Service Box", 'elevation'),
			"base" => "elevation_service_box",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			"params" => array(
				array(
					'type'         => 'iconpicker',
					'heading'      => esc_html__( 'Icon', 'elevation' ),
					'param_name'   => 'service_icon',
					'value'        => 'fa fa-bullhorn',
					'settings'     => array(
							           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
							           'iconsPerPage' => 100, // default 100, how many icons per/page to display
							           ),
					'description'  => esc_html__( 'Select icon from library.', 'elevation' ),
					),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'elevation'),
					"param_name" => "title",
					'holder' => 'div',
					'value'	=> 'Volunteering'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'elevation'),
					"param_name" => "content",
					'holder' => 'div',
					'value'	=> 'Our volunteers believe that they have to work free. They always fell happy to do something for the world.'
				),				
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Background Color", 'elevation'),
					"param_name" => "bg_color",
					'value'	=> '#f39c12'					
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_service_box_shortcode_vc' );