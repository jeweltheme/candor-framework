<?php


/**
 * ======  Wp Jobs Manager Filters START  ======
 */
function inventory_change_job_into_listing( $args ) {

	$singular = esc_html__( 'Listing', 'inventory' );
	$plural   = esc_html__( 'Listings', 'inventory' );

	$args['labels']      = array(
		'name'               => $plural,
		'singular_name'      => $singular,
		'menu_name'          => $plural,
		'all_items'          => sprintf( esc_html__( 'All %s', 'inventory' ), $plural ),
		'add_new'            => esc_html__( 'Add New', 'inventory' ),
		'add_new_item'       => sprintf( esc_html__( 'Add %s', 'inventory' ), $singular ),
		'edit'               => esc_html__( 'Edit', 'inventory' ),
		'edit_item'          => sprintf( esc_html__( 'Edit %s', 'inventory' ), $singular ),
		'new_item'           => sprintf( esc_html__( 'New %s', 'inventory' ), $singular ),
		'view'               => sprintf( esc_html__( 'View %s', 'inventory' ), $singular ),
		'view_item'          => sprintf( esc_html__( 'View %s', 'inventory' ), $singular ),
		'search_items'       => sprintf( esc_html__( 'Search %s', 'inventory' ), $plural ),
		'not_found'          => sprintf( esc_html__( 'No %s found', 'inventory' ), $plural ),
		'not_found_in_trash' => sprintf( esc_html__( 'No %s found in trash', 'inventory' ), $plural ),
		'parent'             => sprintf( esc_html__( 'Parent %s', 'inventory' ), $singular )
	);
	$args['description'] = sprintf( esc_html__( 'This is where you can create and manage %s.', 'inventory' ), $plural );
	$args['supports']    = array( 'title', 'editor', 'custom-fields', 'publicize', 'comments', 'thumbnail' );
	$args['rewrite']     = array( 'slug' => 'listings' );

	$permalinks = get_option( 'listable_permalinks_settings' );
	if ( isset( $permalinks['listing_base'] ) && ! empty( $permalinks['listing_base'] ) ) {
		$args['rewrite']['slug'] = $permalinks['listing_base'];
	}

	return $args;
}

add_filter( 'register_post_type_job_listing', 'inventory_change_job_into_listing' );

function inventory_change_taxonomy_job_listing_type_args( $args ) {
	$singular = esc_html__( 'Listing Type', 'inventory' );
	$plural   = esc_html__( 'Listings Types', 'inventory' );

	$args['label']  = $plural;
	$args['labels'] = array(
		'name'              => $plural,
		'singular_name'     => $singular,
		'menu_name'         => esc_html__( 'Types', 'inventory' ),
		'search_items'      => sprintf( esc_html__( 'Search %s', 'inventory' ), $plural ),
		'all_items'         => sprintf( esc_html__( 'All %s', 'inventory' ), $plural ),
		'parent_item'       => sprintf( esc_html__( 'Parent %s', 'inventory' ), $singular ),
		'parent_item_colon' => sprintf( esc_html__( 'Parent %s:', 'inventory' ), $singular ),
		'edit_item'         => sprintf( esc_html__( 'Edit %s', 'inventory' ), $singular ),
		'update_item'       => sprintf( esc_html__( 'Update %s', 'inventory' ), $singular ),
		'add_new_item'      => sprintf( esc_html__( 'Add New %s', 'inventory' ), $singular ),
		'new_item_name'     => sprintf( esc_html__( 'New %s Name', 'inventory' ), $singular )
	);

	if ( isset( $args['rewrite'] ) && is_array( $args['rewrite'] ) ) {
		$args['rewrite']['slug'] = _x( 'listing-type', 'Listing type slug - resave permalinks after changing this', 'inventory' );
	}

	return $args;
}

add_filter( 'register_taxonomy_job_listing_type_args', 'inventory_change_taxonomy_job_listing_type_args' );

