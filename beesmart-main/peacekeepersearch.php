<?php
/*Template name:Peacekeeper search*/
get_header();
?>

<div class="inner_main_page_section_cls dasktop_main_page_section">
	<div class="peacekeeper_search"> 
	<div class="location_map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109741.02912921079!2d76.6934885768626!3d30.735062644281005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fed0be66ec96b%3A0xa5ff67f9527319fe!2sChandigarh!5e0!3m2!1sen!2sin!4v1646375457939!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
	</div>
    </div>
</div>

<div class="peacesearch-form-wrapper">

	
	
	
	<div class="peacesearch_form_location">
	<form action ="" method ="post" class="form-seacrh-cmm">
	    <div class="location_block">
				<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/pin.png" alt="img" class="map_icon"> 
			    <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/search.png" alt="img" class="search_icon">
				<input type = "text" name = "search_word" id ="search" class ="search form-control"  >
				<div class="location_check">
						<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/tick.png" alt="img" class="check_icon">
				</div>
		</div>
		
	    <div class="map_img">
		<input type = "submit" name = "search" value = "SEARCH" class ="btn_search">
				<a href="#">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/Location.png" alt="img">
				</a>
		</div>
		</form>
	</div>
	
	
	
	
	
	
	
	
	
	<div class="peacekeeper-search-main">
<div class="peacekeeper-search-cts">
<div class="form-search-custom">
<form action ="" method ="post" class="form-seacrh-cmm">
			<input type = "text" name = "search_word" id ="search" class ="search"  >
			<input type = "submit" name = "search" value = "SEARCH" class ="btn_search">
</form>
</div>
</div>
<div class="peacesearch_navigation">
		<div class="row">
			<div class="col-4">
				<a href="#" class="navigation_item" data-toggle="modal" data-target="#what_map">
					<span>What</span>
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/Peacekeeper.png" alt="img">
				</a>
			</div>
			<div class="col-4">
				<a href="#" class="navigation_item" data-toggle="modal" data-target="#when_map">
					<span>When</span>
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/Date-and-time.png" alt="img">
				</a>
			</div>
			<div class="col-4">
				<a href="#" class="navigation_item" data-toggle="modal" data-target="#saves_map">
					<span>Save</span>
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Feeds1.png" alt="img">
				</a>
			</div>
		</div>
	</div>
	<?php
