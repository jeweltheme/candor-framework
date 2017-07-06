<?php 

/**
 * The Shortcode
 */
function candor_framework_videstories_trending_videos_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 					=> 'one',
				'trending_title' 		=> 'Trending:',
				'video_posts' 			=> '5',		
			), $atts 
		) 
	);

ob_start();
?>



<?php if($type=="one"){ ?>

	<section class="video-contents">
		<div class="section-padding">
			<h2 class="section-title"><?php echo esc_attr( $trending_title );?></h2><!-- /.section-title -->
			<div class="trending-slider owl-carousel owl-theme">

				<?php 	   
					$query_args = array(
						'post_type' 		=> 'video',
						'posts_per_page' 	=> $video_posts,
						'post_status' 	 	=> 'publish',						
						
						// Top Videos by View
						'meta_key' => 'post_views_count', 
						'orderby' => 'meta_value_num', 
						'order' => 'DESC',

						// Last 7 Days
						'date_query' 		=> array(
							array(
									'after' 	=> '1 month ago'
								)
							)
					);
					$video_posts_block = new WP_Query( $query_args );
					if ( $video_posts_block->have_posts() ) { while ( $video_posts_block->have_posts() ) { $video_posts_block->the_post();	
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
						$v_src = $video_external[0];
						break;
					}

				?>	

					<div class="item">
						<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-thumbnail">
								<img src="<?php echo esc_url_raw( $url ); ?>" alt="<?php the_title_attribute();?>">
								<a class="iframe" href="<?php echo esc_url_raw( $v_src );?>">
									<span class="play-video"><i class="fa fa-play-circle-o"></i></span>
								</a>
							</div><!-- /.entry-thumbnail -->
							<div class="entry-content">
								<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
								<?php videostories_video_entry_meta();?>
							</div><!-- /.entry-content -->

						</article><!-- /.type-post -->
					</div><!-- /.item -->

				<?php } } wp_reset_postdata(); wp_reset_query(); ?>

			</div><!-- /.trending-slider -->
		</div>
	</section>

<?php } elseif($type=="two"){ ?>

	<section class="trending-titles">
		<div class="container">
			<div class="left-panel">
				<i class="fa fa-bullhorn"></i>
				<h2 class="section-title"><?php echo esc_attr( $trending_title );?></h2>
			</div><!-- /.left-panel -->

			<div class="right-panel">
				<div class="title-slider owl-carousel owl-theme">

					<?php 	   
						$query_args = array(
							'post_type' 		=> 'video',
							'posts_per_page' 	=> $video_posts,
							'post_status' 	 	=> 'publish',
							'order' 			=> 'DESC',
							
							// Top Videos by View
							'meta_key' => 'post_views_count', 
							'orderby' => 'meta_value_num', 							

							// Last 7 Days
							'date_query' 		=> array(
								array(
										'after' 	=> '1 month ago'
									)
								)
						);
						$video_posts_block = new WP_Query( $query_args );
						if ( $video_posts_block->have_posts() ) { while ( $video_posts_block->have_posts() ) { $video_posts_block->the_post();				
					?>

						<div class="item">
							<article>
								<h3 class="entry-title">
									<a href="<?php the_permalink();?>">
										<i class="fa fa-play-circle-o"></i>
										<?php the_title();?>
									</a>
								</h3>
							</article>
						</div><!-- /.item -->
					
					<?php } } wp_reset_postdata(); wp_reset_query(); ?>

				</div><!-- /.title-slider -->
			</div><!-- /.right-panel -->
		</div><!-- /.container -->
	</section><!-- /.trending-titles -->


<?php } ?>


<?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode( 'videstories_trending_videos', 'candor_framework_videstories_trending_videos_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_videstories_trending_videos_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => __("Trending Videos", 'videstories'),
			"base" => "videstories_trending_videos",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Trending Videos.',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Trending Title", 'videstories'),
					"param_name" => "trending_title",
					'holder' => '',
					'value' => 'Trending:',
				),				
				array(
					"type" => "textfield",
					"heading" => __("Video Posts Count", 'videstories'),
					"param_name" => "video_posts",
					'holder' => '',
					'value' => '5',
				),	

				array( 
					'param_name' => 'type', 
					'heading' => __( 'Layout', 'videstories'), 
					'type' => 'dropdown', 
					'admin_label' => true, 
					'std' => 'one', 
					'value' => array( 
							esc_html__( 'Videos with Thumbnails', 'videstories') 				=> 'one', 
							esc_html__( 'Topbar Scroll Trending Videos', 'videstories') 		=> 'two' ) 
				),	



			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_videstories_trending_videos_shortcode_vc' );