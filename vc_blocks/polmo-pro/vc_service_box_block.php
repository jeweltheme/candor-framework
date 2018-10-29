<?php 

/**
 * The Shortcode
 */
function candor_polmo_service_box_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => 'Android Apps Developement',
				'service_icon' => 'fa fa-android',
				'bg_color' => '#e74c3c',
				//'content'	=> 'Atoms dimensions approximately determined with one fifty-millionth an inch in diameter.'
			), $atts 
		) 
	);

	$output = '<div class="section-details">
		<div class="service-details">
			<div class="item wow animated fadeInLeft" data-wow-delay=".5s" style="border: 1px solid ' .  $bg_color. '; background-color: ' . $bg_color . ';">
				<div class="item-icon" style="color: ' .  $bg_color. '">
					<i class="fa ' . esc_attr($service_icon). '"></i>
				</div><!-- /.item-icon -->
				<div class="item-details">
					<h4 class="item-title">' . $title. '</h4><!-- /.item-title -->
					<p class="item-description">' . wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</p>
				</div><!-- /.item-details -->
			</div><!-- /.item -->
		</div>
	</div>';



	return $output;
}
add_shortcode( 'polmo_pro_service_box', 'candor_polmo_service_box_shortcode' );


/**
 * The VC Functions
 */
function candor_polmo_service_box_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'polmo-pro-vc-block',
			"name" => esc_html__("Service Box", 'polmo-pro'),
			"base" => "polmo_pro_service_box",
			"category" => esc_html__('Polmo Pro WP Theme', 'polmo-pro'),
			"params" => array(
				array(
					'type'         => 'iconpicker',
					'heading'      => esc_html__( 'Icon', 'polmo-pro' ),
					'param_name'   => 'service_icon',
					'value'        => 'fa fa-android',
					'settings'     => array(
							           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
							           'iconsPerPage' => 100, // default 100, how many icons per/page to display
							           ),
					'description'  => esc_html__( 'Select icon from library.', 'polmo-pro' ),
					),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'polmo-pro'),
					"param_name" => "title",
					'holder' => 'div',
					'value'	=> 'Android Apps Developement'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'polmo-pro'),
					"param_name" => "content",
					'holder' => 'div',
					"class" => "",
					"description" => __( "Enter your content.", 'polmo-pro'),
					'value'	=> 'Atoms dimensions approximately determined with one fifty-millionth an inch in diameter.'
				),				
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Background Color", 'polmo-pro'),
					"param_name" => "bg_color",
					'value'	=> '#e74c3c'					
				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_polmo_service_box_shortcode_vc' );