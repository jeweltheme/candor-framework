<?php 

/**
 * The Shortcode
 */
function candor_framework_videostories_weekly_top_videos_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'one',
				'order_by' 			=> 'post_view',
				'week_title'		=> 'Week’s Top Videos',
				'ppp' 				=> '5',
			), $atts 
		) 
	);


	
	ob_start();

	
?>
  	

<section class="video-contents">
  	<div class="section-padding">
  		

  			<h2 class="section-title"><?php echo esc_attr( $week_title ); ?></h2><!-- /.section-title -->

  			<div class="weekly-top owl-carousel owl-theme">

				<?php 	 

				$query_args = array(
					'post_type' => 'video',
					'post_status' 	 => 'publish',
					'posts_per_page' => $ppp,

					// Top Videos by View
					'meta_key' => 'post_views_count', 
					'orderby' => 'meta_value_num', 
					'order' => 'DESC',

					// Last 7 Days
					'date_query' => array(
						array(
							'after' => '1 week ago'
							)
						)
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
	  					<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
	  						<div class="entry-thumbnail">
	  							<img src="<?php echo esc_url_raw( $url ); ?>" alt="<?php the_title_attribute();?>">
	  							<a href="<?php echo esc_url_raw( $v_src );?>" class="iframe play-video"><i class="fa fa-play-circle-o"></i></a>
	  						</div><!-- /.entry-thumbnail -->
	  						<div class="entry-content">
	  							<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
	  							<?php videostories_video_entry_meta();?>
	  						</div><!-- /.entry-content -->
	  					</article><!-- /.type-post -->
	  				</div><!-- /.item -->

	  			<?php } } wp_reset_postdata(); wp_reset_query(); ?>

  			</div><!-- /.weekly-top -->

  		
  		
  	</div>
</section>

			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'videostories_weekly_top_videos', 'candor_framework_videostories_weekly_top_videos_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_videostories_weekly_top_videos_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => esc_html__("Section: Weekly Top Videos", 'videstories'),
			"base" => "videostories_weekly_top_videos",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Weekly Videos.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Section Title", 'videstories'),
					"param_name" => "week_title",
					"value" => 'Week’s Top Videos',
				),	
				array(
					"type" => "textfield",
					"heading" => esc_html__("Posts Count", 'videstories'),
					"param_name" => "ppp",
					"value" => '5',
				),

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_videostories_weekly_top_videos_shortcode_vc');