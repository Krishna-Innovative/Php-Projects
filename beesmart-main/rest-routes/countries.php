<?php
add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'get-country', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_country_callback'
    ));
});
function beesmart_get_country_callback(){
	global $wpdb;
	$list_of_country = $wpdb->get_results ("SELECT * FROM `country`",ARRAY_A);
	$country_list=array();
	foreach($list_of_country as $key=>$country_list_data){
		$country_list[$key]['country_id']=$country_list_data['countrycode'];
		$country_list[$key]['countrycode']=$country_list_data['countrycode'];
		$country_list[$key]['countryname']=$country_list_data['countryname'];
		$country_list[$key]['code']=$country_list_data['code'];
	}
	if(count($list_of_country) > 0){
		$response['status'] =  200;
		$response['success'] = true;
		$response['data'] = $country_list;
	}else{
		$response['status'] =  404;
		$response['success'] = false;
		$response['message'] = 'No country data Founds!';
	}
	echo json_encode($response); 
}