import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueRouter from 'vue-router'
import router from './routes'

window.Vue = require('vue');
window.Vue = require('./bootstrap')
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueRouter)


const app = new Vue({
  router
}).$mount('#app')

