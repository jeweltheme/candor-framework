<?php 

/**
 * The Shortcode
 */
function cast_latest_news_shortcode( $atts ) {
  extract( 
    shortcode_atts( 
      array(
        'title'         => 'Latest News',
        'pppage'        => '8',
        'filter'        => 'all'
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

  
  ob_start();

  $block_query = new WP_Query( $query_args );
?>

    <section class="latest-post">
        <div class="section-padding">
            <div class="container">
                <div class="inner-bg">
                    <h2 class="section-title"><?php echo $title;?></h2><!-- /.section-title -->

                    <div class="padding">
                        <div class="items">
                            <div id="latest-post-slider" class="latest-post-slider owl-carousel owl-theme">
                                
                                <?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();?>

                                      <div class="item">
                                          <article class="post type-post">

                                              <?php if ( has_post_thumbnail() ) { ?>
                                                <div class="entry-thumbnail">
                                                  <?php the_post_thumbnail('cast-blog-thumb'); ?>
                                                </div><!-- /.entry-thumbnail -->
                                              <?php } ?>

                                              <div class="latest-entry-content">
                                                  <h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3><!-- /.entry-title -->
                                                  <?php cast_related_post_meta();?>
                                                  <p class="description">
                                                      <?php echo wp_trim_words( get_the_content(), 22, ' '  ); ?>
                                                  </p><!-- /.description -->
                                                  <?php cast_read_more();?>
                                              </div><!-- /.entry-content -->
                                          </article><!-- /.post.type-post -->
                                      </div><!-- /.item -->

                                
                                      <?php } }   
                                  wp_reset_postdata();
                                  ?>
                                
                            </div><!-- /#latest-post-slider -->
                        </div><!-- /.items -->
                    </div><!-- /.padding -->
                </div><!-- /.inner-bg -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.latest-post -->

      
<?php 
  wp_reset_postdata();
  
  $output = ob_get_contents();
  ob_end_clean();
  
  return $output;
}
add_shortcode( 'cast_latest_news', 'cast_latest_news_shortcode' );


/**
 * The VC Functions
 */
function cast_latest_news_shortcode_vc() {
  
  vc_map( 
    array(
      "icon" => 'cast-vc-block',
      "name" => esc_html__("Latest News", 'cast'),
      "base" => "cast_latest_news",
      "category" => esc_html__('CAST WP Theme', 'cast'),
      'description' => 'Latest News as Slide',
      //'wrapper_class'   => 'clearfix',
      "params" => array(
          array(
            "type" => "textfield",
            "heading" => __("Title", 'elevation'),
            "param_name" => "title",
            "value" => 'Latest News'
          ),
          array(
            "type" => "textfield",
            "heading" => __("Show How Many Posts?", 'elevation'),
            "param_name" => "pppage",
            "value" => '8'
            )
      )
    ) 
  );
  
}
add_action( 'vc_before_init', 'cast_latest_news_shortcode_vc');