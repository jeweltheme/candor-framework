<?php 

/**
 * The Shortcode
 */
function cast_team_shortcode( $atts ) {
  extract( 
    shortcode_atts( 
      array(
        'title'           => 'Our Team',
        'team_posts'      => '8',        
        'style'           => 'style1',
        'filters'          => 'yes',
        'join_title'          => 'Wants to Join?',
        'join_position'          => 'Full-time / Part-time / Internship',
        'join_desc'          => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est',
        'join_btn'          => 'Apply now',
        'join_link'          => '#',
        'join_thumb'          => get_template_directory_uri() . '/images/icons/02.svg',
        'filter'          => 'all'
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
    'post_type' => 'team',
    'posts_per_page' => $team_posts,
    'paged' => $paged
  );
  
  if (!( $filter == 'all' )) {
    if( function_exists( 'icl_object_id' ) ){
      $filter = (int)icl_object_id( $filter, 'team_category', true);
    }
    $query_args['tax_query'] = array(
      array(
        'taxonomy' => 'team_category',
        'field' => 'id',
        'terms' => $filter
      )
    );
  }


  if( $filter == 'all' ){
    $cats = get_categories('taxonomy=team_category');
  } else {
    $cats = get_categories('taxonomy=team_category&exclude='. $filter .'&child_of='. $filter);
  }

  
  $block_query = new WP_Query( $query_args );

  $join_thumb = wp_get_attachment_image_src( $join_thumb, 'full' );

  ob_start();
?>

<?php if( $style =="style1" ){ ?>
    <section class="team-section">
        <div class="section-padding">
            <div class="container">
                <div class="inner-bg">
                    <h2 class="section-title"><?php echo $title;?></h2>
                    <div class="padding">
                        <div class="items">
                            <div id="team-slider" class="team-slider owl-carousel owl-theme text-center">
                                
                              <?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
                                
                                global $post;    
                                $team_member_name        = cast_meta( '_cast_team_member_name');
                                $team_member_designation         = cast_meta( '_cast_team_member_designation');
                                $team_desc         = cast_meta( '_cast_team_team_desc');
                                $social_twitter         = cast_meta( '_cast_social_twitter');
                                $social_facebook         = cast_meta( '_cast_social_facebook');
                                $social_dribbble         = cast_meta( '_cast_social_dribbble');
                                $social_google_plus         = cast_meta( '_cast_social_google_plus');
                                $social_linkedin         = cast_meta( '_cast_social_linkedin');
                                $social_instagram         = cast_meta( '_cast_social_instagram');

                                $image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'cast-team-thumbs');
                                if(!( $image_thumb[0] ))
                                  return false;
                                ?>      

                                <div class="item">
                                    <div class="member">
                                        <div class="member-image">
                                          <img src="<?php echo $image_thumb[0];?>" alt="<?php the_title_attribute();?>">
                                        </div><!-- /.member-image -->
                                        <div class="member-details">
                                            <h3 class="name item-title">
                                              <a href="<?php the_permalink();?>"><?php echo esc_attr($team_member_name);?></a>
                                            </h3><!-- /.name -->
                                            <span class="designation"><?php echo esc_attr($team_member_designation);?></span><!-- /.designation -->
                                            <div class="member-social">

                                              <?php if( $social_facebook ){ ?>
                                                <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                                              <?php } if( $social_twitter ){ ?>
                                                <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                                              <?php } if( $social_linkedin ){ ?>
                                                <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                                              <?php } if( $social_google_plus ){ ?>
                                                <a class="google-plus" href="#"><i class="fa fa-google-plus-circle"></i></a>
                                              <?php } if( $social_dribbble ){ ?>
                                                <a class="google-plus" href="#"><i class="fa fa-dribbble"></i></a>
                                              <?php } if( $social_instagram ){ ?>
                                                <a class="google-plus" href="#"><i class="fa fa-instagram"></i></a>
                                              <?php } ?>  

                                            </div><!-- /.member-social -->
                                        </div><!-- /.member-details -->
                                    </div><!-- /.member -->
                                </div><!-- /.item -->

                              <?php } } ?>

                            </div><!-- /#team-slider -->
                        </div><!-- /.items -->
                    </div><!-- /.padding -->
                </div><!-- /.inner-bg -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.team-section -->

<?php } elseif( $style =="style2" ){ ?>


    
    <section class="our-team">
        <div class="section-padding">
            <div class="container">
                <div class="items">

                   <?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
                                
                        global $post;    
                        $team_member_name             = cast_meta( '_cast_team_member_name');
                        $team_member_designation      = cast_meta( '_cast_team_member_designation');
                        $team_desc                    = cast_meta( '_cast_team_desc');
                        $social_twitter               = cast_meta( '_cast_social_twitter');
                        $social_facebook              = cast_meta( '_cast_social_facebook');
                        $social_dribbble              = cast_meta( '_cast_social_dribbble');
                        $social_google_plus           = cast_meta( '_cast_social_google_plus');
                        $social_linkedin              = cast_meta( '_cast_social_linkedin');
                        $social_instagram             = cast_meta( '_cast_social_instagram');

                        $image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'cast-team-thumbs');
                        if(!( $image_thumb[0] ))
                          return false;
                        ?>    

                          <div class="col-sm-3">
                              <div class="member">
                                  <div class="inner-bg">
                                      <div class="member-image">
                                        <img src="<?php echo $image_thumb[0];?>" alt="<?php the_title_attribute();?>">
                                      </div><!-- /.member-image -->
                                      <div class="member-details">
                                          <div class="padding">
                                              <h3 class="name"><?php echo esc_attr($team_member_name);?></h3><!-- /.name -->
                                              <span class="designation"><?php echo esc_attr($team_member_designation);?></span><!-- /.designation -->
                                              <p class="description">
                                                  <?php echo esc_attr($team_desc);?>
                                              </p><!-- /.description -->
                                              <div class="member-social">
                                                <?php if( $social_facebook ){ ?>
                                                  <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                                                <?php } if( $social_twitter ){ ?>
                                                  <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                                                <?php } if( $social_linkedin ){ ?>
                                                  <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                                                <?php } if( $social_google_plus ){ ?>
                                                  <a class="google-plus" href="#"><i class="fa fa-google-plus-circle"></i></a>
                                                <?php } if( $social_dribbble ){ ?>
                                                  <a class="google-plus" href="#"><i class="fa fa-dribbble"></i></a>
                                                <?php } if( $social_instagram ){ ?>
                                                  <a class="google-plus" href="#"><i class="fa fa-instagram"></i></a>
                                                <?php } ?>  
                                              </div><!-- /.member-social -->
                                          </div><!-- /.padding -->
                                      </div><!-- /.member-details -->
                                  </div><!-- /.inner-bg -->
                              </div><!-- /.member -->
                          </div>

                    <?php } } ?>


                    <div class="col-sm-3">
                        <div class="member join">
                            <div class="inner-bg">
                                <div class="member-image">
                                  <img src="<?php echo $join_thumb[0];?>" alt="<?php the_title_attribute();?>">
                                </div><!-- /.member-image -->
                                <div class="member-details">
                                    <div class="padding">
                                        <h3 class="name"><?php echo $join_title;?></h3><!-- /.name -->
                                        <span class="designation"><?php echo $join_position;?></span><!-- /.designation -->
                                        <p class="description">
                                            <?php echo $join_desc;?>
                                        </p><!-- /.description -->
                                        <a href="<?php echo $join_link;?>" class="btn read-more"><?php echo $join_btn;?> <i class="ti-arrow-right"></i></a>
                                    </div><!-- /.padding -->
                                </div><!-- /.member-details -->
                            </div><!-- /.inner-bg -->
                        </div><!-- /.member -->
                    </div>


                </div><!-- /.items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.our-team -->    


