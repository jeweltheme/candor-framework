<?php 

/**
 * The Shortcode
 */
function candor_framework_events_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'title' 			=> 'Upcoming Events',
				'type' 				=> 'carousel',
				'pppage' 			=> '5',
				'filter'	 		=> 'all',

			), $atts 
		) 
	);
	

	ob_start();

?>



  
        <!-- Events Section -->

        <section class="events">
          <div class="section-padding">
            <div class="container">

              <div class="section-top">
                <h2 class="section-sub-title"><?php echo strip_tags(trim($title));?></h2><!-- /.section-title -->
              </div><!-- /.section-top -->
              <div class="row">
                <div class="section-details">

                  <div class="col-md-5">
                    <div class="events-banner">
                      <?php 
                      //$causes1 = candor_get_custom_posts("events", 2, "DESC");
                      $do_not_duplicate = array();
                      $args = array(
                        'posts_per_page'   => 2,
                        // 'orderby'          => 'date',
                        // 'order'            => 'DESC',
                        'post_type'        => 'events'
                        );
                      $causes1 = get_posts( $args );
                      $i = 1;
                      foreach ($causes1 as $key =>$post) {
                        setup_postdata($post);


                        $event_date         = get_post_meta( $post->ID, '_elevation_event_date',true );
                        $event_place        = get_post_meta( $post->ID, '_elevation_event_place',true );
                        $event_start        = get_post_meta( $post->ID, '_elevation_event_start',true );
                        $event_end          = get_post_meta( $post->ID, '_elevation_event_end',true );

                        $old_event_start_timestamp = strtotime($event_start);
                        $old_event_end_timestamp = strtotime($event_end);
                        
                        $event_start_time = date('ga', $old_event_start_timestamp);
                        $event_end_time = date('ga', $old_event_end_timestamp);

                        $do_not_duplicate[] = $post->ID;


                        ?>

                          <div class="banner-item">
                            <div id="time_countdown<?php echo $i;?>" class="time-count-container">
                              <div class="time-box">
                                <div class="time-box-inner dash days_dash">
                                  <span class="time-name"><?php echo esc_html__('Days','elevation');?></span>
                                  <span class="time-number">
                                    <span class="digit">0</span>
                                    <span class="digit">0</span>
                                    <span class="digit">0</span>
                                  </span><!-- /.time-number -->
                                </div><!-- /.time-box-inner -->
                              </div><!-- /.time-box -->
                              <div class="time-box">
                                <div class="time-box-inner dash hours_dash">
                                  <span class="time-name"><?php echo esc_html__('Hours','elevation');?></span>
                                  <span class="time-number">
                                    <span class="digit">0</span>
                                    <span class="digit">0</span>
                                    <span class="digit">0</span>
                                  </span><!-- /.time-number -->
                                </div><!-- /.time-box-inner -->
                              </div><!-- /.time-box -->
                              <div class="time-box">
                                <div class="time-box-inner dash minutes_dash">
                                  <span class="time-name"><?php echo esc_html__('Mins','elevation');?></span>
                                  <span class="time-number">
                                    <span class="digit">0</span>
                                    <span class="digit">0</span>
                                    <span class="digit">0</span>
                                  </span><!-- /.time-number -->
                                </div><!-- /.time-box-inner -->
                              </div><!-- /.time-box -->
                              <div class="time-box">
                                <div class="time-box-inner dash seconds_dash">
                                  <span class="time-name"><?php echo esc_html__('Sec','elevation');?></span>
                                  <span class="time-number">
                                    <span class="digit">0</span>
                                    <span class="digit">0</span>
                                    <span class="digit">0</span>
                                  </span><!-- /.time-number -->
                                </div><!-- /.time-box-inner -->
                              </div><!-- /.time-box -->
                            </div><!-- /#time_countdown -->

                            <div class="event-details">
                              <h4 class="event-title"><a href="<?php echo get_the_permalink($post->ID);?>"><?php echo get_the_title($post->ID);?></a></h4>
                              <div class="event-meta">
                                <div class="event-place">
                                  <i class="fa fa-map-marker meta-icon"></i>
                                  <?php echo esc_attr($event_place);?>
                                </div><!-- /.event-place -->
                                <div class="event-time">
                                  <i class="fa fa-clock-o meta-icon"></i>
                                  <?php echo esc_html__('At','elevation');?> <?php echo esc_attr($event_start_time);?> - <?php echo esc_attr($event_end_time);?>
                                </div><!-- /.event-time -->
                              </div><!-- /.event-meta -->
                            </div><!-- /.event-details -->
                          </div><!-- /.banner-item -->


                        <?php 
                            $i++;
                          } 
                          wp_reset_postdata();
                        ?>
     

                    </div><!-- /.events-banner -->
                  </div>


                  <div class="col-md-7">
                    <div id="events-slider" class="events-slider">
                      <div class="carousel-inner" role="listbox">


                        <?php 

                        $do_not_duplicate = array();

                        $causes2 = array (
                          'post_type'              => 'events',
                          'posts_per_page'         => 3,
                          'post__not_in'           => $do_not_duplicate,
                          'offset'                 => '2'
                          ); 
                        $events_query2 = new WP_Query( $causes2 ); 

                        $i=1;
                        $j=3;

                        if ( $events_query2->have_posts() ) { ?>

                          <div class="item <?php echo ($i=1?'active':'');?>">

                        <?php
                          while ( $events_query2->have_posts() ) {
                            $events_query2->the_post(); 

                            if (in_array($post->ID, $do_not_duplicate)) continue;


                            $event_date1         = get_post_meta( get_the_ID(), '_elevation_event_date',true );
                            $event_place1        = get_post_meta( get_the_ID(), '_elevation_event_place',true );
                            $event_start1        = get_post_meta( get_the_ID(), '_elevation_event_start',true );
                            $event_end1          = get_post_meta( get_the_ID(), '_elevation_event_end',true );


                            $old_event_start_timestamp1 = strtotime($event_start1);
                            $old_event_end_timestamp1 = strtotime($event_end1);
                            
                            $event_start_time1 = date('ga', $old_event_start_timestamp1);
                            $event_end_time1 = date('ga', $old_event_end_timestamp1);
                            
                            $event_day = date_parse($event_date1);

                            $old_event_date1_timestamp = strtotime($event_date1);
                            $event_month = date('M', $old_event_date1_timestamp);

                            
                            $event_image  = get_post_meta( get_the_ID(), '_elevation_events_bg_images',true );
                            

                            //$event__hover_img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() , array('elevation-events-image')));
                            $event_img = wp_get_attachment_image_src( $event_image , 'elevation-events-image');
                            //wp_get_attachment_image_src( $product_cover_image_id, 'product-cover-image');


                             //'elevation-events-image' );
                        ?>

                            <div class="event-item media">
                              <div class="event-date media-left">
                                <time datetime="<?php echo esc_attr( $event_date1 );?>"><?php echo $event_day['day']; ?> <span class="month"><?php echo $event_month; ?></span></time>
                                <a href="<?php echo get_the_permalink();?>" class="btn btn-sm"><?php echo esc_html__('Join Now','elevation');?></a>
                              </div>
                              <div class="event-details media-body">
                                
                                <div class="event-image"><img src="<?php echo $event_img[0];?>" alt="<?php echo get_the_title();?>"></div>

                                <h4 class="event-title"><?php echo get_the_title();?></h4>
                                <div class="event-meta">
                                  <div class="event-time">
                                    <i class="fa fa-clock-o meta-icon"></i>
                                    <?php echo esc_html__('At','elevation');?> <?php echo esc_attr($event_start_time1);?> - <?php echo esc_attr($event_end_time1);?>
                                  </div><!-- /.event-time -->
                                  <div class="event-place">
                                    <i class="fa fa-map-marker meta-icon"></i>
                                    <?php echo esc_attr($event_place1);?>
                                  </div><!-- /.event-place -->
                                </div><!-- /.event-meta -->

                                <div id="time_countdown<?php echo esc_attr( $j );?>" class="time-count-container">
                                  <div class="hover-image">
                                    <?php the_post_thumbnail('elevation-events-image'); ?>
                                  </div>
                                  <div class="time-box">
                                    <div class="time-box-inner dash days_dash">
                                      <span class="time-name"><?php echo esc_html__('Days','elevation');?></span>
                                      <span class="time-number">
                                        <span class="digit">0</span>
                                        <span class="digit">0</span>
                                        <span class="digit">0</span>
                                      </span><!-- /.time-number -->
                                    </div><!-- /.time-box-inner -->
                                  </div><!-- /.time-box -->
                                  <div class="time-box">
                                    <div class="time-box-inner dash hours_dash">
                                      <span class="time-name"><?php echo esc_html__('Hours','elevation');?></span>
                                      <span class="time-number">
                                        <span class="digit">0</span>
                                        <span class="digit">0</span>
                                        <span class="digit">0</span>
                                      </span><!-- /.time-number -->
                                    </div><!-- /.time-box-inner -->
                                  </div><!-- /.time-box -->
                                  <div class="time-box">
                                    <div class="time-box-inner dash minutes_dash">
                                      <span class="time-name"><?php echo esc_html__('Mins','elevation');?></span>
                                      <span class="time-number">
                                        <span class="digit">0</span>
                                        <span class="digit">0</span>
                                        <span class="digit">0</span>
                                      </span><!-- /.time-number -->
                                    </div><!-- /.time-box-inner -->
                                  </div><!-- /.time-box -->
                                  <div class="time-box">
                                    <div class="time-box-inner dash seconds_dash">
                                      <span class="time-name"><?php echo esc_html__('Sec','elevation');?></span>
                                      <span class="time-number">
                                        <span class="digit">0</span>
                                        <span class="digit">0</span>
                                        <span class="digit">0</span>
                                      </span><!-- /.time-number -->
                                    </div><!-- /.time-box-inner -->
                                  </div><!-- /.time-box -->
                                </div><!-- /#time_countdown -->
                              </div><!-- /.event-details -->
                            </div>


                        <?php 
                              $i++;
                              $j++;
                            wp_reset_query();
                          } ?>
                          
                          </div>

                          <?php
                        }
                        ?>  


                      </div><!-- /.carousel-inner -->



                    </div><!-- /#events-slider -->
                  </div>
                </div><!-- /.section-details -->
              </div><!-- /.row -->
            </div><!-- /.container -->
          </div><!-- /.section-padding -->
        </section><!-- /#events -->



