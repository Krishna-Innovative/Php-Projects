<?php
function save_follow_user_data()
{

    global $wpdb;

    $category_id = $_POST['category_id'];
    // The user ID I subscribe to (for $follow_table table)
    $user_id = $_POST['user_id'];
    // category_id: [265, 234 ,643] array
    // user_id: 300 
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
    $follow_table = $wpdb->prefix . 'um_followers';
    $table_name = $wpdb->prefix . 'um_set_priority_by_follower';
    $date = date('Y-m-d H:i:s');
    $results_um_followers = $wpdb->get_results("SELECT * FROM $follow_table where user_id1 =$current_user_id and user_id2=$user_id");
    $results_um_set_priority_by_follower = $wpdb->get_results("SELECT * FROM $table_name where user_id =$current_user_id and follower_id=$user_id");
    if (empty($results_um_set_priority_by_follower)) {
        $insert_follower_data = $wpdb->insert($table_name, array('id' => NULL, 'user_id' => $current_user_id, 'follower_id' => $user_id, 'follower_cat_id' => $category_id));
        $follow_table_data = $wpdb->insert($follow_table, array('id' => NULL, 'time' => $date, 'user_id1' => $current_user_id, 'user_id2' => $user_id));
        if ($insert_follower_data) {
            echo json_encode(array("success" => "true", "message" => 'You have successfully followed this user by his category'));
        } else {
            echo json_encode(array("success" => "false", "message" => 'Oops something went wrong.Please try again later'));
        }
    } else {
        $hive_list_ids = $wpdb->get_results("SELECT id FROM $table_name where user_id =$current_user_id and follower_id=$user_id");
        $hive_id = $hive_list_ids[0]->id;
        $update_follower_hive =  $wpdb->query($wpdb->prepare("UPDATE $table_name SET follower_cat_id = $category_id WHERE `id` = " . $hive_id . " "));
        // $follow_table_data = $wpdb::update($follow_table, array('id' => NULL, 'time' => $date, 'user_id1' => $current_user_id, 'user_id2' => $user_id));
        if ($update_follower_hive) {
            echo json_encode(array("success" => "true", "message" => 'You have successfully updated this user by his category .'));
        } else {
            echo json_encode(array("success" => "false", "message" => 'Oops during updation something went wrong.Please try again later', 'debug' => debug($hive_id), 'result' => debug($update_follower_hive)));
        }
    }
    die;
}
add_action('wp_ajax_save_follow_user_data', 'save_follow_user_data');
add_action('wp_ajax_nopriv_save_follow_user_data', 'save_follow_user_data');


