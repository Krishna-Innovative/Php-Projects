<?php /*Template Name: User Profile Template*/ ?>
<?php get_header();
    $post_id = get_the_ID();
?>

<?php if (um_is_on_edit_profile()) { ?>
    <?php get_template_part('template-parts/profile-page/upload-photo-popups'); ?>
<?php }  ?>

	 <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/scss/user.css">



<div class="inner_main_page_section_cls bg_light inner_main_page_wapper" id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
	   <div class="container">
		  <div class="profile_page">
				<?php get_template_part('template-parts/profile-page/profile_header','',idCurrentUser); ?>

				<?php echo do_shortcode('[ultimatemember form_id="73"]'); ?>
			  <div class="add_to_section">
				<?php
				  $current_user = wp_get_current_user();
					$current_user_id = $current_user->ID;
					$userId = um_profile_id();
				  if($userId==$current_user_id){

				  }else{
					$checking_user_follow = $wpdb->get_results( "SELECT * FROM  wp_um_followers where user_id1=$current_user_id AND user_id2 =$userId");
				  if(!empty($checking_user_follow)){
					   echo '<a href="#" class="form-control Unsubscribed" data-loggedin='.$current_user_id.' data-profileid='.$userId.'>Unsubscribed</a>';
				  }else{

				  }

				  ?>

				  <img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Hive.png" class="add_to_img"/>

				  <?php
				  if ( current_user_can( 'manage_options' ) ) {
						global $wpdb; 
						$current_user = wp_get_current_user();
						$current_user_id = $current_user->ID;
						$new_listing = $wpdb->get_results( "SELECT * FROM wp_um_set_priority_by_follower where follower_id =$userId and user_id=$current_user_id");
						   $follower_cat_id=$new_listing[0]->follower_cat_id;
								//$userId = um_profile_id();
						$author_category_listing = $wpdb->get_results( "SELECT * FROM wp_category_created_by_author where author_id =$current_user_id");
						  if(!empty($author_category_listing)){
						$category=array();
						foreach($author_category_listing as $category_listing){
							$category[]=$category_listing->category_value;
						}
					  ?>
						<select class="selected_category_value">
							
						<?php 
						  $category_data='<option value="0" data-u-id="'.$selected_id.'">--Add to Unlock--</option>';
						  foreach($category as $category){
							  if($follower_cat_id==$category){
								$category_detail=get_cat_name($category);
							 $category_data.= '<option value="'.$category.'" data-u-id="'.um_profile_id().'" selected>'.$category_detail.'</option>';
								  }else{
								   $category_detail=get_cat_name($category);
							 $category_data.= '<option value="'.$category.'" data-u-id="'.um_profile_id().'">'.$category_detail.'</option>';
							  }
							}
						  echo $category_data;
						  ?>
					  </select>  
					<?php
				  }
				  else{
					 echo '<select><option value="0" data-u-id="">--Add to Unlock--</option><option> Please add your categories</option></select>';
					  } 
					  
				}else{
					  	global $wpdb;
					$current_user = wp_get_current_user();
					$current_user_id = $current_user->ID;
							//$userId = um_profile_id();
					$author_category_listing = $wpdb->get_results( "SELECT * FROM wp_category_created_by_author where author_id =$current_user_id");
					  if(!empty($author_category_listing)){
					$category=array();
					foreach($author_category_listing as $category_listing){
						$category[]=$category_listing->category_value;
					}
					  ?>
					<select class="selected_category_value">

					<?php
					  $category_data='<option value="0" data-u-id="'.$selected_id.'">--Add to Unlock--</option>';
					  foreach($category as $category){
						    $category_detail=get_cat_name($category);
						 $category_data.= '<option value="'.$category.'" data-u-id="'.um_profile_id().'">'.$category_detail.'</option>';
						}
					  echo $category_data;
					  ?>
				  </select>
				  <?php
				  }else{
						  echo '<select><option value="0" data-u-id="">--Add to Unlock--</option><option> Please add your categories</option></select>';
					  }
				  }
				  }
				  ?>
<!-- 				  <a href="#" data-toggle="modal" data-target="#hive_manager">Go to your Hive Manager</a> -->
			  </div>

				<?php get_template_part( 'template-parts/profile-page/profile_tabs'); ?>

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
      <div class="reg_form_cls ters d-none">
         <div class="container">
		 <?php global $current_user;
				  wp_get_current_user();
				  $nickname = $current_user->nickname;
				  echo $nickname;
			?>
            <?php echo do_shortcode('[ultimatemember form_id="73"]'); ?>

         </div>
      </div>
	
		   </div>
