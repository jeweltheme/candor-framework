<?php 

/**
 * The Shortcode
 */
function candor_vc_content_video_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' 			=> 'A Heartwarming Success Story',
				'learn_more_title' 	=> 'Learn More',
				'video_url' 		=> 'http://player.vimeo.com/video/85517984',
				'learn_more_url' 	=> '#',
				'donate_title' 		=> 'Donate Now',
				'donate_url' 		=> '#'
			), $atts 
		) 
	);
	

	$output = '<section id="stories" class="stories">
          <div class="row">
            <div class="stories-details">
              <div class="col-md-6">
                <div class="stories-thumbnail">
                  <div class="video-container">
                    <div class="embed-responsive embed-responsive-16by9 vimeo-player">
                      <iframe class="embed-responsive-item" src="'. esc_attr($video_url) .'"></iframe>
                    </div>
                  </div><!-- /.video-container -->
                </div><!-- /.stories-thumbnail -->
              </div>

              <div class="col-md-6">
                <div class="section-padding">
                  <h4 class="section-sub-title">'. esc_attr($title) .'</h4>
                  <p class="description">'. wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</p>
                  <div class="btn-container">
                    <a href="'. esc_attr($learn_more_url) .'" class="btn btn-sm more-btn">'. esc_attr($learn_more_title) .'</a>
                    <a href="'. esc_attr($donate_url) .'" class="btn btn-sm donate-btn">'. esc_attr($donate_title) .'</a>
                  </div><!-- /.btn-container -->
                </div><!-- /.section-padding -->
              </div>
            </div><!-- /.stories-details -->
          </div><!-- /.row -->
        </section><!-- /#stories -->';
	
	return $output;
}
add_shortcode( 'elevation_content_video_box', 'candor_vc_content_video_block_shortcode' );



/**
 * The VC Functions
 */
function candor_vc_content_video_block_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => esc_html__("Left Video, Right Content", 'elevation'),
			"base" => "elevation_content_video_box",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			"params" => array(
				array(
					'type' 			=> 'textfield',
					'heading' 		=> esc_html__( 'Video URL', 'elevation' ),
					'param_name' 	=> 'video_url',
					'value' 		=> 'http://player.vimeo.com/video/85517984',
					"admin_label" 	=> true,
					'description' 	=> esc_html__( 'Enter the URL of Youtube/Vimeo Video', 'elevation' )
					),

				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__("Title", 'elevation'),
					"param_name" 	=> "title",
					'holder' 		=> 'div',
					'value'			=> 'A Heartwarming Success Story'
				),
				array(
					"type" 			=> "textarea_html",
					"heading" 		=> esc_html__("Block Content", 'elevation'),
					"param_name" 	=> "content",
					'holder' 		=> 'div',
					'value'			=> '<span>The story of R. G. LeTourneau. As he succeeded, he increased his giving to the point where he was giving 90% of his income to the Lord’s work.</span>
					                    R. G. LeTourneau says, "I shovel out the money, and God shovels it back—but God has a bigger shovel". You may be thinking, “I could give 90% too if I was a multi-millionaire.” Maybe so, but LeTourneau didn’t start out wealthy.'
				),

				array(
			    	"type" 			=> "textfield",
			    	"heading" 		=> esc_html__("Learn More Button", 'elevation'),
			    	"param_name" 	=> "learn_more_title",
			    	'value' 		=> 'Learn More',
			    	'description' 	=> 'Type Learn More Title'
			    	),
			    array(
			    	"type" 			=> "textfield",
			    	'heading'      	=> esc_html__( 'Learn More Button URL', 'elevation' ),
			    	"param_name" 	=> "learn_more_url",
			    	"value" 		=> "#",
			    	'description' 	=> 'Type URL of Learn More.'
			    	),		    	
			    array(
			    	"type" 			=> "textfield",
			    	"heading" 		=> esc_html__("Donate Button", 'elevation'),
			    	"param_name" 	=> "donate_title",
			    	'value' 		=> 'Donate Now',
			    	'description' 	=> 'Type Donate Title'
			    	),
			    array(
			    	"type" 			=> "textfield",
			    	'heading'      	=> esc_html__( 'Donate Button URL', 'elevation' ),
			    	"param_name" 	=> "donate_url",
			    	"value" 		=> "#",
			    	'description' 	=> 'Type URL of Donate.'
			    	)
				

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_vc_content_video_block_shortcode_vc' );