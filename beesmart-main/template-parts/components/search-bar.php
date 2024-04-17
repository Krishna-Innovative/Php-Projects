<?php 
/**
 * Posts Locator "default" search form template file. 
 * 
 * The information on this file outputs the search form.
 * 
 * You can modify this file to apply custom changes. However, it is not recomended
 * since your changes will be overwritten on the next update of the plugin.
 * 
 * Instead you can copy-paste this template ( the "default" folder contains this file 
 * and the "css" folder ) into the theme's or child theme's folder of your site 
 * and apply your changes from there. 
 * 
 * The template folder needs to be placed under:
 * your-theme's-or-child-theme's-folder/geo-my-wp/posts-locator/search-forms/
 * 
 * Once the template folder is in the theme's folder you will be able to select 
 * it in the form editor. It will show in the "Search form" dropdown menu as "Custom: default".
 *
 * @param $gmw_form ( object ) the entire form object
 * @param $gmw      ( array )  the form settings and values only
 * 
 * @author Eyal Fitoussi
 * 
 */

$tools_main_title = get_field( 'tools_main_title', 'options' );
$tools_main_image = get_field( 'tools_main_image', 'options' );
$focus_main_image = get_field( 'focus_main_image', 'options' );
$type1_main_image = get_field( 'type_1_main_image', 'options' );
$type2_main_image = get_field( 'type_2_main_image', 'options' );
$sort_main_title  = get_field( 'sort_main_title', 'options' );
$sort_main_image  = get_field( 'sort_main_image', 'options' );
$save_main_title  = get_field( 'save_main_title', 'options' );
$save_main_image  = get_field( 'save_main_image', 'options' );
$country_list     = ( class_exists( 'Element_Country' ) ) ? Element_Country::get_country_list() : array();
//echo '<pre>';print_r($country_list);
$um_buildin_obj   = ( class_exists( 'um\core\Builtin' ) ) ? new um\core\Builtin() : array();
$languages        = ( ! empty( $um_buildin_obj ) ) ? $um_buildin_obj->get( 'languages' ) : array();
//$languages        = ( ! empty( $languages ) ) ? array_merge( array( '' => __( '', '' ) ), $languages ) : array();
$languages=$languages;
$logged_id=get_current_user_id();
// echo '<pre>'; print_r( $languages ); die;
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<?php //do_action( 'gmw_before_search_form_template', $gmw ); ?>
<div class="gmw-form-wrapper default gmw-pt-default-form-wrapper <?php //echo esc_attr( $gmw['prefix'] ); ?>">
	<?php //do_action( 'gmw_before_search_form', $gmw ); ?>
	<form class="gmw-form" name="gmw_form" action="<?php //echo esc_attr( $gmw_form->get_results_page() ); ?>" method="get" data-id="<?php echo esc_attr( $gmw['ID'] ); ?>" data-prefix="<?php echo esc_attr( $gmw['prefix'] ); ?>">
		<?php //do_action( 'gmw_search_form_start', $gmw ); ?>
		<?php //do_action( 'gmw_search_form_filters', $gmw ); ?>
	
		
		<div id="search_navigation" class="">
			<?php if ( ! empty( $tools_main_title ) && ! empty( $tools_main_image ) ) { ?>
				<div class="search-nav-block">
					<button data-type="shadow" type="button" class=" search-nav-btn" data-toggle="modal" data-target="#search_filters"> 
						<img data-type="shadow" src="<?php echo esc_url( $tools_main_image );?>">
						<span data-type="shadow"><?php echo wp_kses_post( $tools_main_title ); ?></span>
					</button>

				</div>
			<?php } ?>

			<?php if ( ! empty( $sort_main_title ) && ! empty( $sort_main_image ) ) { ?>
				<div class="search-nav-block">
					<button data-type="shadow" type="button" class="search-nav-btn" data-toggle="modal" data-target="#search_sorts_by">
						<img data-type="shadow" src="<?php echo esc_url( $sort_main_image );?>">
						<span data-type="shadow"><?php echo wp_kses_post( $sort_main_title ); ?></span>
					</button>
                

				</div>
			<?php } ?>

			<?php if ( ! empty( $save_main_title ) && ! empty( $save_main_image ) ) { ?>
				<div id="" class="search-nav-block text-left">
					<button data-type="shadow" type="button" class="search-nav-btn" data-toggle="modal" data-target="#saves_query"> 
						<img data-type="shadow" src="<?php echo esc_url( $save_main_image );?>">
						<span data-type="shadow"><?php echo wp_kses_post( $save_main_title ); ?></span>
					</button>
				</div>
			<?php } ?>
			<!-- Search Filters Modal -->
			<div class="modal fade custom_trsparent_modal search_filter" id="search_filters">
				<div class="modal-dialog  modal-dialog-centered">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header border-0">
							<div class="filter_modal_header d-flex justify-content-center align-items-center">
								<img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Blue-tools.png">
								<?php if ( ! empty( $tools_main_title ) ) { ?>
									<span class="text-white ml-2"><?php echo wp_kses_post( $tools_main_title ); ?></span>
								<?php } ?>
							</div>
						</div>
						<!-- Modal body -->
						<div class="modal-body pt-0">
							<div class="search_filter_steps tools_filter">
								<!-- FOCUS STEPS -->
								<?php if ( have_rows( 'focus_values', 'options' ) ) { ?>
									<div class="single_step focus_step text-center">
										<div class="main_filter_btn">
											<?php if ( ! empty( $focus_main_image ) ) { ?>
												<button type="button" class="filter_btn">
													<img src="<?php echo esc_url( $focus_main_image );?>" alt="focus-main-image" />
												</button>
											<?php } ?>
										</div>
										<?php while ( have_rows( 'focus_values', 'options' ) ) {
											the_row();
											$row_index  = get_row_index();
											$focus      = get_sub_field( 'focus' );
											$icon       = get_sub_field( 'icon' );
											$icon_class = get_sub_field( 'icon_class_attribute' );
											?>
											<a data-focus="<?php echo esc_attr( $focus ); ?>" title="<?php echo esc_attr( $focus ); ?>" href="javascript:void(0);" class="single-focus item item<?php echo esc_attr( $row_index ); ?>">
												<img src="<?php echo esc_url( $icon );?>" class=" <?php echo esc_attr( $icon_class ); ?>">
											</a>
										<?php } ?>
										<input type="hidden" id="selected-focus" value="Business,Hobby,Community,Personal,Location,Professional" />
									</div>
								<?php } ?>

								<!-- TYPE 1 VALUES -->
								<?php if ( have_rows( 'type_1_values', 'options' ) ) { ?>
									<div class="single_step type_step text-center">
										<div class="main_filter_btn">
											<?php if ( ! empty( $type1_main_image ) ) { ?>
												<button type="button" class="filter_btn">
													<img src="<?php echo esc_url( $type1_main_image );?>" alt="type-main-image" />
												</button>
											<?php } ?> 
										</div>
										<?php while ( have_rows( 'type_1_values', 'options' ) ) {
											the_row();
											$row_index  = get_row_index();
											$value      = get_sub_field( 'value' );
											$icon       = get_sub_field( 'icon' );
											$icon_class = get_sub_field( 'icon_class_attribute' );
											?>
											<a data-val="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>" href="javascript:void(0);" class="single-type1 item item<?php echo esc_attr( $row_index ); ?>">
												<img src="<?php echo esc_url( $icon );?>" class="<?php echo esc_attr( $icon_class ); ?>">
											</a>
										<?php } ?>
										<input type="hidden" id="selected-type1" value="Other,Text,Audio,Gaming,Video,Image" />
									</div>
								<?php } ?>

								<!-- TYPE 2 VALUES -->
								<?php /*if ( have_rows( 'type_2_values', 'options' ) ) { ?>
									<div class="single_step find_step text-center">
										<div class="main_filter_btn">
											<?php if ( ! empty( $type2_main_image ) ) { ?>
												<button type="button" class="filter_btn">
													<img src="<?php echo esc_url( $type2_main_image );?>" alt="find-main-image" />
												</button>
											<?php } ?>
										</div>
										<?php while ( have_rows( 'type_2_values', 'options' ) ) {
									
											the_row();
											$row_index  = get_row_index();
											$value      = get_sub_field( 'value' );
											$icon       = get_sub_field( 'icon' );
											$icon_class = get_sub_field( 'icon_class_attribute' );
											?>
											<a data-val="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>" href="javascript:void(0);" class="single-type2 item item<?php echo esc_attr( $row_index ); ?>" data-toggle="modal" data-target="#find_modal">
												<img src="<?php echo esc_url( $icon );?>" class="disable <?php echo esc_attr( $icon_class ); ?>"/>
											</a>
										<?php } ?>
										<input type="hidden" id="selected-type2" value="" />
                                         <input type="hidden" id="selected-type2-discover" value="" />
                                        <input type="hidden" id="selected-type2-location" value="" />
                                        <input type="hidden" id="selected-type2-info-theme" value="" />
                                         <input type="hidden" id="selected-type2-info-paywall" value="" />
									</div>
								<?php }*/ ?>
								<input type="hidden" id="explicit_content" value="0">
								<div class="single_step info_step text-center mb-5 active">
									

									
									<div class="main_filter_btn">
										<button type="button" class="filter_btn">
											<img src="<?php echo site_url();?>/wp-content/uploads/2022/01/Button-Info.png" />
										</button>
									</div>
									<a href="#" class="item item7">
										<img src="<?php echo site_url();?>/wp-content/uploads/2022/01/Metadata-National-1.png" title="Country" class=""/>
										<?php // if ( ! empty( $country_list ) && is_array( $country_list ) ) { ?>
										 <select class="selectpicker countrypicker info_select info_country" data-flag="true"  data-live-search="true" multiple >
												<?php
												get_template_part('template-parts/sign-up/country-dropdown');
												?>
											</select>
										<?php //} ?>
									</a>
									<a href="javascript:void(0);" class="item item8 language_section">
										<img src="<?php echo site_url();?>/wp-content/uploads/2022/01/Language.png" title="Language">
										
										<?php 
										$languages_option=get_user_meta(get_current_user_id(),'languages',true);
										foreach($languages_option as $languages_opt){
												$langunagee[]=$languages_opt;
											}
										
										$loop=0;
										if ( ! empty( $languages ) && is_array( $languages ) ) { ?>
											<select multiple class="form-control info_select info_language selectpicker" data-live-search="true">
												<?php foreach ( $languages as $language ) { 
													if($languages_option[$loop]==$language){
														$selectedq='selected';
													
											?>
													<option value="<?php echo esc_attr( $language ); ?>" <?php echo $selectedq;?>><?php echo esc_html( $language ); ?></option>
												<?php 
														$loop++;
													}
											else{
												$selectedq='';
												?>
												<option value="<?php echo esc_attr( $language ); ?>" <?php echo $selectedq;?>><?php echo esc_html( $language ); ?></option>
											<?php }
											} ?>
											</select>
										<?php } 
										$result = !empty(array_intersect($languages, $languages_option));

										?>
										
									</a>
									<a href="javascript:void(0);" class="item item3 explicit_content">
										<img src="<?php echo site_url();?>/wp-content/uploads/2022/05/Safe-1.png"/>
										
									</a>
									<!--<a href="javascript:void(0);" class="item item4 disable" data-toggle="modal" id="locations_id">
										<img src="<?php echo site_url();?>/wp-content/uploads/2022/01/location1.png"/>
										
										<div class="location_modal_popup">
												 <div class="location_custom_block">
													<img src="<?php echo site_url();?>/wp-content/uploads/2022/02/pin.png" alt="img" class="map_icon"> 
													<img src="<?php echo site_url();?>/wp-content/uploads/2022/05/search2.png" alt="img" class="search_icon">
													<input type="text" name="locations" id="location" class="search pac-target-input form-control">
													
													<div class="location_check">
															<img src="<?php echo site_url();?>/wp-content/uploads/2022/02/tick.png" alt="img" class="check_icon">
													</div>
		                                          </div>
												 
												<input type="number" name="range" id="range" class="form-control" placeholder="range" onkeypress="if(this.value.length==3) return false;">
										</div>
									</a>-->
                                    <input type="hidden" id="info-country" name="info-country" value=""  />
                                    <input type="hidden" id="info-language" name="info-language" value="<?php echo implode(',', $languages_option);?>"  />
								</div>
								
							</div>
							<div class="tool_check text-center">
									<a href="javascript:void(0);" class="beesmart-save-filter-values">
										<img src="<?php echo site_url();?>/wp-content/uploads/2022/01/Check1.png"/>
									</a>  
								</div>
						</div>
						
						<!-- Modal footer -->
						<div class="modal-footer justify-content-center tool_modal_footer">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
						</div>
					</div>
				</div>
			</div>

			<!-- Sort By Modal -->
			<div class="modal fade custom_trsparent_modal search_filter" id="search_sorts_by">
				<div class="modal-dialog  modal-dialog-centered">
					<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header border-0">
						<div class="filter_modal_header d-flex justify-content-center align-items-center">
							<img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Blue-Sort.png">
							<?php if ( ! empty( $sort_main_title ) ) { ?>
								<span class="text-white ml-2"><?php echo wp_kses_post( $sort_main_title ); ?></span>
							<?php } ?>
						</div>
					</div>

					<!-- Modal body -->
					<div class="modal-body pt-0">
						<div class="search_filter_steps">
							<?php if ( have_rows( 'sorting_options', 'options' ) ) { ?>
								<div class="single_step find_step text-center content_step sorting_step">
									<div class="main_filter_btn">
										<button type="button" class="filter_btn">
											<img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Button-Sort.png" />
										</button> 
									</div>
									<?php while ( have_rows( 'sorting_options', 'options' ) ) {
										the_row();
										$row_index  = get_row_index();
										$sort_by    = get_sub_field( 'value' );
										$icon       = get_sub_field( 'icon' );
										$icon_class = get_sub_field( 'icon_class_attribute' );
										?>
										<a href="javascript:void(0);" class="single-sorting-item content_item item item<?php echo esc_attr( $row_index ); ?>">
											<img src="<?php echo esc_url( $icon );?>" class="disable <?php echo esc_attr( $icon_class ); ?>"/>
											<span data-sort="<?php echo esc_html( sanitize_title( $sort_by ) ); ?>"><?php echo wp_kses_post( $sort_by ); ?></span>
										</a>
									<?php } ?>
									<input type="hidden" id="selected-sorting_option" value="" />
								</div>
							<?php } ?>

							<div class="single_step find_step text-center content_step single__last_step">
								<div class="main_filter_btn">
									<button type="button" class="filter_btn">
										<img src="<?php echo home_url( '/wp-content/uploads/2022/02/Button-Show.png' );?>" />
									</button> 
								</div>
								<a href="#" class="item item4 content_item" data-toggle="modal" data-target="#hive_modal">
									<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2022/02/Hive.png' ) );?>"/>
									<span>Hive</span>
								</a>
								<a href="#" class="item item3 content_item">
									<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2022/02/All.png' ) );?>"/>
									<span>All</span>
								</a>
							</div>

							<div class="tool_check text-center pt-0">
								<a href="javascript:void(0);" class="beesmart-save-filter-sorting-values">
									<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2022/01/Check1.png' ) );?>"/>
								</a> 
							</div>
						</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer justify-content-center tool_modal_footer">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Save Feed Modal -->
		<div class="modal fade custom_trsparent_modal search_filter edit_category_modal edit_feed_modal" id="saves_query">
			<div class="modal-dialog  modal-dialog-centered">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header border-0">
						<div class="filter_modal_header d-flex justify-content-center align-items-center mb-0">
							<img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Blue-save.png">
							<span class="text-white ml-2">Save</span>
						</div>
					</div>
					<!-- Modal body -->
					<div class="modal-body pt-0">
						<div class="search_filter_steps">
							<div class="saved_feed_search">
									<input type="text" class="form-control" placeholder="Enter your feed name" id="name-feed" name="name-feed"/>  
								</div>
							<div class="saved_feed_block">
								
