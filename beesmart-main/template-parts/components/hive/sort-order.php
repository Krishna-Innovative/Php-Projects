<?php
$subscribed_users=$args;
//echo '--------------------------';
if ( ! empty( $subscribed_users ) ) {
    $user_own_hive = is_user_have_own_hive();
    if (!empty($user_own_hive)) {
        $category = array();
        foreach ($user_own_hive as $category_listing) {
            $category[] = $user_own_hive->category_value;
        }
        foreach ($subscribed_users as $follower_data) {
            $follower_ids = $follower_data['user_id2'];
            if ($follower_ids != '0') {
                $get_author_id = get_the_author_meta($follower_ids);
                // debug($follower_data);
                $hives_to_which_the_user_has_been_added = is_subscriber_have_hive_which_the_user_has_been_added(get_current_user_id(), $follower_ids);
                if ( !empty( $hives_to_which_the_user_has_been_added ) ) {
                    //var_dump($follower_ids); ?>
                    <div class="single_follower">
                        <div class="single_following user_follow_<?php echo $follower_ids; ?>">
                            <input type="hidden" name="post_name_<?php echo $follower_ids; ?>[]" id="post_name_<?php echo $follower_ids; ?>" value="<?php echo $follower_ids; ?>">
                            <div class="prof" data-url="<?php //echo $real_image; ?>">
                                <div class="hiveuser_image">
                                    <a class="user_page_link" href='<?php echo site_url(); ?>/author/<?php echo get_the_author_meta("user_nicename", $follower_ids); ?>' target='_blank'>
                                        <?php if (get_user_meta($follower_ids, 'user_avatar_url', true)) {
                                            apply_filters('previewRender', get_user_meta($follower_ids, 'user_avatar_url', true));
                                        }
                                        else {
                                            echo '<img src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png" />';
                                        }
                                        ?>
                                    </a>
                                </div>
                                <span>
                                    <?php echo get_the_author_meta("display_name", $follower_ids); ?>
                                </span>
                                <!-- <div class="safe_sec">
                                    <img src="<?php //echo imgPATH; ?>Visibility.png">
                                    <img src="<?php //echo imgPATH; ?>Verified.png">
                                </div> -->
                            </div>
                            <div class="select_group_manager">
                                <div class="group_manager_img">
                                    <div class="category_images client<?php echo $follower_ids; ?> owl-carousel owl-theme">
                                        <?php //do_action('hive_list', $hives_to_which_the_user_has_been_added[0]->follower_cat_id);   ?>
                                    </div>
                                </div>
                                <div class="addHive-block">
                                    <div class="hive_btnblock">
                                        <div class="animated_image">
                                            <img src="<?php echo imgPATH; ?>Hives-Sort-later.png">
                                        </div>
                                        <button data-type="addhive" type="button" class="custom_select hivvdropdown_button" data-feed-id="<?php echo $follower_ids; ?>">
                                            Sort later
                                        </button>
                                    <?php
                                    $args =  $follower_ids;
                                    get_template_part('template-parts/components/hive/dropdown', '', $args); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="p_drop">
                                <div class="dropdown">
                                    <a class="" href="#" role="button" id="ab<?php echo $randome_number; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="ab<?php echo $randome_number; ?>">
                                        <a class="dropdown-item user-remove" data-target="#removeconfirmation<?php echo $follower_ids; ?>" data-toggle="modal" data-userid="<?php echo $follower_ids; ?>">Delete</a>
                                        <a class="dropdown-item user-hide" data-target="#confirmation<?php echo $follower_ids; ?>" data-toggle="modal" data-userid="<?php echo $follower_ids; ?>">Hide</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- hide popup -->
                        <div class="modal following_modal custom_trsparent_modal" id="confirmation<?php echo $follower_ids; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header border-0"></div>
                                    <div class="modal-body text-center mb-5 bg-white rounded">
                                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/right.png" class="img-fluid mb-2" width="50px">
                                        <h3>Are You Sure?</h3>
                                        <p>Do you really want to hide this user in your listing ?</p>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" class="closebuttonpopup">No</button>
                                        <a class="btn btn-danger ml-2 cancel_successfully" href="#" data-userid="<?php echo $follower_ids; ?>">Yes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- remove popup -->
                        <div class="modal following_modal custom_trsparent_modal" id="removeconfirmation<?php echo $follower_ids; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header border-0"></div>
                                    <div class="modal-body text-center mb-5 bg-white rounded">
                                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/right.png" class="img-fluid mb-2" width="50px">
                                        <h3>Are You Sure?</h3>
                                        <p>Do you really want to remove this user in your listing ?</p>
                                        <button type="button" class="UnsubscribePopup-closeBtn" data-dismiss="modal">No</button>
                                        <a class="ml-2 remove_successfully" href="#" data-userid="<?php echo $follower_ids; ?>">Yes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
                }
            }
        }
    }
} ?>