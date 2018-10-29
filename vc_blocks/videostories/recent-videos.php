<?php 

/**
 * The Shortcode
 */
function candor_framework_videstories_recent_videos_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 					=> 'one',
				'recent_title' 			=> 'RECENT VIDEOS',	
			), $atts 
		) 
	);

ob_start();
global $post;
?>



<?php if($type=="one"){ ?>

	<section class="video-contents">
		<div class="section-padding">
			<h2 class="section-title"><?php echo esc_attr( $recent_title );?></h2><!-- /.section-title -->


	            <div class="recent-videos">
	              <div class="row">

					<?php 	   
						$do_not_duplicate = array();
						$query_args = array(
							'post_type' 		=> 'video',
							'posts_per_page' 	=> 1,
							'post_status' 	 	=> 'publish',
							'order' 			=> 'DESC',						

						);
						$video_left = new WP_Query( $query_args );
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

					<div class="col-md-6">
						<div class="left-panel">
							<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>																
								<div class="entry-thumbnail">									
									<?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-slider'); }?>
									<a href="<?php echo esc_url_raw( $v_src );?>" class="iframe">
										<span class="play-video"><i class="fa fa-play-circle-o"></i></span>
									</a>
								</div><!-- /.entry-thumbnail -->
								<div class="entry-content">
									<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
									<?php videostories_video_entry_meta();?>
								</div><!-- /.entry-content -->
							</article><!-- /.type-post -->
						</div><!-- /.left-panel -->
					</div>

			<?php } } wp_reset_postdata(); wp_reset_query(); ?>


	                <div class="col-md-6">
	                  <div class="right-panel">

		                  	<?php 	   
		                  	//$do_not_duplicate = array();
		                  	$query_args = array(
		                  		'post_type' 		=> 'video',
		                  		'posts_per_page' 	=> 3,
		                  		'post_status' 	 	=> 'publish',
		                  		'order' 			=> 'DESC',	
		                  		'offset'         	=> 1,
		                  		'post__not_in' 	 	=> $do_not_duplicate,					

		                  	);
		                  	$videos_right = new WP_Query( $query_args );
		                  	if ( $videos_right->have_posts() ) { while ( $videos_right->have_posts() ) { $videos_right->the_post();	
		                  		if (in_array($post->ID, $do_not_duplicate)) continue;

		                  		$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-cat-thumb' ) );		                  		

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
				                  		<div class="entry-thumbnail media-left">				                  		
				                  			<?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-movie-photos'); }?>
				                  			<a href="<?php echo esc_url_raw( $v_src );?>" class="iframe">
				                  				<span class="play-video"><i class="fa fa-play-circle-o"></i></span>
				                  			</a>
				                  		</div><!-- /.entry-thumbnail -->
				                  		<div class="entry-content media-body">
				                  			<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
				                  			<?php videostories_video_entry_meta();?>
				                  		</div><!-- /.entry-content -->
				                  	</article><!-- /.type-post -->

				            <?php } } wp_reset_postdata(); wp_reset_query(); ?>

	                  </div><!-- /.right-panel -->
	                </div>
	              </div>
	            </div><!-- /.recent-videos -->



		</div>
	</section>

