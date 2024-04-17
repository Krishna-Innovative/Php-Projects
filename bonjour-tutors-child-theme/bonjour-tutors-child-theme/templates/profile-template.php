<?php
/* Template Name: profile */
get_header();
$current_user = wp_get_current_user();
$user_id = get_current_user_id();
$user = wp_get_current_user();
$stm_lms_instructor =$user->roles[0];

?>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" >
<style>
.togglelearner,.togglechildlearner, .edit_child_profile{
	visibility: visible;
	display: block;
	opacity: 1! important;
}
.edit_child_profile .lblTxt {
    text-align: left;
}
table#dat_table {
    width: 55%;
}
.toast-warning {
    background-color: #F89406! important;
}
.toast-success {
    background-color: #51A351! important;
}

</style>
<div class="fontWrp">
	
 
	<div class="parentWrp">

		<div class="container">
			<div class="prfileEdit">
                <div class="row mb-5">
                  <div class="col-md-4">
                      <div class="profileLeft-side">
                    <span class="error_find" style="color:#e01239"></span>
					<form id="uploadimage1" action="" method="post" enctype="multipart/form-data">
						<div class="rw " style="text-align:center">
							<div class="row space-below">
                                <h4 class="user-name"><?php echo esc_html( $current_user->user_firstname );?></h4>
                                <p class="user-email"><?php echo esc_html( $current_user->user_email );?></p>
								<div class="six columns flex-centered-column">
									<div class="headshot-image space-below" id="image_preview">
										
									</div>
									<?php
									if( get_the_author_meta('mm_sua_attachment_id', $user_id, true)) {
										$author_info = get_user_meta( $user_id, 'mm_sua_attachment_id');
										if($author_info) {
											foreach($author_info as $attachments) {
												$url = wp_get_attachment_url( $attachments ); 
											}
										}
										?>
										<img id="profile-img" src="<?php echo $url;?>" alt="User Profile">
									<?php
									}else{
										?>
										<img id="profile-img" src="https://process.filepicker.io/APHE465sSbqvbOIStdwTyz/rotate=deg:exif/resize=fit:crop,height:125,width:125/output=quality:80,compress:true,strip:true,format:png/cache=expiry:max/https://cdn.filestackcontent.com/26Xc9cgQFmpVTv8h268V" alt="User Profile">
									<?php
									}
									?>
									 <div class="profile-img-input" id="profile-img-input">
										<label class="button change-photo-btn" id="change-photo-label" for="change-photo">Change Photo</label>
										<input id="change-photo" class="ImageBrowse" name="pic_url" type="file" style="display: none;" accept="image/*">
									   <input type="hidden" name="customer_id" id="customer_id" value="<?php echo get_current_user_id();?>" />
										<input type="submit" value="Upload" class="customersubmit" style="display:none;	" />
									</div>
								</div>
							</div>
						</div>
					</form>
                          
                      </div>
                    </div>
                     <div class="col-md-8">
                     <div class="WhiteRw profileRight-side">
					<h3>Edit Profile</h3>
					
					<div class="rw dFlx">
						<div class="clwHalf">
							<div class="lblTxt"> 
								<h5>First name  *</h5>
							</div>
							<div class="lblInpt">
								<input type="text" name="firstname" id= "firstname" value="<?php echo esc_html( $current_user->user_firstname );?>" required>
							</div>	
						</div>
						<div class="clwHalf">
							<div class="lblTxt"> 
								<h5>Last name *</h5>
							</div>
							<div class="lblInpt">
								<input type="text" name="lastname" id= "lastname" value="<?php echo esc_html( $current_user->user_lastname );?>" required>
							</div>	
						</div>	
						<div class="clwHalf">
							<div class="lblTxt"> 
								<h5>Email address *</h5>
							</div>
							<div class="lblInpt">
								<input type="email" name="email" id="email_id" value="<?php echo esc_html( $current_user->user_email );?>" readonly required>
							</div>	
						</div>
						<div class="clwHalf">
							<div class="lblTxt"> 
								<h5>Phone *</h5>
							</div>
							<div class="lblInpt">
								<input type="text"  name="phone_numebr" id="phone_numebr" value="<?php echo esc_html( $current_user->billing_phone);?>">
							</div>	
						</div>	
					</div>
                           <div class="edit-form-btn-groups justify-content-start">
                    <div class="logoutRw ms-0">
                        <a href="#" class="newBtn01" id="update_user_profile">Update Profile </a>
                    </div>

                    
                </div>
				</div>
                    </div>
                </div>
				

			<?php
				//echo 
				if ($stm_lms_instructor=="subscriber" || $stm_lms_instructor=="customer") {
				?>
				<div class="WhiteRw preferences-sec">
                    <div class="preferences-heading">
                        <h3>Learner Preferences</h3>
                        <p>Please fill these out, to help us emphasize the best classes for you.</p>
                    </div>
                    
					<div class="rw dFlx">
						<div class="clwFull"> 
							<h5>My Learners</h5>	
							<p>We will show you classes that match your learner ages. Learner names are only shared with teachers and classmates after you enroll in a class.</p>						
						</div>
									<?php
										global $wpdb; 
										$user_id = get_current_user_id();
										$meta_data = $wpdb->get_results("SELECT meta_value FROM `uDO_usermeta` WHERE (`meta_key` = 'is_child_id' AND `user_id` = '".$user_id."') ORDER BY meta_value DESC");
										
										if(!empty($meta_data)) {
											foreach ($meta_data as $key => $valval) {
											  $kid_idd = $valval->meta_value;

											  $kid_first_name = get_user_meta( $kid_idd, 'first_name', true );
											  $kid_age = get_user_meta( $kid_idd, 'age', true );
											  $kid_grade = get_user_meta( $kid_idd, 'grade', true );
											  $kid_img = get_user_meta( $kid_idd, 'kid_img', true );
											  if($key == "0") {?>
						<div class="table-responsive custom-data-table">							
                          <table id="dat_table" class="table w-100">
														  <thead> 
															  <tr>
																<th>Image</th>
																<th>Name</th>
																<th>Age</th>
																<th>Grade</th>
																<th>Action</th>
															  </tr>
														  </thead> 
														
														<tbody>
												<?php }?>
														 <tr id="<?php echo "kid_".$kid_idd; ?>" class='show_data_table'>

															  <td> 
															   <?php if(empty($kid_img))
																{ ?>
																  <img style='max-width: 100px;' src='/wp-content/uploads/2023/01/pic01.png' alt=''>
																  
																<?php } else { ?>
																<img style='max-width: 100px;' src='<?php echo $kid_img; ?>' alt=''>
															  <?php } ?>

															
															  </td>
								  
															  <td class='tble_names'><?php echo $kid_first_name; ?></td>
															  <td class='tble_ages'><?php echo $kid_age; ?></td>
															  <td class='tble_grades'><?php echo $kid_grade; ?></td>

															  <td> 
																<div class="action_div">
																<span onclick="deletekid(<?php echo get_current_user_id().','.$kid_idd; ?>)" class='delTxt tble_delete tble_delete_btn' title="Delete" ><i class="fa fa-trash" aria-hidden="true"></i></span>

																<span class='edit_child_button tble_edit_btn' data-val="<?php echo $kid_idd;?>" title="Edit" data-toggle="modal"  data-target="#edit_user_profile-<?php echo $kid_idd;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
																<div class="modal fade " id="edit_user_profile-<?php echo $kid_idd;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																<input type="hidden" value="<?php echo get_current_user_id(); ?>" name="current_user_id" >

																<input type="hidden" value="<?php echo $kid_idd;?>" name="current_kid_id" id="current_kid_id">
																  <div class="modal-dialog edit-modal modal-dialog-centered" role="document">
																	<div class="modal-content p-0">
																	  <div class="modal-header d-flex p-0 justify-content-start">
																		<h5 class="modal-title" id="exampleModalLabel">Edit Learner</h5>
                                                                          <button type="button" class="close close-edit_profile" data-dismiss="modal" aria-label="Close">
                                                                          <span aria-hidden="true">&times;</span>
                                                                        </button>
																	  </div>
																	  <div class="modal-body">
																		<div class="rw">
																			<div class="mt-4 ">
																				<div class="lblTxt"> 
																					<h5>Child name</h5>
																				</div>
																				<div class="lblInpt">
																					<input type="text" name="childfirstname" class= "childfirstname" value="<?php echo $kid_first_name;?>" required>
																				</div>	
																			</div>
																			<div class="mt-4">
																				<div class="lblTxt"> 
																					<h5>Child age</h5>
																				</div>
																				 <div class="select select_age">
																					<select class="childage" name="childage">
																					  <?php
																					  $terms = get_terms([
																						'taxonomy' => 'age',
																						'hide_empty' => false,
																					]);
																				
																					foreach ($terms as $term){ ?> 
																					<option value="<?php echo $term->name; ?>"<?php if($kid_age==$term->name){echo 'selected';}else{echo '';} ?>><?php echo $term->name; ?></option>
																					  <?php } ?>  
																					</select>
																				 </div>
																			</div>
																			<div class="mt-4">
																				<div class="lblTxt"> 
																					<h5>Child grade</h5>
																				</div>
																				<?php
																				 $gradeterms1 = get_terms([
																					'taxonomy' => 'grade',
																					'hide_empty' => false,
																				]);
																				$gradeterms1 = json_decode( json_encode( $gradeterms1 ), true );
																				asort($gradeterms1);
																				?>
																				<div class="select select_grade">
																						<select class="childgrade" name="childgrade">
																						<?php foreach ($gradeterms1 as $term){?>
																						  <option value="<?php echo $term['slug'];?>" <?php if($kid_grade==$term['slug']){echo 'selected';}else{echo '';} ?> ><?php echo $term['name'];?></option>
																						  <?php } ?>
																						</select>
																					  </div>
																			</div>
																			<div class="mt-4 d-flex">
																				<div class="lblTxt edit_child_main"> 
																					<button data-toggle="modal" class="edit_child_avatar" data-target="#select_child_avatar">Select new child avatar</button>
																				</div>
																				 <img style='max-width: 70px;' src="<?php echo $kid_img;?>" alt='' class="new_child_avatar after_select_image_preview">
																				 <?php 
																					if($kid_img==""){
																					?><input type="hidden" name="show_img_add_img" class="show_img_add_img" value="/wp-content/uploads/2023/01/pic01.png">
																					<?php
																					}else{
																						?><input type="hidden" name="show_img_add_img" class="show_img_add_img" value="<?php echo $kid_img;?>">
																					<?php
																					} ?>
																				
																			</div>
																		</div>
																		
																	  </div>
																	  <div class="modal-footer">
																		<button type="button" class="btn btn-primary edit_child_info" data-val="<?php echo $kid_idd;?>">Update child Info</button>
																	  </div>
																	</div>
																  </div>
																</div>
																</div>  
															  </td> 
														</tr> 
														<?php  }
														}		 ?>   
															 
														</tbody>
													</table>
                        </div>
								
						<div class="clwFull">
							<div class="btnWrp learner_button-mian">
								<button class="newBtn01" data-toggle="modal" id="learner_button" data-target="#learnermodal">+ Add learner...</button>
							</div>
						</div>	

					</div>
				</div>

		<?php
		}else{
			
		}
			?>
				
              
				
			</div>
			<!--</form>-->
			
		</div>

	</div>

	<div class="footerTp">
	    <div class="container">
	      <div class="InrWrp">
	        <div class="fLgo">
	          <a href="/"><img src="/wp-content/uploads/2023/01/logo_small.png" alt=""></a>
	        </div>
	        <div class="cstmFmenu">
	          <ul class="dFlx">
	            <li><a href="/">Home</a></li>
	            <li><a href="">About Us </a></li>
	            <li><a href="">Programs </a></li>
	            <li><a href="">Why Choose us </a></li>
	            <li><a href="">FAQ </a></li>
	            <li><a href="">Contact Us</a></li>
	          </ul>
	        </div>
	        <h3 class="text-center">Have questions? Call us now: +1 (647) 956-1104 </h3>
	        <div class="socialWrp">
	          <ul class="dFlx">
	            <li><a href=""><i class="fab fa-facebook"></i> </a></li>
	          </ul>
	        </div>
	      </div>
	    </div>
	</div> 

