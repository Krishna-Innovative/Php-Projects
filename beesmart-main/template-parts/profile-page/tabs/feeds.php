<?php
global $wpdb;
$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;
//$userId = get_the_author_ID(); 
$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
$userId=$author->ID;
$stiker = stickerPATH;
?><div class="tab-pane fade" id="feeds" role="tabpanel" aria-labelledby="feeds-tab">

    <?php
    if ($current_user_id == $userId) { ?>
			<div class="add-info-updated">
				<div class="feeds-tab_add">
					<div class="row">
						<div class="col-5">
							<div class="search_feld">
								<input type="text" class="form-control" >
								<img src="<?php echo imgPATH;  ?>Search.png" class="search_icon" >
							</div>
						</div>
						<div class="col-2"></div>
						<div class="col-5">
							<div class="sorting_feed">
								<select class="custom_select" id="sort_by_feed" >
									<option selected="">Sort by</option>
									<option>Last activity</option>
									<option>Most followers</option>
									<option value="asc">A-Z</option>
									<option value="dsc">Z-A</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<button type="button" class="btn btn-primary add_btn" >
					 <img src="<?php echo imgPATH; ?>Create1.png" alt="add info">
				</button>
		   </div>
        <div class="saved_feed_items">
            <div class="select_savefeed_icon">
                <img width="40" src="<?php echo imgPATH;  ?>Feeds1.png">
            </div>
            <ul>
                 <?php
                $userfeeds = get_user_meta($current_user_id, 'beesmart-filter-feed-options', true);
				$userfeeds=array_sort($userfeeds, 'position_order', SORT_DESC);
				if(empty($userfeeds)){
					$userfeeds = get_user_meta($current_user_id, 'beesmart-filter-feed-options', true);
				}
				get_template_part( 'template-parts/profile-page/tabs/find-feed-order',null,$userfeeds);
				
			
                ?>
            </ul>
        </div>


        <?php
    } else {
        $results = $wpdb->get_results("SELECT * FROM wp_um_followers where user_id1 =$current_user_id And user_id2=$userId");
        if (empty($results)) {
			?>
			<div class="add-info-updated disable unfollowed_user">
				<div class="feeds-tab_add">
					<div class="row">
						<div class="col-5">
							<div class="search_feld">
								<input type="text" class="form-control" disabled>
								<img src="<?php echo imgPATH;  ?>Search.png" class="search_icon" disabled>
							</div>
						</div>
						<div class="col-2"></div>
						<div class="col-5">
							<div class="sorting_feed">
								<select class="custom_select" id="sort_by_feed" disabled>
									<option selected="" disabled="">Sort by</option>
									<option>Last activity</option>
									<option>Most followers</option>
									<option value="asc">A-Z</option>
									<option value="dsc">Z-A</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<button type="button" class="btn btn-primary add_btn" disabled>
					 <img src="<?php echo imgPATH; ?>Create1.png" alt="add info">
				</button>
		   </div>
			<?php
			 get_template_part( 'template-parts/components/dropdown_hive' );
        } else {

        ?>
		<div class="add-info-updated">
		 <div class="feeds-tab_add">
            <div class="row">
                <div class="col-5">
                    <div class="search_feld">
                        <input type="text" class="form-control" value="" id="feed_val_search">
                        <img src="<?php echo imgPATH;  ?>Search.png" class="search_icon" id="feed_have_search">
                    </div>
                </div>
                <div class="col-2"></div>
                <div class="col-5">
                    <div class="sorting_feed">
                        <select class="custom_select" id="sort_by_feed">
                            <option selected="" disabled="">Sort by</option>
                            <option>Last activity</option>
                            <option>Most followers</option>
                            <option value="asc">A-Z</option>
                            <option value="dsc">Z-A</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
		
		<button type="button" class="btn btn-primary add_btn" data-toggle="modal" data-target="#edit_hive">
            <img src="<?php echo imgPATH; ?>Create1.png" alt="add info">
        </button>
	</div>
            <div class="saved_feed_items select_feedlist">
                <ul>
                    <?php
                    $userfeeds = get_user_meta($current_user_id, 'beesmart-filter-feed-options', true);

                    if (!empty($userfeeds)) {
                        foreach ($userfeeds as $user_feed) {
                            $feed_have = $user_feed['feed_have'];
                            $visibility = $user_feed['visibility'];
							if ($visibility != 1) {
								$display="";
							}else{
								$display="display:none";
							}
                                $explicit_content = $user_feed['explicit_content'];
                                $explicit_content1 = $user_feed['explicit_content'];
                                $feed_id = $user_feed['feed_id'];

                    ?>
                                <li id="feed_<?php echo $feed_id; ?>" data-id="<?php echo $feed_id; ?>" style="<?php echo $display;?>">
                                    <div class="saved_icon d-flex align-items-center">
                                        <div class="select_savefeed disable" data-target="#single_save_feed<?php echo $feed_id; ?>" data-toggle="modal">
                                            <img width="30" src="/wp-content/uploads/2022/01/Feeds1.png" data-image-id="<?php echo $feed_have; ?>">
                                            <span class="saved_text">Saved</span>
                                        </div>
                                        <img width="30" src="<?php echo site_url() . '/images/' . $feed_have; ?>">
                                        <span class="highlight_custom_menu"><?php echo $user_feed['feedname']; ?></span>
                                    </div>
                                    <div class="saved_private">
                                        <?php

                                        if ($explicit_content == 1) {
                                           echo '<img width="30" src="/wp-content/uploads/2022/05/Copy-of-Warning.png">';
                                        } else {
                                            echo '';
                                            $explicit_class = "disable";
                                            $explicit_content = '0';
                                        }
                                        ?>
                                    </div>
                                </li>
				<div class="modal fade custom_trsparent_modal abcc search_filter edit_category_modal single_feed_modal edit_feed_modal" id="single_save_feed<?php echo $feed_id; ?>">
					<div class="modal-dialog  modal-dialog-centered">
						<div class="modal-content d-block">
						<?php  	get_template_part('template-parts/profile-page/profile_header', '', $current_user_id); ?> 
							<div class="modal-header border-0 p-0">
								<img src="/wp-content/uploads/2022/01/Feeds1.png" />
								<h5>Edit</h5>
							</div>
							<div class="modal-body pt-0">
								<div class="writing_group">
									<img src="<?php echo $stiker.$user_feed['feed_have']; ?>" class="selected_sticker">
									<input type="text" value="<?php echo $user_feed['feedname']; ?>" class="form-control readd" placeholder="Enter Your category" readonly />
									<img src="/wp-content/uploads/2022/05/Visibility.png" class="visibility_icon <?php echo $visibility_class; ?>">
									<img src="/wp-content/uploads/2022/05/Copy-of-Warning.png" class="warning_icon <?php echo $explicit_class; ?> ">
								</div>

								<div class="edit_feed_heading">
									<h6><input type="text" value="<?php echo $user_feed['feedname']; ?>" class="form-control edit_feed_listing_<?php echo $feed_id; ?>" placeholder="Enter Your category" /></h6>
								</div>
								<div class="search_filter_steps">
									<div class="saved_feed_block">
										<div class="select_sticker save_icons_block">
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
													echo "<div class='item icon_item active'><img  data-id=$feed_id src=$new_updated_link>  </div>";
												} else {
													$new_updated_link = $image_link . '' . '1.png';
													echo "<div class='item icon_item active'><img data-id=$feed_id src=$new_updated_link>  </div>";
												}
											}
											?>
											<!-- <input type="hidden" value="<?php echo $feed_have; ?>" id="feed_have" name="feed_have" />-->
											<input type="hidden" value="<?php echo $feed_have; ?>" name="imageexist_<?php echo $feed_id; ?>" id="imageexist_<?php echo $feed_id; ?>">
											<input type="hidden" id="pagecount" name="pagecount" value="1" />
										</div>

										<button class="reload_btn">
											<img src="<?php echo imgPATH;  ?>Check1.png">
										</button>
										<button class="confirm_feed_update" data-id="<?php echo $feed_id; ?>">
											<input type="hidden" name="edit_feed_function" class="edit_feed_function" value="">
											<img src="<?php echo imgPATH;  ?>Check.png">
										</button>
									</div>
								</div>
								<div class="edit_feeds_btns">
									<a href="#" class="visibility_btn <?php echo $visibility_class; ?>" data-id="<?php echo $feed_id; ?>"> <img src="<?php echo imgPATH;?>Feeds1.png">
										<p>Open</p>
									</a>
									<a href="#" class="warning_btn <?php echo $explicit_class; ?>" data-id="<?php echo $feed_id; ?>"> <img src="<?php echo imgPATH;?>Safe-1.png">
										<p>Safe</p>
									</a>
									<input type="hidden" id="visibility_btn_<?php echo $feed_id; ?>" value="<?php echo $visibility; ?>">
									<input type="hidden" id="warning_btn_<?php echo $feed_id; ?>" value="<?php echo $explicit_content; ?>">
								</div>
							</div>

							<div class="modal-footer justify-content-center tool_modal_footer">
								<a class="feed-create-close-btn" data-dismiss="modal">
									<img src="<?php echo imgPATH; ?>X.png">
								</a>
							</div>
						</div>
					</div>
				</div>


                        <?php
                            
                        }
                        ?>
                        <input type="hidden" value="<?php echo $userId; ?>" id="um_profile_id">
                </ul>
            </div>

<?php
                    } else {
                        echo 'No Feed found';
                    }
                }
            }
?>
<div class="tab_info_sec">
    <a href="#" data-target="#feeds_info" data-toggle="modal">
        <img src="<?php echo imgPATH; ?>Info.png" alt="img">
    </a>
</div>
</div>
