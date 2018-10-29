<?php

remove_filter ('the_content', 'wpautop');
//add_filter( 'the_content', 'wpautop' , 99);
add_filter( 'the_content', 'angels_shortcode_empty_paragraph_fix' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function angels_shortcode_empty_paragraph_fix( $content ) {
 
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


//Page Title
add_shortcode( 'angels_page_title', function( $atts, $content= null ){
  $atts = shortcode_atts(
    array(
      'title'  => 'Profile',
      'subtitle'  => 'Personal Details'
      ), $atts);

  extract($atts);


  return '<div class="top-space"></div><!-- /.top-space -->
          <div class="content-top text-center">
            <h2 class="page-title">' . esc_attr($title) . '</h2>
            <h3 class="page-subtitle">' . esc_attr($subtitle) . '</h3>         
          </div>';

});


//Section Title
add_shortcode( 'angels_section_title', function( $atts, $content= null ){
  $atts = shortcode_atts(
    array(
      'title'  => 'My Offers'
      ), $atts);

  extract($atts);

  return '<h3 class="section-title text-center">' . $title . '</h3>';

});


// //Title
// add_shortcode( 'angels_section_title', function( $atts, $content= null ){
//   $atts = shortcode_atts(
//     array(
//       'title'  => 'Programming skills'
//       ), $atts);

//   extract($atts);

//   return '<h3 class="title">' . $title . '</h3>';

// });





//Portfolio Shortcode
add_shortcode( 'angels_portfolio', 'angels_portfolio_shortcode');
function angels_portfolio_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array('content'  => ''), $atts);

  extract($atts);

  ob_start();

  global $post;
  $portfolio = candor_get_custom_posts("portfolio", -1);
?>

<div class="content-bottom text-center">
  <div class="itemFilter">
    <a href="#" data-filter="" class="current"><?php echo esc_html('All Works','angels');?></a>
    <?php 
    $category = get_terms( 'portfolio_category' );
    foreach ($category as $cat) { 
      echo '<a href="#" data-filter=".'.trim($cat->slug).'">'.$cat->name.'</a>';
    } ?> 
  </div> <!-- /.itemFilter -->

  <div id="work-items" class="work-items">

    <?php
    foreach ($portfolio as $post) {
      setup_postdata($post);
      $terms = wp_get_post_terms( get_the_ID(), 'portfolio_category', array("fields" => "all"));  
      
      $portfolio_style = get_post_meta( $post->ID,'_angels_portfolio_style',true );


      $t = array();                    
      foreach($terms as $term)
        $t[] = $term->slug;
      $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(),array(300,100)) );
      ?>

      <div class="item <?php echo implode(' ', $t); $t = array(); ?> <?php echo $portfolio_style;?> border">
        <a href="<?php echo $url; ?>" class="image-popup-vertical-fit">
          <img src="<?php echo $url; ?>" alt="<?php echo get_the_title();?>"/>
        </a>
        <div class="item-details">
          <h3 class="item-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
        </div><!-- /.item-details -->
      </div><!-- /.item -->
    <?php } ?>


  </div><!-- /#work-items -->

  <div class="btn-container text-center">
    <?php
      /**
      * Post pagination, use candor_pagination() first and fall back to default
      */
      //echo candor_pagination();
      echo function_exists('candor_pagination') ? candor_pagination() : posts_nav_link();
      ?>
  </div><!-- /.btn-container -->

</div><!-- /.content-bottom --> 

<?php
$output = ob_get_clean();
  return do_shortcode($output);
}




//Blog Shortcode
add_shortcode( 'angels_blog', 'angels_blog_shortcode');
function angels_blog_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      'count'  => ''), $atts);

  extract($atts);

  ob_start();

  global $post;
  $blog_posts = candor_get_custom_posts("post", $count);
?>

    <div class="content-bottom">
      <div class="blog-posts">
        <div class="vgrid-wrapper">
          
            <?php
            foreach ($blog_posts as $post) {
              setup_postdata($post);

                get_template_part( 'template-parts/content', get_post_format() );
               
               } ?>
          
        </div>
      </div><!-- /.blog-posts -->

      <div class="btn-container text-center">
          <?php
          /**
          * Post pagination, use candor_pagination() first and fall back to default
          */
          //echo candor_pagination();
          echo function_exists('candor_pagination') ? candor_pagination() : posts_nav_link();
          ?>
      </div><!-- /.btn-container -->

    </div><!-- /.content-bottom --> 