<?php } ?>

      
<?php 
  wp_reset_postdata();
  
  $output = ob_get_contents();
  ob_end_clean();
  
  return $output;
}
add_shortcode( 'cast_team', 'cast_team_shortcode' );


/**
 * The VC Functions
 */
function cast_team_shortcode_vc() {
  
  vc_map( 
    array(
      "icon" => 'cast-vc-block',
      "name" => esc_html__("Team Block", 'cast'),
      "base" => "cast_team",
      "category" => esc_html__('CAST WP Theme', 'cast'),
      'description' => 'Collection of Team Items',
      //'wrapper_class'   => 'clearfix',
      "params" => array(
          array(
              "type" => "dropdown",
              "heading" => __("Team Style", 'cast'),
              "param_name" => "style",
              "value" => array(
                'Style 1' => 'style1',
                'Style 2' => 'style2',
                ),
            ),           
          array(
              "type" => "textfield",
              "heading" => __("Show How Many Posts?", 'cast'),
              "param_name" => "team_posts",
              "value" => '8'
          ),


          //Wants to Join?
          array(
              "type" => "textfield",
              "heading" => __("Join Title?", 'cast'),
              "param_name" => "join_title",
              'dependency' => array( 
                'element'   => "style", 
                'value'   => array( 'style2')
                ), 
              "value" => 'Wants to Join?'
            ),           
          array( 
            'type' => 'attach_image', 
            'heading' => __( 'Join Image', 'cast'), 
            'param_name' => 'join_thumb',
            'value' => get_template_directory_uri() . '/images/icons/02.svg',
            'dependency' => array( 
              'element'   => "style", 
              'value'   => array( 'style2')
              ), 
            'description' => __( 'Select Service Background from media library', 'cast') 
            ), 

          array(
              "type" => "textfield",
              "heading" => __("Join Title?", 'cast'),
              "param_name" => "join_title",
              'dependency' => array( 
                'element'   => "style", 
                'value'   => array( 'style2')
                ),               
              "value" => 'Wants to Join?'
            ),          
          array(
              "type" => "textfield",
              "heading" => __("Join Positions", 'cast'),
              "param_name" => "join_position",
              'dependency' => array( 
                'element'   => "style", 
                'value'   => array( 'style2')
                ),               
              "value" => 'Full-time / Part-time / Internship'
            ),          
          array(
              "type" => "textfield",
              "heading" => __("Join Description", 'cast'),
              "param_name" => "join_desc",
              'dependency' => array( 
                'element'   => "style", 
                'value'   => array( 'style2')
                ),               
              "value" => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est'
            ),
          array(
              "type" => "textfield",
              "heading" => __("Join Button", 'cast'),
              "param_name" => "join_btn",
              'dependency' => array( 
                'element'   => "style", 
                'value'   => array( 'style2')
                ),               
              "value" => 'Apply Now'
            ),
          array(
              "type" => "textfield",
              "heading" => __("Join Link", 'cast'),
              "param_name" => "join_link",
              'dependency' => array( 
                'element'   => "style", 
                'value'   => array( 'style2')
                ),               
              "value" => '#'
            ),

      )
    ) 
  );
  
}
add_action( 'vc_before_init', 'cast_team_shortcode_vc');
