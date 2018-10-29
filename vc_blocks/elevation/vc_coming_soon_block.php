<?php 

/**
 * The Shortcode
 */
function candor_framework_coming_soon_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' 				=> 'carousel',
				'pppage' 			=> '6',
				'filter'	 		=> 'all'
			), $atts 
		) 
	);
?>


        <section id="landing-banner" class="landing-banner text-center" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="0">
          <div class="section-padding">
            <div class="container">
              <div class="section-top">
                <h2 class="landing-title">We will be live in</h2><!-- /.landing-title -->
                <p class="section-description">
                  Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus
                </p><!-- /.section-description -->
              </div><!-- /.section-top -->
              
              <div class="section-border">
                <div class="border-style">
                  <span></span>
                </div><!-- /.border-style -->
              </div><!-- /.section-border -->

              <div class="section-details">
                <div id="time_countdown10" class="time-count-container">
                  <div class="time-box">
                    <div class="time-box-inner dash days_dash">
                      <span class="time-number">
                        <span class="digit">0</span>
                        <span class="digit">0</span>
                        <span class="digit">0</span>
                      </span><!-- /.time-number -->
                      <span class="time-name">Days</span>
                    </div><!-- /.time-box-inner -->
                  </div><!-- /.time-box -->
                  <div class="time-box">
                    <div class="time-box-inner dash hours_dash">
                      <span class="time-number">
                        <span class="digit">0</span>
                        <span class="digit">0</span>
                        <span class="digit">0</span>
                      </span><!-- /.time-number -->
                      <span class="time-name">Hours</span>
                    </div><!-- /.time-box-inner -->
                  </div><!-- /.time-box -->
                  <div class="time-box">
                    <div class="time-box-inner dash minutes_dash">
                      <span class="time-number">
                        <span class="digit">0</span>
                        <span class="digit">0</span>
                        <span class="digit">0</span>
                      </span><!-- /.time-number -->
                      <span class="time-name">Mins</span>
                    </div><!-- /.time-box-inner -->
                  </div><!-- /.time-box -->
                  <div class="time-box">
                    <div class="time-box-inner dash seconds_dash">
                      <span class="time-number">
                        <span class="digit">0</span>
                        <span class="digit">0</span>
                        <span class="digit">0</span>
                      </span><!-- /.time-number -->
                      <span class="time-name">Sec</span>
                    </div><!-- /.time-box-inner -->
                  </div><!-- /.time-box -->
                </div><!-- /#time_countdown -->

                <div class="btn-container">
                  <a href="#" class="btn btn-lg">Subscribe Now</a>
                </div><!-- /.btn-container -->
              </div><!-- /.section-details -->
            </div><!-- /.container -->
          </div><!-- /.section-paddng -->
        </section><!-- /#landing-banner -->

        


        <section id="causes" class="causes">
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
		                      <h4 class="item-title"><?php echo get_the_title($post->ID);?></h4><!-- /.item-title -->
		                      <div class="target"><?php echo esc_html__('Goal:', 'elevation');?> <span class="currency"><?php echo esc_attr( $main_causes_currency ); ?></span><span class="amount"><?php echo esc_attr( $main_causes_goal ); ?></span></div>
		                      
		                      <p class="item-description"><?php echo wp_trim_words( get_the_content(), 25, ' '  ); ?></p>

		                      <div class="btn-container">
		                        <a href="<?php echo get_the_permalink($post->ID);?>" class="btn btn-xsm donate-btn"><?php echo esc_html__('Donate', 'elevation');?></a>
		                      </div><!-- /.btn-container -->
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
add_shortcode( 'elevation_coming_soon', 'candor_framework_coming_soon_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_coming_soon_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => __("Main Causes", 'elevation'),
			"base" => "elevation_coming_soon",
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
add_action( 'vc_before_init', 'candor_framework_coming_soon_shortcode_vc');