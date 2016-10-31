<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_counter_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'count_serial_no' 	=> '1',
				'counter_icon' 		=> 'fa-shopping-cart',
				'count_number' 		=> '1,203',
				'count_symbol' 		=> 'K+',
				'count_desc' 		=> 'Products available',
			), $atts 
		) 
	);
	
	ob_start();
	$counter_part = vc_param_group_parse_atts( $atts['counter_part'] );

	?>

<div class="row">
  <section class="facts fact-1">
    <div class="section-padding">
      <div class="container">
        <div class="row">
          	<div class="countdown">
				<?php foreach ($counter_part as $key => $value ) {?>

		            <div class="col-md-3 col-sm-6">
		              <div class="item media">
		                <div class="item-icon media-left">
		                  <i class="<?php echo esc_attr( $value['counter_icon'] );?>"></i>  
		                </div><!-- /.item-icon -->

		                <div class="media-body">
		                  <div class="count-inner">
		                    <span class="count-number counter"><?php echo esc_attr( $value['count_number'] );?></span>

		                    <?php if( $value['count_symbol'] ){ ?>
		                    	<span class="count"><?php echo esc_attr( $value['count_symbol'] );?></span>
		                    <?php } ?>		                    

		                  </div><!-- /.count-inner -->
		                  <span class="fact-title">
		                    <?php echo esc_attr( $value['count_desc'] );?>
		                  </span><!-- /.fact-title -->
		                </div>
		              </div><!-- /.fact-item -->
		            </div><!-- /.col-md-3 -->

		        <?php } ?>


          </div><!-- /.countdown -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.section-padding -->
  </section><!-- /.facts -->

</div>

<?php 
  	wp_reset_postdata();

  	$output = ob_get_contents();
  	ob_end_clean();

  	return $output;
}
add_shortcode( 'shopaholic_counter', 'candor_framework_shopaholic_counter_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_counter_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Counter", 'shopaholic-wp'),
			"base" => "shopaholic_counter",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Counter Parts on About Section.',
			"params" => array(

					            // params group
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'param_name' => 'counter_part',
	                // Note params is mapped inside param-group:
	                'params' => array(
						array(
							"type" => "textfield",
							"heading" => __("Counter Serial No.", 'shopaholic-wp'),
							"param_name" => "count_serial_no",
							'holder' => 'div',
							'value' => '1',
						),
						array(
							'type'         => 'iconpicker',
							'heading'      => esc_html__( 'Icon', 'shopaholic-wp' ),
							'param_name'   => 'counter_icon',
							'value'        => 'fa-shopping-cart',
							'settings'     => array(
									           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
									           'iconsPerPage' => 100, // default 100, how many icons per/page to display
									           ),
							'description'  => esc_html__( 'Select icon from library.', 'shopaholic-wp' ),
						),
						array(
							"type" => "textfield",
							"heading" => __("Counter Number", 'shopaholic-wp'),
							"param_name" => "count_number",
							'holder' => 'div',
							'value' => '1,203',
						),					
						array(
							"type" => "textfield",
							"heading" => __("Counter Text", 'shopaholic-wp'),
							"param_name" => "count_symbol",
							'holder' => 'div',
							'value' => 'K+',
						),				
						array(
							"type" => "textfield",
							"heading" => __("Counter Desc", 'shopaholic-wp'),
							"param_name" => "count_desc",
							'holder' => 'div',
							'value' => 'Products available',
						),
	                )
	            ),




			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_counter_shortcode_vc' );