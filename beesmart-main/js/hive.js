

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
function hideOtherHiveDropdowns() {
    document.querySelectorAll('.hivvdropdown')?.forEach(drop => {
        drop.classList.add('hidden')
    })
}
// found all saved hive from other user if there is any 
function selectAllSavedHives(data_id) {
    let selected = []
    $('.list_of_checkbox' + data_id + ' input:checked').each(function () {
        let selectedHive = $(this).val()
        if (selected.indexOf(selectedHive) != -1) {
            // console.log(selected.push($(this).val()));
        } else {
            selected.push(selectedHive)
        }
    });
    return selected
}


/*===============
*   SAVE HIVE   *
*  UNLOCK HIVE  *
*               *
===============*/
function save_follow_user_data(id) {
    // var data_id = $(this).attr('data-id');
    var data_id = id
    console.log(data_id, 'data-id');
    var author_id = $('.list_of_checkbox' + data_id).attr('data-id');
    var selected = selectAllSavedHives(data_id)
    var hive_category = selected.join(",");
    $.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        data: {
            action: "save_follow_user_data",
            'category_id': hive_category,
            'user_id': author_id
        },
        beforeSend: function () {
            $(".loader").show();
        },
        success: function (response) {
            // console.log(response);
            // $(".loader").hide();
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
            // setTimeout(()=>window.location.reload(), 500)
        },
        complete: function (data) {
            $(".loader").hide();
        }
    });
    console.log(hive_category);
}
jQuery(document).ready(function () {
    /* 
    * add to hive (follow)
    */

    $('body').on('click', 'button.hover_hue.click_animation.p-0.hivedrop_down_button img', ()=> save_follow_user_data($('button.hivedrop_down_button img').attr('data-id')))



    /**
     * REMOVE FROM HIVE (unfollow)
     */
    $('body').on('click', '.remove_successfully', function(event) {
        event.preventDefault();
        var user_id = $(this).attr('data-userid');
        $.ajax({
            type: "POST",
            url: "/wp-admin/admin-ajax.php",
            data: {
                action: "remove_user_list_from_follower",
                'user_id': user_id
            },
            beforeSend: function() {
                $(".loader").show();
            },
            success: function(response) {
                // response = jQuery.parseJSON(response);
                // jQuery('.manager_list').html('');
                // jQuery('.manager_list').html(response);
                toastr.success('successfully removed');
                // setTimeout(() => {
                //     $('.UnsubscribePopup-closeBtn').click()
                // }, 1000);
            },
            complete: function(data) {
                $(".loader").hide();
            }
        });
    })


})



// end
/**
 * 
 * SHOW HIVE (FOLLOWERS LIST)
 * 
 */

 jQuery(document).ready(function () {
    var limit = 99;
    var start = 0;
    var action = 'inactive';

    function loadHiveData(limit, start) {
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            method: "POST",
            data: {
                action: "profile_hive_manager_list",
                'limit': limit,
                'start': start
            },
            beforeSend: function () {
                $(".loader").show();
            },
            success: function (data) {
                if (data == '<div class="not_found_record">No Hive Record Found</div>') {
                    $('.manager_list_profile').append(data);
                    $('div#hiveinfo .load_more_btn').css('display', 'none');
                } else {
                    $('.manager_list_profile').append(data);
                    action = "inactive";
                }

            },
            complete: function (data) {
                $(".loader").hide();
            }
        });
    }

    if (action == 'inactive') {
        action = 'active';
        // loadHiveData(limit, start);
    }
    $('#hive_load_more').click(function (event) {
        event.preventDefault();
        start = start + limit;
        loadHiveData(limit, start);
    })
 });


