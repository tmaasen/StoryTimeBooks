import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './pages/Home'
import TermsOfService from './pages/TermsOfService'
import Login from './pages/Login'
import Register from './pages/Register'
import Admin from './pages/Admin'

Vue.use(VueRouter)

export default new VueRouter({
    
    mode: 'history',
    history:true,

    base: process.env.BASE_URL,
 // meta defines the access roles for each route
    routes: [
        { path: '/', component: Home, name: 'Home', meta: {auth:undefined}},
        {path: '/termsofservice', component: TermsOfService, name: 'Terms', meta: {auth:undefined}},
        { path: '/login', component: Login, name: 'Login', meta: {auth:false}},
        { path: '/register', component: Register, name: 'Register', meta: {auth:undefined}},
        { path: '/admin', component: Admin, name: 'Admin', meta: {auth:true}},


    ]

});