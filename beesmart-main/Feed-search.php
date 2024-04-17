<?php
/*Template name:Feed-search*/
get_header();
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/custom.css">
<div class="inner_main_page_section_cls">
<div class="final_single_page">
<?php
global $post;
$feed_ids = $_GET['feed_id'];
$args = 'col-lg-4 col-md-6';
$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;
$userfeeds = get_user_meta($current_user_id, 'beesmart-filter-feed-options', true);
foreach ($userfeeds as $final_feed) {
	$feed_id = $final_feed['feed_id'];
	?>
		<input type="hidden" class="move_up_single_id" value="<?php echo $feed_id;?>" id="single-feed-id<?php echo $feed_id?>">
	<?php 
	if ($feed_id == base64_decode($feed_ids)) {
		$focus = $final_feed['focus'];
		$type1 = $final_feed['type1'];
		$type2 = $final_feed['type2'];
		$location = $final_feed['location'];
		$theme = $final_feed['theme'];
		$sortby = $final_feed['sortby'];
		$language = $final_feed['language'];
		$country = $final_feed['country'];
		$visibility = $final_feed['visibility'];
		$explicit_content = $final_feed['explicit_content'];
		$user_id = $final_feed['user_id'];
		$stiker = stickerPATH . $final_feed['feed_have'];
		?>
		<section id="feed-owner">
	<div class="profile_page">
		<div class="container">
			<?php
			get_template_part('template-parts/profile-page/profile_header', '', $final_feed['user_id']); ?>
		</div>
	</div>
</section>
		<section id="feed-about">
	<div class="container">
		<div class="row">
			<div class="feed-info-block offset-3 col-6">
				<div class="">
					<img id="feed-icon" src="<?php echo $stiker; ?>" alt="feed-icon">
				</div>
				<div class="d-flex justify-content-center align-items-center col-8">
					<h5 class="m-0" id="feed-title<?php echo $final_feed['feedname']; ?>"><?php echo $final_feed['feedname']; ?></h5>
				</div>
				<div class="feed-options">
					<button id="isVisible">
						<?php if ($final_feed['visibility'] == 1) { ?>
							<img src="<?php echo imgPATH; ?>Visibility.png" alt="is visible">
						<?php
						} else {
						?>
							<img src="<?php echo imgPATH; ?>Visibility.png" alt="is visible">
						<?php
						}
						?>
					</button>
					<button id="isExplicit">
						<?php if ($final_feed['explicit_content'] == 1) { ?>
							<img src="<?php echo imgPATH; ?>Warning.png" alt="is explicit">
						<?php
						} else {
						?>
							<img src="<?php echo imgPATH; ?>Safe-1.png" alt="safe">
						<?php
						}
						?>
					</button>
					<div class="dropdown d-flex align-items-center">
						<button id="moreOption" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							...
						</button>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
							<a class="dropdown-item" href="<?php echo site_url();?>/feeds/?feed_id=<?php echo base64_encode($final_feed['feed_id']);?>">Source</a>
							<a class="dropdown-item" data-target="#single_edit_feed<?php echo $feed_id; ?>" data-toggle="modal">Edit</a>
							<a class="dropdown-item move_to_topup" data-id="<?php echo $feed_id; ?>">Move up</a>
							<a class="dropdown-item" data-target="#single_delete_feed<?php echo $feed_id; ?>" data-toggle="modal">Remove</a>
						</div>
						<div class="modal following_modal custom_trsparent_modal" id="single_delete_feed<?php echo $feed_id; ?>" aria-modal="true" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header border-0">
								<!-- 						<button type="button" class="close close_2nd" data-dismiss="modal">×</button> -->
							</div>
							<div class="modal-body text-center mb-5 bg-white rounded">
								<img src="<?php echo imgPATH; ?>Warning.png" class="img-fluid mb-2" width="50px">
								<h3>Are You Sure?</h3>
								<p style="margin-bottom:25px;">Do you really want to delete this feed ?</p>
								<a class="btn btn-secondary" data-userid="<?php echo $feed_id; ?>" data-dismiss="modal" style="color:#000;">Remove child feeds</button>
								<a class="btn btn-danger ml-2 delete_feed" href="#" data-userid="<?php echo $feed_id; ?>" style="color:#000;">Keep child feeds</a>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade custom_trsparent_modal abcc search_filter edit_category_modal single_feed_modal edit_feed_modal" id="single_edit_feed<?php echo $feed_id; ?>">
					<div class="modal-dialog  modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header border-0 p-0">
								<img src="/wp-content/uploads/2022/01/Feeds1.png" />
								<h5>Edit</h5>
							</div>
							<div class="modal-body pt-0">
								<div class="writing_group">
									<img src="<?php echo $stiker; ?>" class="selected_sticker">
									<input type="text" value="<?php echo $final_feed['feedname']; ?>" class="form-control readd" placeholder="Enter Your category" readonly />
									<img src="/wp-content/uploads/2022/05/Visibility.png" class="visibility_icon <?php echo $visibility_class; ?>">
									<img src="/wp-content/uploads/2022/05/Copy-of-Warning.png" class="warning_icon <?php echo $explicit_class; ?> ">
								</div>

								<div class="edit_feed_heading">
									<h6><input type="text" value="<?php echo $final_feed['feedname']; ?>" class="form-control edit_feed_listing_<?php echo $feed_id; ?>" placeholder="Enter Your category" /></h6>
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
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
<?php
		if (!empty($type2)) {
			if ($type2 == 'Be Found') {
				$query = array(
					'key'     => 'f_be_found',
					'value'   => sprintf('"%s"', $discover),
					'compare' => 'Like',
				);
			} elseif ($type2 == 'Find Someone') {
				$query = array(
					'key'     => 'f_find_someone',
					'value'   => sprintf('"%s"', $discover),
					'compare' => 'Like',
				);
			} elseif ($type2 == 'News') {
				$query = array(
					'key'     => 'f_news',
					'value'   => sprintf('"%s"', $discover),
					'compare' => 'Like',
				);
			} elseif ($type2 == 'Hire') {
				$query = array(
					'key'     => 'f_hire_someone',
					'value'   => sprintf('"%s"', $discover),
					'compare' => 'Like',
				);
			} elseif ($type2 == 'Event') {
				$query = array(
					'key'     => 'f_events',
					'value'   => sprintf('"%s"', $discover),
					'compare' => 'Like',
				);
			} elseif ($type2 == 'Sell') {
				$query = array(
					'key'     => 'f_sell_and_buy',
					'value'   => sprintf('"%s"', $discover),
					'compare' => 'Like',
				);
			}
		}
		if (!empty($sortby)) {
			if ('most-buzz' === $sortby) { // Sort by "most-buzz".
				$order   = 'DESC';
				$orderby = 'comment_count';
			} elseif ('oldest' === $sortby) { // Sort by "oldest".
				$order   = 'ASC';
				$orderby = 'date';
			} elseif ('most-views' === $sortby) { // Sort by "most-views".
				$order   = 'DESC';
				$orderby  = 'meta_value_num';
				$meta_key = 'views_counter';
			} elseif ('most-honey' === $sortby) { // Sort by "most-honey".
				$order    = 'DESC';
				$orderby  = 'meta_value_num';
				$meta_key = 'love_me_like';
			} elseif ('biggest-garden' === $sortby) { // Sort by "biggest-garden".
			} elseif ('freshest' === $sortby) { // Sort by "freshest".
				$order  = 'DESC';
				$orderby = 'date';
			}
		}
		$query_args = array(
			'post_type' => 'beeart', 'posts_per_page' => 12, 'orderby'   => $orderby,
			'order' => $order,
			'meta_query'    => array(
				'relation' => 'OR',
				array(
					'key'       => 'is_explisit',
					'value'     => $explicit_content,
					'compare'   => '=',
				),
				array(
					'key'       => 'is_public',
					'value'     => $visibility,
					'compare'   => '=',
				),

				array(
					'key'     => 'f_type_of_post_by_user_type',
					'value'   => $focus,
					'compare' => '=',
				),
				array(
					'key'     => 'f_custom_post_format',
					'value'   => $type1,
					'compare' => '=',
				),
				array(
					'key'     => 'f_language',
					'value'   => $language,
					'compare' => '=',
				),
				array(
					'key'     => 'f_country',
					'value'   => $country,
					'compare' => '=',
				),
				$query,
			)
		);
	}

}
?>
</div>
<div class="feed-page" id="feed-page">
		<div class="container">
			<div class="gmw-results-wrapper grid-gray gmw-pt-grid-gray-results-wrapper pt" data-id="7" data-prefix="pt" id="postdynamic">
				<div class="gmw-results">
					<ul class="posts-list-wrapper row justify-content-center">
						<?php global $post;
						if (get_query_var('paged')) {

							$paged = get_query_var('paged');
						} elseif (get_query_var('page')) {

							$paged = get_query_var('page');
						} else {

							$paged = 1;
						}
						$the_query = new WP_Query($query_args);
						if ($the_query->have_posts()) : ?>
							<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
								<?php get_template_part('template-parts/components/post-cart', '', $args) ?>
							<?php endwhile;
							wp_reset_postdata();
							?>
						<?php else :  ?>
							<p><?php _e('Sorry, no Feed matched your criteria.'); ?></p>
						<?php endif; ?>

						<div class="content_detail__pagination cdp" actpage="1">


							<?php
							$big = 999999999; // need an unlikely integer
							$translated = __('Page', 'mytextdomain'); // Supply translatable string
							echo paginate_links(array(
								'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
								'format' => '?paged=%#%',
								'prev_text' => __('prev'),
								'next_text' => __('next'),
								'current' => max(1, $paged),
								'total' => $the_query->max_num_pages,
								'before_page_number' => '<span class="screen-reader-text">' . $translated . ' </span>'
							));
							wp_reset_postdata();
							?>
						</div>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
