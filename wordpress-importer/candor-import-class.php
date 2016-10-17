<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class candor_wp_import extends WP_Import
{
	function set_menus()
	{
		global $candor_config;
		//get all registered menu locations
		$locations   = get_theme_mod('nav_menu_locations');
		
		//get all created menus
		$candor_menus  = wp_get_nav_menus();
		
		if(!empty($candor_menus) && !empty($candor_config['nav_menus']))
		{
			foreach($candor_menus as $candor_menu)
			{
				//check if we got a menu that corresponds to the Menu name array ($candor_config['nav_menus']) we have set in functions.php
				if(is_object($candor_menu) && in_array($candor_menu->name, $candor_config['nav_menus']))
				{
					$key = array_search($candor_menu->name, $candor_config['nav_menus']);
					if($key)
					{
						//if we have found a menu with the correct menu name apply the id to the menu location
						$locations[$key] = $candor_menu->term_id;
					}
				}
			}
		}
		//update the theme
		set_theme_mod( 'nav_menu_locations', $locations);
	}
}