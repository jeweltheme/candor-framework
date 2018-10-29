<?php 

/**
 * The Shortcode
 */
function candor_nord_experience_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 						=> 'experience_set',
				'experience_period' 		=> '2015 JAN - PRESENT',
				'experience_designation' 	=> 'Creative Director',				
				'experience_company' 		=> 'MediaMount LLC',				
				'experience_company_url' 	=> '#',				
			), $atts 
		) 
	);


	ob_start();
	
	$experience_sets = vc_param_group_parse_atts( $atts['experience_set'] );
?>





		<div class="container"><div class="row">
			<div class="row">
				<div class="skills">
					

	             	<?php
	             	$i =0;
	             	foreach ($experience_sets as $key => $value ) { 
	             	//print_r($i);
	             	//print_r($key);
	             	?>
	             		<?php if( $i==0 || $i===2) echo '<div class="row add-top-quarter">';?>
						
	                  
	                      <div class="col-md-6 text-left experience-item">
	                        <h2 class="font2ultralight color"><?php echo esc_attr( $value['experience_period'] );?></h2>
	                        <h5 class="font2light"><?php echo esc_attr( $value['experience_period'] );?> <?php echo esc_html__('at', 'nord');?> 
	                        	<span class="font2bold">
	                        		<a href="<?php echo esc_attr( $value['experience_period'] );?>"><?php echo esc_attr( $value['experience_period'] );?></a>
	                        	</span>
	                        </h5>
	                      </div>
						<?php if( $i==1 || $i===3) echo '</div>';?>
	                <?php $i++; } ?>        
	                
	                
	            </div>
            </div>

        </div></div>



<?php
  	$output = ob_get_contents();
  	ob_end_clean();

  	return $output;
}
add_shortcode( 'nord_experience', 'candor_nord_experience_shortcode' );



/**
 * The VC Functions
 */
function candor_nord_experience_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => esc_html__("Experience", 'nord'),
			"base" => "nord_experience",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => 'Types of Experience and Description',
			'wrapper_class'   => 'clearfix',
			"params" => array(

									            // params group
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'param_name' => 'experience_set',
	                // Note params is mapped inside param-group:
	                'params' => array(

						array(
							"type" => "textfield",
							"heading" => __("Period", 'nord'),
							"param_name" => "experience_period",
							'holder' => 'div',
							'value' => '2015 JAN - PRESENT',
						),				
						array(
							"type" => "textfield",
							"heading" => __("Designation", 'nord'),
							"param_name" => "experience_designation",
							'holder' => 'div',
							'value' => 'Creative Director',
						),						
						array(
							"type" => "textfield",
							"heading" => __("Company", 'nord'),
							"param_name" => "experience_company",
							'holder' => 'div',
							'value' => 'MediaMount LLC',
						),
						array(
							"type" => "textfield",
							"heading" => __("Company Website", 'nord'),
							"param_name" => "experience_company_url",
							'holder' => 'div',
							'value' => '#',
						),


	                )
	            ),
				

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_nord_experience_shortcode_vc' );