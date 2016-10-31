<?php 

/**
 * The Shortcode
 */
function candor_framework_shopaholic_skills_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title'				=> 'Development',
				'data_target'		=> '90',
				'data_width'		=> '90'
			), $atts 
		) 
	);


	ob_start();
	$skills = vc_param_group_parse_atts( $atts['skills'] );
?>

        <ul class='skills'>
        	<?php foreach ($skills as $key => $value ) {?>
            	<li class='shopaholic-progressbar'   data-width='<?php echo esc_attr( $value['data_width'] );?>' data-target='<?php echo esc_attr( $value['data_target'] );?>'>
            		<?php echo esc_attr( $value['title'] );?>
            	</li>
        	<?php } ?>
        </ul>
            
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_skills', 'candor_framework_shopaholic_skills_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_shopaholic_skills_shortcode_vc() {

	vc_map(
	    array(
			"icon" => 'shopaholic-vc-block',
			"name" => __("Skills", 'shopaholic-wp'),
			"base" => "shopaholic_skills",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Skills',
	        'params' => array(

	            // params group
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'param_name' => 'skills',
	                // Note params is mapped inside param-group:
	                'params' => array(
						array(
							"type" => "textfield",
							"heading" => __("Title", 'shopaholic-wp'),
							"param_name" => "title",
							'value' => 'Development',
						),				
						array(
							"type" => "textfield",
							"heading" => esc_html__("Data Target", 'elevation'),
							"param_name" => "data_target",
							'holder' => 'div',
							'value'	=> '90'
						),							
						array(
							"type" => "textfield",
							"heading" => esc_html__("Data Width", 'elevation'),
							"param_name" => "data_width",
							'holder' => 'div',
							'value'	=> '90'
						),	
	                )
	            ),


	        )
	    )
	);
	
}
add_action( 'vc_before_init', 'candor_framework_shopaholic_skills_shortcode_vc');