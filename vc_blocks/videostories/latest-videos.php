<?php 

/**
 * The Shortcode
 */
function candor_framework_videstories_latest_videos_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 					=> 'one',
				'title' 				=> 'Latest Videos',	
				'ppp' 					=> '8',
				'orderby' 				=> 'ID',				
			), $atts 
		) 
	);

ob_start();
global $post;
?>



<?php if($type=="one"){ ?>

	<section class="video-contents">
		<div class="section-padding">
			<h2 class="section-title"><?php echo esc_attr( $title );?></h2><!-- /.section-title -->


			<div class="latest-videos-slider owl-carousel owl-theme">


					<?php 	   
					$query_args = array(
						'post_type' 		=> 'video',
						'posts_per_page' 	=> $ppp,
						'post_status' 	 	=> 'publish',
						'orderby' 			=> $orderby,
						'order' 			=> 'DESC',
					);

					$i = 1;
					echo '<div class="item">';

					$video_posts_block = new WP_Query( $query_args );

					$count = $video_posts_block->post_count; 

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

							<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-thumbnail">
									<?php the_post_thumbnail('videostories-blog-thumb');?>
									<a href="<?php echo esc_url_raw( $v_src );?>" class="iframe">
										<span class="play-video"><i class="fa fa-play-circle-o"></i></span>
									</a>
								</div><!-- /.entry-thumbnail -->
								<div class="entry-content">
									<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
									<?php videostories_video_entry_meta();?>
								</div><!-- /.entry-content -->
							</article><!-- /.type-post -->


		       <?php 			       
		       	if ($i % 2 == 0 && ($video_posts_block->found_posts != $i)) {
		       		echo '</div><div class="item">';
				} 

		       $i++; 
		       
				if( $i-1 == $count ) {
					echo '</div><!-- /.end-item -->';
				}

		       } } wp_reset_postdata(); wp_reset_query(); ?>


			</div><!-- /.latest-videos-slider -->


		</div>
	</section>

<?php } elseif($type=="two"){ ?>

	<section class="video-contents">
		<div class="section-padding">

			<h2 class="section-title"><?php echo esc_attr( $title );?></h2><!-- /.section-title -->

			<div class="latest-videos-slider-2 owl-carousel owl-theme">
				

				<?php 	   
				$query_args = array(
					'post_type' 		=> 'video',
					'posts_per_page' 	=> $ppp,
					'post_status' 	 	=> 'publish',
					'orderby' 			=> $orderby,
					'order' 			=> 'DESC',
				);

				$i = 1;
				echo '<div class="item">';

				$video_posts_block = new WP_Query( $query_args );

				$count = $video_posts_block->post_count; 

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


						<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-thumbnail">                    
								<?php the_post_thumbnail('videostories-blog-thumb');?>
								<a href="<?php echo esc_url_raw( $v_src );?>" class="iframe">
									<span class="play-video"><i class="fa fa-play-circle-o"></i></span>
								</a>
							</div><!-- /.entry-thumbnail -->
							<div class="entry-content">
								<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
								<?php videostories_video_entry_meta();?>
							</div><!-- /.entry-content -->
						</article><!-- /.type-post -->

		       <?php 			       
		       	if ($i % 2 == 0 && ($video_posts_block->found_posts != $i)) {
		       		echo '</div><div class="item">';
				} 

		       $i++; 
		       
				if( $i-1 == $count ) {
					echo '</div><!-- /.end-item -->';
				}

		       } } wp_reset_postdata(); wp_reset_query(); ?>



			</div><!-- /.latest-videos-slider -->
	
		</div>
	</section>

