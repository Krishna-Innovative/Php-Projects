		<div class="tab-pane fade" id="buzz" role="tabpanel" aria-labelledby="buzz-tab">

			<?php
			$rating = UM()->Reviews()->api()->get_rating($author_id);
			//echo $user_id.'sferfrgertgwre';
			?>
			<div class="um-member-rating">
				<span class="um-reviews-avg" data-number="5" data-score="<?php echo esc_attr($rating); ?>"></span>
			</div>
			<div class="um-field" data-key="">
				<div class="um-field-label"><strong><?php _e('User Reviews', 'um-reviews'); ?></strong></div>

				<?php if ($show_new_reviews) { ?>
					<div class="um-field-area">
						<label class="um-field-checkbox<?php if (!empty($_enable_new_reviews)) { ?> active<?php } ?>">
							<input type="checkbox" name="_enable_new_reviews" value="1" <?php checked(!empty($_enable_new_reviews)) ?> />
							<span class="um-field-checkbox-state"><i class="um-icon-android-checkbox-<?php if (!empty($_enable_new_reviews)) { ?>outline<?php } else { ?>outline-blank<?php } ?>"></i></span>
							<span class="um-field-checkbox-option"><?php echo __('I have got a new review', 'um-reviews'); ?></span>
						</label>
						<div class="um-clear"></div>
					</div>
				<?php }

				if ($show_new_reviews_reply) { ?>
					<div class="um-field-area">
						<label class="um-field-checkbox<?php if (!empty($_enable_new_reviews_reply)) { ?> active<?php } ?>">
							<input type="checkbox" name="_enable_new_reviews_reply" value="1" <?php checked(!empty($_enable_new_reviews_reply)) ?> />
							<span class="um-field-checkbox-state"><i class="um-icon-android-checkbox-<?php if (!empty($_enable_new_reviews_reply)) { ?>outline<?php } else { ?>outline-blank<?php } ?>"></i></span>
							<span class="um-field-checkbox-option"><?php echo __('I have got a new review reply', 'um-reviews'); ?></span>
						</label>
						<div class="um-clear"></div>
					</div>
				<?php } ?>
			</div>
			<?php
			if (UM()->Reviews()->api()->can_reply($author_id, $review_id)) {

				um_fetch_user($author_id); ?>

				<div class="um-reviews-reply-post review-reply-form review-reply-new-form">

					<a href="javascript:void(0);" class="um-reviews-reply-cancel-edit um-new-review-reply-cancel"><i class="um-icon-close"></i></a>

					<form class="um-reviews-reply-form" action="<?= admin_url('admin-ajax.php?action=um_reviews_reply'); ?>" method="post">

						<span class="um-reviews-reply-meta">
							<?php printf(__('by <a href="%s">%s</a>, %s', 'um-reviews'), um_user_profile_url(), um_user('display_name'), date(UM()->options()->get('review_date_format'), time())); ?>
						</span>

						<span class="um-reviews-reply-content">
							<textarea name="content" placeholder="<?php esc_attr_e('Enter your reply...', 'um-reviews'); ?>"></textarea>
						</span>

						<div class="um-field-error" style="display:none;"></div>

						<span class="um-reviews-reply-send">
							<input type="submit" value="<?php esc_attr_e('Reply', 'um-reviews'); ?>" class="um-button" />
						</span>

						<input type="hidden" name="review_id" value="<?php echo esc_attr($review_id); ?>" />

						<input type="hidden" name="profile_id" value="<?php echo esc_attr($author_id); ?>" />

						<?php wp_nonce_field('um_reviews_reply_send'); ?>
					</form>

				</div>

			<?php }

			um_fetch_user($r->user_id); ?>


			<div class="um-reviews-reply-item">

				<div class="um-reviews-reply-img">
					<a href="<?php echo esc_url(um_user_profile_url($r->user_id)); ?>">
						<?php echo um_user('profile_photo', 40); ?>
					</a>
				</div>

				<div class="um-reviews-reply-post review-reply-list">

					<span class="um-reviews-reply-meta">
						<?php printf(__('by <a href="%s">%s</a>, %s', 'um-reviews'), um_user_profile_url(), um_user('display_name'), date(UM()->options()->get('review_date_format'), strtotime($r->comment_date))); ?>
					</span>

					<span class="um-reviews-reply-content">
						<p><?php echo esc_html($r->comment_content); ?></p>
					</span>


					<!--front actions-->
					<?php
					$args = compact('review_id', 'reviewer_id', 'profile_id', 'r');
					UM()->get_template('reply-front-actions.php', um_reviews_plugin, $args, true);
					?>

				</div>

				<!--edit form-->
				<?php
				$args = compact('review_id', 'reviewer_id', 'profile_id', 'r');
				UM()->get_template('reply-edit.php', um_reviews_plugin, $args, true);
				?>
				<div class="um-clear"></div>
			</div>

			<span class="um-reviews-detail">
				<span class="um-reviews-d-s">
					<a href="<?php echo esc_url($star_rating_url); ?>"><?php echo $star_rating_text; ?></a>
				</span>
				<a href="<?php echo esc_url($star_rating_url); ?>" class="um-reviews-d-p um-tip-n" title="<?php echo sprintf(__('%s reviews (%s)', 'um-reviews'), $count_of_reviews, $progress . '%'); ?>">
					<span data-width="<?php echo $progress; ?>"></span>
				</a>
				<span class="um-reviews-d-n"><?php echo $count_of_reviews; ?></span>
			</span>
			<?php
			if (UM()->Reviews()->api()->can_reply($author_id, $review_id)) { ?>

				<div class="um-reviews-reply"><a href="javascript:void(0);"><i class="um-faicon-reply"></i> <span><?php _e('Reply', 'um-reviews'); ?></span></a></div>

			<?php }


			if (UM()->Reviews()->api()->can_flag($review_id)) { ?>

				<div class="um-reviews-flag"><a href="javascript:void(0);"><i class="um-faicon-flag"></i> <span><?php _e('Report', 'um-reviews'); ?></span></a></div>

			<?php }

			if ($reviewer_id == $my_id && UM()->Reviews()->api()->already_reviewed($user_id)) { ?>

				<div class="um-reviews-edit"><a href="javascript:void(0);"><i class="um-faicon-pencil"></i> <span><?php _e('Edit', 'um-reviews'); ?></span></a></div>

			<?php } elseif (UM()->Reviews()->api()->can_edit($reviewer_id)) { ?>

				<div class="um-reviews-edit"><a href="javascript:void(0);"><i class="um-faicon-pencil"></i> <span><?php _e('Edit', 'um-reviews'); ?></span></a></div>

			<?php }

			if (UM()->Reviews()->api()->can_remove($reviewer_id)) { ?>

				<div class="um-reviews-remove"><a href="javascript:void(0);" data-review_id="'. $review_id .'" data-remove="<?php esc_attr_e('Are you sure you want to remove this review?', 'um-reviews'); ?>"><i class="um-faicon-trash"></i> <span><?php _e('Remove', 'um-reviews'); ?></span></a></div>

			<?php }
			if (UM()->Reviews()->api()->already_reviewed($author_id)) {
				$my_id = get_current_user_id();
			} else {
				$my_id = null;
			}

			foreach ($reviews as $review) {
				setup_postdata($review);
				$content = wp_strip_all_tags($review->post_content);

				$reviewer_id = get_post_meta($review->ID, '_reviewer_id', true);
				$reviewer = get_userdata($reviewer_id);
				um_fetch_user($reviewer_id);
			?>

				<div class="um-reviews-item" id="review-<?php echo esc_attr($review->ID); ?>" data-review_id="<?php echo esc_attr($review->ID); ?>" data-user_id="<?php echo esc_attr($author_id); ?>">

					<div class="um-reviews-img">
						<a href="<?php echo esc_url(um_user_profile_url($reviewer_id)); ?>"><?php echo um_user('profile_photo', 40); ?></a>
					</div>

					<div class="um-reviews-post review-list">
						<span class="um-reviews-avg" data-number="5" data-score="<?php echo esc_attr(get_post_meta($review->ID, '_rating', true)); ?>"></span>
						<span class="um-reviews-title"><span><?php echo get_the_title($review); ?></span></span>
						<span class="um-reviews-meta"><?php printf(__('by <a href="%s">%s</a>, %s', 'um-reviews'), um_user_profile_url(), um_user('display_name'), get_the_time(UM()->options()->get('review_date_format'), $review)); ?></span>
						<span class="um-reviews-content"><?php echo nl2br($content); ?></span>
						<?php if (UM()->Reviews()->api()->is_flagged($review->ID)) { ?>
							<div class="um-reviews-flagged"><?php esc_html_e('This is currently being reviewed by an admin', 'um-reviews'); ?></div>
						<?php } ?>
						<div class="um-reviews-note"></div>
						<div class="um-reviews-tools"><?php do_action('um_review_front_actions', $author_id, $reviewer_id, $my_id, $review->ID); ?></div>
					</div>

					<div class="um-reviews-post review-form swed">

						<a href="javascript:void(0);" class="um-reviews-cancel-edit"><i class="um-icon-close"></i></a>

						<form class="um-reviews-form" action="" method="post">

							<span class="um-reviews-rate" data-key="rating" data-number="5" data-score="<?php echo esc_attr(get_post_meta($review->ID, '_rating', true)); ?>"></span>

							<span class="um-reviews-title"><input type="text" name="title" placeholder="<?php esc_attr_e('Enter subject...', 'um-reviews'); ?>" value="<?php echo esc_attr($review->post_title); ?>" /></span>

							<span class="um-reviews-meta"><?php printf(__('by <a href="%s">%s</a>, %s', 'um-reviews'), um_user_profile_url(), um_user('display_name'), current_time(UM()->options()->get('review_date_format'))); ?></span>

							<span class="um-reviews-content">
								<textarea name="content" placeholder="<?php esc_attr_e('Enter your review...', 'um-reviews'); ?>"><?php echo esc_textarea(isset($content) ? $content : ''); ?></textarea>
							</span>

							<input type="hidden" name="user_id" id="user_id1" value="<?php echo esc_attr($author_id); ?>" />
							<input type="hidden" name="reviewer_id" id="reviewer_id1" value="<?php echo esc_attr(get_current_user_id()); ?>" />
							<input type="hidden" name="action1" id="action1" value="um_review_edit" />
							<input type="hidden" name="nonce1" id="action1" value="<?php echo wp_create_nonce('um-frontend-nonce') ?>" />

							<input type="hidden" name="review_id" id="review_id" value="<?php echo esc_attr($review->ID); ?>" />
							<input type="hidden" name="rating_old" id="rating_old" value="<?php echo esc_attr(get_post_meta($review->ID, '_rating', true)); ?>" />
							<input type="hidden" name="reviewer_publish" id="reviewer_publish" value="<?php echo esc_attr(UM()->roles()->um_user_can('can_publish_review')); ?>" />

							<div class="um-field-error" style="display:none"></div>

							<span class="um-reviews-send">
								<input type="submit" value="<?php esc_attr_e('Save Review', 'um-reviews'); ?>" class="um-button" />
							</span>

						</form>

					</div>
					<div class="um-clear"></div>

					<?php do_action('um_review_after_review_content', $review->ID, $reviewer_id, $author_id); ?>

					<div class="um-clear"></div>

				</div>

			<?php }

			um_reset_user();
			wp_reset_postdata();
			wp_reset_query();
			?>
			<div class="um-reviews-none">

				<?php echo (um_is_myprofile()) ? __('You have not received any reviews yet.', 'um-reviews') : __('This user did not receive any other reviews.', 'um-reviews'); ?>

			</div>
			<div class="um-reviews-none">

				<?php echo (um_is_myprofile()) ? __('You have not received any reviews yet.', 'um-reviews') : __('This user did not receive any reviews yet.', 'um-reviews'); ?>

			</div>
			<div class="um-reviews-header">
				<span class="um-reviews-header-span">
					<?php if (um_is_myprofile()) {
						_e('Your Rating', 'um-reviews');
					} else {
						_e('User Rating', 'um-reviews');
					} ?>
				</span>
				<span class="um-reviews-avg" data-number="5" data-score="<?php echo esc_attr(UM()->Reviews()->api()->get_rating()); ?>"></span>
			</div>

			<div class="um-reviews-avg-rating"><?php echo UM()->Reviews()->api()->avg_rating(); ?></div>

			<div class="um-reviews-details">
				<?php UM()->Reviews()->api()->get_details();

				if (UM()->Reviews()->api()->get_filter()) { ?>

					<span class="um-reviews-filter"><?php printf(__('(You are viewing only %s star reviews. <a href="%s">View all reviews</a>)', 'um-reviews'), UM()->Reviews()->api()->get_filter(), remove_query_arg('filter')); ?></span>

				<?php } ?>
			</div>
			<?php

			do_action('um-reviews-widget--before', $users, $list_class);
			?>

			<ul class="um-reviews-widget <?php echo esc_attr($list_class); ?>">

				<?php
				foreach ($users->results as $user_id) {

					um_fetch_user($user_id);

					$rating = UM()->Reviews()->api()->get_avg_rating($user_id);
					$count = UM()->Reviews()->api()->get_reviews_count($user_id);
				?>

					<li>

						<div class="um-reviews-widget-pic">
							<a href="<?php echo um_user_profile_url(); ?>"><?php echo get_avatar($user_id, 40); ?></a>
						</div>

						<div class="um-reviews-widget-user">

							<div class="um-reviews-widget-name"><a href="<?php echo um_user_profile_url(); ?>"><?php echo um_user('display_name'); ?></a></div>

							<div class="um-reviews-widget-rating"><span class="um-reviews-avg" data-number="5" data-score="<?php echo UM()->Reviews()->api()->get_rating($user_id); ?>"></span></div>

							<?php if ($count == 1) { ?>
								<div class="um-reviews-widget-avg"><?php printf(__('%s average based on %s review', 'um-reviews'), $rating, $count); ?></div>
							<?php } else { ?>
								<div class="um-reviews-widget-avg"><?php printf(__('%s average based on %s reviews', 'um-reviews'), $rating, $count); ?></div>
							<?php } ?>

						</div>
						<div class="um-clear"></div>

					</li>

				<?php } ?>

			</ul>

			<?php do_action('um-reviews-widget-after', $users, $list_class); ?>


			<?php
			$current_user = wp_get_current_user();
			$current_user_id = $current_user->ID;
			if ($author_id == $current_user_id) {
			?>
				<div class="buzz-tab">
					<div class="user_rating-table add-info-updated">
						<div class="row align-items-center">
							<div class="col-4">
								<div class="rating_type">
									<?php

									//$user_ID = $author_id;
									$review_avg = get_user_meta($author_id, '_reviews_avg', true);

									if ($review_avg > 4 && $review_avg <= 5) {
										$reaction = imgPATH . "score-5.png";
									} else if ($review_avg > 3 && $review_avg <= 4) {
										$reaction = imgPATH . "score-4.png";
									} else if ($review_avg > 2 && $review_avg <= 3) {
										$reaction = imgPATH . "score-3.png";
									} else if ($review_avg > 1 && $review_avg <= 2) {
										$reaction = imgPATH . "score-2.png";
									} else {
										$reaction = imgPATH . "score-1.png";
									}
									?>
									<img src="<?php echo $reaction; ?>" />
									<?php
									//$user_ID = $author_id;
									$review_count = get_user_meta($author_id, '_reviews_total', true);
									if ($review_count > 0) {
									?>
										<a href="#" data-toggle="modal" data-target="#viewing">See table</a>
									<?php
									}
									?>
								</div>
							</div>
							<div class="col-4">
								<h2 class="total_amount"><?php
															//$user_ID = $author_id;
															echo get_user_meta($author_id, '_reviews_total', true); ?></h2>
							</div>
							<div class="col-4">
								<div class="user_comments">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/User-Profile-Buzz-tab.png" />
									<a href="#" data-toggle="modal" data-target="#viewing2">Public activity</a>
								</div>
							</div>
						</div>
						<a class="buzz_share" data-target="#share" data-toggle="modal">
							<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Share2.png" alt="">
						</a>
					</div>
					<?php
					$current_user = wp_get_current_user();
					$current_user_id = $current_user->ID;
					if ($author_id != $current_user_id) {
					?>
						<div class="review_swapping">
							<div class="select_rating">
								<div class="score" id="score-1">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/03/score-1.png" />
								</div>
								<div class="score" id="score-2">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/03/score-2.png" />
								</div>
								<div class="score selected-score" id="score-3">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/03/score-3.png" />
								</div>
								<div class="score" id="score-4">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/03/score-4.png" />
								</div>
								<div class="score" id="score-5">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/03/score-5.png" />
								</div>
							</div>
							<div class="review_box creation_box score-3">
								<div class="review_box_inner">
									<div class="user-img">
										<?php

										um_fetch_user($current_user_id);
										$profile_image = esc_url(um_get_avatar_uri(um_profile('profile_photo'), 190));
										$profile_image_url = trim(strtok($profile_image, '?'));


										if (!filter_var($profile_image_url, FILTER_VALIDATE_URL) === false) {
											$admin_image = $profile_image_url;
										} else {
											$admin_image = "https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png";
										}
										?>
										<img src="<?php echo $admin_image; ?>" />
									</div>
									<div class="review_input">

										<?php

										if (UM()->Reviews()->api()->can_review($author_id)) {

											um_fetch_user(get_current_user_id()); ?>

											<div class="um-reviews-item">

												<div class="um-reviews-img"><a href="<?php echo esc_url(um_user_profile_url()); ?>"><?php echo um_user('profile_photo', 40); ?></a></div>
												<div class="um-reviews-prepost"><i class="um-faicon-pencil"></i> <?php _e('Write a review for this user', 'um-reviews'); ?></div>

												<div class="um-reviews-post review-new">

													<span class="um-reviews-avg" data-number="5" data-score="0"></span>

													<span class="um-reviews-title"></span>

													<span class="um-reviews-meta">
														<?php printf(__('by <a href="%s">%s</a>, %s', 'um-reviews'), um_user_profile_url(), um_user('display_name'), current_time(UM()->options()->get('review_date_format'))); ?>
													</span>

													<span class="um-reviews-content"></span>

													<div class="um-reviews-note"></div>

													<div class="um-reviews-tools"></div>

												</div>

												<div class="um-reviews-post review-form dcfdfd">

													<a href="javascript:void(0);" class="um-reviews-cancel-add"><i class="um-icon-close"></i></a>

													<form class="um-reviews-form" action="" method="post">

														<span class="um-reviews-rate" data-key="rating" data-number="5" data-score="0"></span>

														<span class="um-reviews-title">
															<input type="text" required="required" name="title" placeholder="<?php esc_attr_e('Enter subject...', 'um-reviews'); ?>" maxlength="60" />
														</span>

														<span class="um-reviews-meta">
															<?php printf(__('by <a href="%s">%s</a>, %s', 'um-reviews'), um_user_profile_url(), um_user('display_name'), current_time(UM()->options()->get('review_date_format'))); ?>
														</span>

														<span class="um-reviews-content">
															<textarea name="content" required="required" placeholder="<?php esc_attr_e('Enter your review...', 'um-reviews'); ?>"></textarea>
														</span>

														<input type="hidden" name="user_id2" id="user_id2" value="<?php echo esc_attr($author_id); ?>" />
														<input type="hidden" name="reviewer_id2" id="reviewer_id2" value="<?php echo esc_attr(get_current_user_id()); ?>" />
														<input type="hidden" name="reviewer_publish2" id="reviewer_publish2" value="<?php echo esc_attr(um_user('can_publish_review')); ?>" />
														<input type="hidden" name="action2" id="action2" value="um_review_add" />
														<input type="hidden" name="nonce2" id="nonce2" value="<?php echo wp_create_nonce('um-frontend-nonce') ?>" />

														<div class="um-field-error" style="display:none"></div>

														<span class="um-reviews-send"><input type="submit" value="<?php esc_attr_e('Submit Review', 'um-reviews'); ?>" class="um-button" /></span>

													</form>

												</div>
												<div class="um-clear"></div>

											</div>

										<?php
											um_fetch_user($userId);
										}
										if (!is_user_logged_in()) { ?>

											<div class="um-reviews-item">
												<?php

												$login_url = add_query_arg('redirect_to', add_query_arg(array('profiletab' => 'reviews'), um_user_profile_url()), um_get_core_page('login'));
												printf(__('You are not logged in. Please <a href="%s">login</a> to review this user.', 'um-reviews'), $login_url);

												?>
											</div>

										<?php } ?>


									</div>

									<div class="review_type_icon review_type_icon_present">
										<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/03/score-3.png" />
									</div>
								</div>
							</div>
							<div class="review_check" id="review_button_custom">
								<a href="#">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Check1.png" />
								</a>
							</div>

						</div>
					<?php
					} ?>


					<?php

					//$user_ID = $author_id;
					global $wpdb;
					$list_of_comment = $wpdb->get_results("SELECT * FROM `wp_posts` WHERE `post_author` = $author_id AND `post_type` = 'um_review' ");
					foreach ($list_of_comment as $comment) {
						//echo '<pre>';print_r($comment);echo '</pre>';
						$post_content = $comment->post_content;
						$post_title = $comment->post_title;
						$post_ID = $comment->ID;
						$commented_id = get_post_meta($post_ID, '_reviewer_id', true);
						$review_rating = get_post_meta($post_ID, '_rating', true);
						if ($review_rating > 4 && $review_rating <= 5) {
							$reaction = imgPATH . "score-5.png";
							$class = 'score-5';
						} else if ($review_rating > 3 && $review_rating <= 4) {
							$reaction = imgPATH . "score-4.png";
							$class = 'score-4';
						} else if ($review_rating > 2 && $review_rating <= 3) {
							$reaction = imgPATH . "score-3.png";
							$class = 'score-3';
						} else if ($review_rating > 1 && $review_rating <= 2) {
							$reaction = imgPATH . "score-2.png";
							$class = 'score-2';
						} else {
							$reaction = imgPATH . "score-1.png";
							$class = 'score-1';
						}
					?>
						<div class="review_box <?php echo $class; ?>">
							<div class="review_box_inner">
								<div class="user-img">
									<?php um_fetch_user($commented_id);
									$profile_image = esc_url(um_get_avatar_uri(um_profile('profile_photo'), 190));
									$profile_image_url = trim(strtok($profile_image, '?'));


									if (!filter_var($profile_image_url, FILTER_VALIDATE_URL) === false) {
										$real_image = $profile_image_url;
									} else {
										$real_image = "https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png";
									}
									?>

									<a href="<?php echo site_url(); ?>/user/<?php echo get_the_author_meta('display_name', $commented_id); ?>"> <img src="<?php echo $real_image; ?>" /></a>

									<?php $user_verified = get_user_meta($user_ID, '_um_verified', true);
									if ($user_verified == "verified") {
									?>
										<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Verified.png" class="verified_icon" />
									<?php
									} else {
										//echo '<img src="https://mpng.subpng.com/20190303/aqu/kisspng-logo-brand-font-product-line-your-home-for-health-achhadoctor-in-5c7c8f19d4cff5.0460816115516669698717.jpg" class="verified_icon">';
									}
									?>

								</div>
								<span class="user_comment"><?php echo $post_title; ?></span>
								<span class="user_name"><?php echo $post_content ?></span>
								<div class="review_type_icon">
									<img src="<?php echo $reaction; ?>" />
								</div>
							</div>

						</div>

					<?php

					}
					?>
					<div class="tab_info_sec">
							<a href="#" data-target="#buzz_info" data-toggle="modal">
								<img src="<?php echo imgPATH; ?>Info.png" alt="img">
							</a>
						</div>
					<div class="modal fade custom_trsparent_modal" id="viewing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-body">
									<div class="viewing_buzz">
										<div class="todal_viewing_buzz">
											<img src="<?php echo imgPATH; ?>Bee.png" />
											<h6><?php
												//$user_ID = $author_id;
												echo get_user_meta($author_id, '_reviews_total', true); ?></h6>
										</div>
										<div id="rating_row_id">

										</div>
									</div>
								</div>
								<div class="modal-footer justify-content-center">
									<a href="#" class="" data-dismiss="modal" aria-label="Close">
										<img src="<?php echo imgPATH; ?>X.png" width="40px">
									</a>
								</div>
							</div>
						</div>
					</div>

				</div>
				<?php
			} else {
				global $wpdb;
				$current_user = wp_get_current_user();
				$current_user_id = $current_user->ID;
				$results = $wpdb->get_results("SELECT * FROM wp_um_followers where user_id1 =$current_user_id And user_id2=$author_id");
				if (!empty($results)) {
				?>
					<div class="buzz-tab">
						<div class="user_rating-table add-info-updated">
							<div class="row align-items-center">
								<div class="col-4">
									<div class="rating_type">
										<?php

										//$user_ID = $author_id;
										$review_avg = get_user_meta($author_id, '_reviews_avg', true);

										if ($review_avg > 4 && $review_avg <= 5) {
											$reaction = site_url() . "/wp-content/uploads/2022/03/score-5.png";
										} else if ($review_avg > 3 && $review_avg <= 4) {
											$reaction = site_url() . "/wp-content/uploads/2022/03/score-4.png";
										} else if ($review_avg > 2 && $review_avg <= 3) {
											$reaction = site_url() . "/wp-content/uploads/2022/03/score-3.png";
										} else if ($review_avg > 1 && $review_avg <= 2) {
											$reaction = site_url() . "/wp-content/uploads/2022/03/score-2.png";
										} else {
											$reaction = site_url() . "/wp-content/uploads/2022/03/score-1.png";
										}
										?>
										<img src="<?php echo $reaction; ?>" />
										<?php
										//$user_ID = $author_id;
										$review_count = get_user_meta($author_id, '_reviews_total', true);
										if ($review_count > 0) {
										?>
											<a href="#" data-toggle="modal" data-target="#viewing">See table</a>
										<?php
										}
										?>
									</div>
								</div>
								<div class="col-4">
									<h2 class="total_amount"><?php
																//$user_ID = $author_id;
																echo get_user_meta($author_id, '_reviews_total', true); ?></h2>
								</div>
								<div class="col-4">
									<div class="user_comments">
										<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/User-Profile-Buzz-tab.png" />
										<a href="#" data-toggle="modal" data-target="#viewing2">Public activity</a>
									</div>
								</div>
							</div>
						</div>

						<div class="review_swapping">
							<div class="select_rating">
								<div class="score" id="score-1">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/03/score-1.png" />
								</div>
								<div class="score" id="score-2">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/03/score-2.png" />
								</div>
								<div class="score selected-score" id="score-3">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/03/score-3.png" />
								</div>
								<div class="score" id="score-4">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/03/score-4.png" />
								</div>
								<div class="score" id="score-5">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/03/score-5.png" />
								</div>
							</div>
							<div class="review_box creation_box score-3">
								<div class="review_box_inner">
									<div class="user-img">
										<?php
										$current_user = wp_get_current_user();
										$current_user_id = $current_user->ID;
										um_fetch_user($current_user_id);
										$profile_image = esc_url(um_get_avatar_uri(um_profile('profile_photo'), 190));
										$profile_image_url = trim(strtok($profile_image, '?'));


										if (!filter_var($profile_image_url, FILTER_VALIDATE_URL) === false) {
											$admin_image = $profile_image_url;
										} else {
											$admin_image = "https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png";
										}
										?>
										<img src="<?php echo $admin_image; ?>" />
									</div>
									<div class="review_input">

										<?php

										if (UM()->Reviews()->api()->can_review($author_id)) {

											um_fetch_user(get_current_user_id()); ?>

											<div class="um-reviews-item">

												<div class="um-reviews-img"><a href="<?php echo esc_url(um_user_profile_url()); ?>"><?php echo um_user('profile_photo', 40); ?></a></div>
												<div class="um-reviews-prepost"><i class="um-faicon-pencil"></i> <?php _e('Write a review for this user', 'um-reviews'); ?></div>

												<div class="um-reviews-post review-new">

													<span class="um-reviews-avg" data-number="5" data-score="0"></span>

													<span class="um-reviews-title"></span>

													<span class="um-reviews-meta">
														<?php printf(__('by <a href="%s">%s</a>, %s', 'um-reviews'), um_user_profile_url(), um_user('display_name'), current_time(UM()->options()->get('review_date_format'))); ?>
													</span>

													<span class="um-reviews-content"></span>

													<div class="um-reviews-note"></div>

													<div class="um-reviews-tools"></div>

												</div>

												<div class="um-reviews-post review-form edede">

													<a href="javascript:void(0);" class="um-reviews-cancel-add"><i class="um-icon-close"></i></a>

													<form class="um-reviews-form" action="" method="post">

														<span class="um-reviews-rate" data-key="rating" data-number="5" data-score="0"></span>

														<span class="um-reviews-title">
															<input type="text" required="required" name="title" placeholder="<?php esc_attr_e('Enter subject...', 'um-reviews'); ?>" maxlength="60" />
														</span>

														<span class="um-reviews-meta">
															<?php printf(__('by <a href="%s">%s</a>, %s', 'um-reviews'), um_user_profile_url(), um_user('display_name'), current_time(UM()->options()->get('review_date_format'))); ?>
														</span>

														<span class="um-reviews-content">
															<textarea name="content" required="required" placeholder="<?php esc_attr_e('Enter your review...', 'um-reviews'); ?>"></textarea>
														</span>

														<input type="hidden" name="user_id" id="user_id_233" value="<?php echo $author_id; ?>" />
														<input type="hidden" name="reviewer_id" id="reviewer_id_233" value="<?php echo esc_attr(get_current_user_id()); ?>" />
														<input type="hidden" name="reviewer_publish" id="reviewer_publish_233" value="<?php echo esc_attr(um_user('can_publish_review')); ?>" />
														<input type="hidden" name="action" id="action_233" value="um_review_add" />
														<input type="hidden" name="nonce" id="nonce_233" value="<?php echo wp_create_nonce('um-frontend-nonce') ?>" />

														<div class="um-field-error" style="display:none"></div>

														<span class="um-reviews-send"><input type="submit" value="<?php esc_attr_e('Submit Review', 'um-reviews'); ?>" class="um-button" /></span>

													</form>

												</div>
												<div class="um-clear"></div>

											</div>

										<?php
											um_fetch_user($author_id);
										}else{
											echo 'Thanks for sharing Review for this User';
										}
										if (!is_user_logged_in()) { ?>

											<div class="um-reviews-item">
												<?php

												$login_url = add_query_arg('redirect_to', add_query_arg(array('profiletab' => 'reviews'), um_user_profile_url()), um_get_core_page('login'));
												printf(__('You are not logged in. Please <a href="%s">login</a> to review this user.', 'um-reviews'), $login_url);

												?>
											</div>

										<?php } ?>


									</div>

									<div class="review_type_icon review_type_icon_present">
										<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/03/score-3.png" />
									</div>
								</div>
							</div>

							<div class="review_check" id="review_button_custom">
								<a href="#">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Check1.png" />
								</a>
							</div>

						</div>



						<?php
					//	$user_ID = $author_id;
						global $wpdb;
						$list_of_comment = $wpdb->get_results("SELECT * FROM `wp_posts` WHERE `post_author` = $author_id AND `post_type` = 'um_review' ");

						foreach ($list_of_comment as $comment) {

							$post_content = $comment->post_content;
							$post_title = $comment->post_title;
							$post_ID = $comment->ID;
							$review_rating = get_post_meta($post_ID, '_rating', true);
							if ($review_rating > 4 && $review_rating <= 5) {
								$reaction = site_url() . "/wp-content/uploads/2022/03/score-5.png";
								$class = 'score-5';
							} else if ($review_rating > 3 && $review_rating <= 4) {
								$reaction = site_url() . "/wp-content/uploads/2022/03/score-4.png";
								$class = 'score-4';
							} else if ($review_rating > 2 && $review_rating <= 3) {
								$reaction = site_url() . "/wp-content/uploads/2022/03/score-3.png";
								$class = 'score-3';
							} else if ($review_rating > 1 && $review_rating <= 2) {
								$reaction = site_url() . "/wp-content/uploads/2022/03/score-2.png";
								$class = 'score-2';
							} else {
								$reaction = site_url() . "/wp-content/uploads/2022/03/score-1.png";
								$class = 'score-1';
							}
						?>
							<div class="review_box <?php echo $class; ?>">
								<div class="review_box_inner">
									<div class="user-img">
										<?php um_fetch_user($userId);
										$profile_image = esc_url(um_get_avatar_uri(um_profile('profile_photo'), 190));
										$profile_image_url = trim(strtok($profile_image, '?'));


										if (!filter_var($profile_image_url, FILTER_VALIDATE_URL) === false) {
											$real_image = $profile_image_url;
										} else {
											$real_image = "https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png";
										}
										?>
										<img src="<?php echo $real_image; ?>" />

										<?php $user_verified = get_user_meta($userId, '_um_verified', true);
										if ($user_verified == "verified") {
										?>
											<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Verified.png" class="verified_icon" />
										<?php
										} else {
											echo '<img src="https://mpng.subpng.com/20190303/aqu/kisspng-logo-brand-font-product-line-your-home-for-health-achhadoctor-in-5c7c8f19d4cff5.0460816115516669698717.jpg" class="verified_icon">';
										}
										?>

									</div>
									<span class="user_comment"><?php echo $post_title; ?></span>
									<span class="user_name"><?php echo $post_content ?></span>
									<div class="review_type_icon">
										<img src="<?php echo $reaction; ?>" />
									</div>
								</div>
							</div>
						<?php

						}
						?>
						<div class="modal fade custom_trsparent_modal" id="viewing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body">
										<div class="viewing_buzz">
											<div class="todal_viewing_buzz">
												<img src="<?php echo imgPATH; ?>Bee.png" />
												<h6><?php
													//$user_ID = $author_id;
													echo get_user_meta($author_id, '_reviews_total', true); ?></h6>
											</div>
											<div id="rating_row_id">

											</div>
										</div>
									</div>
									<div class="modal-footer justify-content-center">
										<a href="#" class="" data-dismiss="modal" aria-label="Close">
											<img src="<?php echo imgPATH; ?>X.png" width="40px">
										</a>
									</div>
								</div>
							</div>
						</div>

					</div>
				<?php
				} else {
				?>
					<div class="follow-block">
						<?php get_template_part( 'template-parts/profile-page/unlock' ); ?>
				</div>
				<?php
			}
			}
			
			?>

		</div>