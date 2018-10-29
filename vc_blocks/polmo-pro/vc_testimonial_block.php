<?php 

/**
 * The Shortcode
 */
function candor_framework_polmo_pro_testimonial_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'testimonial_title' => '<span>Our</span> Testimonials',
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

	$testimonials = candor_get_custom_posts("testimonial", $testimonial_posts);
?>


  <div id="testimonial" class="testimonial text-center" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="0">
    <div class="pattern-overlay">
      <div class="section-padding">
        <div class="container">
          <div class="section-top wow animated fadeInUp" data-wow-delay=".5s">
              <h2 class="section-title">
                <?php echo $testimonial_title; ?>
              </h2><!-- /.section-title -->
          </div><!-- /.section-top -->
          <div class="section-details wow animated fadeInUp" data-wow-delay=".5s">
            <div id="testimonial-slider" class="testimonial-slider carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <?php for($i = 0; $i<count($testimonials); $i++){ ?>
                  <li data-target="#testimonial-slider" data-slide-to="<?php echo $i;?>" class="<?php echo ( ($i == 0) ? "active" : "" );?>"></li>
                <?php } ?>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <?php 
                $i = 0;
                foreach ($testimonials as $key =>$post) {
                  setup_postdata($post);

                  $testimonial_client_name 		= get_post_meta( $post->ID, '_polmo_pro_testimonial_client_name',true );
                  $testimonial_client_designation = get_post_meta( $post->ID, '_polmo_pro_testimonial_client_designation',true );
                  $testimonial_client_company 	= get_post_meta( $post->ID, '_polmo_pro_testimonial_client_company',true );
                  $testimonial_comments 			= get_post_meta( $post->ID, '_polmo_pro_testimonial_comments',true );
                  $testimonial_client_url 		= get_post_meta( $post->ID, '_polmo_pro_testimonial_client_url',true );
                ?>
                  <div class="item <?php echo ( ($key == 0) ? "active" : "" );?>">
                    <blockquote class="client-quote">
                      <?php echo $testimonial_comments; ?>
                    </blockquote><!-- /.client-quote -->
                  </div><!-- /.item -->
                <?php 
                    $i++;
                  } 
                wp_reset_postdata();
                ?>
              </div>
            </div><!-- /#testimonial-slider -->
          </div><!-- /.section-details -->
        </div><!-- /.container -->
      </div><!-- /.section-padding -->
    </div><!-- /.pattern-overlay -->
  </div><!-- /#testimonial -->

  
			
<?php	
	wp_reset_postdata();
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'polmo_testimonial', 'candor_framework_polmo_pro_testimonial_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_polmo_pro_testimonial_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'polmo-pro-vc-block',
			"name" => esc_html__("Testimonial", 'polmo-pro'),
			"base" => "polmo_testimonial",
			"category" => esc_html__('Polmo Pro WP Theme', 'polmo-pro'),
			'description' => 'Show Testimonial posts with layout options.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Section Title", 'elevation'),
					"param_name" => "testimonial_title",
					'holder' => 'h2',
					'value' => '<span>Our</span> Testimonials'
					),
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
add_action( 'vc_before_init', 'candor_framework_polmo_pro_testimonial_shortcode_vc');