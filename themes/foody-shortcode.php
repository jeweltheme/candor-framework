<?php

//add_filter( 'the_content', 'wpautop' , 99);
add_filter( 'the_content', 'foody_shortcode_empty_paragraph_fix' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function foody_shortcode_empty_paragraph_fix( $content ) {
 
    $array = array(
        '<p>['    => '[',
        '<span>['    => '[',
        '<div>['    => '[',
        ']</p>'   => ']',
        ']</span>'   => ']',
        ']</div>'   => ']',
        ']<br />' => ']'
    );
    return strtr( $content, $array );
 

}


//Section Title
add_shortcode( 'foody_section_title', function( $atts, $content= null ){
  $atts = shortcode_atts(
    array(
      'title'  => 'Our Menus'
      ), $atts);

  extract($atts);

  return '<div class="section-title-container">
              <h2 class="section-title">' . $title . '</h2>
            </div><!-- /.section-title-container -->';

});


//Parallax Title
add_shortcode( 'foody_page_title', function( $atts, $content= null ){
  $atts = shortcode_atts(
    array(
      'title'  => 'Book your table'
      ), $atts);

  extract($atts);

  return '<div class="section-title-container">
              <h2 class="parallax-title">' . $title . '</h2>
            </div><!-- /.section-title-container -->';

});




//Foody Menu Shortcode
add_shortcode( 'foody_menu', 'foody_menu_shortcode');
function foody_menu_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      'content'   => '',
      'count'     => '',
      'paginate'  => 'no',
      ), $atts);

  extract($atts);

  ob_start();

  global $post;
  global $paged;
 
?>


  <div class="row">

      <?php
      $paged = (get_query_var('page')) ? get_query_var('page') : 1;
      $args = array( 'post_type' => 'menu', 'posts_per_page' => $count, 'paged'=> (int) $paged);
      $loop = new WP_Query( $args );
      if ( $loop->have_posts() ) { while ( $loop->have_posts() ) { $loop->the_post();

        $terms = wp_get_post_terms( get_the_ID(), 'menu_category', array("fields" => "all"));  

        $menu_img_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'foody-menu-thumbnail') );

        $menu_img_full_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
        ?>

          <div class="col-sm-6">
            <article class="menus-container wow fadeIn animated" data-wow-delay="0.2s">
              <div class="featured-img">
                <img src="<?php echo $menu_img_url; ?>" alt="<?php the_title();?>">
                <a href="<?php echo $menu_img_full_url[0]; ?>" class="boxer img-link"></a>
              </div><!-- /.featured-img -->
              <h4 class="item-title"> <a href="<?php the_permalink();?>"><?php the_title();?></a> </h4>
              <div class="item-entry">
                <p>
                  <?php the_content();?>
                </p>
              </div><!-- /.item-entry -->
            </article><!-- /.menus-container -->
          </div><!-- /.col-sm-6 -->
          <?php  }
        }
        wp_reset_postdata();
        wp_reset_query();
       
        ?>

  
    </div>

<?php
if($paginate=="yes"){
  echo '<div class="pagination"><nav class="paging-navigation" role="navigation">';
  $big = 999999999; // need an unlikely integer
  echo paginate_links( array(
    'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format'        => '?paged=%#%',
    'current'       => $paged,
    'total'         => $loop->max_num_pages,
      //'type'          =>'list',                
    'prev_next'     => true
    ) );
  echo '</nav></div>';  
}

  wp_reset_postdata();
  wp_reset_query();

  /**
  * Post pagination, use candor_framework_pagination() first and fall back to default
  */
  //echo candor_framework_pagination();
  //echo function_exists('candor_framework_pagination') ? candor_framework_pagination() : posts_nav_link();
  
$output = ob_get_clean();
  return do_shortcode($output);
}



//service Shortcode
add_shortcode( 'foody_services', 'foody_services_shortcode');

function foody_services_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array('count'  => ''), $atts);

  extract($atts);

  ob_start();

  global $post;
