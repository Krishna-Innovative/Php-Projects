// import {getAll} from '../../post_form'
import {get, getAll, avatarRequest, avatarRequestById} from '../../utilities'
function getNick(str){
    let newStr = str.split('/')
    return newStr[2] 
}
let observeConfig = {
    childList: true
}
// function this(this){
//     this.querySelector()
// }
function friendsTabHandler(){
    // for mini and usual chat
    getAll('.bpbm-os-viewport.bpbm-os-viewport-native-scrollbars-invisible')
    ?.forEach(fblock =>{
        fblock?.querySelectorAll('img.gravatar.avatar.um-avatar.um-avatar-gravatar')
            ?.forEach(userAvatar =>{
                /* get a tag "a" and from there I take the "link" 
                to the user and cut it off, leaving the user's nickname */
                let userNick = getNick(new URL(userAvatar?.closest('a').href).pathname)
                avatarRequest(userNick, userAvatar)
            })
        })
    }

//  for output avatar on top chat page 
function headerTabHandler(){
try{
    if (get('.bp-messages-column')){   
        let userAvatar = get('.bp-messages-column')
        ?.querySelector('img.gravatar.avatar.um-avatar.um-avatar-gravatar')
        let userNick = getNick(new URL(userAvatar.closest('a').href).pathname)
        avatarRequest(userNick, userAvatar)
    }         
} catch(e){}
}

// function sendHandler(){
//     get('.reply')?.addEventListener('keydown', (e)=> {
//         if (e.keyCode === 13) {
//             setTimeout( ()=>{
//                 // last message sended
//                 let trimed= Array.from(get('.list.can-moderate.synced')
//                             ?.querySelectorAll('.messages-stack')).slice(-1)
//                 let newMessege = trimed[0]

//                 console.log(newMessege)
//                 let userId = newMessege.dataset.userId
//                 let avatar = newMessege.querySelector('img.gravatar.avatar.um-avatar.um-avatar-uploaded')
//                 avatarRequestById(userId, avatar)
//             },1000)
//         }
//     })
// }

function sendsHandler(){
    getAll('.reply')
    ?.forEach(reply=>{
        console.log(reply)
        let messageList = reply.closest('.bpbm-chat-main')
                          ?.querySelector('.list')

        console.log(messageList)
        reply?.addEventListener('keydown', (e)=> {
            if (e.keyCode === 13) {
                console.log('enter')
                let ObservAllChats = new MutationObserver(allChatsMutations  =>{
                    console.log(allChatsMutations)
                    for(let chatMutation of allChatsMutations) {
                        for(let chatMessageNode of chatMutation.addedNodes) {
                            console.log(chatMessageNode)
                            let userId = chatMessageNode.dataset.userId
                            // the place where the avatar will be inserted
                            let avatar = chatMessageNode.querySelector('img.gravatar.avatar.um-avatar.um-avatar-uploaded')
                            // To find the messages of the user who is sending the message
                            let prevMessage = messageList.querySelector(`div[data-user-id='${userId}']`)
                            // get the avatar from this message to send to the place where a new message with the avatar appears
                            let userAvatar = prevMessage.querySelector('.friend_avatar').src
                            console.log(userAvatar)
                            avatar.classList.add('friend_avatar')
                            avatar.src = userAvatar
                            avatar.dataset.default = ''
                        }
                    }
                })
                ObservAllChats.observe(messageList, observeConfig)
            }
        })
    })

}

// function chatsHandler(){
//     getAll('.list')?.forEach(chat=>{
//         chat.querySelector()?.addEventListener('click')
//     })
// }
function miniSendHandler(){
    try{
    let miniChatNav = get('.bp-messages-wrap.bp-better-messages-list.bpbm-template-modern-right.bpbm-template-modern')
    // let miniChatNav = get('.bp-messages-wrap.bp-better-messages-list.bpbm-template-modern-right.bpbm-template-modern.bp-better-messages-list-open')
    miniChatNav.addEventListener('click', (e) =>{
        if(e.target.closest('div.thread')){
            let chat = get('.bpbm-os-content')
            let miniChatThreads = get('.bp-messages-wrap.bp-better-messages-mini.bpbm-template-modern-right.bpbm-template-modern>.chats')
            let ObservMiniChats = new MutationObserver(ChatsMutations  =>{
                console.log(ChatsMutations)
                // observetionHandler(miniChatThreads)
                for(let mutation of ChatsMutations) {
                    for(let node of mutation.addedNodes) {
                        node.querySelector('.reply').addEventListener('keydown', (e)=> {
                            if (e.keyCode === 13) {
                                console.log('enter')
                                let listMesseges = node.querySelector('.list')
                                let messageObverv = new MutationObserver( messagesMutations =>{
                                    for(let messageMutation of messagesMutations) {
                                        for(let messageNode of messageMutation.addedNodes) {
                                            let userId = messageNode.dataset.userId
                                            let avatar = messageNode.querySelector('img.gravatar.avatar.um-avatar.um-avatar-uploaded')
                                            let prevMessage = listMesseges.querySelector(`div[data-user-id='${userId}']`)
                                            console.log(prevMessage)
                                            let userAvatar = prevMessage.querySelector('.friend_avatar').src
                                            avatar.classList.add('friend_avatar')
                                            avatar.src = userAvatar
                                            avatar.dataset.default = ''
                                            // avatarRequestById(userId, avatar)
                                        }
                                    }
                                })
                                messageObverv.observe(listMesseges, observeConfig)
                            }
                        })
                    }
                }
            })
            ObservMiniChats.observe(miniChatThreads, observeConfig)
            console.log(miniChatThreads)
        } else {
            console.log('false')
        }
    })
}catch(e){console.log(e)}
}

// function observetionHandler(ChatsMutations){
//     for(let mutation of ChatsMutations) {
//         for(let node of mutation.addedNodes) {
//             node.querySelector('.reply').addEventListener('keydown', (e)=> {
//                 if (e.keyCode === 13) {
//                     console.log('enter')
//                     let listMesseges = node.querySelector('.list')
//                     let messageObverv = new MutationObserver( messagesMutations => {
//                         for(let messageMutation of messagesMutations) {
//                             for(let messageNode of messageMutation.addedNodes) {
//                                 let userId = messageNode.dataset.userId
//                                 // 
//                                 let avatar = messageNode.querySelector('img.gravatar.avatar.um-avatar.um-avatar-uploaded')
//                                 let prevMessage = listMesseges.querySelector(`div[data-user-id='${userId}']`)
//                                 console.log(prevMessage)
//                                 let userAvatar = prevMessage.querySelector('.friend_avatar').src
//                                 avatar.src = userAvatar
//                                 // avatarRequestById(userId, avatar)
//                             }
//                         }
//                     })
//                     messageObverv.observe(listMesseges, observeConfig)
//                 }
//             })
//         }
//     }
// }


window.addEventListener('load', ()=>{
    setTimeout(()=>{
        sendsHandler(),
        friendsTabHandler(),
        headerTabHandler(),
        // sendHandler(),
        miniSendHandler()
    },2000)
})