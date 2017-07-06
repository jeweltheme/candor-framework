<?php 

/**
 * The Shortcode
 */
function candor_framework_videstories_staff_picks_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 					=> 'one',
				'staff_title' 			=> 'Staff Pick\'s',	
				'video_ids' 			=> '11',	
				'bg_image' 				=> get_template_directory_uri() . '/images/603504216.jpg',
			), $atts 
		) 
	);

ob_start();
$bg_image = wp_get_attachment_image_src( $bg_image, 'full' );
global $post;
?>



<?php if($type=="one"){ ?>


<section class="parallax-section background-bg" data-image-src="<?php echo esc_url_raw($bg_image[0]);?>">
    <div class="overlay">
      <div class="section-padding">
        <div class="container">
          <h2 class="section-title"><?php echo esc_attr( $staff_title );?></h2><!-- /.section-title -->

          <div class="row">
            <div class="col-md-7">
              <div class="left-panel">
				
				<?php 	   
						$do_not_duplicate = array();
						$query_args = array(
							'post_type' 		=> 'video',
							'posts_per_page' 	=> 1,
							'post_status' 	 	=> 'publish',
							'order' 			=> 'DESC',		
							'post__in'			=> array( $video_ids )

						);
						$video_left = new WP_Query( $query_args );
//						print_r($video_left);

						if ( $video_left->have_posts() ) { while ( $video_left->have_posts() ) { $video_left->the_post();	
						$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-cat-thumb' ) );

						$do_not_duplicate[] = $post->ID;

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
						<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-thumbnail">
								<img src="<?php echo esc_url_raw( $url ); ?>" alt="<?php the_title_attribute();?>">
								<a href="<?php echo esc_url_raw( $v_src );?>" class="iframe">
									<span class="play-video"><i class="fa fa-play-circle-o"></i></span>
								</a>
							</div><!-- /.entry-thumbnail -->
							<div class="entry-content">
								<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
								<?php videostories_video_entry_meta();?>
								<p>
									<?php echo wp_trim_words( get_the_content(), 40, ' '  ); ?>
								</p>
							</div><!-- /.entry-content -->
						</article><!-- /.type-post -->

					<?php } } wp_reset_postdata(); ?>

              </div><!-- /.left-panel -->
            </div>

            <div class="col-md-5">
              <div class="right-panel">
              	<?php 	   
		        //$do_not_duplicate = array();
              	$query_args = array(
              		'post_type' 		=> 'video',
              		'posts_per_page' 	=> 3,
              	//	'post__in'			=> array( $video_ids ),
              		'post_status' 	 	=> 'publish',
              		'order' 			=> 'DESC',	
              		'offset'         	=> 1,
              		'post__not_in' 	 	=> $do_not_duplicate,					
              	);
              	$videos_right = new WP_Query( $query_args );
              	//print_r($videos_right);

              	if ( $videos_right->have_posts() ) { while ( $videos_right->have_posts() ) { $videos_right->the_post();	
              		if (in_array($post->ID, $do_not_duplicate)) continue;

              		$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-blog' ) );		                  		

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


		              	<article id="video-<?php the_ID(); ?>" <?php post_class('media'); ?>>
	              			<div class="entry-thumbnail media-left">
	              				<img src="<?php echo esc_url_raw( $url ); ?>" alt="<?php the_title_attribute();?>">
	              				<a href="<?php echo esc_url_raw( $v_src );?>" class="iframe">
	              					<span class="play-video"><i class="fa fa-play-circle-o"></i></span>
	              				</a>
	              			</div><!-- /.entry-thumbnail -->
	              			<div class="entry-content media-body">
	              				<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
	              				<?php videostories_video_entry_meta();?>
	              			</div><!-- /.entry-content -->
						</article><!-- /.type-post -->

					<?php } } wp_reset_postdata(); ?>

              </div><!-- /.right-panel -->
            </div>
          </div>
        </div><!-- /.container -->
      </div><!-- /.section-padding -->
    </div><!-- /.overlay -->
  </section><!-- /.parallax-section -->



<?php } elseif($type=="two"){ ?>

    <section class="parallax-section parallax-section-02 background-bg" data-image-src="<?php echo esc_url_raw($bg_image[0]);?>">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <h2 class="section-title"><?php echo esc_attr( $staff_title );?></h2><!-- /.section-title -->

                    <div class="row">

                        <div class="col-md-5">
                            <div class="left-panel">

				              	<?php 	   
						        $do_not_duplicate = array();
				              	$query_args = array(
				              		'post_type' 		=> 'video',
				              		'posts_per_page' 	=> 3,
				              		'post_status' 	 	=> 'publish',
				              		'order' 			=> 'DESC',	
				              		//	'post__in'			=> array( $video_ids ),			              						              		
				              	);
				              	$videos_right = new WP_Query( $query_args );
				              	if ( $videos_right->have_posts() ) { while ( $videos_right->have_posts() ) { $videos_right->the_post();	
				              		$do_not_duplicate[] = $post->ID;


				              		$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-blog' ) );		                  		

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

					              	<article id="video-<?php the_ID(); ?>" <?php post_class('media'); ?>>
	                                    <div class="entry-thumbnail media-left">
	                                        <img src="<?php echo esc_url_raw( $url ); ?>" alt="<?php the_title_attribute();?>">
	                                        <a href="<?php echo esc_url_raw( $v_src );?>" class="iframe">
	                                            <span class="play-video"><i class="fa fa-play-circle-o"></i></span>
	                                        </a>
	                                    </div><!-- /.entry-thumbnail -->
	                                    <div class="entry-content media-body">
	                                    	<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
	                                    	<?php videostories_video_entry_meta();?>
	                                    </div><!-- /.entry-content -->
									</article><!-- /.type-post -->

								<?php } } wp_reset_postdata(); ?>


                            </div><!-- /.left-panel -->
                        </div>

                        <div class="col-md-7">
                            <div class="right-panel">

                            	<?php

                            	$query_args = array(
                            		'post_type' 		=> 'video',
                            		'posts_per_page' 	=> 1,
                            		'post_status' 	 	=> 'publish',
                            		'order' 			=> 'DESC',	
                            		'offset'         	=> 1,
                            		'post__not_in' 	 	=> $do_not_duplicate,
                            		);

                            	$video_left = new WP_Query( $query_args );
                            	if ( $video_left->have_posts() ) { while ( $video_left->have_posts() ) { $video_left->the_post();	
                            		$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-cat-thumb' ) );

                            		if (in_array($post->ID, $do_not_duplicate)) continue;

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
		                                <article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
		                                    <div class="entry-thumbnail">
		                                        <img src="<?php echo esc_url_raw( $url ); ?>" alt="<?php the_title_attribute();?>">
		                                        <a href="<?php echo esc_url_raw( $v_src );?>" class="iframe">
		                                            <span class="play-video"><i class="fa fa-play-circle-o"></i></span>
		                                        </a>
		                                    </div><!-- /.entry-thumbnail -->
		                                    <div class="entry-content">
		                                        <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
												<?php videostories_video_entry_meta();?>

		                                        <p>
		                                            <?php echo wp_trim_words( get_the_content(), 40, ' '  ); ?>
		                                        </p>
		                                    </div><!-- /.entry-content -->
										</article><!-- /.type-post -->

									<?php } } wp_reset_postdata(); ?>

                            </div><!-- /.right-panel -->
                        </div>
                    </div>
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section><!-- /.parallax-section -->


<?php } elseif($type=="three"){ ?>

	<div class="video-contents">
	<div class="section-padding">
        <h2 class="section-title"><?php echo esc_attr($staff_title);?></h2><!-- /.section-title -->

        <div class="staffs-pick staff-3">
          <div class="row">
          	<?php 	 
          	$query_args = array(
          		'post_type' => 'video',
          		'post_status' 	 => 'publish',
          		'posts_per_page' => 8,
				'order' => 'DESC',
				//'post__in'	=> array( $video_ids )
			);
          	$video_posts_block = new WP_Query( $query_args );
          	if ( $video_posts_block->have_posts() ) { while ( $video_posts_block->have_posts() ) { $video_posts_block->the_post();	
          		$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-cat-thumb' ) );
          		$terms = wp_get_post_terms( get_the_ID(), 'video_category', array("fields" => "all"));  

          		$t = array();                    
          		foreach($terms as $term)
          			$t[] = $term->slug;       

         		?>  

	          		<div class="col-md-3 col-sm-6">
	          			<article id="video-<?php the_ID(); ?>" <?php post_class('media'); ?>>	          					
	          				<div class="entry-thumbnail media-left">
	          					<img src="<?php echo esc_url_raw( $url ); ?>" alt="<?php the_title_attribute();?>">
	          				</div><!-- /.entry-thumbnmail -->
	          				<div class="entry-content media-body">
	          					<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
	          				</div><!-- /.entry-content -->
	          			</article><!-- /.post -->
	          		</div>

	          	<?php } } wp_reset_postdata(); ?>

          </div>
        </div><!-- /.staffs-pick --> 

		</div>
	</div>
<?php } ?>



