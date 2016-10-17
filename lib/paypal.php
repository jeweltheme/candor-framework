<?php

if( !function_exists('elevation_paypal_form') ){
	function elevation_paypal_form($atts){
		extract( shortcode_atts(array('user'=>'', 
			'action'=>'https://www.paypal.com/cgi-bin/webscr',
			'val_1'=>'10', 'val_2'=>'20', 'val_3'=>'30', 
			'currency_format'=>'$NUMBER', 'currency_code'=>'USD'), $atts) );
		
		ob_start();
?>
<div class="elevation-paypal-form-wrapper">
	<h3 class="elevation-paypal-form-head"><?php echo __('You are donating to :','elevation') . ' <span>' . get_the_title() . '</span>'; ?></h3>
	<form class="elevation-paypal-form" action="<?php echo $action; ?>" method="post" data-ajax="<?php echo AJAX_URL; ?>" >
		<div class="elevation-paypal-amount-wrapper">
			<span class="elevation-head"><?php echo __('How much would you like to donate?', 'elevation'); ?></span>
			<a class="elevation-amount-button active" data-val="<?php echo $val_1; ?>"><?php echo elevation_cause_money_format($val_1, 0, $currency_format); ?></a>
			<a class="elevation-amount-button" data-val="<?php echo $val_2; ?>"><?php echo elevation_cause_money_format($val_2, 0, $currency_format); ?></a>
			<a class="elevation-amount-button" data-val="<?php echo $val_3; ?>"><?php echo elevation_cause_money_format($val_3, 0, $currency_format); ?></a>
			<input type="text" class="custom-amount" placeholder="<?php echo __('Or Your Amount', 'elevation') . '(' . $currency_code . ')'; ?>" />
			<div class="clear"></div>
			
			<!-- recurring-1 -->
			<div class="elevation-recurring-payment-wrapper">
				<span class="elevation-head"><?php echo __('Would you like to make regular donations?', 'elevation'); ?></span>
				<span class="elevation-subhead"><?php echo __('I would like to make ', 'elevation'); ?></span>
				<select name="t3" class="elevation-recurring-option" >
					<option value="0"><?php _e('a one time', 'elevation'); ?></option>
					<option value="W"><?php _e('weekly', 'elevation'); ?></option>
					<option value="M"><?php _e('monthly', 'elevation'); ?></option>
					<option value="Y"><?php _e('yearly', 'elevation'); ?></option>
				</select>
				<span class="elevation-subhead" ><?php echo __(' donation(s)', 'elevation'); ?></span>
				
				<div class="elevation-recurring-time-wrapper">
					<span class="elevation-subhead" ><?php echo __('How many times would you like this to recur? (including this payment)*', 'elevation'); ?></span>
					<select name="p3" class="elevation-recurring-option">
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
				</div>
			</div>
			<!-- recurring-2 -->	
			
		</div>
		<div class="elevation-paypal-fields">

				<div class="col-md-6"><span class="elevation-head"><?php echo __('Name *', 'elevation'); ?></span>
					<input class="elevation-require" type="text" name="elevation-name">
				</div>
				<div class="col-md-6"><span class="elevation-head"><?php echo __('Last Name *', 'elevation'); ?></span>
					<input class="elevation-require" type="text" name="elevation-last-name">
				</div>
				<div class="clear"></div>
				<div class="col-md-6"><span class="elevation-head"><?php echo __('Email *', 'elevation'); ?></span>
					<input class="elevation-require elevation-email" type="text" name="elevation-email">
				</div>
				<div class="col-md-6"><span class="elevation-head"><?php echo __('Phone', 'elevation'); ?></span>
					<input type="text" name="elevation-phone">
				</div>		
				<div class="clear"></div>
				<div class="col-md-6"><span class="elevation-head"><?php echo __('Address', 'elevation'); ?></span>
					<textarea name="elevation-address"></textarea>
				</div>
				<div class="col-md-6"><span class="elevation-head"><?php echo __('Additional Note', 'elevation'); ?></span>
					<textarea name="elevation-additional-note"></textarea>
				</div>		
				<div class="clear"></div>

		</div>
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="<?php echo $user; ?>">
		<input type="hidden" name="item_name" value="<?php echo get_the_title(); ?>">
		<input type="hidden" name="item_number" value="<?php echo get_the_ID(); ?>">
		<input type="hidden" name="amount" value="<?php echo $val_1; ?>">    
		<input type="hidden" name="return" value="<?php echo get_permalink(); ?>">
		
		<!-- recurring-1 -->
		<input type="hidden" name="a3" value="<?php echo $val_1; ?>">
		<input type="hidden" name="amount" value="<?php echo $val_1; ?>">
		<input type="hidden" name="src" value="1">
		<input type="hidden" name="sra" value="1">
		<!-- recurring-2 -->
		
		<input type="hidden" name="no_shipping" value="0">
		<input type="hidden" name="no_note" value="1">
		<input type="hidden" name="currency_code" value="<?php echo $currency_code; ?>">
		<input type="hidden" name="lc" value="AU">
		<input type="hidden" name="bn" value="PP-BuyNowBF">
		<input type="hidden" name="action" value="save_paypal_form">
		<input type="hidden" name="security" value="<?php echo wp_create_nonce('elevation-paypal-create-nonce'); ?>">
		<div class="elevation-notice email-invalid" ><?php echo __('Invalid Email Address ', 'elevation'); ?></div>
		<div class="elevation-notice require-field" ><?php echo __('Please fill all required fields', 'elevation'); ?></div>
		<div class="elevation-notice alert-message" ></div>
		<div class="elevation-paypal-loader" ></div>
		<input type="submit" value="donate" >
	</form>
</div>

<!-- recurring-1 -->
<script type="text/javascript">
	jQuery(document).ready(function($){

		$('select[name="t3"]').change(function(){
			$selVal = $(this).val();

			if( $selVal == 0 ){
				$('input[name="cmd"]').val('_xclick');
				$('input[name="bn"]').val('PP-BuyNowBF');
				$('.elevation-recurring-time-wrapper').slideUp();
			} else {
				$html = '';
				$('select[name="p3"]').empty();
				$year_array = new Array();
				if( $selVal == 'Y' ){
					$year_array[2] = 2;
					$year_array[3] = 3;
					$year_array[4] = 4;
					$year_array[5] = 5;
				} else {
					$year_array[2] = 2;
					$year_array[3] = 3;
					$year_array[4] = 4;
					$year_array[5] = 5;
					$year_array[6] = 6;
					$year_array[7] = 7;
					$year_array[8] = 8;
					$year_array[9] = 9;
					$year_array[10] = 10;
					$year_array[11] = 11;
					$year_array[12] = 12;
				}
				$.each( $year_array, function( index, value ){
					if( index != 1 && index != 0 ){
						$html += '<option value="'+index+'">'+value+'</option>';  	
					}
				});

				$('select[name="p3"]').append($html);
				$('input[name="cmd"]').val('_xclick-subscriptions');
				$('input[name="bn"]').val('PP-SubscriptionsBF:btn_subscribeCC_LG.gif:NonHosted');				
				$('.elevation-recurring-time-wrapper').slideDown();
			}

		});

	});
</script>
<!-- recurring-2 -->
<?php	
		$ret = ob_get_contents();
		ob_end_clean();
		
		return $ret;
	}	
}

