<?php 

/**
 * The Shortcode
 */
function candor_nord_about_service_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'service_icon',
				// 'service_icon' 		=> 'fa fa-facebook',
				'bg_image' 			=> NORD_PATH . '/images/icons/02.svg',
				'title' 			=> 'Innovation',
				'service_desc' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit eros hendrerit luctus.',				
			), $atts 
		) 
	);


	ob_start();
	
	wp_enqueue_style( 'font-awesome', NORD_CSS . 'font-awesome.min.css', NORD_VER );
	$about_services = vc_param_group_parse_atts( $atts['about_services'] );	
?>


		<div class="container"><div class="row">
            <div class="row add-top-quarter">

             	<?php foreach ($about_services as $key => $value ) {
             		$bg_image = wp_get_attachment_image_src( $value['bg_image'], 'full' ); ?>

	                    <article class="col-md-4 features-item">
	                    	<?php if( $value['type'] =="service_img"){ ?>
	                      		<img data-no-retina src="<?php echo esc_url_raw( $bg_image[0] ); ?>" class="img-responsive" title="" alt="">
	                      	<?php } elseif($value['type'] == "service_icon"){ ?>
	                      		<i class="<?php echo esc_attr( $value['service_icon'] );?>"></i>
	                      	<?php } ?>

	                      		<h3 class="black font2"><?php echo esc_attr( $value['title'] );?></h3>
	                      		<p class="grey"><?php echo esc_attr( $value['service_desc'] );?></p>
	                    </article>
                <?php } ?>

                </div>
            </div>
        </div>



<?php
  	$output = ob_get_contents();
  	ob_end_clean();

  	return $output;
}
add_shortcode( 'nord_about_service', 'candor_nord_about_service_shortcode' );



/**
 * The VC Functions
 */
function candor_nord_about_service_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => esc_html__("Services", 'nord'),
			"base" => "nord_about_service",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => 'Types of Services and Description',
			'wrapper_class'   => 'clearfix',
			"params" => array(

									            // params group
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'param_name' => 'about_services',
	                // Note params is mapped inside param-group:
	                'params' => array(

	                	array( 
	                		'param_name' => 'type', 
	                		'heading' => __( 'Icon Type', 'nord'), 
	                		'type' => 'dropdown', 
	                		'admin_label' => true, 
	                		'std' => 'service_icon', 
	                		'value' => array( 
	                			__( 'Icons', 'nord') 		=> 'service_icon', 
	                			__( 'Image', 'nord') 		=> 'service_img' ) 
	                		), 

						array(
							'type'         => 'iconpicker',
							'heading'      => esc_html__( 'Icon', 'nord' ),
							'param_name'   => 'service_icon',
							'value'        => 'fa-shopping-cart',
							'settings'     => array(
									           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
									           'iconsPerPage' => 100, // default 100, how many icons per/page to display
									           ),
							'dependency' => array( 
								'element' 	=> "type", 
								'value' 	=> array( 'service_icon')
								), 
							'description'  => esc_html__( 'Select icon from library.', 'nord' ),
						),
			
						array( 
							'type' => 'attach_image', 
							'heading' => __( 'Background', 'nord'), 
							'param_name' => 'bg_image',
							'value' => NORD_PATH . '/images/icons/02.svg',
							'dependency' => array( 
								'element' 	=> "type", 
								'value' 	=> array( 'service_img')
								), 
							'description' => __( 'Select Service Background from media library', 'nord') 
							), 

						array(
							"type" => "textfield",
							"heading" => __("Service Title", 'nord'),
							"param_name" => "title",
							'holder' => 'div',
							'value' => 'Innovation',
						),				
						array(
							"type" => "textfield",
							"heading" => __("Service Description", 'nord'),
							"param_name" => "service_desc",
							'holder' => 'div',
							'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit eros hendrerit luctus.',
						),
	                )
	            ),
				

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_nord_about_service_shortcode_vc' );