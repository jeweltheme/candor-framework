<?php 

/**
 * The Shortcode
 */
function candor_vc_home_gallery_block_shortcode( $atts, $content = null ) {
  extract( 
    shortcode_atts( 
      array(
        'title'             => 'Gallery',
        'learn_more_title'  => 'Learn More',
        'portfolio_posts'   => '8',
        'filter'            => 'all',
        'view_all_text'     => 'View All',
        'parallax_image'    => ELEVATION_PATH . '/images/2.jpg',
      ), $atts 
    ) 
  );
  
  global $elevation_options;

  /**
   * Setup post query
   */
  $query_args = array(
    'post_type'     => 'portfolio',
    'posts_per_page'  => $portfolio_posts
  );
  
  if (!( $filter == 'all' )) {
    if( function_exists( 'icl_object_id' ) ){
      $filter = (int)icl_object_id( $filter, 'portfolio_category', true);
    }
    $query_args['tax_query'] = array(
      array(
        'taxonomy'  => 'portfolio_category',
        'field'     => 'id',
        'terms'     => $filter
      )
    );
  }

  $parallax_image = wp_get_attachment_image_src($parallax_image, 'full' );

  ob_start();
?>

        <div class="gallery text-center">
          <div class="gallery-top" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="0" style="background: url('<?php echo $parallax_image[0];?>') no-repeat fixed center top;">
            <div class="parallax-style">
              <div class="section-padding">
                <div class="container">
                  <div class="section-top">
                    <h2 class="section-title"><?php echo esc_attr($title); ?></h2><!-- /.section-title -->
                    <p class="section-description">
                      <?php echo wpb_js_remove_wpautop(do_shortcode(htmlspecialchars_decode($content)));?>
                    </p><!-- /.section-description -->
                  </div><!-- /.section-top -->

                  <div class="section-border">
                    <div class="border-style">
                      <span></span>
                    </div><!-- /.border-style -->
                  </div><!-- /.section-border -->

                </div><!-- /.container -->
              </div><!-- /.section-padding -->
            </div><!-- /.parallax-style -->
          </div><!-- /.gallery-top -->

          <div class="section-details">
            <div class="itemFilter">
              <a href="#" data-filter="" class="current">
                <?php echo $view_all_text;?>
              </a>
              <?php 
              $category = get_terms( 'portfolio_category' );
              foreach ($category as $cat) { 
                echo '<a href="#" data-filter=".'. $cat->slug .'">'.$cat->name.'</a>';
              } ?> 

            </div> <!-- /.galleryFilter -->

            <div id="gallery-items" class="gallery-items">

              <?php
                $portfolio = candor_get_custom_posts("portfolio", $portfolio_posts);
                foreach ($portfolio as $post) {
                  setup_postdata($post);
                  $terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));  

                  $t = array();                    
                  foreach($terms as $term)
                      $t[] = $term->slug;
                   $urls = wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'full' ) );
                  ?>
                    <div class="item <?php echo implode(' ', $t); $t = array(); ?>">

                      <?php if( $elevation_options['section_portfolio_details_page'] == "popup" ) { ?>
                          <a href="<?php echo $urls; ?>">
                      <?php } else { ?>
                          <a href="<?php echo get_the_permalink($post->ID); ?>">
                      <?php } ?>

                        <?php echo get_the_post_thumbnail($post->ID, 'elevation-home-gallery');?>
                        <?php //the_post_thumbnail('elevation-blog-thumb'); ?>
                        <div class="item-details">
                          <h3 class="item-title">
                            <?php echo get_the_title($post->ID);?>
                          </h3>
                        </div><!-- /.item-details -->
                      </a>
                    </div><!-- /.item -->
                <?php } ?>

            </div><!-- /#gallery-items -->
          </div><!-- /.section-details -->
        </div><!-- /#gallery -->



<?php   
  //wp_reset_postdata();
  
  $output = ob_get_contents();
  ob_end_clean();
  
  return $output;

}
add_shortcode( 'elevation_home_gallery_box', 'candor_vc_home_gallery_block_shortcode' );



/**
 * The VC Functions
 */
function candor_home_gallery_block_shortcode_vc() {
  
  
  vc_map( 
    array(
      "icon" => 'elevation-vc-block',
      "name" => esc_html__("Home Gallery", 'elevation'),
      "base" => "elevation_home_gallery_box",
      "category" => esc_html__('Elevation WP Theme', 'elevation'),
      "params" => array(
        array(
          "type" => "textfield",
          "heading" => esc_html__("Section Title", 'elevation'),
          "param_name" => "title",
          'holder' => 'h2',
          'value' => 'Gallery'
        ),
        array(
          "type" => "textarea_html",
          "heading" => esc_html__("Block Content", 'elevation'),
          "param_name" => "content",
          'holder' => 'p',
          'value' => 'Feel our gallery photos and you can realize how poor people passing their life. This is high time for save both people and children to make our world happy.'
        ),
        array(
          'type' => 'attach_image',
          'heading' => esc_html__( 'Background Parallax Image', 'elevation' ),
          'param_name' => 'parallax_image',
          'value' => get_template_directory_uri() . '/images/2.jpg',
          "admin_label" => true,
          'description' => esc_html__( 'Select Background Parallax Image from media library.', 'elevation' )
        ),
        array(
          "type" => "textfield",
          "heading" => __("View All Text", 'elevation'),
          "param_name" => "view_all_text",
          "value" => esc_html__('View All', 'elevation' )
        ),
        array(
          "type" => "textfield",
          "heading" => __("Show How Many Portfolio Posts?", 'elevation'),
          "param_name" => "portfolio_posts",
          "value" => '8'
        )
        

      )
    ) 
  );
}
add_action( 'vc_before_init', 'candor_home_gallery_block_shortcode_vc' );