<?php } elseif($type=="three"){ ?>

	<section class="latest-posts two-column">
		<div class="section-padding">
			<div class="container">
				<div class="row">
					<h2 class="section-title"><?php echo esc_attr( $title );?></h2><!-- /.section-title -->


					<?php 	   
					$query_args = array(
						'post_type' 		=> 'video',
						'posts_per_page' 	=> $ppp,
						'post_status' 	 	=> 'publish',
						'orderby' 			=> $orderby,
						'order' 			=> 'DESC',
					);

					$video_posts_block = new WP_Query( $query_args );

					if ( $video_posts_block->have_posts() ) { while ( $video_posts_block->have_posts() ) { $video_posts_block->the_post();							


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

						<div class="col-sm-6">
							<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-thumbnail">                    									
									<?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-blog'); }?>
									<a href="<?php echo esc_url_raw( $v_src );?>" class="iframe">
										<span class="play-video"><i class="fa fa-play-circle-o"></i></span>
									</a>
								</div><!-- /.entry-thumbnail -->
								<div class="entry-content">
									<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
									<?php videostories_video_entry_meta();?>
								</div><!-- /.entry-content -->
							</article><!-- /.post -->
						</div>

		       		<?php } } wp_reset_postdata(); wp_reset_query(); ?>
					

				</div>
				<?php echo function_exists('videostories_pagination') ? videostories_pagination() : posts_nav_link(); ?>
			</div><!-- /.container -->
		</div><!-- /.section-padding -->
	</section><!-- /.video-content -->



<?php } elseif($type=="four"){ ?>


<section class="video-contents">
	<div class="section-padding">

		<h2 class="section-title"><?php echo esc_attr( $title );?></h2><!-- /.section-title -->

		<div class="latest-videos-slider has-category owl-carousel owl-theme">

			<?php 	   
			$query_args = array(
				'post_type' 		=> 'video',
				'posts_per_page' 	=> $ppp,
				'post_status' 	 	=> 'publish',
				'orderby' 			=> $orderby,
				'order' 			=> 'DESC',
			);

			$i = 1;
			echo '<div class="item">';

			$video_posts_block = new WP_Query( $query_args );

			$count = $video_posts_block->post_count; 

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
							<?php the_post_thumbnail('videostories-blog-thumb');?>
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
		       		echo '</div><div class="item">';
				} 

		       $i++; 
		       
				if( $i-1 == $count ) {
					echo '</div><!-- /.end-item -->';
				}

		       } } wp_reset_postdata(); wp_reset_query(); ?>


		</div><!-- /.latest-videos-slider -->

	</div>
</section>


<?php } ?>


<?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode( 'videstories_latest_videos', 'candor_framework_videstories_latest_videos_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_videstories_latest_videos_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => __("Section: Latest Videos", 'videstories'),
			"base" => "videstories_latest_videos",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Latest Videos.',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Recent Title", 'videstories'),
					"param_name" => "title",
					'holder' => '',
					'value' => 'Latest Videos',
				),				
				array(
					"type" => "textfield",
					"heading" => esc_html__("Posts Count", 'videstories'),
					"param_name" => "ppp",
					"value" => '10',
				),
				
				array( 
					'type' => 'dropdown',
					'param_name' => 'orderby', 
					'heading' => __( 'Ordery By', 'videstories'), 					 
					'admin_label' => true, 					
					'value' => array( 
						esc_html__( 'Order By ID', 'videstories') 					=> 'ID', 
						esc_html__( 'Order By Author', 'videstories') 				=> 'author' ,
						esc_html__( 'Order By Title', 'videstories') 				=> 'title' ,
						esc_html__( 'Order By Name', 'videstories') 				=> 'name' ,
						esc_html__( 'Order By Date', 'videstories') 				=> 'date' ,
						esc_html__( 'Order By Last Modified Date', 'videstories') 	=> 'modified' ,
						esc_html__( 'Order By Random', 'videstories') 				=> 'rand' ,
						esc_html__( 'Order By Comments Number', 'videstories') 		=> 'comment_count' ,
					) 
				),					
				array( 
					'param_name' => 'type', 
					'heading' => __( 'Layout', 'videstories'), 
					'type' => 'dropdown', 
					'admin_label' => true, 
					'std' => 'one', 
					'value' => array( 
							esc_html__( 'Style 1', 'videstories') 		=> 'one', 
							esc_html__( 'Style 2', 'videstories') 		=> 'two' ,
							esc_html__( 'Style 3', 'videstories') 		=> 'three' ,
							esc_html__( 'Style 4', 'videstories') 		=> 'four' ,
					) 
				),	



			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_videstories_latest_videos_shortcode_vc' );