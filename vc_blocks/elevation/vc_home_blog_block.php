<?php 

/**
 * The Shortcode
 */
function candor_blog_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'pppage' => '3',
				'filter' => 'all'
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
		'ignore_sticky_posts' => true,
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

	global $post;

	$block_query = new WP_Query( $query_args );

	ob_start();

?>
		

        <div class="blog">
            <div class="container">
              <div class="section-details">
                <div class="blog-post">
                  <div class="col-md-8">

                    <?php 
						$counter = 1;
                    	if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();

						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'elevation-blog-home' );
                    	
                    	//Show the left hand side column
			    		if($counter == 1) {?>
			                    <article class="post type-post">
			                      <div class="col-md-6">
			                        <div class="post-top">
			                          <div class="post-thumbnail">
			                            <img src="<?php echo esc_url_raw( $image_url[0] ); ?>" alt="<?php the_title_attribute();?>">
			                          </div><!-- /.post-thumbnail -->
			                          <?php echo elevation_post_date();?>
			                        </div><!-- /.post-top -->
			                      </div>

			                      <div class="col-md-6">
			                        <div class="post-content">
			                          <h3 class="entry-title">
			                            <a href="<?php the_permalink();?>"><?php the_title();?></a>
			                          </h3><!-- /.entry-title -->
			                          <p class="entry-content">
			                            <?php echo wp_trim_words( get_the_content(), 22, ' '  ); ?>
			                          </p><!-- /.entry-content -->
			                          <div class="btn-container">
			                            <a href="<?php the_permalink();?>" class="btn btn-xsm"><?php echo esc_html__('Read More','elevation');?></a>
			                          </div><!-- /.btn-container -->
			                        </div><!-- /.post-content -->
			                      </div>
			                    </article><!-- /.type-post -->
			    		
			    		
			    		<?php
			    		}
						//Show the middle column
			    		elseif( $counter == 2) {
			    			?>
					    		<article class="post type-post">
					    			<div class="col-md-6">
					    				<div class="post-content">
					    					<h3 class="entry-title">
					    						<a href="<?php the_permalink();?>"><?php the_title();?></a>
					    					</h3><!-- /.entry-title -->
					    					<p class="entry-content">
					    						<?php echo wp_trim_words( get_the_content(), 22, ' '  ); ?>
					    					</p><!-- /.entry-content -->
					    					<div class="btn-container">
					    						<a href="<?php the_permalink();?>" class="btn btn-xsm"><?php echo esc_html__('Read More','elevation');?></a>
					    					</div><!-- /.btn-container -->
					    				</div><!-- /.post-content -->
					    			</div>

					    			<div class="col-md-6">
					    				<div class="post-top">
					    					<div class="post-thumbnail">
					    						<img src="<?php echo esc_url_raw( $image_url[0] ); ?>" alt="<?php the_title_attribute();?>">
					    					</div><!-- /.post-thumbnail -->
					    					<?php echo elevation_post_date();?>
					    				</div><!-- /.post-top -->
					    			</div>
					    		</article><!-- /.type-post --> 

					    	</div>

					        <?php } elseif($counter == 3) { ?>
					    		<div class="col-md-4">
					    			<article class="post type-post">
					    				<div class="col-md-6">
					    					<div class="post-top">
					    						<div class="post-thumbnail">
					    							<img src="<?php echo esc_url_raw( $image_url[0] ); ?>" alt="<?php the_title_attribute();?>">
					    						</div><!-- /.post-thumbnail -->
					    						<?php echo elevation_post_date();?>
					    					</div><!-- /.post-top -->
					    				</div>

					    				<div class="col-md-6">
					    					<div class="post-content">
					    						<h3 class="entry-title">
					    							<a href="<?php the_permalink();?>">
					    								<?php the_title();?>
					    							</a>
					    						</h3><!-- /.entry-title -->
					    						<p class="entry-content">
					    							<?php echo wp_trim_words( get_the_content(), 20, ' '  ); ?>
					    						</p><!-- /.entry-content -->
					    						<div class="btn-container">
					    							<a href="<?php the_permalink();?>" class="btn btn-xsm"><?php echo esc_html__('Read More','elevation');?></a>
					    						</div><!-- /.btn-container -->
					    					</div><!-- /.post-content -->
					    				</div>
					    			</article><!-- /.type-post -->
					    		</div>
			    		
			    		<?php }
			    			$counter++;

			    			}
			    		}   
					    wp_reset_postdata();
			    	?>





                </div><!-- /.blog-post -->
              </div><!-- /.section-details -->

              <div class="btn-container text-center">
                <a href="<?php echo elevation_get_blog_link();?>" class="btn btn-sm">
                	<?php echo esc_html__('View All','elevation');?>
                </a>
              </div><!-- /.btn-container -->
            </div><!-- /.container -->
        </div><!-- /#blog -->



			
<?php	
	
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'elevation_blog', 'candor_blog_shortcode' );

/**
 * The VC Functions
 */
function candor_blog_shortcode_vc() {
	
	$blog_types = candor_get_blog_layouts();
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => esc_html__("Home Blog", 'elevation'),
			"base" => "elevation_blog",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			'description' => 'Show blog posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show How Many Posts?", 'elevation'),
					"param_name" => "pppage",
					"value" => '3'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_blog_shortcode_vc');