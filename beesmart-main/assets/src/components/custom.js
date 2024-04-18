// window.addEventListener('load', ()=>{
import { get, getAll, hide } from '../utilities'



function hamburgerHandler() {
  const hamburgerBtn = document.querySelector('button.hamburger-btn')
  const sideBar = document.querySelector('div#cutom_frontend_sidebar')
  hamburgerBtn?.addEventListener('click', () => {
    sideBar.style.display == 'none' ?
      sideBar.style.display = 'block' :
      sideBar.style.display = 'none'
  })
}


function showSavePopup() {
  try {
    let nativeBtn = document.querySelector('span.um-profile-photo-overlay'),
      customBtn = document.querySelector('button.btn.btn-primary[data-target="#upload-url-avatar"]')
    console.log(nativeBtn, customBtn)
    nativeBtn.addEventListener('click', (e) => {
      console.log(e.target)
      customBtn.click()
    })
  } catch (e) {
    console.log(e)
  }
}


function checkDirection() {
  try {
    let neededPathname = /user/
    let currentPathname = url.pathname
    let editPersonalInfoBlock = document.querySelector('.um-profile-body.main.main-default')
    // let result = currentPathname.match(neededPathname)
    if (currentPathname.match(neededPathname) && !url.search) {
      let profileCoverImage = document.querySelector('.profile_page>.cover_img')
      let settingsButton = document.querySelector('.um-profile-edit')

      $('.um-profile-body.main.main-default').hide()
      profileCoverImage.append(settingsButton)
      $('.um.um-profile').hide()
    }
    if (currentPathname.match(neededPathname) && url.search) {
      // $('.profile_tabs').hide()
      // $('.add_to_section').hide()
      $('.um-cover.has-cover.um-trigger-menu-on-click').hide()
      $('.um-header').hide()
      $('.div#myTabContent').hide()
      editPersonalInfoBlock.setAttribute('style', 'display:block !important');
    }
  } catch (e) { }
}
// .Save-Cover-image 
// input#Cover-image-url-73


function notificationsHandler() {
  // let btn = document.querySelector('.menu-item.notifications')
  document.querySelector('.menu-item.notifications')?.addEventListener('click', () => {
    document.querySelector('.um-notification-b').click()
  })
}





// If the user clicks the activation link a second time, he will be redirected to the home page
function redirectToFrontPage() {
  let siteURL = location.origin
  let regExp = /act=activate_via_email/
  let url = window.location
  if (regExp.test(url.search)) {
    setTimeout(url.replace(siteURL), 300)
  }
}
redirectToFrontPage()

function customBugRepHandler() {
  try {
    document.querySelector('.custom-report-button').addEventListener('click', () => {
      document.querySelector('iframe[name=us-entrypoint-buttonV2]').contentWindow.document.querySelector('.container').click()
    })
  } catch (e) { console.log(e) }
}

function miniChatHandler() {
  try {
    let miniChatBtn = document.querySelector('.chat-button')
    let chatTab = document.querySelector('div[data-tab=messages]')
    let miniChat = document.querySelector('div.messages')
    let wholeBlock = document.querySelector('.bp-messages-wrap.bp-better-messages-list')
    miniChatBtn.addEventListener('click', () => {
      if (miniChat.classList.contains('active')) {
        miniChat.classList.remove('active')
        chatTab.style.transform = 'translate(0px, 50px)'
        wholeBlock.classList.remove('active')
      } else {
        miniChat.classList.add('active')
        chatTab.classList.add('active')
        chatTab.style.transform = 'translate(0px, 0px)'
      }
    })
    /**
     * native close btn and messases tab
     */
    document.querySelector('div[data-tab=bpbm-close]').addEventListener('click', () => {
      chatTab.style.transform = 'translate(0px, 50px)'
    })
    document.querySelector('div[data-tab=messages]').addEventListener('click', () => {
      chatTab.style.transform = 'translate(0px, 50px)'
    })
  } catch (e) {
    console.log(e)
  }
}

// acf_form function generate custom field where exist uneeded label
function removeAllLabelsFromAcfAutoRender() {
  document.querySelectorAll('.acf-label').forEach(el => {
    el.remove()
  })
}

function navigation() {
  if (get('ul#myTab')) {
    get('ul#myTab').addEventListener('click', (e) => {
      if (e.target.closest('button[data-toggle=tab]')) {
        getAll('div[role=tabpanel], button[data-toggle=tab]').forEach(el => {
          el.classList.remove('active')
        })
        e.target.classList.add('active')
      }
    })
  }
}

function closeHivePopup() {
  get('body')?.addEventListener('click', (e) => {
    if (e.target.closest('.hive_icon')) {
      let hideBtn = e.target.closest('.hivvdropdown')
      hideBtn.classList.add('hidden')
      // hide(e.target.closest('.hivvdropdown'))
    }
  })
}


window.addEventListener('load', () => {

  closeHivePopup()
  navigation()
  // removeAllLabelsFromAcfAutoRender()
  hamburgerHandler()
  // urlAvatarHandler()
  // urlCoverImageHandler()
  showSavePopup()
  checkDirection()
  notificationsHandler()

  miniChatHandler()
  setTimeout(() => {
    customBugRepHandler()
  }, 2000)

})
