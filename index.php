<?php
/*
Plugin Name: Candor Framework
Plugin URI: https://github.com/jeweltheme/candor-framework
Description: Candor Framework - The Leading Force Behind <a href="https://jeweltheme.com" target="_blank">Jewel Theme</a> Custom Post Types, Theme Options and Functions, Meta Boxes etc.
Version: 1.2.5
Author: Jewel Theme
Author URI: https://www.jeweltheme.com
*/	

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'CANDOR_FRAMEWORK_PATH', trailingslashit(plugin_dir_path(__FILE__)) );
define( 'CANDOR_FRAMEWORK_VERSION', '1.0.0');


/**
 * Styles & Scripts
 */
if(!( function_exists('candor_framework_admin_load_scripts') )){
	function candor_framework_admin_load_scripts(){
		wp_enqueue_style('candor_framework_font_awesome', plugins_url( '/css/font-awesome.min.css' , __FILE__ ) );
		wp_enqueue_style('candor_framework_admin_css', plugins_url( '/css/candor-framework-admin.css' , __FILE__ ) );
		wp_enqueue_script('candor_framework_admin_js', plugins_url( '/js/candor-framework-admin.js' , __FILE__ ) );
	}
	add_action('admin_enqueue_scripts', 'candor_framework_admin_load_scripts', 200);
}


/**
*
* Custom Post Types
*/
require_once( CANDOR_FRAMEWORK_PATH . 'candor_cpt.php' );


/**
*
* Grab All Generic Functions
*/
require_once( CANDOR_FRAMEWORK_PATH . 'candor_functions.php' );

/**
 * Everything else in the framework is conditionally loaded depending on theme options.
 * Let's include all of that now.
 */
require_once( CANDOR_FRAMEWORK_PATH . 'init.php' );


/**
 * BootStrap Navwalker
 */
require_once( CANDOR_FRAMEWORK_PATH . 'lib/navwalker.php' );



// remove update notice for forked plugins
function candor_remove_update_notifications( $value ) {

    if ( isset( $value ) && is_object( $value ) ) {
        unset( $value->response[ 'candor-framework/index.php' ] );
    }

    return $value;
}
add_filter( 'site_transient_update_plugins', 'candor_remove_update_notifications' );
