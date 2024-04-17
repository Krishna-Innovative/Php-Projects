 <div class="addHive-block">
	<?php global $wpdb;
	$user_id =  get_the_author_ID();
	$current_user_id = idCurrentUser;
	//echo $user_id.'--'.$current_user_id;
	if ($user_id != $current_user_id) { 
	?>
	<?php $savedHives = isFollowed($current_user_id, $user_id);
		if (empty($savedHives)){ ?>
	<button	data-type="addhive" type="button" @click="toggle" class="click_animation hover_hue hivvdropdown_button"  data-feed-id="<?php echo absint($user_id); ?>">
		<img data-type="addhive" src="<?php echo imgPATH ?>Add-to-hive.png">
	</button>
	<?php }
			else{ 
				$hive_ids = explode(',', $savedHives[0]->follower_cat_id);
				$hive_slider = '';
				foreach($hive_ids as $hive_id){
					$hive_icon = $wpdb->get_results("SELECT `category_icons` FROM `wp_category_created_by_author` WHERE `category_value` = $hive_id  ");
					$hive_slider .= '
					<div class="item">
						<div class="selectblock new_class0">
							<img src="/images/'. $hive_icon[0]->category_icons .'">
						</div>
					</div>';
				}
				?>
				<button data-type="addhive" type="button" @click="toggle" class="click_animation hover_hue hivvdropdown_button" data-feed-id="<?php echo absint($user_id); ?>">
					<div class="category_images client1 owl-carousel owl-theme"><?php  echo $hive_slider;   ?></div>
				</button>
			<?php }
		?>	
	<div class="hivvdropdown hive_option_<?php echo absint($user_id); ?> hidden">
		<div class="hivvdropdown_search">
			<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Hive.png" class="hive_icon">
			<input type="text" class="form-control">
			<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/search.png" class="search_icon">
		</div>
		<ul class="hivvdropdown_list other-profile list_of_checkbox<?php echo absint($user_id); ?>" data-id="<?php echo absint($user_id); ?>">
			<?php
				$author_category_listing = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where author_id =$current_user_id");
				// debug($author_category_listing);

				if (!empty($author_category_listing)) {
					$category = array();
					foreach ($author_category_listing as $category_listing) {
						$category[] = $category_listing->category_value;
					}

					$selected_result = $wpdb->get_results("SELECT * FROM wp_um_set_priority_by_follower WHERE `follower_id`='" . $follower_ids . "' And user_id='" . $current_user_id . "'");
					// if hive wasnt fount 
					if (empty($selected_result)) {

						foreach ($category as $category) {
							$selected = 'selected';
							$category_detail = get_cat_name($category);
							$category_data .= '<li class="nav-item"><input type="checkbox" id="hive' . $category . '" name="" data-hive value="' . $category . '">
								<label for="hive' . $category . '"><img src="' . site_url() . '/wp-content/uploads/2022/05/Hives-Sort-later.png"> <span>' . $category_detail . '</span></label></li>';
							$selected = '';
						}
					} 
					else {
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
								$category_data .= '<li class="nav-item"><input type="checkbox" id="hive' . $cat . '" name="" value="' . $cat . '">
									<label for="hive' . $cat . '"><img src="' . site_url() . '/images/' . $final_category_stickers . '"> <span>' . $category_detail . '</span></label>
								</li>';
							} else {
								$find_images = $wpdb->get_results("SELECT * FROM wp_category_created_by_author WHERE `category_value`='" . $cat . "' And author_id='" . $current_user_id . "'");

								foreach ($find_images as $selected_image) {
									$final_category_stickers = $selected_image->category_icons;
									$final_category_stickers = site_url() . '/images/' . $final_category_stickers;
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
				?>
		</ul>
		<button class="hover_hue click_animation p-0 hivedrop_down_button" data-type="shadow">
			<img src="<?php echo site_url(); ?>/wp-content/themes/beesmart-main/assets/images/Check.png" data-type="shadow" width="60" data-id="<?php echo absint($user_id); ?>">
		</button>
	</div>
	<?php } ?>
</div>