<!-- 								<p class="text-center">Select a sticker</p>  -->
								<div class="select_sticker save_icons_block">
								<?php global $wpdb;
								  
									$working_dir = getcwd();
									$img_dir = $working_dir . "/images/";
									chdir($img_dir);

									//using glob() function get images 
									$files = glob("*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}", GLOB_BRACE );
									chdir($working_dir);
									shuffle($files);
									for( $i = 0; $i < 16; $i++) {
										if($files[$i]!=""){
											$new_updated_link='/images/'.rawurlencode($files[$i]);
											echo "<div class='item icon_item active '><img src='$new_updated_link'>  </div>";  
										}else{
											$new_updated_link=$image_link.''.'1.png';
											echo "<div class='item icon_item '><img src='$new_updated_link'>  </div>";  
										}
									}
									?>
									
									
								</div>
								<button type="button" class="load_more reload_btn" id="">
										<img src="<?php echo site_url();?>/wp-content/uploads/2022/04/Check1.png"/>
									</button>
								<a href="javascript:void(0);" class="beesmart-save-fiter-options-in-db">
								<img src="<?php echo site_url();?>/wp-content/uploads/2022/01/Check1.png"/>
							    </a> 

								
							</div>
<div class="edit_feeds_btns">
				
								
				<a href="#" class="visibility_btn_add disable"> <img src="<?php echo site_url();?>/wp-content/uploads/2022/05/Visibility.png"><p>Sharing</p></a>
            
			</div>

							<input type="hidden" value="0" id="visibility_type" >
							 <input type="hidden" value="" id="feed_have" name="feed_have" />
							 <input type="hidden" value="<?php echo $logged_id;?>" id="logged_in_user_id" name="logged_in_user_id" />
									<input type="hidden" id="pagecount" name="pagecount" value="1"/>
					</div>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer justify-content-center tool_modal_footer">
					<a class="feed-create-close-btn" data-dismiss="modal">
					<img src="<?php echo imgPATH; ?>X.png" width="40px">
					</a>
				</div>

				</div>
			</div>
			</div>
			<div class="modal fade custom_trsparent_modal search_filter" id="hive_modal">
				<div class="modal-dialog  modal-dialog-centered">
				 <div class="modal-content">
					<!-- Modal body -->
					<div class="modal-body pt-0">
					   <div class="hive_modal_body">
							<div class="hive_header">
							   <img src="<?php echo site_url();?>/wp-content/uploads/2022/02/Hive.png" />
								<p>Select which of your Hive types will appear in your new feed.</p>
								<b>Tip:</b>
								<p>Not seeing much content?</p>
								<p>Browse 'All' to find new Hives to 'Add' or ask for Hive links from people you know.</p>
							</div>
						  <?php 
						  
