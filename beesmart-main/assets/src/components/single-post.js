import { Component } from '../core/component'
import { get, hide } from '../utilities'
export class SinglePost extends Component {
	constructor(id){
			super(id)
	}
	init(){
        if(get('#post-page')){
            // getSinglePostPreview()
            showCommentsHandler()
            classHandler()
            customHoneyPoints()
			customLikeCount()
			setTimeout(function () {
				scrollToContentHandler()
			},500)
            //console.log('single post scripts end')
        }
    }
}
function scrollToContentHandler() {
	let rect = get('.container-resposne.csingle').getBoundingClientRect()
	window.scrollTo({
		top: rect.top,
		behavious: 'smooth'
	})
}
function getSinglePostPreview(){
    $(document).ready(function () {
        var val = document.querySelector('.meta-preview').value;
        if (val != "" && val.indexOf("://") > -1) {
           $('#loading').text('Loading...');
           $('.container-resposne').hide();
           $.ajax({
              type: 'post',
              url:'/wp-admin/admin-ajax.php',
              data: {
                action:'get_preview_for_single_post',
                link: val
              },
              cache: false,
              success: function(response) {
                 $('#loading').text('');
                 $('.container-resposne').show();
                 $('.container-resposne').html(response);
              },
              error:function(err){
                 toastr['warning'](err)
              }
           });
        }
     });
}

// appear comments
function showCommentsHandler(){
	let comments = document.querySelector('.chat_section')
	let showCommentsBtn = get('#join_chat_btn') 
	showCommentsBtn.addEventListener('click', () => {
        if (comments.style.display == 'none') {
			comments.style.display = 'block'
			hide(showCommentsBtn)
			get('.chat_header_content').innerHTML = '<h2 style="font-size: 30px;"><b>PUBLIC <br> CHAT</b></h2>'
        } else {
        comments.style.display = 'none'
        }
    })
}

function classHandler(){
    $(".select_item_background").click(function() {
		$(".select_item_background").removeClass('select_item');
		$(this).addClass('select_item');
	})
}

function customHoneyPoints(){
    $('.custom_honey_points').keypress(function(event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			var post_value = $(this).val();
			var post_id = $(this).attr('data-post-id');
			if (post_value == "") {
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

				$(document).ready(function onDocumentReady() {
					toastr.success('Please enter honey amount');
				});
			} else {
				$.ajax({
					type: "POST",
					url: "/wp-admin/admin-ajax.php",
					data: {
						action: "onhover_like_functionality",
						'post_id': post_id,
						'like_value': post_value
					},
					beforeSend: function() {
						$(".loader").show();
					},
					success: function(response) {
						//console.log(response);
						response = jQuery.parseJSON(response);
						//alert(response.success=='true');
						if (response.success == 'true') {
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

							$(document).ready(function onDocumentReady() {
								toastr.success(response.message);
							});
							setTimeout(function() {

								location.reload();
							}, 1500);
						} else {
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

							$(document).ready(function onDocumentReady() {
								toastr.success(response.message);
							});
						}
					},
					complete: function(data) {
						$(".loader").hide();
					}
				});
			}
		}
	});
}

function customLikeCount(){
    $('a.custom_like_count').click(function(event) {
		event.preventDefault()
		var post_id = $(this).attr('data-post-id');
		var dvalue = $(this).attr('data-value');
		var honey_points = $(this).attr('data-honey');

		$.ajax({
			type: "POST",
			url: "/wp-admin/admin-ajax.php",
			data: {
				action: "onclick_like_functionality",
				'post_id': post_id,
				'like_value': dvalue,
				'honey_points': honey_points
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function(response) {
				//console.log(response);
				response = jQuery.parseJSON(response);
				//alert(response.success=='true');
				if (response.success == 'true') {
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

					$(document).ready(function onDocumentReady() {
						toastr.success(response.message);
					});
					setTimeout(function() {

						location.reload();
					}, 1500);
				} else {
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
}
