<?php

/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Beesmart
 * @since Beesmart
 */

if (is_user_logged_in()) {
?>
	<!-- bottom navigation for mini-chat and bug report -->
	<div class="botton-navigation">
		<button class="chat-button">
			<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Chat3.png" alt="chat">
		</button>
		<button class="custom-report-button">
			<img src="<?php echo imgPATH; ?>Bug-report.png" alt="chat">
		</button>
	</div>
<?php
}
?>

<!-- <div class="loader" style="display:none;z-index:9999;">
</div> -->
<div class="" style='display:none;'>
	<button onclick="getLocation()" id="get_lat">Try It</button>
	<p id="demo"></p>
	<p id="lat-span"></p>
	<p id="lon-span"></p>
</div>
<div class="loader" style="display:none;z-index:9999;">
	<div class="bubbles" id="b1">&nbsp</div>
	<div class="bubbles" id="b2">&nbsp</div>
	<div class="bubbles" id="b3">&nbsp</div>
	<div class="bubbles" id="b4">&nbsp</div>
	<div class="bubbles" id="b5">&nbsp</div>
</div>
<?php wp_footer(); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://jeesite.gitee.io/front/jquery-select2/4.0/index_files/select2.full.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/niceCountryInput.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/styles/niceCountryInput.css">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAoARanHZTzgsyoTBVpz8C5sDdHLI5HkVI"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	$('.content_item.item').click(function(){
		$('.content_item.item').addClass('disable');
		$(this).removeClass('disable');
	})
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2();
	});
	$('body').on('click', '.cancel_successfully', function() {
		var user_id = $(this).attr('data-userid');
		$("#confirmation" + user_id).hide();
		$('.user_follow_' + user_id).hide();
	})
	$(document).ready(function() {
		$('body').on('change', 'select.js-example-basic-single.select2-hidden-accessible', function(e) {
			e.preventDefault();
			var resulted_value = $(this).val();
			$("button.btn.btn-info.btn-danger").hide();
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-ajax.php",
				data: {
					action: "after_search_data",
					'selected_id': resulted_value
				},
				beforeSend: function() {
					$(".loader").show();
				},
				success: function(response) {
					response = jQuery.parseJSON(response);
					if (response.success == 'true') {
						jQuery('.manager_list').html(response.data);
					} else {
						alert(response.data);
					}
					alert('sucess');
				},
				complete: function(data) {
					$(".loader").hide();
				}
			});
		})
	})
	/*$(function() {
		$('body').on('change', "select.postname", function(e) {
			var new_value = {};
			var cat_id = $('select.postname').find('option:selected');
			var user_id = cat_id.data('u-id');
			var category_id = $(e.target).val();
			var new_array = category_id.toString();
			return false;
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-ajax.php",
				data: {
					action: "save_follow_user_data",
					'category_id': new_array,
					'user_id': user_id
				},
				beforeSend: function() {
					$(".loader").show();
				},
				success: function(response) {
					response = jQuery.parseJSON(response);
					if (response.success == 'true') {
						option()
						$(document).ready(function onDocumentReady() {
							toastr.success(response.message);
						});
					} else {
						option()
						$(document).ready(function onDocumentReady() {
							toastr.success(response.message);
						});
					}
				},
				complete: function(data) {
					$(".loader").hide();
				}
			});
		})
	});*/
	$(document).ready(function() {
		$(".pec_item").click(function() {
			$(this).closest(".pec_item").toggleClass("active");
		});
	});
	$(".category_list").on("keyup change", function(e) {
		var key = e.which;
		if (key == 13) // the enter key code
		{
			var timer;
			var resulted_value = $(this).val();
			clearTimeout(timer); //clear any running timeout on key up
			timer = setTimeout(function() {
				$.ajax({
					type: "POST",
					url: "/wp-admin/admin-ajax.php",
					data: {
						action: "category_created_by_logged_in_user",
						'category_value': resulted_value
					},
					beforeSend: function() {
						$(".loader").show();
					},
					success: function(response) {
						response = jQuery.parseJSON(response);
						if (response.success == 'true') {
							option()

							$(document).ready(function onDocumentReady() {
								toastr.success(response.message);
							});
							location.reload();
						} else {
							option()

							$(document).ready(function onDocumentReady() {
								toastr.success(response.message);
							});
						}
					},
					complete: function(data) {
						$(".loader").hide();
					}
				});
			}, 2000);
		}
	})

	$(document).ready(function() {
		$('.page-id-5797 .woocommerce').addClass('billinginfo');
		$(".postname option").each(function() {
			$(this).siblings('[value="' + this.value + '"]').remove();
		});
	})
	$('body').on('click', '.random_category', function() {
		$.ajax({
			type: "POST",
			url: "/wp-admin/admin-ajax.php",
			data: {
				action: "random_category_change"
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function(response) {
				$('.save_icons_block').html('');
				$('.save_icons_block').html(response);

			},
			complete: function(data) {
				$(".loader").hide();
			}
		});
	})


	$("a.dropdown-item.user-remove").click(function() {
		var user_id = $(this).attr('data-userid');
		$.ajax({
			type: "POST",
			url: "/wp-admin/admin-ajax.php",
			data: {
				action: "remove_user_from_friend_list",
				'user_id': user_id
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function(response) {
				response = jQuery.parseJSON(response);
				if (response.success == 'true') {
					option()

					$(document).ready(function onDocumentReady() {
						toastr.success(response.message);
					});

					location.reload();
				}
			},
			complete: function(data) {
				$(".loader").hide();
			}
		});
	})

	$(document).ready(function() {
		setTimeout(function() {
			var new_html = $(".um-profile-body.main.main-default").html();
			$('[id]').each(function() {
				$('[id="' + this.id + '"]:gt(0)').remove();
			});
		}, 500);

	});

	function check_user_can_create_post_or_not() {
		$.ajax({
			type: "POST",
			url: "/wp-admin/admin-ajax.php",
			data: {
				action: 'check_user_plan'
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function(response) {
				response = jQuery.parseJSON(response);
				if (response.success == 'true') {
					option()
					$(document).ready(function onDocumentReady() {
						toastr.success(response.message);
					});
					$("#create-post").click();
				} else {
					option()

					$(document).ready(function onDocumentReady() {
						toastr.success(response.message);
					});
					location.reload();
				}
			},
			complete: function(data) {
				$(".loader").hide();
			}
		})
	}
	$('body').on('click', '.update_category', function() {
		var category_id = $(this).attr('data-cat');
		var imge_url = $('#edit_to_category_' + category_id + ' .item.icon_item.active img').attr('src');

		if (imge_url == "" || imge_url == "undefined" || imge_url == undefined) {
			option()

			$(document).ready(function onDocumentReady() {
				toastr.success('Please choose your updated icon');
			});
		} else {
			parts = imge_url.split("/images/"),
				last_part = parts[parts.length - 1];
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-ajax.php",
				data: {
					action: "update_category_icons",
					'category_id': category_id,
					'category_icons': last_part
				},
				beforeSend: function() {
					$(".loader").show();
				},
				success: function(response) {
					response = jQuery.parseJSON(response);
					if (response.success == 'true') {
						option()

						$(document).ready(function onDocumentReady() {
							toastr.success(response.message);
						});
						$('.edit_to_category').hide();
						$('#image_' + category_id + ' img').attr('src', imge_url);
					}
				},
				complete: function(data) {
					$(".loader").hide();
				}
			});
		}
	})

	$("body").on('click', '.verify_percentage', function(event) {
		event.preventDefault();
		var percentage_val = $(".percentage_coins").val();
		var post_id = $(this).attr('data-post');
		var value = $(".honey_pot_detail ul li.select_item input").val();
		if (value == "" && percentage_val == "") {
			toastr["warning"]('Please choose at least one option');
		} else if (value == undefined && percentage_val != undefined) {
			points_reduction(percentage_val);
		} else if (value != undefined && percentage_val == undefined) {
			points_reduction(value);
		} else if (value != "" && percentage_val == "") {
			points_reduction(value);
		} else if (percentage_val != "" && value == "") {
			points_reduction(percentage_val);
		} else if (percentage_val != "" && value != "") {
			percentage_val = value;
			points_reduction(percentage_val);
		}

		function points_reduction(percentage_val) {
			if (percentage_val == "") {
				toastr["warning"]('Please choose at least one option');
			} else if (percentage_val == undefined) {
				toastr["warning"]('Please choose at least one option');
			} else if (percentage_val > 99) {
				toastr["warning"]('Percentage value should not be greater than 99');
			} else {
				$.ajax({
					type: "POST",
					url: "/wp-admin/admin-ajax.php",
					data: {
						action: "add_to_points_functionality",
						'honey_points': percentage_val,
						'post_id': post_id
					},
					beforeSend: function() {
						$(".loader").show();
					},
					success: function(response) {
						response = jQuery.parseJSON(response);
						if (response.success == 'true') {
							toastr["success"](response.message);
							$('.total_honey_percentage').html(response.total_honey);
							$('button.love.click_animation.p-0').addClass('liked');
							$('.one_percentage').html(response.one_percentage);
							$('#LoveCount_'+post_id).html(response.after_final_honey);
							$('#LoveCount1_' + post_id).html(response.after_final_honey);
							$('.tenth_percentage').html(response.tenth_percentage);
							$(".select_item_background").removeClass('select_item');
							$(".percentage_coins").val();
						} else {
							toastr["success"](response.message);
						}
					},
					complete: function(data) {
						$(".loader").hide();
					}
				});
			}

		}
	})
	$("body").on('click', '.select_item_background', function() {
		$(".select_item_background").removeClass('select_item');
		$(this).addClass('select_item');
	})
	$('.select_rating .score').click(function() {
		var user_rating = $(this).attr('id');
		var new_rating = user_rating.split('-');
		$('span.um-reviews-rate input').val(new_rating[1]);
	})
	$('div#review_button_custom a img').click(function(event) {
		event.preventDefault();
		$('input.um-button').click();
	})
	$('a[data-target="#hive_manager"]').click(function() {
		$("div#profile_target").hide();
		$('div#share .close').click();
		$('div#honey .close').click();
	})
	$('div[data-target="#honey"]').click(function() {
		$('div#share .close').click();
		$('div#hive_manager .close').click();
	})
	$('div[data-target="#share"]').click(function() {
		$('div#honey .close').click();
		$('div#hive_manager .close').click();
	})
	$('body').on('click', '.closebuttonpopup.confirmation_close', function() {
		var user_id = $(this).attr('data-userid');
		$("#confirmation" + user_id).hide();
	})

	$('div#review_button_custom a img').click(function(event) {
		event.preventDefault();
		$('input.um-button').click();
	})
	$('button#save_feed_more').click(function() {
		var previous_value = $("#pagecount").val();
		var new_value = parseInt(previous_value) + 1;
		$('#pagecount').val(new_value);
		var neww_value = $("#pagecount").val();

		$.ajax({
			type: "POST",
			url: "/wp-admin/admin-ajax.php",
			data: {
				action: "load_more_category_in_savefeed",
				'page': neww_value
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function(response) {
				response = jQuery.parseJSON(response);
				if (response.success == 'true') {
					$('div#saves_query .select_sticker.save_icons_block').prepend(response.message);
				} else {

					toastr["warning"](response.message);
					$('button#save_feed_more').hide();
				}
			},
			complete: function(data) {
				$(".loader").hide();
			}
		});
	})
	$('.edit_check_more').click(function() {
		var previous_value = $(".increasebyone").val();
		var new_value = parseInt(previous_value) + 1;
		$('.increasebyone').val(new_value);
		var neww_value = $(".increasebyone").val();

		$.ajax({
			type: "POST",
			url: "/wp-admin/admin-ajax.php",
			data: {
				action: "load_more_category_in_savefeed",
				'page': neww_value
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function(response) {
				response = jQuery.parseJSON(response);
				if (response.success == 'true') {
					$('.abcc.search_filter.edit_category_modal.show .select_sticker.save_icons_block').prepend(response.message);
				} else {

					toastr["warning"](response.message);
					$('.modal.fade.custom_trsparent_modal.abcc.search_filter.edit_category_modal.show').hide();
				}
			},
			complete: function(data) {
				$(".loader").hide();
			}
		});
	})

	jQuery('#more_load_post').click(function() {
		var previous_value = $(this).val();
		var new_value = parseInt(previous_value) + 1;
		$(this).val(new_value);
		var neww_value = $(this).val();
		$.ajax({
			type: "POST",
			url: "/wp-admin/admin-ajax.php",
			data: {
				action: "find_more_post",
				'page': neww_value
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function(response) {
				if (response == '<div class="no_more_post">Sorry, no more posts found.</div>') {
					$("button#more_load_post").hide();
				} else {

					jQuery('.posts-list-wrapper').append(response);
				}
			},
			complete: function(data) {
				$(".loader").hide();
			}
		});
	})

	$('a.beesmart-save-filter-values').click(function() {
		$('.modal-backdrop.fade.show').removeClass('show modal-backdrop');
		$("div#search_filters").hide();
	})
	$('a.beesmart-save-filter-sorting-values').click(function() {
		$('.modal-backdrop.fade.show').removeClass('show modal-backdrop');
		$("div#search_sorts_by").hide();
	})
	$("select.edit_visibility").change(function() {
		var exact_value = $(this).val();
		$('.edit_selected_value').val(exact_value);
	});
	$('.abcc.search_filter.edit_category_modal .item.icon_item.active img').click(function() {
		var feed_src = $(this).attr('src');
		var feed_id = $(this).attr('data-id');
		var parts = feed_src.split("/images/"),
			last_part = parts[parts.length - 1];
		$('#imageexist_' + feed_id).val(last_part);
	})
	$('button.confirm_feed_update').click(function() {
		var feed_id = $(this).attr('data-id');
		var edit_feed_name = $('.edit_feed_listing_' + feed_id).val();
		var edit_feed_stickers = $("#edit_feed" + feed_id + " .item.icon_item.active").attr('data-id');
		var edit_feed_image = $('#imageexist_' + feed_id).val();
		var newimage_link = "<?php echo site_url('/images/') ?>" + edit_feed_image;
		var visibility = $("#visibility_btn_" + feed_id).val();
		var explicit_content = $("#warning_btn_" + feed_id).val();
		if (edit_feed_name == "") {
			toastr["warning"]('Please enter feed name');
		} else if (edit_feed_stickers == "") {
			toastr["warning"]('Please choose stickers');
		} else {
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-ajax.php",
				data: {
					action: "edit_feed_listing",
					'edit_feed_name': edit_feed_name,
					'edit_feed_stickers': edit_feed_image,
					'edit_feed_function': feed_id,
					'edit_visibility': visibility,
					'explicit_content': explicit_content
				},
				beforeSend: function() {
					$(".loader").show();
				},
				success: function(response) {
					response = jQuery.parseJSON(response);
					if (response.success == 'true') {
						$('#edit_feed' + feed_id).hide();
						$('.modal-backdrop.fade.show').hide();
						$("#feed_" + feed_id + ' .saved_icon img').attr('src', newimage_link);
						$("#feed_" + feed_id + ' .saved_icon .highlight_custom_menu').text(edit_feed_name);
					} else {

						toastr["warning"](response.message);
						$('.modal.fade.custom_trsparent_modal.abcc.search_filter.edit_category_modal.show').hide();
					}
				},
				complete: function(data) {
					$(".loader").hide();
				}
			});
		}

	})
	$(".delete_feed").click(function() {
		var feed_id = $(this).attr('data-userid');
		$.ajax({
			type: "POST",
			url: "/wp-admin/admin-ajax.php",
			data: {
				action: "delete_feed_listing",
				'delete_feed_id': feed_id
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function(response) {
				response = jQuery.parseJSON(response);
				if (response.success == 'true') {
					$('li#feed_' + feed_id).hide();
					$('div#deletefeed' + feed_id).hide();
				} else {
					
				}
			},
			complete: function(data) {
				$(".loader").hide();
			}
		});
	})

	$('body').on('click', '.reload_btn', function() {
		$.ajax({
			type: "POST",
			url: "/wp-admin/admin-ajax.php",
			data: {
				action: "random_category_change"
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function(response) {
				$('.save_icons_block').html('');
				$('.save_icons_block').html(response);
			},
			complete: function(data) {
				$(".loader").hide();
			}
		});
	})
	$('body').on('click', '.single_step.info_step.text-center.mb-5.active a.item.item3', function() {
		$(this).toggleClass('explicit_content');
		if ($("div#search_filters .single_step.info_step.text-center.mb-5.active a.item.item3.explicit_content")[0]) {
			$("#explicit_content").val('0');
			$('.single_step.info_step.text-center.mb-5 a.item.item3 img').attr('src', '/wp-content/uploads/2022/05/Safe-1.png');
		} else {
			$('.single_step.info_step.text-center.mb-5 a.item.item3 img').attr('src', '/wp-content/uploads/2022/01/Warning.png');
			$("#explicit_content").val('1');
		}
	})
	$('body').on('click', '.edit_feed_modal .edit_feeds_btns a.visibility_btn', function() {
		var data_id = $(this).attr('data-id');
		$(this).toggleClass('disable');
		if ($("#edit_feed" + data_id + " .edit_feeds_btns a.visibility_btn.disable")[0]) {
			$("#visibility_btn_" + data_id).val(0);
		} else {
			$("#visibility_btn_" + data_id).val(1);
		}

	})
	$('body').on('click', '#saves_query a.visibility_btn_add', function() {
		$(this).toggleClass('disable');
		if ($("#saves_query a.visibility_btn_add.disable")[0]) {
			$("#visibility_type").val(0);
		} else {
			$("#visibility_type").val(1);
		}

	})
	$('body').on('click', '.edit_feed_modal .edit_feeds_btns a.warning_btn', function() {
		var data_id = $(this).attr('data-id');
		$(this).toggleClass('disable');
		if ($("#edit_feed" + data_id + " .edit_feeds_btns a.warning_btn.disable")[0]) {
			$("#warning_btn_" + data_id).val(2);
		} else {
			$("#warning_btn_" + data_id).val(1);
		}
	})

	$('.saved_feed_items.select_feedlist ul li').click(function() {
		var feed_id = $(this).attr('data-id');
		var profile_id = $('#um_profile_id').val();
		$('#feed_' + feed_id + ' .select_savefeed').toggleClass('disable');
		if ($('#feed_' + feed_id + ' .select_savefeed.disable')[0]) {
			console.log('This functionality is undertaken');
		} else {
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-ajax.php",
				data: {
					action: "save_other_user_feed",
					'feed_id': feed_id,
					'profile_id': profile_id
				},
				beforeSend: function() {
					$(".loader").show();
				},
				success: function(response) {
					response = jQuery.parseJSON(response);
					if (response.success == 'true') {
						toastr["warning"](response.message);
					} else {
						toastr["warning"](response.message);
					}
				},
				complete: function(data) {
					$(".loader").hide();
				}
			});
		}
	})

	$("body").on("input.form-control.percentage_coins", "input", function() {
		var post_id = $(this).attr('data-id');
		if ($(this).val() == "") {
			$("#postt_" + post_id).text('0');
		} else {
			var input_value = $(this).val();
			var exact_honey_amount = $('.exact_honey_amount').val();
			var total = (exact_honey_amount / 100) * input_value;
			$("#postt_" + post_id).text(parseInt(total));
		}

	});

	function onChangeCallback(ctr) {
		console.log("The country was changed: " + ctr);
		$('input#info-country').val('');
		$('input#info-country').val(ctr);
	}

	$(document).ready(function() {
		$(".niceCountryInputSelector").each(function(i, e) {
			new NiceCountryInput(e).init();
		});
		$('.info_country span.niceCountryInputMenuDefaultText img.niceCountryInputMenuCountryFlag').hide();
		$(".info_country span.niceCountryInputMenuDefaultText span").text('All');
	});
	$('#locations_id img').click(function() {

		$('#search_filters a.item.item7').addClass('disable');
		$('#locations_id').removeClass('disable');
		$('.location_modal_popup').toggleClass('active');
		$(this).removeClass('disable');
		$('input#info-country').val('');
		var new_location = $('#locations_id').val();
		$('input#info-country').val(new_location);
	})



	var searchInput = 'location';

	$(document).ready(function() {
		var autocomplete;
		autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
			types: ['geocode'],
		});


		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			var near_place = autocomplete.getPlace();
			$('input#info-country').val(near_place.formatted_address);
			document.getElementById('lat-span').innerHTML = near_place.geometry.location.lat();
			document.getElementById('lon-span').innerHTML = near_place.geometry.location.lng();
		});
	});
	$('div#search_filters a.item.item7').click(function() {
		if ($('div#search_filters a.item.item7.disable')[0]) {
			$(this).toggleClass('disable');
			$('a#locations_id').addClass('disable');
			$('input#info-country').val('');
		} else {
		}
	})
	$('body').on('click', '.add_hive_link.save_hive_category', function() {
		$('.add_hive_link.save_hive_category img').removeClass('disable');
		var resulted_data = $("#hive_submit").serialize();
		$.ajax({
			type: 'POST',
			url: "/wp-admin/admin-ajax.php",
			data: resulted_data + '&action=save_hive_data',
			beforeSend: function() {
				$(".loader").show();
			},
			success: function(response) {
				response = jQuery.parseJSON(response);
				if (response.success == 'true') {
					toastr["warning"](response.message);
				} else {
					toastr["warning"](response.message);
				}
			},
			complete: function(data) {
				$(".loader").hide();
			}
		});
	});
