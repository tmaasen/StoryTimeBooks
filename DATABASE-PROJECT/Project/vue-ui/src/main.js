import Vue from 'vue'
import App from './App.vue'
import router from './router/router'
import store from './store/store'
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'popper.js/dist/esm/popper.js'

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

import '@/assets/style.css'
//import './registerServiceWorker'

import GoogleAuth from '@/config/google_oAuth.js'
const gauthOption = {
  clientId: '707231563844-e5cpkqrlt62gncmj6b84of5sml9lp8g9.apps.googleusercontent.com',
  scope: 'profile email',
  prompt: 'select_account'
}
Vue.use(GoogleAuth, gauthOption)
Vue.config.productionTip = false

new Vue({
   router,
   store,
  render: h => h(App)
}).$mount('#app')