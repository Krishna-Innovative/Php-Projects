<?php
/*Template name: location-popups*/
get_header(); 
?>   
	
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/page-create.css">    


<div class="inner_main_page_section_cls">
   <div class="text-center my-4">  
	<a class="btn btn-primary" data-post-id="location1" data-target="#location1" data-toggle="modal"> Location </a>
	<a class="btn btn-primary" data-post-id="location2" data-target="#location2" data-toggle="modal">jion us</a>
  </div>
	
<!--- location modal 1 -->
<div class="modal fade custom_trsparent_modal location_modal" id="location1">
  <div class="modal-dialog">
    <div class="modal-content m-custom">
      <!-- Modal Header -->
      <div class="modal-header m-custom">
		  <h4 class="text-white">Location</h4>
      </div>
      <!-- Modal body -->
      <div class="modal-body p-0">
		  <div class="location_block">
			      <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/02/Location.png" class="location_icon">
				<img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/02/pin.png" alt="img" class="map_icon"> 
			    <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/02/search.png" alt="img" class="search_icon">
				<input type="text" name="search_word" id="search" class="search form-control">
				<div class="location_check">
						<img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/02/tick.png" alt="img" class="check_icon">
				</div>
		</div>
		  <div class="create_post_map">
			   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109741.02912921079!2d76.6934885768626!3d30.735062644281005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fed0be66ec96b%3A0xa5ff67f9527319fe!2sChandigarh!5e0!3m2!1sen!2sin!4v1646375457939!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
		  </div>
		  <div class="region_sec">
			 <div class="row">
				 <div class="col-md-6">
					 <div class="region_select">
					 <img src="<?php echo esc_url(home_url('')); ?>//wp-content/uploads/2022/02/Local1.png" alt="img">
					   <select class="custom_select">
						   <option selected disabled>City region only</option>
						   <option>Chandigarh</option>
					   </select>
					  </div>
				 </div>
				 <div class="col-md-6 pl-md-0">
					<div class="region_checkbox">
					   <label>
						<input type="checkbox"  name=""><span>I understand that the location listed will be shown publically and accept site terms.</span>
						</label>
					</div>
				 </div>
			  </div> 
		  </div>
		  
		  <div class="country_sec">
			  <h4 class="text-white my-4 text-center">Country</h4>
			  <div class="country_select region_select">
				   <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/02/Global1.png" alt="img">
					   <select class="custom_select">
						   <option>India</option>
					   </select>
			  </div>
		  </div>
		  
		  <div class="tool_check text-center pt-0 mt-3">
							  <a href="#">
                                 <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Check1.png">
							   </a> 
						  </div>
        
      </div>
      <!-- Modal footer -->
          <div class="modal-footer m-custom">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
		  </div>
    </div>
  </div>
</div>
	
<!--- location modal 2 -->	
<div class="modal fade custom_trsparent_modal location_modal" id="location2">
  <div class="modal-dialog">
    <div class="modal-content m-custom">
      <!-- Modal Header -->
      <div class="modal-header m-custom disable_modal">
		  <h4 class="text-white">Location</h4>
      </div>
      <!-- Modal body -->
		<div class="join-premium">
          <div class="join-premium-wrapper">
            <a href="/subscription" class="main-jion_btn">
              <!--<button class=""> -->
              <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/download.jpg" alt="user photo" class="user_img">
              <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Join-us-button.png" alt="join btn" class="join_btn_img">
              <!-- JOIN US -->
            </a>
          </div>
          <div class="beesmart-club_main">
            <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/02/Location.png" alt="sunflower" class="sunflower_icon">
            <span>Beesmart Club</span>
            <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Verified.png" alt="verified" class="verified_icon">
          </div>
        </div>
      <div class="modal-body p-0 disable_modal">
		  <div class="location_block">
			      <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/02/Location.png" class="location_icon">
				<img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/02/pin.png" alt="img" class="map_icon"> 
			    <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/02/search.png" alt="img" class="search_icon">
				<input type="text" name="search_word" id="search" class="search form-control">
				<div class="location_check">
						<img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/02/tick.png" alt="img" class="check_icon">
				</div>
		</div>
		  <div class="create_post_map">
			   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109741.02912921079!2d76.6934885768626!3d30.735062644281005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fed0be66ec96b%3A0xa5ff67f9527319fe!2sChandigarh!5e0!3m2!1sen!2sin!4v1646375457939!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
		  </div>
		  <div class="region_sec">
			 <div class="row">
				 <div class="col-md-6">
					 <div class="region_select">
					 <img src="<?php echo esc_url(home_url('')); ?>//wp-content/uploads/2022/02/Local1.png" alt="img">
					   <select class="custom_select">
						   <option selected disabled>City region only</option>
						   <option>Chandigarh</option>
					   </select>
					  </div>
				 </div>
				 <div class="col-md-6 pl-md-0">
					<div class="region_checkbox">
					   <label>
						<input type="checkbox"  name=""><span>I understand that the location listed will be shown publically and accept site terms.</span>
						</label>
					</div>
				 </div>
			  </div> 
		  </div>
		  
		  <div class="country_sec">
			  <h4 class="text-white my-4 text-center">Country</h4>
			  <div class="country_select region_select">
				   <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/02/Global1.png" alt="img">
					   <select class="custom_select">
						   <option>India</option>
					   </select>
			  </div>
		  </div>
		  
		  <div class="tool_check text-center pt-0 mt-3">
							  <a href="#">
                                 <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Check1.png">
							   </a> 
						  </div>
        
      </div>
      <!-- Modal footer -->
          <div class="modal-footer m-custom">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
		  </div>
    </div>
  </div>
</div>
	
	
</div>
<?php 
get_footer();?>