?>

    <div id="welcome-slider"  class="owl-carousel owl-theme"> 


    <?php 
    $i = 1;
    $services = candor_get_custom_posts("service", $count);
    foreach ($services as $key =>$post) {
      setup_postdata($post);


      $service_desc  = candor_framework_meta( '_foody_service_desc' );
      $service_icon  = candor_framework_meta( 'fa_field_icon' );
      $service_bg_color  = candor_framework_meta( '_foody_service_bg_color' );

      //print_r($service_icon);
      ?>

      <div class="item col-xs-12">
        <div class="welcome-post wow fadeIn animated" data-wow-delay="0.<?php echo $i;?>s">
          <div class="hex welcome-hex">
            <span class="hex-icon">
              <i class="fa <?php echo esc_attr($service_icon);?>"></i>
            </span><!-- /.hex-icon -->
          </div><!-- /.welcome-hex -->
          <h3 class="welcome-title"> <?php the_title();?></h3>
          <p class="welcome-texts">
            <?php echo esc_attr($service_desc);?>
          </p><!-- /.welcome-texts -->
        </div><!-- /.welcome-post -->             
      </div><!-- /.item -->

  <?php 
    $i++;
  } ?>

    </div><!-- /#welcome-slider --> 

<?php

wp_reset_postdata();
wp_reset_query();
$output = ob_get_clean();
  return do_shortcode($output);
}








//Blog Shortcode
add_shortcode( 'foody_blog', 'foody_blog_shortcode');
function foody_blog_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      'count'  => ''), $atts);

  extract($atts);

  ob_start();

  global $post;
  $blog_posts = candor_get_custom_posts("post", $count);
?>


            <div class="home-blog">
              <div class="row">


                <?php
                foreach ($blog_posts as $post) {
                  setup_postdata($post);

                    //get_template_part( 'template-parts/content', get_post_format() );
                  ?>

                      
                          <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                      



                  <?php } ?>

                
              </div><!-- /.row -->

              <div class="btn-container">
                <a href="<?php echo candor_framework_get_blog_link();?>" class="btn btn-sm btn-orange"> <?php echo esc_html__('View All Posts','candor');?>  </a>
              </div><!-- /.btn-container -->

            </div><!-- /.blog-post-container --> 


<?php
  wp_reset_postdata();
  wp_reset_query();

$output = ob_get_clean();
  return do_shortcode($output);
}



//Testimonials Shortcode
add_shortcode( 'foody_testimonials', 'foody_testimonials_shortcode');

function foody_testimonials_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array('count'  => ''), $atts);

  extract($atts);

  ob_start();

  global $post, $page;
  $testimonial = candor_get_custom_posts("testimonial", $count);


?>


          <div class="testimonial overlay-normal section-padding">
            <div id="testimonial-carousel" class="carousel slide" data-ride="carousel">

              <ol class="carousel-indicators">
                <?php for($i=0;$i<count($testimonial); $i++) { ?>
                  <li data-target="#testimonial-carousel" data-slide-to="<?php echo $i;?>" class="<?php echo ( ($i == 0) ? "active" : "" );?>"></li>  
                <?php } ?>
              </ol><!-- /.carousel-indicators -->

              <div class="carousel-inner">


          <?php
          $i=1;
            foreach ($testimonial as $post) {
                setup_postdata($post);
                $testimonial_client_name        = get_post_meta( $post->ID,'_foody_testimonial_client_name',true );
                $testimonial_client_designation = get_post_meta( $post->ID,'_foody_testimonial_client_designation',true );
                $testimonial_client_url         = get_post_meta( $post->ID,'_foody_testimonial_client_url',true );
                $testimonial_comments           = get_post_meta( $post->ID,'_foody_testimonial_comments',true );
                $testimonial_rating             = get_post_meta( $post->ID,'_foody_testimonial_rating',true );
                $testimonial_img_url            = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'foody-testimonial') );
            ?>

                <div class="item <?php echo ( ($i == 1) ? "active" : "" );?>">
                  <div class="testimonial-figure">
                    <div class="author-avatar">
                      <img class="img-circle" src="<?php echo esc_url_raw($testimonial_img_url);?>" alt="<?php the_title();?>">
                    </div><!-- /.author-avatar --> 
                    <div class="authors-review">
                      <p class="author-says">
                        <?php echo esc_attr($testimonial_comments);?>
                      </p><!-- /.author-says -->

                      <?php if($testimonial_rating){ ?>
                        <div class="given-stars">
                          <?php for($i=0;$i<$testimonial_rating; $i++){ ?>
                            <span><i class="fa fa-star"></i></span>
                          <?php } ?>                        
                        </div><!-- /.given-stars --> 
                      <?php } ?>                     

                      <div class="author-and-ulr">
                        <h4 class="author-name"> <?php echo esc_attr($testimonial_client_name);?>  </h4> 
                        <a href="<?php echo esc_url_raw($testimonial_client_url);?>" class="author-website" target="_blank"><?php echo esc_attr($testimonial_client_designation);?></a> 
                      </div> <!-- /.author-and-ulr --> 
                    </div><!-- /.authors-review --> 
                  </div><!-- /.testimonial-figure -->
                </div><!-- /.item --> 

                <?php 
                $i++;
              } ?>


              </div><!-- /.carousel-inner -->
            </div><!-- /#testimonial-carousel --> 
          </div><!-- /.testimonial -->



