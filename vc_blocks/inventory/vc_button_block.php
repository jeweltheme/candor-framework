<?php 

/**
 * The Shortcode
 */
function candor_inventory_button_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'button_text' 			=> 'Get Started Now',
				'button_link' 			=> '#'
			), $atts 
		) 
	);
	
	$output = '<div class="row">
        <div class="col-md-12">
            <div class="text-center margin-lg-t115 margin-lg-b150  margin-sm-b100"><a href="'. esc_attr($button_link) .'" class="inv-btn inv-btn-big">'. esc_attr($button_text) .' <i class="fa fa-arrow-right"></i></a></div>
        </div>
    </div>';


	return $output;
}
add_shortcode( 'inventory_button', 'candor_inventory_button_shortcode' );



/**
 * The VC Functions
 */
function candor_inventory_button_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'inventory-vc-block',
			"name" => esc_html__("Button", 'inventory'),
			"base" => "inventory_button",
			"category" => esc_html__('Inventory WP Theme', 'inventory'),
			'description' => esc_html__('Button Block', 'inventory'),
			"params" => array(
			
				array(
						"type" => "textfield",
						"heading" => __("Button Text", 'inventory'),
						"param_name" => "button_text",
						'holder' => 'div',
						'value' => 'Get Started Now ',
					),
				array(
						"type" => "textfield",
						"heading" => __("Button Link", 'inventory'),
						"param_name" => "button_link",
						'holder' => 'div',
						'value' => '#',
					),

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_inventory_button_shortcode_vc' );