</div>
<!-- Modal -->
<div class="modal fade " id="learnermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog edit-modal modal-dialog-centered" role="document">
    <div class="modal-content p-0">
      <div class="modal-header d-flex p-0 justify-content-start">
        <h5 class="modal-title" id="exampleModalLabel">Add Learner</h5>
           <button type="button" class="close btn-secondary close-learner" data-dismiss="modal"> <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="rw">
			<div class="mt-4">
				<div class="lblTxt"> 
					<h5>Child name</h5>
				</div>
				<div class="lblInpt">
					<input type="text" name="childfirstname" id= "childfirstname" value="" required>
				</div>	
			</div>
			<div class="mt-4">
				<div class="lblTxt"> 
					<h5>Child age</h5>
				</div>
				 <div class="select select_age">
                        <select id="childage" name="childage">
                          <?php $terms = get_terms([
							'taxonomy' => 'age',
							'hide_empty' => false,
						]);
						foreach ($terms as $term){ ?> 
                            <option value="<?php echo $term->name; ?>"><?php echo $term->name; ?></option>
                          <?php } ?>     
                        </select>
                      </div>
			</div>
			<div class="mt-4">
				<div class="lblTxt"> 
					<h5>Child grade</h5>
				</div>
				<?php $gradeterms = get_terms([
							'taxonomy' => 'grade',
							'hide_empty' => false,
						]);
						
						$gradeterms = json_decode( json_encode( $gradeterms ), true );
						asort($gradeterms);
							?>
					 <div class="select select_grade">
                        <select id="childgrade" name="childgrade">
						  <?php foreach ($gradeterms as $term){?>
                          <option value="<?php echo $term['slug'];?>"><?php echo $term['name'];?></option>
						  <?php } ?>
                        </select>
                      </div>
			</div>
			
			<div class="mt-4">
				<div class="lblTxt edit_child_main"> 
					<button class="edit_child_avatar2" data-toggle="modal" id="child_avatar" data-target="#select_child_avatar">Select child avatar</button>
				</div>
				<input type="hidden" name="show_img_add_img" id="show_img_add_img" value="/wp-content/uploads/2023/01/pic01.png">
			</div>
		</div>
		
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary save_child_info">Save changes</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal avatar Popup -->
<div class="modal fade" id="select_child_avatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelavatar" aria-hidden="true">
  <div class="modal-dialog edit-modal modal-dialog-centered" role="document">
    <div class="modal-content p-0 ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelavatar">Select child avatar</h5>
          <button type="button" class="close btn-secondary close_child_avatar" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          </button>
                                                                          
      </div>
      <div class="modal-body">
	   <div class="image-check">

            <img alt="" src="../wp-content/uploads/2023/04/car-toy.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/toy.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/rock-horse.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/toy-train.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/rubber-duck.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/plane.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/hand-print.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/rocking-horse.png" class="image_icon choose_avatar">

          </div>
      </div>
    </div>
  </div>
