<?php /*Template Name: User Template*/ ?>
<?php get_header();
$post_id = get_the_author_ID();
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$parts = parse_url($actual_link);
//echo $parts.'parts';
parse_str($parts['query'], $query);
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/scss/user.css">



<div class="inner_main_page_section_cls bg_light inner_main_page_wapper" id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="profile_page" id="preview-js">
			<?php get_template_part('template-parts/profile-page/profile_header', '', $post_id); ?>
		
			<?php get_template_part('template-parts/profile-page/settings-button'); ?>
		
			<?php echo do_shortcode('[ultimatemember form_id="73"]'); ?>
		
			<?php get_template_part( 'template-parts/profile-page/profile_tabs','',$post_id); ?>

		</div>
	</div>
   <section class="main-banner d-none">
         <div class="main-banner-image ">
            <?php echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'alignleftfull' ) ); ?>
            <div class="main-banner-content">
               <h1><?php // the_title(); ?></h1>
               <div class="breadcrumb"><?php // get_breadcrumb(); ?></div>
            </div>
         </div>
      </section>
	
		   </div>

<script>
$(document).ready(function(){
  $(".single_feed").click(function(){
	  $(this).closest('.single_feed').toggleClass('active');
   
  });
});
	
	
	$('a.btn.btn-link.btn-block.text-left').click(function(Event){
		Event.preventDefault();
		var decode_id=$(this).attr('data-info');
		var new_profile_id=$(this).attr('data-id');
		$.ajax({
             type : "POST",
             url : "/wp-admin/admin-ajax.php",
             data : {action: "decode_id_to_save_feed",'feed_id':decode_id,'new_profile_id':new_profile_id},
			 beforeSend: function(){
				$(".loader").show();
			   },
             success: function(response) {
			 response = jQuery.parseJSON(response);
				 if(response.success=='true'){
					option()
					$(document).ready(function onDocumentReady() {
					  toastr.success(response.message);
					});
					// $('a#shortcut_icon').show();
					 $('.adminButtons').prepend('<a href="https://beesmartdev.wpengine.com/search-result/?query='+decode_id+'" <i class="fa fa-pen"></i></a>');
				 }else{
					option()
					$(document).ready(function onDocumentReady() {
					  toastr.warning(response.message);
					});
					// alert(response.message);
				 }
                },complete:function(data){
				$(".loader").hide();
			   }
        });
	})
	// Set the options that I want

$('a.form-control.Unsubscribed').click(function(event){
	event.preventDefault();
	var logged_in_user=$(this).attr('data-loggedin');
	var profile=$(this).attr('data-profileid');
	$.ajax({
             type : "POST",
             url : "/wp-admin/admin-ajax.php",
             data : {action: "unsubscribe_user",'logged_in_user':logged_in_user,'new_profile_id':profile},
			 beforeSend: function(){
				$(".loader").show();
			   },
             success: function(response) {
			 response = jQuery.parseJSON(response);
				 if(response.success=='true'){
					option()
					$(document).ready(function onDocumentReady() {
					  toastr.success(response.message);
						location.reload();
					});
					
				 }else{
					 option()

					$(document).ready(function onDocumentReady() {
					  toastr.warning(response.message);
					});
					// alert(response.message);
				 }
                },complete:function(data){
				$(".loader").hide();
			   }
        });
})
</script>
<style>
.reg_form_cls.ters {
    display: none;
}
</style>
<?php //if ($query['um_action']=='edit') { ?>
    <?php get_template_part('template-parts/profile-page/upload-photo-popups'); ?>
<?php //}  ?>

<div class="wapper_main_footer">
	<?php get_footer() ;?>
</div>