function inventory_change_taxonomy_job_listing_category_args( $args ) {
	$singular = esc_html__( 'Listing Category', 'inventory' );
	$plural   = esc_html__( 'Listings Categories', 'inventory' );

	$args['label'] = $plural;

	$args['labels'] = array(
		'name'              => $plural,
		'singular_name'     => $singular,
		'menu_name'         => esc_html__( 'Categories', 'inventory' ),
		'search_items'      => sprintf( esc_html__( 'Search %s', 'inventory' ), $plural ),
		'all_items'         => sprintf( esc_html__( 'All %s', 'inventory' ), $plural ),
		'parent_item'       => sprintf( esc_html__( 'Parent %s', 'inventory' ), $singular ),
		'parent_item_colon' => sprintf( esc_html__( 'Parent %s:', 'inventory' ), $singular ),
		'edit_item'         => sprintf( esc_html__( 'Edit %s', 'inventory' ), $singular ),
		'update_item'       => sprintf( esc_html__( 'Update %s', 'inventory' ), $singular ),
		'add_new_item'      => sprintf( esc_html__( 'Add New %s', 'inventory' ), $singular ),
		'new_item_name'     => sprintf( esc_html__( 'New %s Name', 'inventory' ), $singular )
	);

	if ( isset( $args['rewrite'] ) && is_array( $args['rewrite'] ) ) {
		$args['rewrite']['slug'] = _x( 'listing-category', 'Listing category slug - resave permalinks after changing this', 'inventory' );
	}

	$permalinks = get_option( 'listable_permalinks_settings' );
	if ( isset( $permalinks['category_base'] ) && ! empty( $permalinks['category_base'] ) ) {
		$args['rewrite']['slug'] = $permalinks['category_base'];
	}

	return $args;
}

add_filter( 'register_taxonomy_job_listing_category_args', 'inventory_change_taxonomy_job_listing_category_args' );

function inventory_replace_listing_tags_object_label() {

	global $wp_taxonomies;

	if ( ! isset( $wp_taxonomies['job_listing_tag'] ) ) {
		return;
	}

	// get the arguments of the already-registered taxonomy
	$job_listing_tag_args = get_taxonomy( 'job_listing_tag' ); // returns an object

	$labels = &$job_listing_tag_args->labels;

	$labels->name                       = esc_html__( 'Listing Tags', 'inventory' );
	$labels->singular_name              = esc_html__( 'Listing Tag', 'inventory' );
	$labels->search_items               = esc_html__( 'Search Listing Tags', 'inventory' );
	$labels->popular_items              = esc_html__( 'Popular Tags', 'inventory' );
	$labels->all_items                  = esc_html__( 'All Listing Tags', 'inventory' );
	$labels->parent_item                = esc_html__( 'Parent Listing Tag', 'inventory' );
	$labels->parent_item_colon          = esc_html__( 'Parent Listing Tag:', 'inventory' );
	$labels->edit_item                  = esc_html__( 'Edit Listing Tag', 'inventory' );
	$labels->view_item                  = esc_html__( 'View Tag', 'inventory' );
	$labels->update_item                = esc_html__( 'Update Listing Tag', 'inventory' );
	$labels->add_new_item               = esc_html__( 'Add New Listing Tag', 'inventory' );
	$labels->new_item_name              = esc_html__( 'New Listing Tag Name', 'inventory' );
	$labels->separate_items_with_commas = esc_html__( 'Separate tags with commas', 'inventory' );
	$labels->add_or_remove_items        = esc_html__( 'Add or remove tags', 'inventory' );
	$labels->choose_from_most_used      = esc_html__( 'Choose from the most used tags', 'inventory' );
	$labels->not_found                  = esc_html__( 'No tags found.', 'inventory' );
	$labels->no_terms                   = esc_html__( 'No tags', 'inventory' );
	$labels->menu_name                  = esc_html__( 'Listing Tags', 'inventory' );
	$labels->name_admin_bar             = esc_html__( 'Listing Tag', 'inventory' );

	$job_listing_tag_args->rewrite = array(
		'slug'         => _x( 'listing-tag', 'permalink', 'inventory' ),
		'with_front'   => false,
		'ep_mask'      => 0,
		'hierarchical' => false
	);

	$permalinks = get_option( 'listable_permalinks_settings' );
	if ( isset( $permalinks['tag_base'] ) && ! empty( $permalinks['tag_base'] ) ) {
		$job_listing_tag_args->rewrite['slug'] = $permalinks['tag_base'];
	}


	// re-register the taxonomy
	register_taxonomy( 'job_listing_tag', array( 'job_listing' ), (array) $job_listing_tag_args );

	// also unregister listing type since we wont use it
	// @todo try another way another time
	//	unset( $wp_taxonomies['job_listing_type'] );
}

