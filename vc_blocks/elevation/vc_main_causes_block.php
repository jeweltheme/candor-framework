<?php 

/**
 * The Shortcode
 */
function candor_framework_main_causes_shortcode( $atts, $content= null  ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'carousel',
				'pppage' 			=> '6',
				'causes_category' 	=> '16',
				'filter'	 		=> 'all'
			), $atts 
		) 
	);
	
	/**
	 * Setup post query
	 */
	$query_args = array(
			'post_type' 		=> 'causes',
			'posts_per_page'	=> $pppage,

			'tax_query' => array(
				array(
					'taxonomy' => 'causes_category',
					'terms' => $causes_category,
					'field' => 'name',
					)
				),
			'orderby' => 'title',
			'order' => 'ASC'
		);

	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'causes_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'causes_category',
				'field' => 'term_id',
				'terms' => $filter
			)
		);
	}

	$cause_query = new WP_Query( $query_args );
	
	//print_r($cause_query);


	ob_start();
?>



        <section class="causes">
            <div class="container">
              <div class="section-details">
                <div id="causes-slider" class="causes-slider owl-carousel">
                  	<?php 


					if ( $cause_query->have_posts() ) { while ( $cause_query->have_posts() ) { $cause_query->the_post();
						global $post;

					    $main_causes_currency 			= candor_framework_meta( '_elevation_causes_currency' );
					    $main_causes_raised 			= candor_framework_meta( '_elevation_causes_raised' );
					    $main_causes_goal			 	= candor_framework_meta( '_elevation_causes_goal');

						
						$main_causes_image 				= wp_get_attachment_url( get_post_thumbnail_id( get_the_ID(), 'elevation-home-causes') );	

						$percentage = ( $main_causes_raised / $main_causes_goal ) * 100;

						$round_percentage = round($percentage);
                  	?>
		                  <div class="item">
		                    <div class="item-image">
		                      <img src="<?php echo esc_url_raw( $main_causes_image ); ?>" alt="<?php echo get_the_title(get_the_ID());?> Image">
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
		                      <h4 class="item-title"><a href="<?php echo get_the_permalink(get_the_ID());?>"><?php echo get_the_title(get_the_ID());?></a></h4><!-- /.item-title -->
		                      <div class="target"><?php echo esc_html__('Goal:', 'elevation');?> <span class="currency"><?php echo esc_attr( $main_causes_currency ); ?></span><span class="amount"><?php echo esc_attr( $main_causes_goal ); ?></span></div>
		                      
		                      <p class="item-description"><?php echo wp_trim_words( get_the_content(), 20, ' '  ); ?></p>

		                      <?php echo elevation_cause_donation_button(get_the_ID());?>

		                    </div><!-- /.item-content -->
		                  </div><!-- /.item -->
					<?php } } ?>

                </div><!-- /#causes-slider -->
              </div><!-- /.section-details -->
            </div><!-- /.container -->
        </section><!-- /#causes --> 


			
<?php	
	wp_reset_postdata();
	wp_reset_query();
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
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Causes Category', 'elevation' ),
					'param_name' => 'causes_category',
					'value'		  => '',
					'description' => esc_html__( 'List of Causes categories', 'elevation' ),
				),

			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_main_causes_shortcode_vc');