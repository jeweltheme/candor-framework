<?php
// Paypal Shortcode
add_shortcode('elevation_paypal', 'elevation_paypal_shortcode');
function elevation_paypal_shortcode($atts, $content = null){
	return elevation_paypal_form($atts);
} 
add_shortcode('candor_dropcap', 'elevation_dropcap_shortcode');
function elevation_dropcap_shortcode($atts, $content = null){
		return '<span class="candor_dropcap">' . esc_attr( $content ) . '</span>';
} 

// Google Map Marker
function elevation_footer_custom_script(){
  global $elevation_options;
  ?>  
        <script type="text/javascript">

           var elv = jQuery;
           elv.noConflict();

            elv(document).ready(function($) {
                "use strict";

                elv(window).load(function(){
                 elv('#preloader').fadeOut('slow',function(){elv(this).remove();});
               });


                elv(".video-container").fitVids();

                elv('#main-menu a[href^="#"]').click(function() {
                 elv('html,body').animate({ scrollTop: $(this.hash).offset().top- 100}, 1500);
                 return false;
                 e.preventDefault();
                });





            }); // End of Document 
          </script>

    <?php
}
add_action( 'wp_footer', 'elevation_footer_custom_script', 100 );


/**
 * Redirect page template if vc_row shortcode is found in the page.
 * This lets us use a dedicated page template for Visual Composer pages
 * without the need for on page checks, or custom page templates.
 * 
 * It's buyer-proof basically.
 */
if(!( function_exists('candor_framework_vc_page_template') )){
  function candor_framework_vc_page_template( $template ){
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
  add_filter( 'template_include', 'candor_framework_vc_page_template', 99 );
}

