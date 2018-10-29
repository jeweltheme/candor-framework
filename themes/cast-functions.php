<?php
// NORD Functions


/**
 * Redirect page template if vc_row shortcode is found in the page.
 * This lets us use a dedicated page template for Visual Composer pages
 * without the need for on page checks, or custom page templates.
 * 
 * It's buyer-proof basically.
 */
if(!( function_exists('candor_framework_nord_vc_page_template') )){
  function candor_framework_nord_vc_page_template( $template ){
    global $post;
    
    if( is_archive() || is_404() )
      return $template;
    
    if(!( isset($post->post_content) ) || is_search() )
      return $template;
      
    if( has_shortcode($post->post_content, 'vc_row') ){
      $new_template = locate_template( array( 'page_visual_composer.php' ) );
      
      if( is_singular('portfolio') ){
        $new_template = locate_template( array( 'page_visual_composer_single_portfolio.php' ) );
      }
      
      if (!( '' == $new_template )){
        return $new_template;
      }
    }
    return $template;
  }
  add_filter( 'template_include', 'candor_framework_nord_vc_page_template', 99 );
}



function nord_custom_styles(){ 
  global $nord_options;
  ?>

  <style type="text/css">
      /* Custom CSS */
      <?php if (isset($nord_options['custom_css'])){
           echo $nord_options['custom_css'];
      }?>
  </style>

<?php 
}  //Check Redux Plugin is Activated
if ( in_array( 'redux-framework/redux-framework.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    add_action( 'wp_head', 'nord_custom_styles');
}
