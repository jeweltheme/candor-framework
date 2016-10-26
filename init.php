<?php

/**
 * Grab our Candor framework options as registered by the theme.
 * If candor_framework_options isn't set then we'll pull a list of defaults.
 * By default everything is turned off.
 */


$defaults = array(
	'candor_shortcodes'      => '0',
	'candor_widgets'         => '0',
	'portfolio_post_type'    => '0',
	'pricing_post_type'    	 => '0',
	'team_post_type'         => '0',
	'client_post_type'       => '0',
	'causes_post_type'       => '0',
	'events_post_type'       => '0',
	'service_post_type'      => '0',
	'testimonial_post_type'  => '0',
	'faq_post_type'          => '0',
	'menu_post_type'         => '0',
	'mega_menu'              => '0',
	'aq_resizer'             => '0',
	'likes'                  => '0',
	'options'                => '0',
	'candor_cache'           => '0',

	'sections_post_type'  	 => '0',
	'paypal_donation'  	 	 => '0',
	'easy_res_shortcodes' 	 => '0',

	//Metaboxes
	'cmbmetaboxes'           => '0',
	'rwmbmetabox'            => '0',

	//Angels
	'angels_shortcodes'      => '0',
	
	//Foody
	'foody_define'		     => '0',
	'foody_shortcodes'       => '0',

	//Elevation
	'elevation_widgets'      => '0',
	'elevation_vc_blocks'    => '0',
	'elevation_shortcodes'   => '0',

	//Shopaholic
	'shopaholic_widgets'      => '0',
	'shopaholic_vc_blocks'    => '0',
	'shopaholic_shortcodes'   => '0',

	//Polmo PRO
	'polmo_pro_widgets'    	 => '0',
	'polmo_pro_vc_blocks'    => '0',


);
$candor_options = wp_parse_args( get_option('candor_framework_options'), $defaults);


//Angels Shortcodes
if( '1' == $candor_options['angels_shortcodes'] ){
	// MCE Buttons
	require_once( CANDOR_FRAMEWORK_PATH  . '/lib/shortcodes/tinymce.button.php');

	// CSS Container Color Class
	require_once( CANDOR_FRAMEWORK_PATH  . '/lib/shortcodes/css-color-classes.php');

	// Font Awesome Icons
	require_once( CANDOR_FRAMEWORK_PATH  . '/lib/shortcodes/fontawesome-icons.php');

	// Shortcodes
	require_once( CANDOR_FRAMEWORK_PATH  . '/themes/angels-shortcode.php');


	/* ---------------------------------------------------------
	Custom Metaboxes - https://github.com/WebDevStudios/CMB2
	----------------------------------------------------------- */

	// Check for PHP version and use the correct one
	$candordir = ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) ? __DIR__ : dirname( __FILE__ );

	if ( file_exists(  $candordir . '/CMB2/metabox.php' ) ) {
		//require_once  $candordir . '/CMB2/init.php';
		require_once  $candordir . '/CMB2/metabox.php';
	} 
	elseif ( file_exists(  $candordir . '/CMB2/init.php' ) ) {
		require_once  $candordir . '/CMB2/init.php';
	}


	/* Include Plugins */
	if ( file_exists(  $candordir . '/lib/cmb-field-map.php' ) ) {
	    include_once( $candordir . '/lib/cmb-field-map.php');
	}
	if ( file_exists(  $candordir . '/lib/font-awesome-field.php' ) ) {
	    include_once( $candordir . '/lib/font-awesome-field.php');
	}

	// Icons
	if ( file_exists(  $candordir . '/lib/icons.php' ) ) {
	    include_once($candordir . '/lib/icons.php');
	}

}


//Foody Shortcodes
if( '1' == $candor_options['foody_shortcodes'] ){
	// MCE Buttons
	require_once( CANDOR_FRAMEWORK_PATH  . '/lib/shortcodes/tinymce.button.php');

	// CSS Container Color Class
	require_once( CANDOR_FRAMEWORK_PATH  . '/lib/shortcodes/css-color-classes.php');

	// Font Awesome Icons
	require_once( CANDOR_FRAMEWORK_PATH  . '/lib/shortcodes/fontawesome-icons.php');

	// Shortcodes
	require_once( CANDOR_FRAMEWORK_PATH  . '/themes/foody-shortcode.php');

	//Twitter API Exchange
	require_once( CANDOR_FRAMEWORK_PATH  . '/lib/TwitterAPIExchange.php');

}



/**
* Candor Class
*/
require_once( CANDOR_FRAMEWORK_PATH . 'classes/class.candor.php' );	


/**
 * Register appropriate Elevation Widgets
 */

if( '1' == $candor_options['elevation_widgets'] ){
	require_once( CANDOR_FRAMEWORK_PATH . 'widgets/elevation-widgets.php' );	
}

/**
 * Register appropriate Elevation Shortcodes
 */
if( '1' == $candor_options['elevation_shortcodes'] ){
	require_once( CANDOR_FRAMEWORK_PATH . 'themes/elevation-shortcodes.php' );	
}




/**
 * Shopaholic Theme Required Files
 */

if( '1' == $candor_options['shopaholic_widgets'] ){
	require_once( CANDOR_FRAMEWORK_PATH . 'widgets/elevation-widgets.php' );	
}

/**
 * Register appropriate Elevation Shortcodes
 */
if( '1' == $candor_options['shopaholic_shortcodes'] ){
	require_once( CANDOR_FRAMEWORK_PATH . 'themes/shopaholic-shortcodes.php' );	
}




/**
 * Register appropriate Polmo Pro Widgets
 */

if( '1' == $candor_options['polmo_pro_widgets'] ){
	require_once( CANDOR_FRAMEWORK_PATH . 'widgets/polmo-pro-widgets.php' );	
}



/**
 * Turn on the image resizer.
 * The resizer file has a class exists check to avoid conflicts
 */
if( '1' == $candor_options['aq_resizer'] ){
	require_once( CANDOR_FRAMEWORK_PATH . 'aq_resizer.php' );		
}


/**
* CMB Metabox
 * Grab our custom metaboxes class
 */
if( '1' == $candor_options['cmbmetaboxes'] ){
	// require_once( CANDOR_FRAMEWORK_PATH . 'metaboxes/init.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'metaboxes/metabox.php' );
	 require_once( CANDOR_FRAMEWORK_PATH . 'cmb/metaboxes.php' );


}


