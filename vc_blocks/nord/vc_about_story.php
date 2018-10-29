<?php 

/**
 * The Shortcode
 */
function candor_nord_about_story_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' 			=> 'We create beautiful designs and illustrations that stand out from common stuffs.',
				'sub_title' 		=> 'We are passionate about everything that has good design.',				
			), $atts 
		) 
	);
	
	$output = '<div class="white-bg pad-top-half">
				<div class="container"><div class="row">
				  	<div class="col-md-6 text-left">
				    	<h3 class="dark font2 font2ultralight"><span class="black font3">'. esc_attr($title) .'</span> '. esc_attr($sub_title) .'</h3>
				  	</div>
				  	<div class="col-md-6 text-left">'. wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>
					</div>
				</div>
				</div>';


	return $output;
}
add_shortcode( 'nord_about_story', 'candor_nord_about_story_shortcode' );



/**
 * The VC Functions
 */
function candor_nord_about_story_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => esc_html__("About Story", 'nord'),
			"base" => "nord_about_story",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => 'About Story, details of About Section',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'nord'),
					"param_name" => "title",
					'holder' => 'div',
					'value'	=> 'We create beautiful designs and illustrations that stand out from common stuffs.'
				),				
				array(
					"type" => "textfield",
					"heading" => esc_html__("Sub Title", 'nord'),
					"param_name" => "sub_title",
					'holder' => 'div',
					'value'	=> 'We are passionate about everything that has good design.'
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Block Content", 'nord'),
					"param_name" => "content",
					'holder' => 'div',
					'value'	=> '<h4 class="font2 silver">Our Story</h4><br/>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis placerat sed augue vel accumsan. Nulla leo velit, mollis ac tortor ac, sollicitudin condimentum sapien. Integer at libero dui. Vestibulum euismod, metus in accumsan varius, risus enim condimentum arcu, in sagittis nunc ipsum eget magna. Integer bibendum, mi vel suscipit pellentesque, lectus leo rhoncus odio, eget posuere lacus orci imperdiet nunc.</p>'
				),
				

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_nord_about_story_shortcode_vc' );