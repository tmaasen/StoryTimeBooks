import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'es6-promise/auto'
import Axios from 'axios'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import auth from './auth'
import router from './router'

window.Vue = require('vue');
window.Vue = require('./bootstrap')
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.router = router
Vue.use(VueRouter)

Vue.use(VueAxios, Axios)
axios.defaults.baseURL = `128.0.0.1:8000/api/v1`

Vue.use(VueAuth, auth)

const app = new Vue({
  router
}).$mount('#app')

