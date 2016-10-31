<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_features_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'			=> 'FREE SHIPPING',
				'feature_icon'	=> 'fa-mobile-phone',
				'style'			=> '1',
				'short_desc'	=> 'But from the first I was disappointed with it. In about a week I was tired of seeing sights'
			), $atts 
		) 
	);


	ob_start();
	$features = vc_param_group_parse_atts( $atts['features'] );
?>

  <section class="features features-0<?php echo esc_attr( $style );?>">
    <div class="section-padding">
      <div class="container">
        <div class="row">


        <?php foreach ($features as $key => $value ) {?>

          <div class="col-md-4">
          	<div class="item media style-<?php if($style == '2') echo '2';?>">
              <div class="item-icon media-left pull-left">
                <i class="<?php echo esc_attr( $value['feature_icon'] );?>"></i>
              </div><!-- /.item-title -->
              <div class="item-details media-body">
                <h3 class="item-title"><?php echo esc_attr( $value['title'] );?> </h3><!-- /.item-title -->
                <p class="description">
                  <?php echo esc_attr( $value['short_desc'] );?>
                </p><!-- /.description -->
              </div><!-- /.item-details -->
            </div><!-- /.item -->
          </div>


		<?php } ?>


        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.section-padding -->
  </section><!-- /.features -->

            
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_features', 'candor_framework_shopaholic_features_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_features_shortcode_vc() {

	vc_map(
	    array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Features", 'shopaholic-wp'),
			"base" => "shopaholic_features",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Features',
	        'params' => array(

	            // params group
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'param_name' => 'features',
	                // Note params is mapped inside param-group:
	                'params' => array(
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
							'value' => 'FREE SHIPPING',
						),				
						array(
							"type" => "textarea",
							"heading" => esc_html__("Short Description", 'elevation'),
							"param_name" => "short_desc",
							'holder' => 'div',
							'value'	=> 'But from the first I was disappointed with it. In about a week I was tired of seeing sights'
						),	
	                )
	            ),

				array(
					"type" => "dropdown",
					"heading" => __("Style", 'shopaholic-wp'),
					"param_name" => "style",
					"value" => array(
						'Style 1' => '1',
						'Style 2' => '2',
						'Style 3' => '3'
						),
				),

	        )
	    )
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_features_shortcode_vc');