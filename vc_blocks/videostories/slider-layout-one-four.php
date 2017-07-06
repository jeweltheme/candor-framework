<?php 

/**
 * The Shortcode
 */
function candor_framework_vs_slider_one_four_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'one',
				'video_posts' 		=> '5',
				'video_url' 		=> '#',
				'headeing_one' 		=> 'Trending Now',
				'headeing_two' 		=> 'Stormtroppers',
				'headeing_three' 	=> 'are on the action',
				'bg_image' 			=> get_template_directory_uri() . '/images/testimonial.png',
			), $atts 
		) 
	);


	$bg_image = wp_get_attachment_image_src( $bg_image, 'full' );
	ob_start();

	
?>
  	


<?php if($type=="one"){ ?>

  <section class="banner-section text-center background-bg" data-image-src="<?php echo esc_url_raw($bg_image[0]);?>">
    <div class="overlay">
      <div class="section-padding">
        <div class="container">
          <div class="banner-contents">
            <div class="play-btn"><a href="<?php echo esc_url_raw( $video_url );?>" class="iframe play-video"><i class="fa fa-play"></i></a></div>
            <h2 class="title"><?php echo esc_attr( $headeing_one );?></h2><!-- /.title -->
            <h2 class="banner-title"><?php echo esc_attr( $headeing_two );?></h2><!-- /.banner-title -->
            <h3 class="banner-sub-title"><?php echo esc_attr( $headeing_three );?></h3><!-- /.banner-sub-title -->
          </div><!-- /.banner-contents -->
        </div><!-- /.container -->
      </div><!-- /.section-padding -->
    </div><!-- /.overlay -->
  </section><!-- /.banner-section -->

<?php } elseif($type=="four"){ ?>


	 <section class="banner-section slider-bottom">
	    <div class="section-padding">
	      <div class="container">
	        <div class="bottom-slider-area text-center background-bg" data-image-src="<?php echo esc_url_raw($bg_image[0]);?>">
	          <div class="overlay">
	            <div class="banner-contents">
	              <div class="play-btn"><a href="<?php echo esc_url_raw( $video_url );?>" class="iframe play-video"><i class="fa fa-play"></i></a></div>

	              <div class="slider-area">
	                <div id="bottom-slider" class="bottom-slider owl-carousel owl-theme">

	                	<?php 	   
	                	$query_args = array(
	                		'post_type' => 'video',
	                		'post_status' 	 => 'publish',
	                		'posts_per_page' => $video_posts,
	                		);
	                	$video_posts_block = new WP_Query( $query_args );
	                	if ( $video_posts_block->have_posts() ) { while ( $video_posts_block->have_posts() ) { $video_posts_block->the_post();				
	                	?>
			                  
		                		<div class="item">
		                			<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
		                				<div class="entry-content">
		                					<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		                					<div class="entry-meta">
		                						<?php echo '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';?>
		                						<span><i class="fa fa-clock-o"></i> <time datetime="PT5M"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?></time></span>
		                						<span><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i> <span class="count"><?php comments_number( '0', '1', '%' );?></span></a></span>
		                						<span><i class="fa fa-eye"></i> <span class="count"><?php echo videostories_getPostViews(get_the_ID());?></span></span>
		                					</div><!-- /.entry-meta -->
		                				</div><!-- /.entry-content -->
		                			</article>
		                		</div><!-- /.item -->

			            <?php } } wp_reset_postdata(); ?> 

	                </div><!-- /.bottom-slider -->
	              </div><!-- /.slider-area -->
	            </div><!-- /.banner-contents -->
	          </div><!-- /.overlay -->
	        </div><!-- /.bottom-slider-area -->
	      </div><!-- /.container -->
	    </div><!-- /.section-padding -->
	  </section><!-- /.banner-section -->



<?php } ?>


			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'videostories_slider_one_four', 'candor_framework_vs_slider_one_four_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_vs_slider_one_four_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => esc_html__("Slider Type Image", 'videstories'),
			"base" => "videostories_slider_one_four",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Background, Video Popup and Slider.',
			"params" => array(
				array( 
					'param_name' => 'type', 
					'heading' => __( 'Slider Type', 'videstories'), 
					'type' => 'dropdown', 
					'admin_label' => true, 
					'std' => 'one', 
					'value' => array( 
							esc_html__( 'Image with Video Popup', 'videstories') 						=> 'one', 
							esc_html__( 'Image with Video Popup & Video Post Slider', 'videstories') 	=> 'four' ) 
				),
			
				array(
					"type" => "textfield",
					"heading" => esc_html__("Popup Video URL", 'videstories'),
					"param_name" => "video_url",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Heading Italic", 'videstories'),
					"param_name" => "headeing_one",
					"value" => 'Trending Now',
					'dependency' => array( 
						'element' => "type", 
						'value' => array( 'one')
					), 
				),					
				array(
					"type" => "textfield",
					"heading" => esc_html__("Heading Main", 'videstories'),
					"param_name" => "headeing_two",
					"value" => 'Stormtroppers',
					'dependency' => array( 
						'element' => "type", 
						'value' => array( 'one')
					), 
				),						
				array(
					"type" => "textfield",
					"heading" => esc_html__("Heading Sub Heading", 'videstories'),
					"param_name" => "headeing_three",
					"value" => 'are on the action',
					'dependency' => array( 
						'element' => "type", 
						'value' => array( 'one')
					), 
				),				
				array( 
					'type' => 'attach_image', 
					'heading' => esc_html__( 'Background', 'videstories'), 
					'param_name' => 'bg_image',
					'value' => get_template_directory_uri() . '/images/testimonial.png',
					'description' => esc_html__( 'Select Slider Background from media library', 'videstories') 
				), 

				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts in Slider?", 'videstories'),
					"param_name" => "video_posts",
					"value" => '5',
					'dependency' => array( 
						'element' => "type", 
						'value' => array( 'four')
					), 
				),	



			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_vs_slider_one_four_shortcode_vc');