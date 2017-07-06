<?php
if( !defined('ABSPATH') ) exit;

//remove_filter ('the_content', 'wpautop');
//add_filter( 'the_content', 'wpautop' , 99);
add_filter( 'the_content', 'videostories_shortcode_empty_paragraph_fix' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function videostories_shortcode_empty_paragraph_fix( $content ) {
 
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



// Add new custom font to Font Family selection in icon box module
function videostories_add_new_icon_set_to_iconbox( ) {
  $param = WPBMap::getParam( 'videstories_contact_details', 'contact_icon' );
  $param['value'][__( 'Themify Icon', 'videostories' )] = 'themify';
  vc_update_shortcode_param( 'contact_icon', $param );
}
add_filter( 'init', 'videostories_add_new_icon_set_to_iconbox', 40 );


// Load your CSS to display the icons in the Visual Composer Editor
// This is important because Visual Composer settings load in an iFrame if your CSS is just added in style.css
// You won't see the icons to select in the Visual Composer so you must load it as a new stylesheet.
function videostories_enqueue_font_icon_style_editor() {
  wp_enqueue_style( 'themify-icons', get_stylesheet_directory_uri() . '/assets/css/themify-icons.css' );
}
add_action( 'vc_backend_editor_enqueue_js_css', 'videostories_enqueue_font_icon_style_editor' );
add_action( 'vc_frontend_editor_enqueue_js_css', 'videostories_enqueue_font_icon_style_editor' );



// Optional - Conditionally load CSS for your icon font as requested by modules on the live site
// Only required if you aren't already loading the custom font globally
function videostories_enqueue_font_icon_style( $font ) {
  if ( 'themify' == $font ) {
    wp_enqueue_style( 'themify-icons', get_stylesheet_directory_uri() . '/assets/css/themify-icons.css' );
  }
}
add_action( 'vc_backend_editor_enqueue_jscss', 'videostories_enqueue_font_icon_style', 10, 2 );




// Social Widget VC Shortcode
if( !function_exists( 'videostories_wp_social_followers') ){
  function videostories_wp_social_followers(){
    add_shortcode('wp_social_followers', 'videostories_wp_social_followers_shortcode');

    if( !function_exists('vc_map') )
      return;
    $args = array(
      'name'  =>  esc_html__('WP Social Authors','videostories'),
      'base'  =>  'wp_social_followers',
      'category'  =>  esc_html__('WordPress Widgets','videostories'),
      "icon" => 'videstories-vc-block',
      'description' =>  esc_html__('Display the Social count box.','videostories'),
      'params'  =>  array(
          array(
            'type'  =>  'textfield',
            'holder'  =>  'div',
            'class' =>  '',
            'heading' =>  __('Title','videostories'),
            'param_name'  =>  'title',
            'value' => 'Stay Connected',
          ),
          array(
            "type" => "textfield",
            "heading" => esc_html__("Facebook Page Url:", 'videstories'),
            "param_name" => "facebook_page_url",
            "value" => '',
            ), 

          array(
            "type" => "textfield",
            "heading" => esc_html__("Facebook App ID:", 'videstories'),
            "param_name" => "facebook_app_id",
            "value" => '',
            ), 

          array(
            "type" => "textfield",
            "heading" => esc_html__("Facebook Access Token:", 'videstories'),
            "param_name" => "facebook_access_token",
            "value" => '',
            ), 

          array(
            "type" => "textfield",
            "heading" => esc_html__("Facebook Like Text:", 'videstories'),
            "param_name" => "facebook_text",
            "value" => '',
            ), 
          array(
            "type" => "textfield",
            "heading" => esc_html__("Twitter ID:", 'videstories'),
            "param_name" => "twitter_id",
            "value" => '',
            ), 
          array(
            "type" => "textfield",
            "heading" => esc_html__("Twitter Consumer Key:", 'videstories'),
            "param_name" => "twitter_comsumer_key",
            "value" => '',
            ), 
          array(
            "type" => "textfield",
            "heading" => esc_html__("Twitter Consumer Secret:", 'videstories'),
            "param_name" => "twitter_comsumer_secret",
            "value" => '',
            ), 
          array(
            "type" => "textfield",
            "heading" => esc_html__("Twitter Access Token:", 'videstories'),
            "param_name" => "twitter_access_token",
            "value" => '',
            ), 
          array(
            "type" => "textfield",
            "heading" => esc_html__("Twitter Access Token Secret:", 'videstories'),
            "param_name" => "twitter_access_token_secret",
            "value" => '',
            ), 
          array(
            "type" => "textfield",
            "heading" => esc_html__("Twitter Text:", 'videstories'),
            "param_name" => "twitter_text",
            "value" => '',
            ), 
          array(
            "type" => "textfield",
            "heading" => esc_html__("Google Plus ID:", 'videstories'),
            "param_name" => "googleplus_id",
            "value" => '',
            ), 
          array(
            "type" => "textfield",
            "heading" => esc_html__("Google Plus Text:", 'videstories'),
            "param_name" => "googleplus_text",
            "value" => '',
            ),           
          array(
            "type" => "textfield",
            "heading" => esc_html__("Youtube ID:", 'videstories'),
            "param_name" => "youtube_id",
            "value" => '',
            ), 
          array(
            "type" => "textfield",
            "heading" => esc_html__("Youtube Channel ID:", 'videstories'),
            "param_name" => "youtube_channel",
            "value" => '',
            ),           
          array(
            "type" => "textfield",
            "heading" => esc_html__("Youtube API Key:", 'videstories'),
            "param_name" => "youtube_app_key",
            "value" => '',
            ), 
          array(
            "type" => "textfield",
            "heading" => esc_html__("Youtube Text:", 'videstories'),
            "param_name" => "youtube_text",
            "value" => '',
            ),           
          array(
            "type" => "textfield",
            "heading" => esc_html__("Dribbble:", 'videstories'),
            "param_name" => "dribbble",
            "value" => '',
            ), 
          array(
            "type" => "textfield",
            "heading" => esc_html__("Dribbble Access Token:", 'videstories'),
            "param_name" => "dribbble_access_token",
            "value" => '',
            ), 
          array(
            "type" => "textfield",
            "heading" => esc_html__("Dribbble Text:", 'videstories'),
            "param_name" => "dribbble_text",
            "value" => '',
            ), 

        )
    );

  vc_map( $args );  

  }
  add_action( 'init' , 'videostories_wp_social_followers');
}

function videostories_wp_social_followers_shortcode( $atts, $content = null ){
  $output = $title = $el_class = $facebook_page_url = $facebook_app_id = $facebook_access_token = $facebook_text = $twitter_id = $twitter_comsumer_key = $twitter_comsumer_secret = $twitter_access_token = $twitter_access_token_secret = $twitter_text = $googleplus_id = $googleplus_text = $youtube_id = $youtube_channel = $youtube_app_key = $youtube_text = $dribbble = $dribbble_access_token = $dribbble_text = '';
    extract( shortcode_atts( array(
        'title' => '',        

          // Facebook
        'facebook_page_url'       => '',
        'facebook_app_id'       => '',
        'facebook_access_token'     => '',
        'facebook_text'         => '',

          // Twitter
        'twitter_id'          => '',
        'twitter_comsumer_key'      => '',
        'twitter_comsumer_secret'   => '',
        'twitter_access_token'      => '',
        'twitter_access_token_secret' => '',
        'twitter_text'          => '',

          // Google Plus
        'googleplus_id'         => '',
        'googleplus_text'       => '',

          // Youtube
        'youtube_id'          => '',
        'youtube_channel'       => '',
        'youtube_app_key'       => '',
        'youtube_text'          => '',

          // Dribbble Socials
        'dribbble'            => '',
        'dribbble_access_token'     => '',
        'dribbble_text'         => ''


    ), $atts ) );
    
    ob_start();
    the_widget( 'WP_Social_Followers', $atts, array() );
      $output .= '<aside class="sidebar">';
      $output .= ob_get_clean();
      $output .= '</aside>';
    return $output;

}


/* Latest Post Widget */

if( !function_exists( 'videostories_latest_post') ){
  function videostories_latest_post(){
    add_shortcode('latest_post', 'videostories_latest_post_shortcode');

    if( !function_exists('vc_map') )
      return;
    $args = array(
      'name'  =>  esc_html__('Latest Posts','videostories'),
      'base'  =>  'latest_post',
      'category'  =>  esc_html__('WordPress Widgets','videostories'),
      "icon" => 'videstories-vc-block',
      'description' =>  esc_html__('Display Latest Posts Widget','videostories'),
      'params'  =>  array(
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Title','videostories'),
          'param_name'  =>  'title',
          'value'       => esc_html__( 'Latest Post', 'videostories' )
          ),
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Post Count','videostories'),
          'param_name'  =>  'count',
          'value'       => '3'
          )

        )
      );

    vc_map( $args ); 
  }
  add_action( 'init' , 'videostories_latest_post');
}

