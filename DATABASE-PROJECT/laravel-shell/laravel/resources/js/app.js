import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueRouter from 'vue-router'
import Axios from 'axios'


import Home from './pages/Home'
import Login from './pages/Login'
import Register from './pages/Register'
import TermsOfService from './pages/TermsOfService'

window.Vue = require('vue');
window.Vue = require('./bootstrap')
Vue.use(Axios)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueRouter)

Vue.component('Home', require('./pages/Home'));

const routes = [
    { path: '/', component: Home, name: 'Home', template: '<div>home</div>'},
    // { path: '/login', component: Login, name: 'Login', template: '<div>login</div>'},
    {path: '/terms', component: TermsOfService, name: 'Terms'},
    { path: '/signup', component: Register, name: 'Register', template: '<div>register</div>'},
]
const router = new VueRouter({routes, mode: 'history', base: process.env.BASE_URL}); 

const app = new Vue({
  router
}).$mount('#app')

