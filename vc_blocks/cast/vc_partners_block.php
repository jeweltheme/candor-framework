<?php 

/**
 * The Shortcode
 */
function cast_partners_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'images'	 		=> ''
			), $atts 
		) 
	);
	ob_start();
?>

    <div class="partners partners-2 text-center">
        <div class="section-padding">
            <div class="container">
                <div class="items">
                	<?php 
                		$images = explode(',', $images);
						$i = 0;

	                  	if( is_array($images) ){
	                  		foreach( $images as $ID ){ 
	                  			$partners_url = get_post_meta( $ID,'_partners_url',true );
	                  			?>

                    		<div class="item">
                    			<a href="<?php echo $partners_url;?>">
                    				<?php echo wp_get_attachment_image( $ID, 'full' );?>
                    			</a>
                    		</div><!-- /.item -->
                    	<?php $i++; } } ?>

                </div><!-- /.items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </div><!-- /.partners -->




<?php

	$output = ob_get_contents();
	ob_end_clean();
	  
  	return $output;
}
add_shortcode( 'cast_partners', 'cast_partners_shortcode' );


/**
 * The VC Functions
 */
function cast_partners_shortcode_vc() {
	
	vc_map( 
		array(
		    "icon" => 'cast-vc-block',
		    "name" => esc_html__("Partners", 'cast'),
		    "base" => "cast_partners",
		    "category" => esc_html__('CAST WP Theme', 'cast'),
		    'description' => 'Select Partners Images',
		    //'wrapper_class'   => 'clearfix',
			"params" => array(
				array(
					'type' => 'attach_images',
					'heading' => esc_html__( 'Images', 'cast' ),
					'param_name' => 'images',
					'value' => get_template_directory_uri() . '/images/difference.jpg',
					"admin_label" => true,
					'description' => esc_html__( 'Select images from media library.', 'cast' )
					),


			)
		) 
	);
	
}
add_action( 'vc_before_init', 'cast_partners_shortcode_vc');