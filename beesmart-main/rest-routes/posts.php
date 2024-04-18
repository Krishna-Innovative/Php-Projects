<?php
// wp-json/beesmart/v1/list-of-post-meta/
add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'list-of-post-meta/', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_post_meta_callback'
    ));
});
// wp-json/beesmart/v1/list-of-post-meta/142
add_action('init', function(){
    register_rest_route( 'beesmart/v1', 'list-of-post-meta/(?P<post_meta_id>\d+)/uid/(?P<uid>\w+)', array(
        'methods' => 'GET',
        'callback' => 'beesmart_get_list_of_post_meta_callback'
    ));
});

function beesmart_get_list_of_post_meta_callback($request){
	global $wpdb;
	
	$post_meta_id = $request->get_param('post_meta_id');
	$user_id = $request->get_param('uid');
	//echo $post_meta_id.'post_meta_id'.$user_id.'user_id';
	
	$final_data=date('Y-m-d H:i:m', strtotime('-25 days'));
	$current_data=date('Y-m-d H:i:m');
	if(empty($post_meta_id)){
		$wp_postmeta = $wpdb->get_results("SELECT wp_posts.post_author,wp_posts.post_date,wp_posts.post_content,wp_posts.post_title,wp_posts.post_name,wp_postmeta.post_id FROM wp_posts JOIN wp_postmeta WHERE wp_posts.ID = wp_postmeta.post_id AND wp_posts.post_type='beeart'  AND wp_posts.post_status='publish' AND post_date > '$final_data' AND post_date < '$current_data' group by post_id",ARRAY_A);
	//echo 'no';
	}else{
	//	echo 'yes';
		$wp_postmeta = $wpdb->get_results("SELECT wp_posts.post_author,wp_posts.post_date,wp_posts.post_content,wp_posts.post_title,wp_posts.post_name,wp_postmeta.post_id FROM wp_posts JOIN wp_postmeta WHERE wp_posts.ID = wp_postmeta.post_id AND wp_posts.post_type='beeart'  AND wp_posts.post_status='publish' AND wp_posts.post_author='$post_meta_id' AND post_date > '$final_data' AND post_date < '$current_data' group by post_id",ARRAY_A);
		$hive_listing=$wpdb->get_results("Select wp_users.ID,wp_users.display_name,wp_users.user_nicename,wp_um_followers.user_id1,wp_um_followers.user_id2,wp_um_set_priority_by_follower.follower_cat_id,wp_um_set_priority_by_follower.created_at 
	from wp_users left join wp_um_followers on wp_users.ID =wp_um_followers.user_id2
	inner join wp_um_set_priority_by_follower on (wp_um_followers.user_id1=wp_um_set_priority_by_follower.user_id and wp_um_followers.user_id2=wp_um_set_priority_by_follower.follower_id) Where user_id1=$post_meta_id And user_id2=$user_id group by created_at",ARRAY_A);
		$created_by_authors = $wpdb->get_results("SELECT * FROM `wp_category_created_by_author` Where author_id=$post_meta_id ORDER BY `author_id`",ARRAY_A);
		//echo "SELECT wp_posts.post_author,wp_posts.post_date,wp_posts.post_content,wp_posts.post_title,wp_posts.post_name,wp_postmeta.post_id FROM wp_posts JOIN wp_postmeta WHERE wp_posts.ID = wp_postmeta.post_id AND wp_posts.post_type='beeart'  AND wp_posts.post_status='publish' AND wp_posts.post_author='$post_meta_id' AND post_date > '$final_data' AND post_date < '$current_data' group by post_id";
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
		$um_Hive_listing=array();
		//echo '<pre>';print_r($hive_listing);
		foreach($hive_listing as $list_of_Hive_listing){
			 $user_ID=$list_of_Hive_listing['ID'];
			if($list_of_Hive_listing['follower_cat_id']!=""){
				$new_hive_value=explode(',',$list_of_Hive_listing['follower_cat_id']);
				
				foreach($new_hive_value as $hive_category){
					if(get_cat_name($hive_category)==""){
						$hive_category_name='Null';
					}else{
						$hive_category_name=get_cat_name($hive_category);
					}
				}
				$new_array=explode(',',$list_of_Hive_listing['follower_cat_id']);
				 foreach($created_category as $k=>$category_value){
						if(in_array($category_value['author_category'],$new_array)){
							$created_category[$k]['iscategory_true']='true';
						}else{
							$created_category[$k]['iscategory_true']='false';
						}
				 } 
				$um_Hive_listing['category_image'][]=$created_category;
				$um_Hive_listing['created_at']=$list_of_Hive_listing['created_at'];
			} 
		}
		$wp_postdata=array();
		foreach($wp_postmeta as $key=>$wp_post){
			$post_id=$wp_post['post_id'];
			$f_url=get_post_meta($post_id,'f_url',true);
			$url = "https://iframe.ly/api/oembed?url=$f_url&api_key=f89673623cd4c5df1efbb0";
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, headParam);
		    //for debug only!
		    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			$resp = curl_exec($curl);
			curl_close($curl);
			$new_value = json_decode($resp, true);
			$upcoming_data=$new_value['html'];
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
			$wp_postdata[$key]['postf_url']=$upcoming_data;
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
			$wp_postdata[$key]['post_hive_listing']=$um_Hive_listing;
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
?>