<?php
$output = ob_get_clean();
  return do_shortcode($output);
}



//service Shortcode
add_shortcode( 'angels_service', 'angels_service_shortcode');

function angels_service_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array('count'  => ''), $atts);

  extract($atts);

  ob_start();

  global $post;
?>
<div class="services">

  <?php 
  $i = 1;
  $services = candor_get_custom_posts("service", $count);
  foreach ($services as $key =>$post) {
    setup_postdata($post);

    $service_title = angels_meta( '_angels_service_title');
    $service_desc  = angels_meta( '_angels_service_desc' );
    $service_icon  = angels_meta( '_angels_service_icon' );
    $service_bg_color  = angels_meta( '_angels_service_bg_color' );
    ?>
      <div class="col-sm-4 service-item text-center item-<?php echo $i;?>" style="background-color:<?php echo $service_bg_color;?>">
        
        <div class="progress-icon"><i class="<?php echo $service_icon;?>"></i></div><!-- /.progress-icon -->
        
        <h4 class="progress-title">
          <a href="<?php the_permalink();?>"> <?php echo $service_title;?></a>
        </h4>
        <p class="progress-description">
          <?php echo $service_desc;?>
        </p>
      </div>
  <?php 
    $i++;
  } ?>

</div><!-- /.our-services -->

<?php
$output = ob_get_clean();
  return do_shortcode($output);
}





//Angels Contact Info
add_shortcode( 'angels_contact_info', function( $atts, $content= null ) {
  //echo '<div class="content-bottom">';
  return '<div class="contact-info text-center">' . do_shortcode( $content ) . '</div>';
  //echo '</div>';
});

// Contact Info
add_shortcode( 'contact_info', function( $atts, $content= null ) {
  $atts = shortcode_atts(
    array(
      "icon"          => 'fa fa-home',
      "title"         => 'Phone'
      ), $atts);

  extract($atts);
  return '<div class="col-sm-4 contact-info-box">                       
            <span class="item-icon phone">
              <i class="' . esc_attr($icon) . '"></i>
            </span>
            <p class="item-title">' . esc_attr($title) . '</p>
            <span class="texts">' . do_shortcode( $content ) . '</span></div>';  
});


// Angels Contact Form 7
add_shortcode( 'angels_contact_form', function( $atts, $content= null ) {
  return do_shortcode( $content );
});




//Pricing
add_shortcode( 'angels_pricing', function( $atts, $content = null ){
  ob_start();
  $atts = shortcode_atts(
    array(
      'category' => '0'
      ), $atts);

  extract($atts);


  $args = array(
    'post_type'=>'pricing', 
    'orderby' => 'menu_order',
    'order' => 'ASC'
    );


  if(  $category > 0 ){
    $args['tax_query'] = array(
      array(
        'posts_per_page' => -1,
        'taxonomy' => 'pricing_category',
        'field' => 'term_id',
        'terms' => $category
        )
      );
  }

$pricings = candor_get_custom_posts("pricing", -1);
?>

    <div class="pricing-tables">
      <div class="row">

        <?php 
        if(count($pricings)>0) {
          foreach ($pricings as $post) {
            setup_postdata($post);
            $price_meta = get_post_meta($post->ID);

            $pricing_currency       =  $price_meta['_angels_pricing_currency'][0];
            $pricing_price          =  $price_meta['_angels_pricing_price'][0];
            //$pricing_price_fraction =  $price_meta['_angels_pricing_price_fraction'][0];
            $pricing_button         =  $price_meta['_angels_pricing_button'][0];
            $pricing_button_link    =  $price_meta['_angels_pricing_button_link'][0];
            $pricing_duration    =  $price_meta['_angels_pricing_duration'][0];
            $pricing_active         =  $price_meta['_angels_pricing_active'][0];

            $pricing_elements =  $price_meta['_angels_pricing_elements'][0];
          ?>
            
            <div class="col-md-4 col-sm-6">
              <div class="table <?php echo ( ($pricing_active=="1") ? "popular" : "" );?> text-center">
                <div class="table-top">
                  <h3 class="table-title"><?php the_title();?></h3><!-- /.table-title -->
                  <div class="pricing-cost">
                    <span class="currency"><?php echo $pricing_currency; ?><?php echo $pricing_price; ?></span>
                    <span class="duration"><?php echo $pricing_duration; ?></span>         
                  </div><!-- /.pricing-cost -->
                </div><!-- /.table-top -->
                <div class="table-details">
                 <?php
                   $el_parts = explode("\n", $pricing_elements);
                   foreach ($el_parts as $el) {
                    $el = do_shortcode($el);
                    echo wpautop($el);
                  }
                ?>
                </div><!-- /.table-details -->
                <div class="table-bottom">
                  <div class="continue-reading">
                    <a class="btn" href="<?php echo $pricing_button_link; ?>">
                      <?php echo $pricing_button; ?>
                    </a>
                  </div>
                </div><!-- /.table-bottom -->
              </div><!-- /.table -->
            </div>

        <?php } } else {?>
          <div class="alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php _e( 'No pricing table found!', 'angels' ); ?>
          </div>
        <?php } ?>

      </div>
    </div><!-- /.pricing-tables -->

<?php
  wp_reset_postdata();
  $output = ob_get_clean();
  return do_shortcode($output);
  //return ob_get_clean();
});





