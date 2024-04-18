/**
 * Custom public jQuery.
 */
 jQuery( document ).ready( function( $ ) {
	'use strict';
	// Localized variables.
	var ajaxurl = Beesmart_Public_JS_Params.ajaxurl;
	var homeurl = Beesmart_Public_JS_Params.homeurl;
 	// Select the focus.
	$( document ).on( 'click', '.focus_step .single-focus', function() {
	//	alert('ss');
		var this_element1 = $(this);
		this_element1.find( 'img' ).toggleClass( 'disable' );
		var selected_types1 = [];
		$( '.focus_step .single-focus' ).each( function() {
			var this_option = $( this );
			var type = this_option.data( 'focus' );
			console.log(type);
			if ( ! this_option.find( 'img' ).hasClass( 'disable' ) ) {
				selected_types1.push( type ); // Get the focus value.
			}
		} );
		var selected_types_string = ( 0 < selected_types1.length ) ? selected_types1.join( ',' ) : '';
		$( '#selected-focus' ).val( selected_types_string );
	} );

	// Select the type1.
	$( document ).on( 'click', '.type_step .single-type1', function() {
		var this_element = $( this );
		this_element.find( 'img' ).toggleClass( 'disable' );
		$( '#selected-type1' ).val('');
		var selected_types = [];

		// Iterate through all the selected types and create a string.
		$( '.single_step.type_step .single-type1' ).each( function() {
			var this_atag = $( this );
			var type = this_atag.data( 'val' );

			// Check if the element is active.
			if ( ! this_atag.find( 'img' ).hasClass( 'disable' ) ) {
				selected_types.push( type ); // Get the focus value.
			}
		} );

		// Put in the values.
		var selected_types_string = ( 0 < selected_types.length ) ? selected_types.join( ',' ) : '';
		$( '#selected-type1' ).val( selected_types_string );
	} );

	// Select the type2.
	$( document ).on( 'click', '.find_step .single-type2', function() {
		var this_element = $( this );
		this_element.find( 'img' ).toggleClass( 'disable' );
		$( '#selected-type2' ).val('');
         
		// Check if the element is active.
		if ( ! this_element.find( 'img' ).hasClass( 'disable' ) ) {
			// Get the focus value.
			$( '#selected-type2' ).val( this_element.data( 'val' ) );
		}
		if(this_element.data( 'val' ) ==='Be Found')
		{
			$( '.main_checkboxes' ).hide();
			$( '.main_checkboxes.be_found' ).show();
		}
		if(this_element.data( 'val' ) ==='Find Someone')
		{
			$( '.main_checkboxes' ).hide();
			$( '.main_checkboxes.find_someone' ).show();
		}
		if(this_element.data( 'val' ) ==='Sell')
		{
			$( '.main_checkboxes' ).hide();
			$( '.main_checkboxes.sell_buy' ).show();
		}
		if(this_element.data( 'val' ) ==='Event')
		{
			$( '.main_checkboxes' ).hide();
			$( '.main_checkboxes.events' ).show();
		}
		if(this_element.data( 'val' ) ==='News')
		{
			$( '.main_checkboxes' ).hide();
			$( '.main_checkboxes.news' ).show();
		}
	} );

	// Select the sorting option.
	$( document ).on( 'click', '.sorting_step .single-sorting-item', function() {
		var this_element = $( this );
		// Iterate through the sorting options.
		$( '.sorting_step .single-sorting-item' ).each( function() {
			var this_sorting_option = $( this );
			this_sorting_option.find( 'img' ).addClass( 'disable' );
		} );

		this_element.find( 'img' ).removeClass( 'disable' );
		$( '#selected-sorting_option' ).val( this_element.find( 'span' ).data( 'sort' ) );
	} );
	$( document ).on( 'click', '.select_sticker.save_icons_block .icon_item img', function() {
		const imge_url = $(this).attr('src');
		  var parts = imge_url.split("/images/"),
    		 last_part = parts[parts.length-1];
		$('#feed_have').val(last_part);
		console.log(last_part);
	});
    $( document ).on( 'click', '.type2_tool_check a', function() {
		var discover = new Array();
            $("input[name='type2_check']:checked").each(function() {
                discover.push($(this).val());
            });
			$( '#selected-type2-discover' ).val(discover); 
			var audience  = $("input[name='audience']:checked").val();
			var theme  = $("#theme").val();
			var yaywall  = $("#yaywall").val();
			$('#selected-type2-location' ).val(audience); 
			$('#selected-type2-info-theme' ).val(theme); 
			$('#selected-type2-info-paywall' ).val(yaywall); 
			$('.modal.custom_trsparent_modal.find-modal').removeClass('show');
			$('.modal.custom_trsparent_modal.find-modal').hide();
			$('.modal.custom_trsparent_modal.find-modal').removeAttr('aria-modal');
	});
	$( document ).on( 'change', '.info_country', function() {
		var country=$('.info_country .filter-option-inner-inner').text();
		//var country = $(this).val();
		$('#info-country' ).val(country); 
	});
	$( document ).on( 'change', '.info_language', function() {
		var language=$('.info_language .filter-option-inner-inner').text();
		$('#info-language' ).val(language); 
	});
	// Save filter values.
	$( document ).on( 'click', '.beesmart-save-filter-values', function() {
		// Send the AJAX to save the selected focus in cookie, so that can be used while applying filters.
		$.ajax( {
			//dataType: 'JSON',
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'save_filter_options',
				focus: $( '#selected-focus').val(),
				type1: $( '#selected-type1').val(),
				type2: $( '#selected-type2').val(),
				discover: $('#selected-type2-discover').val(),
				location: $('#selected-type2-location').val(),
				theme: $( '#selected-type2-info-theme').val(),
				yaywall: $( '#selected-type2-info-paywall').val(),
				language: $( '#info-language' ).val(),
				country: $( '#info-country' ).val(),
			},
			beforeSend: function(){
				 $(".loader").show();
			 },
			success: function (response) {
				$('.modal-backdrop.fade.show').removeClass('show modal-backdrop');
				$("div#search_filters").hide();
				$('body.home.page-template.page-template-homepage.page-template-homepage-php').removeClass('modal-open');
				$('#filtered_post').html('');
				$('#filtered_post').html(response);
			},
			 error: function() {
				//alert('Error occured');
			},
			complete:function(response){
				//alert('sadsdasd');
				$(".loader").hide();
			}
		});
	} );

	// Save filter sorting values.
	$( document ).on( 'click', '.beesmart-save-filter-sorting-values', function() {
		// Send the AJAX to save the selected focus in cookie, so that can be used while applying filters.
			$.ajax( {
			//dataType: 'JSON',
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'save_filter_sorting_options',
				sortby: $( '#selected-sorting_option' ).val(),
			},
			beforeSend: function(){
				 $(".loader").show();
			 },
			success: function (response) {
				//alert('ssss');
				$('body.home.page-template.page-template-homepage.page-template-homepage-php').removeClass('modal-open');
				//console.log(response);
				$('#filtered_post').html('');
				$('#filtered_post').html(response);
			},
			 error: function() {
				//alert('Error occured');
			},
			complete:function(response){
				//alert('sadsdasd');
				$(".loader").hide();
			}
		} );
	} );

	$( document ).on( 'click', '.filter_btn', function() {
		$( '.single_step' ).removeClass( 'active' );
		$( this ).closest( '.single_step' ).toggleClass( 'active' );
 	} );
	$( document ).on( 'click', '.hive_item', function() {
	//	$( this ).closest( '.hive_item' ).toggleClass( 'active' );
	} );
	 	// Save filter sorting values.
	toastr.options = {
	  closeButton: true,
	  newestOnTop: false,
	  progressBar: false,
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
	$( document ).on( 'click', '.beesmart-save-fiter-options-in-db', function() {
		var feed_name = $('#name-feed').val();
		var feed_have = $('#feed_have').val();
		var selected_focus=$("input#selected-focus").val();
		var selectedtype1=$("#selected-type1").val();
		var type2 = $('#selected-type2').val();
		var discover=$('#selected-type2-discover').val();
		var	location=$('#selected-type2-location').val();
		var	theme=$('#selected-type2-info-theme').val();
		var	yaywall= $('#selected-type2-info-paywall').val();
		var	language= $('#info-language').val();
		var	country= $('#info-country').val();
		var sortby=$('#selected-sorting_option').val();
		var visibility=$("input#visibility_type").val();
		var explicit_content=$("#explicit_content").val();
		var range=$("input#range").val();
		var hive_manager=$('#hive_type_list').val();
		var logged_in_user_id=$("#logged_in_user_id").val();
		if(feed_name==""){
		toastr["warning"]('Please enter feed name');
		}else if(feed_have==""){
		toastr["warning"]('Please choose feed image');
		}
		else{
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'save_filter_user_feed',
				feedname: feed_name,
				feed_have:feed_have,
				beesmart_user_selected_focus:selected_focus,
				beesmart_user_selected_type1:selectedtype1,
				beesmart_user_selected_type2:type2,
				beesmart_user_selected_discover:discover,
				beesmart_user_selected_location:location,
				beesmart_user_selected_theme:theme,
				beesmart_user_selected_yaywall:yaywall,
				beesmart_user_selected_language:language,
				beesmart_user_selected_country:country,
				beesmart_user_selected_sort_option:sortby,
				beesmart_user_selected_visibility:visibility,
				beesmart_user_explicit_content:explicit_content,
				beesmart_user_explicit_range:range,
				beesmart_user_hive_manager:hive_manager,
				beesmart_user_logged_in_user_id:logged_in_user_id,
			},
					 beforeSend: function(){
						 $(".loader").show();
					 },
			success: function ( response ) {
				 response = jQuery.parseJSON(response);
				if(response.success=='true'){
				var image = $('div#saves_query .item.icon_item.active img').attr('src');
					let feedTemp = `
						<div class="sidebar_custom_submenu">
							<div class="show_feed_btn">
								<a href='/feeds/?feed_id=/${response.feed_id}'>
									<img width='30' src='${window.location.origin}${image}'>
									<span class='highlight_custom_menu'>${feed_name}</span>
								</a>
							</div>
						</div>`	
					$('ul.dashboard_menu').after(feedTemp);
				$('.modal-backdrop.fade.show').removeClass('show modal-backdrop');
				$(".feed-create-close-btn").click();
				}
			},complete:function(data){

				$(".loader").hide();
			}
		});
 }
	} );
} );

$('#search_filters .single_step.find_step.text-center').click(function(){
	$('.single_step.type_step.text-center .single-type1').addClass('disable');
	$('#selected-type1').val('');
})
$( document ).on( 'click', '#hive_modal .hive_item', function() {
	//	alert('ss');
		var this_element1 = $(this);
		this_element1.toggleClass( 'active' );
		var selected_types2 = [];
		$( '#hive_modal .hive_item' ).each( function() {
			var this_option2 = $(this);
			var type = this_option2.data('id');
			console.log(type);
			if (this_option2.hasClass('active')){
			//	alert('ssss');
				selected_types2.push( type ); // Get the focus value.
			}
		} );
		var selected_types_string2 = ( 0 < selected_types2.length ) ? selected_types2.join( ',' ) : '';
		$( '#hive_type_list' ).val( selected_types_string2 );
	} );

$(document).ready(function(){
	$("#hive_popup_modal").click(function(){
		$("div#hive_modal").hide();
	})
})
