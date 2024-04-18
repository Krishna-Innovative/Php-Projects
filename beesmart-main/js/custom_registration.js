host = window.location.href
window.addEventListener('load',()=>{
  host = window.location.href
  let url = new URL(host)
  console.log(url.origin)
const fullIcon = `${url.origin}/wp-content/uploads/2021/11/orange-oil.png`
const borderIcon = `${url.origin}/wp-content/uploads/2021/11/oil.png`
const greyIcon = `${url.origin}/wp-content/uploads/2021/11/grey-oil.png`

const forb = {
  title: 'Joing to Business',
  description: 'Showcase your business services, connect with new clients & staff, grow your business.',
  icon: `${url.origin}/wp-content/uploads/2021/09/Business.png`
}
const forc = {
  title: 'Joing to Career',
  description: 'Sharing your professional journey, connect with employers and apply for new work.',
  icon: `${url.origin}/wp-content/uploads/2021/09/Career-1.png`
}
const forp = {
  title: 'Joing to Personal',
  description: 'Sharing your personal journey and connecting with Friends & Family.',
  icon: `${url.origin}/wp-content/uploads/2021/09/MicrosoftTeams-image-54.png`
}
const forh = {
  title: 'Joing to Hobby',
  description: 'A digital avatar of your passion. Connect with other avatars from your hobby or interest.',
  icon: `${url.origin}/wp-content/uploads/2021/09/Hobby.png`
}
const forl = {
  title: 'Joing to Location',
  description: 'A digital avatar of a location. People can connect, see events and what\'s happening.',
  icon: `${url.origin}/wp-content/uploads/2021/09/Location.png`
}
const forcm = {
  title: 'Joing to Community',
  description: 'Sharing updates, events and more with a community with fans & followers.',
  icon: `${url.origin}/wp-content/uploads/2021/09/Community.png`
}

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
// append button to needed place 
function appendButtonToNeededPlace(){
  if(document.querySelector('.um.um-register.um-2757')){
    let fisrtStepBtn = document.querySelector('.um-row._um_row_1.step_btns')
    let firstStepForm = document.querySelector('.um.um-register.um-2757')
    firstStepForm.append(fisrtStepBtn)
  }
}
appendButtonToNeededPlace()
let upperCaseReg = /[A-Z]/ 
function registrationSteps(){
  if(host == `${url.origin}/signup/`){

  // steps nav
  const step_1 = document.querySelector('#step_1')
  const step_2 = document.querySelector('#step_2')
  const step_3 = document.querySelector('#step_3')
  const step_4 = document.querySelector('#step_4')
  const step_5 = document.querySelector('#step_5')
  // title of step
  const pageTitle = document.querySelector('#page_title')
  // login / registration block
  const nav = document.querySelector('.navigation')
  // first step
  const firstStepFields = {
    name : document.querySelector('#user_login-2757'),
    email : document.querySelector('#user_email-2757'),
    pass : document.querySelector('#user_password-2757'),
    passConf : document.querySelector('#confirm_user_password-2757'),
  }
  // two step categories 
  const radiobtns = document.querySelectorAll('label.um-field-radio')
  const cat = {
    business :  document.querySelector('#category_business'),
    career :    document.querySelector('#category_career'),
    personal :  document.querySelector('#category_personal'),
    hobby :     document.querySelector('#category_hobby'),
    location :  document.querySelector('#category_location'),
    community : document.querySelector('#category_community')
  }
  const theerdStepFields = {
    country : document.querySelector('#select2-country-container'),
    languages : document.querySelector('#languages'),
    tags : document.querySelector('#user_interests'),
    currency : document.querySelector('#select2-Currency_picker-container'),
    about : document.querySelector('#Description')
  }
  // const fourStepFields = {
  //   img : document.querySelector('#um_field_2757_CHOOSE_PHOTO'),
  // }
  // register Parts
  const regForm = {
    first_part  : document.querySelector('.reg_first_part'),
    second_part : document.querySelector('.reg_second_part'),
    third_part  : document.querySelector('.reg_third_part')
  }

  // terms & conditions 
  const terms = document.querySelectorAll('.um-field-type_terms_conditions')
  // confirm email btn
  const confirm = document.querySelector('.um-col-alt')
  //  describe categiries
  const joinBlock = document.querySelector('#join-block')
  const joinToPopup = document.querySelector('.join-to')
  // const desctTitle = document.querySelector('.join-to_title')
  const desctText = document.querySelector('.desc-text')
  const joinIcon = document.querySelector('.join-icon')

  const categoriesBlock = document.querySelector('#categories_block')

  // buttons
  const stepTwoBtn = document.querySelector('#step_two_btn') 
  const stepThreeBtn = document.querySelector('#step_three_btn') 
  const stepFourBtn = document.querySelector('#step_four_btn') 
  const stepFiveBtn = document.querySelector('#step_five_btn') 
  const forFourBtnBlock = document.querySelector('#step_four_block') 
  const forFiveBtnBlock = document.querySelector('#step_five_block') 

  const backToFirstStep = document.querySelector('#back_to_first_step')
  const backToTwoStep = document.querySelector('#back_to_two_step')
  const backToThreeStep = document.querySelector('#back_to_three_step')

  const confRegBtn = document.querySelector('#um-submit-btn')
  
  // select category
  function addDesc(nameCat, title, desc, icon, n){
    try{
      nameCat.addEventListener('click', ()=> {
        cat.business.classList.remove('orange_bg')
        cat.career.classList.remove('orange_bg')
        cat.personal.classList.remove('orange_bg')
        cat.hobby.classList.remove('orange_bg')
        cat.location.classList.remove('orange_bg')
        cat.community.classList.remove('orange_bg')

        nameCat.classList.add('orange_bg')
        joinToPopup.style.display = 'grid'
        joinIcon.src = icon
        // desctTitle.textContent = title
        desctText.textContent = desc
        radiobtns[n].click()
        stepThreeBtn.removeAttribute('disabled')
    })
    } catch(e){}
  }

  addDesc(cat.business, forb.title, forb.description, forb.icon, 0 )
  addDesc(cat.career, forc.title, forc.description, forc.icon,  1 )
  addDesc(cat.personal, forp.title, forp.description, forp.icon, 2 )
  addDesc(cat.hobby, forh.title, forh.description, forh.icon, 3)
  addDesc(cat.location, forl.title, forl.description, forl.icon, 4)
  addDesc(cat.community, forcm.title, forcm.description, forcm.icon, 5)

  

  function stepTwo(){
    changeIcon(step_1, fullIcon)
    changeIcon(step_2, borderIcon)

    hidePart(nav)
    hidePart(stepTwoBtn)
    hidePart(regForm.first_part)

    showPart(pageTitle)
    showPart(categoriesBlock)
    showPart(joinBlock)
  }

  // stepTwoBtn.addEventListener('click', stepTwo)
  stepTwoBtn.addEventListener('click',()=>{
	  var email_value=firstStepFields.email.value;
     if (firstStepFields.email.value.length <= 8){
      // toastr["warning"]("I do not think that means what you think it means.", "Url required")
      toastr["warning"]('Please complete the field email');
    } else if (firstStepFields.email.value != ''){
       checkEmailExist(email_value)
		function checkEmailExist(email_value){
			$.ajax({
			  type:'POST',
			  url:'/wp-admin/admin-ajax.php',
			  data:{
				action:'bees_unique_get_list',
				"email_value":email_value
			  }, 
				 beforeSend: function(){
					 $(".loader").show();
				 },
			success:function(response) {
			  response = jQuery.parseJSON(response);
				console.log(response);
				if(response.success=='false'){
				 // toastr["success"](response.message) 
					 if (firstStepFields.pass.value.length <= 7){
					  toastr["warning"]('Password must have at least 8 characters and 1 of them must be uppercase')
					} else if (firstStepFields.passConf.value.length <= 7){
					  toastr["warning"]('Password must have at least 8 characters and 1 of them must be uppercase')
					} else if (firstStepFields.pass.value != firstStepFields.passConf.value){
					  toastr["warning"]('Passwords do not match')
					} else if (!upperCaseReg.test(firstStepFields.pass.value)){
					  toastr["warning"]('Password must contain an uppercase letter')
					}
           else {
					  stepTwo()
					}
				}else{
				  toastr["warning"](response.message)
				}
			},
			complete:function(response){
				$(".loader").hide();
			  //toastr["warning"](response.message)
			  console.log(response)
			}
			});
			firstStepFields.email.addEventListener('change', ()=>{
			  let emailValue = firstStepFields.email.value
			  console.log('query')

			})
  		}
    }
  })

  


  function stepThree(){
    changeIcon(step_2, fullIcon)
    changeIcon(step_3, borderIcon)

    pageTitle.textContent = 'DETAIL'
    hidePart(categoriesBlock)
    hidePart(joinBlock)
    hidePart(joinToPopup)
    showPart(regForm.second_part)
    showGridPart(forFourBtnBlock)
  }

  stepThreeBtn.addEventListener('click', ()=>{
    if(joinToPopup.style.display == ''){
      toastr["warning"]('Please select a category')
    } else {
      stepThree()
    }
  })

  
  function fourStep(){
    changeIcon(step_3, fullIcon)
    changeIcon(step_4, borderIcon)

    // pageTitle.textContent = 'MORE INFO'
    pageTitle.textContent = 'CONGRATULATIONS!'
    
    hidePart(regForm.second_part)
    hidePart(forFourBtnBlock)
    showPart(regForm.third_part)
    showFlexPart(forFiveBtnBlock)
    hidePart(forFiveBtnBlock)
    hidePart(regForm.third_part)
    hidePart(forFiveBtnBlock)
    showPart(confirm)
    terms.forEach((el)=>{
      el.style.setProperty('display', 'block', 'important')
    })
  }

    stepFourBtn.addEventListener('click',() => {
      sendUserTypeData()
      if (country.getAttribute('title') == '' ){
        toastr["warning"]('Choose your country')
      } else if (document.querySelector('span#select2-country-container').title == '' || document.querySelector('span#select2-country-container').title == null){
        toastr["warning"]('Choose your country')
      } else if (theerdStepFields.currency.getAttribute('title')== "" || theerdStepFields.currency.getAttribute('title') == null){
        toastr["warning"]('Choose your currency')
      } else if (document.querySelector('li.select2-selection__choice') == null){
        toastr["warning"]('Choose language')
      } else if (theerdStepFields.about.textLength < 5) {
        toastr["warning"]('Please complete description field')
      } else {
        fourStep()
      }
  })
  
  function sendUserTypeData(){
    let active = document.querySelector('label.um-field-radio.active').closest('.active')
    let newUserTypeField = document.querySelector('input#account_type-2757')
    newUserTypeField.value = active.textContent
  }


  function fiveStep(){
    changeIcon(step_4, fullIcon)
    changeIcon(step_5, borderIcon)

    pageTitle.textContent = 'CONGRATULATIONS!'
    hidePart(forFiveBtnBlock)
    hidePart(regForm.third_part)
    hidePart(forFiveBtnBlock)
    showPart(confirm)
    terms.forEach((el)=>{
      el.style.setProperty('display', 'block', 'important')
    })
  }

  stepFiveBtn.addEventListener('click', ()=>{
    let policyPrivacy = document.querySelector('input[name=use_gdpr_agreement]')
    let termsConditions = document.querySelector('input[name=use_terms_conditions_agreement]')
    if (!policyPrivacy.checked){
      toastr["warning"]('Please confirm that you agree to our privacy policy')
    } 
    else if (!termsConditions.checked){
      toastr["warning"]('Please confirm that you agree Terms')
    } else {
      fiveStep()
    }
  })


  // step back functions 
  function backFirstStep(){
    changeIcon(step_1, borderIcon)
    changeIcon(step_2, greyIcon)

    hidePart(pageTitle)
    hidePart(categoriesBlock)
    hidePart(joinBlock)
    
    showPart(nav)
    showPart(regForm.first_part)
    showInlinePart(stepTwoBtn)
  }
  backToFirstStep.addEventListener('click', backFirstStep)

  function backTwoStep(){
    pageTitle.textContent = 'CHOOSE OF FOCUS'

    changeIcon(step_2, borderIcon)
    changeIcon(step_3, greyIcon)

    hidePart(regForm.second_part)
    hidePart(forFourBtnBlock)

    showPart(categoriesBlock)
    showPart(joinBlock)
    showGridPart(joinToPopup)
  }
  backToTwoStep.addEventListener('click', backTwoStep)

  function backTheerdStep(){
    pageTitle.textContent = 'DETAIL'
    
    changeIcon(step_3, borderIcon)
    changeIcon(step_4, greyIcon)

    showPart(regForm.second_part)
    showFlexPart(forFourBtnBlock)
    hidePart(regForm.third_part)
    hidePart(forFiveBtnBlock)
  }
  backToThreeStep.addEventListener('click', backTheerdStep)
  }
}
// setTimeout(registrationSteps, 3000)

//  show/hide functions
function hidePart(selector) {
  try{
    selector.style.display = 'none'
  } catch(e){}
}

function showPart(selector) {
  try{
    selector.style.display = 'block'
  } catch(e){}
}

function showInlinePart(selector) {
  try{
    selector.style.display = 'inline-block'
  } catch(e){}
}

function showFlexPart(selector) {
  try{
    selector.style.display = 'flex'
  } catch(e){}
}

function showGridPart(selector) {
  try{
    selector.style.display = 'grid'
  } catch(e){}
}

function changeIcon(icon, srcIcon) {
  icon.src = srcIcon
}

function confirmation(){
  try{

  const blocks = document.querySelectorAll('.um-field.um-field-type_terms_conditions>.um-field-area>a')
    // const policy = blocks[0]
    // const terms = blocks[1]
  blocks[0].setAttribute('target', '_blank');
  blocks[1].href = `${url.origin}/terms-and-conditions/`
  blocks[1].setAttribute('target', '_blank');
  console.log(blocks[0], blocks[1])
  } catch(e){}
}
// window.addEventListener('load', confirmation)


function editEmailVerifiPage(){
  const stepTwoBtn = document.querySelector('#step_two_btn') 
  if(host == `${url.origin}/register/?message=checkmail&um_role=subscriber&um_form_id=2757`){
    stepTwoBtn.style.display = 'none'
  }
}
// window.addEventListener('load', editEmailVerifiPage)




// window.addEventListener('load', ()=>{
  registrationSteps()
  confirmation()
  editEmailVerifiPage()
// })

})

window.addEventListener('load', ()=>{

  if(document.querySelector('.um-form')){
      let regForm = document.querySelector('.um-form')
      let submitBtn = regForm.querySelector('#um-submit-btn')
      addDisabledAttr(submitBtn)
      function checkAgreement(){
          regForm?.addEventListener('click', ()=>{
              let policy = regForm.querySelector('input[name=use_gdpr_agreement]')
              let terms = regForm.querySelector('input[name=use_terms_conditions_agreement]')
              
              policy.checked && terms.checked ? removeDisabledAttr(submitBtn) : addDisabledAttr(submitBtn)
          })
      }
    checkAgreement()
  }

  function removeDisabledAttr(el){
      el.removeAttribute('disabled')
  }
  function addDisabledAttr(el){
      el.setAttribute('disabled', 'disabled')
  }

})