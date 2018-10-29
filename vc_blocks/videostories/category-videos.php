<?php 

/**
 * The Shortcode
 */
function candor_framework_videstories_cat_video_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'cat_title' 			=> 'Music Vidoes',
				'video_posts' 			=> '5',		
				'video_cat_id' 			=> '3',		
			), $atts 
		) 
	);

ob_start();
?>

<section class="video-contents">
	<div class="section-padding">

		<h2 class="section-title"><?php echo esc_attr( $cat_title );?></h2><!-- /.section-title -->

		<div class="music-video-slider owl-carousel owl-theme">

			<?php 	   
				$query_args = array(
					'post_type' 		=> 'video',
					'posts_per_page' 	=> $video_posts,
					'post_status' 	 	=> 'publish',											
					'tax_query' => array(
						array(
							'taxonomy' => 'video_category',
							'field'    => 'term_id',
							'terms'		=> $video_cat_id
							),
						),
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
					$v_src = $video_external;
					break;
				}
			?>	

					<div class="item">
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
							</div><!-- /.entry-content -->
						</article><!-- /.type-post -->
					</div><!-- /.item -->

			<?php } } wp_reset_postdata(); ?>


		</div><!-- /.music-video-slider -->
	</div>
</section>

<?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode( 'videstories_cat_video', 'candor_framework_videstories_cat_video_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_videstories_cat_video_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => __("Section: Category Videos", 'videstories'),
			"base" => "videstories_cat_video",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Trending Videos.',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Trending Title", 'videstories'),
					"param_name" => "cat_title",
					'holder' => '',
					'value' => 'Music Vidoes',
				),				
				array(
					"type" => "textfield",
					"heading" => __("Video Category ID", 'videstories'),
					"param_name" => "video_cat_id",
					'holder' => '',
					'value' => '5',
				),	
				array(
					"type" => "textfield",
					"heading" => __("Video Posts Count", 'videstories'),
					"param_name" => "video_posts",
					'holder' => '',
					'value' => '5',
				),	



			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_videstories_cat_video_shortcode_vc' );