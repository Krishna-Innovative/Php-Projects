window.addEventListener('load', () => {
    let postOptionsObject = {
        'f_be_found': [],
        'f_find_someone': [],
        'f_sell_and_buy': [],
        'f_events': [],
        'f_news': [],
        'f_hire_someone': [],
        'f_tags': [],
        'f_language': '',
        'f_price_type': '',
        'f_booking': '',
        'f_theme': '',
        'f_paywall': '',
        'f_skill_level': '',
        'f_pay_visibility': '',
        'f_suitible': '',
        'f_is_special_offer': '',
        'f_country': ''
    },
        audience = ''
        isExplisitValue = ''
    options = Object.keys(postOptionsObject)
    tagsArray = []
    // console.log(options)
    function customFieldsHandler() {
        try {
            document.querySelector('#create-post-page')?.addEventListener('click', (e) => {
                let optionValue = e.target.value
                if (e.target.closest('div[data-name]')) {
                    // specifice array from "postOption" object above
                    let postOption = e.target.closest('div[data-name]').dataset.name
                    let selectedOption = postOptionsObject[postOption]
                    // Does the target respond to 1 of the 6 arraies

                    if (options.find(option => option == postOption)) {
                        if (typeof selectedOption == 'string') {
                            console.log(selectedOption, optionValue)
                            Object.defineProperty(postOptionsObject, postOption, {
                                value: optionValue,
                                writable: true,
                                enumerable: true,
                                configurable: true
                            });
                            // selectedOption = optionValue
                            console.log(selectedOption, optionValue, postOptionsObject)
                        }
                        if (typeof selectedOption == 'object') {
                            console.log('obj')
                            if (selectedOption.indexOf(optionValue) == -1 && optionValue != undefined) {
                                selectedOption.push(optionValue)
                            } else {
                                removeOptionHandler(selectedOption, optionValue)
                            }
                        }

                    }
                    else {
                        // handle
                    }
                }
            })
        } catch (e) {
            console.log(e)
        }
    }
    customFieldsHandler()


    function addTag() {
        // input field from which the value is read when adding a new tag
        if (document.querySelector('input.select2-search__field')) {
            let inputTag = document.querySelector('input.select2-search__field')
            inputTag.addEventListener('keydown', ({ key }) => {
                if (key === 'Enter') {
                    // the value of the new tag that is passed into the array 
                    let newTerm = inputTag.value
                    if (tagsArray.length >= 20) {
                        toastr['warning']('no more than 20 tags');
                    }
                    else if (tagsArray.indexOf(newTerm) == -1) {
                        tagsArray.push(newTerm)
                        createTagInDOM(newTerm)
                        inputTag.value = ''
                    } else {
                        alert('Tag alrady edded')
                    }
                    console.log(tagsArray)
                }
            })
        }
    }
    setTimeout(addTag, 5000)

    function createTagInDOM(text) {
        // here temp will create
        let selectedTagsArea = document.querySelector('ul.select2-selection__rendered')
        let tagBlockTemplate = `
        <li class="select2-selection__choice" title="${text}" data-select2-id>
            <span class="remove-selected-user-tag">×</span>
            <span class="acf-selection">${text}</span>
        </li>`
        // insert edded tag into node
        selectedTagsArea.insertAdjacentHTML('afterbegin', tagBlockTemplate)
        // remove added tag funtional
        selectedTagsArea.addEventListener('click', (e) => {
            // detects whether there was a "delete tag button" target
            if (e.target.classList.contains('remove-selected-user-tag')) {
                let tagBlock = e.target.closest('li.select2-selection__choice')
                // remove from Array
                removeOptionHandler(tagsArray, tagBlock.title)
                // remove DOM
                tagBlock.remove()
                console.log(tagsArray)
            }
        })
    }
    function removeOptionHandler(array, value) {
        let optionIndex = array.indexOf(value)
        if (optionIndex !== -1) {
            array.splice(optionIndex, 1)
        } else {
            console.log('remove Option Handler false')
        }
    }
    function audienceHandler() {
        try {
            document.querySelector('.audience_inner')?.addEventListener('click', (e) => {
                active = e.target.closest('input').value
                audience = active
                console.log(audience, active)
            })
        } catch (e) { }
    }
    audienceHandler()
    // function loopOptions(option){
    //     option.forEach(key=> {
    //         option.key = ''
    //     })
    // }
    function locationOptionHandler(mapData) {
        if (document.querySelector('#option-region')) {
            let option = document.querySelector('#option-region').value
            switch (option) {
                case 'City region only':
                    mapData.address = ''
                    mapData.street_name = ''
                    mapData.street_number = ''
                    mapData.lat = ''
                    mapData.lng = ''
                    break
                case 'City and street':
                    mapData
                    break
            }
            return mapData
        }
    }
    $('body').on('click', '.step-submit__button', function () {
        let siteURL = window.location.origin
        let fPostTypeByUserType = $("#f_type_of_post_by_user_type").val(),
            fCustomPostFormat = $("#f_custom_post_format").val(),
            // fCustomPremiumPostFormat = $("#f_premium_custom_post_format").val(),
            fAdditionalText = $("textarea#acf-field_6242b43938a94").val(),
            furl = $("#f_url").val(),
            posttitle = $("#posttitle").val(),
            description = $("#description").val(),
            userId = $('#f_user_id').val(),
            tags = document.querySelector('#acf-field_6242b34b38a92'),
            dataPicker = $('input#acf-field_62536e0856e7b').val(),
            costPrice = $('input#acf-field_62536e3f56e7c').val(),
            aboutMeForFindSomeone = $('input#acf-field_625361291f481').val(),
            aboutMeForHireSomeone = $('#aboutForHire').val(),
            lookingForFindSomeone = $('input#acf-field_6253614e1f482').val(),
            lookingForHireSomeone = $('#lookingForHire').val(),
            // isExplisit = document.querySelector('.no-explicit').classList.contains('safe') ? 1 : 0 
            allmapData = document.querySelector('.acf-google-map>input').value != '' ?
                JSON.parse(document.querySelector('.acf-google-map>input').value) : false,
            mapData = locationOptionHandler(allmapData)
        tags.querySelectorAll('option').forEach(tag => {
            tagsArray.push(tag.textContent)
        })

        aboutMe = aboutMeForFindSomeone != '' ? aboutMeForFindSomeone : aboutMeForHireSomeone
        lookingFor = lookingForFindSomeone != '' ? lookingForFindSomeone : lookingForHireSomeone
        $.ajax({
            type: "POST",
            // dataType : "json",
           url: `${siteURL}/wp-json/pricode/v1/beearts/create`,
            data: {
                'meta_f_type_of_post_by_user_type': fPostTypeByUserType,
                'meta_f_custom_post_format': fCustomPostFormat,
                // 'meta_f_premium_custom_post_format': fCustomPremiumPostFormat,
                'meta_f_additional_text': fAdditionalText,
                'meta_f_url': furl,
                'meta_f_audience': audience,
                'meta_f_ticket_cost': costPrice,
                'meta_f_about_me': aboutMe,
                'meta_f_im_looking_for': lookingFor,
                // 'f_is_explisit': isExplisit,
                'title': posttitle,
                'content': description,
                'f_user_id': userId,
                'f_date_selecter': dataPicker,
                'f_be_found': postOptionsObject['f_be_found'],
                'f_find_someone': postOptionsObject['f_find_someone'],
                'f_sell_and_buy': postOptionsObject['f_sell_and_buy'],
                'f_events': postOptionsObject['f_events'],
                'f_news': postOptionsObject['f_news'],
                'f_hire_someone': postOptionsObject['f_hire_someone'],
                'f_language': postOptionsObject['f_language'],
                'f_price_type': postOptionsObject['f_price_type'],
                'f_booking': postOptionsObject['f_booking'],
                'f_theme': postOptionsObject['f_theme'],
                'f_paywall': postOptionsObject['f_paywall'],
                'f_skill_level': postOptionsObject['f_skill_level'],
                'f_pay_visibility': postOptionsObject['f_pay_visibility'],
                'f_suitible': postOptionsObject['f_suitible'],
                'f_is_special_offer': postOptionsObject['f_is_special_offer'],
                'f_country': postOptionsObject['f_country'],
                'f_tags': tagsArray,
                'address': mapData.address,
                'city': mapData.city,
                'country': mapData.country,
                'country_short': mapData.country_short,
                'lat': mapData.lat,
                'lng': mapData.lng,
                'name': mapData.name,
                'place_id': mapData.place_id,
                'post_code': mapData.post_code,
                'state': mapData.state,
                'state_short': mapData.state_short,
                'zoom': mapData.zoom
            },
            beforeSend: function () {
                // Show image container
                $(".loader").show();
            },
            success: function (response) {
                toastr['success']('Post created successfully');
				console.log(response);
				console.log(response.url);
                window.location.replace(response.url);
                console.log(response, mapData)
            },
            complete: function (data) {
                // Hide image container
                $(".loader").hide();
                console.log(data)
            }
        });
    })
	$('body').on('click', '#save_bio', function() {
		var category_name_of_bio=$("#category_name_of_bio").val();
		var current_user_login=$("#current_user_login").val();
		let siteURL = window.location.origin
		if(category_name_of_bio==""){
			 toastr['warning']('Category Field is Required');
		}else{
		 $.ajax({
			type: 'post',
			url:`${siteURL}/wp-json/pricode/v1/info/create/`,
			data: {
			  'category_name_of_bio': category_name_of_bio,
				'current_user_login':current_user_login
			},
			beforeSend: function() {
				$(".loader").show();
			},
			success: function success(response) {
				console.log(response.data);
				  toastr['warning'](response.data);
			},
			error: function error(err) {
			  toastr['warning'](err);
			},
			complete: function complete(response) {
			  console.log(response);
				$(".loader").hide();
			}
		});
	}
	});
	$('body').on('click', '#edit_bio', function() {
		let siteURL = window.location.origin;
		var current_user=$("#current_user_login").val();
			var data_array = new Array();
			$(".dropped").each(function(){

				var item = {};
				item['data-id'] = $(this).data('id');
				item['value'] = $(this).val();

				data_array.push(item);

			});
			$.ajax({
				type: 'POST',
				url:`${siteURL}/wp-json/pricode/v1/info/edit/`,
				dataType: 'json',
				data: {
			 	 'resulted_data': data_array,
				'current_user':current_user
				},
				beforeSend: function() {
					$(".loader").show();
				},
				success: function(response) {
					console.log(response);
					console.log(response.html);
					if (response.success == 'true') {
						toastr["warning"](response.data);
						$("div#edit-info-categorypopup").hide();
						$(".modal-backdrop.fade.show").hide();
						$("#nav_bar_navigation").html();
						$("#nav_bar_navigation").html(response.html);
					} else {
						toastr["warning"](response.data);
					}
				},
				complete: function(data) {
					$(".loader").hide();
				}
			});
	})
})