// ajax to save form data
add_action( 'wp_ajax_save_paypal_form', 'gdlr_save_paypal_form' );
add_action( 'wp_ajax_nopriv_save_paypal_form', 'gdlr_save_paypal_form' );
if( !function_exists('gdlr_save_paypal_form') ){
	function gdlr_save_paypal_form(){
		$ret = array();
		if( !check_ajax_referer('elevation-paypal-create-nonce', 'security', false) ){
			$ret['status'] = 'failed'; 
			$ret['message'] = __('Invalid Nonce', 'elevation');
		}else{
			$record = get_option('elevation_paypal',array());
			$item_id = sizeof($record); 

			$record[$item_id]['name'] = $_POST['elevation-name'];
			$record[$item_id]['last-name'] = $_POST['elevation-last-name'];
			$record[$item_id]['email'] = $_POST['elevation-email'];
			$record[$item_id]['phone'] = $_POST['elevation-phone'];
			$record[$item_id]['address'] = $_POST['elevation-address'];
			$record[$item_id]['addition'] = $_POST['elevation-additional-note'];
			$record[$item_id]['post-id'] = $_POST['item_number'];
			
			$ret['status'] = 'success'; 
			$ret['message'] = __('Redirecting to paypal', 'elevation');
			$ret['item_number'] = $item_id;
			
			update_option('elevation_paypal',$record);
		}
		die(json_encode($ret));
	}
}

