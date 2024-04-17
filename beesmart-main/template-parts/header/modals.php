<div id="et-main-area">


    <div id="myqrcode" style="display:none">
        <?php global $current_user;
        get_currentuserinfo();
        echo "https://beesm.art/user/$current_user->display_name"; ?>

    </div>

    <div class="modal fade qur-code-hover honey_modal custom_trsparent_modal" id="honey">
        <div class="modal-dialog">
            <div class="modal-content p-0" style="max-width:100%">
                <div class="modal-body">
                    <div class="following_header">
                        <div class="profile_page popup">
                            <?php
                            get_template_part('template-parts/profile-page/profile_header', '', idCurrentUser);
                            ?>
                        </div>
                    </div>
                    <div class="honey_modal_content">
                        <div class="honey_box mt-4">
                            <div class="grid">
                                <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Hive.png" alt="img" />
                                <h4><?php global $wpdb;
                                    $current_user = wp_get_current_user();
                                    $current_user_id = $current_user->ID;
                                    $results = $wpdb->get_results("SELECT count(user_id1) as total FROM wp_um_followers where `user_id1` =$current_user_id");
                                    echo $results[0]->total;

                                    ?></h4>
                            </div>
                            <div class="pra">
                                <p><?php the_field('hive_manager_description', 'option'); ?></p>
                            </div>
                        </div>
                        <div class="honey_box mt-5">
                            <div class="grid">
                                <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Honey64A.png" alt="img" />
                                <h4><?php  
								$honey_count = get_user_meta($current_user_id, 'mycred_default', true);
								 $precision = 1;
							 // function number_format_short($n, $precision = 1 ) {
							  if ($honey_count < 900) {
								// 0 - 900
								$n_format = number_format($honey_count, $precision);
								$n_format=intval($n_format);
								$suffix = '';
							  } else if ($honey_count < 900000) {
								// 0.9k-850k
								$n_format = number_format($honey_count / 1000, $precision);
								$suffix = 'K';
							  } else if ($honey_count < 900000000) {
								// 0.9m-850m
								$n_format = number_format($honey_count / 1000000, $precision);
								$suffix = 'M';
							  } else if ($honey_count < 900000000000) {
								// 0.9b-850b
								$n_format = number_format($honey_count / 1000000000, $precision);
								$suffix = 'B';
							  } else {
								// 0.9t+
								$n_format = number_format($honey_count / 1000000000000, $precision);
								$suffix = 'T';
							  }
							  if ( $precision > 0 ) {
								$dotzero = '.' . str_repeat( '0', $precision );
								$n_format = str_replace( $dotzero, '', $n_format );
							  }
							$get_new_data=$n_format . $suffix;
                                    
                                    echo $get_new_data; ?></h4>
                            </div>
                            <div class="pra">
                                <p><?php the_field('honey_points_description', 'option'); ?></p>
                            </div>
                            <a href="<?php echo site_url(); ?>/subscriptions" class="h_more_btn">
                                <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/button-get-more-honey1.png" alt="img" />
                            </a>
                        </div>
                        <div class="honey_box">
                            <div class="grid">
                                <img src="<?php echo imgPATH; ?>Sunflower.png" alt="img" />
                                <h4 class="color_pink">1</h4>
                            </div>
                            <div class="pra">
                                <p><?php the_field('flower_descriptions', 'option'); ?></p>
                            </div>
                            <a href="<?php echo site_url(); ?>/subscriptions" class="h_more_btn">
                                <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/button-get-more-flowers1.png" alt="img" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center tool_modal_footer">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Following Modal -->




     <!-- share modal -->
     <div class="modal fade share_modal custom_trsparent_modal" id="share">
        <?php $is_popup = true; ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="text-center">
                    <img src="<?php echo imgPATH; ?>Friends1-1.png" alt="img" />
                </div>
                <div class="share_modal_group">
                    <div class="earn_hoeny">
                    <img src="<?php echo imgPATH; ?>Most-Honey.png" alt="img" />
                    <p>Earn 500 Honey</p>
                    </div>
                    <div class="change_usd">
                    <img src="<?php echo imgPATH; ?>Cash-prize.png" alt="img" />
                    <p>Chance to win $100 USD</p>
                    </div>
                    <div class="copy_link">
                        <img src="<?php echo imgPATH; ?>Shared-tab.png" alt="img" />
                        <button type="button" onclick="withJquery();" class="p-0 click_animation mr-2 ml-1">COPY</button>
                        <p id="copy-id"><?php echo esc_url(home_url('?mref=')); ?><?php echo $username; ?></p>
                       
                    </div>
                </dvi>
                <!-- Modal body -->
                <div class="share_body">
                    <div class="share_icons">
                            <div class="single_share">
                                <a class="" href="https://www.reddit.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Reddit.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://www.tiktok.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Tiktok1.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://www.youtube.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Youtube.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://www.instagram.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Instagram.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://www.messenger.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Messenger.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://www.skype.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Skype.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://twitter.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Twitter1.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://groupme.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Groupme.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://www.whatsapp.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Whatsapp.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://kik.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Kik.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://www.snapchat.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Snapchat.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://music.apple.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Apple Music.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://www.periscope.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Periscope.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://www.tumblr.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Tumblr1.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://www.linkedin.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Linkedin.png">
                                </a>
                            </div>
                            <div class="single_share">
                                <a class="" href="https://www.facebook.com/" target="_blank">
                                    <img src="<?php echo imgPATH; ?>Facebook.png">
                                </a>
                            </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center tool_modal_footer">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>





    <!-- follwoing updated modal -->
    <div class="modal fade following_modal custom_trsparent_modal" id="hive_manager">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body p-0">

                    <?php
                    //get_template_part('template-parts/profile-page/profile_header', '', idCurrentUser);
                    ?>

                    <div class="following_header">
                        <div class="mb-3 text-center">
                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Hive.png" class="img-fluid">
                        </div>
                        <div class="add-info-updated profile_inner_box">
                            <div class="feeds-tab_add">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="search_feld">
                                            <input type="text" class="form-control">
                                            <img src="<?php echo imgPATH; ?>Search.png" class="search_icon">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <a href="#" class="showhide_sticker"><img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/05/Visibility.png" alt="img"></a>
                                    </div>
                                    <div class="col-5">
                                        <div class="sorting_feed">
                                            <select class="custom_select">
                                                <option selected="" disabled="">Sort by</option>
                                                <option>Last activity</option>
                                                <option>Most followers</option>
                                                <option>A-Z</option>
                                                <option>Z-A</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary add_btn" data-toggle="modal" data-target="#edit_hive">
                                <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Create1.png" alt="add info">
                            </button>
                        </div>
                    </div>

                    <div class="following_bodycolor">
                        <div class="following_body">
                           <div class="manager_list_profile">
							</div>

                            <div id="load_data_message"></div>
                        </div>
                        <div class="Save_content">
                            <a href="#" class="save_content_data">
                                <img width="65" src="<?php echo imgPATH; ?>Check.png">
                            </a>
                        </div>
                    </div>
                </div>
                <!--<a href="#" data-target="#confirmation" data-toggle="modal">confirmation</a>-->
                <div class="modal-footer justify-content-center mt-3">
                    <a class="close_sticker" data-dismiss="modal" aria-label="Close">
                        <img width="55" src="<?php echo imgPATH; ?>X.png">
                    </a>
                </div>
            </div>
            <!-- Modal footer -->
        </div>
    </div>




    <div class="modal fade following_modal custom_trsparent_modal" id="edit_hive">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body p-0">

                    <div class="edit_hive_sec">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Hive.png" class="hive_icon" />
                        <?php
                        $current_user = wp_get_current_user();
                        $current_user_id = $current_user->ID;
                        $results = $wpdb->get_results("SELECT * FROM wp_um_followers where `user_id1` =$current_user_id"); // Query to fetch data from database table and storing in $results
                        if (!empty($results)) // Checking if $results have some values or not
                        {
                        ?>

							<input type="hidden" id="hive_id_listing" value="">
                            <div class="hive_type_main">
                                <?php
                            }
                            $current_user = wp_get_current_user();
                            $current_user_id = $current_user->ID;
                            $own_category_results = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where `author_id` =$current_user_id AND `visibility` IS NULL ORDER BY `position_order` DESC");
                            $gmw_icons = get_option('gmw_icons');
                            $image_link = $gmw_icons['pt_category_icons']['url'];
                            if (!empty($own_category_results)) {
                                $loop = 1;
                                foreach ($own_category_results as $results) {
                                    $category_ids = $results->category_value;
                                    $category_icons = $results->category_icons;
                                    $db_id = $results->id;
                                    $category_name = get_cat_name($category_ids);
                                    if ($category_name != "") {
                                        if ($category_icons == "") {
                                            $category_icons = '1.png';
                                        } else {
                                            $category_icons = $category_icons;
                                        }
                                ?>
                                        <div class="hive_type" id="<?php echo $db_id; ?>">
                                            <span class="edit_hive_dropdown"><?php //echo $loop; 
                                                                                ?>
                                                <div class="dropdown show">
                                                    <?php $random_ = rand(); ?>
                                                    <a class="" href="#" role="button" id="drp_<?php echo $random_; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                        </svg>
                                                    </a>
                                                   <div class="dropdown-menu" aria-labelledby="drp_<?php echo $random_; ?>">
                                                        <a class="dropdown-item" data-target="#removefeed<?php echo $category_ids;?>" data-toggle="modal" data-id="<?php echo $category_ids; ?>" href="#">Remove</a>
                                                        <a class="dropdown-item move_to_up" data-dbid="<?php echo $db_id; ?>" data-id="<?php echo $category_ids; ?>" href="#">Move to up</a>
                                                    </div>
                                                </div>
												<div class="modal following_modal custom_trsparent_modal" id="removefeed<?php echo $category_ids;?>">
												<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header border-0"></div>
															<div class="modal-body text-center mb-5 bg-white rounded">
															<img src="/wp-content/uploads/2022/02/right.png" class="img-fluid mb-2" width="50px">
														
															<p>Do you really want to remove this Hive Category in your listing ?</p>
															<div class="button_listing d-flex">
															
																<a class="btn btn-danger hide_hive_category" data-val="1" data-dismiss="modal" data-catid="<?php echo $db_id;?>" style="color:#000;">Keep in feeds</button>
																<a class="ml-2 btn btn-danger hide_hive_category" data-val="2" href="#" data-catid="<?php echo $db_id;?>" style="color:#000;">Remove In feeds</a>
															</div>
														</div>
													</div>
													<div class="modal-footer justify-content-center">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												</div>
											</div>
                                            </span>
                                            <input type="text" name="category_list" value="<?php echo $category_name; ?>" placeholder="Enter your category name" class="form-control form-control category_list" readonly>
                                            <div class="select_edit" data-toggle="modal" data-target="#edit_to_category_<?php echo $category_ids; ?>">
                                                <div class="select_sticker" id="image_<?php echo $category_ids; ?>">
                                                    <img src="<?php echo $image_link . '' . $category_icons; ?>">
                                                </div>
                                                <!--<a href="#" data-toggle="modal" data-target="#edit_to_category_<?php echo $category_ids; ?>">Edit</a> -->
                                            </div>
											
                                            <div class="modal fade custom_trsparent_modal search_filter edit_to_category edit_category_modal edit_to" id="edit_to_category_<?php echo $category_ids; ?>">
                                                <div class="modal-dialog  modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header border-0">
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body pt-0">
                                                            <div class="search_filter_steps">
                                                                <div class="saved_feed_search">
                                                                    <input type="text" class="form-control" placeholder="Enter your feed name" id="category_<?php echo $category_ids; ?>" name="name-feed" value="<?php echo $category_name; ?>">
                                                                </div>
                                                                <div class="saved_feed_block">

                                                                    <div class="select_sticker save_icons_block ml-0">
                                                                        <?php global $wpdb;

                                                                        $working_dir = getcwd();
                                                                        $img_dir = $working_dir . "/images/";
                                                                        chdir($img_dir);

                                                                        //using glob() function get images 
                                                                        $files = glob("*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}", GLOB_BRACE);
                                                                        chdir($working_dir);
                                                                        shuffle($files);
                                                                        for ($i = 0; $i < 16; $i++) {
                                                                            if ($files[$i] != "") {
                                                                                $new_updated_link = '/images/' . rawurlencode($files[$i]);
                                                                                echo "<div class='item icon_item active'><img src='$new_updated_link' />  </div>";
                                                                            } else {
                                                                                $new_updated_link = $image_link . '' . '1.png';
                                                                                echo "<div class='item icon_item active'><img src='$new_updated_link' />  </div>";
                                                                            }
                                                                        }
                                                                        ?>


                                                                    </div>
                                                                    <button class="reload_category random_category">
                                                                        <img src="<?php echo imgPATH; ?>Check1.png">
                                                                    </button>
                                                                    <button class="update_category" data-cat="<?php echo $category_ids; ?>">
                                                                        <img src="<?php echo imgPATH; ?>Check.png">
                                                                    </button>
                                                                    <!-- </form>-->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer justify-content-center tool_modal_footer mt-3">
                                                            <a id="feed-create-close-btn" data-dismiss="modal">
                                                                <img src="<?php echo imgPATH; ?>X.png">
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                <?php
                                        $loop++;
                                    }
                                }
                            } else {
                                ?>

                            <?php
                            }
                            ?>
                            </div>
                    </div>
                    <div class="add_hive">
                        <a href="#" data-toggle="modal" data-target="#add_to_category">
                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Create1.png" />

                        </a>
                    </div>
                    <div class="tool_check text-center pt-0" >
                        <a href="#" id="submit_hive_category">
                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Check1.png">
                        </a>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </div>




    <div class="modal fade custom_trsparent_modal search_filter edit_category_modal" id="add_to_category">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header border-0">
                </div>

                <!-- Modal body -->
                <div class="modal-body pt-0">
                    <div class="search_filter_steps">
                        <div class="saved_feed_block">
                            <!-- <form name="configform" id="configform">-->
                            <div class="saved_feed_search">
                                <input type="text" class="form-control new_category_listing" placeholder="Enter Your category" />
                            </div>
                            <div class="select_sticker save_icons_block">
                                <?php global $wpdb;


                                $working_dir = getcwd();
                                $img_dir = $working_dir . "/images/";
                                chdir($img_dir);


                                $files = glob("*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}", GLOB_BRACE);
                                chdir($working_dir);
                                shuffle($files);
                                for ($i = 0; $i < 16; $i++) {
                                    if ($files[$i] != "") {
                                        $new_updated_link = '/images/' . rawurlencode($files[$i]);
                                        echo "<div class='item icon_item '><img src='$new_updated_link' />  </div>";
                                    } else {
                                        $new_updated_link = $image_link . '' . '1.png';
                                        echo "<div class='item icon_item'><img src='$new_updated_link' />  </div>";
                                    }
                                }
                                ?>


                            </div>

                            <button class="reload_category random_category">
                                <img src="<?php echo imgPATH; ?>Check1.png">
                            </button>
                            <button class="update_category_button load_category">
                                <img src="<?php echo imgPATH; ?>Check.png">
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer justify-content-center tool_modal_footer">
                    <a class="feed-create-close-btn" data-dismiss="modal">
                        <img src="<?php echo imgPATH; ?>X.png">
                    </a>

                </div>

            </div>
        </div>
    </div>


    <div class="modal following_modal custom_trsparent_modal" id="confirmation">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close close_2nd" data-dismiss="modal">×</button>
                </div>

                <div class="modal-body text-center mb-5 bg-white rounded">
                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/right.png" class="img-fluid mb-2" width="50px">
                    <h3>Are You Sure?</h3>
                    <p>Do you really want to remove this user?</p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closebuttonpopup">No
                    </button>
                    <a class="btn btn-danger ml-2" href="#">Yes</a>
                </div>
            </div>
        </div>
    </div>

</div>
