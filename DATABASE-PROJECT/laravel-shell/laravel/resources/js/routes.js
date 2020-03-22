import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './pages/Home'
import TermsOfService from './pages/TermsOfService'
import Login from './pages/Login'
import Register from './pages/Register'

Vue.use(VueRouter)

export default new VueRouter({
    
    mode: 'history',

    base: process.env.BASE_URL,

    routes: [
        { path: '/', component: Home, name: 'Home', template: '<div>home</div>'},
        {path: '/terms', component: TermsOfService, name: 'Terms'},
        // { path: '/login', component: Login, name: 'Login'},
        // { path: '/register', component: Register, name: 'Register'},


    ]

});