?>
						   <div class="main_hives_item">
                           <?php 
						   global $wpdb;
$current_user = wp_get_current_user();
                        $current_user_id = $current_user->ID;
                        $own_category_results = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where `author_id` =$current_user_id");
						 $gmw_icons = get_option('gmw_icons');
						$image_link= $gmw_icons['pt_category_icons']['url'];
                        if (!empty($own_category_results)) {
                            $loop = 1;
                            foreach ($own_category_results as $results) {
                                $category_ids = $results->category_value;
								$category_icons = $results->category_icons;
                                $category_name = get_cat_name($category_ids);
								if($category_name!=""){
									if($category_icons==""){
										$category_icons='1.png';
									}else{
										$category_icons=$category_icons;
									}
									?>
								<div class="hive_item" data-id="<?php echo $category_ids;?>">
									<img src="<?php echo $image_link.''.$category_icons;?>">
									<span>Follwing Tag Typee:<?php echo $category_name; ?></span>
							   </div>
                               <?php } } } ?>
							   
						   </div>

						   <div class="tool_check text-center pt-0" id="hive_popup_modal">
								<a href="javascript:void(0);">
								  <img src="<?php echo site_url();?>/wp-content/uploads/2022/01/Check1.png"/>
								</a> 
						   </div>
						   
					   </div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer justify-content-center tool_modal_footer">
					  <a href="javascript:void(0);" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					 </a>
					</div>

				  </div>
				</div>
			  </div>
			<input type="hidden" class="hive_type_list" id="hive_type_list" value="">
		</div>
		
			<div class="sreachinput_group">
			<div class="search_by_keyword_block test_block_example">
			<img src="<?php echo imgPATH; ?>Tags.png" class="tag_icon" alt="img">
			<input type="text" name="customkeywords" id="search_by_keyword_input">
			<button data-type="shadow" type="button" name="customsubmitbtn" id="custo_submit_btm" class="click_animation"></button>
		</div>
		</div>
		
		<!-- sort by -->
		<!-- <div class="gmw-results-message"> -->
			<?php //do_action( 'gmw_search_results_after_results_message', $gmw ); ?>
		<!-- </div> -->
		<?php //gmw_search_form_address_field( $gmw ); ?>
		<?php //gmw_search_form_post_types( $gmw ); ?>
				
		<?php //gmw_search_form_taxonomies( $gmw ); ?>		
				
		<?php // do_action( 'gmw_search_form_before_distance', $gmw ); ?>
					
		<?php //gmw_search_form_radius( $gmw ); ?>
			
		<?php //gmw_search_form_units( $gmw ); ?>
					
		<?php //gmw_search_form_submit_button( $gmw ); ?>
		
		<?php //do_action( 'gmw_search_form_end', $gmw ); ?>
		
	</form>

	<?php //do_action( 'gmw_after_search_form', $gmw ); ?>
	
	
 <!-- The Find Modal -->
  <div class="modal custom_trsparent_modal find-modal" id="find_modal">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content"> 
		  
		<!-- Modal body -->
		<div class="modal-body">
		<section  class="news_details_section">
			<form action="">
			   <div class="warpper mb-0">
				   <div class="details_heading">
						<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Create-Button-Sell.png" class="right_icon"/>
						<h2>Hire Someone</h2>
					   <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/sunflower1.png" class="left_icon"/>
				   </div>
				   <div class="main_checkboxes be_found" style="display:none;">
					<div class="row">
					   <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="1" name="type2_check" value="Music">
									<label class="" for="1">Music</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="2" name="type2_check" value="Dance">
								  <label class="" for="2">Dance</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="3" name="type2_check" value="Art">
									<label class="" for="3">Art</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="4" name="type2_check" value="Celebrity">
								  <label class="" for="4">Celebrity</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="5" name="type2_check" value="Health">
									<label class="" for="5">Health</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="6" name="type2_check" value="Fun">
								  <label class="" for="6">Fun</label>
								</div>
                                <div class="form-check">
								  <input type="checkbox" class="" id="technology" name="type2_check" value="Technology">

								  <label class="" for="12">Technology</label>
								</div>		
						 </div>
					  </div>
					   <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="7" name="type2_check" value="Influencer">
									<label class="" for="7">Influencer</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="8" name="type2_check" value="Travel">
								  <label class="" for="8">Travel</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="9" name="type2_check" value="Motivation">
									<label class="" for="9">Motivation</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="10" name="type2_check" value="Sport">
								  <label class="" for="10">Sport</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="11" name="type2_check" value="Gaming">
									<label class="" for="11">Gaming</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="trolling" name="type2_check" value="Trolling">
								  <label class="" for="12">Trolling</label>
								</div>
                                <div class="form-check">
								  <input type="checkbox" class="" id="religion" name="type2_check" value="Religion">
								  <label class="" for="12">Religion</label>
								</div>	
						 </div>
					  </div>
						  <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="13" name="type2_check" value="Comedy">
									<label class="" for="13">Comedy</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="14" name="type2_check" value="Resume (CV)">
								  <label class="" for="14">Resume (CV)</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="15" name="type2_check" value="Expert">
									<label class="" for="15">Expert</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="16" name="type2_check" value="Business">
								  <label class="" for="16">Business</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="17" name="type2_check" value="Finance">
									<label class="" for="17"> Finance</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="18" name="type2_check" value="Stonks">
								  <label class="" for="18">Stonks</label>
								</div>	
						 </div>
					  </div>
				   </div>
				</div>
				   
                   <div class="main_checkboxes find_someone" style="display:none;">
					<div class="row">
					   <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="friends" name="type2_check" value="Friends">
									<label class="" for="friends">Friends</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="hobby_partner" name="type2_check" value="Hobby partner">
								  <label class="" for="hobby_partner">Hobby partner</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="business_associate" name="type2_check" value="Business associate">
									<label class="" for="business_associate">Business associate</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="teammate" name="type2_check" value="Teammate">
								  <label class="" for="teammate">Teammate</label>
								</div>
								 
								 		
						 </div>
					  </div>
					   <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="romance" name="type2_check" value="Romance">
									<label class="" for="romance">Romance</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="travel_buddy" name="type2_check" value="Travel buddy">
								  <label class="" for="travel_buddy">Travel buddy</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="faith_mate" name="type2_check" value="Faith mate">
									<label class="" for="faith_mate">Faith mate</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="band_member" name="type2_check" value="Band member">
								  <label class="" for="band_member">Band member</label>
								</div>
								
                                
						 </div>
					  </div>
						  <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="filling" name="type2_check" value="Fling/casual">
									<label class="" for="filling">Fling/casual</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="Study_buddy" name="type2_check" value="Study buddy">
								  <label class="" for="Study_buddy">Study buddy</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="group_member" name="type2_check" value="Group member">
									<label class="" for="group_member">Group member</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="other" name="type2_check" value="Other">
								  <label class="" for="other">Other</label>
								</div>
								 
						 </div>
					  </div>
				   </div>
				</div>
                
                
                <div class="main_checkboxes sell_buy" style="display:none;">
					<div class="row">
					   <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="fashion" name="type2_check" value="Fashion">
									<label class="" for="fashion">Fashion</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="art" name="type2_check" value="Art">
								  <label class="" for="art">Art</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="bussiness1" name="type2_check" value="Business">
									<label class="" for="bussiness1">Business</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="card_vehicle" name="type2_check" value="Cart and vehicles">
								  <label class="" for="card_vehicle">Cart and vehicles</label>
								</div>
								 
								 		<div class="form-check">
									<input type="checkbox" class="" id="kitchen" name="type2_check" value="Kitchen">
									<label class="" for="kitchen">Kitchen</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="services" name="type2_check" value="Services">
								  <label class="" for="services">Services</label>
								</div>
						 </div>
					  </div>
					   <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="books" name="type2_check" value="Books">
									<label class="" for="books">Books</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="digital_product" name="type2_check" value="Digital products">
								  <label class="" for="digital_product">Digital products</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="beauty" name="type2_check" value="Beauty">
									<label class="" for="beauty">Beauty</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="food" name="type2_check" value="Food">
								  <label class="" for="food">Food</label>
								</div>
								
                                <div class="form-check">
									<input type="checkbox" class="" id="tech" name="type2_check" value="Tech">
									<label class="" for="tech">Tech</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="venue_hire" name="type2_check" value="Venue hire">
								  <label class="" for="venue_hire">Venue hire</label>
								</div>
						 </div>
					  </div>
						  <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="health" name="type2_check" value="Health">
									<label class="" for="health">Health</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="houses_homes" name="type2_check" value="Houses/homes">
								  <label class="" for="houses_homes">Houses/homes</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="media_music" name="type2_check" value="Media/music">
									<label class="" for="media_music">Media/music</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="household_items" name="type2_check" value="Household items">
								  <label class="" for="household_items">Household items</label>
								</div>
								 <div class="form-check">
									<input type="checkbox" class="" id="coupons" name="type2_check" value="Coupons">
									<label class="" for="coupons">Coupons</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="tradesman_services" name="type2_check" value="Tradesman services">
								  <label class="" for="tradesman_services">Tradesman services</label>
								</div>
						 </div>
					  </div>
				   </div>
				</div>
                
                <div class="main_checkboxes events" style="display:none;">
					<div class="row">
					   <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="holiday" name="type2_check" value="Holiday">
									<label class="" for="holiday">Holiday</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="art1" name="type2_check" value="Art">
								  <label class="" for="art1">Art</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="bussiness2" name="type2_check" value="Business">
									<label class="" for="bussiness2">Business</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="celebrity" name="type2_check" value="Celebrity">
								  <label class="" for="celebrity">Celebrity</label>
								</div>
								 
								 		<div class="form-check">
									<input type="checkbox" class="" id="community" name="type2_check" value="Community">
									<label class="" for="community">Community</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="family1" name="type2_check" value="Family">
								  <label class="" for="family1">Family</label>
								</div>
                                <div class="form-check">
								  <input type="checkbox" class="" id="Funny" name="type2_check" value="Funny">
								  <label class="" for="Funny">Funny</label>
								</div>
						 </div>
					  </div>
					   <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="fashion1" name="type2_check" value="Fashion">
									<label class="" for="fashion1">Fashion</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="festival" name="type2_check" value="Festival">
								  <label class="" for="festival">Festival</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="food1" name="type2_check" value="Food">
									<label class="" for="food1">Food</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="health" name="type2_check" value="Health">
								  <label class="" for="health">Health</label>
								</div>
								
                                <div class="form-check">
									<input type="checkbox" class="" id="movies" name="type2_check" value="Movies">
									<label class="" for="movies">Movies</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="music" name="type2_check" value="Music">
								  <label class="" for="music">Music</label>
								</div>
                                <div class="form-check">
								  <input type="checkbox" class="" id="Wholesome" name="type2_check" value="Wholesome">
								  <label class="" for="Wholesome">Wholesome</label>
								</div>
						 </div>
					  </div>
						  <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="Politics" name="type2_check" value="Politics">
									<label class="" for="Politics">Politics</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="Religion" name="type2_check" value="Religion">
								  <label class="" for="Religion">Religion</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="Live" name="type2_check" value="Live">
									<label class="" for="Live">Live</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="Science" name="type2_check" value="Science">
								  <label class="" for="Science">Science</label>
								</div>
								 <div class="form-check">
									<input type="checkbox" class="" id="Tech11" name="type2_check" value="Tech">
									<label class="" for="Tech11">Tech</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="Inspiring" name="type2_check" value="Inspiring">
								  <label class="" for="Inspiring">Inspiring</label>
								</div>
                                <div class="form-check">
								  <input type="checkbox" class="" id="Kids" name="type2_check" value="Kids">
								  <label class="" for="Kids">Kids</label>
								</div>
						 </div>
					  </div>
				   </div>
				</div>
                
                <div class="main_checkboxes news" style="display:none;">
					<div class="row">
					   <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="breaking" name="type2_check" value="Breaking">
									<label class="" for="breaking">Breaking</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="art12" name="type2_check" value="Art">
								  <label class="" for="art12">Art</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="bussiness22" name="type2_check" value="Business">
									<label class="" for="bussiness22">Business</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="Community1" name="type2_check" value="Community">
								  <label class="" for="Community1">Community</label>
								</div>
								 
								 		<div class="form-check">
									<input type="checkbox" class="" id="Fashion1" name="type2_check" value="Fashion">
									<label class="" for="Fashion1">Fashion</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="World" name="type2_check" value="World">
								  <label class="" for="World">World</label>
								</div>
                               
						 </div>
					  </div>
					   <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="Health1" name="type2_check" value="Health">
									<label class="" for="Health1">Health</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="Medicine" name="type2_check" value="Medicine">
								  <label class="" for="Medicine">Medicine</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="Music1" name="type2_check" value="Music">
									<label class="" for="Music1">Music</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="politics" name="type2_check" value="Politics">
								  <label class="" for="politics">Politics</label>
								</div>
								
                                <div class="form-check">
									<input type="checkbox" class="" id="weather" name="type2_check" value="Weather">
									<label class="" for="weather">Weather</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="Science" name="type2_check" value="Science">
								  <label class="" for="Science">Science</label>
								</div>
                               
						 </div>
					  </div>
						  <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="Inspiring1" name="type2_check" value="Inspiring">
									<label class="" for="Inspiring1">Inspiring</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="Funny1" name="type2_check" value="Funny">
								  <label class="" for="Funny1">Funny</label>
								</div>
								<div class="form-check">
									<input type="checkbox" class="" id="Kids1" name="type2_check" value="Kids">
									<label class="" for="Kids1">Kids</label>
								</div>
								 
                                 <div class="form-check">
								  <input type="checkbox" class="" id="Finance1" name="type2_check" value="Finance">
								  <label class="" for="Finance1">Finance</label>
								</div>
                                 <div class="form-check">
								  <input type="checkbox" class="" id="Tech22" name="type2_check" value="Tech">
								  <label class="" for="Tech22">Tech</label>
								</div>
						 </div>
					  </div>
				   </div>
				</div>
                
                <div class="main_checkboxes hire_someone" style="display:none;">
					<div class="row">
					   <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="one-off-job" name="type2_check" value="One-off job">
									<label class="" for="one-off-job">One-off job</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="Casual" name="type2_check" value="Casual">
								  <label class="" for="Casual">Casual</label>
								</div>
								 
                               
						 </div>
					  </div>
					   <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="Full-time" name="type2_check" value="Full-time">
									<label class="" for="Full-time">Full-time</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="Volunteer" name="type2_check" value="Volunteer">
								  <label class="" for="Volunteer">Volunteer</label>
								</div>
							
 						 </div>
					  </div>
						  <div class="col-md-4 col-6">
						   <div class="checkboxes">
								<div class="form-check">
									<input type="checkbox" class="" id="Part-time" name="type2_check" value="Part-time">
									<label class="" for="Part-time">Part-time</label>
								</div>
								<div class="form-check">
								  <input type="checkbox" class="" id="Contract" name="type2_check" value="Contract">
								  <label class="" for="Contract">Contract</label>
								</div>
								
						 </div>
					  </div>
				   </div>
				</div>
                
                
				   <div class="main_audience">
					   <h4 class="audience_sub_heading">Location</h4>
					   <div class="audience_inner">
							<label class="single_audience" for="local">
						  <input checked type="radio" name="audience" id="local" value="local" />
						  <div class="audience-content">
							<img loading="lazy" src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Metadata-local.png" alt="local" />
							<span>Local</span>
						  </div>
						</label> 			 
					  
					   <label class="single_audience" for="national">
						  <input type="radio" name="audience" id="national" value="national" />
						  <div class="audience-content">
						  <img loading="lazy" src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Metadata-National.png" alt="national" />							<span>National</span>
						  </div>
						</label>
					   
					   <label class="single_audience" for="global">
						  <input type="radio" name="audience" id="global" value="global"/>
						  <div class="audience-content">
							<img loading="lazy" src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Metadata-Global.png" alt="global" />
							<span>Global</span>
						  </div>
						</label>
                        <label class="single_audience" for="online">
						  <input type="radio" name="audience" id="online" value="online"/>
						  <div class="audience-content">
							<img loading="lazy" src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Metadata-Global.png" alt="online" />
							<span>Online</span>
						  </div>
						</label>
					</div>
				   </div>
				   
				   <div class="main_info">
					   <h4 class="audience_sub_heading">Info</h4>
						<div class="row">
							<div class="col-md-6">
                            <label for="theme">Theme</label>
								<select class="form-control" id="theme" name="theme"> 
								  <option value="Positive">Positive</option>
								  <option value="Negative">Negative</option>
								 
								</select>
							</div>
							<div class="col-md-6">
                             <label for="yaywall">Paywall</label>
								<select class="form-control" name="yaywall" id="yaywall">
                                 <option value="Does the content  have a paywall?"> Does the content  have a paywall?</option>
								  <option value="yes">Yes</option>
								  <option value="no">No</option>
								  
								</select>
							</div>
					   </div>
					   
				   </div>
				   
				   <?php /*?><div class="about_fields">
					   <h4 class="audience_sub_heading">About</h4>
						<div class="form-group">
							<input type="email" class="form-control" id="" placeholder="About me (text field)">
						</div>
						<div class="form-group">
							<input type="email" class="form-control" id="" placeholder="I'm looking for (text field)">
						</div>
				   </div><?php */?>
				   
				</div>	
				
					<div class="tool_check type2_tool_check text-center">
								<a href="#">
								  <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Check1.png">
								</a> 
						 </div>
			</form>
		</section>
		</div>
		<!-- Modal footer -->
		<div class="modal-footer justify-content-center">
		  <a href="" class="btn btn-danger close" data-dismiss="modal">Back</a>
		</div>
	  </div>
	</div>
  </div>
  <!-- The Find Modal End -->
