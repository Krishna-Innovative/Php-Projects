import { Component } from '../core/component'
import { get, getAll, getPostPreview, hide, ajaxQuery } from '../utilities'

export class user extends Component {
    constructor(id) {
        super(id)
    }
    init() {
        if (get('.profile_page')) {

            // avatar
            getPostPreview('#pull_data_btn', '.container-response-avatar')
            updateField('#save_pulled_data_btn', '.avatar-meta-url','#preview_position_controller')
            // cover
            // getPostPreview('.cover-image-meta-url', '.container-response-cover-image')
            // updateField('.Save-Cover-image', '.cover-image-meta-url', 'user_cover_image_url', '.close-SaveCoverimage')

            renderUserPhotos()
            //uploadAvatarUrl('input.avatar-meta-url', '.container-response-avatar') // avatar
            //uploadAvatarUrl('input.cover-image-meta-url', '.container-response-cover-image') // cover
            updateProfilePopupHandler()
        }
    }
}

function updateField(
    /**
     *  1 onclick on this button starts updating
     *  2 the field where the value for the pull-up is taken from
     *  3 data about position photo (css)
     */
    button, field, positionEl) {
    if (get('.profile-header')) {
        get(button)?.addEventListener('click', () => {
            let val = get(field).value,
                pos = get(positionEl).style.transform,
                fieldName = get('#pull_preview_popup').getAttribute('data-type')
            $.ajax({
                type: 'post',
                url: '/wp-admin/admin-ajax.php',
                data: {
                    action: 'bees_update_meta_data',
                    link: val,
                    fieldName: fieldName,
                    position: pos
                },
                cache: false,
                beforeSend: function () {
                    // Show image container
                    $('.loader').show()
                },
                erroe: function (response) {
                    alert('error', response)
                    console.log(response)
                },
                success: function (response) {
                    get('#close_pull_data_btn').click()
                    toastr.success('success')
 
                    let nextStepBtn = get('button[data-step=sample-profileNavifation]') ?
                        get('button[data-step=sample-profileNavifation]') : ''
                    if (get(button).classList.contains('Save-Cover-image')) {
                        if (nextStepBtn != '') {
                            nextStepBtn.removeAttribute('disabled', 'disabled')
                            if (!get('button[data-step=sample-profileNavifation]').classList.contains('locked')) {
                                nextStepBtn.querySelector('img').classList.add('heartBeat-animation')
                            }
                        }
                        // get('button[data-step=sample-profileNavifation]').removeAttribute('disabled', 'disabled')
                        // hiding icon when photo added !important :)
                        if (get('img[data-image=upload-url-avatar]')) {
                            hide(get('img[data-image=upload-url-avatar]'))
                        }
                    }
                    else if (get(button).classList.contains('Save-Url-Avatar')) {
                        if (nextStepBtn != '') {
                            nextStepBtn.classList.remove('locked')
                            if (!get('button[data-step=sample-profileNavifation]').hasAttribute('disabled')) {
                                nextStepBtn.querySelector('img').classList.add('heartBeat-animation')
                            }
                        }
                        // hiding icon when photo added !important :)
                        if (get('img[data-image=upload-cover-image]')) {
                            hide(get('img[data-image=upload-cover-image]'))
                        }
                    }


                    console.log(response)
                    let previewClone = null
                    let responseInner = get('#preview_position_controller').innerHTML
                    appendNewElementToDOM(fieldName, responseInner)
                    // if (fieldName == 'user_avatar_url') {
                    //     previewClone = get('.container-response-avatar').innerHTML
                    //     appendNewElementToDOM('.user-avatar', previewClone)
                    // }
                    // else {
                    //     previewClone = get('.container-response-cover-image').innerHTML
                    //     appendNewElementToDOM('.user-coverImage' ,previewClone)
                    // }
                },
                complete: function (response) {
                    console.log(response)
                    $('.loader').hide()
                },
            });
        })

    }
}


// function appendNewAvatarToDOM(newAvatar) {
//     // let avatarsPlacesInDOM = 
//     getAll().forEach(avatar => {
//         avatar.src = newAvatar
//     })
//     // getAll('.user-coverImage')
// }
function appendNewElementToDOM(els, newEl) {
    // let avatarsPlacesInDOM = 
    getAll(`[data-append=${els}]`).forEach(el => {
        el.innerHTML = newEl
    })
    // getAll('.user-coverImage')
}

function renderUserPhotos() {
    if (get('.cover-link')) {
        let container = get('.cover-container')
        let value = get('.cover-link').value
        ajaxQuery(value, container)
        console.log(container, value)
    }
    console.log('done 100%')
}

// btn to save cover .Save-Cover-image
// btn to save avatar .Save-Url-Avatar

// 'input.cover-image-meta-url').value
// avatar-meta-url



function updateProfilePopupHandler(e) {
    get('#update-profile-popup').addEventListener('click', function(e){
        if(e.target.closest('[data-field]')){
            let previewPopup = get('#pull_preview_popup')
            let metaField = e.target.closest('[data-field]')
            previewPopup.dataset.type = metaField.dataset.field
            console.log(e.target)
        }
    })
}