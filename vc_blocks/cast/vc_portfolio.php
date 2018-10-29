<?php 

/**
 * The Shortcode
 */
function cast_portfolio_shortcode( $atts ) {
  extract( 
    shortcode_atts( 
      array(
        'portfolio_posts' => '8',
        'style'           => 'style1',
        'filters'          => 'yes',
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
    'post_type' => 'portfolio',
    'posts_per_page' => $portfolio_posts,
    'paged' => $paged
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


  if( $filter == 'all' ){
    $cats = get_categories('taxonomy=portfolio_category');
  } else {
    $cats = get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
  }

  
  $block_query = new WP_Query( $query_args );


  ob_start();
?>

<?php if( $style =="style1" ){ ?>
    <section class="works">
        <div class="section-padding">
            <div class="container">
                <div class="inner-bg">
                    <div class="padding">
                      <?php if( 'yes' == $filters && !( is_tax() ) ) { ?>
                        <ul class="filter">
                            <li><a class="active" href="#" data-filter="*"><?php echo  esc_html__('All','cast'); ?></a></li>
                            <?php
                            $cats = get_categories('taxonomy=portfolio_category');
                            if(is_array($cats)){
                              foreach($cats as $cat){
                                echo '<li><a href="#" data-filter=".'. esc_attr($cat->slug) .'">'. $cat->name .'</a></li>';
                              }
                            }
                            ?>
                        </ul>
                      <?php } ?>

                        <div class="items">
                            <div class="work-items grid-4">

                              <?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
                                
                                global $post;                                 
                                $image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'cast-portfolio-thumbs');
                                if(!( $image_thumb[0] ))
                                  return false;

                                $terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));  
                                $t = array();                    
                                $name = array();                    
                                foreach($terms as $term)
                                  $t[] = $term->slug;
                                  $name[] = $term->name;
                                ?>

                                  <div class="item <?php echo implode(' ', $t); $t = array(); ?>">
                                      <img src="<?php echo $image_thumb[0];?>" alt="<?php the_title_attribute();?>">
                                      <div class="item-details">
                                          <div class="item-texts">
                                              <h3 class="item-title">
                                                <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                              </h3><!-- /.item-title -->
                                              <span class="category"><?php echo implode(' ', $name); $name = array(); ?></span><!-- /.category -->
                                          </div><!-- /.item-texts -->
                                      </div><!-- /.item-details -->
                                  </div><!-- /.item -->

                              <?php } } ?>

                            </div><!-- /.work-items -->
                        </div><!-- /.items -->
                    </div><!-- /.padding -->
                </div><!-- /.inner-bg -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.works -->    

<?php } elseif( $style =="style2" ){ ?>


    <section class="works">
        <div class="section-padding">
            <div class="container">
                <div class="inner-bg">
                    <div class="padding">

                      <?php if( 'yes' == $filters && !( is_tax() ) ) { ?>
                        <ul class="filter">
                            <li><a class="active" href="#" data-filter="*"><?php echo  esc_html__('All','cast'); ?></a></li>
                            <?php
                            $cats = get_categories('taxonomy=portfolio_category');
                            if(is_array($cats)){
                              foreach($cats as $cat){
                                echo '<li><a href="#" data-filter=".'. esc_attr($cat->slug) .'">'. $cat->name .'</a></li>';
                              }
                            }
                            ?>
                        </ul>
                      <?php } ?>                      

                        <div class="items">
                            <div class="work-items grid-3">

                              <?php if ( $block_query->have_posts() ) { while ( $block_query->have_posts() ) { $block_query->the_post();
                                
                                global $post;                                 
                                $image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'cast-portfolio-thumbs');
                                if(!( $image_thumb[0] ))
                                  return false;

                                $terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));  
                                $t = array();                    
                                $name = array();                    
                                foreach($terms as $term)
                                  $t[] = $term->slug;
                                  $name[] = $term->name;
                                ?>                                                                 

                                  <div class="item <?php echo implode(' ', $t); $t = array(); ?>">
                                      <img src="<?php echo $image_thumb[0];?>" alt="<?php the_title_attribute();?>">
                                      <div class="item-details">
                                          <div class="item-texts">
                                              <h3 class="item-title">
                                                <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                              </h3><!-- /.item-title -->
                                              <span class="category"><?php echo implode(' ', $name); $name = array(); ?></span><!-- /.category -->
                                          </div><!-- /.item-texts -->
                                      </div><!-- /.item-details -->
                                  </div><!-- /.item -->

                                <?php } } ?>

                            </div><!-- /.work-items -->
                        </div><!-- /.items -->
                    </div><!-- /.padding -->
                </div><!-- /.inner-bg -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.works -->    



<?php } ?>
      
<?php 
  wp_reset_postdata();
  
  $output = ob_get_contents();
  ob_end_clean();
  
  return $output;
}
add_shortcode( 'cast_portfolio', 'cast_portfolio_shortcode' );


/**
 * The VC Functions
 */
function cast_portfolio_shortcode_vc() {
  
  vc_map( 
    array(
      "icon" => 'cast-vc-block',
      "name" => esc_html__("Portfolio", 'cast'),
      "base" => "cast_portfolio",
      "category" => esc_html__('CAST WP Theme', 'cast'),
      'description' => 'Collection of Portfolio Items',
      //'wrapper_class'   => 'clearfix',
      "params" => array(
          array(
            "type" => "dropdown",
            "heading" => __("Portfolio Style", 'cast'),
            "param_name" => "style",
            "value" => array(
              'Style 1' => 'style1',
              'Style 2' => 'style2',
              ),
            ),           
          array(
            "type" => "dropdown",
            "heading" => __("Show Filters", 'cast'),
            "param_name" => "filters",
            "value" => array(
              'Yes' => 'yes',
              'No' => 'no',
              ),
            ),  
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
add_action( 'vc_before_init', 'cast_portfolio_shortcode_vc');