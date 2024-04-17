<?php
// wp-json/beesmart/v1/singup/
include_once('send-email.php');
add_action('init', function(){
    register_rest_route('beesmart/v1', '/signup/', array(
        'methods' => 'POST',
        'callback' => 'beesmart_user_signup_meta_callback'
    ));
});
function checkemail_isvalid($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}
function beesmart_user_signup_meta_callback($request){
	global $wpdb;
	$nickname =sanitize_text_field($request->get_param('user_nickname'));
	$user_type =sanitize_text_field($request->get_param('user_type'));
	$language  =sanitize_text_field($request->get_param('language'));
	$countries =sanitize_text_field($request->get_param('countries'));
	$agreement =sanitize_text_field($request->get_param('agreement'));
	$useremail =sanitize_text_field($request->get_param('user_email'));
	$userpass =sanitize_text_field($request->get_param('user_pass'));
	$userconfirm=sanitize_text_field($request->get_param('user_confirm_pass'));
	// Validate password strength
	$uppercase = preg_match('@[A-Z]@', $userpass);
	$lowercase = preg_match('@[a-z]@', $userpass);
	$number    = preg_match('@[0-9]@', $userpass);
	$specialChars = preg_match('@[^\w]@', $userpass);


	if(!checkemail_isvalid($useremail)){
	  $response['status'] =  400;
	  $response['success'] = false;
	  $response['message'] = 'Your Email id is not valid';
	}else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($userpass) < 8){
	  $response['status'] =  400;
	  $response['success'] = false;
	  $response['message'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
	}else if($userpass!=$userconfirm){
	  $response['status'] =  400;
	  $response['success'] = false;
	  $response['message'] = 'Your password is not matching';
	}
	else{
		if($language==""){
			$multiple_language = array('All');
		}else{
			$multiple_language=explode(',',$language);
		}
		if($countries==""){
			$multiple_countries = array('All');
		}else{
			$multiple_countries=explode(',',$countries);
		}
		
		
		 if (username_exists($useremail) == null && email_exists($useremail) == false) {
			// Create the new user
			$user_id = wp_create_user($useremail, $userpass, $useremail);
			if (is_wp_error($user_id)) {
				 $response['status'] =  400;
				 $response['success'] = false;
				 $response['message'] = $user_id->get_error_message();
			}else{
				update_user_meta($user_id, 'nickname', $nickname);
				update_user_meta($user_id, 'account_type', $user_type);
				update_user_meta($user_id, 'languages', $multiple_language);
				update_user_meta($user_id, 'country', $multiple_countries);
				$user = get_user_by('id', $user_id);
				send_email($nickname,'Please activate your email',$useremail);
				$user->add_role('subscriber');
				$response['status'] =  200;
				$response['success'] = true;
				$response['message'] = 'Thanks for creating your account on our website. please confirm your email id';
			}
		}else{
			$response['status'] =  400;
			$response['success'] = false;
			$response['message'] = 'Your account is already registered in our Portal. Try to Login';
		} 
	}
	echo json_encode($response);
}
