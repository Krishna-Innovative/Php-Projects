import './components/custom'
import './post_form'
import './components/mapPopup.component'
import './components/infoTab.component'
import './components/chat/mini-chat'
import './components/create-post/step-3'
import { CreateComponent } from './components/create.component'
import { InfoTabComponent } from './components/infoTab.component'
import { CreatePostStep3 } from './components/create-post/step-3'
import { SinglePost } from './components/single-post'
import { accountSettingComponent } from './components/account-setting'
import { premiumComponent } from './components/premium/premium'
import { sample } from './components/sample'
import { signUp} from './components/signUp'
import { feed } from './components/feed'
import { user } from './components/user'



/* VUE */
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
// createApp(App)
//     .mount('#app')
//     .use(router)
/* VUE */
// window.Vue = require('vue')
// Vue.component()
// import {CreateStep3Component} from './components/createStep3.component'
new CreateComponent('step-2')

new premiumComponent('premium-step-form')
 
new CreatePostStep3('step-3-form')

new InfoTabComponent('bees_add_info_form')
new sample('sample-page')

new feed('feed-page')
new user('preview-js')
new signUp('signUp-page')

// new signUp('signUp-page', '#signUp-page')

// sample.steps = [
//     '#sample-welcome',
//     '#sample-coverPhoto'
// ]
// new CreateStep3Component('acf-form')


/**
 * single.php
 */
new SinglePost('post-page')


/**
 * account page
 */
new accountSettingComponent('settings-block')
