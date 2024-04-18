import { Component } from '../core/component'
import {get} from '../utilities'

export class accountSettingComponent extends Component {
    constructor(id){
        super(id)
    }
    init(){
        if(get('#settings-block')){
            deleteUnusefullTabs(options)
            strReplaces(stgingsToReplace)
            deteleNodesAndSibiling(siblingsToDelete)
            get('#um_field_general_user_email')?.nextElementSibling.remove()
        }
    }
}

let options = [
    'input#um_account_submit_general',
    '.um-account-tab.um-account-tab-orders',
    'div#um_field_privacy_hide_in_members',
    'div#um_field_privacy_um_bookmark_privacy',
    'div#um_field_privacy_profile_noindex',
    'a[data-tab=downloads]',
    'a[data-tab=orders]',
    'div#um_field_general_user_login'
]

// data-tab="orders"
let siblingsToDelete = [
    'div[data-tab=downloads]',
    '.um-col-alt.um-col-alt-b',
    'div[data-tab=general]'
]

let stgingsToReplace = {
    poingToHoney : {
        el :  'div>a[data-tab=points]',
        word: 'My points',
        to :  'My honey'
    },
    followerSToBees :{
        el : 'div[data-tab=notifications]',
        word: 'Followers',
        to: 'Bees'
    },
    followerSToBees2:{
        el: 'div[data-tab=notifications]',
        word:'I\'m followed by someone new',
        to:'You have been added to a hive.'
    },
    followerSToBees3:{
        el: 'div[data-tab=notifications]',
        word:'I have got a new review',
        to:'Check out what people feel about you'
    },
    followerSToBees4:{
        el: 'div[data-tab=notifications]',
        word:'User Reviews',
        to:'Buzz'
    }
}

function deleteUnusefullTabs(options){
    options.forEach(option =>{
        console.log(option, 'unusefull option deleted')
        get(option)?.remove()
    })
}


function strReplaces(objsToReplace){
    for (let obj in objsToReplace){
        get(objsToReplace[obj]['el']).innerHTML = get(objsToReplace[obj]['el']).innerHTML.replace(objsToReplace[obj]['word'], objsToReplace[obj]['to'])
    }
}

    // let el = get(objsToReplace[obj]['el']).innerHTML,
    //     work = objsToReplace[obj]['word'],
    //     replaceTo = objsToReplace[obj]['to']
    // el = el.replace(work, replaceTo)
    // console.log(stgsToRepObjs[obj])

// function strReplace(block, string, replaceTo){
//     get(block).innerHTML = get(block).innerHTML.replace(string, replaceTo)
// }

function deteleNodesAndSibiling(someNodes){
    someNodes.forEach(someNode =>{
        let el = document.querySelector(someNode)
            el?.previousElementSibling.remove()
            el?.remove()
    })
}