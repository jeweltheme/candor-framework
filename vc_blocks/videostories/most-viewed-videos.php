<?php 

/**
 * The Shortcode
 */
function candor_framework_videostories_most_viewed_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'title'			=> 'Most Viewed',
				'ppp' 				=> '10',
			), $atts 
		) 
	);


	
	ob_start();

	
?>


  <section class="video-contents">
  	<div class="section-padding">

  		<h2 class="section-title"><?php echo esc_attr( $title );?></h2><!-- /.section-title -->

  		<div class="most-viewed owl-carousel">

			<?php 	 

			$query_args = array(
				'post_type' => 'video',
				'post_status' 	 => 'publish',
				'posts_per_page' => $ppp,

				// Most Viewed by View
				'meta_key' => 'post_views_count',
				'orderby' => 'meta_value_num', 
				'order' => 'DESC',
			);

			$i = 1;
			echo '<div class="item">';

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
	  					<div class="entry-thumbnail media-left">
	  						<?php the_post_thumbnail('videostories-blog-thumb');?>
	  					</div><!-- /.entry-thumbnail -->
	  					<div class="entry-content media-body">
	  						<h3 class="category-name"><a href="<?php echo get_term_link( $term->slug, 'video_category' ); ?>"><?php echo $term->name; ?></a></h3><!-- /.category-name -->
							<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
							<?php videostories_video_entry_meta();?>
	  					</div><!-- /.entry-content -->
	  				</article><!-- /.post -->


		       <?php 			       
		       	if ($i % 2 == 0 && ($video_posts_block->found_posts != $i)) {
		       		echo '</div><div class="item">';
				} 

		       $i++; 
		       
				if( $i-1 == $count ) {
					echo '</div><!-- /.end-item -->';
				}

		       } } wp_reset_postdata(); wp_reset_query(); ?>



  		</div><!-- /.most-viewed -->

  	</div>
  </section>
			
<?php	
	wp_reset_postdata();
	wp_reset_query();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'videostories_most_viewed', 'candor_framework_videostories_most_viewed_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_videostories_most_viewed_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => esc_html__("Section: Most Viewed", 'videstories'),
			"base" => "videostories_most_viewed",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Most Viewed.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Section Title", 'videstories'),
					"param_name" => "title",
					"value" => 'Most Viewed',
				),	
				array(
					"type" => "textfield",
					"heading" => esc_html__("Posts Count", 'videstories'),
					"param_name" => "ppp",
					"value" => '10',
				)

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_videostories_most_viewed_shortcode_vc');