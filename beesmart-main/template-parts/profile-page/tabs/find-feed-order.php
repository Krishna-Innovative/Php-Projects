<?php
$userfeeds=$args;
if (!empty($userfeeds)) {
	foreach ($userfeeds as $user_feed) {
		$feed_have = $user_feed['feed_have'];
		$feed_id = $user_feed['feed_id'];
		$visibility = $user_feed['visibility'];
		$explicit_content = $user_feed['explicit_content'];
		$explicit_content1 = $user_feed['explicit_content'];
		$distribution = $user_feed['distribution'];
		$feed_id = $user_feed['feed_id'];
		$parent_visibility_feed_id = $user_feed['parent_visibility_feed_id'];
		if ($parent_visibility_feed_id == "1") {
			$non_clickable = "disable not_clickable";
			$hide_edit_profile = "hide_edit_profile";
		} else {
			$non_clickable = "";
			$hide_edit_profile = "";
		}
		?>
		<li id="feed_<?php echo $feed_id; ?>" class="<?php echo $non_clickable; ?>" data-feedid="<?php echo $feed_id;?>">
			<div class="savefeeds_number">
				<span><?php echo $distribution; ?></span>
			</div>
			<div class="saved_icon"><img width="30" src="<?php echo site_url() . '/images/' . $feed_have; ?>" data-image-id="<?php echo $feed_have; ?>">
				<span class="highlight_custom_menu"><?php echo $user_feed['feedname']; ?></span>
			</div>
			<div class="saved_private">
				<?php
				if ($visibility == 1) {
					echo '<img width="30" src="/wp-content/uploads/2022/05/Visibility.png">';
					$visibility_class = "";
				} else {
					echo '';
					$visibility_class = "disable";
				}
				if ($explicit_content == 1) {
					echo '<img width="30" src="/wp-content/uploads/2022/05/Copy-of-Warning.png">';
				} else {
					echo '';
					$explicit_class = "disable";
					$explicit_content = '0';
				}
				$randome_number = rand(); ?>
				<div class="dropdown <?php echo $hide_edit_profile; ?>">
					<a class="" href="#" role="button" id="ab<?php echo $randome_number; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
							<path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
						</svg>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="ab<?php echo $randome_number; ?>" x-placement="bottom-start">
						<a href="#" class="dropdown-item user-hide">Source</a>
						<a class="dropdown-item user-hide" data-target="#edit_feed<?php echo $feed_id; ?>" data-toggle="modal" data-userid="<?php echo $feed_id; ?>">Edit</a>
						<a href="#" class="dropdown-item user-hide move_up_feed" data-moveid="<?php echo $feed_id; ?>">Move up</a>
						<a class="dropdown-item user-hide" data-target="#deletefeed<?php echo $feed_id; ?>" data-toggle="modal" data-userid="">Delete</a>
					</div>
				</div>
				<div class="modal fade custom_trsparent_modal abcc search_filter edit_category_modal edit_feed_modal" id="edit_feed<?php echo $feed_id; ?>">
					<div class="modal-dialog  modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header border-0 p-0">
								<img src="/wp-content/uploads/2022/01/Feeds1.png" />
								<h5>Edit</h5>
							</div>
							<div class="modal-body pt-0">
								<div class="writing_group">
									<img src="<?php echo site_url(); ?>/images/<?php echo $feed_have; ?>" class="selected_sticker">
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
									<a href="#" class="visibility_btn <?php echo $visibility_class; ?>" data-id="<?php echo $feed_id; ?>"> <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/05/Visibility.png">
										<p>Sharing</p>
									</a>
									<a href="#" class="warning_btn <?php echo $explicit_class; ?>" data-id="<?php echo $feed_id; ?>"> <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/05/Copy-of-Warning.png">
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
				<div class="modal following_modal custom_trsparent_modal" id="deletefeed<?php echo $feed_id; ?>" aria-modal="true" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header border-0">
								<!-- 						<button type="button" class="close close_2nd" data-dismiss="modal">×</button> -->
							</div>
							<div class="modal-body text-center mb-5 bg-white rounded">
								<img src="<?php echo imgPATH; ?>Warning.png" class="img-fluid mb-2" width="50px">
								<h3>Are You Sure?</h3>
								<p>Do you really want to delete this feed ?</p>
								<button type="button" class="btn btn-secondary closebuttonpopup" data-userid="<?php echo $feed_id; ?>" data-dismiss="modal">No</button>
								<a class="btn btn-danger ml-2 delete_feed" href="#" data-userid="<?php echo $feed_id; ?>">Yes</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>
	<?php
	}
} else {
	echo 'No Feed found';
}
                ?>