function videostories_latest_post_shortcode( $atts, $content = null ){
  $output = $title = $count = $el_class = '';

  extract( shortcode_atts( array(
    'title'   => '',        
    'count'   => '',
    ), $atts ) );

  ob_start();
  the_widget( 'JWT_Latest_Post_Widget', $atts, array() );
  $output .= '<aside class="sidebar">';
  $output .= ob_get_clean();
  $output .= '</aside>';
  return $output;

}



/* Most Liked Widget */

if( !function_exists( 'videostories_most_liked') ){
  function videostories_most_liked(){
    add_shortcode('most_liked', 'videostories_most_liked_shortcode');

    if( !function_exists('vc_map') )
      return;
    $args = array(
      'name'  =>  esc_html__('Most Liked','videostories'),
      'base'  =>  'most_liked',
      'category'  =>  esc_html__('WordPress Widgets','videostories'),
      "icon" => 'videstories-vc-block',
      'description' =>  esc_html__('Display Most Liked Widget','videostories'),
      'params'  =>  array(
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Title','videostories'),
          'param_name'  =>  'title',
          'value'       => esc_html__( 'Most Liked', 'videostories' )
          ),
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Post Count','videostories'),
          'param_name'  =>  'count',
          'value'       => '2'
          )

        )
      );

    vc_map( $args ); 
  }
  add_action( 'init' , 'videostories_most_liked');
}