<?php
  wp_reset_postdata();
  wp_reset_query();
  $output = ob_get_clean();
  return do_shortcode($output);
}





//Twitter Shortcode
add_shortcode( 'foody_tweets', 'foody_tweets_shortcode');

function foody_tweets_shortcode( $atts, $content= null ){
  global $foody_options;

  $atts = shortcode_atts(
    array('count'  => ''), $atts);

  extract($atts);

  ob_start();

  $username = $foody_options['section_twitter_username'];
  $twitter_consumer_key = $foody_options['section_twitter_consumer_key'];
  $consumer_secret = $foody_options['section_twitter_consumer_secret'];
  $access_token = $foody_options['section_twitter_access_token'];
  $oauth_access_token_secret = $foody_options['section_twitter_oauth_access_token_secret'];

// Twitter API Settings
  $settings = array(
    'consumer_key' => "$twitter_consumer_key",
    'oauth_access_token_secret' => "$oauth_access_token_secret",
    'oauth_access_token' => "$access_token",
    'consumer_secret' => "$consumer_secret"    
    );

  $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

//$getfield = "?screen_name=$username"; // Change it
$getfield = "?screen_name=jwthemeltd"; // Change it

$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest();

//var_dump(json_decode($response)); /* Here you will get all info from user timeline */

$valid_data = json_decode($response); //JSON data to PHP.

?>
        <!-- Tweets  -->
        <div id="tweet" class="parallax-style">
          <div class="tweet-section overlay-normal section-padding"> 
            <div class="twitter-icon-container">
              <div class="hex tweeter-icon">
                <span class="hex-icon"> <i class="fa fa-twitter"></i> </span>
              </div><!-- /.tweeter-icon -->
            </div><!-- /.twitter-icon-container --> 
            <div id="tweet-slider" class="carousel slide tweet-slider" data-ride="carousel"> 
              <div class="carousel-inner">

                <?php foreach ($valid_data as $key=>$value) { ?>
                  <div class="item <?php echo ( ($key == 0) ? "active" : "" );?>">
                    <div class="tweet-details"> 
                      <p class="tweet-description">
                        <a href="https://twitter.com/<?php echo $value->user->screen_name;?>">@<?php echo $value->user->screen_name;?></a> <br>
                          <?php echo $value->text;?>                                   
                      </p><!-- /.tweet-description -->
                    </div><!-- /.tweet-details -->
                  </div><!-- /.item -->
                <?php } ?>

              </div><!-- /.carousel-inner -->
              <a class="slide-nav left" href="#tweet-slider" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
              <a class="slide-nav right" href="#tweet-slider" data-slide="next"><i class="fa fa-chevron-right"></i></a>
            </div><!-- /#tweet-slider -->             
          </div><!-- /.tweet-section -->
        </div><!-- /#tweet -->
        <!-- Tweets End  -->

<?php
  wp_reset_postdata();
  wp_reset_query();
  $output = ob_get_clean();
  return do_shortcode($output);
}








//Team/Our Crew Shortcode
add_shortcode( 'foody_team', 'foody_team_shortcode');

function foody_team_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array('count'  => '4'), $atts);

  extract($atts);

  ob_start();

  global $post;
  $team = candor_get_custom_posts("team", $count);