//Happy Happy Words
add_shortcode( 'angels_happy_words', 'angels_happy_words_shortcode');

function angels_happy_words_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array('count'  => ''), $atts);

  extract($atts);

  ob_start();

  global $post;
?>


<div class="client-testimonial text-center">
  <span class="quote-icon"><i class="fa fa-quote-left"></i></span>
  <div id="testimonial-slider" class="testimonial-slider carousel slide" data-ride="carousel">
    <div class="carousel-inner">

  <?php 
  $testimonials = candor_get_custom_posts("testimonial", $count);
  foreach ($testimonials as $key =>$post) {
    setup_postdata($post);


    $testimonial_client_name = get_post_meta( $post->ID,'_angels_testimonial_client_name',true );
    $testimonial_client_designation = get_post_meta( $post->ID,'_angels_testimonial_client_designation',true );
    $testimonial_client_company = get_post_meta( $post->ID,'_angels_testimonial_client_company',true );
    $testimonial_comments = get_post_meta( $post->ID,'_angels_testimonial_comments',true );
    $testimonial_client_url = get_post_meta( $post->ID,'_angels_testimonial_client_url',true );
    ?>

      <div class="item <?php echo ( ($key == 0) ? "active" : "" );?>">
        <div class="client-details">
          <span class="client-name"><?php echo $testimonial_client_name;?></span>
          <span class="designation"><?php echo $testimonial_client_designation;?> <?php echo esc_html('at -','angels');?> 
            <a href="<?php echo $testimonial_client_url;?>" target="_blank">
              <?php echo $testimonial_client_company;?>
            </a>
          </span>
        </div><!-- /.client-details -->

        <p><?php echo $testimonial_comments;?></p>
      </div><!-- /.item -->

    <?php } ?>

    </div><!-- /.carousel-inner -->

  </div><!-- /#testimonial-slider -->
</div><!-- /.client-testimonial -->

<?php
$output = ob_get_clean();
  return do_shortcode($output);
}



//Happy Happy Clients
add_shortcode( 'angels_happy_clients', 'angels_happy_clients_shortcode');

function angels_happy_clients_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array('count'  => ''), $atts);

  extract($atts);

  ob_start();

  global $post;
?>


<div class="testimonial">
  <div class="row"> 

  <?php 
  $clients = candor_get_custom_posts("client", $count);
  foreach ($clients as $key =>$post) {
    setup_postdata($post);

    $client_name = get_post_meta( $post->ID,'_angels_client_name',true );
    $client_designation = get_post_meta( $post->ID,'_angels_client_designation',true );
    $client_company = get_post_meta( $post->ID,'_angels_client_company',true );
    $client_comments = get_post_meta( $post->ID,'_angels_client_comments',true );
    $client_url = get_post_meta( $post->ID,'_angels_client_url',true );
    ?>

      <div class="col-sm-6">
        <div class="item">
          <div class="client-details">
            <h4 class="client-name">
              <a href="<?php echo $client_url;?>" target="_blank"><?php echo $client_name;?>,</a> 
            </h4><!-- /.client-name -->
            <span class="position"><?php echo $client_designation;?></span> <?php echo esc_html(' of ','angels');?> <span class="company"><?php echo $client_company;?></span>
          </div><!-- /.client-details -->
          <p class="client-speech"><span></span>
            <?php echo $client_comments;?>
          </p><!-- /.client-speech -->
        </div><!-- /.item -->
      </div>

    <?php } ?>

  </div><!-- /.row -->
