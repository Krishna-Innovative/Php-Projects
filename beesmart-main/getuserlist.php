<?php
global $wpdb;
require_once('wp-load.php');
//get_header();
if(isset($_POST["limit"])){
$_POST["start"];
$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;	

$results = $wpdb->get_results( "SELECT * FROM wp_um_followers where `user_id1` =$current_user_id LIMIT ".$_POST["start"].", ".$_POST["limit"]."");

if(!empty($results)) {  
	$author_category_listing = $wpdb->get_results( "SELECT * FROM wp_category_created_by_author where author_id =$current_user_id");
		if(!empty($author_category_listing)){
			$category=array();
		foreach($author_category_listing as $category_listing){
			$category[]=$category_listing->category_value;
		}
	
		$category_data='<option value="0" data-u-id="'.$selected_id.'">--Add category--</option>';
		foreach($results as $follower_data){
			$follower_ids=$follower_data->user_id2;
			$get_author_id = get_the_author_meta($follower_ids);
			$get_author_gravatar = get_avatar_url($get_author_id, array('size' => 450));
			
			 $selected_result = $wpdb->get_results("SELECT * FROM wp_um_set_priority_by_follower WHERE `follower_id`='".$follower_ids."' And user_id='".$current_user_id."'");
			  $selected_category = $wpdb->get_results("SELECT * FROM wp_category_created_by_author WHERE `category_value`='".$selected_result[0]->follower_cat_id."'");
			//echo '<pre>';print_r($selected_result[0]->follower_cat_id);
			//echo 'new_'.'<br>';
			 if(empty($selected_result)){
				// echo '+++++++++++';
			/*foreach($selected_result as $selected_data){ 
					$follower_cat_id=$selected_data->follower_cat_id;
					$follower_id=$selected_data->follower_id;  */
					//$selected-
					$category_data='<option value="0" data-u-id="'.$selected_id.'" selected>--Add category--</option>';
					 foreach($category as $category){
						$selected='selected';
						$category_detail=get_cat_name($category);
						$category_data.= '<option value="'.$category.'" data-id="'.$cat.'_dfghsthrt">'.$category_detail.'</option>';
						$selected='';
					}
			}else{
			//	echo '----------';
			//$category_data="";
					 foreach($category as $cat){
						// echo $cat.'new_cat'.$selected_result[0]->follower_cat_id;
						 $category_detail=get_cat_name($cat);
						 if($cat==$selected_result[0]->follower_cat_id){
					//	 echo $cat.'category_selected'.'<br>';
						$selected='selected';
						 $category_data.= '<option value="'.$cat.'"  data-find="'.$cat.'_finding" '.$selected.'>'.$category_detail.'</option>';
						 //break;
						 }else{
							 $selected='selected';
						 $category_data.= '<option value="'.$cat.'"  data-id="'.$cat.'_dfghsthrt">'.$category_detail.'</option>';
						 }
						
					}
			}
		
			
			$user = get_user_by( 'ID', $follower_ids );
          $category_icons=$selected_category[0]->category_icons;
			if($category_icons==""){
				$url= site_url().'/images/010-creativity.png';
			}else{
				$url= site_url() . '/images/' .$category_icons;
			}
			$display_name = $user->display_name;
			$user_url=esc_url( home_url( '' ) ).'/user/'.$display_name; 
		
			echo $html= '<div class="single_following user_follow_'.$follower_ids.'"><div class="prof"><img src="'.get_avatar_url($follower_ids).'" /><span> '.get_the_author_meta("display_name", $follower_ids).'</span></div>
			<div class="select_group_manager"> <div class="group_manager_img"><img src="'.$url.'""></div><input type="hidden" name="user_profile_id" value="'.$follower_ids.'" class="profile_id"><select name="post_name" class="postname" >'.$category_data.'</select>	</div><div class="p_drop"><div class="dropdown"> <a class="" href="#" role="button" id="ab" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16"><path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path></svg></a><div class="dropdown-menu" aria-labelledby="ab"><a class="dropdown-item user-remove" data-target="#removeconfirmation'.$follower_ids.'" data-toggle="modal" data-userid="'.$follower_ids.'">Remove</a> <a class="dropdown-item user-hide" data-target="#confirmation'.$follower_ids.'" data-toggle="modal" data-userid="'.$follower_ids.'">Hide</a> </div> </div></div></div><div class="modal following_modal custom_trsparent_modal" id="confirmation'.$follower_ids.'"><div class="modal-dialog"><div class="modal-content"><div class="modal-header border-0"><button type="button" class="close close_2nd" data-dismiss="modal">×</button></div><div class="modal-body text-center mb-5 bg-white rounded"><img src="'.site_url().'/wp-content/uploads/2022/02/right.png" class="img-fluid mb-2" width="50px"><h3>Are You Sure?</h3><p>Do you really want to hide this user in your listing ?</p> <button type="button" class="btn btn-secondary" data-dismiss="modal" class="closebuttonpopup">No</button><a class="btn btn-danger ml-2 cancel_successfully" href="#" data-userid="'.$follower_ids.'"">Yes</a></div></div></div></div><div class="modal following_modal custom_trsparent_modal" id="removeconfirmation'.$follower_ids.'"><div class="modal-dialog"><div class="modal-content"><div class="modal-header border-0"><button type="button" class="close close_2nd" data-dismiss="modal">×</button></div><div class="modal-body text-center mb-5 bg-white rounded"><img src="'.site_url().'/wp-content/uploads/2022/02/right.png" class="img-fluid mb-2" width="50px"><h3>Are You Sure?</h3><p>Do you really want to remove this user in your listing ?</p><button type="button" class="btn btn-secondary" data-dismiss="modal" class="closebuttonpopup">No</button><a class="btn btn-danger ml-2 remove_successfully" href="#" data-userid="'.$follower_ids.'">Yes</a></div></div></div> </div>';
				
		}	
	}
}else{
	echo '<div class="not_found_record">No Record Found</div>';
}
}
//get_footer();
?>