?>


                <div id="crew-slider"  class="owl-carousel owl-theme">
                  <?php
                  $i=1;
                    foreach ($team as $post) {
                        setup_postdata($post);

                        $team_member_name = get_post_meta( $post->ID,'_foody_team_member_name',true );
                        $team_member_designation = get_post_meta( $post->ID,'_foody_team_member_designation',true );
                        $team_desc = get_post_meta( $post->ID,'_foody_team_desc',true );

                        $social_twitter = get_post_meta( $post->ID,'_foody_social_twitter',true );
                        $social_facebook = get_post_meta( $post->ID,'_foody_social_facebook',true );
                        $social_dribbble = get_post_meta( $post->ID,'_foody_social_dribbble',true );
                        $social_google_plus = get_post_meta( $post->ID,'_foody_social_google_plus',true );
                        $social_linkedin = get_post_meta( $post->ID,'_foody_social_linkedin',true );
                        $social_instagram = get_post_meta( $post->ID,'_foody_social_instagram',true );

                        $team_img_url            = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'foody-team') );
                    ?>

                      <div class="item col-xs-12">
                        <div class="crew-member-box wow fadeIn animated" data-wow-delay="0.1s">
                          <h4 class="crew-name"><?php echo esc_attr($team_member_name);?></h4>
                          <h5 class="crew-designation"><?php echo esc_attr($team_member_designation);?></h5>
                          <p class="about-crew">
                            <?php echo esc_attr($team_desc);?>
                          </p><!--  /.about-crew -->
                          <div class="crew-photo">
                            <img src="<?php echo esc_url_raw($team_img_url);?>" alt="<?php the_title();?>">
                          </div><!-- /.crew-photo -->
                        </div><!-- /.crew-member-box -->
                      </div><!-- /.item -->

                    <?php } ?>

                </div><!-- /#crew-slider -->


<?php
  wp_reset_postdata();
  wp_reset_query();
  $output = ob_get_clean();
  return do_shortcode($output);
}




//Foody Events
add_shortcode( 'foody_events', 'foody_events_shortcode');

function foody_events_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      'count'  => '4'
    ), $atts);

  extract($atts);

  ob_start();

  global $post;
  //$events = candor_get_custom_posts("events", $count, "DESC");
?>

        <!-- Events -->
            
                <?php
                $i=1;

                $args = array( 'post_type' => 'events', 'posts_per_page' => $count, 'order' => 'DESC' );
                $events = new WP_Query( $args );
                if ( $events->have_posts() ) { while ( $events->have_posts() ) { $events->the_post();



                  $event_date = get_post_meta( $post->ID,'_foody_event_date',true );
                  $event_place = get_post_meta( $post->ID,'_foody_event_place',true );
                  $event_start = get_post_meta( $post->ID,'_foody_event_start',true );
                  $event_end = get_post_meta( $post->ID,'_foody_event_end',true );

                  $newdate = date_parse($event_date);
                  $newdate_month = strtotime($event_date);

                  $event_month = date('F', $newdate_month);

                  $old_event_start_timestamp = strtotime($event_start);
                  $old_event_end_timestamp = strtotime($event_end);

                  $event_start_time = date('ga', $old_event_start_timestamp);
                  $event_end_time = date('ga', $old_event_end_timestamp);


                  $event_img_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'foody-events') );
                  ?>
                  
                    <div class="col-sm-6">
                      <div class="event-item wow fadeIn animated" data-wow-delay="0.1s">
                        <div class="event-img">
                          <img src="<?php echo esc_url_raw( $event_img_url );?>" alt="<?php the_title();?>">
                        </div><!-- /.event-img -->
                        <div class="event-time">
                          <span class="event-month"> <?php echo $event_month; ?> </span>
                          <span class="event-date"> <?php echo $newdate['day']; ?> </span>
                          <span class="event-year"> <?php echo $newdate['year']; ?> </span>
                        </div><!-- /.event-time -->
                        <h3 class="event-title"> <?php the_title();?> </h3>
                        <div class="event-place">
                          <strong><?php echo esc_html__('Place:','elevation');?></strong> <?php echo esc_attr($event_place);?>
                        </div>
                        <div class="event-time-h"><strong><?php echo esc_html__('Time:','elevation');?></strong> <?php echo esc_attr($event_start_time);?> </div>
                      </div><!-- /.event-item -->
                    </div>

                  <?php } } ?>


<?php

  wp_reset_postdata();
  wp_reset_query();
  $output = ob_get_clean();
  return do_shortcode($output);
}


// Foody Contact Form 7
add_shortcode( 'foody_contact_form', function( $atts, $content= null ) {
  return do_shortcode( $content );
});


//Foody Open/Close Time
add_shortcode( 'foody_open_close', 'foody_open_close_shortcode');

