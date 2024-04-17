"use strict";

/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */

/******/
(function () {
  // webpackBootstrap

  /******/
  var __webpack_modules__ = {
    /***/
    "./src/components/create.component.js":
    /*!********************************************!*\
      !*** ./src/components/create.component.js ***!
      \********************************************/

    /***/
    function srcComponentsCreateComponentJs(__unused_webpack_module, __webpack_exports__, __webpack_require__) {
      "use strict";

      eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"CreateComponent\": () => (/* binding */ CreateComponent)\n/* harmony export */ });\n/* harmony import */ var _core_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../core/component */ \"./src/core/component.js\");\n/* harmony import */ var _core_form__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../core/form */ \"./src/core/form.js\");\n/* harmony import */ var _core_validators__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../core/validators */ \"./src/core/validators.js\");\n\r\n\r\n\r\n// import { Progres } from '../core/progres'\r\n\r\nclass CreateComponent extends _core_component__WEBPACK_IMPORTED_MODULE_0__.Component {\r\n  constructor(id) {\r\n    super(id)\r\n  }\r\n\r\n  init() {\r\n\r\n    // window.addEventListener('load', function(){\r\n      // $(document).ready(function(){\r\n      document.querySelector('.next_to_3_step')?.addEventListener('click', submitHandler.bind(this))\r\n\r\n      this.form = new _core_form__WEBPACK_IMPORTED_MODULE_1__.Form(this.$el, {\r\n        f_url: [_core_validators__WEBPACK_IMPORTED_MODULE_2__.Validators.url, _core_validators__WEBPACK_IMPORTED_MODULE_2__.Validators.minLength(10), _core_validators__WEBPACK_IMPORTED_MODULE_2__.Validators.isUrl],\r\n        title: [_core_validators__WEBPACK_IMPORTED_MODULE_2__.Validators.title],\r\n        fulltext: [_core_validators__WEBPACK_IMPORTED_MODULE_2__.Validators.required, _core_validators__WEBPACK_IMPORTED_MODULE_2__.Validators.description(10)]\r\n      })\r\n      \r\n      // console.log(Progres)\r\n    // })\r\n  }\r\n\r\n}\r\n\r\nfunction progresHandle(step, selector){\r\n  return document.querySelector(selector).style.width =+ step + '%'\r\n}\r\nfunction nextStepTest(currentStep, nextStep, type){\r\n  hide(currentStep)\r\n  show(nextStep, type)\r\n}\r\nfunction nextStepNumber3(currentStep, nextStep, type){\r\n  hide(document.querySelector(currentStep))\r\n  show(document.querySelector(nextStep), type)\r\n}\r\nfunction hide(el){\r\n  el.style.display = 'none'\r\n}\r\nfunction show(el, type){\r\n  el.style.display = type\r\n}\r\nfunction submitHandler(event) {\r\n  event.preventDefault()\r\n  if (this.form.isValid()) {\r\n    const formData = {\r\n      ...this.form.value()\r\n    }\r\n    progresHandle(66, '.progress-bar.active')\r\n    nextStepNumber3('.post-form-fields', '.additiona-form-fields', 'grid')\r\n    // this.form.clear()\r\n    console.log('step-2', formData)\r\n  } \r\n  // else {\r\n  //   $(document).ready(function onDocumentReady() {\r\n  //     toastr.success('Fill all fields');\r\n  //   });\r\n  // }\r\n}\n\n//# sourceURL=webpack:///./src/components/create.component.js?");
      /***/
    },

    /***/
    "./src/components/infoTab.component.js":
    /*!*********************************************!*\
      !*** ./src/components/infoTab.component.js ***!
      \*********************************************/

    /***/
    function srcComponentsInfoTabComponentJs() {
      eval("window.addEventListener('load', ()=>{\r\n    function displayForm(){\r\n        document.querySelector('button#show_form_btn')?.addEventListener('click',()=>{\r\n            let form = document.querySelector('#bees_add_info_form')\r\n            form.style.display == 'none' ? \r\n            form.style.display = 'block' :\r\n            form.style.display = 'none'\r\n        })\r\n    }\r\n    displayForm()\r\n})\r\n\r\n$('body').on('click', '#bees_create_info', function() {\r\n    let posttitle=$(\"#info_post_type_title\").val(),\r\n        description=$(\"#info_post_type_description\").val(),\r\n        userId=$(\"#bees_info_user_id\").val(),\r\n        imageByUrl=$(\"#info_post_type_image_by_url\").val()\r\n    $.ajax({\r\n        type : \"POST\",\r\n        // dataType : \"json\",\r\n        url : \"https://beesmart.local/wp-json/beesmart/v1/info/create\",\r\n        data : {\r\n            'title':posttitle,\r\n            'content': description,\r\n            'bees_info_user_id': userId,\r\n            'meta_image_by_url':imageByUrl\r\n        },\r\n                beforeSend: function(){\r\n                    // Show image container\r\n                    $(\".loader\").show();\r\n                },\r\n                success: function(response) {\r\n                    toastr.success('Info added successfully');\r\n                    $('#bees_add_info_form').hide()\r\n                    console.log(response)\r\n                    // window.location.reload()\r\n                    },\r\n                complete:function(data){\r\n                    // Hide image container\r\n                    $(\".loader\").hide();\r\n                    console.log(data)\r\n                }\r\n        });\r\n})\r\n\n\n//# sourceURL=webpack:///./src/components/infoTab.component.js?");
      /***/
    },

    /***/
    "./src/components/mapPopup.component.js":
    /*!**********************************************!*\
      !*** ./src/components/mapPopup.component.js ***!
      \**********************************************/

    /***/
    function srcComponentsMapPopupComponentJs() {
      eval("window.addEventListener('load', ()=>{\r\n    if(document.querySelector('div#map-popup')){\r\n        let mapPopup = document.querySelector('div#map-popup')\r\n        function checkAgreement(){\r\n            mapPopup.querySelector('input#geo-agreement')?.addEventListener('click', ()=>{\r\n                let agreeCheckbox = mapPopup.querySelector('input#geo-agreement')\r\n                let finisBtn = mapPopup.querySelector('#closeMap')\r\n                agreeCheckbox.checked ? removeDisabledAttr(finisBtn) : addDisabledAttr(finisBtn)\r\n            })\r\n        }\r\n    checkAgreement()\r\n    }\r\n\r\n    function removeDisabledAttr(el){\r\n        el.removeAttribute('disabled')\r\n    }\r\n    function addDisabledAttr(el){\r\n        el.setAttribute('disabled', 'disabled')\r\n    }\r\n\r\n})\n\n//# sourceURL=webpack:///./src/components/mapPopup.component.js?");
      /***/
    },

    /***/
    "./src/core/component.js":
    /*!*******************************!*\
      !*** ./src/core/component.js ***!
      \*******************************/

    /***/
    function srcCoreComponentJs(__unused_webpack_module, __webpack_exports__, __webpack_require__) {
      "use strict";

      eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"Component\": () => (/* binding */ Component)\n/* harmony export */ });\nclass Component {\r\n  constructor(id) {\r\n    window.addEventListener('load', ()=>{\r\n      this.$el = document.getElementById(id)\r\n      this.init()\r\n    })\r\n  }\r\n\r\n  init() {}\r\n\r\n  hide() {\r\n    this.$el.classList.add('hide')\r\n  }\r\n\r\n  show() {\r\n    this.$el.classList.remove('hide')\r\n  }\r\n}\n\n//# sourceURL=webpack:///./src/core/component.js?");
      /***/
    },

    /***/
    "./src/core/form.js":
    /*!**************************!*\
      !*** ./src/core/form.js ***!
      \**************************/

    /***/
    function srcCoreFormJs(__unused_webpack_module, __webpack_exports__, __webpack_require__) {
      "use strict";

      eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"Form\": () => (/* binding */ Form)\n/* harmony export */ });\n// import { Z_STREAM_ERROR } from \"zlib\";\r\n\r\nclass Form {\r\n  constructor(form, controls) {\r\n    this.form = form\r\n    this.controls = controls\r\n  }\r\n\r\n  value() {\r\n    const value = {}\r\n    Object.keys(this.controls).forEach(control => {\r\n      value[control] = this.form[control].value\r\n    })\r\n    return value\r\n  }\r\n\r\n  clear() {\r\n    Object.keys(this.controls).forEach(control => {\r\n      this.form[control].value = ''\r\n    })\r\n  }\r\n\r\n  isValid() {\r\n    let isFormValid = true\r\n\r\n    Object.keys(this.controls).forEach(control => {\r\n      const validators = this.controls[control]\r\n\r\n      let isValid = true\r\n      validators.forEach(validator => {\r\n        isValid = validator(this.form[control].value) && isValid\r\n      })\r\n\r\n      // isValid ? clearError(this.form[control]) : setError(this.form[control])\r\n\r\n      isFormValid = isFormValid && isValid\r\n    })\r\n\r\n    return isFormValid\r\n  }\r\n}\r\n\r\n// function setError($control) {\r\n//   clearError($control)\r\n//   const error = '<p class=\"validation-error\">Введите корректное значение</p>'\r\n//   $control.classList.add('invalid')\r\n//   $control.insertAdjacentHTML('afterend', error)\r\n// }\r\n\r\n// function clearError($control) {\r\n//   $control.classList.remove('invalid')\r\n\r\n//   if ($control.nextSibling) {\r\n//     $control.closest('.form-control').removeChild($control.nextSibling)\r\n//   }\r\n// }\n\n//# sourceURL=webpack:///./src/core/form.js?");
      /***/
    },

    /***/
    "./src/core/validators.js":
    /*!********************************!*\
      !*** ./src/core/validators.js ***!
      \********************************/

    /***/
    function srcCoreValidatorsJs(__unused_webpack_module, __webpack_exports__, __webpack_require__) {
      "use strict";

      eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"Validators\": () => (/* binding */ Validators)\n/* harmony export */ });\nclass Validators {\r\n\r\n  static required(value = '') {\r\n    if (value && value.trim()){\r\n      return value && value.trim()\r\n    } \r\n    // else {\r\n    //   toastr[\"warning\"]('not correct');\r\n    // }\r\n  }\r\n\r\n  static title(value = '') {\r\n    if (value && value.trim()){\r\n      return value && value.trim()\r\n    } else {\r\n      toastr[\"warning\"]('Title is required');\r\n    }\r\n  }\r\n\r\n  static url(value = '') {\r\n    if (value && value.trim()){\r\n      return value && value.trim()\r\n    } else {\r\n      toastr[\"warning\"]('Insert link please');\r\n    }\r\n  }\r\n\r\n  static isUrl(value = '') {\r\n    if (value.match('http')){\r\n      return value \r\n    } else {\r\n      toastr[\"warning\"]('Link is not correct');\r\n    }\r\n  }\r\n\r\n  static description(length) {\r\n    return value => {\r\n      if (value.length >= length) {\r\n        return value.length >= length\r\n      } else {\r\n        toastr[\"warning\"]('The description must be at least 10 characters long');\r\n      }\r\n    }\r\n  }\r\n\r\n  static minLength(length) {\r\n    return value => {\r\n      return value.length >= length\r\n    }\r\n  }\r\n\r\n}\n\n//# sourceURL=webpack:///./src/core/validators.js?");
      /***/
    },

    /***/
    "./src/custom.js":
    /*!***********************!*\
      !*** ./src/custom.js ***!
      \***********************/

    /***/
    function srcCustomJs() {
      eval("// window.addEventListener('load', ()=>{\r\n\r\n\r\nhost = window.location.href\r\nlet url = new URL(host)\r\n/* this function simulates step 5 of registration \r\nit turns the profile page into a Step 5 registration page and hides all unnecessary elements */\r\nfunction lastStep() {\r\n  let tag_head = document.getElementsByTagName('head')\r\n  let tag_css = document.createElement('style')\r\n  tag_css.type = 'text/css'\r\n  tag_css.rel = 'stylesheet'\r\n  tag_css.innerHTML = `\r\n  div#um_field_73_nickname_34,\r\n  div#um_field_73_institute,\r\n  div#um_field_73_graduation_date,\r\n  div#um_field_73_qualification,\r\n  div#um_field_73_carrer_location,\r\n  div#um_field_73_employments,\r\n  #um_field_73_nickname,\r\n  #um_field_73_nickname,\r\n  #um_field_73_first_name,\r\n  #um_field_73_last_name,\r\n  #um_field_73_user_url,\r\n  #um_field_73_country,\r\n  #um_field_73_languages,\r\n  #um_field_73_Currency_picker,\r\n  #um_field_73_About_your_business,\r\n  #um_field_73_Choose_Category,\r\n  .um-profile-nav,\r\n  .main-banner,\r\n  .edit-user-work,\r\n  div#um_field_73_services,\r\n  .url-language-duble,\r\n  div#um_field_73_hour_rate,\r\n  div#um_field_73_month_salary{\r\n    display:none;\r\n  }\r\n  .photo-text-set {\r\n    display: flex;\r\n    justify-content: center;\r\n    float: none;\r\n  }\r\n  `\r\n  if (host == `https://${url.pathname}?um_action=edit#UCategories`){\r\n    tag_head[0].appendChild(tag_css)\r\n  }\r\n  console.log('FINISH',url)\r\n}\r\n\r\n// this function shows or hides the list of saved requests on the sidebar\r\nfunction feed_SH(){\r\n  let url = new URL(host)\r\n  if (url.pathname != '/search/'){\r\n    try{\r\n      const showFeedBtn = document.querySelector('.show_feed_btn')\r\n      const feed = document.querySelector('.sidebar_custom_submenu>div#buddyforms-list-view')\r\n      showFeedBtn.addEventListener('click', ()=>{\r\n      if (feed.style.display == 'none'){\r\n        feed.style.display = 'block'\r\n      } else {\r\n        feed.style.display = 'none'\r\n      } \r\n      console.log('click')\r\n      })\r\n    } catch(e){}\r\n  }\r\n}\r\n\r\nfunction hamburgerHandler(){\r\n  const hamburgerBtn = document.querySelector('button.hamburger-btn')\r\n  const sideBar = document.querySelector('div#cutom_frontend_sidebar')\r\n  hamburgerBtn?.addEventListener('click', ()=>{\r\n    sideBar.style.display == 'none' ?\r\n    sideBar.style.display = 'block' :\r\n    sideBar.style.display = 'none'\r\n  })\r\n}\r\n\r\nfunction urlAvatarHandler(){\r\n  try{\r\n\r\n    let customUrl = document.querySelector('input.avatar-meta-url'),\r\n        nativeUrl = document.querySelector('input#user_avatar_url-73'),\r\n        updatebtn = document.querySelector('input[type=submit].um-button'),\r\n  saveAvatarBtn = document.querySelector('button.Save-Url-Avatar.btn.btn-primary')\r\n  customUrl.addEventListener('change', ()=>{\r\n    nativeUrl.value = customUrl.value\r\n    console.log(customUrl.value)\r\n    console.log(nativeUrl.value)\r\n  })\r\n  saveAvatarBtn.addEventListener('click',() =>{\r\n    updatebtn.click()\r\n    })\r\n  } catch(e){console.log(e)}\r\n    // console.log(customUrl)\r\n}\r\nfunction urlCoverImageHandler(){\r\n  try{\r\n\r\n    let customUrl = document.querySelector('input.cover-image-meta-url'),\r\n        nativeUrl = document.querySelector('input#user_cover_image_url-73'),\r\n        updatebtn = document.querySelector('input[type=submit].um-button'),\r\n  saveAvatarBtn = document.querySelector('button.Save-Cover-image.btn.btn-primary')\r\n  customUrl.addEventListener('change', ()=>{\r\n    nativeUrl.value = customUrl.value\r\n    console.log(customUrl.value)\r\n    console.log(nativeUrl.value)\r\n  })\r\n  saveAvatarBtn.addEventListener('click',() =>{\r\n    updatebtn.click()\r\n    })\r\n  } catch(e){console.log(e)}\r\n    // console.log(customUrl)\r\n}\r\n\r\n  function showSavePopup(){\r\n    try{\r\n      let nativeBtn = document.querySelector('span.um-profile-photo-overlay'),\r\n          customBtn = document.querySelector('button.btn.btn-primary[data-target=\"#upload-url-avatar\"]')\r\n          console.log(nativeBtn,customBtn)\r\n      nativeBtn.addEventListener('click',(e)=>{\r\n        console.log(e.target)\r\n        customBtn.click()\r\n      })\r\n      } catch(e){\r\n        console.log(e)\r\n      }\r\n  }\r\n\r\n\r\n  function checkDirection(){\r\n    let neededPathname = /user/\r\n    let currentPathname =  url.pathname\r\n    // let result = currentPathname.match(neededPathname)\r\n    if(currentPathname.match(neededPathname) && !url.search){\r\n      let profileCoverImage = document.querySelector('.profile_page>.cover_img')\r\n      let settingsButton = document.querySelector('.um-profile-edit')\r\n      $('.um-profile-body.main.main-default').hide()\r\n      let js = document.querySelector('.um-profile-body.main.main-default')\r\n      // $('div#info').append(js)\r\n      profileCoverImage.append(settingsButton)\r\n      $('.um.um-profile').hide()\r\n    }\r\n    if(currentPathname.match(neededPathname) && url.search){\r\n      // $('.profile_tabs').hide()\r\n      $('.add_to_section').hide()\r\n      $('.um-cover.has-cover.um-trigger-menu-on-click').hide()\r\n      $('.um-header').hide()\r\n      $('.div#myTabContent').hide()\r\n    }\r\n  }\r\n// .Save-Cover-image \r\n// input#Cover-image-url-73\r\n\r\n\r\nfunction notificationsHandler(){\r\n  // let btn = document.querySelector('.menu-item.notifications')\r\n  document.querySelector('.menu-item.notifications')?.addEventListener('click',()=>{\r\n    document.querySelector('.um-notification-b.right').click()\r\n  })\r\n \r\n}\r\n\r\n\r\nfunction uploadAvatarUrl(selector, container) {\r\n  let link = document.querySelector(selector),\r\n      containerResponse = document.querySelector(container)\r\n\r\n  if( typeof(link) != 'undefined' && link != null){\r\n    link.addEventListener('change', ()=> {\r\n    let val = link.value\r\n      if( val != '' && val.indexOf(\"://\")>-1) {                            \r\n\r\n        $(containerResponse).html('<img src=\"https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif?20151024034921\" alt=\"loading\" class=\"resposne-url-avatar\">');\r\n        // $('.loading').text('Loading...');\r\n        //$('.container-resposne-avatar').hide();\r\n        $.ajax({\r\n              type:'post',\r\n              url:'/wp-admin/admin-ajax.php',\r\n              data:{\r\n                action:'upload_img_by_url',\r\n                link:val\r\n              },\r\n          cache: false,\r\n          success:function(response) {\r\n            $('.loading').text('');\r\n            $(containerResponse).show();\r\n            $(containerResponse).html(response);\r\n              }\r\n            });\r\n      }\r\n      });\r\n    }\r\n}\r\n\r\n// If the user clicks the activation link a second time, he will be redirected to the home page\r\nfunction redirectToFrontPage(){\r\n  let regExp = /act=activate_via_email/\r\n  let url = window.location \r\n  if (regExp.test(url.search)){\r\n      setTimeout(url.replace('https://beesmartstg.wpengine.com/'), 300)\r\n  }\r\n}\r\nredirectToFrontPage()\r\n\r\nwindow.addEventListener('load', ()=>{\r\n  // lastStep()\r\n  // feed_SH()\r\n  hamburgerHandler()\r\n  urlAvatarHandler()\r\n  urlCoverImageHandler()\r\n  showSavePopup()\r\n  checkDirection()\r\n  notificationsHandler()\r\n  uploadAvatarUrl('input.avatar-meta-url', '.container-response-avatar') // avatar\r\n  uploadAvatarUrl('input.cover-image-meta-url', '.container-response-cover-image') // cover\r\n})\r\n// if ()\r\n// $('div#info').append($('.um-profile-body.main.main-default'))  \r\n\r\n\r\n\r\n\r\n// })\n\n//# sourceURL=webpack:///./src/custom.js?");
      /***/
    },

    /***/
    "./src/index.js":
    /*!**********************!*\
      !*** ./src/index.js ***!
      \**********************/

    /***/
    function srcIndexJs(__unused_webpack_module, __webpack_exports__, __webpack_require__) {
      "use strict";

      eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _custom__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./custom */ \"./src/custom.js\");\n/* harmony import */ var _custom__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_custom__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _post_form__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./post_form */ \"./src/post_form.js\");\n/* harmony import */ var _post_form__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_post_form__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _components_mapPopup_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/mapPopup.component */ \"./src/components/mapPopup.component.js\");\n/* harmony import */ var _components_mapPopup_component__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_components_mapPopup_component__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var _components_infoTab_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/infoTab.component */ \"./src/components/infoTab.component.js\");\n/* harmony import */ var _components_infoTab_component__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_components_infoTab_component__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var _components_create_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/create.component */ \"./src/components/create.component.js\");\n\r\n\r\n\r\n\r\n\r\n// import {CreateStep3Component} from './components/createStep3.component'\r\n\r\n\r\nnew _components_create_component__WEBPACK_IMPORTED_MODULE_4__.CreateComponent('step-2')\r\n// new CreateStep3Component('acf-form')\n\n//# sourceURL=webpack:///./src/index.js?");
      /***/
    },

    /***/
    "./src/post_form.js":
    /*!**************************!*\
      !*** ./src/post_form.js ***!
      \**************************/

    /***/
    function srcPost_formJs() {
      eval("window.addEventListener('load', ()=>{\r\n\r\n  let url = new URL(host)\r\n  let beFoundImg = `${url.origin}/wp-content/uploads/2022/01/Be-found1.png`\r\n  let findSomeone = `${url.origin}/wp-content/uploads/2022/01/Find1.png`\r\n  let buyAndSell = `${url.origin}/wp-content/uploads/2022/01/Create-Button-Sell.png`\r\n  let hostEvent = `${url.origin}/wp-content/uploads/2022/01/Create-Button-Event.png`\r\n  let postNews = `${url.origin}/wp-content/uploads/2022/01/Create-Button-News.png`\r\n  let hireSomeone = `${url.origin}/wp-content/uploads/2022/01/Create-Button-Hire.png`\r\n\r\n  try{\r\n    const get = (el) => {\r\n      return document.querySelector(el)\r\n    }\r\n    const getAll = (el) =>{\r\n      return document.querySelectorAll(el)\r\n    }\r\n    function hide(el){\r\n      el.style.display = 'none'\r\n    }\r\n    function show(el, type){\r\n      el.style.display = type\r\n    }\r\n\r\n\r\n    function nextStepTest(currentStep, nextStep, type, ...args){\r\n        console.log(args)\r\n        args.forEach(arg => {\r\n          return arg.length > 0\r\n        })\r\n        if (arg.length >= 3) {\r\n          hide(currentStep)\r\n          show(nextStep, type)\r\n        } else {\r\n          alert('not valid')\r\n        }\r\n    }\r\n\r\n    function nextStep(btn, currentStep, nextStep, type){\r\n      btn.addEventListener('click', (e) => {\r\n        e.preventDefault()\r\n        hide(currentStep)\r\n        show(nextStep, type)\r\n      })\r\n    }\r\n    function previousStep(btn, currentStep, prevStep, type){\r\n      btn.addEventListener('click', (e) => {\r\n        e.preventDefault()\r\n        hide(currentStep)\r\n        show(prevStep, type)\r\n      })\r\n    }\r\n\r\n    function removeNotActiove(){\r\n      const allTypes = getAll('.post-item')\r\n      allTypes.forEach(el => el.classList.remove('active-post-type'))\r\n    }\r\n    function hideUnactiveFields(){\r\n      let unactiveFields = [\r\n        '.elem-Befound',\r\n        '.elem-Findsomeone',\r\n        '.elem-SellandBuy',\r\n        '.elem-Checkbox',\r\n        '.elem-News',\r\n        '.elem-Hiresomeone',\r\n      ]\r\n      unactiveFields.forEach( el =>{\r\n        hide(get(el))\r\n      })   \r\n    }\r\n\r\n// end untilits\r\n\r\n\r\n\r\n    function step1(){\r\n      // let nextStepbtn = get('button[data-id=step-1-next]')\r\n      let basicPostFormat = get('div[data-name=basic-formats]')\r\n      // let basicPostFormat = get('div[data-name=basic-formats]')\r\n      let postTypesPremiumBlock = get('.post-types.premium')\r\n\r\n\r\n      let currentBlock = get('.create-post_type')\r\n      let nextblock = get('.post-form-fields')\r\n\r\n      let postFormatField = get('#f_custom_post_format')\r\n      // let premiumPostFormatField = get('#f_premium_custom_post_format')\r\n\r\n      // postTypesBlock.addEventListener('click', setActiveType)\r\n      postTypesPremiumBlock.addEventListener('click', (e)=>{\r\n        if( e.target.classList.contains('modal') ){\r\n          hideUnactiveFields()\r\n        }\r\n        // if(e.target.closest('div[data-post-id]')){\r\n        //   premiumPostFormatField.value = e.target.closest('div[data-post-id]').dataset.postId\r\n        // }\r\n        // console.log(premiumPostFormatField.value)\r\n      })\r\n      basicPostFormat.addEventListener('click', (e)=>{\r\n        progressBarHandler(33)\r\n        if(e.target.closest('div[data-post-id]')){\r\n          postFormatField.value = e.target.closest('div[data-post-id]').dataset.postId\r\n        }\r\n        console.log(postFormatField.value)\r\n      })\r\n      nextStep(basicPostFormat, currentBlock, nextblock, 'flex')\r\n      \r\n    }\r\n\r\n    function step2(){\r\n      let prevtStepbtn = get('button[data-id=step-2-prev]')\r\n      let nextStepbtn = get('button[data-id=step-2-next]')\r\n\r\n      let previousBlock = get('.create-post_type')\r\n      let currentBlock = get('.post-form-fields')\r\n      let nextBlock = get('.additiona-form-fields')\r\n      let step3Navigation =get('.steps-navigation.step-3')\r\n      prevtStepbtn.addEventListener('click', ()=>{\r\n        progressBarHandler(5)\r\n      })\r\n\r\n\r\n      // nextStepbtn.addEventListener('click', ()=>{\r\n      //     let url = document.querySelector('input#f_url').value\r\n      //     let title = document.querySelector('input#posttitle').value\r\n      //     let desc = document.querySelector('textarea#description').value\r\n      //     nextStepTest(currentBlock, nextBlock, 'grid', url, title, desc)\r\n      //     progressBarHandler(66)\r\n      //     show(step3Navigation, 'flex')\r\n      // })\r\n      \r\n      previousStep(prevtStepbtn, currentBlock, previousBlock, 'grid')\r\n    }\r\n\r\n    function step3(){\r\n      \r\n      let prevtStepbtn = get('button[data-id=step-3-prev]')\r\n      let nextStepbtn = get('button[data-id=step-3-next]')\r\n\r\n      let previousBlock = get('.post-form-fields')\r\n      let currentBlock = get('.additiona-form-fields')\r\n\r\n      // back to previous step\r\n      previousStep(prevtStepbtn, currentBlock, previousBlock, 'flex')\r\n      prevtStepbtn.addEventListener('click', ()=>{\r\n        progressBarHandler(33)\r\n      })\r\n      appendMapPopupButtonInto3Step()\r\n      appendMapIntoPopup()\r\n      // create post\r\n      // nextStepbtn.addEventListener('click', ()=>{\r\n      //   setTimeout(()=>{\r\n      //     progressBarHandler(100)\r\n      //   },500) \r\n      //   alert('Post creater Succesfully')\r\n      // })\r\n      \r\n    }\r\n\r\n\r\n    function goToStepPremium(){\r\n      let prevtStepbtn = get('button[data-id=step-premium-prev]')\r\n      let nextStepbtn = get('button[data-id=step-premium-next]')\r\n\r\n      let previousBlock = get('.create-post_type')\r\n      let currentBlock = get('.inner_main_page_section_cls.news_details_main')\r\n      let nextblock = get('.post-form-fields')\r\n      prevtStepbtn.addEventListener('click', hideUnactiveFields)\r\n      previousStep(prevtStepbtn, currentBlock, previousBlock, 'grid')\r\n      nextStep(nextStepbtn, currentBlock, nextblock, 'flex')\r\n\r\n    }\r\n\r\n    step1()\r\n    step2()\r\n    step3()\r\n    goToStepPremium()\r\n\r\n    function popuHandler(){\r\n      let premiumFreatures = get('.post-types.premium')\r\n      premiumFreatures.addEventListener('click', (event)=>{\r\n        // let pickedPopap = event.target.dataset.target\r\n        if (event.target.closest('div[data-target]')){\r\n          let pickedPopap = event.target.closest('div[data-target]').dataset.target\r\n          let premiumForm = get('.inner_main_page_section_cls.news_details_main')\r\n          console.log(pickedPopap)\r\n          switch (pickedPopap) {\r\n            case '#by_found':\r\n              premiumStep(pickedPopap)\r\n              premiumForm.querySelector('h2').textContent = 'Be found'\r\n              premiumForm.querySelector('img.right_icon').src = beFoundImg\r\n              premiumForm.querySelector('.main_audience>h4').textContent = 'Reach'\r\n              show(premiumForm.querySelector('.elem-Befound'), 'block')\r\n              \r\n              premiumForm.querySelector('.block_title>h4').textContent = 'Info'\r\n              break;\r\n              \r\n            case '#find_someone':\r\n              premiumStep(pickedPopap)\r\n              premiumForm.querySelector('h2').textContent = 'Find someone'\r\n              premiumForm.querySelector('img.right_icon').src = findSomeone\r\n              premiumForm.querySelector('h4').textContent = 'Distance'\r\n              // premiumForm.querySelector('.about_fields>h4').textContent = 'Info'\r\n              \r\n              // hide(premiumForm.querySelector('.block_title'))\r\n              \r\n              show(premiumForm.querySelector('.elem-Findsomeone'), 'block')\r\n\r\n              break;\r\n\r\n            case '#buy_and_sell':\r\n              premiumStep(pickedPopap)\r\n              let checkboxes = premiumForm.querySelector('.elem-SellandBuy')\r\n              premiumForm.querySelector('h2').textContent = 'Sell'\r\n              premiumForm.querySelector('img.right_icon').src = buyAndSell\r\n              premiumForm.querySelector('h4').textContent = 'Reach'\r\n\r\n              show(checkboxes, 'block')\r\n\r\n              break;\r\n            case '#host_event':\r\n              premiumStep(pickedPopap)\r\n              premiumForm.querySelector('h2').textContent = 'Event'\r\n              premiumForm.querySelector('img.right_icon').src = hostEvent\r\n              premiumForm.querySelector('h4').textContent = 'Audience'\r\n              premiumForm.querySelector('.block_title>h4').textContent = 'Info'\r\n              // show(premiumForm.querySelector('.block_title'), 'block')\r\n              show(premiumForm.querySelector('.elem-Checkbox'), 'block')\r\n              \r\n              break;\r\n            case '#news_modal':\r\n              premiumStep(pickedPopap)\r\n              premiumForm.querySelector('h2').textContent = 'News'\r\n              premiumForm.querySelector('img.right_icon').src = postNews\r\n              premiumForm.querySelector('h4').textContent = 'Audience'\r\n\r\n              // show(premiumForm.querySelector('.block_title'), 'block')\r\n              show(premiumForm.querySelector('.elem-News'), 'block')\r\n\r\n              break;\r\n            case '#hire_someone':\r\n              premiumStep(pickedPopap)\r\n              premiumForm.querySelector('h2').textContent = 'Hire someone'\r\n              premiumForm.querySelector('img.right_icon').src = postNews\r\n              premiumForm.querySelector('h4').textContent = 'Location range'\r\n              premiumForm.querySelector('.block_title>h4').textContent = 'Skill'\r\n\r\n              show(premiumForm.querySelector('.elem-Hiresomeone'), 'block')\r\n              \r\n              break;\r\n          }\r\n        }\r\n      })\r\n    }\r\n    popuHandler()\r\n\r\n    function premiumStep(picked){\r\n      let popup = get(picked)\r\n      let userFrowerBtn = popup.querySelector('.flower-btn') \r\n      let closeBtn = popup.querySelector('button.btn.btn-danger')\r\n      userFrowerBtn.addEventListener('click', ()=>{\r\n        closeBtn.click()\r\n        show(get('.inner_main_page_section_cls.news_details_main'), 'block')\r\n        hide(get('section.create-post_type'))\r\n      })\r\n    }\r\n\r\n    function appendMapPopupButtonInto3Step(){\r\n      let FieldWhereNeedAppendBtn = document.querySelector('.acf-field.acf-field-button-group.acf-field-624a5015efb23>.acf-input')\r\n      let LocationPopupBtn = `\r\n      <button type=\"button\" class=\"btn btn-primary map-button\" data-toggle=\"modal\" data-target=\"#map-popup\">\r\n        Location\r\n      </button>\r\n      `\r\n      FieldWhereNeedAppendBtn.innerHTML = LocationPopupBtn\r\n    }\r\n    function appendMapIntoPopup(){\r\n      let map = get('.acf-field.acf-field-google-map.acf-field-624a4e9f377db')\r\n      let popup = get('.acf-map')\r\n      popup.append(map)\r\n      \r\n      let locationCountryArea = get('.location-country')\r\n      let countryList = get('div[data-name=f_country]')\r\n      locationCountryArea.append(countryList)\r\n      \r\n      console.log(locationCountryArea,countryList)\r\n    }\r\n\r\n    function progressBarHandler(step){\r\n        return get('.progress-bar.active').style.width =+ step + '%'\r\n    }\r\n\r\n    function makeAllTabsActive(){\r\n      let tabBlock = document.querySelector('ul.acf-hl.acf-tab-group')\r\n      tabBlock?.querySelectorAll('li').forEach(tab =>{\r\n          tab.classList.add('active')\r\n      })\r\n    }\r\n    makeAllTabsActive()\r\n\r\n  } catch(e){console.log(e)}\r\n\r\n\r\n\r\n})\r\n\r\n\n\n//# sourceURL=webpack:///./src/post_form.js?");
      /***/
    }
    /******/

  };
  /************************************************************************/

  /******/
  // The module cache

  /******/

  var __webpack_module_cache__ = {};
  /******/

  /******/
  // The require function

  /******/

  function __webpack_require__(moduleId) {
    /******/
    // Check if module is in cache

    /******/
    var cachedModule = __webpack_module_cache__[moduleId];
    /******/

    if (cachedModule !== undefined) {
      /******/
      return cachedModule.exports;
      /******/
    }
    /******/
    // Create a new module (and put it into the cache)

    /******/


    var module = __webpack_module_cache__[moduleId] = {
      /******/
      // no module.id needed

      /******/
      // no module.loaded needed

      /******/
      exports: {}
      /******/

    };
    /******/

    /******/
    // Execute the module function

    /******/

    __webpack_modules__[moduleId](module, module.exports, __webpack_require__);
    /******/

    /******/
    // Return the exports of the module

    /******/


    return module.exports;
    /******/
  }
  /******/

  /************************************************************************/

  /******/

  /* webpack/runtime/compat get default export */

  /******/


  (function () {
    /******/
    // getDefaultExport function for compatibility with non-harmony modules

    /******/
    __webpack_require__.n = function (module) {
      /******/
      var getter = module && module.__esModule ?
      /******/
      function () {
        return module['default'];
      } :
      /******/
      function () {
        return module;
      };
      /******/

      __webpack_require__.d(getter, {
        a: getter
      });
      /******/


      return getter;
      /******/
    };
    /******/

  })();
  /******/

  /******/

  /* webpack/runtime/define property getters */

  /******/


  (function () {
    /******/
    // define getter functions for harmony exports

    /******/
    __webpack_require__.d = function (exports, definition) {
      /******/
      for (var key in definition) {
        /******/
        if (__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
          /******/
          Object.defineProperty(exports, key, {
            enumerable: true,
            get: definition[key]
          });
          /******/
        }
        /******/

      }
      /******/

    };
    /******/

  })();
  /******/

  /******/

  /* webpack/runtime/hasOwnProperty shorthand */

  /******/


  (function () {
    /******/
    __webpack_require__.o = function (obj, prop) {
      return Object.prototype.hasOwnProperty.call(obj, prop);
    };
    /******/

  })();
  /******/

  /******/

  /* webpack/runtime/make namespace object */

  /******/


  (function () {
    /******/
    // define __esModule on exports

    /******/
    __webpack_require__.r = function (exports) {
      /******/
      if (typeof Symbol !== 'undefined' && Symbol.toStringTag) {
        /******/
        Object.defineProperty(exports, Symbol.toStringTag, {
          value: 'Module'
        });
        /******/
      }
      /******/


      Object.defineProperty(exports, '__esModule', {
        value: true
      });
      /******/
    };
    /******/

  })();
  /******/

  /************************************************************************/

  /******/

  /******/
  // startup

  /******/
  // Load entry module and return exports

  /******/
  // This entry module can't be inlined because the eval devtool is used.

  /******/


  var __webpack_exports__ = __webpack_require__("./src/index.js");
  /******/

  /******/

})();