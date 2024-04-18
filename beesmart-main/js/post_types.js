/*window.addEventListener('load', () => {
    console.log('log')
    // Quick Add Post AJAX
    let quickAddButton = document.querySelector("#try")
    let cPP = document.getElementById('create-post-page')
    quickAddButton?.addEventListener("click", function () {
        let ourPostData = {
            "title": cPP.querySelector('input[name="buddyforms_form_title"]').value,
            "Url": cPP.querySelector('input[name="Url"]').value,
            "content": cPP.querySelector('textarea[name="buddyforms_form_content"]').value,
            "language": cPP.querySelector('select[name="Country"]').value,
            "tags": cPP.querySelector('select[name="Tags[]"]').value,
            // "additional_text_optional": cPP.querySelector('').value,
            // "type_of_post_by_user_type": cPP.querySelector('').value,
            // "": cPP.querySelector('').value,
            // "": cPP.querySelector('').value,
            // "": cPP.querySelector('').value,
            "status": "publish"
        }

        let createPost = new XMLHttpRequest();
        createPost.open("POST", magicalData.siteURL + "/wp-json/wp/v2/posts");
        createPost.setRequestHeader("X-WP-Nonce", magicalData.nonce);
        createPost.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        createPost.send(JSON.stringify(ourPostData));
        createPost.onreadystatechange = function () {
            if (createPost.readyState == 4) {
                if (createPost.status == 201) {
                    alert('Nice')
                } else {
                    alert("Error - try again.");
                }
            }
        }
    });
})*/