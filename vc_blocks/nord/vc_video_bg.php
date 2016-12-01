<?php 

/**
 * The Shortcode
 */
function candor_nord_video_bg_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' 		=> 'Nord',
				'video_src' 	=> 'Vimeo',
				'video_id' 		=> '84931739'
			), $atts 
		) 
	);
	
	ob_start();
?>

		  <section class="intro04 fullheight">
		   
		   <div class="valign">
		     
		            <div class="container-fluid">
		              
		                  <div class="row add-top-half">
		                      <div class="col-md-6 col-md-offset-3 text-center header-caps">
		                        <h1 class="white font2"><?php echo esc_attr($title);?></h1>
		                      </div>
		                  </div>

		            </div>
		   </div>

		  </section>





  <!-- FULLSCREEN BG VIDEO SCRIPT  -->
  <script>

    jQuery(document).ready(function($){

        if( !device.tablet() && !device.mobile() ) {
          
          /* plays the BG Vimeo or Youtube video if non-mobile device is detected*/ 
          jQuery('body').umbg({
                  'mediaPlayerType': '<?php echo esc_attr($video_src);?>', // YouTube, Vimeo, Dailymotion, Wistia, HTML5, Image, or Color.
                  'mediaId': '<?php echo esc_attr($video_id);?>', // Use the video id . For HTML5 use the location and video filename.
                  'mediaOverlay': 0, //Overlay
                  'displayControls': 0
           });
                
        } else {
          
          /* displays a static image / poster image if mobile device is detected. This is due to limitation of mobile browsers which can not display fullscreen BG videos.*/ 
          jQuery('body').addClass('poster-img');          
          
        }
          
          jQuery('.mastwrap .common-content').removeClass('white-bg');
            
       
    });
    // $(function ($)  : ends
    </script>
        
    <style>
    	header.masthead{
    		width: 101% !important;
    	}
    </style>     


<?php 
  $output = ob_get_contents();
  ob_end_clean();
  
	return $output;
}
add_shortcode( 'nord_video_bg', 'candor_nord_video_bg_shortcode' );



/**
 * The VC Functions
 */
function candor_nord_video_bg_shortcode_vc() {
	
	
	vc_map( 
		array(
			"icon" => 'nord-vc-block',
			"name" => esc_html__("Video BG", 'nord'),
			"base" => "nord_video_bg",
			"category" => esc_html__('NORD WP Theme', 'nord'),
			'description' => esc_html__('Fullscreen Video BG of Content Block', 'nord'),
			"params" => array(
				
				// params group
				array(
						"type" => "textfield",
						"heading" => __("Title", 'nord'),
						"param_name" => "title",
						'holder' => 'div',
						'value' => 'Nord',
					),				
				array(
						"type" => "textfield",
						"heading" => __("Fullscreen Video Source", 'nord'),
						"param_name" => "video_src",
						'holder' => 'div',
						'value' => 'Vimeo',
						'description' => esc_html__( 'Sources: YouTube, Vimeo, Dailymotion, Wistia, HTML5, Image, or Color', 'nord') 
					),
				array(
						"type" => "textfield",
						"heading" => __("Video ID", 'nord'),
						"param_name" => "video_id",
						'holder' => 'div',
						'value' => '84931739',
						'description' => esc_html__( 'Sources: Enter Video ID of Youtube/Vimeo Sources', 'nord') 
					)

			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_nord_video_bg_shortcode_vc' );