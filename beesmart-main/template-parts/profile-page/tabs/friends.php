<?php
$userId = um_profile_id();
$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;
?>
<div class="tab-pane fade" id="friends" role="tabpanel" aria-labelledby="friends-tab">

    <div class="add-info-updated">
        <div class="friends-tab_add">
            <div class="invite_user">
                <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/05/Friends1.png" class="invite_add_icon" alt="img">
                <input type="text" placeholder="Invite" class="form-control">
                <a href="" class="friends_share" data-target="#share" data-toggle="modal"><img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Share2.png" alt="img" /> </a>
            </div>
            <!-- <div class="friends_tab_chat">
                <img src="<?php //echo site_url(); ?>/wp-content/uploads/2022/01/Chat3.png" class="invite_add_icon" alt="img">
                <span>13</span>
            </div> -->
        </div>
    </div>
    <?php
    if ($userId == $current_user_id) {
        $friends_list = $wpdb->get_results("SELECT * FROM `wp_um_friends` WHERE (`user_id1` = $current_user_id OR `user_id2` = $current_user_id) And status='1'");
        if (count($friends_list) == 0) {
            echo '<p class="text-center">No friends Found <p>';
        } else {
            foreach ($friends_list as $list_of_friends) {
                $user_id1 = $list_of_friends->user_id1;
                $user_id2 = $list_of_friends->user_id2;
                if ($user_id1 == $current_user_id) {
                    $user_id1 = $user_id2;
                } else if ($user_id2 == $current_user_id) {
                    $user_id1 = $user_id1;
                }
                $UserPostMeta = $wpdb->prefix . 'users';
                $SelectPostMeta = $wpdb->get_row("SELECT * FROM $UserPostMeta WHERE ID = $user_id1");
                $username = $SelectPostMeta->display_name;
                $username = str_replace(' ', '-', $username);
    ?>
                <div class="user-friends-section">
                    <div class="user-friend-block">
                        <!-- <div class="chat-with-friend">
                            <a href="<?php //echo site_url(); ?>/your-chats/?new-message&to=<?php //echo $username; ?>&fast=1&scrollToContainer"><img src="<?php //echo site_url(); ?>/wp-content/uploads/2022/01/Chat3.png" alt=""></a>
                            <?php //$friends_meta = get_user_meta($SelectPostMeta->ID); ?>
                        </div> -->
                        <div class="avatar-friend">
                            <a href="<?php echo site_url(); ?>/user/<?php echo $username; ?>" class="" title="<?php echo $username; ?>">
                                <?php

                                // um_fetch_user($user_id1);
                                // $profile_image = esc_url(um_get_avatar_uri(um_profile('profile_photo'), 190));
                                // $profile_image_url = trim(strtok($profile_image, '?'));

                                // if (!filter_var($profile_image_url, FILTER_VALIDATE_URL) === false) {
                                //     $real_image = $profile_image_url;
                                // } else {
                                //     $real_image = "https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png";
                                // }

                                // 
                                ?>
                                <?php apply_filters('previewRender', $friends_meta['user_avatar_url'][0]); ?>
                                <!-- // <img src="<?php //echo $real_image 
                                                    ?>" size="150"> -->
                            </a>
                            <h6>
                                <a href="<?php echo site_url(); ?>/user/<?php echo $username; ?>" title="<?php echo $username; ?>"><?php echo $username; ?></a>

                                <?php do_action('um_friends_list_post_user_name', $user_id1, $user_id2);
                                do_action('um_friends_list_after_user_name', $user_id1, $user_id2); ?>
                            </h6>
                        </div>

                        <div class="option-friend">
                            <div class="select-friend">
                                <?php
                                global $wpdb;
                                $current_user = wp_get_current_user();
                                $current_user_id = $current_user->ID;
                                $author_category_listing = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where author_id =$current_user_id");
                                $selected_result = $wpdb->get_results("SELECT * FROM wp_um_set_priority_by_follower WHERE `follower_id`='" . $user_id1 . "' And user_id='" . $current_user_id . "'");
                                $selected_category = $wpdb->get_results("SELECT * FROM wp_category_created_by_author WHERE `category_value`='" . $selected_result[0]->follower_cat_id . "'");
                                if (!empty($author_category_listing)) {
                                    $category = array();
                                    foreach ($author_category_listing as $category_listing) {
                                        $category[] = $category_listing->category_value;
                                    }
                                ?>
                                    <div class="select_group_manager">
                                        <input type="hidden" name="user_profile_id" value="<?php echo $user_id1; ?>" class="profile_id">
                                        <select name="post_name" class="postname custom_select">

                                            <?php
                                            $category_data = '<option value="0" data-u-id="' . $selected_id . '">Sort later</option>';
                                            foreach ($category as $cat) {
                                                $category_detail = get_cat_name($cat);
                                                if ($cat == $selected_result[0]->follower_cat_id) {
                                                    $selected = 'selected';
                                                    $category_data .= '<option value="' . $cat . '"  data-find="' . $cat . '_finding" ' . $selected . '>' . $category_detail . '</option>';
                                                    //break;
                                                } else {
                                                    $selected = 'selected';
                                                    $category_data .= '<option value="' . $cat . '"  data-id="' . $cat . '_dfghsthrt">' . $category_detail . '</option>';
                                                }
                                            }
                                            echo $category_data;

                                            ?>
                                        </select>
                                    </div>
                                    <?php
                                    $user = get_user_by('ID', $user_id1);
                                    $category_icons = $selected_category[0]->category_icons;
                                    if ($category_icons == "") {
                                        $url = site_url() . '/wp-content/plugins/gmw-premium-settings/assets/map-icons/1.png';
                                    } else {
                                        $url = site_url() . '/wp-content/plugins/gmw-premium-settings/assets/map-icons/' . $category_icons;
                                    }
                                    ?>
                                    <button>
                                        <div class="group_manager_img"><img src="<?php echo $url; ?>"></div>
                                    </button>
                                <?php
                                } ?>

                            </div>
                            <div class="dropdown">
                                <a class="" href="#" role="button" id="ab" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                    </svg></a>
                                <div class="dropdown-menu" aria-labelledby="ab">
                                    <a class="dropdown-item user-remove" data-userid="<?php echo $user_id1; ?>">Remove</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="um-friends-user-btn">
                        <?php if ($user_id2 == get_current_user_id()) {
                            echo '<a href="' . esc_url(um_edit_profile_url()) . '" class="um-friend-edit um-button um-alt">' . __('Edit profile', 'um-friends') . '</a>';
                        } else {
                            echo UM()->Friends_API()->api()->friend_button($user_id2, get_current_user_id(), true);
                        } ?>
                    </div>

                </div>

        <?php
            }
        }
        ?>
        <div class="tab_info_sec">
            <a href="#" data-target="#friends_info" data-toggle="modal">
                <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/05/Info.png" alt="img">
            </a>
        </div>
        <?php
        if (count($friends_list) != 0) {
        }
    } else {
        $results = $wpdb->get_results("SELECT * FROM wp_um_followers where user_id1 =$current_user_id And user_id2=$userId");
        if (!empty($results)) {
            $friends_list = $wpdb->get_results("SELECT * FROM `wp_um_friends` WHERE (`user_id1` = $current_user_id OR `user_id2` = $current_user_id) And status='1'");
            if (count($friends_list) == 0) {
                echo 'No friends Found ';
            } else {
                foreach ($friends_list as $list_of_friends) {
                    $user_id1 = $list_of_friends->user_id1;
                    $user_id2 = $list_of_friends->user_id2;
                    if ($user_id1 == $current_user_id) {
                        $user_id1 = $user_id2;
                    } else if ($user_id2 == $current_user_id) {
                        $user_id1 = $user_id1;
                    }
                    $UserPostMeta = $wpdb->prefix . 'users';
                    $SelectPostMeta = $wpdb->get_row("SELECT * FROM $UserPostMeta WHERE ID = $user_id1");
                    $username = $SelectPostMeta->display_name;
                    $username = str_replace(' ', '-', $username);
        ?>
                <div class="user-friends-section">
                    <div class="user-friend-block">
                        <!-- <div class="chat-with-friend">
                            <a href="<?php //echo site_url(); ?>/your-chats/?new-message&to=<?php //echo $username; ?>&fast=1&scrollToContainer"><img src="<?php //echo site_url(); ?>/wp-content/uploads/2022/01/Chat3.png" alt=""></a>
                        </div> -->
                        <div class="avatar-friend">
                            <a href="<?php echo site_url(); ?>/user/<?php echo $username; ?>" class="" title="<?php echo $username; ?>">
                                <?php
                                /*
                                        um_fetch_user($user_id1);
                                        $profile_image = esc_url(um_get_avatar_uri(um_profile('profile_photo'), 190));
                                        $profile_image_url = trim(strtok($profile_image, '?'));
                                        */


                                if (!filter_var($profile_image_url, FILTER_VALIDATE_URL) === false) {
                                    $real_image = $profile_image_url;
                                } else {
                                    $real_image = "https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png";
                                }

                                ?>
                                <img src="<?php echo $real_image ?>" size="150">

                            </a>
                            <h6>
                                <a href="<?php echo site_url(); ?>/user/<?php echo $username; ?>" title="<?php echo $username; ?>"><?php echo $username; ?></a>

                                <?php do_action('um_friends_list_post_user_name', $user_id1, $user_id2);
                                do_action('um_friends_list_after_user_name', $user_id1, $user_id2); ?>
                            </h6>
                        </div>

                        <div class="option-friend">
                            <div class="select-friend">
                                <?php
                                global $wpdb;
                                $current_user = wp_get_current_user();
                                $current_user_id = $current_user->ID;
                                $author_category_listing = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where author_id =$current_user_id");
                                $selected_result = $wpdb->get_results("SELECT * FROM wp_um_set_priority_by_follower WHERE `follower_id`='" . $user_id1 . "' And user_id='" . $current_user_id . "'");
                                $selected_category = $wpdb->get_results("SELECT * FROM wp_category_created_by_author WHERE `category_value`='" . $selected_result[0]->follower_cat_id . "'");
                                if (!empty($author_category_listing)) {
                                    $category = array();
                                    foreach ($author_category_listing as $category_listing) {
                                        $category[] = $category_listing->category_value;
                                    }
                                ?>
                                    <div class="select_group_manager">
                                        <input type="hidden" name="user_profile_id" value="<?php echo $user_id1; ?>" class="profile_id">
                                        <select name="post_name" class="postname custom_select">

                                            <?php
                                            $category_data = '<option value="0" data-u-id="' . $selected_id . '">Sort later</option>';
                                            foreach ($category as $cat) {
                                                $category_detail = get_cat_name($cat);
                                                if ($cat == $selected_result[0]->follower_cat_id) {
                                                    $selected = 'selected';
                                                    $category_data .= '<option value="' . $cat . '"  data-find="' . $cat . '_finding" ' . $selected . '>' . $category_detail . '</option>';
                                                    //break;
                                                } else {
                                                    $selected = 'selected';
                                                    $category_data .= '<option value="' . $cat . '"  data-id="' . $cat . '_dfghsthrt">' . $category_detail . '</option>';
                                                }
                                            }
                                            echo $category_data;

                                            ?>
                                        </select>
                                    </div>
                                    <?php
                                    $user = get_user_by('ID', $user_id1);
                                    $category_icons = $selected_category[0]->category_icons;
                                    if ($category_icons == "") {
                                        $url = site_url() . '/images/1.png';
                                    } else {
                                        $url = site_url() . '/images/' . $category_icons;
                                    }
                                    ?>
                                    <button>
                                        <div class="group_manager_img"><img src="<?php echo $url; ?>"></div>
                                    </button>
                                <?php
                                } ?>

                            </div>
                            <div class="dropdown">
                                <a class="" href="#" role="button" id="ab" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                    </svg></a>

                            </div>
                        </div>
                    </div>
                    <div class="um-friends-user-btn">
                        <?php if ($user_id2 == get_current_user_id()) {
                            echo '<a href="' . esc_url(um_edit_profile_url()) . '" class="um-friend-edit um-button um-alt">' . __('Edit profile', 'um-friends') . '</a>';
                        } else {
                            echo UM()->Friends_API()->api()->friend_button($user_id2, get_current_user_id(), true);
                        } ?>
                    </div>

                </div>
            <?php
                }
            }
        } 
        else {
            get_template_part('template-parts/profile-page/unlock'); 
        }
    }                
    ?>
</div>