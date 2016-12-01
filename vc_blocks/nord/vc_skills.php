<?php 

/**
 * The Shortcode
 */
function candor_nord_skills_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'skills_set',
				'skills_title' 		=> 'LOGO DESIGN',
				'service_desc' 		=> '80',				
			), $atts 
		) 
	);


	ob_start();
	
	$skills_sets = vc_param_group_parse_atts( $atts['skills_set'] );	
?>



		<div class="container"><div class="row">
			<div class="row">
				<div class="skills">

	             	<?php foreach ($skills_sets as $key => $value ) { ?>


	                	<div class="row">
	                		<article class="col-md-12 progress-container">
	                			<h6 class="font2 dark"><?php echo esc_attr( $value['skills_title'] );?><span class="font2ultralight color"><?php echo esc_attr( $value['skills_percentage'] );?>%</span></h6>
	                			<div class="progress active">
	                				<div class="progress-bar dark-bg" data-skills-value="<?php echo esc_attr( $value['skills_percentage'] );?>"></div>
	                			</div>
	                		</article>
	                	</div>

	                <?php } ?>        
	                
	            </div>
            </div>

        </div></div>



<?php
  	$output = ob_get_contents();
  	ob_end_clean();

  	return $output;
}
add_shortcode( 'nord_skills', 'candor_nord_skills_shortcode' );



/**
 * The VC Functions
 */
function candor_nord_skills_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => esc_html__("Skills", 'nord'),
			"base" => "nord_skills",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => 'Types of Skills and Description',
			'wrapper_class'   => 'clearfix',
			"params" => array(

									            // params group
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'param_name' => 'skills_set',
	                // Note params is mapped inside param-group:
	                'params' => array(

						array(
							"type" => "textfield",
							"heading" => __("Skills Title", 'nord'),
							"param_name" => "skills_title",
							'holder' => 'div',
							'value' => 'LOGO DESIGN',
						),				
						array(
							"type" => "textfield",
							"heading" => __("Skills Percentage", 'nord'),
							"param_name" => "skills_percentage",
							'holder' => 'div',
							'value' => '80',
						),
	                )
	            ),
				

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_nord_skills_shortcode_vc' );