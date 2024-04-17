<?php
global $wpdb;
require_once('wp-load.php');
array("success" => true, "userid"=>"",  "message" => "");
$face_id=$_POST['id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$device_token = $_POST['google_token'];
$password=wp_generate_password('12', true, false);
$user = get_user_by( 'email', $email);
$user_block=get_user_meta($user_id,'user_block_status',true);
	
$username= $firstname.''.$lastname;
$user_id = username_exists($username);
if (!$user_id && email_exists($email) == false) {
$i = 1;
// $profilepicture = $_FILES['pic_url'];
// if($profilepicture!=""){
		$user_id = wp_create_user($email, $password, $email);
		$time = time();
		$string = $user_id.'-'.$user_email.$time;
		// $generate_key= base64_encode($string);
		update_user_meta($user_id, 'first_name', $firstname);
		update_user_meta($user_id, 'last_name', $lastname);
		update_user_meta($user_id, 'user_block_status', '0');
		update_user_meta($user_id, 'user_active_status', '0');
		// update_user_meta($user_id, 'user_token_key', $generate_key);
		// update_user_meta($user_id, 'user_token_time', $time);
		// update_user_meta($user_id, 'mm_sua_attachment_id', $attach_id );
		// update_user_meta($user_id, 'user_google_device_token', $device_token);
		// update_user_meta($user_id, 'mm_sua_attachment_id', $upload_id );
		if (!is_wp_error($user_id)) {
			$user_array = array();
			$user = get_user_by('id', $user_id);
			$user_login=$user->data->user_login;
			$user_id=$user->data->ID;
			$user_pass=$user->data->user_pass;
			$user_email=$user->data->user_email;
			$user->set_role('Musician');
			// $first_name = get_user_meta($user_id, 'first_name', true);
			// $last_name = get_user_meta($user_id, 'last_name', true);
			// $phonenumber = get_user_meta($user_id, 'phonenumber', true);
			// $user_token_key = get_user_meta($user_id, 'user_token_key', true);
			
			$response['success']=true;
			$response['user_id']=$user_id;
			$response['user_login']=$user_login;
			$response['user_name']=$first_name;
			$response['name'] =$first_name.' '.$last_name;
			$response['isnew']=true;
			$response['profile_updated']=true;
			$response['user_email']=$user_email;
			$response['pic_url']=$url;
			$response['token_id']=$user_token_key;
			$response['message'] = "User " . $username . " Registration was successful";
		}
	// }
}
echo json_encode($response);
?>