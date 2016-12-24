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







/* User Registration Form*/
function shopaholic_registration_form( $username, $password, $email, $phone, $first_name, $last_name ) {
    echo '
	    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">

	    <p class="form-input">
	    	<input type="text" name="username" placeholder="User Name" value="' . ( isset( $_POST['username'] ) ? $username : null ) . '">
	    </p>
	     
	    <p class="form-input">
	    	<input type="password" name="password" placeholder="Password" value="' . ( isset( $_POST['password'] ) ? $password : null ) . '">
	    </p>
	     
	    <p class="form-input">
	    	<input type="text" name="email" placeholder="Email" value="' . ( isset( $_POST['email']) ? $email : null ) . '">
	    </p>
	     	     
	    <p class="form-input">
	    	<input type="text" name="fname" placeholder="First Name" value="' . ( isset( $_POST['fname']) ? $first_name : null ) . '">
	    </p>
	     
	    <p class="form-input">
	    	<input type="text" name="lname" placeholder="Last Name" value="' . ( isset( $_POST['lname']) ? $last_name : null ) . '">
	    </p>
	     
	    <p class="form-input">
	    	<input type="text" name="phone" placeholder="Phone Number" value="' . ( isset( $_POST['phone']) ? $phone : null ) . '">
	    </p>
	    
	    <p class="checkbox pull-left">
	    	<input name="accept_terms" type="checkbox" class="accept_terms" value="1" checked/> 
	    	' . esc_html__( 'I agree the ', 'shopaholic-wp' ) .'
	    	<a href="' . esc_url( get_permalink(woocommerce_get_page_id('terms')) ) .'" target="_blank">' . esc_html__( 'terms and conditions', 'shopaholic-wp' ) .'</a>
	    </p>

	    <p class="submit-input pull-right">
	    	<input type="submit" name="submit" value="'. esc_html__( 'Sign up', 'shopaholic-wp' ) .'"/>
	    </p>
	    </form>
    ';
}


function shopaholic_registration_validation( $username, $password, $email, $phone, $first_name, $last_name )  {

	global $reg_errors;
	$reg_errors = new WP_Error;

	if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
	    $reg_errors->add('field', 'Required form field is missing');
	}
	if ( 4 > strlen( $username ) ) {
	    $reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
	}
	if ( username_exists( $username ) )
	    $reg_errors->add('user_name', 'Sorry, that username already exists!');

	if ( ! validate_username( $username ) ) {
	    $reg_errors->add( 'username_invalid', 'Sorry, the username you entered is not valid' );
	}
	if ( 5 > strlen( $password ) ) {
	        $reg_errors->add( 'password', 'Password length must be greater than 5' );
	    }
	if ( !is_email( $email ) ) {
	    $reg_errors->add( 'email_invalid', 'Email is not valid' );
	}
	if ( email_exists( $email ) ) {
	    $reg_errors->add( 'email', 'Email Already in use' );
	}

	$phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
	if(strlen($phone) === 10) {
		if ( ! filter_var( $phone, FILTER_VALIDATE_URL ) ) {
			$reg_errors->add( 'phone', 'Phone is not a valid' );
		}
	}
	if ( is_wp_error( $reg_errors ) ) {

		foreach ( $reg_errors->get_error_messages() as $error ) {

			echo '<div>';
			echo '<strong>ERROR</strong>:';
			echo $error . '<br/>';
			echo '</div>';

		}

	}


}


function shopaholic_complete_registration() {
    global $reg_errors, $username, $password, $email, $phone, $first_name, $last_name;
    if ( 1 > count( $reg_errors->get_error_messages() ) ) {
        $userdata = array(
        'user_login'    =>   $username,
        'user_email'    =>   $email,
        'user_pass'     =>   $password,
        'phone' 		=>   $phone,
        'first_name'    =>   $first_name,
        'last_name'     =>   $last_name,
        //'accept_terms'  =>   $accept_terms,
        );
        $user = wp_insert_user( $userdata );
        echo '<div class="success">Registration complete. Go to <a href="' . get_site_url() . '/wp-login.php">login page</a></div>';
    }
}


function shopaholic_custom_registration_function() {
	global $username, $password, $email, $phone, $first_name, $last_name;
    if ( isset($_POST['submit'] ) ) {
        shopaholic_registration_validation(
        $_POST['username'],
        $_POST['password'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['fname'],
        $_POST['lname']
        //$_POST['accept_terms']
        );
         
        // sanitize user form input
        global $username, $password, $email, $phone, $first_name, $last_name;
        $username   =   sanitize_user( $_POST['username'] );
        $password   =   esc_attr( $_POST['password'] );
        $email      =   sanitize_email( $_POST['email'] );
        $phone    	=   sanitize_text_field( $_POST['phone'] );
        $first_name =   sanitize_text_field( $_POST['fname'] );
        $last_name  =   sanitize_text_field( $_POST['lname'] );
        //$accept_terms   =  $_POST['accept_terms'];

        // call @function shopaholic_complete_registration to create the user
        // only when no WP_error is found
        shopaholic_complete_registration(
        $username,
        $password,
        $email,
        $phone,
        $first_name,
        $last_name
        );
    }
 
    shopaholic_registration_form(
        $username,
        $password,
        $email,
        $phone,
        $first_name,
        $last_name
        );
}




function shopaholic_user_contactmethods( $contactmethods ) {
	$contactmethods['twitter_profile'] 	= 'Twitter';
	$contactmethods['facebook_profile'] = 'Facebook';
	$contactmethods['google_profile'] 	= 'Google Plus';
	$contactmethods['dribbble_profile'] = 'Dribbble';
	$contactmethods['linkedin_profile'] = 'Linked In';
	$contactmethods['phone'] 			= 'Phone No.';
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'shopaholic_user_contactmethods' );