if( isset($_GET['paypal']) ){
	// STEP 1: read POST data
	 
	// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
	// Instead, read raw POST data from the input stream. 
	$raw_post_data = file_get_contents('php://input');
	$raw_post_array = explode('&', $raw_post_data);
	$myPost = array();
	foreach ($raw_post_array as $keyval) {
	  $keyval = explode ('=', $keyval);
	  if (count($keyval) == 2)
		 $myPost[$keyval[0]] = urldecode($keyval[1]);
	}
	// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
	$req = 'cmd=_notify-validate';
	if(function_exists('get_magic_quotes_gpc')) {
	   $get_magic_quotes_exists = true;
	} 
	foreach ($myPost as $key => $value) {        
	   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
			$value = urlencode(stripslashes($value)); 
	   } else {
			$value = urlencode($value);
	   }
	   $req .= "&$key=$value";
	}
	 
	 
	// Step 2: POST IPN data back to PayPal to validate
	$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
	 
	if( !($res = curl_exec($ch)) ) {
		curl_close($ch);
		exit;
	}
	// update_option('elevation_paypal', '1:' . $ret . ':2:' . curl_error($ch));
	// update_option('elevation_paypal', $_POST);
	curl_close($ch);
	
	// inspect IPN validation result and act accordingly
	if( empty($res) || strcmp ($res, "VERIFIED") == 0 ) {
		global $elevation_options;
		$recipient = empty($elevation_options['cause_recipient_name'])? 'ORGANIZATION_NAME': $elevation_options['cause_recipient_name'];
	
		$record = get_option('elevation_paypal', array());
		$num = $_POST['item_number'];
		$record[$num]['status'] = $_POST['payment_status'];
		$record[$num]['txn_id'] = $_POST['txn_id'];
		$record[$num]['amount'] = $_POST['mc_gross'] . ' ' . $_POST['mc_currency'];
		
		$item_name = $_POST['item_name'];
		

		
		
		if( $_POST['payment_status'] == 'Completed' ){
			// update the post value
			$temp_option = json_decode(get_post_meta($record[$num]['post-id'], 'post-option', true), true);
			if( !empty($temp_option) ){
				$temp_goal = floatval($temp_option['goal-of-donation']);
				$temp_current = floatval($temp_option['current-funding']) + floatval($record[$num]['amount']);

				$temp_option['current-funding'] = $temp_current;
				$temp_option = json_encode($temp_option);
				update_post_meta($record[$num]['post-id'], 'post-option', $temp_option);
				
				if(!empty($temp_current)){
					update_post_meta($record[$num]['post-id'], 'elevation-current-funding', $temp_current);
				}
				
				if(!empty($temp_goal)){
					$temp_percent = intval(($temp_current / $temp_goal)*100); 
					update_post_meta($record[$num]['post-id'], 'elevation-donation-percent', $temp_percent);
				}				
			}
			
		
			// send the mail
			$headers  = 'From: ' . $recipient . ' <' . $_POST['receiver_email'] . '>' . "\r\n";
			$message  = __('Thank you very much for your donation to', 'elevation') . ' ' . $_POST['item_name'] . "\r\n";
			$message .= __('Below are the details of your donation.', 'elevation') . ' ' . $_POST['item_name'] . "\r\n";
			$message .= __('Name of Recipient :', 'elevation') . ' ' . $_POST['receiver_email'] . "\r\n";
			$message .= __('Name :', 'elevation') . ' ' . $record[$num]['name'] . ' ' . $record[$num]['last-name'] . "\r\n";
			$message .= __('Date :', 'elevation') . ' ' . $_POST['payment_date'] . "\r\n";
			$message .= __('Amount :', 'elevation') . ' ' . $record[$num]['amount'] . "\r\n";
			$message .= __('Transaction ID :', 'elevation') . ' ' . $record[$num]['txn_id'] . "\r\n";
			$message .= __('Regards,', 'elevation') . ' ' . $recipient;
	
			if( wp_mail($record[$num]['email'], __('Thank you for your donation', 'elevation'), $message, $headers ) ){
				$record[$num]['mail_status'] = 'complete';
			}else{
				$record[$num]['mail_status'] = 'failed';
			}
			
			$headers  = 'From: ' . $recipient . "\r\n";
			$message  = __('Cause Name :', 'elevation') . ' ' . $_POST['item_name'] . "\r\n";
			$message .= __('Name :', 'elevation') . ' ' . $record[$num]['name'] . ' ' . $record[$num]['last-name'] . "\r\n";
			$message .= __('Email :', 'elevation') . ' ' . $record[$num]['email'] . "\r\n";
			$message .= __('Phone :', 'elevation') . ' ' . $record[$num]['phone'] . "\r\n";
			$message .= __('Address :', 'elevation') . ' ' . $record[$num]['address'] . "\r\n";
			$message .= __('Additional Message :', 'elevation') . ' ' . $record[$num]['addition'] . "\r\n";
			$message .= __('Date :', 'elevation') . ' ' . $_POST['payment_date'] . "\r\n";
			$message .= __('Amount :', 'elevation') . ' ' . $record[$num]['amount'] . "\r\n";
			$message .= __('Transaction ID :', 'elevation') . ' ' . $record[$num]['txn_id'];
	
			if( wp_mail($_POST['receiver_email'], __('You received a new donation', 'elevation'), $message, $headers ) ){
				$record[$num]['notify_status'] = 'complete';
			}else{
				$record[$num]['notify_status'] = 'failed';
			}			
		}
		update_option('elevation_paypal', $record);
	}else if( strcmp ($res, "INVALID") == 0 ){
		echo "The response from IPN was: " . $res;
	}
}else if( isset($_GET['paypal_print']) && is_user_logged_in() ){
	print_r(get_option('elevation_paypal', array()));
	die();
}else if( isset($_GET['paypal_clear']) && is_user_logged_in() ){
	delete_option('elevation_paypal');
	echo 'Option Deleted';
	die();
}
?>