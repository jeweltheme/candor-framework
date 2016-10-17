<?php 

/**
 * The Shortcode
 */
function candor_framework_polmo_portfolio_shortcode( $atts ) {
  extract( 
    shortcode_atts( 
      array(
        'portfolio_posts' => '8',
        'filter'          => 'all'
      ), $atts 
    ) 
  );
  
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
        'taxonomy' => 'portfolio_category',
        'field' => 'id',
        'terms' => $filter
      )
    );
  }

  ob_start();
?>


      <div class="latest-projects wow animated fadeInUp" data-wow-delay=".5s">
          <div class="itemFilter text-center">
            <a href="#" data-filter="" class="current"><?php echo esc_html__('All','elevation');?></a>
            <?php 
            $category = get_terms( 'portfolio_category' );
            foreach ($category as $cat) { 
              echo '<a href="#" data-filter=".'.trim($cat->slug).'">'.$cat->name.'</a>';
            } ?> 
          </div> <!-- /.itemFilter -->

          <div id="project-items" class="project-items">
            
            <?php
              $portfolio = candor_get_custom_posts("portfolio", $portfolio_posts);
              foreach ($portfolio as $post) {
                  global $polmo_options;
                  setup_postdata($post);
                  $terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));  
                  $portfolio_style = get_post_meta( $post->ID,'_polmo_pro_portfolio_style',true );

                  $t = array();                    
                  foreach($terms as $term)
                      $t[] = $term->slug;
                      
                      $urls = wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'full' ) );
                  ?>

                    <div class="item <?php echo implode(' ', $t); $t = array(); ?> <?php echo $portfolio_style;?>">
                    <?php if( $polmo_options['portfolio_link'] == "popup" ){ ?>
                      <a href="<?php echo $urls;?>" class="image-popup-vertical-fit">
                    <?php } elseif( $polmo_options['portfolio_link'] == "link" ){  ?>
                      <a href="<?php echo get_the_permalink($post->ID);?>" class="portfolio-link">
                    <?php } ?>  
                      
                        <?php echo get_the_post_thumbnail($post->ID, 'full');?>
                      </a>
                      <div class="item-details">
                        <h3 class="project-title"><?php echo get_the_title($post->ID);?></h3>
                        <span class="category"><?php echo $term->name;?></span>
                      </div><!-- /.item-details -->
                    </div><!-- /.item -->

                <?php } ?>

          </div><!-- /#project-items -->

        </div><!-- /.latest-projects -->

      
<?php 
  wp_reset_postdata();
  
  $output = ob_get_contents();
  ob_end_clean();
  
  return $output;
}
add_shortcode( 'polmo_portfolio', 'candor_framework_polmo_portfolio_shortcode' );


/**
 * The VC Functions
 */
function candor_framework_polmo_portfolio_shortcode_vc() {
  
  vc_map( 
    array(
      "icon" => 'polmo-pro-vc-block',
      "name" => esc_html__("Portfolio Block", 'polmo-pro'),
      "base" => "polmo_portfolio",
      "category" => esc_html__('Polmo Pro WP Theme', 'polmo-pro'),
      'description' => 'Show Portfolio posts with layout options.',
      "params" => array(
        array(
          "type" => "textfield",
          "heading" => __("Show How Many Posts?", 'elevation'),
          "param_name" => "portfolio_posts",
          "value" => '8'
        )
      )
    ) 
  );
  
}
add_action( 'vc_before_init', 'candor_framework_polmo_portfolio_shortcode_vc');