function foody_open_close_shortcode( $atts, $content= null ){ 

  $atts = shortcode_atts(
    array(
          'section_title'           => 'We are waiting for you! Visit us',
          'left_open_close_title'   => 'Every Monday to Friday',
          'left_open_close_time'    => '09:00 AM - 09:30 PM',
          'right_open_close_title'  => 'Every Monday to Friday',
          'right_open_close_time'   => '09:00 AM - 09:30 PM',
        ), $atts);

  extract($atts);

  ob_start();

?>

            <div class="open-close">
              <h4 class="oc-heading text-center"> <?php echo esc_attr($section_title);?></h4>

              <div class="row">
                <div class="col-md-6">
                  <div class="oc-container">
                    <div class="col-sm-7 os-txt-box">
                      <span class="oc-txt"><?php echo esc_attr($left_open_close_title);?> </span>
                    </div>
                    <div class="col-sm-5">
                      <span class="oc-time"><?php echo esc_attr($left_open_close_time);?> </span>
                    </div>
                  </div><!-- /.oc-container -->
                </div><!-- /.oc-container -->

                <div class="col-md-6">
                  <div class="oc-container">
                    <div class="col-sm-7 os-txt-box">
                      <span class="oc-txt"><?php echo esc_attr($right_open_close_title);?> </span>
                    </div>
                    <div class="col-sm-5">
                      <span class="oc-time"><?php echo esc_attr($right_open_close_time);?> </span>
                    </div>
                  </div><!-- /.oc-container -->
                </div><!-- /.oc-container -->
              </div><!-- /.row -->
            </div><!-- /.open-close --> 

<?php
$output = ob_get_clean();
  return do_shortcode($output);
}


// Foody Contact Form 7
add_shortcode( 'foody_contact_form', function( $atts, $content= null ) {
  return do_shortcode( $content );
});


//Foody Best Deal
add_shortcode( 'foody_best_deal', 'foody_best_deal_shortcode');

function foody_best_deal_shortcode( $atts, $content= null ){ 

  $atts = shortcode_atts(
    array(
          'text_1'   => 'Best Deal',
          'text_2'   => 'Chicken Fry + Beef Grills',
          'text_3'   => 'Left Open/Close Time'
        ), $atts);

  extract($atts);

  ob_start();

  $deal_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
?>
      <div class="best-deal">
        <img src="<?php echo $deal_bg_image[0];?>" alt="<?php the_title();?>" class="foods-img">
        <div class="best-deal-content">
          <div class="row">
            <div class="col-sm-6 pull-right">
              <h3 class="deal-txt-1"> <?php echo esc_attr($text_1);?> </h3>
              <h3 class="deal-txt-2"> <?php echo esc_attr($text_2);?> </h3>
              <h4 class="deal-txt-3"> <?php echo htmlspecialchars_decode($text_3);?> </h4>
            </div><!-- /.col-sm-6 -->
          </div><!-- /.row -->
        </div><!-- /.best-deal-content -->
      </div><!-- /.best-deal -->

<?php
$output = ob_get_clean();
  return do_shortcode($output);
}


//Foody Mobile App
add_shortcode( 'foody_mobile_app', 'foody_mobile_app_shortcode');

function foody_mobile_app_shortcode( $atts, $content= null ){ 

  $atts = shortcode_atts(
    array(

          'img_url'   => '#',
          'text_1'    => 'Happy to Announce',
          'text_2'    => 'Mobile App',
          'text_3'    => 'is Available in every os platform.',
          'btn_text'  => 'Download Now',
          'btn_url'   => '#'
        ), $atts);

  extract($atts);

  ob_start();
?>       


        <div class="mobile-app overlay-normal section-padding full-width">
          <div class="row">

            <div class="col-sm-5">
              <div class="mobile-container wow fadeIn animated" data-wow-delay="0.1s">
                <img class="mobile-img" src="<?php echo esc_url_raw($img_url);?>" alt="<?php the_title();?>">
              </div><!-- /.mobile-containe -->
            </div><!-- /.col-sm-5 -->

            <div class="col-sm-7">
              <h2 class="apps-title">
                <?php echo $text_1;?>
                <span><?php echo $text_2;?></span>
                <?php echo $text_3;?>
              </h2><!-- /.apps-title -->
              <div class="btn-container">
                <a href="<?php echo esc_url_raw($btn_url);?>" class="btn btn-sm btn-light-green"><?php echo esc_attr($btn_text);?></a>
              </div><!-- /.btn-container -->
            </div><!-- /.col-sm-7 --> 
          </div><!-- /.row --> 
        </div><!-- /.mobile-app -->


<?php
$output = ob_get_clean();
  return do_shortcode($output);
}



