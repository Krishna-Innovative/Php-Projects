<?php

/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo get_bloginfo(); ?> | <?php wp_title(); ?></title>
    <?php
    /**
     * NEW
     */
    // for user
    $user_meta = get_user_meta(um_profile_id());
    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
    $um_id = um_profile_id();
    
    global $post;
    $author_id = $post->post_author;
    define('idCurrentUser', $current_user_id);
    define('umID', $um_id);
    define('authorID', $author_id);
    define('imgPATH', get_stylesheet_directory_uri() . '/assets/images/');
    define('stickerPATH', get_stylesheet_directory_uri() . '/images/');


    /**
     * END NEW
     */

    ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <script type="text/javascript">
        document.documentElement.className = 'js';
    </script>
    <?php wp_head(); ?>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/scss/chat.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"/>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>/wp-content/plugins/ultimate-member/assets/js/select2/select2.full.min.js?ver=4.0.13" id="select2-js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/vue.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/vue.global.prod.js"></script>
</head>
<script type="text/javascript">
    const imgPATH = `${location.origin}'/wp-content/themes/beesmart/assets/images/`
	$('input.form-control.percentage_coins').keyup(function() {
		var post_id=$(this).attr('data-id');
		$('#postt_'+post_id).text($(this).val()+' %');
	});
	$('body').on('click', '.single_feed_modal .edit_feeds_btns a.visibility_btn', function() {
		var data_id = $(this).attr('data-id');
		//alert(data_id);
		//return false;
		$(this).toggleClass('disable');
		if ($("#single_edit_feed" + data_id + " .edit_feeds_btns a.visibility_btn.disable")[0]) {
			alert("#visibility_btn_" + data_id);
			$("#visibility_btn_" + data_id).val(0);
		} else {
			//alert('rtttt_z67s');
			alert("#visibility_btn_" + data_id);
			$("#visibility_btn_" + data_id).val(1);
		}

	})
	$('input.form-control.percentage_coins').keyup(function() {
		var post_id=$(this).attr('data-id');
		$('#postt_'+post_id).text($(this).val()+' %');
	});
	$(document).ready(function(){
        function drhangler(){
            document.querySelector('#preview-js').addEventListener('click', function(e){
            if(e.target.closest('.nav-item')){
                console.log(e.target.querySelector('input'))
                e.target.querySelector('input').classList.toggle('checked');
                }
            });
        }
        // setTimeout(drhangler,5000);
		// $('body').on('click', 'ul.hivvdropdown_list li input', function(e){
        // console.log(e.target.closest('input'));
		// e.target.closest('input')
        // .toggleClass('checked')
		// })

	})
	
    function option() {
        return toastr.options = {
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
    }
    $(document).ready(function() {
        setTimeout(function() {
            $(".postname option").each(function() {
                $(this).siblings('[data-id="' + this.value + '_dfghsthrt"]').remove();
            });
        }, 4500);
        $('body').on('click', '#add_to_category .item.icon_item', function() {
            $('.item.icon_item').removeClass('active');
            $(this).addClass('active');
        });
        $('body').on('click', '.search_filter.edit_to_category.edit_to .item.icon_item', function() {
            $('.item.icon_item').removeClass('active');
            $(this).addClass('active');
            $(this).toggleClass('disable1');
            if ($(".search_filter.edit_to_category.edit_to .item.icon_item.disable1")[0]) {
                $('.item.icon_item').removeClass('active');
                $('.item.icon_item').removeClass('disable1');
                $(this).addClass('disable1');
            } else {
                $('.item.icon_item').addClass('active');
            }
        });
        // on click delete active for all category and add for current target
        $('body').on('click', 'div#saves_query .item.icon_item', function() {
            $('.item.icon_item').removeClass('active');
            $(this).addClass('active');
        });

        $('body').on('click', '.abcc.search_filter.edit_category_modal .item.icon_item', function() {
            $('.item.icon_item').removeClass('active');
            $(this).addClass('active');
        });
        //  add hive
        $('body').on('click', 'button.load_category', function() {
            // hive name
            var resulted_value = $('.new_category_listing').val();
            // hive image
            const imge_url = $('#add_to_category .item.icon_item.active img').attr('src');
            if (resulted_value == "") {
                option()
                $(document).ready(function onDocumentReady() {
                    toastr["warning"]('Please fill category name');
                });
            } else if (imge_url == "" || imge_url == undefined) {
                option()
                $(document).ready(function onDocumentReady() {
                    toastr["warning"]('Please choose your category image');
                });
            } else {
                parts = imge_url.split("/images/"),
                    last_part = parts[parts.length - 1];
                setTimeout(function() {
                    $.ajax({
                        type: "POST",
                        url: "/wp-admin/admin-ajax.php",
                        data: {
                            action: "category_created_by_logged_in_user",
                            'category_value': resulted_value,
                            'category_image': last_part
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
                                $('input.form-control.new_category_listing').val('');
                                $('.item.icon_item.active').removeClass('active');
                                $('.close_category_popup').click();
                                $("div#add_to_category").hide();
                                jQuery('div#add_to_category .tool_modal_footer a').click();
                                $('.hive_type span').css('display', 'none');
                                $('.edit_hive_sec .hive_type_main').prepend('<div class="hive_type"><input type="text" name="category_list" value="' + resulted_value + '" class="form-control form-control category_list" readonly>	<div class="select_edit" data-toggle="modal" data-target="#edit_to_category_' + response.last_id + '"><div class="select_sticker"><img src="' + imge_url + '"></div> </div></div><div class="modal fade custom_trsparent_modal search_filter edit_catey edit_to_category edit_category_modal show" id="edit_to_category_' + response.last_id + '" aria-modal="true" role="dialog"><div class="modal-dialog  modal-dialog-centered"><div class="modal-content"><div class="modal-header border-0"></div><div class="modal-body pt-0"><div class="search_filter_steps"><div class="saved_feed_block"><div class="select_sticker save_icons_block"><div class="item icon_item"><img src="/images/004-diamond.png">  </div><div class="item icon_item"><img src="/images/020-plane.png">  </div><div class="item icon_item"><img src="/images/015-world%20pride%20day.png">  </div><div class="item icon_item"><img src="/images/037-volleyball.png">  </div><div class="item icon_item"><img src="/images/046-house.png">  </div><div class="item icon_item"><img src="/images/004-buddha.png">  </div><div class="item icon_item"><img src="/images/021-stationary%20bike.png">  </div><div class="item icon_item"><img src="/images/253-ballet.png">  </div><div class="item icon_item"><img src="/images/004-honey.png">  </div><div class="item icon_item"><img src="/images/007-umbrella.png">  </div><div class="item icon_item"><img src="/images/036-pomegranate.png">  </div><div class="item icon_item"><img src="/images/032-ping%20pong.png">  </div><div class="item icon_item"><img src="/images/005-candy%20corn.png">  </div><div class="item icon_item"><img src="/images/002-boot.png">  </div><div class="item icon_item"><img src="/images/025-brass%20knuckles.png">  </div><div class="item icon_item"><img src="/images/017-kayak.png">  </div></div><button class="reload_category random_category"><img src="<?php echo imgPATH; ?>Check1.png"></button> <button class="update_category" data-cat="' + response.last_id + '"><img src="/wp-content/uploads/2022/01/Check1.png"></button></div></div></div><div class="modal-footer justify-content-center tool_modal_footer "><a class="feed-create-close-btn" data-dismiss="modal"><img src="<?php echo imgPATH; ?>X.png"></a></div></div></div></div>');
                            } else {
                                option()
                                $(document).ready(function onDocumentReady() {
                                    toastr["warning"](response.message);
                                });
                            }
                        },
                        complete: function(data) {
                            $(".loader").hide();
                        }
                    });
                }, 1000);
            }

        })

    });

    //})

    window.onUsersnapCXLoad = function(api) {
        api.init();
    }
    var script = document.createElement('script');
    script.defer = 1;
    script.src = 'https://widget.usersnap.com/global/load/e017357d-f831-42fc-99a4-f788523fa190?onload=onUsersnapCXLoad';
    document.getElementsByTagName('head')[0].appendChild(script);

    jQuery(document).on('click', function() {
        jQuery('.um-dropdown').hide();
    });

    jQuery(document).ready(function() {
        setTimeout(function() {
            $(".js-example-basic-multiple").select2();
        }, 2500);
    })
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        var honney = '<div class="honey_tab-outer"><div class="honey_tab-top"><div class="honey_top_honey"><img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2021/11/honey-2-1.png"></div><div class="honey_tab-count"><img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2021/11/Honey-14-1.png"><span><?php echo do_shortcode('[mycred_total_balance types="mycred_default,mycustomtype" total=1]'); ?></span></div></div><div class="honey_tab_services"><div class="honey_tab_services_head"><h4 class="business-service">Services:</h4><h4 class="business-skills">Skills:</h4><p><?php echo $wservices ?></p></div><div class="honey_tab_services_rate"><div class="honey_tab_services_rate_item services_center"><img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2021/12/Rectangle-434.png"><div class="honey_tab_services_time_item-text"><span class="time"><?php echo $Buisness_hour ?> - <?php echo $Buisness_hour_28 ?></span><span>Business Hours</span></div></div><div class="honey_tab_services_rate_item services_rate_left"><img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2021/11/Vector-219.png"><div class="honey_tab_services_rate_item-text"><span class="price">$<?php echo $month_salary ?></span><span>Month Salary</span></div></div><div class="honey_tab_services_rate_item services_rate_right"><img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2021/11/Vector-218.png"><div class="honey_tab_services_rate_item-text"><span class="price">$<?php echo $hour_rate ?></span><span>Hour Rate</span></div></div></div></div></div>'

        $('body').toggleClass('colaps-custom-close');
        jQuery('#submit_search').click(function() {

            jQuery('#searchheader').submit();

        });
        jQuery('.gmw-address-field-wrapper,.gmw-search-form-taxonomies').wrapAll('<div class="gmw-address-duble"></div>');
        jQuery(".badges-default").prepend(honney);
        var urlParams = new URLSearchParams(window.location.search);
        var param_x = urlParams.get('h');
        var search_key = urlParams.get('search_key');

        if (param_x == 'true') {
            jQuery('#gmw-keywords-4').val(search_key);
            jQuery('#gmw-submit-4').trigger("click");
        }
        jQuery(window).scroll(function() {
            var scroll = $(window).scrollTop();

            //>=, not <=
            if (scroll >= 50) {
                //clearHeader, not clearheader - caps H
                jQuery("body").addClass("darkHeader");
            }
            if (scroll <= 50) {
                //clearHeader, not clearheader - caps H
                jQuery("body").removeClass("darkHeader");
            }
        });
    });
    jQuery(document).ready(function() {
        jQuery('input[name="customkeywords"]').keyup(function() {
            var v = jQuery(this).val();
            jQuery('#gmw-keywords-7').val(v);
        });
    });
    /*on feed page (Post preview and post clicked show different information) script */
    jQuery(document).ready(function() {
        jQuery('body').on('click', 'button.cp_btn', function() {
            var post_id = $(this).attr('data-id');
            var final_honey_value = $('#single-post-' + post_id + ' .LoveCount').text();
            var author_image = $('#single-post-' + post_id + ' .author-img img').attr('src');
            var time_of_post = $("div#timer_" + post_id).html();
            console.log(time_of_post + '++');
            setTimeout(function() {
                jQuery('.popup-card-wrapper .LoveCount').text(final_honey_value);
                jQuery('.popup-author-img img').attr('src', author_image);
                jQuery('.popup-card-wrapper #timer_').html(time_of_post);
            }, 1000);
        })
    })
    /*End of screipt*/
