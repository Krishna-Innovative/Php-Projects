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