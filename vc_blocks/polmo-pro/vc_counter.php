<?php 

/**
 * The Shortcode
 */
function candor_framework_polmo_counter_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'count_serial_no' 	=> '1',
				'counter_icon' 		=> 'fa fa-wifi',
				'count_number' 		=> '1,203',
				'count_desc' 		=> 'Wifi Zones',
				'counter_bg_color' 	=> '#e6675a'
			), $atts 
		) 
	);
	
	$output = '<div class="about-breifing" style="background:'. esc_attr($counter_bg_color) .'">
				<div class="item media wow animated fadeInLeft" data-wow-delay=".35s">
		            <div class="section-padding">
		              <div class="item-no media-left">
		                <span class="count text-right">'. esc_attr($count_serial_no) .'</span>
		              </div><!-- /.item-no -->
		              <div class="item-details media-body text-center">
		                <div class="item-icon">
		                  <i class="fa '. esc_attr($counter_icon) .'"></i>
		                </div><!-- /.item-icon -->
		                <div class="countdown">
		                  <span class="count-number counter">'. esc_attr($count_number) .'</span>
		                </div><!-- /.coundown -->
		                <span class="about-item">'. esc_attr($count_desc) .'</span>
		              </div><!-- /.item-details -->
		            </div><!-- /.section-padding -->
		        </div><!-- /.item -->
		      </div>';
	
	return $output;
}
add_shortcode( 'polmo_counter', 'candor_framework_polmo_counter_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_polmo_counter_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'polmo-pro-vc-block',
			"name" => __("Counter", 'polmo-pro'),
			"base" => "polmo_counter",
			"category" => esc_html__('Polmo Pro WP Theme', 'polmo-pro'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Counter Serial No.", 'polmo-pro'),
					"param_name" => "count_serial_no",
					'holder' => 'div',
					'value' => '1',
				),
				array(
					'type'         => 'iconpicker',
					'heading'      => esc_html__( 'Icon', 'polmo-pro' ),
					'param_name'   => 'counter_icon',
					'value'        => 'fa fa-wifi',
					'settings'     => array(
							           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
							           'iconsPerPage' => 100, // default 100, how many icons per/page to display
							           ),
					'description'  => esc_html__( 'Select icon from library.', 'polmo-pro' ),
				),
				array(
					"type" => "textfield",
					"heading" => __("Counter Number", 'polmo-pro'),
					"param_name" => "count_number",
					'holder' => 'div',
					'value' => '1,203',
				),				
				array(
					"type" => "textfield",
					"heading" => __("Counter Desc", 'polmo-pro'),
					"param_name" => "count_desc",
					'holder' => 'div',
					'value' => 'Wifi Zones',
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Background Color", 'polmo-pro'),
					"param_name" => "counter_bg_color",
					'value'	=> '#e6675a'					
				),


			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_polmo_counter_shortcode_vc' );