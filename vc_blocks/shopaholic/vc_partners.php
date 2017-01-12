<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_partners_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'images'	 		=> SHOPAHOLIC_PATH . '/images//brand/1.png',
				'style'				=> 'style1'
			), $atts 
		) 
	);
global $post;
	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(190,112));
	ob_start();

	if( $style =="style1" ){
		$style_class = 'clients-logo-01 bg-gray';
	} 
	elseif( $style =="style2" ){ 
		$style_class = 'bg-transparent';
	}

?>
	<div class="row">
		<div class="clients-logo <?php echo esc_attr( $style_class );?> text-center">
		    <div class="section-padding">
		      <div class="container">
		        <div class="row">
		  			
		  			<?php 
			  			$images = explode(',', $images);

						$i = 0;

		                  if( is_array($images) ){
		                  	foreach( $images as $ID ){ 
		                  		global $post;
		                  		$image_thumb = wp_get_attachment_image_src( $ID, array(190,112));

		                  		$partners_url = get_post_meta( $ID,'_partners_url',true );
		                  		?>
									<div class="col-sm-3">
										<div class="item <?php // echo ($style== "style1") ? "bg-gray": "";?>">
											<a href="<?php echo esc_url_raw( $partners_url );?>" target="_blank">
												<img src="<?php echo esc_url_raw( $image_thumb['0'] );?>" alt="<?php the_title_attribute();?>">
											</a>
										</div>
									</div>
		                  		<?php 
		                  		$i++;	
		                  	}
		                  } 
	                ?>
		  
		        </div><!-- /.row -->
		      </div><!-- /.container -->
		    </div><!-- /.section-padding -->
		</div>
	</div><!-- /.row -->
<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode( 'shopaholic_partners', 'candor_framework_shopaholic_partners_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_shopaholic_partners_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Partners/Clients", 'shopaholic-wp'),
			"base" => "shopaholic_partners",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Partners/Clients Logo Image.',
			"params" => array(
				array(
					'type' => 'attach_images',
					'heading' => esc_html__( 'Partner Images', 'shopaholic-wp' ),
					'param_name' => 'images',
					'value' => SHOPAHOLIC_PATH . '/images//brand/1.png',
					"admin_label" => true,
					'description' => esc_html__( 'Select images from media library.', 'shopaholic-wp' )
					),

				array(
					"type" => "dropdown",
					"heading" => __("Style", 'shopaholic-wp'),
					"param_name" => "style",
					"value" => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2'
						),
					),


			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_partners_shortcode_vc');