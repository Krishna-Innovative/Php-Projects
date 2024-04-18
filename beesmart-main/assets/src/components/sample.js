import { Component } from '../core/component'
import { get, getAll, hideBlocks, show, hide, siteURL, imgPATH } from '../utilities'

export class sample extends Component {
    constructor(id) {
        super(id)
    }
    init() {
        if (get('#sample-page')) {
            stepsHandler()

        }
    }
}

function stepsHandler() {
    let samplePage = get('#sample-page')
    samplePage.addEventListener('click', (e) => {
        if (e.target.closest('button[data-step]')) {

            // dataset
            let activeDataSet = e.target.closest('button[data-step]').dataset.step

            // this button response for navigation be step
            let activeButton = e.target.closest('button[data-step]')


            // this step respond for adding avatar and cover photo
            if (activeDataSet == 'sample-profileNavifation') {
                if (activeButton.hasAttribute('disabled') || activeButton.classList.contains('locked')) {
                    toastr['warning']('Add Avatar and cover photo')
                }
                else {
                    hideBlocks(sampleSteps)
                    TabHandler('a#info-tab')
                    show(get(`#${activeDataSet}`), 'block')
                }
            }
            // this step accesseble after adding bio
            else if (activeDataSet == 'sample-saveToHive') {
                if (activeButton.hasAttribute('disabled')) {
                    toastr['warning']('Add Bio')
                }
                else {
                    TabHandler('a#hive-tab')
                    // for next step validation
                    dropDownHandler()
                    hiveTabHandler()
                }
            }
            // this step accesseble after adding 3 hiver
            else if (activeDataSet == 'sample-feed') {
                if (activeButton.hasAttribute('disabled')) {
                    toastr['warning']('Add Hive')
                }
                else {
                    show(get('#sample-profileNavifation'), 'block')
                    hide(get('#sample-feedPage'))
                    TabHandler('a#feeds-tab')
                    // hide(activeButton)
                }
            }
            //  step back to add Hive
            else if (activeDataSet == 'sample-feedStepBack') {
                TabHandler('a#hive-tab')
            }
            //  just open sample feed page
            else if (activeDataSet == 'sample-feedPage') {
                hideBlocks(sampleSteps)
                show(get(`#${activeDataSet}`), 'block')
            }

            // This step respond for login of save feed popup after click "SAVE" btn
            else if (activeDataSet == 'sample-saveFeedPopup') {
                if (activeButton.hasAttribute('disabled')) {
                    toastr['warning']('Save Feed')
                }
                else {
                    get('button.search-nav-btn.save').style.backgroundColor = '#ffc700'
                    get('button.search-nav-btn.save').classList.remove('heartBeat-animation')
                    PopupSaveFeedHandler()
                }
            }

            // on this step appears saved feed button
            else if (activeDataSet == 'sample-goToSideBat') {
                if (activeButton.hasAttribute('disabled')) {
                    toastr['warning']('Choose Feed')
                }
                else {
                    sideBarHandler()
                    // next final step
                    setTimeout(() => {
                        get('li[data-step=sample-savedFeed]').addEventListener('click', () => {
                            // remove animation
                            get('li[data-step=sample-savedFeed]>img').classList.remove('heartBeat-animation')
                            // hide bg 
                            get('.tool_modal_footer.sample-closeSaveFeed>a').click()
                            // side sidebar
                            get('div#cutom_frontend_sidebar').removeAttribute('style')
                            // remove save feed popup
                            get('#saves_query').remove()
                            // hide old list of posts
                            hide(get('.sample-post'))
                            // show post with Spunch Bob 
                            show(get('.sample-postSpunchBob'), 'block')
                            // add animation on add hive btn
                            get('.add-hiveFromPost').classList.add('heartBeat-animation')
                            // 
                            addHiveHandler()
                        })
                    }, 1000)
                }
            }
            else if (activeDataSet == 'sample-finish') {
                if (activeButton.hasAttribute('disabled')) {
                    toastr['warning']('Save feed')
                }
                else {
                    updateField('button[data-step=sample-finish]', 'is_trained')
                    get('button[data-step=sample-finish]').click()
                }
            }

            // else if (activeDataSet == 'sample-savedFeed') {
            //     alert('ok')
            //     get('.tool_modal_footer.sample-closeSaveFeed>a').click()
            //     get('div#cutom_frontend_sidebar').removeAttribute('style')
            // }

            else {
                hideBlocks(sampleSteps)
                show(get(`#${activeDataSet}`), 'block')
            }
        }
    })
}

function TabHandler(el) {
    /**
     * this btn lead to some tab
     */
    let btn = get(el)
    btn.click()
    btn.closest('li').classList.remove('locked')
}