</script>
<script>
    function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("myInput");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);
    }
</script>
<?php if (is_user_logged_in()) { ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            var conflg = "<input type='hidden' id='code_cn' value='<?php print_r($country_new[0]->code); ?>'><div class='cont-flg um-field'><span class='countryy'><i style='background-position: 0px -300px;'></i></span><div class='con-flg'><?php print_r($country_new[0]->code); ?></div></div>";
            $('.um-field-languages').after(conflg);
        });
    </script>
<?php } ?>
<script>
    window.document.onload = function() {
        if (document.readyState !== "complete") {
            document.querySelector(".gmw-pt-default-form-wrapper").style.visibility = "hidden";
            document.querySelector("#loader").style.visibility = "visible";
        } else {
            setTimeout(function() {
                document.querySelector("#loader").style.display = "none";
                document.querySelector(".gmw-pt-default-form-wrapper").style.visibility = "visible";
            }, 1000);
        }
    };
</script>

<body <?php body_class(); ?>>

    <?php get_template_part('template-parts/header/header') ?>

    <?php
     do_action( 'db_query' );
    get_template_part('template-parts/header/modals') ?>

    <?php if (is_user_logged_in()) { ?>
        <?php get_template_part('template-parts/header/sidebar') ?>
    <?php } ?>

    <script>
          $('body').on('click','.profile_toggle',function() {
            $('#profile_target').toggleClass('slow');
        });
        $(".hamburger-btn").click(function() {
            $("body").toggleClass("main");
        });

        function withJquery() {
            console.time('time1');
            var temp = $("<input>");
            $("body").append(temp);
            temp.val($('#copy-id').text()).select();
            document.execCommand("copy");
            temp.remove();
            console.timeEnd('time1');
        }
        $('body').on('click', 'button#custo_submit_btm', function() {
            var site_url = document.URL;
            var value = $("#search_by_keyword_input").val();
            if (value == "") {
                option()

                $(document).ready(function onDocumentReady() {
                    toastr.success('Please Enter any keywords');
                });
            } else {
                window.location.href = site_url + '/search?query=' + value;
            }

        })
        $(document).ready(function() {
            $(".category_list").on("keyup change", function(e) {
                var key = e.which;
                if (key == 13) // the enter key code
                {
                    var timer;
                    var resulted_value = $(this).val();
                    clearTimeout(timer); //clear any running timeout on key up
                    setTimeout(function() {
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
                                        $('input.form-control.new_category_listing').val('');
                                        $('.item.icon_item.active').removeClass('active');
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
        });
        jQuery("body").on('click', 'a.um-profile-edit-a .um-faicon-cog', function() {
            jQuery(".um-profile-edit.um-profile-headericon .um-dropdown").toggleClass('existed');
        })
    </script>
