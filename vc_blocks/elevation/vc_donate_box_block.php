<?php 

/**
 * The Shortcode
 */
function candor_donate_box_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'donate_title' 			=> 'Fund Raising',
				'donate_icon' 			=> 'fa fa-money',
				'donate_bg_color' 		=> '#f39c12',
				'donate_button_title' 	=> 'Help Now',
				'donate_button_url' 	=> '#',
			), $atts 
		) 
	);
	
	$output = '<div class="section-details">
	              <div class="help-details">
	                <div class="item">
	                  <div class="item-inner">
	                    <div class="item-icon">
	                      <i class="icon '. esc_attr($donate_icon) .'"></i>
	                    </div><!-- /.item-icon -->
	                    <h4 class="item-title">'. strip_tags($donate_title ) .'</h4><!-- /.item-title -->
	                    <p class="item-description">'. wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</p><!-- /.item-description -->
	                    <div class="btn-container">
	                      <a href="'. esc_url_raw($donate_button_url) .'" class="btn btn-xsm">'. esc_attr($donate_button_title) .'</a>
	                    </div><!-- /.btn-container -->
	                  </div><!-- /.item-inner -->
	                </div>
	              </div>
	            </div>';
	
	return $output;
}
add_shortcode( 'elevation_donate_box', 'candor_donate_box_shortcode' );



/**
 * The VC Functions
 */
function candor_donate_box_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => esc_html__("Donate Box", 'elevation'),
			"base" => "elevation_donate_box",
			'description' => 'Show Donate Box Options.',
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			"params" => array(
				array(
					'type'         => 'iconpicker',
					'heading'      => esc_html__( 'Icon', 'elevation' ),
					'param_name'   => 'donate_icon',
					'value'        => 'fa fa-money',
					'settings'     => array(
							           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
							           'iconsPerPage' => 100, // default 100, how many icons per/page to display
							           ),
					'description'  => esc_html__( 'Select icon from library.', 'elevation' ),
					),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'elevation'),
					"param_name" => "donate_title",
					'holder' => 'div',
					'value'	=> 'Fund Raising'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'elevation'),
					"param_name" => "content",
					'holder' => 'div',
					'value'	=> 'Fund raising events are really a win-win situation, the public likes getting involved in activities that help others and worth causes or individuals benefit from the effort.'
				),				
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Background Color", 'elevation'),
					"param_name" => "donate_bg_color",
					'value'	=> '#f39c12'					
				),				
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Hover Color", 'elevation'),
					"param_name" => "donate_bg_hover_color",
					'value'	=> '#f39c12'					
				),
				array(
			    	"type" => "textfield",
			    	"heading" => esc_html__("Button Title", 'elevation'),
			    	"param_name" => "donate_button_title",
			    	'value' => 'Help Now',
			    	'description' => 'Type Button Title'
			    	),
			    array(
			    	"type" => "textfield",
			    	'heading'      => esc_html__( 'Donate Button URL', 'elevation' ),
			    	"param_name" => "donate_button_url",
			    	"value" => "#",
			    	'description' => 'Type URL of Donate Button.'
			    	)


			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_donate_box_shortcode_vc' );