</script>
<script>


	function pop(e) {
		let amount = 30;
		switch (e.target.dataset.type) {
			case 'shadow':
				amount = 30;
				break;
			case 'addhive':
				amount = 30;
				break;
		}
		// Quick check if user clicked the button using a keyboard
		if (e.clientX === 0 && e.clientY === 0) {
			const bbox = e.target.getBoundingClientRect();
			const x = bbox.left + bbox.width / 2;
			const y = bbox.top + bbox.height / 2;
			for (let i = 0; i < 30; i++) {
				// We call the function createParticle 30 times
				// We pass the coordinates of the button for x & y values
				createParticle(x, y, e.target.dataset.type);
			}
		} else {
			for (let i = 0; i < amount; i++) {
				createParticle(e.clientX, e.clientY + window.scrollY, e.target.dataset.type);
			}
		}
	}

	function createParticle(x, y, type) {
		const particle = document.createElement('particle');
		document.body.appendChild(particle);
		let width = Math.floor(Math.random() * 30 + 8);
		let height = width;
		let destinationX = (Math.random() - 0.5) * 150;
		let destinationY = (Math.random() - 0.5) * 150
		let rotation = Math.random() * 0;
		let delay = Math.random() * 20;

		switch (type) {
			case 'shadow':
				var color = `hsl(${Math.random() * 1000}, 70%, 70%)`;
				particle.style.boxShadow = `10 10 ${Math.floor(Math.random() * 30 + 10)}px ${color}`;
				particle.style.background = color;
				particle.style.borderRadius = '100%';
				width = height = Math.random() * 5 + 4;
				break;
			case 'addhive':
				var color = `hsl(${Math.random() * 2 + 30 + 22}, 60%, 60%)`;
				particle.style.boxShadow = `10 10 ${Math.floor(Math.random() * 30 + 10)}px ${color}`;
				particle.style.background = color;
				particle.style.borderRadius = '100%';
				width = height = Math.random() * 5 + 4;
				break;
		}


		particle.style.width = `${width}px`;
		particle.style.height = `${height}px`;
		const animation = particle.animate([{
				transform: `translate(-25%, -25%) translate(${x}px, ${y}px) rotate(0deg)`,
				opacity: 1
			},
			{
				transform: `translate(-50%, -50%) translate(${x + destinationX}px, ${y + destinationY}px) rotate(${rotation}deg)`,
				opacity: 0
			}
		], {
			duration: Math.random() * 200 + 800,
			easing: 'cubic-bezier(0, 1, 1, 1)',
			delay: delay
		});
		animation.onfinish = removeParticle;
	}

	function removeParticle(e) {
		e.srcElement.effect.target.remove();
	}




	/**/
	function pop1(e) {
		let amount = 1;

		// Quick check if user clicked the button using a keyboard
		if (e.clientX === 0 && e.clientY === 0) {
			const bbox = e.target.getBoundingClientRect();
			const x = bbox.left + bbox.width / 2;
			const y = bbox.top + bbox.height / 2;
			for (let i = 0; i < 30; i++) {
				// We call the function createParticle 30 times
				// We pass the coordinates of the button for x & y values
				createParticle1(x, y, e.target.dataset.type);
			}
		} else {
			for (let i = 0; i < amount; i++) {
				createParticle1(e.clientX, e.clientY + window.scrollY, e.target.dataset.type);
			}
		}
	}
	function createParticle1(x, y, type) {
		const particle = document.createElement('particle');
		document.body.appendChild(particle);
		let width = 30;
		let height = width;
		let destinationX = 0;
		let destinationY = 80
		let rotation = Math.random() * 00;
		let delay = Math.random() * 100;

		switch (type) {
			case 'drophoney':
				particle.style.backgroundImage = 'url(/wp-content/uploads/2022/01/Honey64A.png)';
				break;
		}

		particle.style.width = `${width}px`;
		particle.style.height = `${height}px`;
		const animation = particle.animate([{
				transform: `translate(-25%, -25%) translate(${x}px, ${y}px) rotate(0deg)`,
				opacity: 1
			},
			{
				transform: `translate(-50%, -50%) translate(${x + destinationX}px, ${y + destinationY}px) rotate(${rotation}deg)`,
				opacity: .5
			}
		], {
			duration: Math.random() * 200 + 800,
			easing: 'cubic-bezier(0, 1, 1, 0)',
			delay: delay
		});
		animation.onfinish = removeParticle1;
	}
	function removeParticle1(e) {
		e.srcElement.effect.target.remove();
	}

	$('#reset_all_form').click(function() {
		$("div#reset_all_form img").removeClass('disable');
		location.reload();
	});
	/**/

	if (document.body.animate) {
		document.querySelectorAll('button').forEach(button => button.addEventListener('click', pop));
		document.querySelectorAll('a').forEach(button => button.addEventListener('click', pop));
		document.querySelectorAll('span').forEach(button => button.addEventListener('span', pop));
		document.querySelectorAll('img').forEach(button => button.addEventListener('img', pop));
		document.querySelectorAll('label').forEach(button => button.addEventListener('label', pop1));
		document.querySelectorAll('button').forEach(button => button.addEventListener('click', pop1));
	}
	$('body').on('click', '#saves_query .item.icon_item', function() {
		$('.item.icon_item').removeClass('active');
		$(this).addClass('active');
		$(this).toggleClass('disable1');
		if ($("#saves_query .item.icon_item.disable1")[0]) {
			$('.item.icon_item').removeClass('active');
			$('.item.icon_item').removeClass('disable1');
			$(this).addClass('disable1')
		} else {
			$('.item.icon_item').addClass('active');
		}
	});
	$("#submit_login").click(function(){
		var login_email=$("#login_email").val();
		var login_password=$("#login_password").val();
		$.ajax({
			type: 'POST',
			url: "/wp-admin/admin-ajax.php",
			data: {
				action: "login_user_by_website",
				'login_email': login_email,
				'login_password': login_password,
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function(response) {
				response = jQuery.parseJSON(response);
				if (response.success == 'true') {
					toastr["success"](response.message);
					setTimeout(function() {
						//location.reload();
						window.location.href="<?php echo site_url() ?>";
					}, 3000);
				} else {
					toastr["warning"](response.message);
				}
			},
			complete: function(data) {
				$(".loader").hide();
			}
		});
	})
	// $("body").on("input", "#cover_url_in_profile,#avatar_url_in_profile", function() {
	// 	var this_id = $(this).attr('id');
	// 	var url = $(this).val();
	// 	$.ajax({
	// 		type: 'post',
	// 		url: '/wp-admin/admin-ajax.php',
	// 		data: {
	// 			action: 'render_preview',
	// 			link: url
	// 		},
	// 		beforeSend: function() {
	// 			$(".loader").show();
	// 		},
	// 		success: function success(response) {
	// 			$('.' + this_id).html(response);
	// 			$('.' + this_id).html(response)
	// 			console.log(response);
	// 		},
	// 		error: function error(err) {
	// 			toastr['warning'](err);
	// 		},
	// 		complete: function complete(response) {
	// 			console.log(response);
	// 			$(".loader").hide();
	// 		}
	// 	});
	// });
	$('body').on('change', '#Sortingfunctionality', function() {
		var sorting_value = $(this).val();
		$.ajax({
			type: 'post',
			url: '/wp-admin/admin-ajax.php',
			data: {
				action: 'sort_by_bio',
				sorting_value: sorting_value
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function success(response) {
				console.log(response);
				$('.list_of_bios').html('');
				$('.list_of_bios').html(response);
			},
			error: function error(err) {
				toastr['warning'](err);
			},
			complete: function complete(response) {
				console.log(response);
				$(".loader").hide();
			}
		});
	});

	$(".profile_toggle").click(function(){
	  $("particle").css("display", "none");
	});
	$("#main-header .click_animation, .addHive-block .click_animation,.honey-block .click_animation, .cutom_frontend-sidebar .click_animation,.create-post .single-sorting-item,.createpost_button .btn_section,.steps-navigation button").click(function(){
	  $("particle").css("position", "absolute");
	});
	$('#hive_order').change(function(){
		var value=$(this).val();
		$.ajax({
			type: 'GET',
			url: '/wp-admin/admin-ajax.php',
			data: {
				action: 'is_hive_data_exist',
				'hive_order': value
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function success(response) {
				console.log(response);
				$('.manager_list_profile').html(response);
			},
			error: function error(err) {
				toastr['warning'](err);
			},
			complete: function complete(response) {
				console.log(response);
				$(".loader").hide();
			}
		});
	});
	$('img#hive_search').click(function(){
		//alert('dsds');
		var search_hive_value=$('#search_hive_value').val();
		var hidden_search_value=$('#hidden_search_value').val();
		//console.log(search_hive_value+'---'+hidden_search_value);
		//return false;
		$.ajax({
			type: 'GET',
			url: '/wp-admin/admin-ajax.php',
			data: {
				action: 'is_hive_data_exist',
				'hive_order': hidden_search_value,
				'search_value':search_hive_value
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function success(response) {
				console.log(response);
				$('.manager_list_profile').html(response);
			},
			error: function error(err) {
				toastr['warning'](err);
			},
			complete: function complete(response) {
				console.log(response);
				$(".loader").hide();
			}
		});
	});
	$('.move_up_feed').click(function(){
		var feed_id=$(this).attr('data-moveid');
		var feed_row=$("#feed_"+feed_id).html();
		$("#feed_"+feed_id).remove();
		var side_bar_feed=$("#side_feed"+feed_id).html();
		$("#side_feed"+feed_id).remove();
		$('.saved_feed_items ul').prepend('<li id="feed_'+feed_id+'" class="" data-feedid="'+feed_id+'">'+feed_row+'</li>');
		$('.menu-dashboard-container .subchild').prepend('<div class="sidebar_custom_submenu" id=side_feed'+feed_id+'>'+side_bar_feed+'</div>');
		$("li#feed_"+feed_id+" .dropdown-menu.dropdown-menu-right").removeClass('show');
		$("li#feed_"+feed_id+" .saved_private.dropdown").removeClass('show');
		var feed_ids = new Array();
		$('.saved_feed_items ul>li').each(function() {
			feed_ids.push($(this).attr("data-feedid"));
		});
		$.ajax({
			type: 'post',
			url: '/wp-admin/admin-ajax.php',
			data: {
				action: 'own_feed_move_top',
				move_to_top: feed_ids
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function success(response) {
				response = jQuery.parseJSON(response);
				toastr['warning'](response.message);
				console.log(response);
			},
			error: function error(err) {
				toastr['warning'](err);
			},
			complete: function complete(response) {
				console.log(response);
				$(".loader").hide();
			}
		});
	})
	 
	//updateOrder(selectedData);
	$('.move_to_up').click(function(){
		var data_id=$(this).attr('data-dbid');
		var moved_data=$('#'+data_id).html();
		$('#'+data_id).remove();
		
		$('.hive_type_main').prepend('<div class="hive_type" id='+data_id+'>'+moved_data+'</div>');
		$('.dropdown-menu').removeClass('show');
		$('dropdown-menu').hide();
		var selectedData = new Array();
		$('.hive_type_main>.hive_type').each(function() {
			selectedData.push($(this).attr("id"));
		});
		$("#hive_id_listing").val(selectedData);
	});
		$("#submit_hive_category").click(function(e){
			e.preventDefault();
			//console.log(selectedData);
			var hive_id_listing=$("#hive_id_listing").val();
		$.ajax({
			type: 'post',
			url: '/wp-admin/admin-ajax.php',
			data: {
				action: 'data_move_top',
				move_to_top: hive_id_listing
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function success(response) {
				console.log(response);
			},
			error: function error(err) {
				toastr['warning'](err);
			},
			complete: function complete(response) {
				console.log(response);
				$(".loader").hide();
			}
		});
	})
	$('#sort_by_feed').change(function(){
		var sorting_order_value=$(this).val();
		console.log(sorting_order_value);
		$.ajax({
			type: 'post',
			url: '/wp-admin/admin-ajax.php',
			data: {
				action: 'sort_feed_order',
				sorting_order_value: sorting_order_value
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function success(response) {
				console.log(response);
				$('.saved_feed_items ul').html(response);
			},
			error: function error(err) {
				toastr['warning'](err);
			},
			complete: function complete(response) {
				console.log(response);
				$(".loader").hide();
			}
		});
	})
	$('#feed_have_search').click(function(){
		var feed_val_search=$("#feed_val_search").val();
		//console.log(sorting_order_value);
		$.ajax({
			type: 'post',
			url: '/wp-admin/admin-ajax.php',
			data: {
				action: 'feed_val_search',
				feed_val_search: feed_val_search
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function success(response) {
				console.log(response);
				$('.saved_feed_items ul').html(response);
			},
			error: function error(err) {
				toastr['warning'](err);
			},
			complete: function complete(response) {
				console.log(response);
				$(".loader").hide();
			}
		});
	})
	
	$('.hide_hive_category').click(function(){
		var option_name=$(this).attr('data-val');
		var cat_name=$(this).attr('data-catid');
		$('#'+cat_name).remove();
		$.ajax({
			type: 'post',
			url: '/wp-admin/admin-ajax.php',
			data: {
				action: 'delete_feed_from_listing',
				option_name: option_name,
				cat_name: cat_name
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function success(response) {
				console.log(response);
				//$('.saved_feed_items ul').html(response);
			},
			error: function error(err) {
				toastr['warning'](err);
			},
			complete: function complete(response) {
				console.log(response);
				$(".loader").hide();
			}
		});
		
	})
	$(document).ready(function(){
	$('button.btn.dropdown-toggle.btn-light.bs-placeholder').text('All');
	//$('button.btn.dropdown-toggle.btn-light.bs-placeholder').hide();
	})
</script>
</body>

</html>
