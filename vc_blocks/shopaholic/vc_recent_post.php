<?php 

/**
 * The Shortcode
 */
function candor_shopaholic_recent_post_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'recent_title' 	=> 'Recent Posts',
				'pppage' 		=> '2',
				'filter' 		=> 'all'
			), $atts 
		) 
	);
	
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
		'posts_per_page' => $pppage,
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

	ob_start();

?>



  <section class="blog blog-01 recent-posts text-center">
    <div class="section-padding">
      <div class="container">
          <div class="section-top">
            <h2 class="section-title">
            	<?php echo strip_tags( $recent_title );?><span></span>
            </h2>
          </div><!-- /.section-top -->

          <div class="section-details text-left">

          	<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post(); 
          		$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), array(440,300));
          		?>

	            <div class="col-md-6">
	              <article class="post type-post">
	                <div class="entry-thumbnail">
		                <?php if ( has_post_thumbnail() ) { ?>
		                 	<img src="<?php echo $image_thumb[0];?>" alt="<?php the_title_attribute();?>">
		                <?php } ?>
	                </div><!-- .entry-thumbnail -->

	                <div class="post-content">	                  
	                  	<h3 class="entry-title">
	                  		<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">
	                  			<?php the_title();?>
	                  		</a>
	                  	</h3><!-- /.entry-title -->

	                  	<?php shopaholic_recent_post_meta();?>

	                  	<p class="description">
	                    	<?php echo wp_trim_words( get_the_content(), 15, ' '  ); ?>
	                  	</p><!-- /.description -->
	                  	
	                  	<a href="<?php the_permalink();?>" class="btn"><?php echo esc_html__('Read More', 'shopaholic-wp');?></a>

	                </div><!-- /.post-content -->
	              </article><!-- /.post -->
	            </div>

            <?php } } wp_reset_postdata(); ?>

          </div><!-- /.section-details -->
      </div><!-- /.container -->
    </div><!-- /.section-padding -->
  </section><!-- /.blog -->



<?php



	wp_reset_postdata();
	wp_reset_query();
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'shopaholic_recent_post', 'candor_shopaholic_recent_post_shortcode' );

/**
 * The VC Functions
 */
function candor_shopaholic_recent_post_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'shopaholic-vc-block',
			"name" => esc_html__("Recent Post", 'shopaholic-wp'),
			"base" => "shopaholic_recent_post",
			"category" => esc_html__('Shopaholic WP Theme', 'shopaholic-wp'),
			'description' => 'Show Recent Posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'shopaholic-wp'),
					"param_name" => "recent_title",
					"value" => 'Recent Posts'
				),	
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'shopaholic-wp'),
					"param_name" => "pppage",
					"value" => '2'
				),	

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_shopaholic_recent_post_shortcode_vc');