<!-- The Location Modal Start-->
<div class="modal custom_trsparent_modal find-modal" id="location_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
                <section class="news_details_section">
                    <form action="">
                        <div class="warpper mb-0">
                            <div class="details_heading">
                                <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Create-Button-Be-Found.png"
                                    class="right_icon" />
                                <h2>Location</h2>
                                <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/sunflower1.png"
                                    class="left_icon" />
                            </div>
                            <div class="main_location">
                            	<div class="search_by_keyword_block test_block_example">
                                    <input type="text" name="customkeywords" class="location_search">
                                    <button type="button" name="customsubmitbtn" id="location_search_btn"></button>
                                </div>
                                <div class="location_map"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Malet%20St,%20London%20WC1E%207HU,%20United%20Kingdom+(Your%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/sport-gps/">hiking gps</a></iframe></div>
                            </div>
                        </div>
                        <div class="tool_check text-center">
                            <a href="#">
                                <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Check1.png">
                            </a>
                        </div>
                    </form>
                </section>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <a href="" class="btn btn-danger close" data-dismiss="modal">Back</a>
            </div>
        </div>
    </div>
</div>
<!-- Find Location Modal End -->
</div>
<?php
do_action( 'gmw_after_search_form_template', $gmw );
?>
<style>
.niceCountryInputSelector.info_select.info_country {
    background: #fff;
    padding: 0px;
}
.niceCountryInputMenuDropdownContent a {
    text-align: left;
}
	.location_modal {
    position: absolute;
}
	input#range {
    width: 160px;
}
button.btn.dropdown-toggle.btn-light.bs-placeholder {
    display: none! important;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script>
$(function () {
    $('.selectpicker').selectpicker();
});
$(document).ready(function(){
	$('button.btn.dropdown-toggle.btn-light.bs-placeholder').text('All');
	$('button.btn.dropdown-toggle.btn-light.bs-placeholder').hide();
	$('a.item.item8.language_section').click(function(){
		$('.form-control.info_select.info_language button').show();
		$('.info_select.info_country button').hide();
	})
	$('a.item.item7').click(function(){
		//.dropdown.bootstrap-select.show-tick.form-control.info_select.info_language.dropup
		$('.form-control.info_select.info_language button').hide();
		$('.info_select.info_country button').show();
	})
})
</script>
