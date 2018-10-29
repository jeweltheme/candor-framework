<?php 

/**
 * The Shortcode
 */
function candor_framework_vs_slider_two_five_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'two',
			), $atts 
		) 
	);

	ob_start();

	global $post;

?>
  	


<?php if($type=="two"){ ?>

  <section class="banner-section banner-posts">

  	<?php 
	  	$do_not_duplicate = array();
	  	$query_args = array(
	  		'post_type' => 'video',
	  		'post_status' 	 => 'publish',
	  		'posts_per_page' => "1",
	  	);
	  	$video_posts_block_big = new WP_Query( $query_args );
		
		if ( $video_posts_block_big->have_posts() ) { while ( $video_posts_block_big->have_posts() ) { $video_posts_block_big->the_post();
			$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-cat-thumb' ) );
			$terms = wp_get_post_terms( get_the_ID(), 'video_category', array("fields" => "all"));  

			$do_not_duplicate[] = $post->ID;
		?>

			<div class="col-md-6">
				<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-thumbnail">						
						<?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-cat-thumb'); }?>
					</div><!-- /.entry-thumbnail -->
					<div class="entry-content">
						<span><?php 
									foreach ($terms as $term) {
										$url = get_term_link($term->slug, 'video_category');
										echo "<a href='$url' class='category'>{$term->name}</a>";
						} ?></span><!-- /.category -->
						<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
						<div class="entry-meta">
							<?php echo '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';?>
    						<span><i class="fa fa-clock-o"></i> <time datetime="PT5M"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?></time></span>
    						<span><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i> <span class="count"><?php comments_number( '0', '1', '%' );?></span></a></span>
    						<span><i class="fa fa-eye"></i> <span class="count"><?php echo videostories_getPostViews(get_the_ID());?></span></span>
						</div><!-- /.entry-meta -->
					</div><!-- /.entry-content -->
				</article><!-- /.post -->
			</div>

    	<?php } } wp_reset_postdata(); ?>



    <div class="col-md-6">
  		<?php 	  	
	  	$query_args = array(
	  		'post_type' 	 => 'video',
	  		'posts_per_page' => "4",
	  		'post_status' 	 => 'publish',
	  		'offset'         => 1,
	  		'post__not_in' 	 => $do_not_duplicate,
	  	);
	  	$video_posts_block = new WP_Query( $query_args );
		
		if ( $video_posts_block->have_posts() ) { while ( $video_posts_block->have_posts() ) { $video_posts_block->the_post();
			if (in_array($post->ID, $do_not_duplicate)) continue;

			$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-blog' ) );
			$terms = wp_get_post_terms( get_the_ID(), 'video_category', array("fields" => "all"));  			
		?>

			<div class="col-sm-6">
				<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-thumbnail">						
						<?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-blog'); }?>
					</div><!-- /.entry-thumbnail -->
					<div class="entry-content">
						<span><?php 
								foreach ($terms as $term) {
									$url = get_term_link($term->slug, 'video_category');
									echo "<a href='$url' class='category'>{$term->name}</a>";										
						} ?></span><!-- /.category -->
						<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
						<div class="entry-meta">
							<?php echo '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';?>
    						<span><i class="fa fa-clock-o"></i> <time datetime="PT5M"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) ; ?></time></span>
    						<span><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i> <span class="count"><?php comments_number( '0', '1', '%' );?></span></a></span>
    						<span><i class="fa fa-eye"></i> <span class="count"><?php echo videostories_getPostViews(get_the_ID());?></span></span>
						</div><!-- /.entry-meta -->
					</div><!-- /.entry-content -->
				</article><!-- /.post -->
			</div>

		<?php } } wp_reset_postdata(); ?>


    </div>
  </section><!-- /.banner-section -->

<?php } elseif($type=="five"){ ?>


    <section class="banner-section banner-posts banner-posts-02">

    	<div class="video-posts-slider">
	        <div class="col-sm-3">


			  	<?php 
				  	$do_not_duplicate = array();
				  	$query_args = array(
				  		'post_type' => 'video',
				  		'post_status' 	 => 'publish',
				  		'posts_per_page' => "2",
				  		);
				  	$left_block = new WP_Query( $query_args );
					
					if ( $left_block->have_posts() ) { while ( $left_block->have_posts() ) { $left_block->the_post();					
						$terms = wp_get_post_terms( get_the_ID(), 'video_category', array("fields" => "all"));  

						$do_not_duplicate[] = $post->ID;
					?>


			            <article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
			                <div class="entry-thumbnail">
			                	<?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-blog'); }?>
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
			            </article><!-- /.post -->


		    	<?php } } wp_reset_postdata(); ?>
	        </div>

	        <?php 	  	
	        $do_not_duplicate = array();
	        $query_args = array(
	        	'post_type' 	 => 'video',
	        	'posts_per_page' => "1",
	        	'post_status' 	 => 'publish',
	        	'offset'         => 2,	  		
	        	'post__not_in' 	 => $do_not_duplicate,
	        	);
	        $center_block = new WP_Query( $query_args );

	        if ( $center_block->have_posts() ) { while ( $center_block->have_posts() ) { $center_block->the_post();
	        	if (in_array($post->ID, $do_not_duplicate)) continue;

	        	$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-blog' ) );
	        	$terms = wp_get_post_terms( get_the_ID(), 'video_category', array("fields" => "all"));  			
	        	?>

			        <div class="col-sm-6">
			            <article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
			                <div class="entry-thumbnail">
			                	<?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-cat-thumb'); }?>
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
			            </article><!-- /.post -->
			        </div>
			
			<?php } } wp_reset_postdata(); ?>


	        <div class="col-sm-3">
	        	<?php 	  	
	        	$query_args = array(
	        		'post_type' 	 => 'video',
	        		'posts_per_page' => "2",
	        		'post_status' 	 => 'publish',
	        		'offset'         => 3,	  		
	        		'post__not_in' 	 => $do_not_duplicate,
	        		);
	        	$right_block = new WP_Query( $query_args );

	        	if ( $right_block->have_posts() ) { while ( $right_block->have_posts() ) { $right_block->the_post();
	        		if (in_array($post->ID, $do_not_duplicate)) continue;

	        		$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-blog' ) );
	        		$terms = wp_get_post_terms( get_the_ID(), 'video_category', array("fields" => "all"));  			
	        		?>

		        		<article id="video-<?php the_ID(); ?>" <?php post_class(); ?>>
		        			<div class="entry-thumbnail">
		        				<?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-blog'); }?>
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
		        		</article><!-- /.post -->

	            <?php } } wp_reset_postdata(); ?>

	        </div>

        </div>
    </section><!-- /.banner-section -->



<?php } ?>


			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'videostories_slider_two_five', 'candor_framework_vs_slider_two_five_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_vs_slider_two_five_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => esc_html__("Slider: Video Posts Block", 'videstories'),
			"base" => "videostories_slider_two_five",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Video Posts Block Slider.',
			"params" => array(
				array( 
					'param_name' => 'type', 
					'heading' => __( 'Slider Type', 'videstories'), 
					'type' => 'dropdown', 
					'admin_label' => true, 
					'std' => 'two', 
					'value' => array( 
							esc_html__( 'Left Big Video', 'videstories') 	=> 'two', 
							esc_html__( 'Center Big Video', 'videstories') 	=> 'five' ) 
				),
			

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_vs_slider_two_five_shortcode_vc');