//columns
add_shortcode( 'candor_columns', function( $atts=array(), $content=null ){

 $output = wpautop(do_shortcode(htmlspecialchars_decode($content)));

  return $output;
});


//Dropcap
add_shortcode( 'candor_dropcap',  function( $atts, $content="" ) {

  $atts = shortcode_atts(
    array(
      'style'  => 'default'
      ), $atts);

  extract($atts);

  return '<p class="dropcap '. $style .'">' . do_shortcode( $content ) .'</p>';

} );



//Button
add_shortcode( 'candor_button', function( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      'text'  => 'Button',
      'type'  => 'default',
      'size'  => '',
      'url'   => '#',
      'class' => '',
      'icon'  => '',
      'target'=>'_self'
      ), $atts);

  extract($atts);

  $classes  = 'btn';
  $output   = $text;

  if($type) $classes .= ' btn-'. $type;
  if($size) $classes .= ' btn-'. $size;
  if($class) $classes .= ' '. $class;

  //if($icon) $output = '<i class="' . $icon . '"></i> ' . $text;

  //return '<a target="' . $target . '" href="' . $url . '" class="' . $classes . '">' .  do_shortcode($output)  . '</a>';
  return '<div class="btn-container">
              <a class="btn btn-sm btn-light-green" href="' . $url . '">' .  do_shortcode($output)  . '</a>
          </div>';
});





//Progressbar
add_shortcode( 'candor_progressbar', function( $atts, $content= null ) {
    $atts = shortcode_atts(
    array(
      'title'  => 'Programming skills'
      ), $atts);

  extract($atts);

  return '<div class="progressbar bottom-padding"><div class="skill-details"><h3 class="title">' . $title . '</h3>' . do_shortcode( $content ) . '</div></div>';

});

// Bar
add_shortcode( 'bar', function( $atts, $content= null ) {
  $atts = shortcode_atts(
    array(
      "width"        => '70%'
      ), $atts);

  extract($atts);

  return '<div class="progress">
            <div class="progress-bar" role="progressbar" data-transitiongoal="' . $width . '" aria-valuemin="0" aria-valuemax="100">
              <span class="progress-title">' . do_shortcode( $content ) . ' <span class="percent">' . $width . '%</span></span>
            </div>
          </div>';  

});





