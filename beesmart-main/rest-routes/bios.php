<?php
// https://beesmartstg.wpengine.com/wp-json/beesmart/v1/bio-data/142
// https://beesmart.local/wp-json/beesmart/v1/bio-data/142

add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/bio-data/', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_bio_callback'
    ));
});
add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/bio-data/(?P<user_meta_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_bio_callback'
    ));
});

function beesmart_get_list_of_bio_callback($request){
	global $wpdb;
	$user_meta_id = $request->get_param('user_meta_id');
	if(empty($user_meta_id)){
		$um_bio_data = $wpdb->get_results ("SELECT * FROM `wp_posts` WHERE `post_type` = 'info' AND `post_status` = 'publish' AND post_author!=0",ARRAY_A);
	}else{
		$um_bio_data = $wpdb->get_results ("SELECT * FROM `wp_posts` WHERE `post_type` = 'info' AND `post_status` = 'publish' AND post_author=$user_meta_id limit 4",ARRAY_A);
	}
	$um_bio_info=array();
	$headers = array(
		  'Content-Type: application/json',
		  'Access-Control-Allow-Origin: *',
		  'Authorization: Basic XXXXXXXXX'
		);
	foreach($um_bio_data as $key=>$list_of_bio_info){
		
			$bio_id=$list_of_bio_info['ID'];
			$bio_post_author=$list_of_bio_info['post_author'];
			$image_link=get_post_meta($bio_id,'image_by_url',true);
			$get_value=curl_method($image_link);
			if($get_value['html']==""){
				$image_name=get_template_directory_uri().'/assets/images/giphy.gif';
				$final_data=curl_method($image_name);
			}else{
				$final_data=$get_value;
			}
			$category_sections=get_post_meta($bio_id,'category_sections',true);
			$um_bio_info[$key]['info_post_id']=$list_of_bio_info['ID'];
			$um_bio_info[$key]['info_post_author']=$bio_post_author;
			$um_bio_info[$key]['post_title']=$list_of_bio_info['post_title'];
			$um_bio_info[$key]['post_content']=$list_of_bio_info['post_content'];
			$um_bio_info[$key]['post_link']=$list_of_bio_info['guid'];
			$um_bio_info[$key]['post_date']=$list_of_bio_info['post_date'];
			$um_bio_info[$key]['post_image_link']=$final_data;
			$um_bio_info[$key]['post_category_name']=$category_sections;
	}
	if(count($um_bio_data) > 0){
		$response['status'] =  200;
		$response['success'] = true;
		$response['data'] = $um_bio_info;
	}else{
		$response['status'] =  400;
		$response['success'] = false;
		$response['message'] = 'No Bio data Founds!';
	}
	echo json_encode($response);
}
function curl_method($image_link){
	$url = "https://iframe.ly/api/oembed?url=$image_link&api_key=f89673623cd4c5df1efbb0";
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
	return $new_value;
	
}