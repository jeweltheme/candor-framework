<?php 

/**
 * The Shortcode
 */
function candor_framework_testimonial_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'carousel',
				'testimonial_posts' => '5',
				'filter'	 		=> 'all'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' 		=> 'testimonial',
		'posts_per_page' 	=> $testimonial_posts
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'testimonial_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'testimonial_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	ob_start();
?>
   <div class="testimonial">
            <div class="section-padding">

                <div id="testimonial-slider" class="testimonial-slider carousel slide carousel-fade" data-interval="false" data-ride="carousel" data-pause="hover">
                  <div class="carousel-inner">

                  	<?php 
                  	$testimonials = candor_get_custom_posts("testimonial", $testimonial_posts);

                  	foreach ($testimonials as $key =>$post) {
                  		setup_postdata($post);


					    $testimonial_client_name 		= get_post_meta( $post->ID, '_elevation_testimonial_client_name',true );
					    $testimonial_client_designation = get_post_meta( $post->ID, '_elevation_testimonial_client_designation',true );
					    $testimonial_client_company 	= get_post_meta( $post->ID, '_elevation_testimonial_client_company',true );
					    $testimonial_comments 			= get_post_meta( $post->ID, '_elevation_testimonial_comments',true );
					    $testimonial_client_url 		= get_post_meta( $post->ID, '_elevation_testimonial_client_url',true );
						
						$testimonial_image 				= wp_get_attachment_url( get_post_thumbnail_id( $post->ID, array( 110, 110 )) );					
                  	?>
	                    <div class="item <?php echo ( ($key == 0) ? "active" : "" );?>">
	                      <div class="client-speech">
	                        <blockquote><?php echo esc_attr( $testimonial_comments ); ?></blockquote>
	                      </div><!-- /.client-speech -->
	                      <div class="speech-author media">
	                        <div class="client-image media-left"> 
	                          <img class="img-circle" src="<?php echo $testimonial_image; ?>" alt="Testimonial Image of <?php the_title();?>">
	                        </div><!-- /.client-image -->
	                        <div class="client-details media-body">
	                          <span class="client-name"><?php echo esc_attr( $testimonial_client_name ); ?></span>
	                          <span class="designation"><?php echo esc_attr( $testimonial_client_designation ); ?> <?php echo esc_html_e('-', 'elevation');?> <a href="<?php echo esc_url_raw( $testimonial_client_url );?>" target="_blank"><?php echo esc_html_e( $testimonial_client_company );?></a></span>
	                        </div><!-- /.client-details -->
	                      </div><!-- /.speech-author -->
	                    </div><!-- /.item -->
	                <?php } ?>

                  </div><!-- /.carousel-inner -->

                  <!-- Controls -->
                  <div class="carousel-controls">
                    <a class="left carousel-control" href="#testimonial-slider" role="button" data-slide="prev">
                      <span><i class="fa fa-angle-left"></i></span>
                    </a>
                    <a class="right carousel-control" href="#testimonial-slider" role="button" data-slide="next">
                      <span><i class="fa fa-angle-right"></i></span>
                    </a>
                  </div><!-- /.carousel-controls -->

                  
                </div><!-- /#testimonial-slider -->

      </div>
  </div>
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'elevation_testimonial', 'candor_framework_testimonial_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_testimonial_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => __("Testimonial", 'elevation'),
			"base" => "elevation_testimonial",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			'description' => 'Show Testimonial posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'elevation'),
					"param_name" => "testimonial_posts",
					"value" => '4'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_testimonial_shortcode_vc');