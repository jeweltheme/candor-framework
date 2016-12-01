<?php 

/**
 * The Shortcode
 */
function candor_vc_urgent_causes_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' 			=> 'Urgent Cause',
				'subtitle' 			=> 'Please Donate Whatever You Can and Save the Hungry Children in South Sudan',
				'counter1' 			=> 'Target;$;21201',
				'counter2' 			=> '63;%;Done;Donate',
				'counter3' 			=> 'Collected;$;11990'
			), $atts 
		) 
	);
	
 $counter1_parts = explode(";",$counter1);
 $counter2_parts = explode(";",$counter2);
 $counter3_parts = explode(";",$counter3);


	$output = '<section id="donate" class="donate text-center" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="0">
		          <div class="parallax-style">
		            <div class="section-padding">
		              <div class="container">
		                <div class="donate-details">
		                  <h3 class="section-sub-title">'. esc_attr($title) .'</h3>
		                  <p class="donate-description">'. strip_tags(trim($subtitle)) .'</p>
		                  <div class="countdown">
		                    <div class="donate-count">
		                      <div class="count-inner">
		                        <h3 class="donate-title">'. $counter1_parts[0] .'</h3>
		                        <span class="currency">'. $counter1_parts[1] .'</span>
		                        <span class="count-number counter">'. $counter1_parts[2] .'</span>
		                      </div><!-- /.count-inner -->
		                    </div><!-- /.donate-count -->
		                    <div class="donate-count">
		                      <div class="count-inner">
		                        <a href="#" class="btn">                     
		                          <span class="count-number counter">'. $counter2_parts[0] .'</span>
		                          <span class="percentage">'. $counter2_parts[1] .'</span>
		                          <span class="text">'. $counter2_parts[2] .'</span>
		                          <h3 class="donate-title">'. $counter2_parts[3] .'</h3>
		                        </a>
		                      </div><!-- /.count-inner -->
		                    </div><!-- /.donate-count -->
		                    <div class="donate-count">
		                      <div class="count-inner">
		                        <h3 class="donate-title">'. $counter3_parts[0] .'</h3>
		                        <span class="currency">'. $counter3_parts[1] .'</span>
		                        <span class="count-number counter">'. $counter3_parts[2] .'</span>
		                      </div><!-- /.count-inner -->
		                    </div><!-- /.donate-count -->
		                  </div><!-- /.countdown -->
		                </div><!-- /.donate-details -->
		              </div><!-- /.container -->
		            </div><!-- /.section-padding -->
		          </div><!-- /.parallax-style -->
		        </section><!-- /#donate -->';
	
	return $output;
}
add_shortcode( 'elevation_urgent_causes_box', 'candor_vc_urgent_causes_block_shortcode' );



/**
 * The VC Functions
 */
function candor_vc_urgent_causes_block_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => esc_html__("Urgent Causes", 'elevation'),
			"base" => "elevation_urgent_causes_box",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			"params" => array(
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__("Title", 'elevation'),
					"param_name" 	=> "title",
					'value'			=> 'Urgent Cause'
				),
				array(
					"type" 			=> "textarea_html",
					"heading" 		=> esc_html__("Block Content", 'elevation'),
					"param_name" 	=> "subtitle",
					'value'			=> 'Please Donate Whatever You Can and Save the Hungry Children in South Sudan'
				),
				array(
			    	"type" 			=> "textfield",
			    	"heading" 		=> esc_html__("Counter 1", 'elevation'),
			    	"param_name" 	=> "counter1",
			    	'value' 		=> 'Target; $; 21201',
			    	'description' 	=> 'Type Counter 1 ( Seperated with ; ): Title, Currency and Number'
			    	),				
				array(
			    	"type" 			=> "textfield",
			    	"heading" 		=> esc_html__("Counter 2", 'elevation'),
			    	"param_name" 	=> "counter2",
			    	'value' 		=> '63; %; Done; Donate',
			    	'description' 	=> 'Type Counter 2( Seperated with ; ): Title, Currency and Number'
			    	),				
				array(
			    	"type" 			=> "textfield",
			    	"heading" 		=> esc_html__("Counter 3", 'elevation'),
			    	"param_name" 	=> "counter3",
			    	'value' 		=> 'Collected; $; 11990',
			    	'description' 	=> 'Type Counter 3( Seperated with ; ): Title, Currency and Number'
			    	)


			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_vc_urgent_causes_block_shortcode_vc' );