window.addEventListener('load', () => {
    let otherUserId = document.querySelector('.hivvdropdown_button').dataset.feedId 
    otherUserId = otherUserId ? otherUserId : 0
    console.log(otherUserId)
    // document.querySelectorAll('ul.hivvdropdown_list, .hivvdropdown_button')?.forEach(dp=>{
    //     dp.addEventListener('click', function(e){
    //         let singleHive = e.target.closest('.nav-item').querySelector('input')
    //         singleHive.checked = !singleHive.checked
    //         // console.log(singleHive)
    //     })
    // })
    // adding checked icon for saved hive
    function checkIsUserSavedOtherUserToOwnHive() {
        $.ajax({
            type: "POST",
            url: "/wp-admin/admin-ajax.php",
            data: {
                action: "check_saved_hive",
                'user_id': otherUserId
            },
            beforeSend: function() {
                // $(".loader").show();
            },
            success: function(response) {
                let savedHiveIds = response.split(',')
                savedHiveIds.forEach(hiveId =>{
                    document.querySelectorAll(`.hive${hiveId}`).forEach(h =>{
                        h.checked = true;
                        console.log(hiveId)
                    })
                })
                setTimeout(() => {
                    console.log(savedHiveIds)
                    // if (savedHiveIds) {
                    // }
                }, 1000);
                return savedHiveIds
            },
            complete: function(data) {
                console.log(data)
                // $(".loader").hide();
            }
        });
    }
    function checkArrayUsers() {
        let otherUserIds = []
        document.querySelectorAll('button[data-type=addhive]')?.forEach(i => otherUserIds.push(i.dataset.feedId))
        $.ajax({
            type: "POST",
            url: "/wp-admin/admin-ajax.php",
            data: {
                action: "check_saved_hive_array",
                'user_ids_array': otherUserIds
            },
            beforeSend: function() {
                // $(".loader").show();
            },
            success: function(response) {
                // let savedHiveIds = response.split(',')
                // savedHiveIds.forEach(hiveId =>{
                //     document.querySelectorAll(`.hive${hiveId}`).forEach(h =>{
                //         h.checked = true;
                //         console.log(hiveId)
                //     })
                // })
                setTimeout(() => {
                    console.log(response)

                }, 1000);
            },
            complete: function(data) {
                console.log(data)
                // $(".loader").hide();
            }
        });
    }
    // is responsible for the opening of the X dropdown
    function dropdownHandler(e) {
        if (e.target.closest('button[data-type=addhive]')) {
            let btn = e.target.closest('button[data-type=addhive]'),
                drop = btn.nextSibling ? btn.nextSibling : e.target.nextSibling 
                hideOtherHiveDropdowns()
                // console.log(btn,drop,e.target)
            if (drop) {
                drop.nextSibling.classList.remove('hidden')
                drop.nextSibling.addEventListener('click', function (e) {
                    // Checking if this is a list item ?
                    if ((e.target.closest('.nav-item'))) {
                        let singleHive = e.target.closest('.nav-item').querySelector('input')
                        singleHive.checked = !singleHive.checked
                    }
                    // Checking whether these are buttons to save
                    else if (e.target.closest('.hivedrop_down_button')) {
                        let saveBtn = e.target.closest('.hivedrop_down_button')
                        console.log(saveBtn.dataset.hive)
                        save_follow_user_data(saveBtn.dataset.hive)
                    }
                    // console.log(singleHive)
                })
            }
            // document.addEventListener('click', () => checkIsDropownTarget(e, drop))
        }
        else if (e.target.closest('.hive_icon')) {
            let hideBtn = e.target.closest('.hivvdropdown')
            hideBtn.classList.add('hidden')
        }
        else {
            if (e.target.closest('.hivvdropdown')) {
                console.log('true')
            }
            else { 
                hideOtherHiveDropdowns()
            }
        }
    }

    $(".postname option").each(function() {
        $(this).siblings('[data-id="' + this.value + '_dfghsthrt"]').remove();
    });
    var count = 1;
    $(document).ready(function() {
        setTimeout(function() {
            for (i = 0; i <= count; i++) {
                $('.client' + i).owlCarousel({
                    loop: true,
                    nav: true,
                    items: 1,
                    autoplayTimeout: 3000,
                    autoplay: true,
                    animateIn: 'fadeIn',
                    animateOut: 'fadeOut'
                });
            }
            console.log('im there');
        }, 1000);
    })
    checkIsUserSavedOtherUserToOwnHive()
    // if(window.location)
    checkArrayUsers()
    document.addEventListener('click', dropdownHandler)
})
