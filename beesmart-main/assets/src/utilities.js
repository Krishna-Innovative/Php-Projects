export const host = window.location.href
export const url = new URL(host)
export const siteURL = location.origin
export const imgPATH = siteURL + '/wp-content/themes/beesmart/assets/images/'
export const get = (el) => {
    return document.querySelector(el)
}
export const getAll = (el) => {
    return document.querySelectorAll(el)
}

export function avatarRequest(userNick, userAvatar) {
    $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
            action: 'bees_avatar_by_url',
            'user_nick': userNick,
        },
        beforeSend: function () {
            $(".loader").show();
        },
        success: function (data) {
            $(".loader").hide();
            userAvatar.dataset.default = ''
            userAvatar.classList = 'friend_avatar'
            userAvatar.src = data
            console.log(data);
        },
        complete: function (response) {
            $(".loader").hide();
            console.log(response)
        },
        error: function (error) {
            console.log(error)
        }
    });
}

export function avatarRequestById(userId, userAvatar) {
    $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
            action: 'bees_avatar_by_id',
            'user_id': userId,
        },
        beforeSend: function () {
            // $(".loader").show();
        },
        success: function (data) {
            $(".loader").hide();
            userAvatar.dataset.default = ''
            userAvatar.classList = 'friend_avatar'
            userAvatar.src = data
            console.log(data);
        },
        complete: function (response) {
            $(".loader").hide();
            console.log(response)
        },
        error: function (error) {
            console.log(error)
        }
    });
}

/*
* this function provide ability check is
* agree user with conditions and if agree
* provide posobility click next step 
 */
function removeDisabledAttr(el) {
    el.removeAttribute('disabled')
}
function addDisabledAttr(el) {
    el.setAttribute('disabled', 'disabled')
}
export function agreementHandler(input, button) {
    input?.addEventListener('click', () => {
        input.checked ? removeDisabledAttr(button) : addDisabledAttr(button)
    })
}

// export function getPostPreview() {
//     $(document).ready(function () {
//         $("#f_url").keyup(function () {
//             let val = document.querySelector('#f_url').value,
//                 containerResponse = document.querySelector('.resposne-url-avatar'),
//                 regJpg = /.jpg/,
//                 regPng = /.png/
//             $('.container-resposne').html('<img src="https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif?20151024034921" alt="loading" class="resposne-url-avatar">');
//             if (val.match(regJpg)) {
//                 document.querySelector('.resposne-url-avatar').src = val
//             }
//             else if (val.match(regPng)) {
//                 document.querySelector('.resposne-url-avatar').src = val
//             }
//             else {
//                 ajaxQuery(val)
//             }
//         });
//     });
// }

export function listener(transmitter, receiver) {
    let tr =  get(transmitter)
    let rec = get(receiver)
    console.log(tr)
    console.log(rec)
    tr?.addEventListener('change', ()=> {
        rec.textContent = tr.value
    })
}

export function getPostPreview(input, container) {
    $(document).ready(function () {
        $(input).click(function () {
            let val = document.querySelector('#avatar_url_in_profile').value,
                containerResponse = $(container),
                regJpg = /.jpg/,
                regPng = /.png/
            containerResponse.html(`<img src="${imgPATH}giphy.gif" alt="loading" class="resposne-url-avatar">`);
            if (val.match(regJpg)) {
                containerResponse.html(`<img src="${val}" alt="photo" />`)
                // document.querySelector('.resposne-url-avatar').src = val
            }
            else if (val.match(regPng)) {
                containerResponse.html(`<img src="${val}" alt="photo" />`)

                // document.querySelector('.resposne-url-avatar').src = val
            }
            else {
                ajaxQuery(val, containerResponse)
            }
        });
    });
}

export function ajaxQuery(value , container) {
    $.ajax({
        type: 'post',
        url: '/wp-admin/admin-ajax.php',
        //   url: '<?php echo get_stylesheet_directory_uri().'/get-data-single-post.php '?>',
        data: {
            action: 'render_preview',
            link: value
        },
        cache: false,
        success: function (response) {
            $(container).show();
            $(container).html(response);
        },
        error: function (err) {
            toastr['warning'](err)
        },
        complete: function (response) {
            console.log(response)
        }
    });
}

/**
 * get content from iframe
 */
function iFrameHandler() {
    let iframe = get('.container-resposne')?.querySelector('iframe').contentWindow.document
    console.log(iframe)
}
// document.querySelector('.embedly-card')?.querySelector('iframe').contentWindow.document


export function hideBlocks(blocks) {
    blocks.forEach(el => {
        hide(get(el))
    })
}

export function hide(el) {
    el.style.display = 'none'
}

export function show(el, type) {
    el.style.display = type
}