function videostories_most_liked_shortcode( $atts, $content = null ){
  $output = $title = $count = $el_class = '';

  extract( shortcode_atts( array(
    'title'   => '',        
    'count'   => '',
    ), $atts ) );

  ob_start();
  the_widget( 'JWT_Most_Likes_Widget', $atts, array() );
  $output .= '<aside class="sidebar">';
  $output .= ob_get_clean();
  $output .= '</aside>';
  return $output;

}






/* Today\'s Most Viewed Widget */

if( !function_exists( 'videostories_todays_most_viewed') ){
  function videostories_todays_most_viewed(){
    add_shortcode('most_viewd', 'videostories_todays_most_viewed_vc_shortcode');

    if( !function_exists('vc_map') )
      return;
    $args = array(
      'name'  =>  esc_html__('Todays Most Viewed','videostories'),
      'base'  =>  'most_viewd',
      'category'  =>  esc_html__('WordPress Widgets','videostories'),
      "icon" => 'videstories-vc-block',
      'description' =>  esc_html__('Display Today\'s Most Viewed Widget','videostories'),
      'params'  =>  array(
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Title','videostories'),
          'param_name'  =>  'title',
          'value'       => esc_html__( 'Today\'s Most Viewed', 'videostories' )
          ),
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Post Count','videostories'),
          'param_name'  =>  'count',
          'value'       => '1'
          )

        )
      );

    vc_map( $args ); 
  }
  add_action( 'init' , 'videostories_todays_most_viewed');
}

function videostories_todays_most_viewed_vc_shortcode( $atts, $content = null ){
  $output = $title = $count = $el_class = '';

  extract( shortcode_atts( array(
    'title'   => 'Today\'s Most Viewed',        
    'count'   => '1',
    ), $atts ) );

  ob_start();
  the_widget( 'Jewel_Theme_Todays_Most_Viewed', $atts, array() );
  $output .= '<aside class="sidebar">';
  $output .= ob_get_clean();
  $output .= '</aside>';
  return $output;

}



/* Instagram Widget */

