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


// Twitter API
//require_once( CANDOR_FRAMEWORK_PATH . 'lib/twitter/setup.php' );
//require_once( CANDOR_FRAMEWORK_PATH . 'lib/twitter/get_tweets.php' );




/**
 * candor_ajax_import_data
 * 
 * Use this to auto import a demo-data.xml for the theme.
 * demo-data.xml must be in your active theme root folder, you should also copy this into a child theme if you supply one.
 * 
 * @author Jewel Theme
 * @since v1.0.0
 */
if(!( function_exists('candor_ajax_import_data') )){
	function candor_ajax_import_data() {				
		require_once( CANDOR_FRAMEWORK_PATH . 'wordpress-importer/demo_import.php' );
		die('ebor_import');
	}
	add_action('wp_ajax_candor_ajax_import_data', 'candor_ajax_import_data');
}



/**
 * Plugin Updates
 * This plugin updates from wp-updates.com
 * 
 * @author Jewel Theme
 * @since v1.0.0
 */
require_once(CANDOR_FRAMEWORK_PATH . 'wp-updates-plugin.php');
new WPUpdatesPluginUpdater_745( 'http://wp-updates.com/api/2/plugin', plugin_basename(__FILE__));