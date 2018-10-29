<?php



/**
 * Execute Shortcodes on Sidebar Widget areas and Prints the Output of Shortcodes
 * @since 1.0.0
 * @author Jewel Theme
 */
add_filter('widget_text', 'do_shortcode');


/**
 * Jewel Load Custom Favicons
 * Prints Custom Favicons to wp_head()
 * @since 1.0.0
 * @author Jewel Theme
 */
if(!( function_exists('candor_framework_load_favicons') )){
	function candor_framework_load_favicons() {

		$favicon_144 = get_option('144_favicon', get_template_directory_uri() . '/images/favicon/144.png');
		$favicon_114 = get_option('114_favicon', get_template_directory_uri() . '/images/favicon/114.png');
		$favicon_72  = get_option('72_favicon', get_template_directory_uri() . '/images/favicon/72.png');
		$mobile_favicon  = get_option('mobile_favicon', get_template_directory_uri() . '/images/favicon/64.png');
		$custom_favicon  = get_option('custom_favicon', get_template_directory_uri() . '/images/favicon/32.png');


		if ( $favicon_144  !=='' )
			echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="' . $favicon_144 . '">';
		
		if ( $favicon_114 !=='' )
			echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="' . $favicon_114 . '">';
			
		if ( $favicon_72 !=='' )
			echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="' . $favicon_72 . '">';
			
		if ( $mobile_favicon !=='' )
			echo '<link rel="apple-touch-icon-precomposed" href="' . $mobile_favicon . '">';
			
		if ( $custom_favicon !=='' )
			echo '<link rel="shortcut icon" href="' . $custom_favicon . '">';
	}
	//add_action('wp_head', 'candor_framework_load_favicons');
}


/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 * @since 1.0.0
 * @author Jewel Theme
 */
if(!( function_exists('candor_framework_wp_title') )){
	function candor_framework_wp_title( $title, $sep ) {
		global $page, $paged;
	
		if ( is_feed() )
			return $title;
	
		// Add the blog name
		$title .= get_bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title .= " $sep $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			$title .= " $sep " . sprintf( __( 'Page %s', 'candor-framework' ), max( $paged, $page ) );
	
		return $title;
	}
	add_filter( 'wp_title', 'candor_framework_wp_title', 10, 2 );
}



// Get Blog Posts Link
function candor_framework_get_blog_link(){
    $blog_post = get_option("page_for_posts");
    if($blog_post){
        $permalink = get_permalink($blog_post);
    }
    else
        $permalink = site_url();
    return $permalink;
}




