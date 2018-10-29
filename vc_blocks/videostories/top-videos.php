<?php 

/**
 * The Shortcode
 */
function candor_framework_videostories_top_videos_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'one',
				'order_by' 			=> 'post_view',
				'top_title'			=> 'Top videos',
				'ppp' 				=> '10',
			), $atts 
		) 
	);


	
	ob_start();

	
?>
  	


<?php if($type=="one"){ ?>


  <section class="top-videos">
    <div class="section-padding">
      <div class="container">

        <h2 class="section-title"><?php echo esc_attr( $top_title );?></h2><!-- /.section-title -->

        <div class="video-slider owl-carousel owl-theme">

			<?php 	 

				if( $order_by == "post_view"){
					$query_args = array(
						'post_type' => 'video',
						'post_status' 	 => 'publish',
						'posts_per_page' => $ppp,

						// Top Videos by View
						'meta_key' => 'post_views_count',
						'orderby' => 'meta_value_num', 
						'order' => 'DESC',

					);
				} if( $order_by == "last_week"){
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
				}
				

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
							<div class="entry-meta">
        						<?php echo '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';?>
        						<span><i class="fa fa-clock-o"></i> <time datetime="PT5M"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?></time></span>
        						<span><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i> <span class="count"><?php comments_number( '0', '1', '%' );?></span></a></span>
        						<span><i class="fa fa-eye"></i> <span class="count"><?php echo videostories_getPostViews(get_the_ID());?></span></span>									
							</div><!-- /.entry-meta -->
						</div><!-- /.entry-content -->
					</article><!-- /.type-post -->
				</div><!-- /.item -->
			
			<?php } } wp_reset_postdata(); wp_reset_query(); ?>
	          
        </div><!-- /.video-slider -->

      </div><!-- /.container -->
    </div><!-- /.section-padding -->
  </section><!-- /.top-videos -->





<?php } elseif($type=="two"){ ?>


    <section class="top-videos top-videos-02">
        <div class="section-padding">
            <div class="container">
            	

                <h2 class="section-title"><?php echo esc_attr( $top_title );?></h2><!-- /.section-title -->

                <div class="video-slider owl-carousel owl-theme">

					<?php 	 
					$query_args = array(
						'post_type' => 'video',
						'post_status' 	 => 'publish',
						'posts_per_page' => $ppp,

						'meta_key' => 'post_views_count', // Top Videos by View
						'orderby' => 'meta_value_num', 
						'order' => 'DESC' 
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
							$v_src = $video_external[0];
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
	                                <div class="entry-meta">
		        						<?php echo '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';?>
		        						<span><i class="fa fa-clock-o"></i> <time datetime="PT5M"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?></time></span>
		        						<span><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i> <span class="count"><?php comments_number( '0', '1', '%' );?></span></a></span>
		        						<span><i class="fa fa-eye"></i> <span class="count"><?php echo videostories_getPostViews(get_the_ID());?></span></span>									
									</div><!-- /.entry-meta -->
	                            </div><!-- /.entry-content -->
	                        </article><!-- /.type-post -->
	                    </div><!-- /.item -->

				
					<?php } } wp_reset_postdata(); ?>

                </div><!-- /.video-slider -->

            	
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.top-videos -->




<?php } ?>


			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'videostories_top_videos', 'candor_framework_videostories_top_videos_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_videostories_top_videos_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => esc_html__("Section: Top Videos", 'videstories'),
			"base" => "videostories_top_videos",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Top Videos.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Section Title", 'videstories'),
					"param_name" => "top_title",
					"value" => 'Top Videos',
				),	
				array(
					"type" => "textfield",
					"heading" => esc_html__("Posts Count", 'videstories'),
					"param_name" => "ppp",
					"value" => '10',
				),
				array(
					"type" => "dropdown",
					"heading" => __("Order By", 'videstories'),
					"param_name" => "order_by",
					"value" => array(
							esc_html__( 'Video View Count', 'videstories') 	=> 'post_view',
							esc_html__( 'Last 7 Days', 'videstories') 		=> 'last_week'
						),
				),

				array( 
					'param_name' => 'type', 
					'heading' => __( 'Layout', 'videstories'), 
					'type' => 'dropdown', 
					'admin_label' => true, 
					'std' => 'one', 
					'value' => array( 
							esc_html__( 'Style 1', 'videstories') 		=> 'one', 
							esc_html__( 'Style 2', 'videstories') 		=> 'two' 
						) 
				),	

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_videostories_top_videos_shortcode_vc');