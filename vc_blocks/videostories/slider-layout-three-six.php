<?php 

/**
 * The Shortcode
 */
function candor_framework_vs_slider_three_six_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'three',
				'video_posts' 		=> '5',
			), $atts 
		) 
	);


	
	ob_start();

	
?>
  	


<?php if($type=="three"){ ?>

<section class="banner-section banner-slider text-center">
	<div class="section-padding">
		<div class="banner-slider-01 owl-carousel owl-theme">
			<?php 	   
			$query_args = array(
				'post_type' => 'video',
				'post_status' 	 => 'publish',
				'posts_per_page' => $video_posts,
				);
			$video_posts_block = new WP_Query( $query_args );
			if ( $video_posts_block->have_posts() ) { while ( $video_posts_block->have_posts() ) { $video_posts_block->the_post();	
				$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-cat-thumb' ) );
				$terms = wp_get_post_terms( get_the_ID(), 'video_category', array("fields" => "all"));  

				$t = array();                    
				foreach($terms as $term)
					$t[] = $term->slug;       


				$public_video_source = videostories_meta( '_videostories_public_video_source' ); 
				$video_external = videostories_meta( '_videostories_video_external' ); 
				$video_self = videostories_meta( '_videostories_video_self','type=video');
				$video_remote = videostories_meta( '_videostories_video_remote' ); 
				$video_embed = videostories_meta('_videostories_video_embed','type=oembed');

				switch ($public_video_source) {
					case 'external':
					$v_src = $video_external[0];
					break;

					case 'self':
					$v_src = videostories_get_attachment_url( $video_self );
					break;

					case 'remote':
					$v_src = videostories_get_attachment_url( $video_remote );
					break;

					case 'custom':					
					preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $video_embed[0], $matches);
					$v_src = $matches[1];
					break;

					default:
					$v_src = $video_external;
					break;
				}

			?>      

				<div class="item">
					<?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-cat-thumb'); }?>
					<div class="overlay">
						<div class="banner-contents">
							<div class="play-btn"><a href="<?php echo esc_url_raw( $v_src );?>" class="iframe play-video"><i class="fa fa-play"></i></a></div>
							<h2 class="title"><?php echo implode(', ', $t); $t = array(); ?></h2><!-- /.title -->
							<h3 class="banner-sub-title"><?php the_title();?></h3><!-- /.banner-sub-title -->
						</div><!-- /.banner-contents -->
					</div><!-- /.overlay -->
				</div>

			<?php } } wp_reset_postdata(); ?>

			</div><!-- /.banner-slider-01 -->
		</div><!-- /.section-padding -->
	</section><!-- /.banner-section -->


<?php } elseif($type=="six"){ ?>

	<section class="banner-section  banner-slider-02">
		<div class="section-padding">
			<div class="container">
				<div id="banner-slider" class="banner-slider owl-carousel">
                	<?php 	   
                	$query_args = array(
                		'post_type' => 'video',
                		'post_status' 	 => 'publish',
                		'posts_per_page' => $video_posts,
                	);
                	$video_posts_block = new WP_Query( $query_args );
                	if ( $video_posts_block->have_posts() ) { while ( $video_posts_block->have_posts() ) { $video_posts_block->the_post();
                		$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-cat-thumb' ) );
                		$terms = wp_get_post_terms( get_the_ID(), 'video_category', array("fields" => "all"));  

                		$t = array();                    
                		foreach($terms as $term)
                			$t[] = $term->slug;       


                		$public_video_source = videostories_meta( '_videostories_public_video_source' ); 
                		$video_external = videostories_meta( '_videostories_video_external' ); 
                		$video_self = videostories_meta( '_videostories_video_self','type=video');
                		$video_remote = videostories_meta( '_videostories_video_remote' ); 
                		$video_embed = videostories_meta('_videostories_video_embed','type=oembed');

                		switch ($public_video_source) {
                			case 'external':
                			$v_src = $video_external[0];
                			break;

                			case 'self':
                			$v_src = videostories_get_attachment_url( $video_self );
                			break;

                			case 'remote':
                			$v_src = videostories_get_attachment_url( $video_remote );
                			break;

                			default:
                			$v_src = $video_external[0];
                			break;
                		}

                	?>				
						<div class="item">
							<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-thumbnail">
									<?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-cat-thumb'); }?>
									<div class="overlay">
										<div class="play-btn">											
											<a href="<?php echo esc_url_raw( $v_src );?>" class="iframe play-video"><i class="fa fa-play"></i></a>
										</div>
									</div><!-- /.overlay -->
								</div><!-- /.entry-thumbnail -->
							</article><!-- /.post -->
						</div>

					<?php } } wp_reset_postdata(); ?>

					
				</div><!-- /.banner-slider-02 -->
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
add_shortcode( 'videostories_slider_three_six', 'candor_framework_vs_slider_three_six_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_vs_slider_three_six_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => esc_html__("Slider: Slick Slider", 'videstories'),
			"base" => "videostories_slider_three_six",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Background, Video Popup and Slider.',
			"params" => array(
				array( 
					'param_name' => 'type', 
					'heading' => __( 'Slider Type', 'videstories'), 
					'type' => 'dropdown', 
					'admin_label' => true, 
					'std' => 'three', 
					'value' => array( 
							esc_html__( 'Slider with Nav Video Posts', 'videstories') 		=> 'three', 
							esc_html__( 'Slider without Nav Video Posts', 'videstories') 	=> 'six' ) 
				),	

				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts in Slider?", 'videstories'),
					"param_name" => "video_posts",
					"value" => '5',
				),	



			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_vs_slider_three_six_shortcode_vc');