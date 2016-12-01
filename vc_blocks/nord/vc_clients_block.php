<?php 

/**
 * The Shortcode
 */
function candor_framework_nord_clients_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'images'	 		=> NORD_THEME_ROOT . '/images/clients/01.png'
			), $atts 
		) 
	);

	ob_start();
?>
             <div class="container">
                  <div class="row add-top-quarter">
                  <div class="row">
                  <div class="row">
                      <div class="col-md-12">
                            <div class="clients-logos">                                
                                <div class="owl-carousel clients-carousel">
                                    

                                    <?php 
                                        $images = explode(',', $images);
                                        $i = 0;

	                                    if( is_array($images) ){
                                      	foreach( $images as $ID ){ 
                                      		
                                      		global $post;
                                      		$image_thumb = wp_get_attachment_image_src( $ID, array(190,112));

                                      		$nord_clients_url = get_post_meta( $ID,'_partners_url',true );


                                          		echo '<div class="clients-carousel-item"><a href="' . $nord_clients_url  . '" target="_blank"><img data-no-retina src="'. esc_url_raw( $image_thumb['0'] ) .'" alt=""></a></div>';
                                          		$i++;	
                                          	}
                                    	} 
                                    ?>                                   
                                
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            </div>


<?php 
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode( 'nord_clients', 'candor_framework_nord_clients_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_nord_clients_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => __("Clients Slider", 'nord'),
			"base" => "nord_clients",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => 'Show Clients Logo Image.',
			"params" => array(
				array(
					'type' => 'attach_images',
					'heading' => esc_html__( 'Images', 'nord' ),
					'param_name' => 'images',
					'value' => NORD_THEME_ROOT . '/images/clients/01.png',
					"admin_label" => true,
					'description' => esc_html__( 'Select images from media library.', 'nord' )
					),


			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_nord_clients_shortcode_vc');