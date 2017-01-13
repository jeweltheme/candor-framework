<?php 

/**
 * The Shortcode
 */
function candor_service_box_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'service_box',
				'title' 			=> 'Volunteering',
				'service_icon' 		=> 'fa fa-bullhorn',
				'service_content' 	=> 'Our volunteers believe that they have to work free. They always fell happy to do something for the world',
				'bg_color' 			=> '#f39c12',
			), $atts 
		) 
	);

	ob_start();
	
	$service_box = vc_param_group_parse_atts( $atts['service_box'] );	
	?>
	


	    <section id="about" class="about-us">
          <div class="section-padding">
            <div class="container">
              <div class="row">
                <div class="about-details text-center">

                	<?php foreach ($service_box as $key => $value ) { ?>
	                  <div class="col-sm-4">
	                    <div class="item text-center <?php echo esc_attr( $value['service_icon'] );?>" style="background-color:<?php echo esc_attr( $value['bg_color'] );?>">
	                      <div class="item-icon"><i class="<?php echo esc_attr( $value['service_icon'] );?>"></i></div>
	                      <h4 class="item-title"><?php echo esc_attr( $value['title'] );?></h4>
	                      <p class="description"><?php echo esc_attr( $value['service_content'] );?> </p>
	                    </div>
	                  </div>
	                <?php } ?>

                </div><!-- /.about-details -->
              </div><!-- /.row -->
            </div><!-- /.container -->
          </div><!-- /.section-padding -->
        </section><!-- /#about-us -->




<?php 	
  	$output = ob_get_contents();
  	ob_end_clean();

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
			'wrapper_class'   => 'clearfix',
			"params" => array(

				array(
					'type' => 'param_group',
					'value' => '',
					'param_name' => 'service_box',
	                // Note params is mapped inside param-group:
					'params' => array(

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
								"type" => "textarea",
								"heading" => esc_html__("Block Content", 'elevation'),
								"param_name" => "service_content",
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
			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_service_box_shortcode_vc' );