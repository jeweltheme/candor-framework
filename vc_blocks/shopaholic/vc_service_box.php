<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_service_box_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' 		=> 'Designing',
				'service_icon' 	=> 'icon-picture',
			), $atts 
		) 
	);

	//print_r($service_icon);

	$output = '<div class="core-services text-center">
			        	<div class="item media">
			        		<div class="item-icon media-left">
			        			<span class="' . str_replace("fa ", "", $service_icon) . '"></span>
			        		</div><!-- /.item-icon -->
			        		<div class="item-details media-body">
			        			<h3 class="item-title">'. strip_tags(trim($title)) .'</h3><!-- /.item-title -->
			        			<p class="description">'. wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</p><!-- /.description -->
			        		</div><!-- /.item-details -->
			        	</div><!-- /.item -->
		        </div>';
	
	wp_enqueue_style( 'shopaholic-service', SHOPAHOLIC_CSS . 'pages/service.css', SHOPAHOLIC_VER );

	return $output;

}
add_shortcode( 'shopaholic_service_box', 'candor_framework_shopaholic_service_box_shortcode' );



/**
 * The VC Functions
 */
function candor_framework_shopaholic_service_box_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => esc_html__("Service Box", 'shopaholic-wp'),
			"base" => "shopaholic_service_box",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			"params" => array(
				array(
					'type'         => 'dropdown',
					'heading'      => esc_html__( 'Icon library', 'shopaholic-wp' ),
					'param_name'   => 'service_icon',
					'value'     => array(
							__( 'Font Awesome', 'shopaholic-wp' ) => 'fontawesome',
							__( 'Open Iconic', 'shopaholic-wp' )  => 'openiconic',
							__( 'Typicons', 'shopaholic-wp' )     => 'typicons',
							__( 'Entypo', 'shopaholic-wp' )       => 'entypo',
							__( 'Linecons', 'shopaholic-wp' )     => 'linecons',
							__( 'Plain Icon', 'shopaholic-wp' )   => 'plainicon',
						),
					'settings'     => array(
			           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
			           'iconsPerPage' => 100, // default 100, how many icons per/page to display
			           ),
					'description'  => esc_html__( 'Select icon from library.', 'shopaholic-wp' ),
					),
				array(
					'type'         => 'iconpicker',
					'heading'      => __( 'Icon', 'plain' ),
					'param_name'   => 'icon_fontawesome',
					'value'        => 'fa fa-facebook',
					'settings'     => array(
				         'emptyIcon'    => false, // default true, display an "EMPTY" icon?
				         'iconsPerPage' => 200, // default 100, how many icons per/page to display
				         ),
					'dependency'   => array(
						'element'   => 'service_icon',
						'value'     => 'fontawesome',
						),
					'description'  => __( 'Select icon from library.', 'plain' ),
					),
			   array(
				      'type'         => 'iconpicker',
				      'heading'      => __( 'Icon', 'plain' ),
				      'param_name'   => 'icon_linecons',
				      'settings'     => array(
				         'emptyIcon'    => false, // default true, display an "EMPTY" icon?
				         'type'         => 'linecons',
				         'iconsPerPage' => 200, // default 100, how many icons per/page to display
				      ),
				      'dependency'   => array(
				         'element'   => 'service_icon',
				         'value'     => 'linecons',
				      ),
				      'description'  => __( 'Select icon from library.', 'plain' ),
			   ),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'shopaholic-wp'),
					"param_name" => "title",
					'holder' => 'div',
					'value'	=> 'Designing'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'shopaholic-wp'),
					"param_name" => "content",
					'holder' => 'div',
					'value'	=> 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum'
				)

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_service_box_shortcode_vc' );