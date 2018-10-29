<?php 

/**
 * The Shortcode
 */
function candor_framework_inventory_service_box_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' 		=> 'Quick & Easy Steps',
				'service_desc' 	=> 'Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio.',
				'service_icon' 	=> 'fa fa-map-o',
			), $atts 
		) 
	);

	ob_start();
	$services = vc_param_group_parse_atts( $atts['services'] );
?>

<div class="container padd-lr0">
    <div class="row">
    	
    	<?php
    	$i=3;
    	foreach ($services as $key => $value ) {?>
	        <div class="col-sm-4 padd-lr0">
	            <div class="inv-3item margin-lg-b140 margin-lg-t150 margin-sm-b100 margin-sm-t100">
	                <i class="<?php echo esc_attr( $value['service_icon'] );?> icons bg<?php echo $i;?>"></i>
	                <h5>
	                	<?php //echo strip_tags(trim($title));?>
	                	<?php echo strip_tags( $value['title'] );?>
	                </h5>
	                <p>
	                	<?php echo esc_attr( $value['service_desc'] );?>
	                </p>
	            </div>
	        </div>
	    <?php $i++; } ?>

    </div>
</div>

	
<?php 

	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;

}
add_shortcode( 'inventory_service_box', 'candor_framework_inventory_service_box_shortcode' );



/**
 * The VC Functions
 */
function candor_framework_inventory_service_box_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'inventory-vc-block',
			"name" => __("Services", 'inventory'),
			"base" => "inventory_service_box",
			"category" => esc_html__('Inventory WP Theme', 'inventory'),

			'params' => array(

	            // params group
				array(
					'type' => 'param_group',
					'value' => '',
					'param_name' => 'services',
	                // Note params is mapped inside param-group:				

					"params" => array(
							array(
								'type'         => 'iconpicker',
								'heading'      => esc_html__( 'Icon', 'nord' ),
								'param_name'   => 'service_icon',
								'value'        => 'fa fa-map-o',
								'settings'     => array(
											           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
											           'iconsPerPage' => 100, // default 100, how many icons per/page to display
											           ),

								'description'  => esc_html__( 'Select icon from library.', 'nord' ),
								),

							array(
								"type" => "textfield",
								"heading" => esc_html__("Title", 'inventory'),
								"param_name" => "title",
								'holder' => 'div',
								'value'	=> 'Quick & Easy Steps'
							),
							array(
								"type" => "textarea",
								"heading" => esc_html__("Short Description", 'inventory'),
								"param_name" => "service_desc",
								'holder' => 'div',
								'value'	=> 'Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio.'
							)

						)

				)
			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_inventory_service_box_shortcode_vc' );