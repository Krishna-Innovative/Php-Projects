<?php
// beesmart.local/wp-json/beesmart/v1/list-of-feed/142
add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/list-of-feed/(?P<user_meta_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_feed_callback'
    ));
});
add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/list-of-feed/', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_feed_callback'
    ));
});
function beesmart_get_list_feed_callback($request){
	global $wpdb;
	$user_meta_id = $request->get_param('user_meta_id');
	if(empty($user_meta_id)){
		$users = get_users( array( 'fields' => array( 'ID' ) ) );
		$listing_of_feeds=array();
		foreach($users as $user){
			 $listing_of_feed=get_user_meta($user->ID, 'beesmart-filter-feed-options', true);
			 foreach($listing_of_feed as $single_user_listing){
				$listing_of_feeds[]=$single_user_listing;
			}
		}
	}else{
		$listing_of_feeds=get_user_meta($user_meta_id, 'beesmart-filter-feed-options', true);
	}
	$list_of_feed=array();
	//echo '<pre>';print_r($listing_of_feeds);echo '<pre>';
	foreach($listing_of_feeds as $single_user_listing){
		$list_of_feed['feed_listing'][]=$single_user_listing;
	}
	if(count($listing_of_feeds) > 0){
		$response['status'] =  200;
		$response['success'] = true;
		$response['data'] = $list_of_feed;
	}else{
		$response['status'] =  400;
		$response['success'] = false;
		$response['message'] = 'No Feed data Founds!';
	}
	echo json_encode($response);
}