// Standard Footer Menu Script
function foody_standard_menu_script() { ?>
    <script>
      jQuery(document).ready(function($) {
        "use strict";

        <?php if (has_nav_menu("primary")) { ?>
          /*---------------------- Current Menu Item -------------------------*/
          $('#main-menu #headernavigation').onePageNav({
            currentClass: 'active',
            changeHash: false,
            scrollSpeed: 750,
            scrollThreshold: 0.5,
            scrollOffset: 0,
            filter: ':not(.sub-menu a, .not-in-home)',
            easing: 'swing'
          }); 
        <?php } ?>




      <?php //if ( is_page() && ( basename(get_page_template()) == "page-templates/contact.php" ) ) { 
      //  if ( get_page_template_slug( get_the_ID() ) == 'page-templates/contact.php' ) {
          ?>
        
        /*----------- Google Map - with support of gmaps.js ----------------*/

        function isMobile() { 
          return ('ontouchstart' in document.documentElement);
        }

        function init_gmap() {

          var gmap_link, gmap_variables, gmap_zoom, gmap_style;

          var gmap_markercontent = $('#googleMaps').data('markercontent');
          gmap_link = $('#googleMaps').data('url');
          gmap_style = typeof $('#googleMaps').data('customstyle') !== "undefined" ? "style1" : google.maps.MapTypeId.ROADMAP;

        // Overwrite Math.log to accept a second optional parameter as base for logarhitm
        Math.log = (function () {
          var log = Math.log;
          return function (n, base) {
            return log(n) / (base ? log(base) : 1);
          };
        })();

        function get_url_parameter(needed_param, gmap_url) {
          var sURLVariables = (gmap_url.split('?'))[1];
          if (typeof sURLVariables === "undefined") {
            return sURLVariables;
          }
          sURLVariables = sURLVariables.split('&');
          for (var i = 0; i < sURLVariables.length; i++) {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == needed_param) {
              return sParameterName[1];
            }
          }
        }

          var gmap_coordinates = [],
          gmap_zoom;
          if (gmap_link) {
        //Parse the URL and load variables (ll = latitude/longitude; z = zoom)
        var gmap_variables = get_url_parameter('ll', gmap_link);
        if (typeof gmap_variables === "undefined") {
          gmap_variables = get_url_parameter('sll', gmap_link);
        }
        // if gmap_variables is still undefined that means the url was pasted from the new version of google maps
        if (typeof gmap_variables === "undefined") {

          if (gmap_link.split('!3d') != gmap_link) {
            //new google maps old link type

            var split, lt, ln, dist, z;
            split = gmap_link.split('!3d');
            lt = split[1];
            split = split[0].split('!2d');
            ln = split[1];
            split = split[0].split('!1d');
            dist = split[1];
            gmap_zoom = 21 - Math.round(Math.log(Math.round(dist / 218), 2));
            gmap_coordinates = [lt, ln];

          } else {
            //new google maps new link type

            var gmap_link_l;

            gmap_link_l = gmap_link.split('@')[1];
            gmap_link_l = gmap_link_l.split('z/')[0];

            gmap_link_l = gmap_link_l.split(',');

            var latitude = gmap_link_l[0];
            var longitude = gmap_link_l[1];
            var zoom = gmap_link_l[2];

            if (zoom.indexOf('z') >= 0)
              zoom = zoom.substring(0, zoom.length - 1);

            gmap_coordinates[0] = latitude;
            gmap_coordinates[1] = longitude;
            gmap_zoom = zoom;
          }


        } else {
          gmap_zoom = get_url_parameter('z', gmap_link);
          if (typeof gmap_zoom === "undefined") {
            gmap_zoom = 10;
          }
          gmap_coordinates = gmap_variables.split(',');
        }
      }
      

          if ( typeof google == 'undefined' ) return;
          var options = {
            center: [53.599339, 10.172954],
            zoom: 15,
            mapTypeControl: true,
            mapTypeControlOptions: {
              style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
            },
            navigationControl: true,
            scrollwheel: false,
            streetViewControl: true
          }

          if (isMobile()) {
            options.draggable = false;
          }

          $('#googleMaps').gmap3({
            // map: {
            //  options: options
            // },
            map: {
              options: {
                center: new google.maps.LatLng(gmap_coordinates[0], gmap_coordinates[1]),
                zoom: parseInt(gmap_zoom),
                mapTypeId: gmap_style,
                mapTypeControlOptions: {mapTypeIds: []},
                scrollwheel: false
              }
            },
            marker: {
              //latLng: [53.599339, 10.172954],
              latLng: new google.maps.LatLng(gmap_coordinates[0], gmap_coordinates[1]),
              options: { icon: '<?php echo get_template_directory_uri();?>/assets/images/mapicon.png' }
            },
            overlay: {
              //latLng: new google.maps.LatLng(53.599339, 10.172954),
              latLng: new google.maps.LatLng(gmap_coordinates[0], gmap_coordinates[1]),
              options: {
                content:
                '<div class="map__marker-wrap">' +
                '<div class="map__marker">' +
                  gmap_markercontent +
                '</div>' +
                '</div>'
              }
            },
            styledmaptype: {
              id: "style1",
              options: {
                name: "Style 1"
              },
              styles: [
              {
                "stylers": [
                { "saturation": -100 },
                { "gamma": 2.45 },
                { "visibility": "simplified" }
                ]
              },{
                "featureType": "road",
                "stylers": [
                { "hue": $("body").data("color") ? $("body").data("color") : "#ffaa00" },
                { "saturation": 50 },
                { "gamma": 0.40 },
                { "visibility": "on" }
                ]
              },{
                "featureType": "administrative",
                "stylers": [
                { "visibility": "on" }
                ]
              }
              ]
            }


          });
        }

        init_gmap();


      <?php // } ?>
  });
    </script>
<?php }
add_action( 'wp_footer', 'foody_standard_menu_script', 100 );


function foody_custom_styles(){ 
  global $foody_options;
  global $post_id;
  $page_thumbnail_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID(), 'full' ) );
    
    $main_color     = $foody_options['main_color'];
    $bg_color       = $foody_options['bg_color'];
    $text_color     = $foody_options['text_color'];
    $headings_color = $foody_options['headings_color'];
    $nav_background = $foody_options['nav_background'];