/*
* RWMB Metabox
* @author http://www.deluxeblogtips.com/meta-box
*/
if( '1' == $candor_options['rwmbmetabox'] ){
	require_once( CANDOR_FRAMEWORK_PATH . 'meta-box/meta-box.php' );
}


/**
 * We use LESS CSS in our Themes, don't worry, this is all parsed and cached the first time you load your page,
 * or when you change the theme options, this is not re-compiled on every page load.
 * Variables are passed to the LESS files from the enqueue section of theme_functions
 * If you need to you can edit the LESS files manually, though you'd be best doing this from a child theme.
 */
if( '1' == $candor_options['candor_cache'] ){
	require_once( CANDOR_FRAMEWORK_PATH . 'lib/lessc.inc.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'lib/wp-less.php' );

}


/*
* Paypal Donation
*/
if( '1' == $candor_options['paypal_donation'] ){
	require_once( CANDOR_FRAMEWORK_PATH . 'lib/paypal.php' );
}


/**
 * Grab candor likes, make sure Candor likes isn't installed though
 */
if(!( class_exists( 'candorLikes' ) || class_exists( 'CandorLikes' ) ) && '1' == $candor_options['likes'] ){
	require_once( CANDOR_FRAMEWORK_PATH . 'candor-likes/likes.php' );
}


/**
 * Grab simple options class
 */

if( '1' == $candor_options['options'] ){
	require_once( CANDOR_FRAMEWORK_PATH . 'candor_options.php' );
}


/**
 * Register Portfolio Post Type
 */
if( '1' == $candor_options['portfolio_post_type'] ){
	add_action( 'init', 'candor_framework_register_portfolio', 10 );
	add_action( 'init', 'candor_framework_create_portfolio_taxonomies', 10  );
}

/**
 * Register Team Post Type
 */
if( '1' == $candor_options['team_post_type'] ){
	add_action( 'init', 'candor_framework_register_team', 10  );
	add_action( 'init', 'candor_framework_create_team_taxonomies', 10  );
}

/**
 * Register Team Post Type
 */
if( '1' == $candor_options['pricing_post_type'] ){
	add_action( 'init', 'candor_framework_register_pricing', 10  );
	add_action( 'init', 'candor_framework_create_pricing_taxonomies', 10  );
}

/**
 * Register Client Post Type
 */
if( '1' == $candor_options['client_post_type'] ){
	add_action( 'init', 'candor_framework_register_client', 10  );
	add_action( 'init', 'candor_framework_create_client_taxonomies', 10  );
}

/**
 * Register Causes Post Type
 */
if( '1' == $candor_options['causes_post_type'] ){
	add_action( 'init', 'candor_framework_register_causes', 10  );
	add_action( 'init', 'candor_framework_create_causes_taxonomies', 10  );
}

/**
 * Register Events Post Type
 */
if( '1' == $candor_options['events_post_type'] ){
	add_action( 'init', 'candor_framework_register_events', 10  );
	add_action( 'init', 'candor_framework_create_events_taxonomies', 10  );
}

/**
 * Register Service Post Type
 */
if( '1' == $candor_options['service_post_type'] ){
	add_action( 'init', 'candor_framework_register_services', 10  );
}

/**
 * Register Testimonial Post Type
 */
if( '1' == $candor_options['testimonial_post_type'] ){
	add_action( 'init', 'candor_framework_register_testimonial', 10  );
	add_action( 'init', 'candor_framework_create_testimonial_taxonomies', 10  );
}

/**
 * Register faq Post Type
 */
if( '1' == $candor_options['faq_post_type'] ){
	add_action( 'init', 'candor_framework_register_faq', 10  );
	add_action( 'init', 'candor_framework_create_faq_taxonomies', 10  );
}

/**
 * Register Menu Post Type
 */
if( '1' == $candor_options['menu_post_type'] ){
	add_action( 'init', 'candor_framework_register_menu', 10  );
	add_action( 'init', 'candor_framework_create_menu_taxonomies', 10  );
}

/**
 * Register Mega Menu Post Type
 */
if( '1' == $candor_options['mega_menu'] ){
	add_action( 'init', 'candor_framework_register_mega_menu', 10  );
}


/**
 * Register Sections Post Type
 */
if( '1' == $candor_options['sections_post_type'] ){
	add_action( 'init', 'candor_framework_register_sections', 10  );
}






/*===================================================================================
 * Post Meta Show/Hide 
 * =================================================================================*/
function candor_post_format_meta_script($hook) {
 
	if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' ) 
		return;
 
	wp_enqueue_script( 'custom-js', plugins_url( 'candor-framework/js/candor-post-meta.js' , dirname(__FILE__) ) );
}
add_action('admin_enqueue_scripts', 'candor_post_format_meta_script');




if(!( function_exists('candor_get_blog_layouts') )){
	function candor_get_blog_layouts(){
		return array(
			esc_html__( 'Strip Blog', 'candor' ) 				=> 'strip',
			esc_html__( 'Masonry Blog', 'candor' ) 				=> 'masonry',
			esc_html__( 'Masonry Blog (No Sidebar)', 'candor' ) => 'masonry-no-sidebar'
		);	
	}
}


if(!( function_exists('candor_get_site_layouts') )){
	function candor_get_site_layouts(){
		return array(
			esc_html__( 'Boxed Layout', 'candor' ) 				=> 'boxed',
			esc_html__( 'Full Width Layout', 'candor' ) 		=> 'full-width',
		);	
	}
}


/*===================================================================================
 * Custom Posts Query with Sorting Order
 * =================================================================================*/
function candor_get_custom_posts($type, $limit = 20, $order = "DESC"){
    wp_reset_postdata();
    $args = array(
        "posts_per_page" 	=> $limit,
        "post_type" 		=> $type,
        'orderby' 			=> 'menu_order',
        "order" 			=> $order,
    );
    $custom_posts = get_posts($args);
    return $custom_posts;
}


// Get Post Meta
function candor_framework_meta($meta){
    $meta = get_post_meta(get_the_ID(), $meta, true);
    return $meta;
}



/* Plugin Activation Notice Allignment */
add_action('admin_head', 'candor_framework_custom_admin_notice_css');
function candor_framework_custom_admin_notice_css() {
  echo '<style>
    .themes-php div.notice {
    	float: left;
    } 
  </style>';
}


/*===================================================================================
 * WP TITLE
 * =================================================================================*/
if ( ! function_exists( 'candor_render_wp_title' ) ) {
	function candor_render_wp_title() {?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
    add_action( 'wp_head', 'candor_render_wp_title' );
}


if(!( function_exists('candor_get_ti_icons') )){
	function candor_get_ti_icons(){
		$icons = array("none",'ti-wand', 'ti-volume', 'ti-user', 'ti-unlock', 'ti-unlink', 'ti-trash', 'ti-thought', 'ti-target', 'ti-tag', 'ti-tablet', 'ti-star', 'ti-spray', 'ti-signal', 'ti-shopping-cart', 'ti-shopping-cart-full', 'ti-settings', 'ti-search', 'ti-zoom-in', 'ti-zoom-out', 'ti-cut', 'ti-ruler', 'ti-ruler-pencil', 'ti-ruler-alt', 'ti-bookmark', 'ti-bookmark-alt', 'ti-reload', 'ti-plus', 'ti-pin', 'ti-pencil', 'ti-pencil-alt', 'ti-paint-roller', 'ti-paint-bucket', 'ti-na', 'ti-mobile', 'ti-minus', 'ti-medall', 'ti-medall-alt', 'ti-marker', 'ti-marker-alt', 'ti-arrow-up', 'ti-arrow-right', 'ti-arrow-left', 'ti-arrow-down', 'ti-lock', 'ti-location-arrow', 'ti-link', 'ti-layout', 'ti-layers', 'ti-layers-alt', 'ti-key', 'ti-import', 'ti-image', 'ti-heart', 'ti-heart-broken', 'ti-hand-stop', 'ti-hand-open', 'ti-hand-drag', 'ti-folder', 'ti-flag', 'ti-flag-alt', 'ti-flag-alt-2', 'ti-eye', 'ti-export', 'ti-exchange-vertical', 'ti-desktop', 'ti-cup', 'ti-crown', 'ti-comments', 'ti-comment', 'ti-comment-alt', 'ti-close', 'ti-clip', 'ti-angle-up', 'ti-angle-right', 'ti-angle-left', 'ti-angle-down', 'ti-check', 'ti-check-box', 'ti-camera', 'ti-announcement', 'ti-brush', 'ti-briefcase', 'ti-bolt', 'ti-bolt-alt', 'ti-blackboard', 'ti-bag', 'ti-move', 'ti-arrows-vertical', 'ti-arrows-horizontal', 'ti-fullscreen', 'ti-arrow-top-right', 'ti-arrow-top-left', 'ti-arrow-circle-up', 'ti-arrow-circle-right', 'ti-arrow-circle-left', 'ti-arrow-circle-down', 'ti-angle-double-up', 'ti-angle-double-right', 'ti-angle-double-left', 'ti-angle-double-down', 'ti-zip', 'ti-world', 'ti-wheelchair', 'ti-view-list', 'ti-view-list-alt', 'ti-view-grid', 'ti-uppercase', 'ti-upload', 'ti-underline', 'ti-truck', 'ti-timer', 'ti-ticket', 'ti-thumb-up', 'ti-thumb-down', 'ti-text', 'ti-stats-up', 'ti-stats-down', 'ti-split-v', 'ti-split-h', 'ti-smallcap', 'ti-shine', 'ti-shift-right', 'ti-shift-left', 'ti-shield', 'ti-notepad', 'ti-server', 'ti-quote-right', 'ti-quote-left', 'ti-pulse', 'ti-printer', 'ti-power-off', 'ti-plug', 'ti-pie-chart', 'ti-paragraph', 'ti-panel', 'ti-package', 'ti-music', 'ti-music-alt', 'ti-mouse', 'ti-mouse-alt', 'ti-money', 'ti-microphone', 'ti-menu', 'ti-menu-alt', 'ti-map', 'ti-map-alt', 'ti-loop', 'ti-location-pin', 'ti-list', 'ti-light-bulb', 'ti-Italic', 'ti-info', 'ti-infinite', 'ti-id-badge', 'ti-hummer', 'ti-home', 'ti-help', 'ti-headphone', 'ti-harddrives', 'ti-harddrive', 'ti-gift', 'ti-game', 'ti-filter', 'ti-files', 'ti-file', 'ti-eraser', 'ti-envelope', 'ti-download', 'ti-direction', 'ti-direction-alt', 'ti-dashboard', 'ti-control-stop', 'ti-control-shuffle', 'ti-control-play', 'ti-control-pause', 'ti-control-forward', 'ti-control-backward', 'ti-cloud', 'ti-cloud-up', 'ti-cloud-down', 'ti-clipboard', 'ti-car', 'ti-calendar', 'ti-book', 'ti-bell', 'ti-basketball', 'ti-bar-chart', 'ti-bar-chart-alt', 'ti-back-right', 'ti-back-left', 'ti-arrows-corner', 'ti-archive', 'ti-anchor', 'ti-align-right', 'ti-align-left', 'ti-align-justify', 'ti-align-center', 'ti-alert', 'ti-alarm-clock', 'ti-agenda', 'ti-write', 'ti-window', 'ti-widgetized', 'ti-widget', 'ti-widget-alt', 'ti-wallet', 'ti-video-clapper', 'ti-video-camera', 'ti-vector', 'ti-themify-logo', 'ti-themify-favicon', 'ti-themify-favicon-alt', 'ti-support', 'ti-stamp', 'ti-split-v-alt', 'ti-slice', 'ti-shortcode', 'ti-shift-right-alt', 'ti-shift-left-alt', 'ti-ruler-alt-2', 'ti-receipt', 'ti-pin2', 'ti-pin-alt', 'ti-pencil-alt2', 'ti-palette', 'ti-more', 'ti-more-alt', 'ti-microphone-alt', 'ti-magnet', 'ti-line-double', 'ti-line-dotted', 'ti-line-dashed', 'ti-layout-width-full', 'ti-layout-width-default', 'ti-layout-width-default-alt', 'ti-layout-tab', 'ti-layout-tab-window', 'ti-layout-tab-v', 'ti-layout-tab-min', 'ti-layout-slider', 'ti-layout-slider-alt', 'ti-layout-sidebar-right', 'ti-layout-sidebar-none', 'ti-layout-sidebar-left', 'ti-layout-placeholder', 'ti-layout-menu', 'ti-layout-menu-v', 'ti-layout-menu-separated', 'ti-layout-menu-full', 'ti-layout-media-right-alt', 'ti-layout-media-right', 'ti-layout-media-overlay', 'ti-layout-media-overlay-alt', 'ti-layout-media-overlay-alt-2', 'ti-layout-media-left-alt', 'ti-layout-media-left', 'ti-layout-media-center-alt', 'ti-layout-media-center', 'ti-layout-list-thumb', 'ti-layout-list-thumb-alt', 'ti-layout-list-post', 'ti-layout-list-large-image', 'ti-layout-line-solid', 'ti-layout-grid4', 'ti-layout-grid3', 'ti-layout-grid2', 'ti-layout-grid2-thumb', 'ti-layout-cta-right', 'ti-layout-cta-left', 'ti-layout-cta-center', 'ti-layout-cta-btn-right', 'ti-layout-cta-btn-left', 'ti-layout-column4', 'ti-layout-column3', 'ti-layout-column2', 'ti-layout-accordion-separated', 'ti-layout-accordion-merged', 'ti-layout-accordion-list', 'ti-ink-pen', 'ti-info-alt', 'ti-help-alt', 'ti-headphone-alt', 'ti-hand-point-up', 'ti-hand-point-right', 'ti-hand-point-left', 'ti-hand-point-down', 'ti-gallery', 'ti-face-smile', 'ti-face-sad', 'ti-credit-card', 'ti-control-skip-forward', 'ti-control-skip-backward', 'ti-control-record', 'ti-control-eject', 'ti-comments-smiley', 'ti-brush-alt', 'ti-youtube', 'ti-vimeo', 'ti-twitter', 'ti-time', 'ti-tumblr', 'ti-skype', 'ti-share', 'ti-share-alt', 'ti-rocket', 'ti-pinterest', 'ti-new-window', 'ti-microsoft', 'ti-list-ol', 'ti-linkedin', 'ti-layout-sidebar-2', 'ti-layout-grid4-alt', 'ti-layout-grid3-alt', 'ti-layout-grid2-alt', 'ti-layout-column4-alt', 'ti-layout-column3-alt', 'ti-layout-column2-alt', 'ti-instagram', 'ti-google', 'ti-github', 'ti-flickr', 'ti-facebook', 'ti-dropbox', 'ti-dribbble', 'ti-apple', 'ti-android', 'ti-save', 'ti-save-alt', 'ti-yahoo', 'ti-wordpress', 'ti-vimeo-alt', 'ti-twitter-alt', 'ti-tumblr-alt', 'ti-trello', 'ti-stack-overflow', 'ti-soundcloud', 'ti-sharethis', 'ti-sharethis-alt', 'ti-reddit', 'ti-pinterest-alt', 'ti-microsoft-alt', 'ti-linux', 'ti-jsfiddle', 'ti-joomla', 'ti-html5', 'ti-flickr-alt', 'ti-email', 'ti-drupal', 'ti-dropbox-alt', 'ti-css3', 'ti-rss', 'ti-rss-alt', 'pe-7s-album', 'pe-7s-arc', 'pe-7s-back-2', 'pe-7s-bandaid', 'pe-7s-car', 'pe-7s-diamond', 'pe-7s-door-lock', 'pe-7s-eyedropper', 'pe-7s-female', 'pe-7s-gym', 'pe-7s-hammer', 'pe-7s-headphones', 'pe-7s-helm', 'pe-7s-hourglass', 'pe-7s-leaf', 'pe-7s-magic-wand', 'pe-7s-male', 'pe-7s-map-2', 'pe-7s-next-2', 'pe-7s-paint-bucket', 'pe-7s-pendrive', 'pe-7s-photo', 'pe-7s-piggy', 'pe-7s-plugin', 'pe-7s-refresh-2', 'pe-7s-rocket', 'pe-7s-settings', 'pe-7s-shield', 'pe-7s-smile', 'pe-7s-usb', 'pe-7s-vector', 'pe-7s-wine', 'pe-7s-cloud-upload', 'pe-7s-cash', 'pe-7s-close', 'pe-7s-bluetooth', 'pe-7s-cloud-download', 'pe-7s-way', 'pe-7s-close-circle', 'pe-7s-id', 'pe-7s-angle-up', 'pe-7s-wristwatch', 'pe-7s-angle-up-circle', 'pe-7s-world', 'pe-7s-angle-right', 'pe-7s-volume', 'pe-7s-angle-right-circle', 'pe-7s-users', 'pe-7s-angle-left', 'pe-7s-user-female', 'pe-7s-angle-left-circle', 'pe-7s-up-arrow', 'pe-7s-angle-down', 'pe-7s-switch', 'pe-7s-angle-down-circle', 'pe-7s-scissors', 'pe-7s-wallet', 'pe-7s-safe', 'pe-7s-volume2', 'pe-7s-volume1', 'pe-7s-voicemail', 'pe-7s-video', 'pe-7s-user', 'pe-7s-upload', 'pe-7s-unlock', 'pe-7s-umbrella', 'pe-7s-trash', 'pe-7s-tools', 'pe-7s-timer', 'pe-7s-ticket', 'pe-7s-target', 'pe-7s-sun', 'pe-7s-study', 'pe-7s-stopwatch', 'pe-7s-star', 'pe-7s-speaker', 'pe-7s-signal', 'pe-7s-shuffle', 'pe-7s-shopbag', 'pe-7s-share', 'pe-7s-server', 'pe-7s-search', 'pe-7s-film', 'pe-7s-science', 'pe-7s-disk', 'pe-7s-ribbon', 'pe-7s-repeat', 'pe-7s-refresh', 'pe-7s-add-user', 'pe-7s-refresh-cloud', 'pe-7s-paperclip', 'pe-7s-radio', 'pe-7s-note2', 'pe-7s-print', 'pe-7s-network', 'pe-7s-prev', 'pe-7s-mute', 'pe-7s-power', 'pe-7s-medal', 'pe-7s-portfolio', 'pe-7s-like2', 'pe-7s-plus', 'pe-7s-left-arrow', 'pe-7s-play', 'pe-7s-key', 'pe-7s-plane', 'pe-7s-joy', 'pe-7s-photo-gallery', 'pe-7s-pin', 'pe-7s-phone', 'pe-7s-plug', 'pe-7s-pen', 'pe-7s-right-arrow', 'pe-7s-paper-plane', 'pe-7s-delete-user', 'pe-7s-paint', 'pe-7s-bottom-arrow', 'pe-7s-notebook', 'pe-7s-note', 'pe-7s-next', 'pe-7s-news-paper', 'pe-7s-musiclist', 'pe-7s-music', 'pe-7s-mouse', 'pe-7s-more', 'pe-7s-moon', 'pe-7s-monitor', 'pe-7s-micro', 'pe-7s-menu', 'pe-7s-map', 'pe-7s-map-marker', 'pe-7s-mail', 'pe-7s-mail-open', 'pe-7s-mail-open-file', 'pe-7s-magnet', 'pe-7s-loop', 'pe-7s-look', 'pe-7s-lock', 'pe-7s-lintern', 'pe-7s-link', 'pe-7s-like', 'pe-7s-light', 'pe-7s-less', 'pe-7s-keypad', 'pe-7s-junk', 'pe-7s-info', 'pe-7s-home', 'pe-7s-help2', 'pe-7s-help1', 'pe-7s-graph3', 'pe-7s-graph2', 'pe-7s-graph1', 'pe-7s-graph', 'pe-7s-global', 'pe-7s-gleam', 'pe-7s-glasses', 'pe-7s-gift', 'pe-7s-folder', 'pe-7s-flag', 'pe-7s-filter', 'pe-7s-file', 'pe-7s-expand1', 'pe-7s-exapnd2', 'pe-7s-edit', 'pe-7s-drop', 'pe-7s-drawer', 'pe-7s-download', 'pe-7s-display2', 'pe-7s-display1', 'pe-7s-diskette', 'pe-7s-date', 'pe-7s-cup', 'pe-7s-culture', 'pe-7s-crop', 'pe-7s-credit', 'pe-7s-copy-file', 'pe-7s-config', 'pe-7s-compass', 'pe-7s-comment', 'pe-7s-coffee', 'pe-7s-cloud', 'pe-7s-clock', 'pe-7s-check', 'pe-7s-chat', 'pe-7s-cart', 'pe-7s-camera', 'pe-7s-call', 'pe-7s-calculator', 'pe-7s-browser', 'pe-7s-box2', 'pe-7s-box1', 'pe-7s-bookmarks', 'pe-7s-bicycle', 'pe-7s-bell', 'pe-7s-battery', 'pe-7s-ball', 'pe-7s-back', 'pe-7s-attention', 'pe-7s-anchor', 'pe-7s-albums', 'pe-7s-alarm', 'pe-7s-airplay', 'icon-user-female', 'icon-user-follow', 'icon-user-following', 'icon-user-unfollow', 'icon-trophy', 'icon-screen-smartphone', 'icon-screen-desktop', 'icon-plane', 'icon-notebook', 'icon-moustache', 'icon-mouse', 'icon-magnet', 'icon-energy', 'icon-emoticon-smile', 'icon-disc', 'icon-cursor-move', 'icon-crop', 'icon-credit-card', 'icon-chemistry', 'icon-user', 'icon-speedometer', 'icon-social-youtube', 'icon-social-twitter', 'icon-social-tumblr', 'icon-social-facebook', 'icon-social-dropbox', 'icon-social-dribbble', 'icon-shield', 'icon-screen-tablet', 'icon-magic-wand', 'icon-hourglass', 'icon-graduation', 'icon-ghost', 'icon-game-controller', 'icon-fire', 'icon-eyeglasses', 'icon-envelope-open', 'icon-envelope-letter', 'icon-bell', 'icon-badge', 'icon-anchor', 'icon-wallet', 'icon-vector', 'icon-speech', 'icon-puzzle', 'icon-printer', 'icon-present', 'icon-playlist', 'icon-pin', 'icon-picture', 'icon-map', 'icon-layers', 'icon-handbag', 'icon-globe-alt', 'icon-globe', 'icon-frame', 'icon-folder-alt', 'icon-film', 'icon-feed', 'icon-earphones-alt', 'icon-earphones', 'icon-drop', 'icon-drawer', 'icon-docs', 'icon-directions', 'icon-direction', 'icon-diamond', 'icon-cup', 'icon-compass', 'icon-call-out', 'icon-call-in', 'icon-call-end', 'icon-calculator', 'icon-bubbles', 'icon-briefcase', 'icon-book-open', 'icon-basket-loaded', 'icon-basket', 'icon-bag', 'icon-action-undo', 'icon-action-redo', 'icon-wrench', 'icon-umbrella', 'icon-trash', 'icon-tag', 'icon-support', 'icon-size-fullscreen', 'icon-size-actual', 'icon-shuffle', 'icon-share-alt', 'icon-share', 'icon-rocket', 'icon-question', 'icon-pie-chart', 'icon-pencil', 'icon-note', 'icon-music-tone-alt', 'icon-music-tone', 'icon-microphone', 'icon-loop', 'icon-logout', 'icon-login', 'icon-list', 'icon-like', 'icon-home', 'icon-grid', 'icon-graph', 'icon-equalizer', 'icon-dislike', 'icon-cursor', 'icon-control-start', 'icon-control-rewind', 'icon-control-play', 'icon-control-pause', 'icon-control-forward', 'icon-control-end', 'icon-calendar', 'icon-bulb', 'icon-bar-chart', 'icon-arrow-up', 'icon-arrow-right', 'icon-arrow-left', 'icon-arrow-down', 'icon-ban', 'icon-bubble', 'icon-camcorder', 'icon-camera', 'icon-check', 'icon-clock', 'icon-close', 'icon-cloud-download', 'icon-cloud-upload', 'icon-doc', 'icon-envelope', 'icon-eye', 'icon-flag', 'icon-folder', 'icon-heart', 'icon-info', 'icon-key', 'icon-link', 'icon-lock', 'icon-lock-open', 'icon-magnifier', 'icon-magnifier-add', 'icon-magnifier-remove', 'icon-paper-clip', 'icon-paper-plane', 'icon-plus', 'icon-pointer', 'icon-power', 'icon-refresh', 'icon-reload', 'icon-settings', 'icon-star', 'icon-symbol-female', 'icon-symbol-male', 'icon-target', 'icon-volume-1', 'icon-volume-2', 'icon-volume-off', 'icon-users', 'fa fa-glass', 'fa fa-music', 'fa fa-search', 'fa fa-envelope-o', 'fa fa-heart', 'fa fa-star', 'fa fa-star-o', 'fa fa-user', 'fa fa-film', 'fa fa-th-large', 'fa fa-th', 'fa fa-th-list', 'fa fa-check', 'fa fa-times', 'fa fa-search-plus', 'fa fa-search-minus', 'fa fa-power-off', 'fa fa-signal', 'fa fa-gear', 'fa fa-cog', 'fa fa-trash-o', 'fa fa-home', 'fa fa-file-o', 'fa fa-clock-o', 'fa fa-road', 'fa fa-download', 'fa fa-arrow-circle-o-down', 'fa fa-arrow-circle-o-up', 'fa fa-inbox', 'fa fa-play-circle-o', 'fa fa-rotate-right', 'fa fa-repeat', 'fa fa-refresh', 'fa fa-list-alt', 'fa fa-lock', 'fa fa-flag', 'fa fa-headphones', 'fa fa-volume-off', 'fa fa-volume-down', 'fa fa-volume-up', 'fa fa-qrcode', 'fa fa-barcode', 'fa fa-tag', 'fa fa-tags', 'fa fa-book', 'fa fa-bookmark', 'fa fa-print', 'fa fa-camera', 'fa fa-font', 'fa fa-bold', 'fa fa-italic', 'fa fa-text-height', 'fa fa-text-width', 'fa fa-align-left', 'fa fa-align-center', 'fa fa-align-right', 'fa fa-align-justify', 'fa fa-list', 'fa fa-dedent', 'fa fa-outdent', 'fa fa-indent', 'fa fa-video-camera', 'fa fa-photo', 'fa fa-image', 'fa fa-picture-o', 'fa fa-pencil', 'fa fa-map-marker', 'fa fa-adjust', 'fa fa-tint', 'fa fa-edit', 'fa fa-pencil-square-o', 'fa fa-share-square-o', 'fa fa-check-square-o', 'fa fa-arrows', 'fa fa-step-backward', 'fa fa-fast-backward', 'fa fa-backward', 'fa fa-play', 'fa fa-pause', 'fa fa-stop', 'fa fa-forward', 'fa fa-fast-forward', 'fa fa-step-forward', 'fa fa-eject', 'fa fa-chevron-left', 'fa fa-chevron-right', 'fa fa-plus-circle', 'fa fa-minus-circle', 'fa fa-times-circle', 'fa fa-check-circle', 'fa fa-question-circle', 'fa fa-info-circle', 'fa fa-crosshairs', 'fa fa-times-circle-o', 'fa fa-check-circle-o', 'fa fa-ban', 'fa fa-arrow-left', 'fa fa-arrow-right', 'fa fa-arrow-up', 'fa fa-arrow-down', 'fa fa-mail-forward', 'fa fa-share', 'fa fa-expand', 'fa fa-compress', 'fa fa-plus', 'fa fa-minus', 'fa fa-asterisk', 'fa fa-exclamation-circle', 'fa fa-gift', 'fa fa-leaf', 'fa fa-fire', 'fa fa-eye', 'fa fa-eye-slash', 'fa fa-warning', 'fa fa-exclamation-triangle', 'fa fa-plane', 'fa fa-calendar', 'fa fa-random', 'fa fa-comment', 'fa fa-magnet', 'fa fa-chevron-up', 'fa fa-chevron-down', 'fa fa-retweet', 'fa fa-shopping-cart', 'fa fa-folder', 'fa fa-folder-open', 'fa fa-arrows-v', 'fa fa-arrows-h', 'fa fa-bar-chart-o', 'fa fa-twitter-square', 'fa fa-facebook-square', 'fa fa-camera-retro', 'fa fa-key', 'fa fa-gears', 'fa fa-cogs', 'fa fa-comments', 'fa fa-thumbs-o-up', 'fa fa-thumbs-o-down', 'fa fa-star-half', 'fa fa-heart-o', 'fa fa-sign-out', 'fa fa-linkedin-square', 'fa fa-thumb-tack', 'fa fa-external-link', 'fa fa-sign-in', 'fa fa-trophy', 'fa fa-github-square', 'fa fa-upload', 'fa fa-lemon-o', 'fa fa-phone', 'fa fa-square-o', 'fa fa-bookmark-o', 'fa fa-phone-square', 'fa fa-twitter', 'fa fa-facebook', 'fa fa-github', 'fa fa-unlock', 'fa fa-credit-card', 'fa fa-rss', 'fa fa-hdd-o', 'fa fa-bullhorn', 'fa fa-bell', 'fa fa-certificate', 'fa fa-hand-o-right', 'fa fa-hand-o-left', 'fa fa-hand-o-up', 'fa fa-hand-o-down', 'fa fa-arrow-circle-left', 'fa fa-arrow-circle-right', 'fa fa-arrow-circle-up', 'fa fa-arrow-circle-down', 'fa fa-globe', 'fa fa-wrench', 'fa fa-tasks', 'fa fa-filter', 'fa fa-briefcase', 'fa fa-arrows-alt', 'fa fa-group', 'fa fa-users', 'fa fa-chain', 'fa fa-link', 'fa fa-cloud', 'fa fa-flask', 'fa fa-cut', 'fa fa-scissors', 'fa fa-copy', 'fa fa-files-o', 'fa fa-paperclip', 'fa fa-save', 'fa fa-floppy-o', 'fa fa-square', 'fa fa-navicon', 'fa fa-reorder', 'fa fa-bars', 'fa fa-list-ul', 'fa fa-list-ol', 'fa fa-strikethrough', 'fa fa-underline', 'fa fa-table', 'fa fa-magic', 'fa fa-truck', 'fa fa-pinterest', 'fa fa-pinterest-square', 'fa fa-google-plus-square', 'fa fa-google-plus', 'fa fa-money', 'fa fa-caret-down', 'fa fa-caret-up', 'fa fa-caret-left', 'fa fa-caret-right', 'fa fa-columns', 'fa fa-unsorted', 'fa fa-sort', 'fa fa-sort-down', 'fa fa-sort-desc', 'fa fa-sort-up', 'fa fa-sort-asc', 'fa fa-envelope', 'fa fa-linkedin', 'fa fa-rotate-left', 'fa fa-undo', 'fa fa-legal', 'fa fa-gavel', 'fa fa-dashboard', 'fa fa-tachometer', 'fa fa-comment-o', 'fa fa-comments-o', 'fa fa-flash', 'fa fa-bolt', 'fa fa-sitemap', 'fa fa-umbrella', 'fa fa-paste', 'fa fa-clipboard', 'fa fa-lightbulb-o', 'fa fa-exchange', 'fa fa-cloud-download', 'fa fa-cloud-upload', 'fa fa-user-md', 'fa fa-stethoscope', 'fa fa-suitcase', 'fa fa-bell-o', 'fa fa-coffee', 'fa fa-cutlery', 'fa fa-file-text-o', 'fa fa-building-o', 'fa fa-hospital-o', 'fa fa-ambulance', 'fa fa-medkit', 'fa fa-fighter-jet', 'fa fa-beer', 'fa fa-h-square', 'fa fa-plus-square', 'fa fa-angle-double-left', 'fa fa-angle-double-right', 'fa fa-angle-double-up', 'fa fa-angle-double-down', 'fa fa-angle-left', 'fa fa-angle-right', 'fa fa-angle-up', 'fa fa-angle-down', 'fa fa-desktop', 'fa fa-laptop', 'fa fa-tablet', 'fa fa-mobile-phone', 'fa fa-mobile', 'fa fa-circle-o', 'fa fa-quote-left', 'fa fa-quote-right', 'fa fa-spinner', 'fa fa-circle', 'fa fa-mail-reply', 'fa fa-reply', 'fa fa-github-alt', 'fa fa-folder-o', 'fa fa-folder-open-o', 'fa fa-smile-o', 'fa fa-frown-o', 'fa fa-meh-o', 'fa fa-gamepad', 'fa fa-keyboard-o', 'fa fa-flag-o', 'fa fa-flag-checkered', 'fa fa-terminal', 'fa fa-code', 'fa fa-mail-reply-all', 'fa fa-reply-all', 'fa fa-star-half-empty', 'fa fa-star-half-full', 'fa fa-star-half-o', 'fa fa-location-arrow', 'fa fa-crop', 'fa fa-code-fork', 'fa fa-unlink', 'fa fa-chain-broken', 'fa fa-question', 'fa fa-info', 'fa fa-exclamation', 'fa fa-superscript', 'fa fa-subscript', 'fa fa-eraser', 'fa fa-puzzle-piece', 'fa fa-microphone', 'fa fa-microphone-slash', 'fa fa-shield', 'fa fa-calendar-o', 'fa fa-fire-extinguisher', 'fa fa-rocket', 'fa fa-maxcdn', 'fa fa-chevron-circle-left', 'fa fa-chevron-circle-right', 'fa fa-chevron-circle-up', 'fa fa-chevron-circle-down', 'fa fa-html5', 'fa fa-css3', 'fa fa-anchor', 'fa fa-unlock-alt', 'fa fa-bullseye', 'fa fa-ellipsis-h', 'fa fa-ellipsis-v', 'fa fa-rss-square', 'fa fa-play-circle', 'fa fa-ticket', 'fa fa-minus-square', 'fa fa-minus-square-o', 'fa fa-level-up', 'fa fa-level-down', 'fa fa-check-square', 'fa fa-pencil-square', 'fa fa-external-link-square', 'fa fa-share-square', 'fa fa-compass', 'fa fa-toggle-down', 'fa fa-caret-square-o-down', 'fa fa-toggle-up', 'fa fa-caret-square-o-up', 'fa fa-toggle-right', 'fa fa-caret-square-o-right', 'fa fa-euro', 'fa fa-eur', 'fa fa-gbp', 'fa fa-dollar', 'fa fa-usd', 'fa fa-rupee', 'fa fa-inr', 'fa fa-cny', 'fa fa-rmb', 'fa fa-yen', 'fa fa-jpy', 'fa fa-ruble', 'fa fa-rouble', 'fa fa-rub', 'fa fa-won', 'fa fa-krw', 'fa fa-bitcoin', 'fa fa-btc', 'fa fa-file', 'fa fa-file-text', 'fa fa-sort-alpha-asc', 'fa fa-sort-alpha-desc', 'fa fa-sort-amount-asc', 'fa fa-sort-amount-desc', 'fa fa-sort-numeric-asc', 'fa fa-sort-numeric-desc', 'fa fa-thumbs-up', 'fa fa-thumbs-down', 'fa fa-youtube-square', 'fa fa-youtube', 'fa fa-xing', 'fa fa-xing-square', 'fa fa-youtube-play', 'fa fa-dropbox', 'fa fa-stack-overflow', 'fa fa-instagram', 'fa fa-flickr', 'fa fa-adn', 'fa fa-bitbucket', 'fa fa-bitbucket-square', 'fa fa-tumblr', 'fa fa-tumblr-square', 'fa fa-long-arrow-down', 'fa fa-long-arrow-up', 'fa fa-long-arrow-left', 'fa fa-long-arrow-right', 'fa fa-apple', 'fa fa-windows', 'fa fa-android', 'fa fa-linux', 'fa fa-dribbble', 'fa fa-skype', 'fa fa-foursquare', 'fa fa-trello', 'fa fa-female', 'fa fa-male', 'fa fa-gittip', 'fa fa-sun-o', 'fa fa-moon-o', 'fa fa-archive', 'fa fa-bug', 'fa fa-vk', 'fa fa-weibo', 'fa fa-renren', 'fa fa-pagelines', 'fa fa-stack-exchange', 'fa fa-arrow-circle-o-right', 'fa fa-arrow-circle-o-left', 'fa fa-toggle-left', 'fa fa-caret-square-o-left', 'fa fa-dot-circle-o', 'fa fa-wheelchair', 'fa fa-vimeo-square', 'fa fa-turkish-lira', 'fa fa-try', 'fa fa-plus-square-o', 'fa fa-space-shuttle', 'fa fa-slack', 'fa fa-envelope-square', 'fa fa-wordpress', 'fa fa-openid', 'fa fa-institution', 'fa fa-bank', 'fa fa-university', 'fa fa-mortar-board', 'fa fa-graduation-cap', 'fa fa-yahoo', 'fa fa-google', 'fa fa-reddit', 'fa fa-reddit-square', 'fa fa-stumbleupon-circle', 'fa fa-stumbleupon', 'fa fa-delicious', 'fa fa-digg', 'fa fa-pied-piper-square', 'fa fa-pied-piper', 'fa fa-pied-piper-alt', 'fa fa-drupal', 'fa fa-joomla', 'fa fa-language', 'fa fa-fax', 'fa fa-building', 'fa fa-child', 'fa fa-paw', 'fa fa-spoon', 'fa fa-cube', 'fa fa-cubes', 'fa fa-behance', 'fa fa-behance-square', 'fa fa-steam', 'fa fa-steam-square', 'fa fa-recycle', 'fa fa-automobile', 'fa fa-car', 'fa fa-cab', 'fa fa-taxi', 'fa fa-tree', 'fa fa-spotify', 'fa fa-deviantart', 'fa fa-soundcloud', 'fa fa-database', 'fa fa-file-pdf-o', 'fa fa-file-word-o', 'fa fa-file-excel-o', 'fa fa-file-powerpoint-o', 'fa fa-file-photo-o', 'fa fa-file-picture-o', 'fa fa-file-image-o', 'fa fa-file-zip-o', 'fa fa-file-archive-o', 'fa fa-file-sound-o', 'fa fa-file-audio-o', 'fa fa-file-movie-o', 'fa fa-file-video-o', 'fa fa-file-code-o', 'fa fa-vine', 'fa fa-codepen', 'fa fa-jsfiddle', 'fa fa-life-bouy', 'fa fa-life-saver', 'fa fa-support', 'fa fa-life-ring', 'fa fa-circle-o-notch', 'fa fa-ra', 'fa fa-rebel', 'fa fa-ge', 'fa fa-empire', 'fa fa-git-square', 'fa fa-git', 'fa fa-hacker-news', 'fa fa-tencent-weibo', 'fa fa-qq', 'fa fa-wechat', 'fa fa-weixin', 'fa fa-send', 'fa fa-paper-plane', 'fa fa-send-o', 'fa fa-paper-plane-o', 'fa fa-history', 'fa fa-circle-thin', 'fa fa-header', 'fa fa-paragraph', 'fa fa-sliders', 'fa fa-share-alt', 'fa fa-share-alt-square', 'fa fa-bomb', );
		return $icons;	
	}
}
/*===================================================================================
 * custom tag cloud
 * =================================================================================*/
if ( ! function_exists( 'candor_tag_cloud_args' ) ) {
    function candor_tag_cloud_args($args) {
        $args = array('smallest' => 15, 'largest' => 15, 'orderby' => 'count','unit' => 'px','order' => 'DESC',);
        return $args;
    }
}
add_filter('widget_tag_cloud_args','candor_tag_cloud_args');


/**
 * Returns an array of all available portfolio options
 * 
 * @val array
 * @since 1.0.0
 * @author Jewel Theme
 */
if(!( function_exists('candor_get_portfolio_layouts') )){
	function candor_get_portfolio_layouts(){
		return array(
			esc_html__( '2 Column', 'candor' ) 				=> '2col',
			esc_html__( '3 Column', 'candor' ) 				=> '3col',
			esc_html__( '4 Column', 'candor' ) 				=> '4col',
			esc_html__( '4 Column With Gaps', 'candor' ) 	=> '4col-gap',
			esc_html__( '5 Column', 'candor' ) 				=> '5col',
			esc_html__( 'Slider', 'candor' ) 				=> 'slider'
		);	
	}
}



/*
* Register Appropriate Shortcodes for Elevation
*/

if( '1' == $candor_options['elevation_vc_blocks'] ){

	/*===================================================================================
	 * Redux Extensions Loader
	 * =================================================================================*/

	/**
	 * Filter for adding extensions to the Redux Panel
	 *
	 * @since 1.01
	 */
	if ( ! function_exists( 'elevation_redux_register_custom_extension_loader' ) ) {
		function elevation_redux_register_custom_extension_loader( $ReduxFramework ) {

			//$path    = get_template_directory() . '/admin/extensions/';
			$path    = CANDOR_FRAMEWORK_PATH . '/vc_blocks/elevation/';
			$folders = scandir( $path, 1 );

			foreach ( $folders as $folder ) {

				if ( $folder === '.' or $folder === '..' or ! is_dir( $path . $folder ) ) {
					continue;
				}

				$extension_class = 'ReduxFramework_Extension_' . $folder;

				if ( ! class_exists( $extension_class ) ) {
					// In case you wanted override your override, hah.
					$class_file = $path . $folder . '/extension_' . $folder . '.php';
					$class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file );
					if ( $class_file ) {
						require_once( $class_file );
						$extension = new $extension_class( $ReduxFramework );
					}
				}

			}
		}

		add_action( "redux/extensions/elevation_options/before", 'elevation_redux_register_custom_extension_loader', 0 );
	}


	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_section_title_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_page_title_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_home_blog_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_call_to_action.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_service_box_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_content_image_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_team_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_donate_box_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_content_video_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_urgent_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_featured_content_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_testimonial_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_partners_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_main_causes_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_events_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_subscriber_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_gallery_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_coming_soon_block.php' );
}



/*
* Register Appropriate Shortcodes for Elevation
*/

if( '1' == $candor_options['shopaholic_vc_blocks'] ){
	//require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/shopaholic_image_box_feature.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_features.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_product_categories_grid.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_partners_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_product_category.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_mailchimp.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_recent_post.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_discount.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_products_trending.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_product_featured.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_products_featured_new.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_faq.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_skills.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_feature_items.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_services.php' );	
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_service_inspire.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_service_box.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_contact.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_pricing.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_google_map.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_section_title.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_counter.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_team.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_testimonial.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_partners.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_blog_classic.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_blog_grid.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_blog_masonry.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_portfolio_grid.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/shopaholic/vc_portfolio_list.php' );

	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_section_title_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_page_title_block.php' );
	
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_call_to_action.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_service_box_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_content_image_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_team_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_donate_box_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_content_video_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_urgent_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_featured_content_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_testimonial_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_partners_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_main_causes_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_events_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_subscriber_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_gallery_block.php' );
	// require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/elevation/vc_coming_soon_block.php' );
}



/*
* Register Appropriate Shortcodes for Polmo Pro
*/

if( '1' == $candor_options['polmo_pro_vc_blocks'] ){

	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/polmo-pro/vc_section_title_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/polmo-pro/vc_content_title_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/polmo-pro/vc_service_box_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/polmo-pro/vc_content_button.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/polmo-pro/vc_counter.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/polmo-pro/vc_portfolio_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/polmo-pro/vc_sponsor_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/polmo-pro/vc_home_blog_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/polmo-pro/vc_testimonial_block.php' );
	require_once( CANDOR_FRAMEWORK_PATH . 'vc_blocks/polmo-pro/vc_social_block.php' );
}