add_action( 'init', 'inventory_replace_listing_tags_object_label' );

function inventory_replace_listing_regions_object_label() {

	global $wp_taxonomies;

	if ( ! isset( $wp_taxonomies['job_listing_region'] ) ) {
		return;
	}

	// get the arguments of the already-registered taxonomy
	$job_listing_region_args = get_taxonomy( 'job_listing_region' ); // returns an object

	$labels = &$job_listing_region_args->labels;

	$labels->name                       = esc_html__( 'Listing Regions', 'inventory' );
	$labels->singular_name              = esc_html__( 'Region', 'inventory' );
	$labels->search_items               = esc_html__( 'Search Regions', 'inventory' );
	$labels->popular_items              = esc_html__( 'Popular Regions', 'inventory' );
	$labels->all_items                  = esc_html__( 'All Regions', 'inventory' );
	$labels->parent_item                = esc_html__( 'Parent Region', 'inventory' );
	$labels->parent_item_colon          = esc_html__( 'Parent Region:', 'inventory' );
	$labels->edit_item                  = esc_html__( 'Edit Region', 'inventory' );
	$labels->view_item                  = esc_html__( 'View Region', 'inventory' );
	$labels->update_item                = esc_html__( 'Update Region', 'inventory' );
	$labels->add_new_item               = esc_html__( 'Add New Region', 'inventory' );
	$labels->new_item_name              = esc_html__( 'New Region Name', 'inventory' );
	$labels->separate_items_with_commas = esc_html__( 'Separate regions with commas', 'inventory' );
	$labels->add_or_remove_items        = esc_html__( 'Add or remove regions', 'inventory' );
	$labels->choose_from_most_used      = esc_html__( 'Choose from the most used regions', 'inventory' );
	$labels->not_found                  = esc_html__( 'No regions found.', 'inventory' );
	$labels->no_terms                   = esc_html__( 'No regions', 'inventory' );
	$labels->menu_name                  = esc_html__( 'Regions', 'inventory' );
	$labels->name_admin_bar             = esc_html__( 'Listing Region', 'inventory' );
	$job_listing_region_args->label     = esc_html__( 'Listing Regions', 'inventory' );

	$job_listing_region_args->rewrite = array(
		'slug'         => _x( 'listing-region', 'permalink', 'inventory' ),
		'with_front'   => false,
		'ep_mask'      => 0,
		'hierarchical' => true
	);

	// re-register the taxonomy
	register_taxonomy( 'job_listing_region', array( 'job_listing' ), (array) $job_listing_region_args );
}

add_action( 'init', 'inventory_replace_listing_regions_object_label', 11 );




function get_url_shortcode($atts) {
	 if(is_front_page()){
		 $frontpage_ID = get_option('page_on_front');
		 $url = home_url();
		 //echo esc_url( $url;

		 $link =  get_home_url().'/?page_id='.$frontpage_ID ;
		 return $link;
	 }
	 elseif(is_page()){
		$pageid = get_the_ID();
		 $link = get_home_url().'/?page_id='.$pageid ;
		 return $link;
	 }
	 else{
		 $link = $_SERVER['REQUEST_URI'];
		 //$link = get_home_url();
		 return $link;
	 }
	 
	 
 }
 add_shortcode('get_url','get_url_shortcode');