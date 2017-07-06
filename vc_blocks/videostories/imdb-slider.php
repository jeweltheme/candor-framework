<?php 

/**
 * The Shortcode
 */
function candor_framework_videstories_imdb_slider_shortcode( $atts ) {
  extract( 
    shortcode_atts( 
      array(

        'orderby'     => 'ID',
        'ppp'         => '8',
      ), $atts 
    ) 
  );


  
  ob_start();

  global $post;
?>

  <section class="top-videos">
    <div class="section-padding">
      <div class="container">
        <div class="recent-movie-slider owl-carousel owl-theme">

        <?php 
        global $post;
        $count = 5;
        $query_args = array(
          'post_type' => 'imdb',
          'posts_per_page' => $count,
        );
        $block_query = new WP_Query( $query_args );
        if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();

          $terms = wp_get_post_terms( get_the_ID(), 'movie_category', array("fields" => "all"));  
          $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-cat-thumb' ) );

          $t = array();                    
          foreach($terms as $term)
            $t[] = $term->slug;       


          ?>


          <div class="item">
            <article id="movie-<?php the_ID(); ?>" <?php post_class(); ?>>
              <div class="entry-thumbnail">
                <a href="<?php the_permalink();?>">
                  <?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-movie-thumb'); } ?>
                </a>
                <span class="rating"><i class="fa fa-star"></i><span class="count"><?php echo videostories_meta('_videostories_movie_imdb_rating');?></span></span>
              </div><!-- /.entry-thumbnail -->
              <div class="entry-content">
                <h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3><!-- /.entry-title -->
              </div><!-- /.entry-content -->
            </article><!-- /.post -->
          </div>

        <?php } } wp_reset_postdata(); wp_reset_query(); ?>      


      </div><!-- /.container -->
    </div><!-- /.section-padding -->
  </section><!-- /.top-videos -->


      
<?php 
  wp_reset_postdata();
  wp_reset_query();
  
  $output = ob_get_contents();
  ob_end_clean();
  
  return $output;
}
add_shortcode( 'videstories_imdb_slider', 'candor_framework_videstories_imdb_slider_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_videstories_imdb_slider_shortcode_vc() {
  
  vc_map( 
    array(
      "icon" => 'videstories-vc-block',
      "name" => esc_html__("Section: IMDb Slider", 'videostories'),
      "base" => "videstories_imdb_slider",
      "category" => esc_html__('VideoStories WP Theme', 'videostories'),
      'description' => 'Show IMDb Slider Videos.',
      "params" => array(
        array(
          "type" => "textfield",
          "heading" => esc_html__("Posts Count", 'videostories'),
          "param_name" => "ppp",
          "value" => '8',
        ),
        array( 
          'type' => 'dropdown',
          'param_name' => 'orderby', 
          'heading' => __( 'Ordery By', 'videostories'),            
          'admin_label' => true,          
          'value' => array( 
            esc_html__( 'Order By ID', 'videostories')           => 'ID', 
            esc_html__( 'Order By Author', 'videostories')         => 'author' ,
            esc_html__( 'Order By Title', 'videostories')        => 'title' ,
            esc_html__( 'Order By Name', 'videostories')         => 'name' ,
            esc_html__( 'Order By Date', 'videostories')         => 'date' ,
            esc_html__( 'Order By Last Modified Date', 'videostories')   => 'modified' ,
            esc_html__( 'Order By Random', 'videostories')         => 'rand' ,
            esc_html__( 'Order By Comments Number', 'videostories')    => 'comment_count' ,
          ) 
        ),


      )
    ) 
  );
  
}
add_action( 'vc_before_init', 'candor_framework_videstories_imdb_slider_shortcode_vc');