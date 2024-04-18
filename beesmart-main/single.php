<?php acf_form_head(); ?>

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/scss/user.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/scss/single.css">

<div class="post_detail_page">
	<?php
	get_header();
	global $wpdb;
	global $post;
	$post_id = get_the_ID();

	$meta = get_post_meta($post_id);
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$location_data = get_field('f_map');
	$url = get_field('f_url');
	$format = $meta['f_custom_post_format'][0];
	$user_id = get_current_user_id();
	$UserPostMeta = $wpdb->prefix . 'users';
	$SelectPostMeta = $wpdb->get_row("SELECT * FROM $UserPostMeta WHERE ID = '$user_id' ");
	$username = $SelectPostMeta->display_name;
	?>

	<!-- 1 section start in wp  -->
	<div id="post-page" class="inner_mainsection inner_main_page_section_cls">
		<div class="container">
			<div class="profile_page">
				<?php 
				// debug($meta);
				get_template_part('template-parts/profile-page/profile_header', '', authorID);  ?>

				<?php get_template_part('template-parts/components/add_hive'); ?>

				<!-- <div class="align-items-center mt-4 book_mark_block">
					<?php //echo do_shortcode('[um_bookmarks_button post_id="' . get_the_ID() . '"]'); ?>
				</div> -->

				<div class="profile_tabs" id="singlepost_tabs">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a data-type="shadow" class="nav-link click_animation active" id="shared-tab" data-toggle="tab" href="#shared" role="tab" aria-controls="shared" aria-selected="true">
								<img data-type="shadow" src="<?php echo imgPATH; ?>Shared-tab.png" />
								<span>Shared</span>
							</a>
						</li>
						<li class="nav-item">
							<a data-type="shadow" class="nav-link click_animation" id="backpack-tab" data-toggle="tab" href="#backpack" role="tab" aria-controls="backpack" aria-selected="true">
								<img data-type="shadow" src="<?php echo imgPATH; ?>Backpack.png" />
								<span>Backpack</span>
							</a>
						</li>
						<li class="nav-item">
							<a data-type="shadow" class="nav-link click_animation" id="sharepost-tab" data-toggle="tab" href="#sharepost" role="tab" aria-controls="sharepost" aria-selected="false">
								<img data-type="shadow" src="<?php echo imgPATH; ?>Share2.png" />
								<span>Share</span>
							</a>
						</li>
						<li class="nav-item">
							<a data-type="shadow" class="nav-link click_animation" id="tags-tab" data-toggle="tab" href="#tags" role="tab" aria-controls="tags" aria-selected="false">
								<img data-type="shadow" src="<?php echo imgPATH; ?>Tags.png" />
								<span>Tags</span>
							</a>
						</li>
						<li class="nav-item ">
							<a data-type="shadow" class="nav-link click_animation" id="chat-tab" data-toggle="tab" href="#chat" role="tab" aria-controls="chat" aria-selected="false">
								<img data-type="shadow" src="<?php echo imgPATH; ?>chat.png" />
								<span>Chat</span>
							</a>
						</li>
					</ul>
					<div class="profile_inner_box"></div>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="shared" role="tabpanel" aria-labelledby="shared-tab">
							<div class="add-info-updated">
								<div class="singleinfo_detail">
									<div class="shared_tab_honey">
										<?php 
										$love_count=get_post_meta($post_id, 'love_me_like', true);
										$precision = 1;
										 // function number_format_short($n, $precision = 1 ) {
										  if ($love_count < 900) {
											// 0 - 900
											$n_format = number_format($love_count, $precision);
											$n_format=intval($n_format);
											$suffix = '';
										  } else if ($love_count < 900000) {
											// 0.9k-850k
											$n_format = number_format($love_count / 1000, $precision);
											$suffix = 'K';
										  } else if ($love < 900000000) {
											// 0.9m-850m
											$n_format = number_format($love_count / 1000000, $precision);
											$suffix = 'M';
										  } else if ($love < 900000000000) {
											// 0.9b-850b
											$n_format = number_format($love_count / 1000000000, $precision);
											$suffix = 'B';
										  } else {
											// 0.9t+
											$n_format = number_format($love_count / 1000000000000, $precision);
											$suffix = 'T';
										  }
										  if ( $precision > 0 ) {
											$dotzero = '.' . str_repeat( '0', $precision );
											$n_format = str_replace( $dotzero, '', $n_format );
										  }
										$get_new_data=$n_format . $suffix;
										$love_ip = get_post_meta( $post_id, 'love_me_ips', true );

										$love_ip = unserialize($love_ip);
										$class = '';
										$checked = '';
										if(!empty($love_ip)) {
											$ip_client = $_SERVER['REMOTE_ADDR'];
											if(in_array($ip_client, $love_ip)) {
												$class = ' liked';
												$checked = 'checked';
											}
										}
										?>
										<span class="LoveCount">
											<button data-type="drophoney" class="love click_animation p-0 <?php echo $class;?>"><input id="post_<?php echo $post_id;?>" type="checkbox" class="LoveCheck">
                <label for="post_<?php echo $post_id;?>" class="dashicons dashicons-heart LoveLabel" aria-label="like this" data-type="drophoney"></label><span class="LoveCount" id="LoveCount_<?php echo $post_id;?>"><?php echo $get_new_data; ?></span></button>
											</span>
									</div>
									<div class="honey_pot">
										<img src="<?php echo imgPATH; ?>Most-Honey.png" alt="">
										<div class="honey_pot_detail">
											<ul>
												<li>
													<img src="<?php echo imgPATH; ?>Most-Honey.png" alt="">
													<span class="total_honey_percentage">
														<?php $coins_points = get_user_meta($current_user_id, 'mycred_default', true);
														echo intval($coins_points);
														?>
													</span>
												</li>
												<li class="select_item_background">
													<div class="select_group">
														<div class="select">1%</div>
														<input type="hidden" value="1" name="one_value">
													</div>
													<span class="one_percentage">
														<?php $coins_points = get_user_meta($current_user_id, 'mycred_default', true);
														$total = ($coins_points / 100) * 1;
														echo intval($total); ?>
													</span>
												</li>
												<li class="select_item_background">
													<div class="select_group">
														<div class="select">10%</div>
														<input type="hidden" value="10" name="ten_value">
													</div>
													<span class="tenth_percentage">
														<?php $coins_points = get_user_meta($current_user_id, 'mycred_default', true);
														$total = ($coins_points / 100) * 10;
														echo intval($total); ?>
													</span>
												</li>
												<li class="honey_input">
													<input type="number" class="form-control" id="percentage_coins" onkeypress="if(this.value.length==2) return false;" />
													<p class="inputlabel">%</p>
													<span>0</span>
												</li>
												<li>
													<a href="" class="verify_percentage" data-post="<?php echo $post_id;?>">
														<img src="<?php // echo site_url(); 
																	?>/wp-content/uploads/2022/01/Check1.png" alt="">
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="post-img">
										<img src="<?php do_action('post_format'); ?>" />
									</div>
									<div class="like_block">
										<div class="bee_icon">
											<a href="#">
												<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Most-Views.png" alt="bee">
											</a>
										</div>
										<span class="linkCount"> <?php echo get_comments_number(); ?></span>
									</div>
								</div>
								<div class="singlepost_timer">
									<?php get_template_part('template-parts/components/timer'); ?>
								</div>
							</div>
							<div class="post_detail_single">
								<div class="post-wrapper">
									<div class="post-block">


									</div>

									<!-- CONTENT START -->
									<h2 class="post_tittle">
										<?php the_title(); ?>
									</h2>
									<p class="post_description">
										<span><?php echo $post->post_content; ?></span>
									</p>
								</div>
								<div class="post-thumbnail">
									<div class="loading"></div>
									<div class="container-resposne csingle">
										  <?php apply_filters( 'previewRender', get_field('f_url') ); ?>
									</div>
								</div>

							</div>
						</div>

						<div class="tab-pane fade" id="backpack" role="tabpanel" aria-labelledby="backpack-tab">
							<div class="add-info-updated">
								<?php	echo do_shortcode( '[um_user_bookmarks]' );
										echo do_shortcode( '[um_bookmarks_button post_id="' . get_the_ID() . '"]' );  ?>
							</div>

						</div>
						<div class="tab-pane fade" id="sharepost" role="tabpanel" aria-labelledby="sharepost-tab">
							<div class="add-info-updated">
								<div class="sharepost_copy">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Embed.png">
									<p id="copy-id1"><?php echo esc_url(home_url('?mref=')); ?><?php echo $username; ?></p>
									<button type="button" onclick="withJquery();">Copy</button>
								</div>
							</div>

							<div class="social_links">
								<a href="#" title="Twitter"><img src="<?php echo imgPATH; ?>/twitter.png"></a>
								<a href="#" title="Tiktok"><img src="<?php echo imgPATH; ?>/tiktok.png"></a>
								<a href="#" title="Facebook"><img src="<?php echo imgPATH; ?>/facebook-3.png"></a>
								<a href="#" title="Tumblr"><img src="<?php echo imgPATH; ?>/tumblr.png"></a>
							</div>

						</div>
						<div class="tab-pane fade" id="tags" role="tabpanel" aria-labelledby="tags-tab">
							<div class="add-info-updated">
								<?php if ($location_data['address']) { ?>
									<div class="post_location">
										<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/location1.png">
										<p><?php echo $location_data['address']; ?></p>
									</div>
								<?php } else {
								?>
									<div class="post_location">
										<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/location1.png">
										<p><?php echo 'United State'; ?></p>
									</div>
								<?php } ?>
							</div>
							<div class="tags_area">
								<?php
								$post_tags = get_the_tags();

								if ($post_tags) {
									foreach ($post_tags as $tag) {
								?> <span class="tag">
											<?php echo $tag->name ?>
										</span><?php
											}
										}
												?>
							</div>


						</div>
						<div class="tab-pane fade" id="chat" role="tabpanel" aria-labelledby="chat-tab">
							<div class="main_public_chat">
								<div class="public_chat_header">
									<div class="chat_header1 add-info-updated">

										<div class="chat_header_content">
											<p class="mb-0">This is space for a disclaimer. By clicking 'join' you agree to abide by the terms
												and conditions.</p>
											<p class="mb-0">- By good to each other, we're all got.</p>
										</div>
										<div class="join_chat">
											<button id="join_chat_btn">
												<img src="<?php echo imgPATH; ?>/Button-Join-public-chat.png" alt="img">
											</button>
										</div>
									</div>


								</div>
								<section style="display:none" class="chat_section">
									<div class="chat_header2">
										<img src="<?php echo imgPATH; ?>Bee.png" alt="img" class="bee_icon">
										<b>Messages: <span><?php comments_number(); ?> </span></b>
										<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/image-1.png" alt="img" class="chat_icon">
									</div>
									<?php
									if (comments_open() || get_comments_number()) : comments_template();
									endif;
									?>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- </div> -->

	<!-- end jquery in wp  -->
	<?php get_footer(); ?>
</div>
<style>
	.single .liked label.dashicons.dashicons-heart.LoveLabel {
		background: url(/wp-content/uploads/2022/06/Honey-splat-1.png)! important;
		background-size: contain! important;
	}
	.shared_tab_honey .liked {
		pointer-events: none;
	}
	</style>
