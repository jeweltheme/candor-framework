<?php 

/**
 * The Shortcode
 */
function inventory_partners_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'images'	 		=> ''
			), $atts 
		) 
	);

	ob_start();

?>


            <div class="inv-partners margin-lg-t90 margin-lg-b145 margin-sm-b100">
            	<ul>
            		<?php 
            		$images = explode(',', $images);
            		$i = 0;

            		if( is_array($images) ){
            			foreach( $images as $ID ){ 
            				$partners_url = get_post_meta( $ID,'_partners_url',true );
            				?>

            				<li>
            					<a href="<?php echo $partners_url;?>">
            						<?php echo wp_get_attachment_image( $ID, 'full' );?>
            					</a>
            				</li><!-- /.item -->
            				<?php $i++; } } ?>
            			</ul>
            		</div>


<?php

	
	$output = ob_get_contents();
	ob_end_clean();
	  
  return $output;
}
add_shortcode( 'inventory_partners', 'inventory_partners_shortcode' );


/**
 * The VC Functions
 */
function inventory_partners_shortcode_vc() {
	
	vc_map( 
		array(
		    "icon" => 'inventory-vc-block',
		    "name" => esc_html__("Partners", 'cast'),
		    "base" => "inventory_partners",
		    "category" => esc_html__('Inventory WP Theme', 'inventory'),
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
add_action( 'vc_before_init', 'inventory_partners_shortcode_vc');