function hiveTabHandler() {
    let nextStepBtn = get('button[data-step=sample-feed]')
    getAll('.dropdown-menu.hiveSample')?.forEach(dropDown => {
        dropDown.addEventListener('click', () => {
            let dataSet = dropDown.dataset.done
            console.log(dataSet)
            nextStepBtn.classList.add(dataSet)
            if (
                nextStepBtn.getAttribute('class').indexOf('first') != -1 &&
                nextStepBtn.getAttribute('class').indexOf('second') != 1 &&
                nextStepBtn.getAttribute('class').indexOf('third') != -1
            ) {
                nextStepBtn.removeAttribute('disabled', 'disabled')
                nextStepBtn.querySelector('img').classList.add('heartBeat-animation')
            }
        })
    })
}

function dropDownHandler() {
    get('.manager_list_profile').addEventListener('click', (e) => {
        if (e.target.closest('a.dropdown-item')) {
            let thisOption = e.target.closest('a.dropdown-item'),
                // option property
                img = thisOption.querySelector('img'), // image of option
                text = thisOption.querySelector('span').textContent,

                // property where needs append option property
                placeholder = thisOption.closest('div').previousElementSibling, // button 
                placeholderIcon = placeholder.previousElementSibling.querySelector('img')

            // appending values
            placeholder.textContent = text
            placeholderIcon.src = img.src


            console.log(placeholder)
            console.log(placeholderIcon)
            // selectionTitle = sibling.textContent
            // selectionImage

            console.log(thisOption)
        }
    })
}

function PopupSaveFeedHandler() {
    if (get('.select_sticker.save_icons_block.ml-0')) {
        let saveFeedPopup = get('.select_sticker.save_icons_block.ml-0')
        saveFeedPopup.addEventListener('click', (e) => {
            if (e.target.closest('div.special')) {
                get('.sample-saveFeed').removeAttribute('disabled', 'disabled')
                get('.sample-saveFeed').classList.remove('locked')
                saveFeedPopup.querySelectorAll('.item.icon_item')?.forEach(el => {
                    el.classList.add('locked')
                })
            }
        })
    }
}

function sideBarHandler() {
    let template = `
    <li class="menu-item dynamic_feed" href="javascript:void(0)"  data-step="sample-savedFeed">
        <img class="heartBeat-animation" width="40" src=${imgPATH}046-pride.png">
        <span class="highlight_custom_menu">Happy!</span>
    </li>
    `
    let sideBar = get('div#cutom_frontend_sidebar')
    let feedArea = sideBar.querySelector('.dashboard_menu')
    sideBar.setAttribute('style', 'display:block!important; z-index:100000000000')
    hide(get('div#saves_query'))
    setTimeout(() => {
        feedArea.insertAdjacentHTML('beforeend', template)
    }, 1000)
}

function addHiveHandler() {
    if (get('.ajax-load-more-wrap.sample')) {
        let feedList = get('.ajax-load-more-wrap.sample')
        feedList.addEventListener('click', (e) => {
            if (e.target.closest('a.dropdown-item')) {
                let thisOption = e.target.closest('a.dropdown-item'),
                    // option property
                    img = thisOption.querySelector('img'), // image of option
                    text = thisOption.querySelector('span').textContent,

                    // property where needs append option property
                    placeholder = thisOption.closest('div').previousElementSibling, // button 
                    placeholderIcon = placeholder.querySelector('img')    // icon

                // appending values
                placeholder.querySelector('span').textContent = text
                placeholderIcon.src = img.src
                if (placeholder.classList.contains('heartBeat-animation')) {
                    placeholder.classList.remove('heartBeat-animation')
                }
                let finishBtn = get('button[data-step=sample-finish]')
                finishBtn.removeAttribute('disabled', 'disabled')
                finishBtn.classList.add('heartBeat-animation')
            }
        })
    }
}

// sample-feedPage
// sample-feed
let sampleSteps = [
    // '#sample-welcome',
    '#sample-coverPhoto',
    '#sample-profileNavifation',
    '#sample-feedPage'
    // '#sample-addBio',
    // '#sample-saveToHive',
    // '#sample-feed',
    // '#sample-saveUpdates'
]
/**
 *  1 onclick on this button starts updating
 *  2 field in database what need update
 */
function updateField(button, fieldName) {
    if (get('.profile-header')) {
        get(button)?.addEventListener('click', () => {
            toastr.success('update start')
            $.ajax({
                type: 'post',
                url: '/wp-admin/admin-ajax.php',
                data: {
                    action: 'upload_update',
                    fieldName: fieldName
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
                    toastr.success('success')
                    window.location = window.location.origin
                },
                complete: function (response) {
                    toastr.success('complete')

                    console.log(response)
                    $('.loader').hide()
                },
            });
        })

    }
}
