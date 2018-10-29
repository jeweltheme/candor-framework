<?php 

/**
 * The Shortcode
 */
function candor_framework_videostories_exclusive_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'title'			=> 'Exclusive Videos',
				'p_ids' 		=> '',
				'ppp' 			=> '8',
			), $atts 
		) 
	);


	
	ob_start();

	global $post;
?>


  <section class="video-contents">
  	<div class="section-padding">

  		<h2 class="section-title"><?php echo esc_attr( $title );?></h2><!-- /.section-title -->




  		<div class="exclusive-videos">
  			<div class="row">


				<?php 	 
				$exclusive_post_array = explode(',', $p_ids);
				$query_args = array(
					'post_type' => 'video',
					'post_status' 	 => 'publish',
					'posts_per_page' => $ppp,
					'ignore_sticky_posts' => true,
					'fields' => 'ids',
					'post__in'	=> $exclusive_post_array,
					'order' => 'DESC',
				);

				$i = 1;
				echo '<div class="col-md-4 col-sm-6">';

				$video_posts_block = new WP_Query( $query_args );

				$count = $video_posts_block->post_count; 

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
					

	  				
	  					<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
	  						<div class="entry-thumbnail">
	  							<?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-blog-thumb'); } else{ videostories_get_video_type($v_src, $post->ID); } ?>
	  							<a href="<?php echo esc_url_raw( $v_src );?>" class="iframe">
	  								<span class="play-video"><i class="fa fa-play-circle-o"></i></span>
	  							</a>
	  						</div><!-- /.entry-thumbnail -->
	  						<div class="entry-content">
	  							<h3 class="category-name"><a href="<?php echo get_term_link( $term->slug, 'video_category' ); ?>"><?php echo $term->name; ?></a></h3><!-- /.category-name -->
	  							<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
	  							<?php videostories_video_entry_meta();?>
	  						</div><!-- /.entry-content -->
	  					</article><!-- /.type-post -->



			       <?php 			       
			       	if ($i % 2 == 0 && ($video_posts_block->found_posts != $i)) {
			       		echo '</div><div class="col-md-4 col-sm-6">';
					} 

			       $i++; 
			       
					if( $i-1 == $count ) {
						echo '</div><!-- /.col-md-4 col-sm-6 -->';
					}

			       } } wp_reset_postdata(); wp_reset_query(); ?>


  			</div>
  		</div><!-- /.exclusive-videos -->





  	</div>
  </section>
			
<?php	
	wp_reset_postdata();
	wp_reset_query();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'videostories_exclusive', 'candor_framework_videostories_exclusive_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_videostories_exclusive_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => esc_html__("Section: Exclusive Videos", 'videstories'),
			"base" => "videostories_exclusive",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Exclusive Videos.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Section Title", 'videstories'),
					"param_name" => "title",
					"value" => 'Exclusive Videos',
				),	
				array(
					"type" => "textfield",
					"heading" => esc_html__("Video Post ID's", 'videstories'),
					"param_name" => "p_ids",
					"description" => esc_html__("Separate IDs by Comma. Ex: 1,2 etc..", 'videstories'),
					"value" => '8',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Posts Count", 'videstories'),
					"param_name" => "ppp",
					"value" => '8',
				)

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_videostories_exclusive_shortcode_vc');