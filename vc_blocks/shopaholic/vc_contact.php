<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_contact_details_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'contact_icon' 		=> 'fa-shopping-cart',
				'contact_title' 	=> 'Phone',
		
			), $atts 
		) 
	);
	
	$output = '<div class="contact-section item text-center">
				<div class="item-icon"><span class="'. esc_attr($contact_icon) .'"></span></div><!-- /.item-icon -->
					<div class="item-details">
						<h4 class="item-title">'. esc_attr($contact_title) .'</h4><!-- /.item-title -->
						<span class="details">'. wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</span><!-- /.details -->
					</div>
				</div>';
	
	return $output;
}
add_shortcode( 'shopaholic_contact_box', 'candor_framework_shopaholic_contact_details_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_contact_details_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Contact Box", 'shopaholic-wp'),
			"base" => "shopaholic_contact_box",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Counter Parts on Contact Section.',
			"params" => array(

				array(
					'type'         => 'iconpicker',
					'heading'      => esc_html__( 'Icon', 'shopaholic-wp' ),
					'param_name'   => 'contact_icon',
					'value'        => 'fa-shopping-cart',
					'settings'     => array(
							           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
							           'iconsPerPage' => 100, // default 100, how many icons per/page to display
							           ),
					'description'  => esc_html__( 'Select icon from library.', 'shopaholic-wp' ),
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", 'shopaholic-wp'),
					"param_name" => "contact_title",
					'holder' => 'div',
					'value' => 'Phone',
				),					
				array(
					"type" => "textarea_html",
					"heading" => __("Counter Details", 'shopaholic-wp'),
					"param_name" => "content",
					'holder' => 'div',
					'value' => '+61 3 8376 6284 (Office Time: 09:00 - 16:00)<br>
                  				+61 3 8743 2309 (24 Hours)',
				),


			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_contact_details_shortcode_vc' );