function remove_user_list_from_follower()
{
    global $wpdb;
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
    $user_id = $_POST['user_id'];
    $delete_follower = $wpdb->query("DELETE FROM wp_um_followers WHERE user_id1=$current_user_id AND user_id2=$user_id");
    $delete = $wpdb->query("DELETE from wp_um_set_priority_by_follower where user_id=$current_user_id and follower_id=$user_id");
    $results = $wpdb->get_results("SELECT * FROM wp_um_followers where `user_id1` =$current_user_id");
    if (!empty($results)) {
        $author_category_listing = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where author_id =$current_user_id");
        if (!empty($author_category_listing)) {
            $category = array();
            foreach ($author_category_listing as $category_listing) {
                $category[] = $category_listing->category_value;
            }

            $category_data = '<option value="0" data-u-id="' . $selected_id . '">--Add category--</option>';
            foreach ($results as $follower_data) {
                $follower_ids = $follower_data->user_id2;
                $get_author_id = get_the_author_meta($follower_ids);
                $get_author_gravatar = get_avatar_url($get_author_id, array('size' => 450));

                $selected_result = $wpdb->get_results("SELECT * FROM wp_um_set_priority_by_follower WHERE `follower_id`='" . $follower_ids . "' And user_id='" . $current_user_id . "'");
                $selected_category = $wpdb->get_results("SELECT * FROM wp_category_created_by_author WHERE `category_value`='" . $selected_result[0]->follower_cat_id . "'");
                if (empty($selected_result)) {
                    $category_data = '<option value="0" data-u-id="' . $selected_id . '" selected>--Add category--</option>';
                    foreach ($category as $category) {
                        $selected = 'selected';
                        $category_detail = get_cat_name($category);
                        $category_data .= '<option value="' . $category . '" data-id="' . $cat . '_dfghsthrt">' . $category_detail . '</option>';
                        $selected = '';
                    }
                } else {
                    foreach ($category as $cat) {
                        $category_detail = get_cat_name($cat);
                        if ($cat == $selected_result[0]->follower_cat_id) {
                            $selected = 'selected';
                            $category_data .= '<option value="' . $cat . '"  data-find="' . $cat . '_finding" ' . $selected . '>' . $category_detail . '</option>';
                        } else {
                            $selected = 'selected';
                            $category_data .= '<option value="' . $cat . '"  data-id="' . $cat . '_dfghsthrt">' . $category_detail . '</option>';
                        }
                    }
                }
                $user = get_user_by('ID', $follower_ids);
                $category_icons = $selected_category[0]->category_icons;
                if ($category_icons == "") {
                    $url = site_url() . '/images/010-creativity.png';
                } else {
                    $url = site_url() . '/images/' . $category_icons;
                }
                $display_name = $user->display_name;
                $user_url = esc_url(home_url('')) . '/user/' . $display_name;

                echo $html = '
                <div class="single_following user_follow_' . $follower_ids . '">
                    <div class="prof">
                        <img src="' . get_avatar_url($follower_ids) . '" />
                        <span> ' . get_the_author_meta("display_name", $follower_ids) . '</span>
                    </div>
                    <div class="select_group_manager">
                        <div class="group_manager_img">
                            <img src="' . $url . '"">
                        </div>
                        <input type="hidden" name="user_profile_id" value="' . $follower_ids . '" class="profile_id">
                        <select name="post_name" class="postname" >' . $category_data . '</select>
                    </div>
                    <div class="p_drop">
                        <div class="dropdown">
                        <a class="" href="#" role="button" id="ab" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16"><path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path></svg></a>
                        <div class="dropdown-menu" aria-labelledby="ab">
                            <a class="dropdown-item user-remove" data-target="#removeconfirmation' . $follower_ids . '" data-toggle="modal" data-userid="' . $follower_ids . '">Remove</a> 
                        <a class="dropdown-item user-hide" data-target="#confirmation' . $follower_ids . '" data-toggle="modal" data-userid="' . $follower_ids . '">Hide</a> 
                    </div> 
                </div>
                </div>
                </div><div class="modal following_modal custom_trsparent_modal" id="confirmation' . $follower_ids . '"><div class="modal-dialog"><div class="modal-content"><div class="modal-header border-0"><!--<button type="button" class="close close_2nd" data-dismiss="modal">×</button>--></div><div class="modal-body text-center mb-5 bg-white rounded"><img src="' . site_url() . '/wp-content/uploads/2022/02/right.png" class="img-fluid mb-2" width="50px"><h3>Are You Sure?</h3><p>Do you really want to hide this user in your listing ?</p> <button type="button" class="btn btn-secondary" data-dismiss="modal" class="closebuttonpopup">No</button><a class="btn btn-danger ml-2 cancel_successfully" href="#" data-userid="' . $follower_ids . '"">Yes</a></div></div></div></div><div class="modal following_modal custom_trsparent_modal" id="removeconfirmation' . $follower_ids . '"><div class="modal-dialog"><div class="modal-content"><div class="modal-header border-0"><!--<button type="button" class="close close_2nd" data-dismiss="modal">×</button>--></div><div class="modal-body text-center mb-5 bg-white rounded"><img src="' . site_url() . '/wp-content/uploads/2022/02/right.png" class="img-fluid mb-2" width="50px"><h3>Are You Sure?</h3><p>Do you really want to remove this user in your listing ?</p><button type="button" class="btn btn-secondary" data-dismiss="modal" class="closebuttonpopup">No</button><a class="btn btn-danger ml-2 remove_successfully" href="#" data-userid="' . $follower_ids . '">Yes</a></div></div></div> </div>';
            }
        }
    }
    die;
}
add_action('wp_ajax_remove_user_list_from_follower', 'remove_user_list_from_follower');
add_action('wp_ajax_nopriv_remove_user_list_from_follower', 'remove_user_list_from_follower');







