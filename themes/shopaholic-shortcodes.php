<?php

// wishlist
//if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) || is_plugin_active( 'yith-woocommerce-compare/init.php' ) ){
	add_action( 'woocommerce_after_single_variation', 'shopaholic_add_wishlist_variation', 10 );
	add_action( 'woocommerce_single_product_summary', 'shopaholic_before_addcart', 28);
	//add_action( 'woocommerce_after_add_to_cart_button', 'shopaholic_after_addcart', 38);
	add_action('woocommerce_after_shop_loop_item','shopaholic_add_loop_compare_link', 20);
	add_action( 'woocommerce_after_shop_loop_item', 'shopaholic_add_loop_wishlist_link', 25 );
	add_action( 'woocommerce_after_add_to_cart_button', 'shopaholic_add_wishlist_link', 10);
	function shopaholic_before_addcart(){
		echo '<div class="product-summary-bottom clearfix">';
	}
	function shopaholic_after_addcart(){
		echo '</div>';
	}
	function shopaholic_add_loop_compare_link(){
		if( is_plugin_active( 'yith-woocommerce-compare/init.php' ) ){
			$yith_compare = new YITH_Woocompare_Frontend();
			add_shortcode( 'yith_compare_button', array( $yith_compare , 'compare_button_sc' ) );
			echo do_shortcode("[yith_compare_button]");						
		}
	}
	function shopaholic_add_loop_wishlist_link(){
		if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ){
			echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
		}
	}
	function shopaholic_add_wishlist_link(){
		global $product;
		if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) && is_plugin_active( 'yith-woocommerce-compare/init.php' ) ){
			$yith_compare = new YITH_Woocompare_Frontend();
			add_shortcode( 'yith_compare_button', array( $yith_compare , 'compare_button_sc' ) );
			if( $product->product_type != 'variable' ){
				
				echo do_shortcode( "[yith_compare_button]" );
				echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
				
			}else{
				return ;
			}
		}
	}
	function shopaholic_add_wishlist_variation(){	
		if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) && is_plugin_active( 'yith-woocommerce-compare/init.php' ) ){
			$yith_compare = new YITH_Woocompare_Frontend();
			add_shortcode( 'yith_compare_button', array( $yith_compare , 'compare_button_sc' ) );

			echo do_shortcode( "[yith_compare_button]" );
			echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
		}
	}
//}



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
