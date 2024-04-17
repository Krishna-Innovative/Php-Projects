window.addEventListener('load', ()=>{
  let url = new URL(host)
  let beFoundImg = `${url.origin}/wp-content/uploads/2022/01/Be-found1.png`
  let findSomeone = `${url.origin}/wp-content/uploads/2022/01/Find1.png`
  let buyAndSell = `${url.origin}/wp-content/uploads/2022/01/Create-Button-Sell.png`
  let hostEvent = `${url.origin}/wp-content/uploads/2022/01/Create-Button-Event.png`
  let postNews = `${url.origin}/wp-content/uploads/2022/01/Create-Button-News.png`
  let hireSomeone = `${url.origin}/wp-content/uploads/2022/01/Create-Button-Hire.png`

  try{
    const get = (el) => {
      return document.querySelector(el)
    }
    const getAll = (el) =>{
      return document.querySelectorAll(el)
    }
    function hide(el){
      el.style.display = 'none'
    }
    function show(el, type){
      el.style.display = type
    }

function nextStepTest(currentStep, nextStep, type){
          hide(document.querySelector(currentStep))
          show(document.querySelector(nextStep), type)
    }
    function nextStep(btn, currentStep, nextStep, type){
      btn.addEventListener('click', (e) => {
        e.preventDefault()
        hide(currentStep)
        show(nextStep, type)
      })
    }
    function previousStep(btn, currentStep, prevStep, type){
      btn.addEventListener('click', (e) => {
        e.preventDefault()
        hide(currentStep)
        show(prevStep, type)
      })
    }

    /*function removeNotActiove(){
      const allTypes = getAll('.post-item')
      allTypes.forEach(el => el.classList.remove('active-post-type'))
    }*/
    function hideUnactiveFields(){
      let unactiveFields = [
        '.bf_field_group.elem-Befound',
        '.bf_field_group.elem-Findsomeone',
        '.bf_field_group.elem-SellandBuy',
        '.bf_field_group.elem-Checkbox',
        '.bf_field_group.elem-News',
        '.bf_field_group.elem-Hiresomeone',
      ]
      unactiveFields.forEach( el =>{
        hide(get(el))
      })   
    }

// end untilits


    // function setActiveType(event){
    //   removeNotActiove()
    //   if (event.target.classList.contains('post-item')){
    //     event.target.classList.add('active-post-type')

    //     // get fields from 2 step and hide 
    //     let fieldTypes = getAll('div.field-type')
    //     fieldTypes.forEach(el => hide(el))

    //     // get specific field at step 2 and show
    //     // let selectedType = `.col-`+event.target.dataset.postId
    //     // console.log(selectedType)
    //     // // show( get( selectedType ), 'block')
    //     clickActive()
    //   }
    //   function clickActive(){
    //     let active = get('button[data-id=step-1-next]')
    //     active.click()
    //   }
    
    // }

    function step1(){
      // let nextStepbtn = get('button[data-id=step-1-next]')
      let nextStepbtn = get('div[data-name=basic-formats]')


      let currentBlock = get('.create-post_type')
      let nextblock = get('.post-form-fields')

      let postTypesBlock = get('.post-types')
      let postTypesPremiumBlock = get('.post-types.premium')
      let postFormatField = get('#f_custom_post_format')
      // postTypesBlock.addEventListener('click', setActiveType)
      postTypesPremiumBlock.addEventListener('click', (e)=>{
        if( e.target.classList.contains('modal') ){
          hideUnactiveFields()
		  postFormatField.value = e.target.closest('div[data-post-id]').dataset.postId

          console.log('good')
        }
        // if( e.target.dataset.dismiss ){
        //   hideUnactiveFields()
        //   console.log('dismiss')
        // }
      })
      nextStepbtn.addEventListener('click', (e)=>{
        progressBarHandler(33)
        if(e.target.closest('div[data-post-id]')){
          postFormatField.value = e.target.closest('div[data-post-id]').dataset.postId
        }
        console.log(postFormatField.value)
      })
      nextStep(nextStepbtn, currentBlock, nextblock, 'flex')
      
    }

    function step2(){
      let prevtStepbtn = get('button[data-id=step-2-prev]')
      let nextStepbtn = get('button[data-id=step-2-next]')

      let previousBlock = get('.create-post_type')
      let currentBlock = get('.post-form-fields')
      let nextBlock = get('.additiona-form-fields')
      let step3Navigation =get('.steps-navigation.step-3')
     /* appendToStep2Fields()
      step3Navigation.addEventListener('click',()=> hide(step3Navigation))*/
      prevtStepbtn.addEventListener('click', ()=>{
        progressBarHandler(5)
      })
    /*  nextStepbtn.addEventListener('click', ()=>{
        progressBarHandler(66)
        show(step3Navigation, 'flex')
      })
      nextStep(nextStepbtn, currentBlock, nextBlock, 'grid')*/
      previousStep(prevtStepbtn, currentBlock, previousBlock, 'grid')
    }

    function step3(){
      let prevtStepbtn = get('button[data-id=step-3-prev]')
      let nextStepbtn = get('button[data-id=step-3-next]')

      let previousBlock = get('.post-form-fields')
      let currentBlock = get('.additiona-form-fields')

      // append additional fields
      // appendToStep3Fields()

      // back to previous step
      previousStep(prevtStepbtn, currentBlock, previousBlock, 'flex')
      prevtStepbtn.addEventListener('click', ()=>{
        progressBarHandler(33)
      })
      appendMapPopupButtonInto3Step()
      appendMapIntoPopup()
      // create post
      nextStepbtn.addEventListener('click', ()=>{
        setTimeout(()=>{
          progressBarHandler(100)
        },500) 
        alert('Post creater Succesfully')
      })
      
    }


    function goToStepPremium(){
      let prevtStepbtn = get('button[data-id=step-premium-prev]')
      let nextStepbtn = get('button[data-id=step-premium-next]')

      let previousBlock = get('.create-post_type')
      let currentBlock = get('.inner_main_page_section_cls.news_details_main')
      let nextblock = get('.post-form-fields')
      prevtStepbtn.addEventListener('click', hideUnactiveFields)
      previousStep(prevtStepbtn, currentBlock, previousBlock, 'grid')
      nextStep(nextStepbtn, currentBlock, nextblock, 'flex')

    }

   /* function appendToStep2Fields(){
      let urlBlock = get('.col-step-2-meta-url')
      let metaInfo = get('.container-resposne')
      // urlBlock.after(metaInfo)
      console.log(urlBlock,metaInfo)
    }*/
   /* function appendToStep3Fields(){
      let addtionalStep = get('.additiona-form-fields>.wrapper')
      let tagField = get('.step-3-field-tags')
      let langField = get('.step-3-field-language')
      let text = get('.col-step-3-field-Additional_Text')
      addtionalStep.prepend(tagField, langField, text)
    }*/
    step1()
    step2()
    step3()
    goToStepPremium()

    function popuHandler(){
      let premiumFreatures = get('.post-types.premium')

      premiumFreatures.addEventListener('click', (event)=>{
        let pickedPopap = event.target.dataset.target
        let premiumForm = get('.inner_main_page_section_cls.news_details_main')
        switch (pickedPopap) {
          case '#premium':
            premiumStep(pickedPopap)
            premiumForm.querySelector('h2').textContent = 'Be found'
            premiumForm.querySelector('img.right_icon').src = beFoundImg
            premiumForm.querySelector('.main_audience>h4.audience_sub_heading').textContent = 'Reach'
            hide(premiumForm.querySelector('.about_fields'))
            hide(premiumForm.querySelector('.main_age_slider'))
            show(premiumForm.querySelector('.main_info'), 'block')
            show(premiumForm.querySelector('.acf-field.acf-field-checkbox.acf-field-6242b46338a96'), 'grid')
            // show(premiumForm.querySelector('.bf_field_group.elem-Befound'), 'grid')
            
            premiumForm.querySelector('.main_info>h4.audience_sub_heading').textContent = 'Info'
            break;
            
          case '#find_someone':
            premiumStep(pickedPopap)
            premiumForm.querySelector('h2').textContent = 'Find someone'
            premiumForm.querySelector('img.right_icon').src = findSomeone
            premiumForm.querySelector('h4.audience_sub_heading').textContent = 'Distance'
            premiumForm.querySelector('.about_fields>h4.audience_sub_heading').textContent = 'Info'
            
            hide(premiumForm.querySelector('.main_info'))
            
            show(premiumForm.querySelector('.main_age_slider'), 'block')
            show(premiumForm.querySelector('.about_fields'), 'block')
            show(premiumForm.querySelector('.bf_field_group.elem-Findsomeone'), 'grid')
            break;

          case '#buy_and_sell':
            premiumStep(pickedPopap)
            premiumForm.querySelector('h2').textContent = 'Sell'
            premiumForm.querySelector('img.right_icon').src = buyAndSell
            premiumForm.querySelector('h4.audience_sub_heading').textContent = 'Reach'

            // hide(premiumForm.querySelector('.about_fields'))
            hide(premiumForm.querySelector('.main_info'))
            hide(premiumForm.querySelector('.main_age_slider'))
            hide(premiumForm.querySelector('.about_fields'))
            show(premiumForm.querySelector('.bf_field_group.elem-SellandBuy'), 'grid')


            break;
          case '#host_event':
            premiumStep(pickedPopap)
            premiumForm.querySelector('h2').textContent = 'Event'
            premiumForm.querySelector('img.right_icon').src = hostEvent
            premiumForm.querySelector('h4.audience_sub_heading').textContent = 'Audience'
            premiumForm.querySelector('.main_info>h4.audience_sub_heading').textContent = 'Info'
            show(premiumForm.querySelector('.main_info'), 'block')
            show(premiumForm.querySelector('.bf_field_group.elem-Checkbox'), 'grid')
            
            hide(premiumForm.querySelector('.main_age_slider'))
            hide(premiumForm.querySelector('.about_fields'))

            break;
          case '#news_modal':
            premiumStep(pickedPopap)
            premiumForm.querySelector('h2').textContent = 'News'
            premiumForm.querySelector('img.right_icon').src = postNews
            premiumForm.querySelector('h4.audience_sub_heading').textContent = 'Audience'

            show(premiumForm.querySelector('.main_info'), 'block')
            show(premiumForm.querySelector('.bf_field_group.elem-News'), 'grid')

            hide(premiumForm.querySelector('.main_age_slider'))
            hide(premiumForm.querySelector('.about_fields'))
              break;
          case '#hire_someone':
            premiumStep(pickedPopap)
            premiumForm.querySelector('h2').textContent = 'Hire someone'
            premiumForm.querySelector('.audience_sub_heading').textContent = 'Info'
            premiumForm.querySelector('img.right_icon').src = postNews
            premiumForm.querySelector('h4.audience_sub_heading').textContent = 'Location range'
            premiumForm.querySelector('.main_info>h4.audience_sub_heading').textContent = 'Skill'

            show(premiumForm.querySelector('.main_info'), 'block')
            show(premiumForm.querySelector('.about_fields'), 'block')
            show(premiumForm.querySelector('.bf_field_group.elem-Hiresomeone'), 'grid')

            hide(premiumForm.querySelector('.main_age_slider'))

            break;
        }
      })
    }
    popuHandler()

    function premiumStep(picked){
      let popup = get(picked)
      let userFrowerBtn = popup.querySelector('.flower-btn') 
      let closeBtn = popup.querySelector('button.btn.btn-danger')
      userFrowerBtn.addEventListener('click', ()=>{
        closeBtn.click()
        show(get('.inner_main_page_section_cls.news_details_main'), 'block')
        hide(get('section.create-post_type'))
      })
      console.log('closeBtn true', closeBtn  )
    }

    function appendMapPopupButtonInto3Step(){
      let FieldWhereNeedAppendBtn = document.querySelector('.acf-field.acf-field-button-group.acf-field-624a5015efb23>.acf-input')
      let LocationPopupBtn = `
      <button type="button" class="btn btn-primary map-button" data-toggle="modal" data-target="#map-popup">
        Location
      </button>
      `
      FieldWhereNeedAppendBtn.innerHTML = LocationPopupBtn
    }
    function appendMapIntoPopup(){
      let map = get('.acf-field.acf-field-google-map.acf-field-624a4e9f377db')
      let popup = get('.acf-map')
      popup.append(map)
    }

    function progressBarHandler(step){
      return get('.progress-bar.active').style.width =+ step + '%'
    }

  } catch(e){console.log(e)}



//  select-Listaner
 /* function selectHandler(){

  }*/
})

