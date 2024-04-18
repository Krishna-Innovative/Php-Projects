import { get, getAll, host } from './utilities'
window.addEventListener('load', () => {

  let url = new URL(host)
  let beFoundImg = `${url.origin}/wp-content/uploads/2022/01/Be-found1.png`
  let findSomeone = `${url.origin}/wp-content/uploads/2022/01/Find1.png`
  let buyAndSell = `${url.origin}/wp-content/uploads/2022/01/Create-Button-Sell.png`
  let hostEvent = `${url.origin}/wp-content/uploads/2022/01/Create-Button-Event.png`
  let postNews = `${url.origin}/wp-content/uploads/2022/01/Create-Button-News.png`
  let hireSomeone = `${url.origin}/wp-content/uploads/2022/01/Create-Button-Hire.png`


  // let types = [
  // textFormat = {
  //     title : 'lorem dolor text',
  //     desc : 'lorem dolor eipfa didi fode tootto bene? '
  //   },
  //  imageFormat = {
  //     title : 'lorem dolor image',
  //     desc : 'lorem dolor eipfa didi fode tootto bene? '
  //   },
  //  videoFormat = {
  //     title : 'lorem dolor video',
  //     desc : 'lorem dolor eipfa didi fode tootto bene? '
  //   },
  //  audioFormat = {
  //     title : 'lorem dolor audio',
  //     desc : 'lorem dolor eipfa didi fode tootto bene? '
  //   },
  //  streamingFormat = {
  //     title : 'lorem dolor stream',
  //     desc : 'lorem dolor eipfa didi fode tootto bene? '
  //   },
  //  otherFormat = {
  //     title : 'lorem dolor other',
  //     desc : 'lorem dolor eipfa didi fode tootto bene? '
  //   }
  // ]
  
  try {
    $(document).ready(function () {
      $('body').on('click', 'a.single-sorting-item.content_item', function () {
        $('a.single-sorting-item.content_item').removeClass('selected');
        $('a.single-sorting-item.content_item').addClass('disable');
        $(this).addClass('selected');

        var image_name = $(this).find('img').attr('src');
        //alert(image_name);
        $('.selectpost_img img').attr('src', image_name)
        $(this).removeClass('disable');
        $(this).toggleClass('findselection');
        if ($('a.single-sorting-item.content_item.findselection')[0]) {
          //alert('Yes');
          $(this).toggleClass('selected');
          $('a.single-sorting-item.content_item').removeClass('findselection');
          $(this).addClass('findselection')

        } else {
          //alert('No');
          $('a.single-sorting-item.content_item').addClass('selected');
          $('a.single-sorting-item.content_item').removeClass('disable');
        }
      })
    })
    // delete disabled for one charapter
    get('.create-post_type')?.addEventListener('click', (e) => {
      if (e.target.closest('.single-sorting-item')) {
        let character = e.target.closest('.single-sorting-item'),
          id = character.dataset.postId
        
        character.children[0].classList.remove('disable')
      }
    })
    /*  const get = (el) => {
       return document.querySelector(el)
     }
     const getAll = (el) =>{
       return document.querySelectorAll(el)
     } */
    
    function hide(el) {
      el.style.display = 'none'
    }
    function show(el, type) {
      el.style.display = type
    }
    function isVisible($el) {
      return get($el).style.display == 'block'
    }
    function isEmpty($el) {
      return get($el).value == ''
    }

    function nextStepTest(currentStep, nextStep, type, ...args) {
      console.log(args)
      args.forEach(arg => {
        return arg.length > 0
      })
      if (arg.length >= 3) {
        hide(currentStep)
        show(nextStep, type)
      } else {
        alert('not valid')
      }
    }

    function nextStep(btn, currentStep, nextStep, type) {
      btn.addEventListener('click', (e) => {
        e.preventDefault()
        hide(currentStep)
        show(nextStep, type)
      })
    }
    function previousStep(btn, currentStep, prevStep, type) {
      btn.addEventListener('click', (e) => {
        e.preventDefault()
        hide(currentStep)
        show(prevStep, type)
      })
    }

    function removeNotActiove() {
      const allTypes = getAll('.post-item')
      allTypes.forEach(el => el.classList.remove('active-post-type'))
    }
    function hideUnactiveFields() {
      let unactiveFields = [
        '.elem-Befound',
        '.elem-Findsomeone',
        '.elem-SellandBuy',
        '.elem-Checkbox',
        '.elem-News',
        '.elem-Hiresomeone',
      ]
      unactiveFields.forEach(el => {
        hide(get(el))
      })
    }

    // end untilits



    function step1() {
      // let nextStepbtn = get('button[data-id=step-1-next]')
      // let PostFormat = get('div[data-name=basic-formats]')
      let basicPostFormat = get('div[data-name=basic-formats]')
      let secondStepBtn = get('button#btn-CP-second-step')
      
      
      let currentBlock = get('.create-post_type')
      let nextblock = get('.post-form-fields')
      
      let postFormatField = get('#f_custom_post_format')
      // postTypesBlock.addEventListener('click', setActiveType)
      let postTypesPremiumBlock = get('section.create-post_type')
      postTypesPremiumBlock.addEventListener('click', (e) => {
      //   if (e.target.classList.contains('modal')) {
      //     hideUnactiveFields()
      //   }
        if (e.target.closest('[data-post-id]')) {
      //     clearChecked()
          postFormatField.value = e.target.closest('[data-post-id]').dataset.postId
        }
      //   console.log(postFormatField.value)
      })
      // secondStepBtn.addEventListener('click', (e) => {
      //   progressBarHandler(43)
      //   if (e.target.closest('div[data-post-id]')) {
      //     postFormatField.value = e.target.closest('div[data-post-id]').dataset.postId
      //   }
      //   console.log(postFormatField.value)
      // })
      nextStep(secondStepBtn, currentBlock, nextblock, 'flex')

    }

    function step2() {
      let prevtStepbtn = get('button[data-id=step-2-prev]')
      let nextStepbtn = get('button[data-id=step-2-next]')

      let previousBlock = get('.create-post_type')
      let currentBlock = get('.post-form-fields')
      let nextBlock = get('.additiona-form-fields')
      let step3Navigation = get('.steps-navigation.step-3')
      prevtStepbtn.addEventListener('click', () => {
        progressBarHandler(5)
      })


      // nextStepbtn.addEventListener('click', ()=>{
      //     let url = document.querySelector('input#f_url').value
      //     let title = document.querySelector('input#posttitle').value
      //     let desc = document.querySelector('textarea#description').value
      //     nextStepTest(currentBlock, nextBlock, 'grid', url, title, desc)
      //     progressBarHandler(66)
      //     show(step3Navigation, 'flex')
      // })

      previousStep(prevtStepbtn, currentBlock, previousBlock, 'grid')
    }

    function step3() {

      let prevtStepbtn = get('button[data-id=step-3-prev]')
      let nextStepbtn = get('button[data-id=step-3-next]')

      let previousBlock = get('.post-form-fields')
      let currentBlock = get('.additiona-form-fields')

      // back to previous step
      previousStep(prevtStepbtn, currentBlock, previousBlock, 'flex')
      prevtStepbtn.addEventListener('click', () => {
        progressBarHandler(33)
      })
      appendMapPopupButtonInto3Step()
      appendMapIntoPopup()
      // create post
      // nextStepbtn.addEventListener('click', ()=>{
      //   setTimeout(()=>{
      //     progressBarHandler(100)
      //   },500) 
      //   alert('Post creater Succesfully')
      // })

    }

    // function clearChecked() {
    //   getAll('input[type=checkbox]:checked').forEach(input => {
    //     input.checked = false
    //   })
    // }

    function goToStepPremium() {
      let prevtStepbtn = get('button[data-id=step-premium-prev]')
      let nextStepbtn = get('button[data-id=step-premium-next]')

      let previousBlock = get('.create-post_type')
      let currentBlock = get('.inner_main_page_section_cls.news_details_main')
      let nextblock = get('.post-form-fields')
      prevtStepbtn.addEventListener('click', hideUnactiveFields)
      previousStep(prevtStepbtn, currentBlock, previousBlock, 'grid')

      //nextStep(nextStepbtn, currentBlock, nextblock, 'flex')
      nextStepbtn.addEventListener('click', (e) => {
        e.preventDefault()

        if (getAll('input[type=checkbox]:checked').length == 0) { // check does user select any checkbox
          toastr["warning"]('Choose what you are looking for')
        }

        /**
         * FIND SOMEONE
         */
        else if (isVisible('.elem-Findsomeone')) { // condition for Find some one
          if (isEmpty('input#acf-field_625361291f481')) {
            toastr["warning"]('Tell about yourself.')
          } else if (isEmpty('input#acf-field_6253614e1f482')) {
            toastr["warning"]('Tell what are you looking for.')
          }
          else {
            hide(currentBlock)
            show(nextblock, 'flex')
          }
        }
        /**
         * Sell
         */
        else if (isVisible('.elem-SellandBuy')) { // condition for Find some one
          if (isEmpty('input#acf-field_625361291f481')) {
            toastr["warning"]('Tell about yourself.')
          } else if (isEmpty('input#acf-field_6253614e1f482')) {
            toastr["warning"]('Tell what are you looking for.')
          }
          else {
            hide(currentBlock)
            show(nextblock, 'flex')
          }
        }

        else if (isVisible('.elem-Hiresomeone')) {  // condition for Hire some one
          if (isEmpty('input#aboutForHire')) {
            toastr["warning"]('Tell about yourself.')
          } else if (isEmpty('input#lookingForHire')) {
            toastr["warning"]('Tell what are you looking for.')
          } else {
            hide(currentBlock)
            show(nextblock, 'flex')
          }
        }
        else {
          hide(currentBlock)
          show(nextblock, 'flex')
        }
      })
    }

    step1()
    step2()
    step3()
    goToStepPremium()

    function popuHandler() {
      let premiumFreatures = get('.post-types.premium')
      premiumFreatures.addEventListener('click', (event) => {
        // let pickedPopap = event.target.dataset.target
        if (event.target.closest('div[data-target]')) {
          progressBarHandler(25)
          let pickedPopap = event.target.closest('div[data-target]').dataset.target
          let premiumForm = get('.inner_main_page_section_cls.news_details_main')
          console.log(pickedPopap)
          switch (pickedPopap) {
            case '#by_found':
              premiumStep(pickedPopap)
              premiumForm.querySelector('h2').textContent = 'Be found'
              premiumForm.querySelector('img.right_icon').src = beFoundImg
              premiumForm.querySelector('.main_audience>h4').textContent = 'Reach'
              //  show(premiumForm.querySelector('.elem-Befound'), 'block')

              premiumForm.querySelector('.block_title>h4').textContent = 'Info'
              show(premiumForm.querySelector('.elem-Befound'), 'block')
              prevPremiumStep('.elem-Befound')
              break;

            case '#find_someone':
              premiumStep(pickedPopap)
              premiumForm.querySelector('h2').textContent = 'Find someone'
              premiumForm.querySelector('img.right_icon').src = findSomeone
              premiumForm.querySelector('h4').textContent = 'Distance'
              // premiumForm.querySelector('.about_fields>h4').textContent = 'Info'

              // hide(premiumForm.querySelector('.block_title'))

              show(premiumForm.querySelector('.elem-Findsomeone'), 'block')
              prevPremiumStep('.elem-Findsomeone')
              break;

            case '#buy_and_sell':
              premiumStep(pickedPopap)
              let checkboxes = premiumForm.querySelector('.elem-SellandBuy')
              premiumForm.querySelector('h2').textContent = 'Sell'
              premiumForm.querySelector('img.right_icon').src = buyAndSell
              premiumForm.querySelector('h4').textContent = 'Reach'

              show(checkboxes, 'block')
              prevPremiumStep('.elem-SellandBuy')

              break;
            case '#host_event':
              premiumStep(pickedPopap)
              premiumForm.querySelector('h2').textContent = 'Event'
              premiumForm.querySelector('img.right_icon').src = hostEvent
              premiumForm.querySelector('h4').textContent = 'Audience'
              premiumForm.querySelector('.block_title>h4').textContent = 'Info'
              // show(premiumForm.querySelector('.block_title'), 'block')
              show(premiumForm.querySelector('.elem-Checkbox'), 'block')
              prevPremiumStep('.elem-Checkbox')

              break;
            case '#news_modal':
              premiumStep(pickedPopap)
              premiumForm.querySelector('h2').textContent = 'News'
              premiumForm.querySelector('img.right_icon').src = postNews
              premiumForm.querySelector('h4').textContent = 'Audience'

              // show(premiumForm.querySelector('.block_title'), 'block')
              show(premiumForm.querySelector('.elem-News'), 'block')
              prevPremiumStep('.elem-News')

              break;
            case '#hire_someone':
              premiumStep(pickedPopap)
              premiumForm.querySelector('h2').textContent = 'Hire someone'
              premiumForm.querySelector('img.right_icon').src = postNews
              premiumForm.querySelector('h4').textContent = 'Location range'
              premiumForm.querySelector('.block_title>h4').textContent = 'Skill'

              show(premiumForm.querySelector('.elem-Hiresomeone'), 'block')
              prevPremiumStep('.elem-Hiresomeone')

              break;
          }
        }
      })
    }
    popuHandler()

    function premiumStep(picked) {
      let popup = get(picked)
      let userFrowerBtn = popup.querySelector('.flower-btn')
      let closeBtn = popup.querySelector('button.btn.btn-danger')
      userFrowerBtn.addEventListener('click', () => {
        closeBtn.click()
        show(get('.inner_main_page_section_cls.news_details_main'), 'block')
        hide(get('section.create-post_type'))
      })
    }
    function prevPremiumStep(premiumType) {
      // let premiumForm = get('.post-types.premium')
      get('button[data-id=step-2-prev]').addEventListener('click', () => {
        show(get('.inner_main_page_section_cls.news_details_main'), 'block')
        hide(get('section.post-form-fields'))
        hide(get('.create-post_type'))
        show(document.querySelector(premiumType), 'block')
      }, { once: true })
    }

    function appendMapPopupButtonInto3Step() {
      let FieldWhereNeedAppendBtn = document.querySelector('.acf-field.acf-field-button-group.acf-field-624a5015efb23>.acf-input')
      let LocationPopupBtn = `
      <button type="button" class="btn btn-primary map-button" data-toggle="modal" data-target="#map-popup">
        Location
      </button>
      `
      FieldWhereNeedAppendBtn.innerHTML = LocationPopupBtn
    }
    function appendMapIntoPopup() {
      let map = get('.acf-field.acf-field-google-map.acf-field-624a4e9f377db')
      let popup = get('.acf-map')
      popup.append(map)

      let locationCountryArea = get('.location-country')
      let countryList = get('div[data-name=f_country]')
      locationCountryArea.append(countryList)

      console.log(locationCountryArea, countryList)
    }

    function progressBarHandler(step) {
      return get('.progress-bar.active').style.width = + step + '%'
    }

    function makeAllTabsActive() {
      let tabBlock = document.querySelector('ul.acf-hl.acf-tab-group')
      tabBlock?.querySelectorAll('li').forEach(tab => {
        tab.classList.add('active')
      })
    }
    makeAllTabsActive()

  } catch (e) { console.log(e) }



})