if( !function_exists( 'videostories_instagram_vc_widget') ){
  function videostories_instagram_vc_widget(){
    add_shortcode('instagram_feed', 'videostories_instagram_widget_shortcode');

    if( !function_exists('vc_map') )
      return;
    $args = array(
      'name'  =>  esc_html__('Instagram Posts','videostories'),
      'base'  =>  'instagram_feed',
      'category'  =>  esc_html__('WordPress Widgets','videostories'),
      "icon" => 'videstories-vc-block',
      'description' =>  esc_html__('Display Instagram Posts Widget','videostories'),
      'params'  =>  array(
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Title','videostories'),
          'param_name'  =>  'title',
          'value'       => esc_html__( 'Instagram Posts', 'videostories' )
        ),
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Username','videostories'),
          'param_name'  =>  'username',
          'value'       => ''
        ),
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Posts Count','videostories'),
          'param_name'  =>  'number_items',
          'value'       => '6'
        ),


        )
      );

    vc_map( $args ); 
  }
  add_action( 'init' , 'videostories_instagram_vc_widget');
}

function videostories_instagram_widget_shortcode( $atts, $content = null ){

  //$output = $title = $username = $number_items = $columns = $spacing = $height = $width = $show_likes_comments = $show_follow_text = $follow_text = $link_new_page = $el_class = '';
  $output = $title = $username = $number_items = $el_class = '';

  extract( shortcode_atts( array(
    'title'   => '',        
    'username'   => '',
    'number_items'   => '',
    ), $atts ) );

  ob_start();
  the_widget( 'WP_Awesome_Instagram_Widget', $atts, array() );
  
  $output .= '<aside class="sidebar">';
  $output .= ob_get_clean();
  $output .= '</aside>';


  return $output;

}


/* Facebook Feed */
if( !function_exists( 'videostories_facebook_vc_widget') ){
  function videostories_facebook_vc_widget(){
    add_shortcode('facebbok_feed', 'videostories_facebook_widget_shortcode');

    if( !function_exists('vc_map') )
      return;
    $args = array(
      'name'        =>  esc_html__('Facebook Page Feed','videostories'),
      'base'        =>  'facebbok_feed',
      'category'    =>  esc_html__('WordPress Widgets','videostories'),
      "icon"        => 'videstories-vc-block',
      'description' =>  esc_html__('Display Facebook Page Widget','videostories'),
      'params'      =>  array(
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Facebook Page ID','videostories'),
          'param_name'  =>  'page_name',
          'description'  => esc_html__( 'Facebook Page URL', 'videostories' ),
          'value'       => esc_html__( 'jwthemeltd', 'videostories' )
          ),
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Application ID','videostories'),
          'param_name'  =>  'app_id',
          'value'       => ''
          ),
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Width','videostories'),
          'param_name'  =>  'width',
          'value'       => '320'
          ),


        )
      );

    vc_map( $args ); 

  }

  add_action( 'init' , 'videostories_facebook_vc_widget');
}

function videostories_facebook_widget_shortcode( $atts, $content = null ){
  $output = $width = $username = $app_id = $el_class = '';

  extract( shortcode_atts( array(      
    'page_name'   => '',
    'app_id'   => '',
    'width'   => '',
    ), $atts ) );

  ob_start();
  the_widget( 'JewelTheme_Facebook_like', $atts, array() );
  
  $output .= '<aside class="sidebar">';
  $output .= ob_get_clean();
  $output .= '</aside>';


  return $output;

}



/* Banner Ads */
if( !function_exists( 'videostories_banner_ads_vc_widget') ){
  function videostories_banner_ads_vc_widget(){
    add_shortcode('banner_ad', 'videostories_facebook_vc_widget_shortcode');

    if( !function_exists('vc_map') )
      return;
    $args = array(
      'name'        =>  esc_html__('Banner Ads','videostories'),
      'base'        =>  'banner_ad',
      'category'    =>  esc_html__('WordPress Widgets','videostories'),
      "icon"        => 'videstories-vc-block',
      'description' =>  esc_html__('Display Banner Ads Widget','videostories'),
      'params'      =>  array(   
        array(
          'type'        =>  'attach_image',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Select an Image','videostories'),
          'param_name'  =>  'banner_image',
          'description'  => esc_html__( 'Banner Ads Image', 'videostories' ),
          'value'       => ''
          ),
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Link','videostories'),
          'param_name'  =>  'link',
          'value'       => '#'
          ),               
        array(
          'type'        =>  'dropdown',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Link Target','videostories'),
          'param_name'  =>  'linktarget',          
          'value'       => array( 
                              esc_html__( 'Stay in Window', 'videstories')     => '_self', 
                              esc_html__( 'Open New Window', 'videstories')     => '_blank' 
                          ) 
          ),
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Height','videostories'),
          'param_name'  =>  'height',
          'value'       => ''
          ),
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Width','videostories'),
          'param_name'  =>  'width',
          'value'       => ''
          ),        

        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('ALT Text','videostories'),
          'param_name'  =>  'alt',
          'value'       => ''
          ),


        )
      );

    vc_map( $args ); 
  }
  add_action( 'init' , 'videostories_banner_ads_vc_widget');
}


