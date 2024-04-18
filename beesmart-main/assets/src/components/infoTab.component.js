import { Component } from '../core/component'
import { Form } from '../core/form'
import { Validators } from '../core/validators'
import { get, getPostPreview, siteURL } from '../utilities'
console.log(siteURL)
export class InfoTabComponent extends Component {
    constructor(id) {
        super(id)
    }
    init() {
        document.querySelector('#bees_create_info')?.addEventListener('click', submitHandler.bind(this))

        this.form = new Form(this.$el, {
            info_preview_by_link: [Validators.url, Validators.minLength(10), Validators.isUrl],
            info_title: [Validators.title],
            info_content: [Validators.required, Validators.description(10)]
        })

        if (get('#bees_add_info_form')) {
            getPostPreview('#info_post_type_image_by_url', '.bio-container-resposne')
        }
    }



}

function submitHandler(event) {
    event.preventDefault()
    if (this.form.isValid()) {
        const formData = {
            ...this.form.value()
        }
        addInfo()
        // this.form.clear()
        console.log('Add info', formData)
    }
}

function addInfo() {
    let posttitle = $("#info_post_type_title").val(),
        description = $("#info_post_type_description").val(),
        userId = $("#bees_info_user_id").val(),
        imageByUrl = $("#info_post_type_image_by_url").val(),
        selectcategory = $("#post_select_option").val(),
        // for render bio to DOM
        copy = document.querySelector('.bio-container-resposne').innerHTML,
        preview = document.querySelector('.container-resposne').insertAdjacentHTML('afterbegin', copy)
    $.ajax({
        type: "POST",
        url: `${siteURL}/wp-json/beesmart/v1/info/create`,
        data: {
            'title': posttitle,
            'content': description,
            'bees_info_user_id': userId,
            'meta_image_by_url': imageByUrl,
			'meta_selectcategory':selectcategory
        },
        beforeSend: function () {
            // Show image container
            $(".loader").show();
        },
        success: function (response) {
            toastr.success('Bio added successfully');
            $('#close-addInfo-popup').click()
            console.log(response)
            if (get('.add-info-block')) {
                let containerToAppend = get('.add-info-block > .add_bio_inner ')
                setTimeout(() => {
                    renderBioToDOM(posttitle, description, preview, containerToAppend)
                }, 1000)
            }
            // get('button[data-step=sample-saveToHive]').removeAttribute('disabled', 'disabled')

            // window.location.reload()
        },
        complete: function (data) {
            // Hide image container
            $(".loader").hide();
            console.log(data)
            // toastr.success('Info added successfully');
            $('#close-addInfo-popup').click()
            if (get('button[data-step=sample-saveToHive]')) {
                let nextStepBtn = get('button[data-step=sample-saveToHive]')
                nextStepBtn.removeAttribute('disabled', 'disabled')
                nextStepBtn.querySelector('img').classList.add('heartBeat-animation')
            }
        }
    });
}
function renderBioToDOM(title, description, preview , containerToAppend) {
    let def = get('.bio-container-resposne').innerHTML
    preview != undefined ? preview = preview : preview = def
    let template = `
    <div class="profile_single_info">
        <div class="post-thumbnail">
            <div class="loading"></div>
            <div class="container-resposne">
                ${preview}
            </div>
        </div>
        <div class="post-content">
            <div class="top-wrapper">
                <h2 class="post-title">${title}</h2>
                <p>${description}</p>                       
            </div>
        </div>
    </div>
    `
    console.log(preview)
    console.log(template)
    containerToAppend.insertAdjacentHTML('afterend', template)
}



// window.addEventListener('load', ()=>{})


// $( document ).ready(function() {
//     $( "#info_post_type_image_by_url" ).keyup(function() {
// console.log('prev')
// var val = document.querySelector('#info_post_type_image_by_url').value;
// /*if(val!="" && val.indexOf("://")>-1)
// {*/
// $('#loading').text('Loading...');
// $('.container-resposne').html('<img src="https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif?20151024034921" alt="loading" class="resposne-url-avatar">');
//     $.ajax({
//         type:'post',
//         url:'/wp-admin/admin-ajax.php',
//         data:{
//             action:'get_preview',
//             link:val
//         },
//     cache: false,
//     success:function(response) {
//     $('#loading').text('');
//     $('.container-resposne').show();
//     $('.container-resposne').html(response);

//         }
//         });
// // }
//     });
// });






// $('body').on('click', '#bees_create_info', function() {
//     let posttitle=$("#info_post_type_title").val(),
//         description=$("#info_post_type_description").val(),
//         userId=$("#bees_info_user_id").val(),
//         imageByUrl=$("#info_post_type_image_by_url").val()
//     $.ajax({
//         type : "POST",
//         // dataType : "json",
//         url : "https://beesmartstg.wpengine.com/wp-json/beesmart/v1/info/create",
//         data : {
//             'title':posttitle,
//             'content': description,
//             'bees_info_user_id': userId,
//             'meta_image_by_url':imageByUrl
//         },
//                 beforeSend: function(){
//                     // Show image container
//                     $(".loader").show();
//                 },
//                 success: function(response) {
//                     toastr.success('Info added successfully');
//                     $('#close-addInfo-popup').click()
//                     console.log(response)
//                     // window.location.reload()
//                     },
//                 complete:function(data){
//                     // Hide image container
//                     $(".loader").hide();
//                     location.reload()
//                     console.log(data)
//                 }
//         });
// })
