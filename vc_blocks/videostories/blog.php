<?php 

/**
 * The Shortcode
 */
function candor_framework_videstories_blog_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 					=> 'one',
				'blog_title' 			=> 'Newest Blog Posts',	
				'ppp' 					=> 2,	
				'filter' 				=> 'all'
			), $atts 
		) 
	);

ob_start();

	global $post;

	
	// Fix for pagination
	if( is_front_page() ) { 
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 
	} else { 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
	}
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'post',
		'ignore_sticky_posts' => true,
		'posts_per_page' => $ppp,
		'paged' => $paged
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	$block_query = new WP_Query( $query_args );


?>



<?php if($type=="one"){ ?>

  <section class="video-contents">
    <div class="section-padding">
      
        <h2 class="section-title"><?php echo esc_attr( $blog_title ); ?></h2><!-- /.section-title -->

        <div class="latest-posts">
          	<div class="row">
          		<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post(); ?>

              		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              			<div class="col-md-6">
              				<div class="entry-thumbnail">
              					<?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-blog'); }?>
              				</div><!-- /.entry-thumbnail -->
              			</div>

              			<div class="col-md-6">
              				<div class="entry-content">
              					<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
              					<?php videostories_blog_entry_meta();?>
              					<p>
              						<?php echo wp_trim_words( get_the_content(), 40, ' '  ); ?>
              					</p>
              					<?php videostories_read_more();?>
              				</div><!-- /.entry-content -->
              			</div>
              		</article><!-- /.type-post -->

              	<?php } } wp_reset_postdata();?>

          	</div>
        </div><!-- /.latest-posts -->
            

    </div><!-- /.section-padding -->
  </section><!-- /.video-contents -->



<?php } elseif($type=="two"){ ?>


    <section class="latest-posts latest-posts-02">
        <div class="section-padding">
            <div class="container">
                <h2 class="section-title"><?php echo esc_attr( $blog_title ); ?></h2><!-- /.section-title -->
                <div class="row">

              		<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post(); 
              			$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-blog-thumb' ) );              			
              			?>

		                	<div class="col-sm-6">
		                		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		                			<div class="entry-thumbnail">
		                				<?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-blog'); }?>
		                			</div><!-- /.entry-thumbnail -->

		                			<div class="entry-content">
		                				<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><!-- /.entry-title -->
		                				<?php videostories_blog_entry_meta();?>
		                				<p>
		                					<?php echo wp_trim_words( get_the_content(), 40, ' '  ); ?>
		                				</p>
		                				<?php videostories_read_more();?>
		                			</div><!-- /.entry-content -->

		                		</article><!-- /.type-post -->
		                	</div>

		            <?php } } wp_reset_postdata(); ?>


                </div>
            </div>
        </div><!-- /.section-padding -->
    </section><!-- /.latest-posts -->



<?php } ?>



<?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_shortcode( 'videstories_blog', 'candor_framework_videstories_blog_shortcode' );

/**
 * The VC Functions
 */
function candor_framework_videstories_blog_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'videstories-vc-block',
			"name" => __("Section: Blog", 'videstories'),
			"base" => "videstories_blog",
			"category" => esc_html__('VideoStories WP Theme', 'videstories'),
			'description' => 'Show Blog Posts.',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Section Title", 'videstories'),
					"param_name" => "blog_title",
					'holder' => '',
					'value' => 'Newest Blog Posts',
				),					
				array(
					"type" => "textfield",
					"heading" => __("Post Count", 'videstories'),
					"param_name" => "ppp",
					'description' => esc_html__( 'How many Posts will show on Blog', 'videstories'), 
					'holder' => '',
					'value' => '2',
				),				

				array( 
					'param_name' => 'type', 
					'heading' => __( 'Layout', 'videstories'), 
					'type' => 'dropdown', 
					'admin_label' => true, 
					'std' => 'one', 
					'value' => array( 
							esc_html__( 'Style 1', 'videstories') 					=> 'one', 
							esc_html__( 'Style 2', 'videstories') 					=> 'two' 							
						) 
					),	



			)
		) 
	);
}
add_action( 'vc_before_init', 'candor_framework_videstories_blog_shortcode_vc' );