</div>

<!--end of Modfal avatar-->

<?php
get_footer();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

 
 <script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>


 <script src='../wp-content/themes/ms-lms-starter-theme/assets/js/admin-ajax.js?ver=1.1'></script>
<script>
 toastr.options = {
	  closeButton: true,
	  newestOnTop: false,
	  progressBar: true,
	  positionClass: "toast-top-right",
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
jQuery("#update_user_profile").click(function(e){
    e.preventDefault();
    //alert();
    var firstname=jQuery("input#firstname").val();
    var lastname=jQuery("input#lastname").val();
    var email_id=jQuery("input#email_id").val();
    var parentsee=jQuery("input#parentsee").val();
    var author_bio=jQuery("#author_bio").val();
    var hear_about=jQuery("#hear_about").val();
    var education_approach=jQuery("#education_approach").val();
    var phone_numebr=jQuery("#phone_numebr").val();
	if(firstname==""){
		toastr["warning"]('First name is required');
	}else if(lastname==""){
		toastr["warning"]('Last name is required');
	}
	else if(email_id==""){
		toastr["warning"]('Email name is required');
	}
	else if(phone_numebr==""){
		toastr["warning"]('Phone number is required');
	}else{
		jQuery.ajax({
				type : "post",
				url : "/wp-admin/admin-ajax.php",
				data: 'firstname=' + firstname + '&lastname=' + lastname  + '&email_id=' + email_id + '&action=update_user_profile'+ '&phone_numebr='+phone_numebr,
				beforeSend: function(){
					jQuery("#loader_footer").show();
				},
				success: function(response) {
					response = jQuery.parseJSON(response);
					 if(response.success=='true'){
						  toastr["success"](response.message);
					 }else{
						  toastr["success"](response.message);
					 }
				 },
				complete:function(data){
					jQuery("#loader_footer").hide();
				}
		}) 
	}
})

jQuery("#learner_button").click(function(){
	jQuery("#learnermodal").toggleClass("togglelearner");
})
jQuery(".close-learner").click(function(){
	jQuery(".togglelearner").removeClass("togglelearner");
	jQuery("body.page-template.page-template-templates").toggleClass('modal-open');
	jQuery(".modal-backdrop.fade.in").hide();
})
jQuery(".close_child_avatar").click(function(){
	jQuery(".togglechildlearner").removeClass("togglechildlearner");
	jQuery("body.page-template.page-template-templates").toggleClass('modal-open');
	jQuery(".modal-backdrop.fade.in").hide();
})
jQuery("#child_avatar").click(function(){
	jQuery("#select_child_avatar").toggleClass("togglechildlearner");
})
jQuery(".edit_child_avatar").click(function(){
	jQuery("#select_child_avatar").toggleClass("togglechildlearner");
})

jQuery(".save_child_info").click(function(){
	var childfirstname=jQuery("#childfirstname").val();
    var childage=jQuery("#childage").val();
    var childgrade=jQuery("#childgrade").val();
    var show_img_add_img=jQuery("#show_img_add_img").val();
	if(childfirstname==""){
		toastr["warning"]('Child name is required');
	}else if(childage==""){
		toastr["warning"]('Child age is required');
	}else if(childgrade==""){
		toastr["warning"]('Child grade is required');
	}else{
		jQuery.ajax({
				type : "post",
				url : "/wp-admin/admin-ajax.php",
				data: 'first_name=' + childfirstname + '&age=' + childage  + '&grade=' + childgrade +  '&kid_img='+show_img_add_img+'&action=addkid',
				beforeSend: function(){
					jQuery("#loader_footer").show();
				},
				success: function(response) {
					response = jQuery.parseJSON(response);
					 if(response.success=='true'){
						  toastr["success"]("Kid profile added successfully");
					 }else{
						  toastr["success"]("Kid profile added successfully");
						  jQuery("#learnermodal").toggleClass("togglelearner");
						   setTimeout(function(){
							   window.location.reload();
							}, 2000);
					 }
				 },
				complete:function(data){
					jQuery("#loader_footer").hide();
				}
		}) 
	}
})


jQuery(".edit_child_button").click(function(){
	var data_edit_value=jQuery(this).attr('data-val');
	jQuery("#edit_user_profile-"+data_edit_value).toggleClass("edit_child_profile");
})
jQuery(".close-edit_profile").click(function(){
	jQuery(".edit_child_profile").toggleClass("edit_child_profile");
	jQuery("body.page-template.page-template-templates").toggleClass('modal-open');
	jQuery(".modal-backdrop.fade.in").hide();
})


jQuery(".edit_child_info").click(function(){
    //alert('res');
	var data_kid_edit_id=jQuery(this).attr('data-val');
	var childname=jQuery("#edit_user_profile-"+data_kid_edit_id+ " .childfirstname").val();
	var childage=jQuery("#edit_user_profile-"+data_kid_edit_id+ " .childage").val();
	var childgrade=jQuery("#edit_user_profile-"+data_kid_edit_id+ " .childgrade").val();
	var show_img_add_img=jQuery("#edit_user_profile-"+data_kid_edit_id+ " .show_img_add_img").val();
	if(childname==""){
		toastr["warning"]('Name is required');
	}else if(childage==""){
		toastr["warning"]('Child age is required');
	}else if(childgrade==""){
		toastr["warning"]('Child grade is required');
	}else{
		jQuery.ajax({
				type : "post",
				url : "/wp-admin/admin-ajax.php",
				data: 'first_name=' + childname + '&age=' + childage  + '&grade=' + childgrade + '&current_kid_id='+data_kid_edit_id+ '&kid_img='+show_img_add_img+'&action=updatekid',
				beforeSend: function(){
					jQuery("#loader_footer").show();
				},
				success: function(response) {
					response = jQuery.parseJSON(response);
					 if(response.success=='true'){
						  toastr["success"]("Kid profile updated successfully");
					 }else{
						  toastr["success"]("Kid profile updated successfully");
						  jQuery("#edit_user_profile-"+data_kid_edit_id).toggleClass("edit_child_profile");
						   setTimeout(function(){
							   window.location.reload();
							}, 2000);
					 }
				 },
				complete:function(data){
					jQuery("#loader_footer").hide();
				}
		}) 
	}
})



jQuery(document).ready(function (e) {
jQuery("#uploadimage1").on('submit',(function(e) {
e.preventDefault();
jQuery("#message").empty();
jQuery('#loading').show();
jQuery.ajax({
	url: "<?php echo site_url();?>/updateprofile.php", // Url to which the request is send
	type: "POST",             // Type of request to be send, called as method
	data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
	contentType: false,       // The content type used when sending data to the server.
	cache: false,             // To unable request pages to be cached
	processData:false,   
	beforeSend: function(){
		jQuery("#loader_footer").show();
	},	// To send DOMDocument or non processed data file it is set to false	// To send DOMDocument or non processed data file it is set to false
	success: function(data)   // A function to be called if request succeeds
	{
	var jsonData = JSON.parse(data);
		if(jsonData.success==true){
			toastr["success"](jsonData.message);
		}else{
			toastr["warning"](jsonData.message);
		}
	},
	complete:function(data){
		jQuery("#loader_footer").hide();
	}
});
}));

jQuery(function() {
jQuery("#change-photo").change(function() {
jQuery("#message").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var size = file.size;
var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
{
alert('Please Select A valid Image File.Only jpeg, jpg and png Images type allowed');
	  jQuery("#loader_footer").show();
	  setTimeout(function() {
		location.reload();
	}, 1000);
return false;
}else if(size>5000000){
	alert('"File is too Big, please select a file less than 5 MB');
	return false;
}else if(imagefile == 'image/gif'){
	  alert('Please Select A valid Image File.Only jpeg, jpg and png Images type allowed');
	  jQuery("#loader_footer").show();
	  setTimeout(function() {
		location.reload();
	}, 1000);
}
else
{
jQuery("input.customersubmit").click();
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
}
});
});
function imageIsLoaded(e) {
	//alert('ok good')
jQuery("#change-photo").css("color","green");
jQuery('#image_preview').css("display", "block");
jQuery('#profile-img').attr('src', e.target.result);
jQuery('.peer.profile_img_header.mR-10 img').attr('src', e.target.result);
jQuery('#profile-img').attr('width', '250px');
jQuery('#profile-img').attr('height', '230px');
};


});






</script>