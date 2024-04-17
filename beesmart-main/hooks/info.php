<?php 
//Register post type
//
if( !function_exists('bees_info_post_type_callback') ){
    function bees_info_post_type_callback() {
        $args = array(
            'public'    => true,
            'label'     => __( 'info', 'textdomain' ),
            'supports' => [ 'custom-fields',  'title', 'editor' ]
        );
        register_post_type( 'info', $args );
    }
    add_action( 'init', 'bees_info_post_type_callback' );
}
//GET routes
add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/info/', array(
        'methods' => 'GET',
        'callback' => 'beesmart_api_get_callback'

    ));
});
add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/info/(?P<info_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'beesmart_api_get_callback'

    ));
});
//POST
add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/info/create/', array(
        'methods' => 'POST',
        'callback' => 'beesmart_info_post_callback'

    ));
});
add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'list-of-followers', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_followers_callback'
    ));
});
/*add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'get-country', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_country_callback'
    ));
});
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
});*/
add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'set-priority-by-follower', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_set_priority_by_follower_callback'
    ));
});
/* add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'list-of-posts', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_posts_callback'
    ));
});
add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'list-of-post-meta/(?P<post_meta_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_post_meta_callback'
    ));
}); */
add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'list-of-post-meta/', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_post_meta_callback'
    ));
});