function videostories_facebook_vc_widget_shortcode( $atts, $content = null ){

  $output = $description = $banner_image = $link = $linktarget = $height = $width = $maxwidth = $maxheight = $align = $alt = $rel = $el_class = '';

  extract( shortcode_atts( array(      
      'title'         => '',
      'description'   => '',
      'banner_image'  => get_template_directory_uri().'/images/banner.png',
      'link'          => '#',
      'linktarget'    => '',
      'width'         => '',
      'height'        => '',
      'alt'           => 'Banner ALT',
    ), $atts ) );



  ob_start();
 
  $banner_image = wp_get_attachment_image_src( $banner_image, 'full' );
?>
  <div class="widget widget_banner_ad">
    <div class="widget-details">
      <a href="<?php echo esc_url_raw( $link );?>" target="<?php echo esc_attr( $linktarget );?>">
        <img height="<?php echo esc_attr( $height );?>" width="<?php echo esc_attr( $width );?>" src="<?php echo $banner_image[0];?>" alt="<?php echo esc_attr( $alt );?>">
      </a> 
    </div><!-- /.widget-details -->
  </div><!-- /.widget -->

<?php
  $output .= '<aside class="sidebar">';
  $output .= ob_get_clean();
  $output .= '</aside>';


  return $output;

}








/* Submit Video */
if( !function_exists( 'videostories_submit_video_vc_widget') ){
  function videostories_submit_video_vc_widget(){
    add_shortcode('submit_video', 'videostories_submit_video_vc_widget_shortcode');

    if( !function_exists('vc_map') )
      return;
    $args = array(
      'name'        =>  esc_html__('Submit Video','videostories'),
      'base'        =>  'submit_video',
      'category'    =>  esc_html__('WordPress Widgets','videostories'),
      "icon"        => 'videstories-vc-block',
      'description' =>  esc_html__('Display Submit Video Widget','videostories'),
      'params'      =>  array(   
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Title','videostories'),
          'param_name'  =>  'title',
          'description'  => esc_html__( 'Submit Video Title', 'videostories' ),
          'value'       => 'Submit Video'
          ),
        array(
          'type'        =>  'textarea',
          'holder'      =>  'p',
          'heading'     =>  esc_html__('Description','videostories'),
          'param_name'  =>  'desc',
          'value'       => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat. '
          ),               
        array(
          'type'        =>  'textfield',
          'holder'      =>  'div',
          'heading'     =>  esc_html__('Upload Link','videostories'),
          'param_name'  =>  'upload_link',
          'value'       => '#'
          ),

        )
      );

    vc_map( $args ); 
  }
  add_action( 'init' , 'videostories_submit_video_vc_widget');
}


function videostories_submit_video_vc_widget_shortcode( $atts, $content = null ){

  $output = $desc = $title = $upload_link = $el_class = '';

  extract( shortcode_atts( array(      
      'title'         => 'Submit Video',
      'desc'          => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat.',
      'upload_link'   => '#',
    ), $atts ) );

  ob_start();
?>


  <div class="widget widget_submit_video">
    <h3 class="widget-title"><?php echo esc_attr( $title );?></h3><!-- /.widget-title -->
    <div class="widget-details">
      <p><?php echo esc_attr( $desc );?></p>
      <div class="file-upload"><a href="<?php echo esc_url_raw( $upload_link );?>" class="btn upload-btn"><?php echo esc_html__("Upload your video", "videostories");?></a></div>
    </div><!-- /.widget-details -->
  </div><!-- /.widget -->


<?php
  $output .= '<aside class="sidebar">';
  $output .= ob_get_clean();
  $output .= '</aside>';


  return $output;

}

