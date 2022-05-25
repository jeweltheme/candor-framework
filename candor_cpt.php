<?php
// Set-up Action and Filter Hooks

register_uninstall_hook(__FILE__, 'candor_framework_cpt_delete_plugin_options');


// RUN ON THEME ACTIVATION 
register_activation_hook( __FILE__, 'candor_framework_cpt_activation' );

// Flush rewrite rules on activation
function candor_framework_cpt_activation(){
	flush_rewrite_rules(true);
}

// Delete options table entries ONLY when Plugin Deactivated AND Deleted
function candor_framework_cpt_delete_plugin_options(){
	delete_options( 'candor_framework_cpt_display_options' );
}


function candor_framework_register_mega_menu() {

    $labels = array( 
        'name' => __( 'Candor Mega Menu', 'candor' ),
        'singular_name' => __( 'Candor Mega Menu Item', 'candor' ),
        'add_new' => __( 'Add New', 'candor' ),
        'add_new_item' => __( 'Add New Candor Mega Menu Item', 'candor' ),
        'edit_item' => __( 'Edit Candor Mega Menu Item', 'candor' ),
        'new_item' => __( 'New Candor Mega Menu Item', 'candor' ),
        'view_item' => __( 'View Candor Mega Menu Item', 'candor' ),
        'search_items' => __( 'Search Candor Mega Menu Items', 'candor' ),
        'not_found' => __( 'No Candor Mega Menu Items found', 'candor' ),
        'not_found_in_trash' => __( 'No Candor Mega Menu Items found in Trash', 'candor' ),
        'parent_item_colon' => __( 'Parent Candor Mega Menu Item:', 'candor' ),
        'menu_name' => __( 'Candor Mega Menu', 'candor' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'menu_icon' => 'dashicons-menu',
        'description' => __('Mega Menus entries for the theme.', 'candor'),
        'supports' => array( 'title', 'editor' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 40,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => false,
        'capability_type' => 'post'
    );

    register_post_type( 'mega_menu', $args );
}


function candor_framework_register_portfolio() {

	$displays = get_option('candor_framework_cpt_display_options');

	if( isset($displays['portfolio_slug']) && !empty($displays['portfolio_slug'] ) ){ $slug = $displays['portfolio_slug']; } else { $slug = 'portfolio'; }

	$labels = array( 
		'name' => __( 'Portfolio', 'candor' ),
		'singular_name' => __( 'Portfolio', 'candor' ),
		'add_new' => __( 'Add New', 'candor' ),
		'add_new_item' => __( 'Add New Portfolio', 'candor' ),
		'edit_item' => __( 'Edit Portfolio', 'candor' ),
		'new_item' => __( 'New Portfolio', 'candor' ),
		'view_item' => __( 'View Portfolio', 'candor' ),
		'search_items' => __( 'Search Portfolios', 'candor' ),
		'not_found' => __( 'No portfolios found', 'candor' ),
		'not_found_in_trash' => __( 'No portfolios found in Trash', 'candor' ),
		'parent_item_colon' => __( 'Parent Portfolio:', 'candor' ),
		'menu_name' => __( 'Portfolio', 'candor' ),
		);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => __('Portfolio entries for the candor Theme.', 'candor'),
		'supports' => array( 'title', 'editor', 'thumbnail'),
		'taxonomies' => array( 'portfolio-category' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-portfolio',

		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array( 'slug' => $slug ),
		'capability_type' => 'post'
		);

	register_post_type( 'portfolio', $args );
}




function candor_framework_create_portfolio_taxonomies(){
	$labels = array(
		'name' => _x( 'Portfolio Categories','candor' ),
		'singular_name' => _x( 'Portfolio Category','candor' ),
		'search_items' =>  __( 'Search Portfolio Categories','candor' ),
		'all_items' => __( 'All Portfolio Categories','candor' ),
		'parent_item' => __( 'Parent Portfolio Category','candor' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:','candor' ),
		'edit_item' => __( 'Edit Portfolio Category','candor' ), 
		'update_item' => __( 'Update Portfolio Category','candor' ),
		'add_new_item' => __( 'Add New Portfolio Category','candor' ),
		'new_item_name' => __( 'New Portfolio Category Name','candor' ),
		'menu_name' => __( 'Portfolio Categories','candor' ),
		); 	
	register_taxonomy('portfolio_category', array('portfolio'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
}


// Video
function candor_framework_register_video() {

	$displays = get_option('candor_framework_cpt_display_options');

	if( isset($displays['video_slug']) && !empty($displays['video_slug']) ){ $slug = $displays['video_slug']; } else { $slug = 'video'; }

	$labels = array( 
		'name' => __( 'Videos', 'candor' ),
		'singular_name' => __( 'Video', 'candor' ),
		'add_new' => __( 'Add New', 'candor' ),
		'add_new_item' => __( 'Add New Video', 'candor' ),
		'edit_item' => __( 'Edit Video', 'candor' ),
		'new_item' => __( 'New Video', 'candor' ),
		'view_item' => __( 'View Video', 'candor' ),
		'search_items' => __( 'Search Videos', 'candor' ),
		'not_found' => __( 'No Videos found', 'candor' ),
		'not_found_in_trash' => __( 'No Videos found in Trash', 'candor' ),
		'parent_item_colon' => __( 'Parent Video:', 'candor' ),
		'menu_name' => __( 'Videos', 'candor' ),
		);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => __('Video entries for the candor Theme.', 'candor'),
		'supports' => array( 'title', 'editor', 'thumbnail', 'author', 'comments'),
		'taxonomies' => array( 'video-category' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-video-alt3',

		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array( 'slug' => 'videos' ),
		'capability_type' => 'post'
		);

	register_post_type( 'video', $args );
}




function candor_framework_create_video_category_taxonomies(){
	$labels = array(
		'name' => _x( 'Video Categories','candor' ),
		'singular_name' => _x( 'Video Category','candor' ),
		'search_items' =>  __( 'Search Video Categories','candor' ),
		'all_items' => __( 'All Video Categories','candor' ),
		'parent_item' => __( 'Parent Video Category','candor' ),
		'parent_item_colon' => __( 'Parent Video Category:','candor' ),
		'edit_item' => __( 'Edit Video Category','candor' ), 
		'update_item' => __( 'Update Video Category','candor' ),
		'add_new_item' => __( 'Add New Video Category','candor' ),
		'new_item_name' => __( 'New Video Category Name','candor' ),
		'menu_name' => __( 'Video Categories','candor' ),
		); 	
	register_taxonomy('video_category', array('video'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
}

function candor_framework_create_video_tag_taxonomies(){
	$labels = array(
		'name' => _x( 'Video Tags','candor' ),
		'singular_name' => _x( 'Video Tag','candor' ),
		'search_items' =>  __( 'Search Video Tags','candor' ),
		'all_items' => __( 'All Video Tags','candor' ),
		'parent_item' => __( 'Parent Video Tag','candor' ),
		'parent_item_colon' => __( 'Parent Video Tag:','candor' ),
		'edit_item' => __( 'Edit Video Tag','candor' ), 
		'update_item' => __( 'Update Video Tag','candor' ),
		'add_new_item' => __( 'Add New Video Tag','candor' ),
		'new_item_name' => __( 'New Video Tag Name','candor' ),
		'menu_name' => __( 'Video Tags','candor' ),
		); 	
	register_taxonomy('video_tag', array('video'), array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
}





// Movie

function candor_framework_register_movie() {

	$displays = get_option('candor_framework_cpt_display_options');

	if( isset($displays['movie_slug']) && !empty($displays['movie_slug']) ){ $slug = $displays['movie_slug']; } else { $slug = 'movie'; }

	$labels = array( 
		'name' => __( 'Movies', 'candor' ),
		'singular_name' => __( 'Movie', 'candor' ),
		'add_new' => __( 'Add New', 'candor' ),
		'add_new_item' => __( 'Add New Movie', 'candor' ),
		'edit_item' => __( 'Edit Movie', 'candor' ),
		'new_item' => __( 'New Movie', 'candor' ),
		'view_item' => __( 'View Movie', 'candor' ),
		'search_items' => __( 'Search Movies', 'candor' ),
		'not_found' => __( 'No Movies found', 'candor' ),
		'not_found_in_trash' => __( 'No Movies found in Trash', 'candor' ),
		'parent_item_colon' => __( 'Parent Movie:', 'candor' ),
		'menu_name' => __( 'Movies', 'candor' ),
		);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => __('Movie entries for the candor Theme.', 'candor'),
		'supports' => array( 'title', 'editor', 'thumbnail', 'author', 'comments'),
		'taxonomies' => array( 'video-category' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-video-alt',

		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array( 'slug' => $slug ),
		'capability_type' => 'post'
		);

	register_post_type( 'movie', $args );
}




function candor_framework_create_movie_category_taxonomies(){
	$labels = array(
		'name' => _x( 'Movie Categories','candor' ),
		'singular_name' => _x( 'Movie Category','candor' ),
		'search_items' =>  __( 'Search Movie Categories','candor' ),
		'all_items' => __( 'All Movie Categories','candor' ),
		'parent_item' => __( 'Parent Movie Category','candor' ),
		'parent_item_colon' => __( 'Parent Movie Category:','candor' ),
		'edit_item' => __( 'Edit Movie Category','candor' ), 
		'update_item' => __( 'Update Movie Category','candor' ),
		'add_new_item' => __( 'Add New Movie Category','candor' ),
		'new_item_name' => __( 'New Movie Category Name','candor' ),
		'menu_name' => __( 'Movie Categories','candor' ),
		); 	
	register_taxonomy('movie_category', array('movie'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
}

function candor_framework_create_movie_tag_taxonomies(){
	$labels = array(
		'name' => _x( 'Movie Tags','candor' ),
		'singular_name' => _x( 'Movie Tag','candor' ),
		'search_items' =>  __( 'Search Movie Tags','candor' ),
		'all_items' => __( 'All Movie Tags','candor' ),
		'parent_item' => __( 'Parent Movie Tag','candor' ),
		'parent_item_colon' => __( 'Parent Movie Tag:','candor' ),
		'edit_item' => __( 'Edit Movie Tag','candor' ), 
		'update_item' => __( 'Update Movie Tag','candor' ),
		'add_new_item' => __( 'Add New Movie Tag','candor' ),
		'new_item_name' => __( 'New Movie Tag Name','candor' ),
		'menu_name' => __( 'Movie Tags','candor' ),
		); 	
	register_taxonomy('movie_tag', array('movie'), array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
}







// IMDb

function candor_framework_register_imdb_movie() {

	$displays = get_option('candor_framework_cpt_display_options');

	if( isset($displays['imdb_slug']) && !empty($displays['imdb_slug']) ){ $slug = $displays['imdb_slug']; } else { $slug = 'imdb'; }

	$labels = array( 
		'name' => __( 'IMDb', 'candor' ),
		'singular_name' => __( 'IMDb', 'candor' ),
		'add_new' => __( 'Add New', 'candor' ),
		'add_new_item' => __( 'Add New IMDb', 'candor' ),
		'edit_item' => __( 'Edit IMDb', 'candor' ),
		'new_item' => __( 'New IMDb', 'candor' ),
		'view_item' => __( 'View IMDb', 'candor' ),
		'search_items' => __( 'Search IMDb', 'candor' ),
		'not_found' => __( 'No IMDb found', 'candor' ),
		'not_found_in_trash' => __( 'No IMDb found in Trash', 'candor' ),
		'parent_item_colon' => __( 'Parent IMDb:', 'candor' ),
		'menu_name' => __( 'IMDb', 'candor' ),
		);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => __('IMDb entries for the candor Theme.', 'candor'),
		'supports' => array( 'title', 'editor', 'thumbnail', 'author', 'comments'),
		'taxonomies' => array( 'imdb-category' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 20,
		'menu_icon' => get_template_directory_uri() . '/images/i1.png',

		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array( 'slug' => $slug ),
		'capability_type' => 'post'
		);

	register_post_type( 'imdb', $args );
}




function candor_framework_create_imdb_movie_category_taxonomies(){
	$labels = array(
		'name' => _x( 'IMDb Categories','candor' ),
		'singular_name' => _x( 'IMDb Category','candor' ),
		'search_items' =>  __( 'Search IMDb Categories','candor' ),
		'all_items' => __( 'All Movie Categories','candor' ),
		'parent_item' => __( 'Parent IMDb Category','candor' ),
		'parent_item_colon' => __( 'Parent IMDb Category:','candor' ),
		'edit_item' => __( 'Edit IMDb Category','candor' ), 
		'update_item' => __( 'Update IMDb Category','candor' ),
		'add_new_item' => __( 'Add New IMDb Category','candor' ),
		'new_item_name' => __( 'New IMDb Category Name','candor' ),
		'menu_name' => __( 'IMDb Categories','candor' ),
		); 	
	register_taxonomy('imdb_category', array('imdb'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
}

function candor_framework_create_imdb_movie_tag_taxonomies(){
	$labels = array(
		'name' => _x( 'IMDb Tags','candor' ),
		'singular_name' => _x( 'IMDb Tag','candor' ),
		'search_items' =>  __( 'Search IMDb Tags','candor' ),
		'all_items' => __( 'All IMDb Tags','candor' ),
		'parent_item' => __( 'Parent IMDb Tag','candor' ),
		'parent_item_colon' => __( 'Parent IMDb Tag:','candor' ),
		'edit_item' => __( 'Edit IMDb Tag','candor' ), 
		'update_item' => __( 'Update IMDb Tag','candor' ),
		'add_new_item' => __( 'Add New IMDb Tag','candor' ),
		'new_item_name' => __( 'New IMDb Tag Name','candor' ),
		'menu_name' => __( 'IMDb Tags','candor' ),
		); 	
	register_taxonomy('imdb_tag', array('imdb'), array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
}




function candor_framework_register_pricing() {

	$displays = get_option('candor_framework_cpt_display_options');

	$labels = array( 
		'name' => __( 'Pricing', 'candor' ),
		'singular_name' => __( 'Pricing', 'candor' ),
		'add_new' => __( 'Add New', 'candor' ),
		'add_new_item' => __( 'Add New Pricing', 'candor' ),
		'edit_item' => __( 'Edit Pricing', 'candor' ),
		'new_item' => __( 'New Pricing', 'candor' ),
		'view_item' => __( 'View Pricing', 'candor' ),
		'search_items' => __( 'Search Portfolios', 'candor' ),
		'not_found' => __( 'No Pricing\'s found', 'candor' ),
		'not_found_in_trash' => __( 'No Pricing\'s found in Trash', 'candor' ),
		'parent_item_colon' => __( 'Parent Pricing:', 'candor' ),
		'menu_name' => __( 'Pricing', 'candor' ),
		);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => __('Pricing entries for the candor Theme.', 'candor'),
		'supports' => array( 'title'),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 22,
		'menu_icon' => 'dashicons-screenoptions',

		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
		);

	register_post_type( 'pricing', $args );
}

function candor_framework_create_pricing_taxonomies(){
	
	$labels = array(
		'name' => _x( 'Pricing Categories','candor' ),
		'singular_name' => _x( 'Pricing Category','candor' ),
		'search_items' =>  __( 'Search Pricing Categories','candor' ),
		'all_items' => __( 'All Pricing Categories','candor' ),
		'parent_item' => __( 'Parent Pricing Category','candor' ),
		'parent_item_colon' => __( 'Parent Pricing Category:','candor' ),
		'edit_item' => __( 'Edit Pricing Category','candor' ), 
		'update_item' => __( 'Update Pricing Category','candor' ),
		'add_new_item' => __( 'Add New Pricing Category','candor' ),
		'new_item_name' => __( 'New Pricing Category Name','candor' ),
		'menu_name' => __( 'Pricing Categories','candor' ),
		); 
	
	register_taxonomy('pricing_category', array('pricing'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
	
}



function candor_framework_register_services() {

	$displays = get_option('candor_framework_cpt_display_options');

	$labels = array( 
		'name' => __( 'Service', 'candor' ),
		'singular_name' => __( 'Service', 'candor' ),
		'add_new' => __( 'Add New', 'candor' ),
		'add_new_item' => __( 'Add New Service', 'candor' ),
		'edit_item' => __( 'Edit Service', 'candor' ),
		'new_item' => __( 'New Service', 'candor' ),
		'view_item' => __( 'View Service', 'candor' ),
		'search_items' => __( 'Search Portfolios', 'candor' ),
		'not_found' => __( 'No Service\'s found', 'candor' ),
		'not_found_in_trash' => __( 'No Service\'s found in Trash', 'candor' ),
		'parent_item_colon' => __( 'Parent Service:', 'candor' ),
		'menu_name' => __( 'Service', 'candor' ),
		);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => __('Service entries for the candor Theme.', 'candor'),
		'supports' => array( 'title', 'thumbnail'),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 24,
		'menu_icon' => 'dashicons-admin-network',

		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
		);

	register_post_type( 'service', $args );
}




function candor_framework_register_team() {

	$displays = get_option('candor_framework_cpt_display_options');

	if( isset($displays['team_slug']) && !empty($displays['team_slug']) ){ $slug = $displays['team_slug']; } else { $slug = 'team'; }

	$labels = array( 
		'name' => __( 'Team Members', 'candor' ),
		'singular_name' => __( 'Team Member', 'candor' ),
		'add_new' => __( 'Add New', 'candor' ),
		'add_new_item' => __( 'Add New Team Member', 'candor' ),
		'edit_item' => __( 'Edit Team Member', 'candor' ),
		'new_item' => __( 'New Team Member', 'candor' ),
		'view_item' => __( 'View Team Member', 'candor' ),
		'search_items' => __( 'Search Team Members', 'candor' ),
		'not_found' => __( 'No Team Members found', 'candor' ),
		'not_found_in_trash' => __( 'No Team Members found in Trash', 'candor' ),
		'parent_item_colon' => __( 'Parent Team Member:', 'candor' ),
		'menu_name' => __( 'Team Members', 'candor' ),
		);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => __('Team Member entries for the candor Theme.', 'candor'),
		'supports' => array( 'title', 'thumbnail', 'editor' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 24,
		'menu_icon' => 'dashicons-groups',
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array( 'slug' => $slug ),
		'capability_type' => 'post'
		);

	register_post_type( 'team', $args );
}

function candor_framework_create_team_taxonomies(){
	
	$labels = array(
		'name' => _x( 'Team Categories','candor' ),
		'singular_name' => _x( 'Team Category','candor' ),
		'search_items' =>  __( 'Search Team Categories','candor' ),
		'all_items' => __( 'All Team Categories','candor' ),
		'parent_item' => __( 'Parent Team Category','candor' ),
		'parent_item_colon' => __( 'Parent Team Category:','candor' ),
		'edit_item' => __( 'Edit Team Category','candor' ), 
		'update_item' => __( 'Update Team Category','candor' ),
		'add_new_item' => __( 'Add New Team Category','candor' ),
		'new_item_name' => __( 'New Team Category Name','candor' ),
		'menu_name' => __( 'Team Categories','candor' ),
		); 
	
	register_taxonomy('team_category', array('team'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
	
}




function candor_framework_register_client() {

	$labels = array( 
		'name' => __( 'Clients', 'candor' ),
		'singular_name' => __( 'Client', 'candor' ),
		'add_new' => __( 'Add New', 'candor' ),
		'add_new_item' => __( 'Add New Client', 'candor' ),
		'edit_item' => __( 'Edit Client', 'candor' ),
		'new_item' => __( 'New Client', 'candor' ),
		'view_item' => __( 'View Client', 'candor' ),
		'search_items' => __( 'Search Clients', 'candor' ),
		'not_found' => __( 'No Clients found', 'candor' ),
		'not_found_in_trash' => __( 'No Clients found in Trash', 'candor' ),
		'parent_item_colon' => __( 'Parent Client:', 'candor' ),
		'menu_name' => __( 'Clients', 'candor' ),
		);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => __('Client entries.', 'candor'),
		'supports' => array( 'title', 'thumbnail' ),
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 25,
		'menu_icon' => 'dashicons-businessman',
		'show_in_nav_menus' => true,
		'publicly_queryable' => false,
		'exclude_from_search' => true,
		'has_archive' => false,
		'query_var' => false,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
		);

	register_post_type( 'client', $args );
}

function candor_framework_create_client_taxonomies(){
	
	$labels = array(
		'name' => _x( 'Client Categories','candor' ),
		'singular_name' => _x( 'Client Category','candor' ),
		'search_items' =>  __( 'Search Client Categories','candor' ),
		'all_items' => __( 'All Client Categories','candor' ),
		'parent_item' => __( 'Parent Client Category','candor' ),
		'parent_item_colon' => __( 'Parent Client Category:','candor' ),
		'edit_item' => __( 'Edit Client Category','candor' ), 
		'update_item' => __( 'Update Client Category','candor' ),
		'add_new_item' => __( 'Add New Client Category','candor' ),
		'new_item_name' => __( 'New Client Category Name','candor' ),
		'menu_name' => __( 'Client Categories','candor' ),
		); 
	
	register_taxonomy('client_category', array('client'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
	
}


// Causes
function candor_framework_register_causes() {

	$labels = array( 
		'name' => __( 'Causes', 'candor' ),
		'singular_name' => __( 'Cause', 'candor' ),
		'add_new' => __( 'Add New', 'candor' ),
		'add_new_item' => __( 'Add New Cause', 'candor' ),
		'edit_item' => __( 'Edit Cause', 'candor' ),
		'new_item' => __( 'New Cause', 'candor' ),
		'view_item' => __( 'View Cause', 'candor' ),
		'search_items' => __( 'Search Causes', 'candor' ),
		'not_found' => __( 'No Causes found', 'candor' ),
		'not_found_in_trash' => __( 'No Causes found in Trash', 'candor' ),
		'parent_item_colon' => __( 'Parent Cause:', 'candor' ),
		'menu_name' => __( 'Causes', 'candor' ),
		);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => __('Causes entries.', 'candor'),
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 22,
		'menu_icon' => 'dashicons-chart-line',
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		//'rewrite' => array( 'slug' => $slug ),
		'capability_type' => 'post'
		);

	register_post_type( 'causes', $args );
}

function candor_framework_create_causes_taxonomies(){
	
	$labels = array(
		'name' => _x( 'Cause Categories','candor' ),
		'singular_name' => _x( 'Cause Category','candor' ),
		'search_items' =>  __( 'Search Cause Categories','candor' ),
		'all_items' => __( 'All Cause Categories','candor' ),
		'parent_item' => __( 'Parent Cause Category','candor' ),
		'parent_item_colon' => __( 'Parent Cause Category:','candor' ),
		'edit_item' => __( 'Edit Cause Category','candor' ), 
		'update_item' => __( 'Update Cause Category','candor' ),
		'add_new_item' => __( 'Add New Cause Category','candor' ),
		'new_item_name' => __( 'New Cause Category Name','candor' ),
		'menu_name' => __( 'Cause Categories','candor' ),
		); 
	
	register_taxonomy('causes_category', array('causes'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
	
}


// Events
function candor_framework_register_events() {

	$labels = array( 
		'name' => __( 'Events', 'candor' ),
		'singular_name' => __( 'Event', 'candor' ),
		'add_new' => __( 'Add New', 'candor' ),
		'add_new_item' => __( 'Add New Event', 'candor' ),
		'edit_item' => __( 'Edit Event', 'candor' ),
		'new_item' => __( 'New Event', 'candor' ),
		'view_item' => __( 'View Event', 'candor' ),
		'search_items' => __( 'Search Events', 'candor' ),
		'not_found' => __( 'No Events found', 'candor' ),
		'not_found_in_trash' => __( 'No Events found in Trash', 'candor' ),
		'parent_item_colon' => __( 'Parent Event:', 'candor' ),
		'menu_name' => __( 'Events', 'candor' ),
		);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => __('Events entries.', 'candor'),
		'supports' => array( 'title', 'thumbnail', 'editor' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 23,
		'menu_icon' => 'dashicons-businessman',
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
		);

	register_post_type( 'events', $args );
}

function candor_framework_create_events_taxonomies(){
	
	$labels = array(
		'name' => _x( 'Event Categories','candor' ),
		'singular_name' => _x( 'Event Category','candor' ),
		'search_items' =>  __( 'Search Event Categories','candor' ),
		'all_items' => __( 'All Event Categories','candor' ),
		'parent_item' => __( 'Parent Event Category','candor' ),
		'parent_item_colon' => __( 'Parent Event Category:','candor' ),
		'edit_item' => __( 'Edit Event Category','candor' ), 
		'update_item' => __( 'Update Event Category','candor' ),
		'add_new_item' => __( 'Add New Event Category','candor' ),
		'new_item_name' => __( 'New Event Category Name','candor' ),
		'menu_name' => __( 'Event Categories','candor' ),
		); 
	
	register_taxonomy('events_category', array('events'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
	
}




// Testimonial
function candor_framework_register_testimonial() {

	$labels = array( 
		'name' => __( 'Testimonials', 'candor' ),
		'singular_name' => __( 'Testimonial', 'candor' ),
		'add_new' => __( 'Add New', 'candor' ),
		'add_new_item' => __( 'Add New Testimonial', 'candor' ),
		'edit_item' => __( 'Edit Testimonial', 'candor' ),
		'new_item' => __( 'New Testimonial', 'candor' ),
		'view_item' => __( 'View Testimonial', 'candor' ),
		'search_items' => __( 'Search Testimonials', 'candor' ),
		'not_found' => __( 'No Testimonials found', 'candor' ),
		'not_found_in_trash' => __( 'No Testimonials found in Trash', 'candor' ),
		'parent_item_colon' => __( 'Parent Testimonial:', 'candor' ),
		'menu_name' => __( 'Testimonials', 'candor' ),
		);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => __('Testimonial entries.', 'candor'),
		'supports' => array( 'title', 'thumbnail' ),
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-editor-quote',
		'show_in_nav_menus' => true,
		'publicly_queryable' => false,
		'exclude_from_search' => true,
		'has_archive' => false,
		'query_var' => false,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
		);

	register_post_type( 'testimonial', $args );
}

function candor_framework_create_testimonial_taxonomies(){
	
	$labels = array(
		'name' => _x( 'Testimonial Categories','candor' ),
		'singular_name' => _x( 'Testimonial Category','candor' ),
		'search_items' =>  __( 'Search Testimonial Categories','candor' ),
		'all_items' => __( 'All Testimonial Categories','candor' ),
		'parent_item' => __( 'Parent Testimonial Category','candor' ),
		'parent_item_colon' => __( 'Parent Testimonial Category:','candor' ),
		'edit_item' => __( 'Edit Testimonial Category','candor' ), 
		'update_item' => __( 'Update Testimonial Category','candor' ),
		'add_new_item' => __( 'Add New Testimonial Category','candor' ),
		'new_item_name' => __( 'New Testimonial Category Name','candor' ),
		'menu_name' => __( 'Testimonial Categories','candor' ),
		); 
	
	register_taxonomy('testimonial_category', array('testimonial'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
	
}

function candor_framework_register_faq() {

	$labels = array( 
		'name' => __( 'FAQs', 'candor' ),
		'singular_name' => __( 'FAQ', 'candor' ),
		'add_new' => __( 'Add New', 'candor' ),
		'add_new_item' => __( 'Add New FAQ', 'candor' ),
		'edit_item' => __( 'Edit FAQ', 'candor' ),
		'new_item' => __( 'New FAQ', 'candor' ),
		'view_item' => __( 'View FAQ', 'candor' ),
		'search_items' => __( 'Search FAQs', 'candor' ),
		'not_found' => __( 'No faqs found', 'candor' ),
		'not_found_in_trash' => __( 'No FAQs found in Trash', 'candor' ),
		'parent_item_colon' => __( 'Parent FAQ:', 'candor' ),
		'menu_name' => __( 'FAQs', 'candor' ),
		);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => __('FAQ Entries.', 'candor'),
		'supports' => array( 'title', 'editor' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-welcome-learn-more',
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'has_archive' => false,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
		);

	register_post_type( 'faq', $args );
}

function candor_framework_create_faq_taxonomies(){
	
	$labels = array(
		'name' => _x( 'FAQ Categories','candor' ),
		'singular_name' => _x( 'FAQ Category','candor' ),
		'search_items' =>  __( 'Search FAQ Categories','candor' ),
		'all_items' => __( 'All FAQ Categories','candor' ),
		'parent_item' => __( 'Parent FAQ Category','candor' ),
		'parent_item_colon' => __( 'Parent FAQ Category:','candor' ),
		'edit_item' => __( 'Edit FAQ Category','candor' ), 
		'update_item' => __( 'Update FAQ Category','candor' ),
		'add_new_item' => __( 'Add New FAQ Category','candor' ),
		'new_item_name' => __( 'New FAQ Category Name','candor' ),
		'menu_name' => __( 'FAQ Categories','candor' ),
		); 
	
	register_taxonomy('faq_category', array('faq'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
		));
	
}

function candor_framework_register_menu() {

	$labels = array( 
		'name' => __( 'Menu Items', 'candor' ),
		'singular_name' => __( 'Menu Item', 'candor' ),
		'add_new' => __( 'Add New', 'candor' ),
		'add_new_item' => __( 'Add New Menu Item', 'candor' ),
		'edit_item' => __( 'Edit Menu Item', 'candor' ),
		'new_item' => __( 'New Menu Item', 'candor' ),
		'view_item' => __( 'View Menu Item', 'candor' ),
		'search_items' => __( 'Search Menu Items', 'candor' ),
		'not_found' => __( 'No Menu Items found', 'candor' ),
		'not_found_in_trash' => __( 'No Menu Items found in Trash', 'candor' ),
		'parent_item_colon' => __( 'Parent Menu Item:', 'candor' ),
		'menu_name' => __( 'Menu Items', 'candor' ),
		);

	$args = array( 

		'labels' => $labels,
		'hierarchical' => false,
		'description' => __('Menu Item Entries.', 'candor'),
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-carrot',
		'show_in_nav_menus' => false,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => false,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => false,
		'capability_type' => 'post'
		);

	register_post_type( 'menu', $args );
}

function candor_framework_create_menu_taxonomies(){
	
	$labels = array(
		'name' => _x( 'Menu Item Categories','candor' ),
		'singular_name' => _x( 'Menu Item Category','candor' ),
		'search_items' =>  __( 'Search Menu Item Categories','candor' ),
		'all_items' => __( 'All Menu Item Categories','candor' ),
		'parent_item' => __( 'Parent Menu Item Category','candor' ),
		'parent_item_colon' => __( 'Parent Menu Item Category:','candor' ),
		'edit_item' => __( 'Edit Menu Item Category','candor' ), 
		'update_item' => __( 'Update Menu Item Category','candor' ),
		'add_new_item' => __( 'Add New Menu Item Category','candor' ),
		'new_item_name' => __( 'New Menu Item Category Name','candor' ),
		'menu_name' => __( 'Menu Item Categories','candor' ),
		); 
	
	register_taxonomy('menu_category', array('menu'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => false,
		'rewrite' => false,
		));
	
}



function candor_framework_register_sections() {
    $labels = array(
        'name'              => esc_attr__( 'Sections', 'candor' ),
        'singular_name'     => esc_attr__( 'Section', 'candor' ),
        'add_new'           => esc_attr__( 'Add new section', 'candor' ),
        'add_new_item'      => esc_attr__( 'Add new section', 'candor' ),
        'edit_item'         => esc_attr__( 'Edit section', 'candor' ),
        'new_item'          => esc_attr__( 'New section', 'candor' ),
        'view_item'         => esc_attr__( 'View section', 'candor' ),
        'search_items'      => esc_attr__( 'Search sections', 'candor' ),
        'not_found'         => esc_attr__( 'No section found', 'candor' ),
        'not_found_in_trash'=> esc_attr__( 'No section found in trash', 'candor' ),
        'parent_item_colon' => esc_attr__( 'Parent sections:', 'candor' ),
        'menu_name'         => esc_attr__( 'Sections', 'candor' )
    );

    $taxonomies = array();
 
    $supports = array('title','editor','thumbnail');
 
    $post_type_args = array(
        'labels'            => $labels,
        'singular_label'    => esc_attr__('Section', 'candor'),
        'public'            => true,
        'exclude_from_search' => true,
        'show_ui'           => true,
        'show_in_nav_menus' => false,
        'publicly_queryable'=> true,
        'query_var'         => true,
        'capability_type'   => 'post',
        'has_archive'       => false,
        'hierarchical'      => false,
        'rewrite'           => array( 'slug' => 'sections', 'with_front' => false ),
        'supports'          => $supports,
        'menu_position'     => 95,
        'menu_icon'         => 'dashicons-admin-page',
        'taxonomies'        => $taxonomies
    );
    register_post_type('sections',$post_type_args);
}