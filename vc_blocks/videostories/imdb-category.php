<?php 

/**
 * The Shortcode
 */
function candor_framework_videstories_imdb_category_shortcode( $atts ) {
  extract( 
    shortcode_atts( 
      array(
          'section_title'   => 'English Movies',
          'movie_cat_id'    => '',
          'ppp'             => '6',
      ), $atts 
    ) 
  );


  
  ob_start();

  global $post;
?>

<section class="video-contents">
  <div class="section-padding">    
      <div class="movie-contents-area">

        <div class="left-panel">
          <h2 class="section-title"><?php echo esc_attr( $section_title );?></h2><!-- /.section-title -->
            <?php 
              $term = get_term( $movie_cat_id, 'imdb_category' );
              $term_link = get_term_link( $term );
              echo '<a href="' . $term_link . '"  class="btn view-all">'. esc_html__('View All', 'videostories') .'</a>';
            ?>
            <div class="movie-contents">
              <?php               
              $query_args = array(
                'post_type'       => 'imdb',
                'posts_per_page'  => $ppp,
                'post_status'     => 'publish',                     
                'tax_query'       => array(
                  array(
                    'taxonomy'  => 'imdb_category',
                    'field'     => 'term_id',
                    'terms'     => $movie_cat_id
                    ),
                  ),
                );
              $block_query = new WP_Query( $query_args );
              if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();

                $terms = wp_get_post_terms( get_the_ID(), 'imdb_category', array("fields" => "all"));  
                $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'videostories-cat-thumb' ) );
                $poster = videostories_meta('_videostories_movie_imdb_poster'); 
                
                $t = array();                    
                foreach($terms as $term)
                  $t[] = $term->slug;       

                ?>

              <div class="col-sm-4 col-xs-6">
                <div class="contents">
                  <article id="movie-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-thumbnail">
                      <a href="<?php the_permalink();?>">

                        <?php if( has_post_thumbnail() ){ the_post_thumbnail('videostories-movie-thumb'); } else{ if( $poster) {?>
                            <img src="<?php echo esc_url_raw( $poster );?>">
                        <?php } else{ ?>
                            <img src="<?php echo get_template_directory_uri(). '/inc/imdb/imdb-grabber/posters/not-found.jpg';?>?>">  
                        <?php } } ?>
                        

                      </a>
                      <span class="rating"><i class="fa fa-star"></i><span class="count"><?php echo videostories_meta('_videostories_movie_imdb_rating');?></span></span>
                    </div><!-- /.entry-thumbnail -->
                    <div class="entry-content">
                      <h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3><!-- /.entry-title -->
                    </div><!-- /.entry-content -->
                  </article><!-- /.post -->
                </div>
              </div>


              <?php } } wp_reset_postdata(); wp_reset_query(); ?>      

            </div><!-- /.movie-contents -->
          </div><!-- left-panel -->
       

      
    </div>
  </div>
</section>

   
<?php 
  wp_reset_postdata();
  wp_reset_query();
  
  $output = ob_get_contents();
  ob_end_clean();
  
  return $output;
}
add_shortcode( 'videstories_imdb_category', 'candor_framework_videstories_imdb_category_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_videstories_imdb_category_shortcode_vc() {
  
  vc_map( 
    array(
      "icon" => 'videstories-vc-block',
      "name" => esc_html__("Section: IMDb Category", 'videostories'),
      "base" => "videstories_imdb_category",
      "category" => esc_html__('VideoStories WP Theme', 'videostories'),
      'description' => 'Show IMDb Category Videos.',
      "params" => array(
        array(
          "type" => "textfield",
          "heading" => __("Section Title", 'videostories'),
          "param_name" => "section_title",
          'holder' => '',
          'value' => 'English Movies',
          ),        
        array(
          "type" => "textfield",
          "heading" => __("IMDb Category ID", 'videostories'),
          "param_name" => "movie_cat_id",
          'holder' => '',
          'value' => '5',
          ),  
        array(
          "type" => "textfield",
          "heading" => __("IMDb Posts Count", 'videostories'),
          "param_name" => "ppp",
          'holder' => '',
          'value' => '6',
          ),  



      )
    ) 
  );
  
}
add_action( 'vc_before_init', 'candor_framework_videstories_imdb_category_shortcode_vc');