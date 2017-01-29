<?php 

/**
 * The Shortcode
 */
function candor_inventory_callout_box_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'callout_title' 			=> 'Get the best Directory Wordpress Theme',				
				'callout_subtitle' 			=> 'Appropriately Strategize Performance Based Intellectual Capital Before Premier Users',
				'button_text' 				=> 'Purchase Now',
				'button_link' 				=> '#',
				'callout_bg_image' 			=> get_template_directory_uri() . '/images/bg2.jpg',
			), $atts 
		) 
	);
	ob_start();
	$callout_bg_image = wp_get_attachment_image_src( $callout_bg_image, 'full' );
?>


		<div class="subscribe inv-bg-block padding-lg-t70 padding-lg-b80">
			<img src="<?php echo $callout_bg_image[0];?>" alt="<?php the_title_attribute();?>" class="inv-img">
			<div class="container padd-only-xs">
				<div class="row">
					<div class="col-sm-12 col-md-9">
						<h3><?php echo $callout_title;?></h3>
						<span><?php echo $callout_subtitle;?></span>
					</div>
					<div class="col-sm-12 col-md-3">
						<a href="<?php echo $button_link;?>" class="inv-btn"><?php echo $button_text;?></a>
					</div>
				</div>
			</div>
		</div>


<?php 
	wp_reset_postdata();
	wp_reset_query();
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'inventory_callout_box', 'candor_inventory_callout_box_shortcode' );



/**
 * The VC Functions
 */
function candor_inventory_callout_box_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'inventory-vc-block',
			"name" => esc_html__("Callout Box", 'inventory'),
			"base" => "inventory_callout_box",
			"category" => esc_html__('Inventory WP Theme', 'inventory'),
			'description' => esc_html__('Call out Box', 'inventory'),
			"params" => array(
			
				array(
						"type" => "textfield",
						"heading" => __("Callout Title", 'inventory'),
						"param_name" => "callout_title",
						'holder' => 'div',
						'value' => 'Get the best Directory Wordpress Theme',
					),
				array(
						"type" => "textfield",
						"heading" => __("Callout Subtitle", 'inventory'),
						"param_name" => "callout_subtitle",
						'holder' => 'div',
						'value' => 'Appropriately Strategize Performance Based Intellectual Capital Before Premier Users',
					),				
				array(
						"type" => "textfield",
						"heading" => __("Button Text", 'inventory'),
						"param_name" => "button_text",
						'holder' => 'div',
						'value' => 'Purchase Now',
					),
				array(
						"type" => "textfield",
						"heading" => __("Button Link", 'inventory'),
						"param_name" => "button_link",
						'holder' => 'div',
						'value' => '#',
					),
				array( 
					'type' => 'attach_image', 
					'heading' => __( 'Background Image', 'inventory'), 
					'param_name' => 'callout_bg_image',
					'value' => get_template_directory_uri() . '/images/bg2.jpg',
					'description' => __( 'Select Featured Listings Background from media library', 'inventory') 
					), 


			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_inventory_callout_box_shortcode_vc' );