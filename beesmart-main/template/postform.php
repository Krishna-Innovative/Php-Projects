<?php /* Template Name: Post Form Template */ ?>
<?php get_header();
$post_id = get_the_ID(); /*current post id get in wp*/
$user_id = get_current_user_id(); 
$WebUrl = site_url();  
//$currentpost = get_post_permalink( $post_id ); 

	
?>
<?php //$all_meta_for_user = get_user_meta( $post_ids );
        //$Currencypicker = $all_meta_for_user['Currency_picker'][0];

			?> 
        <!-- Banner html start in wp -->
        <div class="inner_main_page_section_cls" id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
            <div class="search_option">
                <div class="container">
                    <?php //echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
                </div>
            </div>
			<style>
			.price-range-slider {display:none;}
			.price-range-slider {width:100%;float:left;padding:10px 20px;}
			.range-value {margin:0;}
			input {width:100%;background:none;color: #000;font-size: 16px;font-weight: initial;box-shadow: none;border: none;margin: 20px 0 20px 0;
			}
			.range-bar {
				border: none;
				background: #000;
				height: 3px;
				width: 96%;
				margin-left: 8px;
			}		
			.ui-slider-range {background:#06b9c0;}
			.ui-slider-handle {border:none;border-radius:25px;background:#fff;border:2px solid #06b9c0;height:17px;width:17px;top: -0.52em;cursor:pointer;}
			.ui-slider-handle + span {background:#06b9c0;}
			.page-template-postform .the_buddyforms_form .buddyforms-buddyform-post fieldset .col-xs-12.currency-range .bf_field_group.elem-Country {float: left;width: 27%;}
			.page-template-postform .map_section .map_location_clss .buddy_main_cls #buddyforms_form_hero_buddyform-post #buddyforms_form_buddyform-post .col-xs-12.currency-range .bf_field_group.elem-Country select {text-align: center;color: #db9b36 !important;font-weight: 600;}
			.page-template-postform .the_buddyforms_form .buddyforms-buddyform-post fieldset .col-xs-12.currency-range .price-range-slider {float: left;width: 73%;	padding-right: 10px;padding-top: 40px;}
			.page-template-postform .the_buddyforms_form .buddyforms-buddyform-post fieldset .col-xs-12.currency-range .price-range-slider .range-value input {width: 100%;	padding: 9px 10px;}
			.page-template-postform .the_buddyforms_form .buddyforms-buddyform-post fieldset .col-xs-12.currency-range .price-range-slider #slider-range .ui-slider-handle.ui-corner-all {background: #DB9B36;border-radius: 40px;width: 25px;height: 25px;top: -8px;}
			</style>
			    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
				<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>-->
				<style>
					.page-template-postform .map_section .map_location_clss .buddy_main_cls #buddyforms_form_hero_buddyform-post #buddyforms_form_buddyform-post .bf-input .select2-selection {
						/* box-shadow: 0px 2px 2px rgba(0,0,0,0.25); */
						border: none!important;
						color: black!important;
						font-size: 18px!important;
						font-weight: 500;
						margin: 5px 0px;
						border-radius: 10px!important;
				}
			</style>
			<script>
			        //-----JS for Price Range slider-----
					$(function() {
						$( "#slider-range" ).slider({
						  range: true,
						  min: 9000,
						  max: 1000000,
						  values: [ 9000, 1000000 ],
						  slide: function( event, ui ) {
							$( "#amount" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
						  }
						});
						$( "#amount" ).val( "" + $( "#slider-range" ).slider( "values", 0 ) +
						  " - " + $( "#slider-range" ).slider( "values", 1 ) );
					});
					</script>
				
				<div class="price-range-slider">
				  <p class="range-value">
					<input type="text" id="amount" readonly>
				  </p>
				  <div id="slider-range" class="range-bar"></div>
				  
				</div>
            <div id="UserClories"></div>
            <?php if ( is_user_logged_in() ) { ?>
                <!-- user login check in wp condition start -->
                <div class="map_section">
                    <div class="container">
                        <div class="map_location_clss">
						    <div class="col-xs-12 my_map_cls">
                                <label>Map Location</label>
                                <?php echo do_shortcode('[gmw_current_location elements="formatted_address,address,location_form"]');?>
                            </div>
                            <div class="buddy_main_cls">
                                <div class="line_cls">
                                    <div id="post_title_cls"> <img class="gry_cls" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/grey-oil.png"> <img class="org_cls" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/orng.png"> <span>1</span> </div>
                                    <div id="post_price"> <img class="gry_cls" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/grey-oil.png"> <img class="org_cls" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/orng.png"> <span>2</span> </div>
                                    <div id="post_language"> <img class="gry_cls" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/grey-oil.png"> <img class="org_cls" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/orng.png"> <span>3</span> </div>
                                    <div id="post_category_cls"> <img class="gry_cls" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/grey-oil.png"> <img class="org_cls" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/orng.png"> <span>4</span> </div>
                                    <div id="post_tag_cls"> <img class="gry_cls" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/grey-oil.png"> <img class="org_cls" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/orng.png"> <span>5</span> </div>
									<div id="feature_post_tag_cls"> <img class="gry_cls" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/grey-oil.png"> <img class="org_cls" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/orng.png"> <span>6</span> </div>
                                </div>
								<div class="buddy-creating-post-form">
								
									<div class="creting-post-title">
								        <h1>Creating Post</h1>
										<div class="view-latest-post" style="display:none">

										  <?php
												$args = array( 'numberposts' => '1' );
												$recent_posts = wp_get_recent_posts( $args );
												foreach( $recent_posts as $recent ){
												  $recent_link = '<a id="view_my_post" href="">View Post</a>';
												  echo $recent_link;
												}
											?>
										  
											 
											
										</div>
								    </div>
									
								  
                                <?php echo do_shortcode('[bf form_slug="buddyform-post"]'); ?>
								</div>
                                    <!-- Buddy press form shortcode add in wp and add hidden field in this form -->
                            </div>
							
							
                        </div>
                    </div>
                </div>
                <!-- End -->

                <script type="text/javascript">

						  $(function () {
                             var userlink = '<?php echo $post_id ?>';
							 //var postlink = '<?php echo $currentpost ?>';
							$('form').on('submit', function (e) {

							  e.preventDefault();

							  $.ajax({
								type: 'post',
								url: 'https://beesmartdev.wpengine.com/post-form/',
								data: {
                                    userlink: userlink
                                },
								success: function () {
									
									var link = '<?php echo get_permalink($post_id)?>'; 
								    $("#view_my_post").attr("href", link); 
								}
							  });
							});
						  });
                </script>
                <script type="text/javascript">
                $(document).ready(function() {
					//alert('123');
                    /*----------------------------------------------------------------------------------------------------------------------------------*/
                    /*DefaultAddress Get and append the value in input filed */
					//$("#Currency").val('<?php echo $Currencypicker; ?>'); 
                    var DefaultCityAddress = $(".address_custom_get").attr("value");
                    $("#Address").val(DefaultCityAddress);
                    $("#Eventaddress").val(DefaultCityAddress);
                    $("#Jobaddress").val(DefaultCityAddress);
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({
                        'address': DefaultCityAddress
                    }, function(results, status) {
                        var DefaultCityLatitude = results[0].geometry.location.lat();
                        var DefaultCityLongitude = results[0].geometry.location.lng();
                        $("#Latitude").val(DefaultCityLatitude);
                        $("#Longitude").val(DefaultCityLongitude);
                    });
                    /*End DefaultAddress Get and append the value in input filed */
                    /*End formatted_address */
                    var userid = '<?php echo $user_id; ?>';
                    var SiteUrl ='<?php echo $WebUrl; ?>';
                    var ckbox = $('#Checkbox-0');
                    $('#Checkbox-0').on('click', function() {
                        if(ckbox.is(':checked')) {
                            $.ajax('https://beesmartdev.wpengine.com/wp-content/themes/Divi/ajax.php', {
                                type: 'POST',
                                data: {
                                    userid: userid
                                },
                                dataType: "json",
                                success: function(data, status, xhr) {
                                    //alert('User Payment Done'); 
                                    /*if user show the payment then its show alert message*/
                                },
                                error: function(jqXhr, textStatus, errorMessage) {
                                    window.location.href = "https://beesmartdev.wpengine.com/payment";
                                    /*if user payment not found in database then its redirect payment page*/
                                }
                            });
                            var CurrentLatitude = $("#Latitude").val();
                            var CurrentLongitude = $("#Longitude").val();
                            var settings = {
                                "url": "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + CurrentLatitude + "," + CurrentLongitude + "&key=AIzaSyAhiLcdUvV7gHYh-GDsAIvfcQ4GWMO39rQ",
                                "method": "GET",
                                "timeout": 0,
                            };
                            $.ajax(settings).done(function(response) {
                                var CurrentFormatted_Address = response.results[0].formatted_address;
                                $("#Address").val(CurrentFormatted_Address);
								$("#Eventaddress").val(CurrentFormatted_Address);
                                $("#Jobaddress").val(CurrentFormatted_Address);
                            });
                        } else {
                            $("#Address").val(DefaultCityAddress);
							$("#Eventaddress").val(CurrentFormatted_Address);
                            $("#Jobaddress").val(CurrentFormatted_Address);
                        }
                    });
					 $('#buddyform-post').click(function(){
			 
							 $('body').addClass("active-submit");
							 $(".view-latest-post").css("display", "block");
								
						}); 
                    /*----------------------------------------------------------------------------------------------------------------------------------*/
					/*Add class select*/
					    $(function() {
							jQuery('.col-postcat').on('click', function(e) {
								  jQuery('body').toggleClass("active-popus");
							});	
							jQuery(document).on("click", function(e) {
								if ($(e.target).is(".col-postcat") === false) {
								  jQuery(".col-postcat").removeClass("active-popus");
								  //jQuery('body').removeClass("active-popus");
								}
							});
						});
						
						$(function(){
							  $('input[type="radio"]').click(function(){
								if(this.value == 'yes')
								{
								  jQuery('input#COVIDsafe-0').addClass("active");
								  jQuery('input#COVIDsafe-1').removeClass("active");
								}
							  });
							});
						$(function(){
							  $('input[type="radio"]').click(function(){
								if(this.value == 'no')
								{
								  jQuery('input#COVIDsafe-1').addClass("active");
								  jQuery('input#COVIDsafe-0').removeClass("active");
								}
							  });
							});
					/*End Add class select*/
	
                    /*1 keypress start*/
						$('#buddyforms_form_title').keyup(function() {
							if($.trim($('#buddyforms_form_title').val()).length) {
								//alert('11123');
								$('#post_title_cls').addClass('active-text');
							} else {
								$('#post_title_cls').removeClass('active-text');
							}
						}); 
                    /*2 keypress start*/
						$("textarea").keyup(function(){
                           $('#post_price').addClass('active-text');
                        });
 
                    /*3 keypress start*/
					    $(".gmw-cl-address-input").click(function() {
						     $( "#post_language" ).addClass( 'active-text' );
                        });
					/*4 keypress start*/
					    $("#featured_image").click(function() {
						     $( "#post_category_cls" ).addClass( 'active-text' );
                        });
					/*5 keypress start*/
					    $("#3567df4099").change(function() {
							if($.trim($('.select2-selection__choice').val()).length) {
								$('#post_tag_cls').addClass('active-text');
								
							} else {
								$('#post_tag_cls').removeClass('active-text');
							}
						});
					/*6 keypress start*/
						$("#1360c37280").change(function() {	  
							if($.trim($('#1360c37280').val()).length) {
								$('#feature_post_tag_cls').addClass('active-text');
								$('.select2-selection__arrow').addClass('new-active-text');
							} else {
								$('#feature_post_tag_cls').removeClass('active-text');
							}
						});
                    /*end*/

                     $("#buddyform-post").click(function(){
                         $('.my_map_cls').delay(300).fadeOut('slow');
                         $('.line_cls').delay(300).fadeOut('slow');
                        //$('.view-latest-post').css("display", "block");						 
                     });
					  
					 /*Price field */ 
					    $('.col-secondtype select').on('change', function() {
						//	alert( this.value );
							if(this.value == 'Personal') {
							   $(".price-currency-duble").css("display", "none");
							   }else {
								$(".price-currency-duble").css("display", "block");
							}
						});
						$('input[type="radio"]').click(function(){
							if(this.value == 'delivery_yes')
							{
								jQuery('input#Delivery-0').addClass("active");
								jQuery('input#Delivery-1').removeClass("active");
							}else if(this.value == 'delivery_no') {
								jQuery('input#Delivery-1').addClass("active");
								jQuery('input#Delivery-0').removeClass("active");	
							}else {
								jQuery('input#Delivery-1').removeClass("active");
								jQuery('input#Delivery-0').removeClass("active");
							}	
						});	
						$('input[type="radio"]').click(function(){
							if(this.value == 'new_yes')
							{
								jQuery('input#New-0').addClass("active");
								jQuery('input#New-1').removeClass("active");
							}else if(this.value == 'new_no') {
								jQuery('input#New-1').addClass("active");
								jQuery('input#New-0').removeClass("active");	
							}else {
								jQuery('input#New-1').removeClass("active");
								jQuery('input#New-0').removeClass("active");
							}	
						});
						$('input[type="radio"]').click(function(){
								if(this.value == 'Office Work')
								{
								  jQuery('input#RemoteOffice-3').addClass("active");
								  jQuery('input#RemoteOffice-2').removeClass("active");
								  jQuery('input#RemoteOffice-1').removeClass("active");
								  jQuery('input#RemoteOffice-0').removeClass("active");
								}else if(this.value == 'Partly Remote') {
 									jQuery('input#RemoteOffice-2').addClass("active");
									jQuery('input#RemoteOffice-3').removeClass("active");
								  jQuery('input#RemoteOffice-1').removeClass("active");
								  jQuery('input#RemoteOffice-0').removeClass("active");
								}else if(this.value == 'Quarantine Remote') {  
								  jQuery('input#RemoteOffice-1').addClass("active");
								  jQuery('input#RemoteOffice-2').removeClass("active");
								  jQuery('input#RemoteOffice-3').removeClass("active");
								  jQuery('input#RemoteOffice-0').removeClass("active");
								}else if(this.value == 'Full Remote') { 
								  jQuery('input#RemoteOffice-0').addClass("active");
								  jQuery('input#RemoteOffice-1').removeClass("active");
								  jQuery('input#RemoteOffice-2').removeClass("active");
								  jQuery('input#RemoteOffice-3').removeClass("active");
								}else {
									jQuery('input#RemoteOffice-3').removeClass("active");
									jQuery('input#RemoteOffice-2').removeClass("active");
									jQuery('input#RemoteOffice-1').removeClass("active");
									jQuery('input#RemoteOffice-0').removeClass("active");
								}
							  });	
					    $('.col-postcat select').on('change', function() {
						  //alert( this.value );
						  if(this.value == '63') {
								$(".col-xs-12.col-jobscat").css("display", "block");
								$(".price-range-slider").css("display", "block");
								$(".col-xs-12.col-price-with-currency.bf-start-row").css("display", "none");
								$(".col-xs-12.col-post-currency.bf-start-row").css("display", "none");
								$(".col-xs-12.col-eventcat").css("display", "none");
								$(".col-xs-12.col-newscat").css("display", "none");
								$(".col-xs-12.col-resumecat").css("display", "none");
								$(".col-xs-12.col-sellcat").css("display", "none");
								$(".col-xs-12.col-socialcats").css("display", "none");
								$('body').removeClass("active-popus");
						  }else if(this.value == '82') {
						        $(".col-xs-12.col-eventcat").css("display", "block");
								$(".col-xs-12.col-price-with-currency.bf-start-row").css("display", "block");
								$(".col-xs-12.col-post-currency.bf-start-row").css("display", "block");
						        $(".col-xs-12.col-jobscat").css("display", "none");
								$(".col-xs-12.col-newscat").css("display", "none");
								$(".col-xs-12.col-resumecat").css("display", "none");
								$(".col-xs-12.col-sellcat").css("display", "none");
								$(".col-xs-12.col-socialcats").css("display", "none");
								$('body').removeClass("active-popus");
						  }else if(this.value == '84') {
							    $(".col-xs-12.col-newscat").css("display", "block");
								$(".col-xs-12.col-price-with-currency.bf-start-row").css("display", "none");
								$(".col-xs-12.col-post-currency.bf-start-row").css("display", "none");
							    $(".col-xs-12.col-eventcat").css("display", "none");
						        $(".col-xs-12.col-jobscat").css("display", "none");
								$(".col-xs-12.col-resumecat").css("display", "none");
								$(".col-xs-12.col-sellcat").css("display", "none");
								$(".col-xs-12.col-socialcats").css("display", "none");
								$('body').removeClass("active-popus");
						  }else if(this.value == '65') {
							    $(".col-xs-12.col-jobscat").css("display", "block");
							    $(".price-range-slider").css("display", "block");
								$(".col-xs-12.col-price-with-currency.bf-start-row").css("display", "none");
								$(".col-xs-12.col-post-currency.bf-start-row").css("display", "none");
						        $(".col-xs-12.col-resumecat").css("display", "none");
						        $(".col-xs-12.col-newscat").css("display", "none");
							    $(".col-xs-12.col-eventcat").css("display", "none");
								$(".col-xs-12.col-sellcat").css("display", "none");
								$(".col-xs-12.col-socialcats").css("display", "none");
								$('body').removeClass("active-popus");
						  }else if(this.value == '64') {		
						        $(".col-xs-12.col-sellcat").css("display", "block");
								$(".col-xs-12.col-price-with-currency.bf-start-row").css("display", "block");
								$(".col-xs-12.col-post-currency.bf-start-row").css("display", "block");
						        $(".col-xs-12.col-resumecat").css("display", "none");
						        $(".col-xs-12.col-newscat").css("display", "none");
							    $(".col-xs-12.col-eventcat").css("display", "none");
						        $(".col-xs-12.col-jobscat").css("display", "none");
								$(".col-xs-12.col-socialcats").css("display", "none");
								$('body').removeClass("active-popus");
						  }else if(this.value == '83') {		
						        $(".col-xs-12.col-socialcats").css("display", "block");
								$(".col-xs-12.col-price-with-currency.bf-start-row").css("display", "none");
								$(".col-xs-12.col-post-currency.bf-start-row").css("display", "none");
						        $(".col-xs-12.col-sellcat").css("display", "none");
						        $(".col-xs-12.col-resumecat").css("display", "none");
						        $(".col-xs-12.col-newscat").css("display", "none");
							    $(".col-xs-12.col-eventcat").css("display", "none");
						        $(".col-xs-12.col-jobscat").css("display", "none");	
                                $('body').removeClass("active-popus");								
						  }else {
							    $(".col-xs-12.col-jobscat").css("display", "none");
								$(".price-range-slider").css("display", "none");
								$(".col-xs-12.col-price-with-currency.bf-start-row").css("display", "none");
								$(".col-xs-12.col-post-currency.bf-start-row").css("display", "none");
								$(".col-xs-12.col-eventcat").css("display", "none");
								$(".col-xs-12.col-newscat").css("display", "none");
								$(".col-xs-12.col-resumecat").css("display", "none");
								$(".col-xs-12.col-sellcat").css("display", "none");
								$(".col-xs-12.col-socialcats").css("display", "none");
								$(".col-xs-12.col-price-with-currency.bf-start-row").css("display", "none");
								$(".col-xs-12.col-post-currency.bf-start-row").css("display", "none");
								//$('body').removeClass("active-popus");
						  }	 
					    });
					 /* End */
					 
					 /* Start Select value add and remove class */
						 $(document).ready(function(){
						  $(".col-postcat").click(function(){
							  //alert('12');
							$("span .select2-dropdown").addClass("addpopscat");
						  });
						});
					/* End Select value add and remove class */
					
					/* Add submit button value start */
						$publish = "<span class='labelpublish'>Publish</span>"
							$('#buddyform-post').html( $publish );
							$('#PriceandCurrency').keyup(function() {
								//alert( this.value );
								$publishprice = "<span class='labelpublish'>Publish</span>" + "<span class='labelprice'>"+this.value+'</span>';
								$('#buddyform-post').html( $publishprice );
							});
					/* Add submit button value End */
					
					/* Add COVIDsafe button value start */
						$("input#COVIDsafe-0").after('<span class="radio-spn"></span>');
						$("input#COVIDsafe-1").after('<span class="radio-spn"></span>');
						$("input#RemoteOffice-3").after('<span class="radio-spn"></span>');
						$("input#RemoteOffice-2").after('<span class="radio-spn"></span>');
						$("input#RemoteOffice-1").after('<span class="radio-spn"></span>');
						$("input#RemoteOffice-0").after('<span class="radio-spn"></span>');
						$("input#Delivery-1").after('<span class="radio-spn"></span>');
						$("input#Delivery-0").after('<span class="radio-spn"></span>');
						$("input#New-0").after('<span class="radio-spn"></span>');
						$("input#New-1").after('<span class="radio-spn"></span>');
						$('.col-price-with-currency,.col-post-currency').wrapAll('<div class="price-currency-duble"></div>'); 
					/* Add COVIDsafe button value End */
					
					/* Add Descriptions text start */
					   $(".col-description").prepend("<span class='help-inline'>Descriptions</span>"); 
					   $(".col-featureimg").prepend("<span class='help-inline'>Creating a stunning project gallery</span>"); 
					   $feature = "<div class='drop-image'>Upload feature image <b>100</b></div>"
					   $('#featured_image span').html( $feature );
					   $video = "<div class='drop-video'>Video Url <b>100</b></div>"
					   $('#Video span').html( $video );
					   $('.price-range-slider').each(function() {
							$(this).insertAfter($(this).parent().find('.elem-Country'));
						});
						//$('.currency-range,.price-range-slider').wrapAll('<div class="price-currency-slider"></div>');
					   
					/* Add text End */
					
					
					$(".selection").trigger(function(){
					  $("#select2-1360c37280-result-o4p1-1").hide()
					}); 
					

                });

            jQuery(document).ready(function () {
                jQuery("#metabox_save-search-query :input").attr("disabled", true);
                jQuery('#metabox_save-search-query').prop('readonly', true);
                jQuery('#metabox_save-search-query').find('input, textarea, button, select').attr('disabled', 'disabled');
            });
				
                </script>
                <!-- end jquery end in wp -->
                <?php } else { ?>
                    <!-- user login conditions start in wp -->
                    <div class="userlogin"> <a class="logn_btn" href="<?php echo site_url();?>/login">Please Login.</a> </div>
                    <?php } ?>
                        <!-- login condition end in wp  -->
        </div>
				<style>
				/* post form 04.02.22 */
					input#buddyforms_form_title,input#Url,input.select2-search__field {
						border: none!important;
					}
					.gmw-cl-element.gmw-cl-address-wrapper {
						border-bottom: 0!important;
					}
					.page-template-postform .map_section .map_location_clss .buddy_main_cls #buddyforms_form_hero_buddyform-post #buddyforms_form_buddyform-post .bf-input #wp-buddyforms_form_content-editor-container {
						border: none!important;
						color: black!important;
						font-size: 18px!important;
						font-weight: 500;
						margin: 5px 0px;
						padding: 0!important;
					}
					/*photo*/
					.page-template-postform .map_section .map_location_clss .buddy_main_cls #buddyforms_form_hero_buddyform-post #buddyforms_form_buddyform-post #featured_image{
						min-height: 222px;
					}
					.page-template-postform .map_section .map_location_clss .buddy_main_cls #buddyforms_form_hero_buddyform-post #buddyforms_form_buddyform-post #featured_image, input#Url {
						background: #fff!important;
						border: 1px solid #d7d7d7!important;
						color: black!important;
						font-size: 18px!important;
						font-weight: 500;
						border-radius: 10px;
						box-shadow: 0px 1px 4px rgba(102, 102, 102, 0.25);
					}
				</style>
        <?php get_footer(); ?>
            <!-- footer file call in wp -->

