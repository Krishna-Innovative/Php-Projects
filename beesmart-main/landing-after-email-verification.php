<?php /* Template Name: landing-after-email-verification */ ?>
<?php get_header();?>

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/scss/user.css">
<div class="inner_main_page_section_cls bg_light inner_main_page_wapper" id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="profile_page">
		<?php
		the_content();

		get_template_part('template-parts/profile-page/upload-photo-popups'); 

		get_template_part('template-parts/profile-page/profile_header'); 
		
		//get_template_part('template-parts/profile-page/add_info'); 
		?>
		</div>
	</div>
</div>
<?php

 get_footer(); 

?>