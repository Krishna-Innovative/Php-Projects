<?php
// beesmart.local/wp-json/beesmart/v1/list-of-friends/36
add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'list-of-friends', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_friends_callback'
    ));
});
add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'list-of-friends/(?P<user_meta_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_friends_callback'
    ));
});
function beesmart_get_list_of_friends_callback($request){
	global $wpdb;
	$user_meta_id = $request->get_param('user_meta_id');
	if(empty($user_meta_id)){
		$um_friends = $wpdb->get_results ("SELECT * FROM `wp_um_friends`",ARRAY_A);
	}else{
		$um_friends = $wpdb->get_results ("SELECT * FROM `wp_um_friends` where `user_id1` = $user_meta_id",ARRAY_A);
	}
	$um_friends_list=array();
	foreach($um_friends as $key=>$list_of_um_friends){
		$um_friends_list[$key]['set_friend_id']=$list_of_um_friends['id'];
		$um_friends_list[$key]['set_friend_id1']=$list_of_um_friends['user_id1'];
		$um_friends_list[$key]['set_friend_id2']=$list_of_um_friends['user_id2'];
		$um_friends_list[$key]['set_status']=$list_of_um_friends['status'];
		$um_friends_list[$key]['set_created_at']=$list_of_um_friends['time'];
	}
	if(count($um_friends) > 0){
		$response['status'] =  200;
		$response['success'] = true;
		$response['data'] = $um_friends_list;
	}else{
		$response['status'] =  400;
		$response['success'] = false;
		$response['message'] = 'No Friends data Founds!';
	}
	echo json_encode($response);
}