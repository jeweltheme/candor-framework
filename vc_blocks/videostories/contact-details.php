<?php 

/**
 * The Shortcode
 */
function candor_framework_videstories_contact_details_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 					=> 'videstories_contact_details_set',
				'contact_title' 		=> 'Address',
				'contact_icon' 			=> 'icon-picture',
				'contact_details' 		=> '121 King Street, Melbourne VIC 3000, Australia',
			), $atts 
		) 
	);
	
	ob_start();


	
	$videstories_contact_details_set = vc_param_group_parse_atts( $atts['videstories_contact_details_set'] );
?>

		<aside class="sidebar">
			<div class="widget widget_address">

				<?php foreach ($videstories_contact_details_set as $key => $value ) { 

					switch ($value['contact_icon'] ) {
						case 'fontawesome':
						$icon = $value['icon_fontawesome'];
						break;
						
						case 'linecons':
						$icon = $value['icon_linecons'];
						break;
						
						case 'themify':
						$icon = $value['icon_themify'];
						break;
						
						default:
						$icon = $value['icon_fontawesome'];
						break;
					}
	?>

					<div class="item media">
						<div class="item-icon media-left"><i class="<?php echo esc_attr( $icon );?>"></i></div><!-- /.item-icon -->
						<div class="item-details media-body">
							<h3 class="item-title"><?php echo esc_attr( $value['contact_title'] );?></h3><!-- /.item-title -->
							<span>
								<?php echo esc_attr( $value['contact_details'] );?>
							</span>
						</div><!-- /.item-details -->
					</div><!-- /.item -->

				<?php } ?>

			</div><!-- /.widget -->
		</aside><!-- /.inner-bg -->


<?php 
	
  	$output = ob_get_contents();
  	ob_end_clean();

  	return $output;
}
add_shortcode( 'videstories_contact_details', 'candor_framework_videstories_contact_details_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_videstories_contact_details_shortcode_vc() {
	
	
 $themify_icons = array(
    array( 'ti-location-pin' => 'location' ), // Each icon should be added as an array
    array( 'ti-mobile' => 'mobile' ),
    array( 'ti-email' => 'email' ),    


 );



vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => esc_html__("Contact Details", 'videstories'),
			"base" => "videstories_contact_details",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			"params" => array(

				array(
					'type' => 'param_group',
					'value' => '',
					'param_name' => 'videstories_contact_details_set',
	                // Note params is mapped inside param-group:
					'params' => array(



								array(
									'type'         => 'dropdown',
									'heading'      => esc_html__( 'Icon library', 'videstories' ),
									'param_name'   => 'contact_icon',
									'value'     => array(
											__( 'Font Awesome', 'videstories' ) => 'fontawesome',
											__( 'Linecons', 'videstories' )     => 'linecons',
											__( 'Themify Icon', 'videstories' )   => 'themify',
										),
									'settings'     => array(
							           'emptyIcon'    => false, // default true, display an "EMPTY" icon?
							           'iconsPerPage' => 100, // default 100, how many icons per/page to display
							           ),
									'description'  => esc_html__( 'Select icon from library.', 'videstories' ),
									),
								array(
									'type'         => 'iconpicker',
									'heading'      => __( 'Icon', 'videstories' ),
									'param_name'   => 'icon_fontawesome',
									'value'        => 'fa fa-facebook',
									'settings'     => array(
								         'emptyIcon'    => false, // default true, display an "EMPTY" icon?
								         'iconsPerPage' => 200, // default 100, how many icons per/page to display
								         ),
									'dependency'   => array(
										'element'   => 'contact_icon',
										'value'     => 'fontawesome',
										),
									'description'  => __( 'Select icon from library.', 'videstories' ),
									),
							   	array(
								      'type'         => 'iconpicker',
								      'heading'      => __( 'Icon', 'videstories' ),
								      'param_name'   => 'icon_linecons',
								      'settings'     => array(
								         'emptyIcon'    => false, // default true, display an "EMPTY" icon?
								         'type'         => 'linecons',
								         'iconsPerPage' => 200, // default 100, how many icons per/page to display
								      ),
								      'dependency'   => array(
								         'element'   => 'contact_icon',
								         'value'     => 'linecons',
								      ),
								      'description'  => __( 'Select icon from library.', 'videstories' ),
							   	),

						      	array(
							      	'type'         => 'iconpicker',
							      	'heading'      => __( 'Icon', 'plain' ),
							      	'param_name'   => 'icon_themify',
							      	'settings'     => array(
							         	'emptyIcon' => false, // default true, display an "EMPTY" icon?
							         	'type'      => 'themify',
							         	'source'    => $themify_icons,
							         	'iconsPerPage' => 100, // default 100, how many icons per/page to display
							      	),
							      	'dependency'   => array(
							         	'element'   => 'contact_icon',
							         	'value'     => 'themify',
							      	),
							      	'description'  => __( 'Select icon from library.', 'plain' ),
							   	),
								array(
									"type" => "textfield",
									"heading" => esc_html__("Title", 'videstories'),
									"param_name" => "contact_title",
									'holder' => '',
									'value'	=> 'Address'
								),
								array(
									"type" => "textarea",
									"heading" => esc_html__("Block Content", 'videstories'),
									"param_name" => "contact_details",
									'holder' => '',
									'value'	=> '121 King Street, Melbourne VIC 3000, Australia'
								)



	                )
	            ),
				


			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_videstories_contact_details_shortcode_vc' );