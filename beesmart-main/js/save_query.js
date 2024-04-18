window.addEventListener('load',()=>{

  host = window.location.href

  let searchString = ''
  let url = new URL(host)
  console.log(host)
  function saveQuery(){
    try{
      // const saveBtn = document.querySelector('#save-search-query')
      const urlField = document.querySelector('.feed-page>.container>div#buddyforms_form_hero_save-search-query>.form_wrapper.clearfix>form#buddyforms_form_save-search-query>fieldset>.col-xs-12.bf-start-row>.bf_field_group.elem-post_excerpt>.bf-input>.bf_field_group.bf_form_content>.bf_inputs.bf-input>div#wp-post_excerpt-wrap>div#wp-post_excerpt-editor-container>textarea#post_excerpt')
      console.log(urlField)
        urlField.value = host
        urlField.textContent = host

      
    } catch(e){}
  }

  // this function adds a request link to the request save
  function openLink(){
    try{
    const titles = document.querySelectorAll('.item-title>a')
    const link = document.querySelectorAll('.item-desc')

      for (let i = 0; i< link.length; i++){
        for (let i = 0; i<titles.length; i++ ){
          link[i].outerHTML = `<a class="query-link" id="feed${titles[i].textContent.trim()}" href="${link[i].innerHTML}">`+ titles[i].textContent + ` </a>`
          titles[i].style.display = 'none'
        }
      }

      }catch(e){}
  }
  // setTimeout(openLink, 3000)

  // this function simply adds a button that goes to a blank search page
  function clearQuery(){
    try{
      const searchForm = document.querySelector('.gmw-form')
      const clearBtn = document.createElement('a')
      clearBtn.classList.add('clear_query')
      clearBtn.textContent = 'clear'
      clearBtn.href = 'https://beesm.art/feed-2/'
      
      searchForm.before(clearBtn)
    } catch(e){}

  }
  // setTimeout(clearQuery, 3000)


  function acceptValue(){
    
    try{
    
    const searchForm = {
      keyword:  document.querySelector('#gmw-keywords-4'),
      country:  document.querySelector('#gmw-address-field-4'),
      category: document.querySelector('#category-taxonomy-4'),
      tag:      document.querySelector('#post_tag-taxonomy-4'),
      type:     document.querySelector('#gmw-cf-Choose-Type-4'),
      price:    document.querySelector('#gmw-cf-Price-4'),
      date:     document.querySelector('#gmw-cf-Date-4'),
      condition:document.querySelector('#gmw-cf-Condition-4')
    }

    if ( url.search.indexOf('&') !== -1 ){
      searchString = url.search.slice(1).split('&')
    }
    else {
      searchString = url.search.slice(1).split('&amp;')
    }
    
    // add selection
    function makeMultiSelect(field, listName){
      try{
        field.setAttribute('list', listName)
      } catch(e){}
    }

    setTimeout( ()=> makeMultiSelect(searchForm.type , 'chooseType'), 3000)
    setTimeout( ()=> makeMultiSelect(searchForm.condition , 'condition'), 3000)
    // end add selection

    const res = searchStringToObj(searchString)
    decodeURI(res)
    console.log(res)


    if (res.hasOwnProperty('address%5B0%5D') && res['address%5B0%5D'] !== undefined){
      searchForm.country.value.replace(/%2C/g, ',') = decodeURI(res['address%5B0%5D'])
    } else if (res.hasOwnProperty('address0') && res['address0'] !== undefined) {
      searchForm.country.value = decodeURI(res['address0'])
    } else {
      // console.log('has no property') 
      }


    if (res.hasOwnProperty('tax%5Bcategory%5D%5B0%5D') && res['tax%5Bcategory%5D%5B0%5D'] !== undefined){
      searchForm.category.value = res['tax%5Bcategory%5D%5B0%5D']
    } else if (res.hasOwnProperty('taxcategory0') && res['taxcategory0'] !== undefined){
      searchForm.category.value = res['taxcategory0']
    } else {
    }


    if (res.hasOwnProperty('tax%5Bpost_tag%5D%5B0%5D') && res['tax%5Bpost_tag%5D%5B0%5D'] !== undefined){
      searchForm.tag.value = res['tax%5Bpost_tag%5D%5B0%5D']
    } else if (res.hasOwnProperty('taxpost_tag0') && res['taxpost_tag0'] !== undefined){
      searchForm.tag.value = res['taxpost_tag0']
    } else {
    }


    if (res.hasOwnProperty('cf%5Bchoose_type%5D') && res['cf%5Bchoose_type%5D'] !== undefined){
      searchForm.type.value = res['cf%5Bchoose_type%5D']
    } else if (res.hasOwnProperty('cfchoose_type') && res['cfchoose_type'] !== undefined){
      searchForm.type.value = res['cfchoose_type']
    } else {
    }

    // price
    if (res.hasOwnProperty('cf%5BPrice%5D') && res['cf%5BPrice%5D'] !== undefined){
      searchForm.price.value = res['cf%5BPrice%5D']
    } else if (res.hasOwnProperty('cfPrice') && res['cfPrice'] !== undefined){
      searchForm.price.value = res['cfPrice']
    } else {
    }

    // condition 
    if (res.hasOwnProperty('cf%5BCondition%5D') && res['cf%5BCondition%5D'] !== undefined){
      searchForm.condition.value = res['cf%5BCondition%5D']
    } else if (res.hasOwnProperty('cfCondition') && res['cfCondition'] !== undefined){
      searchForm.condition.value = res['cfCondition']
    } else {
    }

    // date
    if (res.hasOwnProperty('cf%5BDate%5D') && res['cf%5BDate%5D'] !== undefined){
      searchForm.date.value = res['cf%5BDate%5D']
    } else if (res.hasOwnProperty('cfDate') && res['cfDate'] !== undefined){
      searchForm.date.value = res['cfDate']
    } else {
    }



    // show or hide additional fields 
    function showAdditionalField2(field, x, subfield){
      if (field.value == x){
        subfield.classList.add('active')
      } else {
        subfield.classList.remove('active')
      }
    }

      // price
    searchForm.category.addEventListener('change', ()=> showAdditionalField2(
      searchForm.category, 64, document.querySelector('.gmw-form-field-wrapper.custom-field.Price.CHAR')
      ))

      // condition
    searchForm.category.addEventListener('change', ()=> showAdditionalField2(
      searchForm.category, 64, document.querySelector('.gmw-form-field-wrapper.custom-field.Condition.CHAR')
      ))

    // date
    searchForm.category.addEventListener('change', ()=> showAdditionalField2(
      searchForm.category, 82, document.querySelector('.gmw-form-field-wrapper.custom-field.Date.CHAR')
      ))

    // end show or hide additional fields 
    } catch(e){}
  }
  // window.addEventListener('load', acceptValue)
  // setTimeout(acceptValue, 4000)

  // cut shearch query
  function searchStringToObj(s){
    return s.reduce((accum, item) => {
      item = item.split('=')
      accum[item[0]] = item[1]
      return accum
    },  {})
  }


  window.addEventListener('load', function(){
    try{

    const savedLinks = document.querySelectorAll('.query-link')
      
    savedLinks.forEach(link =>{
      link.addEventListener('click', saveToLocalStorage)
    })

    function saveToLocalStorage(event){
      localStorage.setItem('savedFeed', event.target.id)
      console.log(event.target.id)
    }
    function appendLocalStorage(){
      if (localStorage.getItem('savedFeed') != null){
        document.querySelector('#'+localStorage.getItem('savedFeed')).classList.add('active-saved-search') 
      }
    }
    appendLocalStorage()
    } catch(e){}
  })

  function deleteTextOnDeleteFeedBtn(){
    const btns = document.querySelectorAll('.bf_delete_post')
    btns.forEach(btn =>{
      btn.textContent = ''
    })
  }

  // ================= choose icon script ======================= //

  let chooseIconTemp = `
  <div class="save_icons_block">
    <div class="icon_item" id="">
    <img data-id="1rwcwwcq" src="https://beesm.art/wp-content/uploads/2021/11/cooking.svg">
    </div>
    <div class="icon_item" id="">
      <img data-id="2wqdqwta" src="https://beesm.art/wp-content/uploads/2021/11/books.svg">
    </div>
    <div class="icon_item" id="">
      <img data-id="3fwqgag3" src="https://beesm.art/wp-content/uploads/2021/11/fantasy.svg">
    </div>
    <div class="icon_item" id="">
    <img data-id="4kiwhfveg" src="https://beesm.art/wp-content/uploads/2021/11/diy.svg">
    </div>
    <div class="icon_item" id="">
    <img data-id="5jboavgaq" src="https://beesm.art/wp-content/uploads/2021/11/gym.svg">
    </div>
    <div class="icon_item" id="">
    <img data-id="6dsgdsdsf" src="https://beesm.art/wp-content/uploads/2021/11/Raccoon.svg">
    </div>
    <div class="icon_item" id="">
    <img data-id="7asfhashg" src="https://beesm.art/wp-content/uploads/2021/11/tiger.svg">
    </div>
    <div class="icon_item" id="">
    <img data-id="8dsafgsas" src="https://beesm.art/wp-content/uploads/2021/11/potatos.svg">
    </div>
    <div class="icon_item" id="">
    <img data-id="9daswfvac" src="https://beesm.art/wp-content/uploads/2021/11/cirle.svg">
    </div>
    <div class="icon_item" id="">
    <img data-id="10fasdasgf" src="https://beesm.art/wp-content/uploads/2021/11/berry.svg">
    </div>
  </div>
  `

  function appendIcons(){
    try{
      const btn = document.querySelector('.form-actions.col-xs-12')
      btn.insertAdjacentHTML('beforebegin', chooseIconTemp)
    } catch(e){}
  }

  function makeIconActive(){
    try{

      const iconBlock = document.querySelector('.save_icons_block'),
            iconItems = document.querySelectorAll('.icon_item'),
          nativeItems = document.querySelectorAll('.col-xs-12.col-Save_with_icon.bf-start-row>.bf_field_group.elem-RadioButton>.bf-input>.radio>label.settings-input.form-control.Save_with_icon>input[data-form="save-search-query"]')

    iconBlock.addEventListener('click', (event)=>{
      if(event.target.parentNode.classList.contains('icon_item')){
        removeNotActiveIcons(iconItems)
        event.target.parentNode.classList.add('active_icon')
        findActive(nativeItems)
      }
    })
    console.log(iconBlock)
    } catch(e){}
  }
  function removeNotActiveIcons(icons){
    icons.forEach(icon => icon.classList.remove('active_icon') )
  }
  function findActive(items){
    items.forEach(item => {
      if (item.defaultValue === event.target.dataset.id){
        item.click()
      }
    })
  }
  // ================= ! choose icon script END ======================= //


  // window.addEventListener('load', appendIcons)
  // setTimeout(makeIconActive, 15000)

  window.addEventListener('load', ()=>{
    saveQuery()
    openLink()
    clearQuery()
    acceptValue()

    appendIcons()
    makeIconActive()
    // deleteTextOnDeleteFeedBtn()
  })

})