</div><!-- /.testimonial -->

<?php
$output = ob_get_clean();
  return do_shortcode($output);
}


//columns
add_shortcode( 'candor_columns', function( $atts=array(), $content=null ){

  //$output = '<div class="row">';
  //$output = do_shortcode( str_replace('<p></p>', '', $content) );

 $output = wpautop(do_shortcode(htmlspecialchars_decode($content)));


 // $output .= '</div>';
  return $output;
});

//column
add_shortcode( 'candor_column', function( $atts, $content=null ){
 $atts = shortcode_atts(
  array(
    'size' => '1'
    ), $atts);

 $output = '<div class="col-sm-'.$atts['size'].'">';
 $output .= do_shortcode( str_replace('<p></p>', '', $content) );
 $output .= '</div>';

 return $output;

});



// Counter
add_shortcode( 'candor_counter', function( $atts=array(), $content=null ){
  return '<div id="counter" class="bottom-padding"><div class="facts text-center"><div class="facts-items">' . do_shortcode( $content ) . '</div></div></div>';
});


//counter
add_shortcode( 'counter', function( $atts, $content=null ){
 $atts = shortcode_atts(
  array(
    'icon'      => 'fa-clock-o',
    'number'    => '3412',
    'content'   => 'Hours Worked'
    ), $atts);
extract($atts);

 $output = '<div class="col-md-3 col-sm-6">
              <div class="item">
                <div class="item-icon"><i class="fa ' . $icon . '"></i></div>
                <div class="countdown">
                  <span class="count-number counter">' . $number . '</span>
                </div><!-- /.countdown -->
                <span class="item-about">' . $content . '</span><!-- /.item-about -->
              </div><!-- /.item -->
            </div>';
 return $output;

});





//Angels Habits & Intersts Info
add_shortcode( 'angels_habits', function( $atts, $content= null ) {
  return '<div class="interest-list text-center"><div class="col-sm-2 col-xs-6">' . do_shortcode( $content ) . '</div></div>';
});

// Habits
add_shortcode( 'habits', function( $atts, $content= null ) {
  $atts = shortcode_atts(
    array(
      "icon"          => 'fa fa-home',
      "title"         => 'Games'
      ), $atts);

  extract($atts);
  return '<a href="#" class="item">
              <span class="item-icon"><i class="' . $icon . '"></i></span>
              <span class="item-details">
                <span class="item-title">' . $title . '</span>
                <span class="item-description">'  . do_shortcode( $content ) . '</span>
              </span>
            </a>';  
});




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
              <a class="btn load-more" href="' . $url . '"> <span class="btn-icon"><i class="' . $icon . '"></i></span>' .  do_shortcode($output)  . '</a>
          </div>';
});





//Profile Details
add_shortcode( 'angels_resume_button', function( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      'signature'   => 'Robert Doe',
      'resume_btn'  => 'Download Resume',
      'resume_url'  => '#'
      ), $atts);

  extract($atts);

  return '<div class="profile-details">
            <div class="signature">' . $signature . '</div>

            <div class="btn-container">
              <a class="btn load-more" href="' . $resume_url . '"> <span class="btn-icon"><i class="fa fa-download"></i></span>' . $resume_btn . '</a>
            </div><!-- /.btn-container -->
          </div><!-- /.profile-details -->';
});



// Angels Profile Meta
add_shortcode( 'angels_profile_meta', function( $atts, $content= null ) {
  return '<div class="profile-meta">' .  do_shortcode(htmlspecialchars_decode($content)) . '</div>';

  
});