?>
  <style type="text/css">
            body {
               font-family:    "<?php echo $foody_options['body_font']['font-family'];?>", sans-serif;
               font-size:     <?php echo $foody_options['body_font']['font-size'];?>;
               color:         <?php echo $foody_options['body_font']['color'];?>;
            }
            p, article .entry{
                color: <?php echo $foody_options['paragraph_typography']['color'];?>;
                font-size: <?php echo $foody_options['paragraph_typography']['font-size'];?>;
                font-weight: <?php echo $foody_options['paragraph_typography']['font-weight'];?>;
                line-height: <?php echo $foody_options['paragraph_typography']['line-height'];?>;
            }
            h1, h2, h3, h4, h5, h6 {
                font-weight: <?php echo $foody_options['heading_google_font']['font-weight'];?>;
                font-family: "<?php echo $foody_options['heading_google_font']['font-family'];?>", sans-serif;
                text-transform: <?php echo $foody_options['heading_google_font']['text-transform'];?>;
            }
            .navbar-brand.logo_text{
                font-family: "<?php echo $foody_options['logo_and_top_heading']['font-family'];?>",sans-serif;
                font-size: <?php echo $foody_options['logo_and_top_heading']['font-size'];?>;
                color: <?php echo $foody_options['logo_and_top_heading']['color'];?>;
                font-weight: <?php echo $foody_options['logo_and_top_heading']['font-weight'];?>;                
            }
            .menu_color .navbar-default {
              background-color: <?php echo $nav_background;?>; 
            }
            a:hover, .menu_color .navbar-default .navbar-nav>li>a:hover, .menu_color .navbar-default .navbar-nav>li>a:focus, .menu_color .navbar-default .navbar-nav>.active>a, 
            .menu_color .navbar-default .navbar-nav>.active>a:hover, .menu_color .navbar-default .navbar-nav>.active>a:focus, .menu_color .nav-social-btn a:hover, .top-section .top-heading-1,
            .mobile-app .apps-title span, .post-content .post-title a:hover, .testimonial .given-stars span, .copyrights a:hover, .post .entry-meta a:hover, .post-navigation .nav-links a:hover,
            .comment-author a:hover, .comment-metadata a time:hover, .comments-area .reply a {
              color: <?php echo $main_color;?>;
            }

            .choose-table-form input, .contact-us .wpcf7-form-control.wpcf7-submit:hover, #scroll-to-top {
              background: <?php echo $bg_color;?>;
            }
            .main-menu-continer{
              background: <?php echo $nav_background;?>; 
            }
             .navbar-default .navbar-nav>li>a, .navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>.active>a, 
            .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus, .toggle_nav_button {
              background-color: <?php echo $bg_color;?>;  
            }
            .menu_color.main-menu-continer .menubar-toggle{
              background: <?php echo $nav_background;?>;
            }

            .main-menu-continer .menubar-toggle,
            .carousel-indicators .active,
            .paging-navigation a:hover,
            .event-item:hover .event-time,
            .blog-section .post-meta,
            .owl-page.active,
            .contact-us .wpcf7-form-control.wpcf7-submit,
            .os-txt-box,
            .paging-navigation a.active {
              background: <?php echo $main_color;?>;
            }
            h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a{
                color: <?php echo $text_color;?>;
            }
            .btn-light-green {
              background: <?php echo $bg_color;?>;
            }

            .deal-txt-2 {
              color: <?php echo $main_color;?>;
            }
            .hex, .hex:before, .hex:after, .comments-area .reply a:hover, .comment-form .submit:hover {
              border-color: <?php echo $main_color;?>;
              background: <?php echo $main_color;?>;
            }

            .post-content .continue-reading a:hover, .owl-page, .oc-container, .type-page blockquote, .type-post blockquote {
              border-color: <?php echo $main_color;?>;
            }

            .wpcf7-form .wpcf7-form-control:focus,
            .search-form input:focus {
              border-color: <?php echo esc_attr( $main_color );?>;
            }


          /* Custom CSS */
          <?php if (isset($foody_options['custom_css'])){
               echo $foody_options['custom_css'];
          }?>

  </style>
<?php 

}


//Check Redux Plugin is Activated
if ( in_array( 'redux-framework/redux-framework.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    add_action( 'wp_head', 'foody_custom_styles');
}