/* add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/list-of-user-meta/', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_user_meta_callback'
    ));
});
add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/list-of-user-meta/(?P<user_meta_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_user_meta_callback'
    ));
}); */
/* add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'list-of-user', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_user_callback'
    ));
});
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
add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'list-of-hive/', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_hive_callback'
    ));
});
add_action('init', function(){
    register_rest_route( 'beesmart/v1', '/list-of-hive/(?P<user_meta_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_hive_callback'
    ));
});
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
}); */
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
/* function beesmart_get_followers_callback(){
	global $wpdb;
	$list_of_followers = $wpdb->get_results ("SELECT * FROM `wp_um_followers`",ARRAY_A);
	$follower_id=array();
	foreach($list_of_followers as $key=>$single_user_list){
		$follower_id[$key]['follower_id']=$single_user_list['id'];
		$follower_id[$key]['created_time']=$single_user_list['time'];
		$follower_id[$key]['current_user_id']=$single_user_list['user_id1'];
		$follower_id[$key]['following_id']=$single_user_list['user_id2'];
	}
	if(count($list_of_followers) > 0){
		$response['status'] =  200;
		$response['success'] = true;
		$response['data'] = $follower_id;
	}else{
		$response['status'] =  404;
		$response['success'] = false;
		$response['message'] = 'No Followers Founds!';
	}
	echo json_encode($response);
}

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
function beesmart_get_created_category_callback(){
	global $wpdb;
	$created_by_author = $wpdb->get_results ("SELECT * FROM `wp_category_created_by_author`",ARRAY_A);
	$created_categories=array();
	foreach($created_by_author as $key=>$list_created_by_author){
		$created_categories[$key]['catgory_id']=$list_created_by_author['id'];
		$created_categories[$key]['category_value']=$list_created_by_author['category_value'];
		$created_categories[$key]['category_author_id']=$list_created_by_author['author_id'];
		$created_categories[$key]['category_icons']=$list_created_by_author['category_icons'];
		$created_categories[$key]['category_position_order']=$list_created_by_author['position_order'];
		$created_categories[$key]['category_visibility']=$list_created_by_author['visibility'];
		$created_categories[$key]['category_created_at']=$list_created_by_author['created_at'];
		
	}
	if(count($created_by_author) > 0){
		$response['status'] =  200;
		$response['success'] = true;
		$response['data'] = $created_categories;
	}else{
		$response['status'] =  404;
		$response['success'] = false;
		$response['message'] = 'No category data Founds!';
	}
	echo json_encode($response);
}
function beesmart_get_set_priority_by_follower_callback(){
	global $wpdb;
	$set_priority_follower = $wpdb->get_results ("SELECT * FROM `wp_um_set_priority_by_follower`",ARRAY_A);
	$set_followers=array();
	foreach($set_priority_follower as $key=>$list_of_follower){
		$set_followers[$key]['set_follower_id']=$list_of_follower['id'];
		$set_followers[$key]['set_user_id']=$list_of_follower['user_id'];
		$set_followers[$key]['set_follower_id']=$list_of_follower['follower_id'];
		$set_followers[$key]['set_category_ids']=$list_of_follower['follower_cat_id'];
		$set_followers[$key]['set_created_at ']=$list_of_follower['created_at'];
	}
	if(count($set_priority_follower) > 0){
		$response['status'] =  200;
		$response['success'] = true;
		$response['data'] = $set_followers;
	}else{
		$response['status'] =  404;
		$response['success'] = false;
		$response['message'] = 'No category data Founds!';
	}
	echo json_encode($response);
}
function beesmart_get_list_of_posts_callback(){
	$posts = get_posts( [ 'post_type' => 'beeart', 'post_status' => 'publish' ] );
        if( count($posts) > 0 ){
            $response['status'] =  200;
            $response['success'] = true;
            $response['data'] = $posts;
        }else{
            $response['status'] =  400;
            $response['success'] = false;
            $response['message'] = 'NO posts founds!';
        }
	echo json_encode($response);
}
function beesmart_get_list_of_user_callback(){
	$users = get_users( array( 'fields' => array( 'ID' ) ) );
	$user_listing=array();
	$key=0;
	foreach($users as $user){
	$single_user = get_user_by('id',$user->ID);
    $user_listing[$key]['WPId']           = $user->ID;
    $user_listing[$key]['user_login']      = $single_user->user_login;
    $user_listing[$key]['user_decoding_link'] = $single_user->user_nicename;
    $user_listing[$key]['user_email'] =  $single_user->user_email;
    $user_listing[$key]['user_registered'] = $single_user->user_registered;
	$user_listing[$key]['user_display_name'] = $single_user->display_name;
	$key++;
    }
	if( count($users) > 0 ){
            $response['status'] =  200;
            $response['success'] = true;
            $response['data'] = $user_listing;
        }else{
            $response['status'] =  400;
            $response['success'] = false;
            $response['message'] = 'NO user founds!';
        }
	echo json_encode($response);
	
}
function beesmart_get_list_of_user_meta_callback($request){
	global $wpdb;
	$user_meta_id = $request->get_param('user_meta_id');
	//echo $post_meta_id.'dfgtg';
	 if(empty($user_meta_id)){
		  $wp_usermeta = $wpdb->get_results ("SELECT wp_usermeta.user_id,wp_users.user_email,wp_users.display_name FROM wp_users JOIN wp_usermeta WHERE wp_users.ID = wp_usermeta.user_id group by user_id",ARRAY_A);
	 }else{
		  $wp_usermeta = $wpdb->get_results ("SELECT * FROM wp_users WHERE wp_users.ID =$user_meta_id",ARRAY_A);
	 }
	 $wp_userdata=array();
		foreach($wp_usermeta as $key=>$wp_user){
		
			$user_id=$wp_user['user_id'];
			if($user_id==""){
				$user_id=$wp_user['ID'];
			}
			$wp_userdata[$key]['user_id']=$user_id;
			$wp_userdata[$key]['user_email']=$wp_user['user_email'];
			$wp_userdata[$key]['display_name']=$wp_user['display_name'];
			$wp_userdata[$key]['user_email']=get_user_meta($user_id,'first_name',true);
			$wp_userdata[$key]['first_name']=get_user_meta($user_id,'last_name',true);
			$wp_userdata[$key]['description']=get_user_meta($user_id,'description',true);
			$wp_userdata[$key]['is_user_verified']=get_user_meta($user_id,'_um_verified',true);
			$wp_userdata[$key]['account_status']=get_user_meta($user_id,'account_status',true);
			$wp_userdata[$key]['mycred_default']=get_user_meta($user_id,'mycred_default',true);
			$wp_userdata[$key]['reviews_avg']=get_user_meta($user_id,'_reviews_avg',true);
			$wp_userdata[$key]['reviews_total']=get_user_meta($user_id,'_reviews_total',true);
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
function beesmart_get_list_of_post_meta_callback($request){
	global $wpdb;
	$post_meta_id = $request->get_param('post_meta_id');
	$final_data=date('Y-m-d H:i:m', strtotime('-25 days'));
	$current_data=date('Y-m-d H:i:m');
	if(empty($post_meta_id)){
		$wp_postmeta = $wpdb->get_results ("SELECT wp_posts.post_author,wp_posts.post_date,wp_posts.post_content,wp_posts.post_title,wp_posts.post_name,wp_postmeta.post_id FROM wp_posts JOIN wp_postmeta WHERE wp_posts.ID = wp_postmeta.post_id AND wp_posts.post_type='beeart'  AND wp_posts.post_status='publish' AND post_date > '$final_data' AND post_date < '$current_data' group by post_id",ARRAY_A);
	}else{
		$wp_postmeta = $wpdb->get_results ("SELECT wp_posts.post_author,wp_posts.post_date,wp_posts.post_content,wp_posts.post_title,wp_posts.post_name,wp_postmeta.post_id FROM wp_posts JOIN wp_postmeta WHERE wp_posts.ID = wp_postmeta.post_id AND wp_posts.post_type='beeart'  AND wp_posts.post_status='publish' AND wp_posts.post_author='$post_meta_id' AND post_date > '$final_data' AND post_date < '$current_data' group by post_id",ARRAY_A);
	}
		$wp_postdata=array();
		foreach($wp_postmeta as $key=>$wp_post){
			$post_id=$wp_post['post_id'];
			$f_url=get_post_meta($post_id,'f_url',true);
			$user_type=get_post_meta($post_id,'f_type_of_post_by_user_type',true);
			$f_custom_post_format=get_post_meta($post_id,'f_custom_post_format',true);
			$f_additional_text=get_post_meta($post_id,'f_additional_text',true);
			$f_audience=get_post_meta($post_id,'f_audience',true);
			$f_ticket_cost=get_post_meta($post_id,'f_ticket_cost',true);
			$f_about_me=get_post_meta($post_id,'f_about_me',true);
			$f_im_looking_for=get_post_meta($post_id,'f_im_looking_for',true);
			$f_embed=get_post_meta($post_id,'f_embed',true);
			$f_country=get_post_meta($post_id,'f_country',true);
			$f_language=get_post_meta($post_id,'f_language',true);
			$wp_postdata[$key]['post_id']=$wp_post['post_id'];
			$wp_postdata[$key]['post_author']=$wp_post['post_author'];
			$wp_postdata[$key]['post_date']=$wp_post['post_date'];
			$wp_postdata[$key]['post_content']=$wp_post['post_content'];
			$wp_postdata[$key]['post_title']=$wp_post['post_title'];
			$wp_postdata[$key]['post_name']=$wp_post['post_name'];
			$wp_postdata[$key]['postf_url']=$f_url;
			$wp_postdata[$key]['post_user_type ']=$user_type;
			$wp_postdata[$key]['post_format']=$f_custom_post_format;
			$wp_postdata[$key]['post_f_additional_text']=$f_additional_text;
			$wp_postdata[$key]['post_f_audience']=$f_audience;
			$wp_postdata[$key]['post_ticket_cost']=$f_ticket_cost;
			$wp_postdata[$key]['post_about_me']=$f_about_me;
			$wp_postdata[$key]['post_im_looking_for']=$f_im_looking_for;
			$wp_postdata[$key]['post_embed']=$f_embed;
			$wp_postdata[$key]['post_f_audience']=$f_audience;
			$wp_postdata[$key]['post_country']=$f_country;
			$wp_postdata[$key]['post_language']=$f_language;
		}
		if(count($wp_postmeta) > 0){
			$response['status'] =  200;
			$response['success'] = true;
			$response['data'] = $wp_postdata;
		}else{
			$response['status'] =  400;
			$response['success'] = false;
			$response['message'] = 'No post data Founds!';
		}
	 
	echo json_encode($response);
	
}
function beesmart_get_list_of_friends_callback(){
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
} */
/* function beesmart_get_list_of_hive_callback($request){
	
	global $wpdb;
	$user_meta_id = $request->get_param('user_meta_id');
	if(!empty($user_meta_id)){
		$Hive_listing = $wpdb->get_results("Select wp_users.ID,wp_users.display_name,wp_users.user_nicename,wp_um_followers.user_id1,wp_um_followers.user_id2,wp_um_set_priority_by_follower.follower_cat_id,wp_um_set_priority_by_follower.created_at 
	from wp_users left join wp_um_followers on wp_users.ID =wp_um_followers.user_id2
	inner join wp_um_set_priority_by_follower on (wp_um_followers.user_id1=wp_um_set_priority_by_follower.user_id and wp_um_followers.user_id2=wp_um_set_priority_by_follower.follower_id) Where user_id1=$user_meta_id group by created_at",ARRAY_A);
	}else{
		
	$Hive_listing = $wpdb->get_results("Select wp_users.ID,wp_users.display_name,wp_users.user_nicename,wp_um_followers.user_id1,wp_um_followers.user_id2,wp_um_set_priority_by_follower.follower_cat_id,wp_um_set_priority_by_follower.created_at 
	from wp_users left join wp_um_followers on wp_users.ID =wp_um_followers.user_id2
	inner join wp_um_set_priority_by_follower on (wp_um_followers.user_id1=wp_um_set_priority_by_follower.user_id and wp_um_followers.user_id2=wp_um_set_priority_by_follower.follower_id) group by created_at",ARRAY_A);
		
	}
	$created_by_authors = $wpdb->get_results("SELECT * FROM `wp_category_created_by_author` ORDER BY `author_id`",ARRAY_A);
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
		}
		$i = 0;
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
		}
		$um_Hive_listing=array();
		foreach($Hive_listing as $key=>$list_of_Hive_listing){
			$user_ID=$list_of_Hive_listing['ID'];
			if($list_of_Hive_listing['follower_cat_id']!=""){
				$user_avatar=get_user_meta($user_ID,'user_avatar_url',true);
				$um_Hive_listing[$key]['follower_cat_id']=$list_of_Hive_listing['follower_cat_id'];
				//$um_Hive_listing[$key]['user_id']=$user_ID;
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
				foreach($listed_category as $k=>$category_value){
				if($category_value[$k]['author_id']==$user_ID){
					$um_Hive_listing[$key]['category_image']=$category_value;
				}
			}
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
function beesmart_get_list_of_bio_callback($request){
	global $wpdb;
	$user_meta_id = $request->get_param('user_meta_id');
	if(empty($user_meta_id)){
		$um_bio_data = $wpdb->get_results ("SELECT * FROM `wp_posts` WHERE `post_type` = 'info' AND `post_status` = 'publish' AND post_author!=0",ARRAY_A);
	}else{
		$um_bio_data = $wpdb->get_results ("SELECT * FROM `wp_posts` WHERE `post_type` = 'info' AND `post_status` = 'publish' AND post_author=$user_meta_id limit 4",ARRAY_A);
	}
	$um_bio_info=array();
	foreach($um_bio_data as $key=>$list_of_bio_info){
		$bio_id=$list_of_bio_info['ID'];
		$bio_post_author=$list_of_bio_info['post_author'];
			$image_link=get_post_meta($bio_id,'image_by_url',true);
			$category_sections=get_post_meta($bio_id,'category_sections',true);
			$um_bio_info[$key]['info_post_id']=$list_of_bio_info['ID'];
			$um_bio_info[$key]['info_post_author']=$bio_post_author;
			$um_bio_info[$key]['post_title']=$list_of_bio_info['post_title'];
			$um_bio_info[$key]['post_content']=$list_of_bio_info['post_content'];
			$um_bio_info[$key]['post_link']=$list_of_bio_info['guid'];
			$um_bio_info[$key]['post_date']=$list_of_bio_info['post_date'];
			$um_bio_info[$key]['post_image_link']=$image_link;
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
} */
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
	foreach($listing_of_feeds as $single_user_listing){
		$list_of_feed['feed_listing'][]=$single_user_listing;
	}
	if(count($listing_of_feed) > 0){
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
		$_user_id=get_post_meta($buzz_id,'_user_id',true);
		$_rating=get_post_meta($buzz_id,'_rating',true);
		$um_buzz_listing[$key]['review_title']=$buzz_data['post_title'];
		$um_buzz_listing[$key]['review_content']=strip_tags($buzz_data['post_content']);
		$um_buzz_listing[$key]['post_user_id']=$_user_id;
		$um_buzz_listing[$key]['reviewer_id']=$_reviewer_id;
		$um_buzz_listing[$key]['reviewer_rating']=$_rating;
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
/**
 * Get all info from our WordPress Installation
 * @param  object $request WP_Request with data
 * @return obeject         WP_REST_Response
 */
function beesmart_api_get_callback( $request ){
    $info_id = $request->get_param('info_id');
    if( empty( $info_id ) ){
        $posts = get_posts( [ 'post_type' => 'info', 'post_status' => 'publish' ] );

        if( count($posts) > 0 ){
            $response['status'] =  200;
            $response['success'] = true;
            $response['data'] = $posts;
        }else{
            $response['status'] =  200;
            $response['success'] = false;
            $response['message'] = 'NO posts!';
        }
    }else{
        if( $info_id > 0 ){
            $post = get_post( $info_id );
            if( !empty( $post ) ){
                $response['status'] =  200;
                $response['success'] = true;
                $response['data'] = $post;
            }else{
                $response['status'] =  200;
                $response['success'] = false;
                $response['message'] = 'No post found!';
            }

        }
    }

    wp_reset_postdata();
    return new WP_REST_Response( $response );
}


/**
 * Create a beeart post by rest api
 * @param  object $request WP_Request with data
 * @return obeject         WP_REST_Response
 */
function beesmart_info_post_callback( $request ){

    $post['post_title'] = sanitize_text_field( $request->get_param( 'title' ) );
    $post['post_content'] = sanitize_text_field( $request->get_param( 'content' ) );
	$meta_selectcategory=sanitize_text_field( $request->get_param( 'meta_selectcategory' ) );
    $post['meta_input'] = [
        'image_by_url' => sanitize_text_field( $request->get_param( 'meta_image_by_url' ) )
    ];
    $post['post_status'] = 'publish';
    $post['post_author'] = sanitize_text_field( $request->get_param( 'bees_info_user_id' ) );
    $post['post_type'] = 'info';
	$siteUrl = get_site_url();

	// $post['post_map'] = $request->get_param( 'f_map' );


    $new_post_id = wp_insert_post($post);
	add_post_meta($new_post_id, 'category_sections', $meta_selectcategory);
	// update checkboxes
	// update_field( 'f_be_found', $post['post_value_f_by_found'], $new_post_id );

    if( !is_wp_error( $new_post_id ) ){
        $response['status'] =  200;
        $response['success'] = true;
        $response['data'] = get_post( $new_post_id ); 
    }else{
        $response['status'] =  200;
        $response['success'] = false;
        $response['message'] = 'No post found!';
    }

    return new WP_REST_Response( $response );     
	
}
add_action('wp_ajax_get_preview', 'get_preview');
add_action('wp_ajax_nopriv_get_preview', 'get_preview');
function get_preview(){
    if(isset($_POST["link"]))
    {  
       $main_url=$_POST["link"];
       @$str = file_get_contents($main_url);


       // This Code Block is used to extract title
       if(strlen($str)>0)
       {
         $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
         preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title);
       }


       // This Code block is used to extract description 
       $b =$main_url;
       @$url = parse_url( $b ) ;


       $youtubeUrl = parse_url($b, PHP_URL_QUERY);
       parse_str($youtubeUrl);


       @$tags = get_meta_tags( $main_url );

       // This Code Block is used to extract og:image which facebook extracts from webpage it is also considered 
       // the default image of the webpage
       $d = new DomDocument();
       @$d->loadHTML($str);
       $xp = new domxpath($d);
       foreach ($xp->query("//meta[@property='og:image']") as $el){
         $l2=parse_url($el->getAttribute("content"));
         if($l2['scheme']){
          $img[]=$el->getAttribute("content");
       // print_r($img2);
          }
         else{

         }
       }
       $imggs = $d->getElementsByTagName('img');
       $imgg = $imggs->item(0); 
       // $img = @$url . $imgg->getAttribute('src');
       // $img = @$url . $imgg->getAttribute('src');

      ?>


       <?php
          if(!empty($img)) {
            echo "<img  style='max-height:250px; max-width:100%;' src='".$img[0]."'>";
          } else if ($main_url == ''){
            echo "<img style='max-height:100%; max-width:100%;' src='".site_url()."'/wp-content/uploads/2022/02/New-Project-48.png'>";
          } else if($imgg->getAttribute( 'src' )) {
         echo "<img src='".$imgg->getAttribute('src')."' class='container-resposne'>" ;
          }
           echo "<H2 class='title' >".$title[1]."</H2>";

    }
}