// Profile Meta
add_shortcode( 'profile_meta', function( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      "icon"          => 'fa-phone',
      "title"         => 'Phone'
      ), $atts);
  extract($atts);

  // $output = '<div class="media">
  //             <div class="meta-icon media-left">
  //               <i class="fa ' . $icon . '"></i>
  //               <span>' . $title . '</span>
  //             </div>
  //             <div class="media-body">' . do_shortcode( $content ). '</div>
  //           </div>';



  $output = '<div class="media">
              <div class="meta-icon media-left">
                <i class="fa ' . esc_attr( $icon ) . '"></i>
                <span>' . esc_attr( $title ) . '</span>
              </div>
              <div class="media-body">' . wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>
            </div>';


  return $output;

});



// Resume Timeline
add_shortcode( 'resume_timeline', function( $atts, $content= null ){
  return '<div class="about-resume"><div class="job-details"><div class="row">' .  do_shortcode(htmlspecialchars_decode($content)) . '</div></div></div>';

  // $output = '<div class="about-resume"><div class="job-details">';
  // $output = do_shortcode( str_replace('<p></p>', '', $content) );
  // $output .= '</div></div>';
  // return $output;

});

// Timeline
add_shortcode( 'timeline', function( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      "from"          => '2012',
      "to"            => 'Present',
      "company"       => 'Google',
      "jobtitle"      => 'Software Engineer',
      "jobdetails"    => 'Job Details',
      ), $atts);
  extract($atts);

  $output = '<div class="item">
                <div class="col-sm-6">
                  <div class="box">
                    <span class="from">' . $from . '</span> - <span class="to">' . $to . '</span>
                    <div class="institution">' . $company . '</div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <h3 class="name">' . esc_attr( $jobtitle ). '</h3>
                  <p class="description">' . esc_attr($content) . '</p>
                </div>
              </div>';



  return $output;

});




//progressbar
add_shortcode( 'candor_progressbar', function( $atts, $content= null ) {
    $atts = shortcode_atts(
    array(
      'title'  => 'Programming skills'
      ), $atts);

  extract($atts);

  return '<div class="col-md-6"><div class="progressbar bottom-padding"><div class="skill-details"><h3 class="title">' . $title . '</h3>' . do_shortcode( $content ) . '</div></div></div>';

});


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



//Language Skills
add_shortcode( 'candor_language_skills', function( $atts, $content= null ) {
    $atts = shortcode_atts(
    array(
      'title'  => 'Language Skills'
      ), $atts);

  extract($atts);

  return '<div class="col-md-7"><div id="skills" class="bottom-padding"><div id="language-details" class="language-details"><h3 class="title">' . $title . '</h3>' . do_shortcode( $content ) . '</div></div></div>';

});


add_shortcode( 'skills', function( $atts, $content= null ) {
  $atts = shortcode_atts(
    array(
      "width"        => '70%'
      ), $atts);

  extract($atts);

  return '<div class="col-sm-6 col-md-3 text-center"> 
            <div class="chart" data-percent="' . $width . '">
              <div class="chart-content">
                <span class="item-title">' . do_shortcode( $content ) . '</span>
                <span class="data-percent">' . $width . '</span>  
              </div><!-- /.chart-content -->
            </div>
          </div>';  

});





//Knowledge Skills
add_shortcode( 'candor_knowledge_skills', function( $atts, $content= null ) {
    $atts = shortcode_atts(
    array(
      'title'  => 'Knowledge Base'
      ), $atts);

  extract($atts);


  return '<div class="col-md-5"><div class="knowledge-details bottom-padding"><h3 class="title">' . $title . '</h3>' . do_shortcode( $content ) . '</div></div>';

});


add_shortcode( 'knowledge', function( $atts, $content= null ) {

  return '<div class="col-sm-6"><span>' . do_shortcode( $content ) . '</span></div>';  

});





//container
add_shortcode( 'angels_container', function( $atts, $content = null ) {
  $atts = shortcode_atts(
    array(
      "content"        => '',
      ), $atts);
  
  extract($atts);

  return '<div class="container"><div class="row">' . do_shortcode( $content ) . '</div></div>';
});



//Dropcap
add_shortcode( 'candor_dropcap',  function( $atts, $content="" ) {
  return '<p class="dropcap">' . do_shortcode( $content ) .'</p>';
} );