function is_hive_data_exist(){
	 global $wpdb;
	$user_id=get_current_user_id();
	define('imgPATH', get_stylesheet_directory_uri() . '/assets/images/');
	$order_type = $_GET['hive_order'];
	$search_value = $_GET['search_value'];
	if($_GET['hive_order']=='dsc'){
		$Query="SELECT wp_users.id, wp_um_followers.user_id1,wp_um_followers.user_id2, wp_users.display_name FROM wp_users LEFT JOIN wp_um_followers on wp_users.ID=wp_um_followers.user_id2 WHERE (wp_um_followers.user_id1=$user_id) order by wp_users.display_name DESC";
	}
    else if($_GET['hive_order']=='asc'){
		$Query="SELECT wp_users.id, wp_um_followers.user_id1,wp_um_followers.user_id2, wp_users.display_name FROM wp_users LEFT JOIN wp_um_followers on wp_users.ID=wp_um_followers.user_id2 WHERE (wp_um_followers.user_id1=$user_id) order by wp_users.display_name ASC";
	}else if($_GET['hive_order']=='search'){
		 $Query="SELECT wp_users.id, wp_um_followers.user_id1,wp_um_followers.user_id2, wp_users.display_name FROM wp_users LEFT JOIN wp_um_followers on wp_users.ID=wp_um_followers.user_id2
 WHERE ( wp_users.`display_name` LIKE '%$search_value%' and wp_um_followers.user_id1=$user_id ) order by wp_users.display_name ASC";
	}
    else{
		$Query="SELECT * FROM wp_um_followers where `user_id1` = $user_id";
	}
	
    $subscribed_users = $wpdb->get_results($Query, ARRAY_A);
	//echo '<pre>';print_r($subscribed_users);echo '</pre>';
	get_template_part('template-parts/components/hive/sort-order',null,$subscribed_users);
	die;
}
add_action('wp_ajax_is_hive_data_exist', 'is_hive_data_exist');
add_action('wp_ajax_nopriv_is_hive_data_exist', 'is_hive_data_exist');

function is_signed_to_anyone()
{
    global $wpdb;
	$user_id=get_current_user_id();
	
		$Query="SELECT * FROM wp_um_followers where `user_id1` = $user_id";
        // echo 'Yes Im in else';
	
    $results = $wpdb->get_results($Query);
	//echo '<pre>';print_r($results);
    return $results;
	//die;
}
add_action('wp_ajax_is_signed_to_anyone', 'is_signed_to_anyone');
add_action('wp_ajax_nopriv_is_signed_to_anyone', 'is_signed_to_anyone');

function is_user_have_own_hive()
{
    global $wpdb;
    $author_category_listing = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where author_id = " . get_current_user_id() . " ");
    return $author_category_listing;
}



