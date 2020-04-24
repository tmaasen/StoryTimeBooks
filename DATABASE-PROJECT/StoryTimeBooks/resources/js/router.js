import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './pages/Home'
import TermsOfService from './pages/TermsOfService'
import Login from './pages/Login'
import Register from './pages/Register'
import Admin from './pages/Admin'
import Profile from './pages/Profile'
import Restricted from './pages/403'
import ShoppingCart from './pages/ShoppingCart'
import PurchaseInfo from './pages/PurchaseInfo'

Vue.use(VueRouter)

const router = new VueRouter({

    mode: 'history',
    history: true,

    base: process.env.BASE_URL,
    // meta defines the access roles for each route
    routes: [
        { path: '/403', component: Restricted, name: 'Restricted', meta: { auth: undefined } },
        { path: '/', component: Home, name: 'Home', meta: { auth: undefined } },
        { path: '/termsofservice', component: TermsOfService, name: 'Terms', meta: { auth: undefined } },
        { path: '/login', component: Login, name: 'Login', meta: { auth: false } },
        { path: '/register', component: Register, name: 'Register', meta: { auth: undefined } },
        { path: '/admin', component: Admin, name: 'Admin', meta: { admin: true, auth: true } },
        { path: '/user/profile/:id', component: Profile, name: 'Profile', meta: { auth: true } },
        { path: '/user/cart/:id', component: ShoppingCart, name: 'ShoppingCart', meta: { auth: true } },
        { path: '/user/:id/purchase/info', component: PurchaseInfo, name: 'PurchaseInfo', meta: { auth: true } },
    ]

});

export default router;