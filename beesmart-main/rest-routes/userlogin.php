<?php
// https://beesmartstg.wpengine.com/wp-json/beesmart/v1/bio-data/142
// https://beesmart.local/wp-json/beesmart/v1/bio-data/142

add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/login/', array(
        'methods' => 'POST',
        'callback' => 'beesmart_login_callback'
    ));
});
function email_validation_($email) {
    return (!preg_match(
"^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email))
        ? FALSE : TRUE;
}
function beesmart_login_callback($request){
	global $wpdb;
	$login_email=$_POST['login_email'];
	$login_password=$_POST['login_password'];
	if($login_email==""){
		$response['success'] = 'false';
		$response['message'] = "Email is required";
	}else if($login_password==""){
		$response['success'] = 'false';
		$response['message'] = "Password is required";
	}else if(!email_validation_($login_email)) {
		$response['success'] = 'false';
		$response['message'] = "Invalid email format.";
	}else if(!email_exists($login_email)) {
		$response['success'] = 'false';
		$response['message'] = "Please signin to our website your email is not exist in our website";
	}else{
		$user = get_user_by( 'email', $login_email);
		$login=wp_check_password($login_password, $user->user_pass, $user->ID);
		if(!$login){
		  $response['success'] = false;
		  $response['staus'] = 400;
		  $response['message'] = "Password not correct";
		}else{
			$user_info = array();
			$user_info['user_login'] = $user->user_login;
			$user_info['user_password'] =  $login_password;
			$user_info['remember'] = true;
			$user_login = wp_signon( $user_info, true );
			if (is_wp_error( $user_login )) { 
				$response['success'] = false;
				$response['message'] = $user_login->get_error_message();	
			}else{
				$userID = $user_login->ID;
				$user_name = $user_login->data->user_login;
				$user_email = $user_login->data->user_email;
				wp_set_current_user( $userID, $user_login );
				wp_set_auth_cookie( $userID, true );
				$response['success'] = true;
				$response['staus'] = 200;
				$response['message'] = "Logged in Successfully";	
			}
		}
	}
	echo json_encode($response);
	die;
	
}
