<?php
global $wpdb;
$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;
//$userId = um_profile_id();
$profiletab = $_GET['profiletab'];
$author = get_queried_object();
$new_user_id = $author->ID;
$um_edit = $_GET['um_action'];
if ($profiletab == "messages" || $profiletab == "bookmarks") {
?>
	<style>
		.profile_tabs {
			display: none;
		}
	</style>
<?php
}
if ($profiletab == "friends") {
?>
	<style>
		.um-profile-body.main.main-default {
			display: none;
		}
	</style>
	<script>
		$(document).ready(function() {
			jQuery('.nav-link').removeClass('activebackpack-block');
			jQuery('.tab-pane.fade').removeClass('show');
			jQuery('.tab-pane.fade').removeClass('active');
			jQuery("a#friends-tab").addClass('active');
			jQuery("div#friends").addClass("show");
			jQuery("div#friends").addClass("active");
		})
	</script>
<?php
}
if ($profiletab == "feeds") {
?>
	<script>
		$(document).ready(function() {
			jQuery('.nav-link').removeClass('active');
			jQuery('.tab-pane.fade').removeClass('show');
			jQuery('.tab-pane.fade').removeClass('active');
			jQuery("a#feeds-tab").addClass('active');
			jQuery("div#feeds").addClass("show");
			jQuery("div#feeds").addClass("active");
		})
	</script>
<?php
}
if ($profiletab === "posts") {
?>
	<style>
		.um-profile-body.main.main-default {
			display: none;
		}
	</style>
<?php
}
if ($um_edit == "edit") {
?>
	<style>
		.profile_tabs {
			display: none;
		}
	</style>
<?php
}
?>

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/feed-page.css">

<div class="profile_tabs">

	<?php get_template_part('template-parts/profile-page/navs'); ?>
	<div class="profile_inner_box"></div>

	<div class="tab-content" id="myTabContent">
		<?php get_template_part('template-parts/profile-page/tabs/shared'); ?>

		<div class="tab-pane fade" id="backpack" role="tabpanel" aria-labelledby="backpack-tab">
			<div class="backpack-block backpack_content">
				<?php 
				$userId = get_the_author_ID();
				if ($userId == $current_user_id) {
					echo do_shortcode('[um_user_bookmarks]');
				} else {
					$results = $wpdb->get_results("SELECT * FROM wp_um_followers where user_id1 =$current_user_id And user_id2=$userId");
					if (empty($results)) {
				?>
					<?php get_template_part('template-parts/profile-page/unlock'); ?>
				<?php
					} else {
						echo do_shortcode('[um_user_bookmarks]');
					}
				}
				?>
			</div>
			<div class="tab_info_sec">
				<a href="#" data-target="#backpack_info" data-toggle="modal">
					<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/05/Info.png" alt="img">
				</a>
			</div>
		</div>

		<?php get_template_part('template-parts/profile-page/tabs/feeds'); ?>


		<?php 
		set_query_var( 'author_id', absint( $new_user_id ) );
		get_template_part('template-parts/profile-page/tabs/reviews','contact_methods'); ?> 



		<?php get_template_part('template-parts/profile-page/tabs/hive_tab'); ?>
		<?php //if ($userId == $current_user_id) { 
		?>
	
		<?php get_template_part('template-parts/profile-page/tabs/friends'); ?>

		<?php get_template_part('template-parts/profile-page/tabs/bio'); ?>

		<?php //}
		?>

		<!-- </div> -->




	</div>
</div>

<?php get_template_part('template-parts/profile-page/info_popups'); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
	jQuery(document).ready(function() {
		var get_html = $('.um-reviews-details').html();
		//alert(get_html);
		//console.log(get_html);
		$('#rating_row_id').html(get_html);
		$('.select_rating .score').click(function() {
			var score_id = $(this).attr('id');
			$('.review_box.creation_box').removeClass('score-3');
			$('.review_box.creation_box').removeClass('score-2');
			$('.review_box.creation_box').removeClass('score-1');
			$('.review_box.creation_box').removeClass('score-4');
			$('.review_box.creation_box').removeClass('score-5');
			$('.review_box.creation_box').addClass(score_id);
			$('.select_rating .score').removeClass('selected-score');
			$(this).addClass('selected-score');
			var new_emoji = $('.select_rating .score.selected-score img').attr('src');
			$('.review_type_icon_present img').attr('src', new_emoji);
		})
		var user_rating = $('.score.selected-score').attr('id');
		var new_rating = user_rating.split('-');
		$('span.um-reviews-rate input').val(new_rating[1]);

		$('a#shared-tab').removeClass('active');
		$('div#shared').removeClass('show active');
		$('a#info-tab').addClass('active');
		$('div#info').addClass('show active');
	})
</script>