<div class="wapper_main_footer">
	<?php get_footer() ;?>
</div>

<script>
$(document).ready(function(){
  $(".single_feed").click(function(){
	  $(this).closest('.single_feed').toggleClass('active');

  });
});

	jQuery(".selected_category_value").change(function(){
		var category_id=$(this).val();
		//var user_id =$(this).attr('data-u-id');
		var u_id = $(this).find('option:selected');
      	var user_id = u_id.data('u-id');
		//alert(user_id+'===='+u_id);
		$.ajax({
             type : "POST",
          // dataType : "json",
             url : "/wp-admin/admin-ajax.php",
             data : {action: "save_category_to_unlock_feature",'category_id':category_id,'user_id':user_id},
			 beforeSend: function(){
				// Show image container
				$(".loader").show();
			   },
             success: function(response) {
			 response = jQuery.parseJSON(response);
				//alert(response.success=='true');
				 if(response.success=='true'){
					 toastr.options = {
					  closeButton: true,
					  newestOnTop: false,
					  progressBar: true,
					  positionClass: "toast-top-center",
					  preventDuplicates: false,
					  onclick: null,
					  showDuration: "10000",
					  hideDuration: "10000",
					  timeOut: "5000",
					  extendedTimeOut: "1000",
					  showEasing: "swing",
					  hideEasing: "linear",
					  showMethod: "fadeIn",
					  hideMethod: "fadeOut"
					};

					$(document).ready(function onDocumentReady() {
					  toastr.success(response.message);
					});
				 }else{
					 //alert(response.message);
				 }
                },complete:function(data){
				// Hide image container
				$(".loader").hide();
			   }
        });
	})
	$('a.btn.btn-link.btn-block.text-left').click(function(Event){
		Event.preventDefault();
		var decode_id=$(this).attr('data-info');
		var new_profile_id=$(this).attr('data-id');
		var site_url=document.URL;
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
					toastr.options = {
					  closeButton: true,
					  newestOnTop: false,
					  progressBar: true,
					  positionClass: "toast-top-center",
					  preventDuplicates: false,
					  onclick: null,
					  showDuration: "10000",
					  hideDuration: "10000",
					  timeOut: "5000",
					  extendedTimeOut: "1000",
					  showEasing: "swing",
					  hideEasing: "linear",
					  showMethod: "fadeIn",
					  hideMethod: "fadeOut"
					};

					$(document).ready(function onDocumentReady() {
					  toastr.success(response.message);
					});
					// $('a#shortcut_icon').show();
					 $('.adminButtons').prepend('<a href="'+site_url+'/search-result/?query='+decode_id+'" <i class="fa fa-pen"></i></a>');
					// window.location.href="https://beesmartstg.wpengine.com/search-result/?query="+decode_id+";
				 }else{
					 toastr.options = {
					  closeButton: true,
					  newestOnTop: false,
					  progressBar: true,
					  positionClass: "toast-top-center",
					  preventDuplicates: false,
					  onclick: null,
					  showDuration: "10000",
					  hideDuration: "10000",
					  timeOut: "5000",
					  extendedTimeOut: "1000",
					  showEasing: "swing",
					  hideEasing: "linear",
					  showMethod: "fadeIn",
					  hideMethod: "fadeOut"
					};

					$(document).ready(function onDocumentReady() {
					  toastr.warning(response.message);
					});
				 }
                },complete:function(data){
				$(".loader").hide();
			   }
        });
	})



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
					toastr.options = {
					  closeButton: true,
					  newestOnTop: false,
					  progressBar: true,
					  positionClass: "toast-top-center",
					  preventDuplicates: false,
					  onclick: null,
					  showDuration: "10000",
					  hideDuration: "10000",
					  timeOut: "5000",
					  extendedTimeOut: "1000",
					  showEasing: "swing",
					  hideEasing: "linear",
					  showMethod: "fadeIn",
					  hideMethod: "fadeOut"
					};

					$(document).ready(function onDocumentReady() {
					  toastr.success(response.message);
						location.reload();
					});
					
				 }else{
					 toastr.options = {
					  closeButton: true,
					  newestOnTop: false,
					  progressBar: true,
					  positionClass: "toast-top-center",
					  preventDuplicates: false,
					  onclick: null,
					  showDuration: "10000",
					  hideDuration: "10000",
					  timeOut: "5000",
					  extendedTimeOut: "1000",
					  showEasing: "swing",
					  hideEasing: "linear",
					  showMethod: "fadeIn",
					  hideMethod: "fadeOut"
					};

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
