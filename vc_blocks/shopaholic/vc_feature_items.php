<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_feature_items_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(

				'title'			=> 'Clean & modern design',
				'feature_icon'	=> 'fa-mobile-phone'
			), $atts 
		) 
	);


	ob_start();
?>

    <div class="item media">
      <div class="item-icon media-left">
        <span class="fa <?php echo esc_html__($feature_icon);?>"></span>
      </div><!-- /.item-icon -->
      <div class="item-details media-body">
        <h3 class="item-title"><?php echo esc_html__($title);?></h3><!-- /.item-title -->
      </div><!-- /.item-details -->
    </div><!-- /.item -->
            
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_service_feature', 'candor_framework_shopaholic_feature_items_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_feature_items_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Service Feature", 'shopaholic-wp'),
			"base" => "shopaholic_service_feature",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Services Features',
			"params" => array(

				array(
					'type'         => 'iconpicker',
					'heading'      => esc_html__( 'Icon', 'elevation' ),
					'param_name'   => 'feature_icon',
					'value'        => 'fa-mobile-phone',
					'settings'     => array(
							           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
							           'iconsPerPage' => 100, // default 100, how many icons per/page to display
							           ),
					'description'  => esc_html__( 'Select icon from library.', 'elevation' ),
					),
				array(
					"type" => "textfield",
					"heading" => __("Title", 'shopaholic-wp'),
					"param_name" => "title",
					'value' => 'Clean & modern design',
				),

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_feature_items_shortcode_vc');