<?php
      add_action('wp_footer', 'elevation_events_countdown_script');
      function elevation_events_countdown_script(){

        $elevation_events_args1 = array (
            'post_type'              => 'events',
          ); 

        $i = 1;
          // The Query
        $events_query1 = new WP_Query( $elevation_events_args1 );  


      ?>
        <script type="text/javascript">
          jQuery(document).ready(function() {
            "use strict";

        <?php

        $args = array(
          'posts_per_page'   => 5,
          'orderby'          => 'date',
          'order'            => 'DESC',
          'post_type'        => 'events'
        );


        $events = get_posts( $args );

          foreach ($events as $post) {
            setup_postdata($post);

              $event_date = get_post_meta( $post->ID, '_elevation_event_date',true );

              $newdate = date_parse($event_date); 
          ?>


            jQuery("#time_countdown<?php echo $i; ?>").countDown({

              targetDate: {
                'day':    <?php echo $newdate['day']; ?>,
                'month':  <?php echo $newdate['month']; ?>,
                'year':   <?php echo $newdate['year']; ?>,
                'hour':   <?php echo $newdate['hour']; ?>,
                'min':    <?php echo $newdate['minute']; ?>,
                'sec':    <?php echo $newdate['second']; ?>
              },
              omitWeeks: true
            });

        <?php 
            $i++;
          } wp_reset_postdata();
        ?>
          });
           
         </script>
         <?php
      }


	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'elevation_events', 'candor_framework_events_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_events_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'elevation-vc-block',
			"name" => __("Events", 'elevation'),
			"base" => "elevation_events",
			"category" => esc_html__('Elevation WP Theme', 'elevation'),
			'description' => 'Show Events posts.',
			"params" => array(

				array(
					"type" => "textfield",
					"heading" => __("Title", 'elevation'),
					"param_name" => "title",
					'holder' => 'div',
					'value' => 'Upcoming Events',
				),
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'elevation'),
					"param_name" => "pppage",
					"value" => '5'
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'candor_framework_events_shortcode_vc');