<?php /*Template Name: User Accout Template*/ ?>
<?php 
	get_header(); 
	$post_id = get_the_ID();
?>
<style>
	#settings-block {
		display: block;
		margin: 0 auto;
		max-width: 500px;
	}
	.um-account-main {
		width: 100%!important;
		padding: 0!important;
	}
	div#um_field_general_user_login,
	div#um_field_privacy_profile_noindex,
	div#um_field_privacy_um_bookmark_privacy,
	div#um_field_privacy_hide_in_members,
	.um-account-tab.um-account-tab-orders,
	input#um_account_submit_general,
	a[data-tab=downloads],
	a[data-tab=general],
	a[data-tab=orders]{
		display:none!important;
	}
</style>
<div class="inner_main_page_section_cls bg_light inner_main_page_wapper" id="post-<?php echo $post_id; ?>">
	<div class="container">
		<div class="profile_page">
			<?php get_template_part('template-parts/profile-page/profile_header', '', idCurrentUser); ?>
			<div id="settings-block">
				<?php echo do_shortcode('[ultimatemember_account]'); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>