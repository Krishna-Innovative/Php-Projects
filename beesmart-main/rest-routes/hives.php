<?php
/**
 * 
 */
// beesmart.local/wp-json/beesmart/v1/list-of-hive/142
add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'list-of-hive', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_hive_callback'
    ));
});
// /wp-json/beesmart/v1/list-of-hive/{id}/
add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/list-of-hive/(?P<user_meta_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_hive_callback'
    ));
});

function beesmart_get_list_of_hive_callback($request){
	
	global $wpdb;
	$user_meta_id = $request->get_param('user_meta_id');
	if(!empty($user_meta_id)){
		$Hive_listing = $wpdb->get_results("Select wp_users.ID,wp_users.display_name,wp_users.user_nicename,wp_um_followers.user_id1,wp_um_followers.user_id2,wp_um_set_priority_by_follower.follower_cat_id,wp_um_set_priority_by_follower.created_at 
	from wp_users left join wp_um_followers on wp_users.ID =wp_um_followers.user_id2
	inner join wp_um_set_priority_by_follower on (wp_um_followers.user_id1=wp_um_set_priority_by_follower.user_id and wp_um_followers.user_id2=wp_um_set_priority_by_follower.follower_id) Where user_id1=$user_meta_id group by created_at",ARRAY_A);
	
	$created_by_authors = $wpdb->get_results("SELECT * FROM `wp_category_created_by_author` Where author_id=$user_meta_id ORDER BY `author_id`",ARRAY_A);
	}else{
		/*$Hive_listing = $wpdb->get_results("Select wp_users.ID,wp_users.display_name,wp_users.user_nicename,wp_um_set_priority_by_follower.follower_cat_id,wp_um_set_priority_by_follower.created_at 
	from wp_users inner join wp_um_followers on wp_users.ID =wp_um_followers.user_id1  
	inner join wp_um_set_priority_by_follower on wp_um_followers.user_id1=wp_um_set_priority_by_follower.follower_id group by ID",ARRAY_A);*/
	$Hive_listing = $wpdb->get_results("Select wp_users.ID,wp_users.display_name,wp_users.user_nicename,wp_um_followers.user_id1,wp_um_followers.user_id2,wp_um_set_priority_by_follower.follower_cat_id,wp_um_set_priority_by_follower.created_at 
	from wp_users left join wp_um_followers on wp_users.ID =wp_um_followers.user_id2
	inner join wp_um_set_priority_by_follower on (wp_um_followers.user_id1=wp_um_set_priority_by_follower.user_id and wp_um_followers.user_id2=wp_um_set_priority_by_follower.follower_id) group by created_at",ARRAY_A);
		$created_by_authors = $wpdb->get_results("SELECT * FROM `wp_category_created_by_author` ORDER BY `author_id`",ARRAY_A);
	}
	$created_category=array();
		foreach($created_by_authors as $key=>$author_category){
			if($author_category['category_icons']=="" || $author_category['category_icons']=="null" || $author_category['category_icons']==null){
				$_icons='Hives-Sort-later.png';
			}else{
				$_icons=$author_category['category_icons'];
			}
			$category_names=get_cat_name($author_category['category_value']);
			$created_category[$key]['author_category']=$author_category['category_value'];
			$created_category[$key]['author_id']=$author_category['author_id'];
			$created_category[$key]['category_icons']=$_icons;
			$created_category[$key]['category_names']=$category_names;
			$created_category[$key]['position_order']=$author_category['position_order'];
			$created_category[$key]['categorycreated_at']=$author_category['created_at'];
		}
		/*$i = 0;
		$sepr = 0;
		$listed_category = array();
		foreach($created_category as $listed_value) {
			$k = $i; $k = ($k > 0 ? $k-1 : 0);
			foreach($listed_value as $key => $value) {
				if($key == "author_id" && $value != $created_category[$k][$key]) {
					$sepr++;
				}
			}
			$listed_category[$sepr][] = $listed_value;
			$i++;
		}*/
	//	echo '<pre>';print_r($created_category);echo '</pre>';
		$um_Hive_listing=array();
		foreach($Hive_listing as $key=>$list_of_Hive_listing){
			$user_ID=$list_of_Hive_listing['ID'];
			if($list_of_Hive_listing['follower_cat_id']!=""){
				
				$user_avatar=get_user_meta($user_ID,'user_avatar_url',true);
				$um_Hive_listing[$key]['follower_cat_id']=$list_of_Hive_listing['follower_cat_id'];
				$um_Hive_listing[$key]['follower_id']=$list_of_Hive_listing['user_id2'];
				$um_Hive_listing[$key]['user_avatar']=$user_avatar;
				$um_Hive_listing[$key]['user_name']=$list_of_Hive_listing['display_name'];
				$um_Hive_listing[$key]['user_url']=site_url().'/author/'.$list_of_Hive_listing['user_nicename'];
				$new_hive_value=explode(',',$list_of_Hive_listing['follower_cat_id']);
				foreach($new_hive_value as $hive_category){
					if(get_cat_name($hive_category)==""){
						$hive_category_name='Null';
					}else{
						$hive_category_name=get_cat_name($hive_category);
					}
					$um_Hive_listing[$key]['category_name'][]=$hive_category_name;
				}
				$new_array=explode(',',$list_of_Hive_listing['follower_cat_id']);
				 foreach($created_category as $k=>$category_value){
						if(in_array($category_value['author_category'],$new_array)){
							$created_category[$k]['iscategory_true']='true';
						}else{
							$created_category[$k]['iscategory_true']='false';
						}
				 } 
				$um_Hive_listing[$key]['category_image'][]=$created_category;
				$um_Hive_listing[$key]['created_at']=$list_of_Hive_listing['created_at'];
			}
		}
	
	if(count($Hive_listing) > 0){
		$response['status'] =  200;
		$response['success'] = true;
		$response['data'] = $um_Hive_listing;
	}else{
		$response['status'] =  400;
		$response['success'] = false;
		$response['message'] = 'No hive data Founds!';
	}
	echo json_encode($response); 
}


/**
 * CATEGOTIES CREATED BY AUTHOR
 * /wp-json/beesmart/v1/created-category/
 */
add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'created-category', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_created_category_callback'
    ));
});
add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/created-category/(?P<user_meta_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_created_category_callback'
    ));
});
function beesmart_get_created_category_callback($request){
	global $wpdb;
	$user_meta_id = $request->get_param('user_meta_id');
	if(empty($user_meta_id)){
		$created_by_author = $wpdb->get_results ("SELECT * FROM `wp_category_created_by_author`",ARRAY_A);
	}else{
		$created_by_author = $wpdb->get_results ("SELECT * FROM `wp_category_created_by_author` where author_id=$user_meta_id",ARRAY_A);
	}
	
	$created_categories=array();
	foreach($created_by_author as $key=>$list_created_by_author){
		$created_categories[$key]['catgory_id']=$list_created_by_author['id'];
		$created_categories[$key]['category_value']=$list_created_by_author['category_value'];
		$created_categories[$key]['category_author_id']=$list_created_by_author['author_id'];
		$created_categories[$key]['category_icons']=$list_created_by_author['category_icons'];
		$created_categories[$key]['category_position_order']=$list_created_by_author['position_order'];
		$created_categories[$key]['category_visibility']=$list_created_by_author['visibility'];
		$created_categories[$key]['category_created_at']=$list_created_by_author['created_at'];
		$created_categories[$key]['category_names']='title';

	}
	if(count($created_by_author) > 0){
		$response['status'] =  200;
		$response['success'] = true;
		$response['data'] = $created_categories;
		$response['debug'] = 	var_dump($created_by_author);

	}else{
		$response['status'] =  404;
		$response['success'] = false;
		$response['message'] = 'No category data Founds!';
	}
	echo json_encode($response);
}
