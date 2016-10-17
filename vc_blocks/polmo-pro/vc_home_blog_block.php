<?php 

/**
 * The Shortcode
 */
function candor_polmo_pro_home_blog_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'blog_title' 	=> '<span>Our</span> Latest Blog Post',
				'pppage' 		=> '3',
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

	ob_start();
?>
		

	<div id="blog-posts" class="blog-posts text-center">
	    <div class="section-padding">
	      <div class="container">
	        <div class="row">
	          <div class="section-top wow animated fadeInUp" data-wow-delay=".5s">
	            <h2 class="section-title"><?php echo $blog_title; ?></h2><!-- /.section-title -->
	          </div><!-- /.section-top -->

	          <div class="section-details">
	            <div class="post-area">

	               	<?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post(); ?>

   		                <div class="col-md-4">
			                <article class="type-post post wow animated fadeInUp" data-wow-delay=".35s">
			                  <div class="post-thumbnail">
			                    <?php if ( has_post_thumbnail() ) { 
			                    	$url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'polmo-home-blog' );
			                    	?>
			                    	<img src="<?php echo esc_url( $url[0] ); ?>" alt="<?php the_title();?>" />
			                    	<?php } else{ echo polmo_pro_featured_image_placeholder();} ?>
			                  </div><!-- /.post-thumbnail -->

			                  <div class="post-content">
			                    <h4 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4><!-- /.entry-title -->
			                    <p class="entry-content">
			                      <?php echo wp_trim_words( get_the_content(), 25, ' '  ); ?>
			                    </p><!-- /.entry-content -->
			                  </div><!-- /.post-content -->
			                </article><!-- /.type-post -->
			              </div>
			    		<?php 
			    			}
			    		}   
					    wp_reset_postdata();
			    	?>


	            </div><!-- /.post-area -->

	            <div class="btn-container text-center">
	              <a class="btn more" href="<?php echo polmo_pro_get_blog_link();?>"><?php echo esc_html__('View Blog','polmo-pro');?></a>
	            </div><!-- /.btn-container -->
	          </div><!-- /.section-details -->
	        </div><!-- /.row -->
	      </div><!-- /.container -->
	    </div><!-- /.section-padding -->
	</div><!-- /#blog -->



			
<?php	
	
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'polmo_home_blog', 'candor_polmo_pro_home_blog_shortcode' );

/**
 * The VC Functions
 */
function candor_polmo_pro_home_blog_shortcode_vc() {
	
	$blog_types = candor_get_blog_layouts();
	
	vc_map( 
		array(
		    "icon" => 'polmo-pro-vc-block',
		    "name" => esc_html__("Home Blog", 'polmo-pro'),
		    "base" => "polmo_home_blog",
		    "category" => esc_html__('Polmo Pro WP Theme', 'polmo-pro'),
			'description' => 'Show blog posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Section Title", 'polmo-pro'),
					"param_name" => "blog_title",
					'holder' => 'div',
					'value'	=> '<span>Our</span> Latest Blog Post'
				),array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'polmo-pro'),
					"param_name" => "pppage",
					"value" => '3'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_polmo_pro_home_blog_shortcode_vc');