<?php 

/**
 * The Shortcode
 */
function candor_framework_main_causes_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'carousel',
				'pppage' 			=> '6',
				'filter'	 		=> 'all'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' 		=> 'causes',
		'posts_per_page' 	=> $pppage
	);
	
	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'causes_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'causes_category',
				'field' => 'id',
				'terms' => $filter
			)
		);
	}

	ob_start();
?>



        <section class="causes">
            <div class="container">
              <div class="section-details">
                <div id="causes-slider" class="causes-slider owl-carousel">
                  	<?php 
                  	$causes = candor_get_custom_posts("causes", $pppage);

                  	foreach ($causes as $key =>$post) {
                  		setup_postdata($post);


					    $main_causes_currency 			= get_post_meta( $post->ID, '_elevation_causes_currency',true );
					    $main_causes_raised 			= get_post_meta( $post->ID, '_elevation_causes_raised',true );
					    $main_causes_goal			 	= get_post_meta( $post->ID, '_elevation_causes_goal',true );

						
						$main_causes_image 				= wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'elevation-home-causes') );	

						$percentage = ( $main_causes_raised / $main_causes_goal ) * 100;

						$round_percentage = round($percentage);
                  	?>
		                  <div class="item">
		                    <div class="item-image">
		                      <img src="<?php echo esc_url_raw( $main_causes_image ); ?>" alt="<?php echo get_the_title($post->ID);?> Image">
		                      <div class="item-progress">
		                        <div class="progress">
		                          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo esc_attr( $round_percentage );?>%;">
		                            <div class="sr-only">
		                              <div class="reach"><?php echo esc_html__('Raised', 'elevation');?> <span class="currency"><?php echo esc_attr( $main_causes_currency ); ?></span><span class="amount"><?php echo esc_attr( $main_causes_raised ); ?></span></div>
		                              <div class="complete"><?php echo esc_attr( $round_percentage );?>%</div>
		                            </div>
		                          </div><!-- /.progress-bar -->
		                        </div><!-- /.progress -->
		                      </div><!-- /.item-progress -->
		                    </div><!-- /.item-image -->
		                    <div class="item-content">
		                      <h4 class="item-title"><a href="<?php echo get_the_permalink($post->ID);?>"><?php echo get_the_title($post->ID);?></a></h4><!-- /.item-title -->
		                      <div class="target"><?php echo esc_html__('Goal:', 'elevation');?> <span class="currency"><?php echo esc_attr( $main_causes_currency ); ?></span><span class="amount"><?php echo esc_attr( $main_causes_goal ); ?></span></div>
		                      
		                      <p class="item-description"><?php echo wp_trim_words( get_the_content(), 20, ' '  ); ?></p>

		                      <?php echo elevation_cause_donation_button($post->ID);?>

		                    </div><!-- /.item-content -->
		                  </div><!-- /.item -->
					<?php } ?>

                </div><!-- /#causes-slider -->
              </div><!-- /.section-details -->
            </div><!-- /.container -->
        </section><!-- /#causes --> 


			
<?php	
	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'elevation_causes', 'candor_framework_main_causes_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_main_causes_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => __("Main Causes", 'elevation'),
			"base" => "elevation_causes",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			'description' => 'Show Causes posts.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'elevation'),
					"param_name" => "pppage",
					"value" => '4'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_main_causes_shortcode_vc');