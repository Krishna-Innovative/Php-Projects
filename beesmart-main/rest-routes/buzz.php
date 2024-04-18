<?php
add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/list-of-buzz/', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_buzz_callback'
    ));
});
add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/list-of-buzz/(?P<user_meta_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_buzz_callback'
    ));
});
function beesmart_get_list_of_buzz_callback($request){
	global $wpdb;
	$user_meta_id = $request->get_param('user_meta_id');
	if(empty($user_meta_id)){
		$um_buzz_data = $wpdb->get_results ("SELECT * FROM `wp_posts` WHERE `post_type` = 'um_review' AND `post_status` = 'publish'",ARRAY_A);
	}else{
		$um_buzz_data = $wpdb->get_results ("SELECT * FROM `wp_posts` WHERE `post_type` = 'um_review' AND `post_status` = 'publish' AND `post_author`=4",ARRAY_A);
	}
	$um_buzz_listing=array();
	foreach($um_buzz_data as $key=>$buzz_data){
		$buzz_id=$buzz_data['ID'];
		$_reviewer_id=get_post_meta($buzz_id,'_reviewer_id',true);
		$wp_usermeta = $wpdb->get_results ("SELECT * FROM wp_users WHERE wp_users.ID =$_reviewer_id",ARRAY_A);
		foreach($wp_usermeta as $key_user=>$wp_user){
			$user_id=$wp_user['user_id'];
			if($user_id==""){
				$user_id=$wp_user['ID'];
			} 
            $meta = get_user_meta($user_id);
            $user_avarar_obj = get_user_meta($user_id, 'user_avatar_url', true);
            $cover_img_obj = get_user_meta($user_id, 'user_cover_image_url', true);
			$get_user_avatar=get_buzz_response($user_avarar_obj['link']);
			if($get_user_avatar['html']==""){
				$image_name=get_template_directory_uri().'/assets/images/giphy.gif';
				$final_data=get_buzz_response($image_name);
			}else{
				$final_data=$get_user_avatar;
			}
			$get_cover_img_obj=get_buzz_response($cover_img_obj['link']);
			if($get_cover_img_obj['html']==""){
				$image_name=get_template_directory_uri().'/assets/images/giphy.gif';
				$cover_image=get_buzz_response($image_name);
			}else{
				$cover_image=$get_cover_img_obj;
			}
			$wp_userdata[$key_user]['user_id']=$user_id;
			$wp_userdata[$key_user]['user_email']=$wp_user['user_email'];
			$wp_userdata[$key_user]['display_name']=$wp_user['display_name'];
			$wp_userdata[$key_user]['first_name']= $meta['last_name'][0];
			$wp_userdata[$key_user]['description']= $meta['description'][0];
			$wp_userdata[$key_user]['is_user_verified']= $meta['_um_verified'][0];
			$wp_userdata[$key_user]['account_status']= $meta['account_status'][0];
			$wp_userdata[$key_user]['mycred_default']= $meta['mycred_default'][0];
			$wp_userdata[$key_user]['reviews_avg']= $meta['_reviews_avg'][0];
			$wp_userdata[$key_user]['reviews_total']= $meta['_reviews_total'][0];
			$wp_userdata[$key_user]['user_type']= $meta['account_type'][0];
			$wp_userdata[$key_user]['avatar_data']['user_avatar']= $final_data;
			$wp_userdata[$key_user]['avatar_data']['avatar_position']= $user_avarar_obj['position'];
			$wp_userdata[$key_user]['cover_image_data']['user_avatar']= $cover_image;
			$wp_userdata[$key_user]['cover_image_data']['avatar_position']= $cover_img_obj['position']; 
		}
		$_user_id=get_post_meta($buzz_id,'_user_id',true);
		$_rating=get_post_meta($buzz_id,'_rating',true);
		$um_buzz_listing[$key]['review_title']=$buzz_data['post_title'];
		$um_buzz_listing[$key]['review_content']=strip_tags($buzz_data['post_content']);
		$um_buzz_listing[$key]['post_user_id']=$_user_id;
		$um_buzz_listing[$key]['reviewer_id']=$_reviewer_id;
		$um_buzz_listing[$key]['reviewer_rating']=$_rating;
		$um_buzz_listing[$key]['user_data']=$wp_userdata;
	}
	if(count($um_buzz_data) > 0){
		$response['status'] =  200;
		$response['success'] = true;
		$response['data'] = $um_buzz_listing;
	}else{
		$response['status'] =  400;
		$response['success'] = false;
		$response['message'] = 'No review data Founds!';
	}
	echo json_encode($response);
}
function get_buzz_response($image_url){
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
?>