<?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode( 'videstories_staff_picks', 'candor_framework_videstories_staff_picks_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_videstories_staff_picks_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => __("Section: Staff Pick's", 'videstories'),
			"base" => "videstories_staff_picks",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Staff Pick\'s.',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Section Title", 'videstories'),
					"param_name" => "staff_title",
					'holder' => '',
					'value' => 'Staff Pick\'s',
				),					
				array(
					"type" => "textfield",
					"heading" => __("Video ID\'s", 'videstories'),
					"param_name" => "video_ids",
					'description' => esc_html__( 'Video ID\'s by Comma separated: Ex: 1,2,3 etc', 'videstories'), 
					'holder' => '',
					'value' => '1,2',
				),				
				array( 
					'type' => 'attach_image', 
					'heading' => esc_html__( 'Parallax Background', 'videstories'), 
					'param_name' => 'bg_image',
					'value' => get_template_directory_uri() . '/images/603504216.jpg',
					'description' => esc_html__( 'Select Slider Background from media library', 'videstories'), 
					'dependency' => array( 
						'element' => "type", 
						'value' => array( 'one', 'two')
					), 
				), 
				array( 
					'param_name' => 'type', 
					'heading' => __( 'Layout', 'videstories'), 
					'type' => 'dropdown', 
					'admin_label' => true, 
					'std' => 'one', 
					'value' => array( 
							esc_html__( 'Style 1', 'videstories') 					=> 'one', 
							esc_html__( 'Style 2', 'videstories') 					=> 'two' ,
							esc_html__( 'Style 3:Grid Layout', 'videstories') 		=> 'three' 
						) 
					),	



			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_videstories_staff_picks_shortcode_vc' );