if(isset($_POST['search'])) {
		$search = $_POST["search_word"];
		$search_word = $search;	
$publish = "publish";
$table = "peacekeeper";
$postid = $wpdb->get_results( "SELECT * FROM $table WHERE Location LIKE '$search_word' " );
?>
<div class="peacekeeper-search-next">
	<?php
//print_r($postid);
 count($postid);
$count_arr = count($postid);
if($count_arr == 0)
{
	?>
<div class="location_data">

<h3> No Record Found. </h3>

</div>
<?php
}

foreach ($postid as $postid)
{
	 $title_loc= $postid->Title;
	 $Location_loc= $postid->Location;
	 $url_loc= $postid->post_url;
	//if($title_loc != '')
	//{
?>
<div class="location_data">
<a href="<?php echo $url_loc;?>" target="_blank">
<span> <?php echo  $title_loc;?> </span>
<h3><?php echo  $Location_loc;?> </h3>
</a>
</div>
<?php
	//}
	//else
	//{
		
		
	//}
}
?>
</div>
<?php
}
?>
</div>
</div>

       <!-- Save Map Modal -->
        <div class="modal fade custom_trsparent_modal search_filter" id="saves_map">
                <div class="modal-dialog  modal-dialog-centered">
                 <div class="modal-content">

                     <!-- Modal Header -->
                    <div class="modal-header border-0">
                          <div class="filter_modal_header d-flex justify-content-center align-items-center mb-0">
                           <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Feeds1.png" alt="img">
                           <span class="text-white ml-2">Save</span>
                         </div>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body pt-0">
					   <p class="text-white text-center mb-3 mt-3">Save your map</p>
                       <div class="search_filter_steps">
                           <div class="saved_feed_block">
							  <div class="saved_feed_search">
								 <input type="text" class="form-control" placeholder="Name"/>  
							   </div>
							   
							   <p class="text-center">Select a sticker</p> 
							   <div class="select_sticker save_icons_block">
								   <div class="item icon_item">
									    <img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Most-Views.png"/>
								   </div>
								   <div class="item icon_item">
									    <img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Most-Views.png"/>
								   </div>
								   <div class="item icon_item">
									    <img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Most-Views.png"/>
								   </div>
								   <div class="item icon_item">
									    <img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Most-Views.png"/>
								   </div>
								   <div class="item icon_item">
									    <img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Most-Views.png"/>
								   </div>
								   <div class="item icon_item">
									    <img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Most-Views.png"/>
								   </div>
								   <div class="item icon_item">
									    <img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Most-Views.png"/>
								   </div>
								   <div class="item icon_item">
									    <img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Most-Views.png"/>
								   </div>
 							      <button type="button" class="load_more">
									 <img src="<?php echo site_url();?>/wp-content/uploads/2022/01/More-3.png"/>
								   </button>
							   </div>
						   </div>
						   
						   <div class="visibility_dropdown">
				             <img src="<?php echo site_url();?>/wp-content/uploads/2022/01/Hire1.png" class="add_to_img">		                            <select>
					        <option disabled selected>Visibility</option>
					        <option>Everyone</option>
							 <option>Me only</option>
				           </select>  
			            </div>
						   <div class="tool_check text-center pt-0">
							    <a href="#">
                                  <img src="<?php echo site_url();?>/wp-content/uploads/2022/01/Check1.png"/>
								</a> 
						   </div>
						   
                       </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer justify-content-center tool_modal_footer">
                      <button type="button" class="close close_center" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
					 </button>
                    </div>

                  </div>
                </div>
              </div>


         <!-- When Map Modal -->
        <div class="modal fade custom_trsparent_modal search_filter" id="when_map">
                <div class="modal-dialog  modal-dialog-centered">
                 <div class="modal-content">

                     <!-- Modal Header -->
                    <div class="modal-header border-0">
                          <div class="filter_modal_header d-flex justify-content-center align-items-center mb-0">
                           <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/Date-and-time.png" alt="img">
                           <span class="text-white ml-2">When</span>
                         </div>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body pt-0">
					   <p class="text-white text-center mb-3 mt-3">See content from</p>
                         <div class="custom_wrapper">
							 <select class="custom_select">
								 <option>Last 28 days</option>
								 <option>Last 30 days</option>
								 <option>Last 20 days</option>
							 </select>
                         </div>
						  <div class="tool_check text-center pt-0">
							  <a href="#">
                                 <img src="<?php echo site_url();?>/wp-content/uploads/2022/01/Check1.png"/>
							   </a> 
						  </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer justify-content-center tool_modal_footer">
                      <button type="button" class="close close_center" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
					 </button>
                    </div>

                  </div>
                </div>
              </div>

    <!-- What Map Modal -->
        <div class="modal fade custom_trsparent_modal search_filter" id="what_map">
                <div class="modal-dialog  modal-dialog-centered modal-lg">
                 <div class="modal-content">

                     <!-- Modal Header -->
                    <div class="modal-header border-0">
                          <div class="filter_modal_header d-flex justify-content-center align-items-center mb-0">
                           <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/Peacekeeper.png" alt="img" class="mx-70">
                           <span class="text-white ml-2">What</span>
                         </div>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body pt-0">
					   <p class="text-white text-center mb-3 mt-3">Select what you want to see:</p>
                         <div class="peacekeeper_items mt-0">
			   <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/1-soldier.png">
					<span>Soldier</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/2-terrorist.png">
					<span>Terrorist</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/3-Leader.png">
					<span>Corruption</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/4-live-combat.png">
					<span>Live Combat</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/5-Civilian-danger.png">
					<span>Civilian danger</span>
			 </div>
			 <div class="pec_item active">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/6-Truck.png">
					<span>Truck</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/7-tank.png">
					<span>Tank</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/8-helicopter.png">
					<span>Helicopter</span>
			 </div>
			 <div class="pec_item active">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/9-plane.png">
					<span>Plane</span>
			 </div>	
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/10-boat.png">
					<span>Boat</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/11-drone.png">
					<span>Drone</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/12-Missile.png">
					<span>Missile</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/13-explosives.png">
					<span>Explosives</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/14-base.png">
					<span>Base</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/15-supplies.png">
					<span>Supplies</span>
			 </div>
		 </div>
						  <div class="tool_check text-center pt-0">
							  <a href="#" data-toggle="modal" data-target="#post_map">
                                 <img src="<?php echo site_url();?>/wp-content/uploads/2022/01/Check1.png"/>
							   </a> 
						  </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer justify-content-center tool_modal_footer">
                      <button type="button" class="close close_center" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
					 </button>
                    </div>

                  </div>
                </div>
              </div>

      <!-- Post Map Modal -->
        <div class="modal fade custom_trsparent_modal search_filter" id="post_map">
                <div class="modal-dialog  modal-dialog-centered">
                 <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body pt-0">
                       <div class="peacekeeper_post custom_wrapper">
						   <div class="peacekeeper_post_header">
							   <h4>Peacekeeper</h4>
							     <img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Anonymous.png" class="left_img" alt="img">
							     <img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Peacekeeper.png" class="right_img" alt="img">
						   </div>
						  <div class="peacekeeper_post_thumbnail">
						   <img src="<?php echo site_url();?>/wp-content/uploads/2022/01/cover_photo-150x150.jpg" class="post-image" alt="">
							  <img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Copy-of-Warning.png" class="warning_img">
						  </div>
						   
						   <div class="peacekeeper_post_content">
							   <h4>Title</h4>
							   <p class="mb-3">Description</p>
							   <div class="row">
								   <div class="col-6">
									   <p>When:</p>
									   <p>3rd of march, 2022</p>
									   <p>10:33 AM</p>
								   </div>
								   <div class="col-6">
									   <p>Where:</p>
									   <p>35d Chandigarh, India</p>
								   </div>
							   </div>
							   <div class="peacekeeper_wrapper">
								 <div class="honey-block">
									 <div class="dashicons_heart_icon">
										 <a href="#" data-target="#honey" data-toggle="modal">
						                  <img src="<?php echo site_url();?>/wp-content/uploads/2022/01/Honey64A.png">
										   </a>
									 </div>
									 <span class="LoveCount">0</span>
								   </div> 
								   <div class="peacekeeper_time">
										  <span>3 d:</span>
										  <span>18 h:</span>
										  <span>22 m</span> 
								   </div>
								    <div class="like_block">
									<span class="linkCount"> 1</span>
									 <div class="bee_icon">
											<a href="#">
												<img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Most-Views.png" alt="bee"> 
											 </a>
									 </div>
									
								   </div> 
								    </div>
						  </div>
						   
						</div> 
						<div class="open_btn text-center mx-5">
							<a href="" >
							<img src="<?php echo site_url();?>/wp-content/uploads/2022/02/open_btn.png" alt="bee"> 
						    </a>
						</div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer justify-content-center tool_modal_footer">
                      <button class="close close_center" onclick="modalHide()">
                        <span aria-hidden="true">&times;</span>
					 </button>
                    </div>

                  </div>
                </div>
              </div>


<?php
get_footer();
?>