function profile_hive_manager_list()
{
    global $wpdb;
    $loop = 0;
    if (isset($_POST["limit"])) {
        $_POST["start"];
        $current_user = wp_get_current_user();
        $current_user_id = $current_user->ID;
        // 1.found all follows of current user
        $results = $wpdb->get_results("SELECT * FROM wp_um_followers where `user_id1` =$current_user_id LIMIT " . $_POST["start"] . ", " . $_POST["limit"] . "");
        // debug($results);

        if (!empty($results)) {
            // $number_of_follower = $wpdb->get_results("SELECT * FROM wp_um_followers where `user_id1` =$current_user_id");

            $author_category_listing = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where author_id =$current_user_id");
            // debug($author_category_listing);

            if (!empty($author_category_listing)) {
                $category = array();
                foreach ($author_category_listing as $category_listing) {
                    $category[] = $category_listing->category_value;
                }

                foreach ($results as $follower_data) {
                    $follower_ids = $follower_data->user_id2;
                    if ($follower_ids != '0') {
                        $get_author_id = get_the_author_meta($follower_ids);
                        $get_author_gravatar = get_avatar_url($get_author_id, array('size' => 450));

                        $selected_result = $wpdb->get_results("SELECT * FROM wp_um_set_priority_by_follower WHERE `follower_id`='" . $follower_ids . "' And user_id='" . $current_user_id . "'");

                        if (empty($selected_result)) {
                            //$category_data = '<option value="0" data-u-id="' . $selected_id . '" selected>Sort later</option>';

                            foreach ($category as $category) {
                                $selected = 'selected';
                                $category_detail = get_cat_name($category);
                                //$category_data .= '<option value="' . $category . '" data-src="8.png"  data-id="' . $cat . '_dfghsthrt" data-u-id="' . $follower_ids . '">' . $category_detail . '</option>';
                                $category_data .= '
                                <li class="nav-item">
									<input type="checkbox" id="hive' . $category . '" name="" value="' . $category . '">
                                    <label for="hive' . $category . '">
                                        <img src="' . site_url() . '/wp-content/uploads/2022/05/Hives-Sort-later.png"> 
                                        <span>' . $category_detail . '</span>
                                    </label>
                                </li>';
                                $selected = '';
                            }
                        } else {
                            foreach ($category as $cat) {
                                $category_detail = get_cat_name($cat);
                                $selected_ids = explode(',', $selected_result[0]->follower_cat_id);
                                if (in_array($cat, $selected_ids)) {
                                    $find_images = $wpdb->get_results("SELECT * FROM wp_category_created_by_author WHERE `category_value`='" . $cat . "' And author_id='" . $current_user_id . "'");

                                    foreach ($find_images as $selected_image) {
                                        $final_category_stickers = $selected_image->category_icons;
                                        $image_value++;
                                    }
                                    $resulted_stickers[] = $final_category_stickers;
                                    $selected = 'selected';
                                    //$category_data .= '<option value="' . $cat . '"  data-thumbnail="'.site_url().'/images/'.$final_category_stickers.'" data-find="' . $cat . '_finding" ' . $selected . '>' . $category_detail . '</option>';
                                    $category_data .= '
                                    <li class="nav-item">
									    <input type="checkbox" id="hive' . $cat . '" name="" value="' . $cat . '">
                                        <label for="hive' . $cat . '">
                                            <img src="' . site_url() . '/images/' . $final_category_stickers . '">
                                            <span>' . $category_detail . '</span>
                                        </label>
                                    </li>';
                                }
                                else {
                                    $find_images = $wpdb->get_results("SELECT * FROM wp_category_created_by_author WHERE `category_value`='" . $cat . "' And author_id='" . $current_user_id . "'");

                                    foreach ($find_images as $selected_image) {
                                        $final_category_stickers = $selected_image->category_icons;
                                        $final_category_stickers = site_url() . '/images/' . $final_category_stickers;
                                    }
                                    $selected = 'selected';
                                    //$category_data .= '<option value="' . $cat . '"  data-thumbnail="'.$final_category_stickers.'" data-id="' . $cat . '_dfghsthrt" data-u-id="' . $follower_ids . '">' . $category_detail . '</option>';
                                    $category_data .= '
                                    <li class="nav-item">
									    <input type="checkbox" id="hive' . $cat . '" name="" value="' . $cat . '">
                                        <label for="hive' . $cat . '">
                                            <img src="' . $final_category_stickers . '">
                                            <span>' . $category_detail . '</span>
                                        </label>
                                    </li>';
                                }
                            }
                        }
                        if (empty($resulted_stickers)) {
                            $site_url = site_url();

                            $url = $site_url . '/wp-content/uploads/2022/05/Hives-Sort-later.png';
                            $new_images .= '<div class="item"><div class="selectblock"><img src="' . $url . '"></div></div>';
                        } else {
                            $new_images = '';
                            for ($i = 0; $i < count($resulted_stickers); $i++) {
                                // There should be categories in which the user has been added
                                $new_images .= '
                                <div class="item">
                                    <div class="selectblock new_class' . $i . '">
                                        <img src="/images/' . $resulted_stickers[$i] . '">
                                    </div>
                                </div>';
                            }
                        }
                        $user = get_user_by('ID', $follower_ids);
                        $display_name = $user->display_name;
                        $user_url = esc_url(home_url('')) . '/user/' . $display_name;
                        um_fetch_user($follower_ids);
                        $profile_image = esc_url(um_get_avatar_uri(um_profile('profile_photo'), 190));
                        $profile_image_url = trim(strtok($profile_image, '?'));
                        $follower_meta = get_user_meta($follower_ids);

                        if (!filter_var($profile_image_url, FILTER_VALIDATE_URL) === false) {
                            $real_image = $profile_image_url;
                        } else {
                            $real_image = "https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png";
                        }
                        $randome_number = rand();
                        // $imgPath = null;
                        echo $html = '
                        <div class="single_follower">
                            <div class="single_following user_follow_' . $follower_ids . '">
                                <input type="hidden" name="post_name_' . $follower_ids . '[]" id="post_name_' . $follower_ids . '" value="' . $follower_ids . '">
                                    <div class="prof" data-url=' . $real_image . '>
                                        <div class="hiveuser_image"><img src="' . $real_image . '"></div>
                                        <span> ' . get_the_author_meta("display_name", $follower_ids) . '</span>
                                        <div class="safe_sec">
                                            <img src="/wp-content/uploads/2022/05/Visibility.png">
                                            <img src="/wp-content/uploads/2022/01/Verified.png">
                                        </div>
                                    </div>
                                    <div class="select_group_manager">
                                        <div class="group_manager_img">
                                            <div class="category_images client' . $loop . ' owl-carousel owl-theme">' . $new_images . '</div>
                                        </div>
                                        <div class="addHive-block">
                                            <div class="hive_btnblock">
                                                <div class="animated_image">
                                                    <img src="' . site_url() . '/wp-content/uploads/2022/05/Hives-Sort-later.png">
                                                </div>
                                                <button data-type="addhive" type="button" class="custom_select hivvdropdown_button" data-feed-id="' . $follower_ids . '">
                                                    Sort later
                                                </button>
                                            </div>
                                            <div class="hivvdropdown hive_option_' . $follower_ids . '">
                                                <div class="hivvdropdown_search">
                                                    <img src="' . site_url() . '/wp-content/uploads/2022/02/Hive.png" class="hive_icon">
                                                    <input type="text" class="form-control">
                                                    <img src="' . site_url() . '/wp-content/uploads/2022/02/search.png" class="search_icon">
                                                </div>
                                                <ul class="hivvdropdown_list">
                                                    ' . $category_data . '
                                                </ul>
                                                <button class="hover_hue click_animation p-0 hivedrop_down_button" data-type="shadow">
                                                    <img src="' . site_url() . '/wp-content/themes/beesmart-main/assets/images/Check.png" data-type="shadow" width="60">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p_drop">
                                        <div class="dropdown">
                                            <a class="" href="#" role="button" id="ab' . $randome_number . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16"><path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path></svg>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="ab' . $randome_number . '">
                                                <a class="dropdown-item user-remove" data-target="#removeconfirmation' . $follower_ids . '" data-toggle="modal" data-userid="' . $follower_ids . '">Delete</a> 
                                                <a class="dropdown-item user-hide" data-target="#confirmation' . $follower_ids . '" data-toggle="modal" data-userid="' . $follower_ids . '">Hide</a> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <!-- hide popup -->
                                <div class="modal following_modal custom_trsparent_modal" id="confirmation' . $follower_ids . '">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header border-0"></div>
                                            <div class="modal-body text-center mb-5 bg-white rounded">
                                                <img src="' . site_url() . '/wp-content/uploads/2022/02/right.png" class="img-fluid mb-2" width="50px">
                                                <h3>Are You Sure?</h3>
                                                <p>Do you really want to hide this user in your listing ?</p>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" class="closebuttonpopup">No</button>
                                                <a class="btn btn-danger ml-2 cancel_successfully" href="#" data-userid="' . $follower_ids . '">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- remove popup -->
                                <div class="modal following_modal custom_trsparent_modal" id="removeconfirmation' . $follower_ids . '">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header border-0"></div>
                                            <div class="modal-body text-center mb-5 bg-white rounded">
                                            <img src="' . site_url() . '/wp-content/uploads/2022/02/right.png" class="img-fluid mb-2" width="50px">
                                            <h3>Are You Sure?</h3>
                                            <p>Do you really want to remove this user in your listing ?</p>
                                            <button type="button" class="UnsubscribePopup-closeBtn" data-dismiss="modal">No</button>
                                            <a class="ml-2 remove_successfully" href="#" data-userid="' . $follower_ids . '">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }
                    $loop++;
                }
            }
            //' . get_template_part('template-parts/components/dropdown_hive') . '
            

                //} 
            } else {
                echo '<div class="not_found_record">No Hive Record Found</div>';
            }
        }
        die;
    }
    add_action('wp_ajax_profile_hive_manager_list', 'profile_hive_manager_list');
    add_action('wp_ajax_nopriv_profile_hive_manager_list', 'profile_hive_manager_list');





    // function check_saved_hive()
    // {
    //     global $wpdb;
    //     $other_user_id = $_POST['user_id'];
    //     $selected_hives = is_subscriber_have_hive_which_the_user_has_been_added(get_current_user_id(), $other_user_id);
    //     // $selected_hives = $wpdb->get_results("SELECT follower_cat_id FROM wp_um_set_priority_by_follower WHERE `user_id`= ". get_current_user_id() ." AND `follower_id`= " . $other_user_id . " ");
    //     if (empty($selected_hives)) {
    //         echo 'hive not founded';
    //         // debug($selected_hives);
    //         // var_dump($other_user_id); // other user
    //         // var_dump(get_current_user_id());
    //         exit;
    //     } else {
    //         $hive_list = array();
    //         foreach ($selected_hives as $hive) {
    //             $hive_list[] = $hive->follower_cat_id;
    //         }
    //         echo $hive_list[0];
    //         exit;
    //         // debug($hive_list);
    //         // var_dump($other_user_id); // other user
    //         // var_dump(get_current_user_id());
    //     }
    // }


    // add_action('wp_ajax_check_saved_hive', 'check_saved_hive');
    // add_action('wp_ajax_nopriv_check_saved_hive', 'check_saved_hive');


    function check_saved_hive_array()
    {
        global $wpdb;
        $other_user_ids = $_POST['user_ids_array'];
        foreach ($other_user_ids as $other_user_id) {
            // var_dump($other_user_id);
            $selected_hives_of_single_user = isFollowed(get_current_user_id(), $other_user_id);
          //  var_dump($selected_hives_of_single_user);

            // if (empty($selected_hives_of_single_user)) {

            //     echo 'hive not founded';

            //     var_dump($selected_hives_of_single_user);

            //     exit;
            // }
            // else {
            //     var_dump($selected_hives_of_single_user);

            //     $list_of_single_user_saved_hive = array();

            //     foreach($selected_hives_of_single_user as $hive){
            //         $list_of_single_user_saved_hive[] = $hive->follower_cat_id;
            //     }

            //     echo $list_of_single_user_saved_hive[0];
            //     exit;
            // debug($hive_list);
            // var_dump($other_user_id); // other user
            // var_dump(get_current_user_id());
        }
    }
    // $selected_hives = is_subscriber_have_hive_which_the_user_has_been_added(get_current_user_id(), $other_user_id);
    // $selected_hives = $wpdb->get_results("SELECT follower_cat_id FROM wp_um_set_priority_by_follower WHERE `user_id`= ". get_current_user_id() ." AND `follower_id`= " . $other_user_id . " ");
    // if (empty($other_user_id)) {
    // echo 'hive not founded';
    // var_dump($other_user_id);
    // var_dump($other_user_id);
    // var_dump($other_user_id); // other user
    // var_dump(get_current_user_id());
    // exit;
    // }
    // else {
    // var_dump($other_user_id);
    // var_dump($other_user_id);
    // $hive_list = array();
    // foreach($selected_hives as $hive){
    //     $hive_list[] = $hive->follower_cat_id;
    // }
    // echo $hive_list[0];
    // exit;
    // debug($hive_list);
    // var_dump($other_user_id); // other user
    // var_dump(get_current_user_id());
    // }
    // }


    add_action('wp_ajax_check_saved_hive_array', 'check_saved_hive_array');
    add_action('wp_ajax_nopriv_check_saved_hive_array', 'check_saved_hive_array');



    /**==============
     *               *
     *  UNLOCK HIVE  *
     *               *
==============**/
    function save_category_to_unlock_feature()
    {
        global $wpdb;
        $category_id = $_POST['category_id'];
        $user_id = $_POST['user_id'];
        $current_user = wp_get_current_user();
        $current_user_id = $current_user->ID;

        $table_name = $wpdb->prefix . 'um_set_priority_by_follower';
        $follow_table = $wpdb->prefix . 'um_followers';
        $date = date('Y-m-d H:i:s');
        $results = $wpdb->get_results("SELECT * FROM $table_name where user_id =$current_user_id and follower_id=$user_id");
        if (empty($results)) {
            $insert_follower_data = $wpdb->insert($table_name, array('id' => NULL, 'user_id' => $current_user_id, 'follower_id' => $user_id, 'follower_cat_id' => $category_id));
            $follow_table_data = $wpdb->insert($follow_table, array('id' => NULL, 'time' => $date, 'user_id1' => $current_user_id, 'user_id2' => $user_id));
            if ($insert_follower_data) {
                echo json_encode(array("success" => "true", "message" => 'You have successfully followed this user by his category'));
            } else {
                echo json_encode(array("success" => "false", "message" => 'Oops something went wrong.Please try again later'));
            }
        } else {
            $unsubscribed = $wpdb->query("delete from wp_um_followers where user_id1=$current_user_id and user_id2=$user_id");
            $delete = $wpdb->query("delete from wp_um_set_priority_by_follower where user_id=$current_user_id and follower_id=$user_id");
            $insert_follower_data = $wpdb->insert($table_name, array('id' => NULL, 'user_id' => $current_user_id, 'follower_id' => $user_id, 'follower_cat_id' => $category_id));
            $follow_table_data = $wpdb->insert($follow_table, array('id' => NULL, 'time' => $date, 'user_id1' => $current_user_id, 'user_id2' => $user_id));
            if ($insert_follower_data) {
                echo json_encode(array("success" => "true", "message" => 'You have successfully followed this user by his category'));
            }
        }

        die;
    }
    add_action('wp_ajax_save_category_to_unlock_feature', 'save_category_to_unlock_feature');
    add_action('wp_ajax_nopriv_save_category_to_unlock_feature', 'save_category_to_unlock_feature');




    add_action('hive_list', 'hive_list');
    function hive_list($ids)
    {
        global $wpdb;
        $hive_ids = explode(',', $ids);
        $hive_slider = '';
        foreach ($hive_ids as $hive_id) {
            $hive_icon = $wpdb->get_results("SELECT `category_icons` FROM `wp_category_created_by_author` WHERE `category_value` = $hive_id  ");
            if ($hive_icon) {
                $hive_slider .= '
            <div class="item">
                <div class="selectblock new_class0">
                    <img src="/images/' . $hive_icon[0]->category_icons . '">
                </div>
            </div>';
            } else {
                $hive_slider = '
                <div class="selectblock new_class0">
                    <img src="/wp-content/uploads/2022/05/Hives-Sort-later.png">
                </div>';
            }
        }
        echo $hive_slider;

        // return $hive_slider;
    }


    add_action('the_own_hive_list', 'the_own_hive_list');

    function the_own_hive_list()
    {
        global $wpdb;
        $current_user_id = get_current_user_id();
        $author_category_listing = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where author_id =$current_user_id");
        // debug($author_category_listing);

        if (!empty($author_category_listing)) {
            
            $follower_ids = $author_category_listing->user_id2;
            $category = array();
            foreach ($author_category_listing as $category_listing) {
                $category[] = $category_listing->category_value;
            }

            $selected_result = $wpdb->get_results("SELECT * FROM wp_um_set_priority_by_follower WHERE `follower_id`='" . $follower_ids . "' And user_id='" . $current_user_id . "'");
            // if hive wasnt fount 
            if (empty($selected_result)) {

                // foreach ($category as $category) {
                //     $selected = 'selected';
                //     $category_detail = get_cat_name($category);
                    $category_data .= '<li class="nav-item"><input type="checkbox" id="hive' . $category . '" name="" data-hive value="' . $category . '">
                        <label for="hive' . $category . '"><img src="' . site_url() . '/wp-content/uploads/2022/05/Hives-Sort-later.png"> <span>' . $category_detail . '</span></label></li>';
                    $selected = '';
                // }
            } else {
                foreach ($category as $cat) {
                    $category_detail = get_cat_name($cat);
                    $selected_ids = explode(',', $selected_result[0]->follower_cat_id);
                    if (in_array($cat, $selected_ids)) {
                        $find_images = $wpdb->get_results("SELECT * FROM wp_category_created_by_author WHERE `category_value`='" . $cat . "' And author_id='" . $current_user_id . "'");

                        foreach ($find_images as $selected_image) {
                            $final_category_stickers = $selected_image->category_icons;
                            if ($final_category_stickers != ''){
                                $final_category_stickers = site_url() . '/images/' . $final_category_stickers;
                            }else {
                                $final_category_stickers = site_url() . '/wp-content/uploads/2022/05/Hives-Sort-later.png';
                            }
                        }
                        $resulted_stickers[] = $final_category_stickers;
                        $selected = 'selected';
                        $category_data .= '
                        <li class="nav-item"><input type="checkbox" id="hive' . $cat . '" name="" value="' . $cat . '">
                            <label for="hive' . $cat . '">
                            <img src="' . site_url() . '/images/' . $final_category_stickers . '" />
                            <span>' . $category_detail . '</span>
                            </label>
                        </li>';
                    } else {
                        $find_images = $wpdb->get_results("SELECT * FROM wp_category_created_by_author WHERE `category_value`='" . $cat . "' And author_id='" . $current_user_id . "'");

                        foreach ($find_images as $selected_image) {
                            $final_category_stickers = $selected_image->category_icons;
                            if ($final_category_stickers != ''){
                                $final_category_stickers = site_url() . '/images/' . $final_category_stickers;
                            }else {
                                $final_category_stickers = site_url() . '/wp-content/uploads/2022/05/Hives-Sort-later.png';
                            }
                        }
                        $selected = 'selected';
                        $category_data .= '
                        <li class="nav-item">
                            <input type="checkbox" class="hive' . $cat . '" data-hive name="" value="' . $cat . '">
                            <label for="hive' . $cat . '">
                                <img src="' . $final_category_stickers . '">
                                <span>' . $category_detail . '</span>
                            </label>
                        </li>';
                        // break;    
                    }
                }
            }
            // }
            // }
        }
        // }
        echo $category_data;
    }

// query for checking does you followed the user or not
function is_subscriber_have_hive_which_the_user_has_been_added($current_user_id, $follower_id)
{
	global $wpdb;
	return $wpdb->get_results("SELECT follower_cat_id FROM wp_um_set_priority_by_follower WHERE `user_id` = " . $current_user_id . " AND `follower_id` = " . $follower_id . " ");
}