<?php } elseif($type=="two"){ ?>

    <section class="recent-videos recent-videos-02">
        <div class="section-padding">
        	<div class="container">
        
            <h2 class="section-title"><?php echo esc_attr( $recent_title );?></h2><!-- /.section-title -->
            <div class="row">

                <div class="col-md-4">
                    <div class="left-panel">

                    	<?php 	   
                    	$do_not_duplicate = array();
                    	$query_args = array(
                    		'post_type' 		=> 'video',
                    		'posts_per_page' 	=> 1,
                    		'post_status' 	 	=> 'publish',
                    		'order' 			=> 'DESC',						

                    		);
                    	$video_left = new WP_Query( $query_args );
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
	                                    <?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-slider'); }?>
	                                    <a href="<?php echo esc_url_raw( $v_src );?>" class="iframe">
	                                        <span class="play-video"><i class="fa fa-play-circle-o"></i></span>
	                                    </a>
	                                </div><!-- /.entry-thumbnail -->
	                                <div class="entry-content">
	                                    <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
										<?php videostories_video_entry_meta();?>
	                                </div><!-- /.entry-content -->
	                            </article><!-- /.type-post -->
	                    
	                    <?php } } wp_reset_postdata(); wp_reset_query(); ?>

                    </div><!-- /.left-panel -->
                </div>

                <div class="col-md-4">
                    <div class="right-panel">

                    	<?php 	   
	                  	$do_not_duplicate = array();
                    	$query_args = array(
                    		'post_type' 		=> 'video',
                    		'posts_per_page' 	=> 3,
                    		'post_status' 	 	=> 'publish',
                    		'order' 			=> 'DESC',	
                    		'offset'         	=> 1,
                    		'post__not_in' 	 	=> $do_not_duplicate,					

                    		);
                    	$videos_center = new WP_Query( $query_args );
                    	if ( $videos_center->have_posts() ) { while ( $videos_center->have_posts() ) { $videos_center->the_post();	
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

                    			default:
                    			$v_src = $video_external;
                    			break;
                    		}
                    		?>
	                            <article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
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

	                    <?php } } wp_reset_postdata(); wp_reset_query(); ?>

                    </div><!-- /.right-panel -->
                </div>

                <div class="col-md-4">
                    <div class="right-panel">

                    	<?php 	  	
                    	$query_args = array(
                    		'post_type' 	 => 'video',
                    		'posts_per_page' => 3,
                    		'post_status' 	 => 'publish',
                    		'offset'         => 4,	  		
                    		'post__not_in' 	 => $do_not_duplicate,
                    		);
                    	$right_block = new WP_Query( $query_args );

                    	if ( $right_block->have_posts() ) { while ( $right_block->have_posts() ) { $right_block->the_post();
                    		if (in_array($post->ID, $do_not_duplicate)) continue;

                    		$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-blog' ) );
                    		$terms = wp_get_post_terms( get_the_ID(), 'video_category', array("fields" => "all"));  	

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
                    			$v_src = $video_external;
                    			break;
                    		}		
                    		?>

	                            <article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
	                                <div class="entry-thumbnail media-left">
	                                    <?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-movie-photos'); }?>
	                                    <a href="<?php echo esc_url_raw( $v_src );?>" class="iframe">
	                                        <span class="play-video"><i class="fa fa-play-circle-o"></i></span>
	                                    </a>
	                                </div><!-- /.entry-thumbnail -->
	                                <div class="entry-content media-body">
			                  			<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
			                  			<?php videostories_video_entry_meta();?>
	                                </div><!-- /.entry-content -->
	                            </article><!-- /.type-post -->

                         <?php } } wp_reset_postdata(); wp_reset_query(); ?>

                    </div><!-- /.right-panel -->
                </div>
            </div>
            </div>
        </div><!-- /.recent-videos -->
    </section><!-- /.recent-videos -->



<?php } ?>


<?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode( 'videstories_recent_videos', 'candor_framework_videstories_recent_videos_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_videstories_recent_videos_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => __("Section: Recent Videos", 'videstories'),
			"base" => "videstories_recent_videos",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Recent Videos.',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Recent Title", 'videstories'),
					"param_name" => "recent_title",
					'holder' => '',
					'value' => 'RECENT VIDEOS',
				),				

				array( 
					'param_name' => 'type', 
					'heading' => __( 'Layout', 'videstories'), 
					'type' => 'dropdown', 
					'admin_label' => true, 
					'std' => 'one', 
					'value' => array( 
							esc_html__( 'Grid 2 Column', 'videstories') 		=> 'one', 
							esc_html__( 'Grid 3 Column', 'videstories') 		=> 'two' 
						) 
				),	



			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_videstories_recent_videos_shortcode_vc' );