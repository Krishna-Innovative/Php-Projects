<?php

add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/list-of-user-meta/', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_user_meta_callback'
    ));
});
// Get user by userId
// /wp-json/beesmart/v1/list-of-user-meta/142
add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/list-of-user-meta/(?P<user_meta_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_user_meta_callback'
    ));
});
function beesmart_get_list_of_user_meta_callback($request){
	global $wpdb;
	$user_meta_id = $request->get_param('user_meta_id');
	//echo $post_meta_id.'dfgtg';
	 if(empty($user_meta_id)){
		  $wp_usermeta = $wpdb->get_results ("SELECT wp_usermeta.user_id,wp_users.user_email,wp_users.display_name FROM wp_users JOIN wp_usermeta WHERE wp_users.ID = wp_usermeta.user_id group by user_id",ARRAY_A);
	 }else{
		  //echo "SELECT wp_usermeta.user_id,wp_users.user_email,wp_users.display_name FROM wp_users JOIN wp_usermeta WHERE wp_users.ID = $user_meta_id group by user_email";
		  $wp_usermeta = $wpdb->get_results ("SELECT * FROM wp_users WHERE wp_users.ID =$user_meta_id",ARRAY_A);
		  //echo '<pre>';print_r($wp_user);
	 }
	 $wp_userdata=array();
		foreach($wp_usermeta as $key=>$wp_user){
		//echo '<pre>';print_r($wp_user);
			$user_id=$wp_user['user_id'];
			 if($user_id==""){
				$user_id=$wp_user['ID'];
			} 
             $meta = get_user_meta($user_id);
            $user_avarar_obj = get_user_meta($user_id, 'user_avatar_url', true);
            $cover_img_obj = get_user_meta($user_id, 'user_cover_image_url', true);
			
			$wp_userdata[$key]['user_id']=$user_id;
			$wp_userdata[$key]['user_email']=$wp_user['user_email'];
			$wp_userdata[$key]['display_name']=$wp_user['display_name'];
			//$wp_userdata[$key]['user_nickname']=$meta['nickname'][0];
			//$wp_userdata[$key]['user_email']= $meta['first_name'][0];
			$wp_userdata[$key]['first_name']= $meta['last_name'][0];
			$wp_userdata[$key]['description']= $meta['description'][0];
			$wp_userdata[$key]['is_user_verified']= $meta['_um_verified'][0];
			$wp_userdata[$key]['account_status']= $meta['account_status'][0];
			$wp_userdata[$key]['mycred_default']= $meta['mycred_default'][0];
			$wp_userdata[$key]['reviews_avg']= $meta['_reviews_avg'][0];
			$wp_userdata[$key]['reviews_total']= $meta['_reviews_total'][0];
			$wp_userdata[$key]['user_type']= $meta['account_type'][0];
			$wp_userdata[$key]['avatar_data']['user_avatar']= get_response($user_avarar_obj['link']);
			$wp_userdata[$key]['avatar_data']['avatar_position']= $user_avarar_obj['position'];
			$wp_userdata[$key]['cover_image_data']['user_avatar']= get_response($cover_img_obj['link']);
			$wp_userdata[$key]['cover_image_data']['avatar_position']= $cover_img_obj['position']; 
		}
			
	 if(count($wp_usermeta) > 0){
			$response['status'] =  200;
			$response['success'] = true;
			$response['data'] = $wp_userdata;
		}else{
			$response['status'] =  400;
			$response['success'] = false;
			$response['message'] = 'No user data Founds!';
		}
	 
	echo json_encode($response);
}
function get_response($image_url){
	$headers = array(
	  'Content-Type: application/json',
	  'Access-Control-Allow-Origin: *',
	  'Authorization: Basic XXXXXXXXX'
	  );
	$url = "https://iframe.ly/api/oembed?url=$image_url&api_key=f89673623cd4c5df1efbb0";
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	//for debug only!
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$resp = curl_exec($curl);
	curl_close($curl);
	$new_value = json_decode($resp, true); 
	return $new_value['html'];
}