?>
<script>
$('.move_to_topup').click(function(){
		var feed_id=$(this).attr('data-id');
		$('#single-feed-id'+feed_id).remove();
		$('.final_single_page').prepend('<input type="hidden" class="move_up_single_id" value="'+feed_id+'" id="#single-feed-id'+feed_id+'">');
		var side_bar=$('#side_feed'+feed_id).html();
		//$('.saved_feed_items ul').prepend('<li id="feed_'+feed_id+'" class="" data-feedid="'+feed_id+'">'+feed_row+'</li>');
		$('.menu-dashboard-container .subchild').prepend('<div class="sidebar_custom_submenu" id=side_feed'+feed_id+'>'+side_bar+'</div>');
		var feed_ids = new Array();
		$('.inner_main_page_section_cls .final_single_page>.move_up_single_id').each(function() {
			feed_ids.push($(this).attr("value"));
		});
		$.ajax({
			type: 'post',
			url: '/wp-admin/admin-ajax.php',
			data: {
				action: 'own_feed_move_top',
				move_to_top: feed_ids
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function success(response) {
				response = jQuery.parseJSON(response);
				toastr['warning'](response.message);
				console.log(response);
			},
			error: function error(err) {
				toastr['warning'](err);
			},
			complete: function complete(response) {
				console.log(response);
				$(".loader").hide();
			}
		});
		//console.log(feed_ids+'dfrefrefrrf');
})
</script>