import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '@/views/Home'
import Login from '@/views/Login'
import SignUp from '@/views/SignUp'
import TermsOfService from '@/views/TermsOfService'
import PageNotFound from '@/components/PageNotFound'

Vue.use(VueRouter)

let baseRoutes = [
  {
    path: '/',
    redirect: '/login'
  },
  {
    path: '/home',
    name: 'Home',
    component: Home
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: SignUp
  },
  {
    path: '/termsofservice',
    name: 'TermsOfService',
    component: TermsOfService
  },
  {
    path: '*',
    name: 'PageNotFound',
    component: PageNotFound
  }
]

const router = new VueRouter({
  mode: 'history',
  linkExactActiveClass: 'active',
  base: process.env.BASE_URL, // WHERE THE HOME PAGE IS SPECIFIED
  routes: baseRoutes
})

router.beforeEach((to, from, next) => {
  // redirect to login page if not logged in and trying to access a restricted page
  const publicPages = ['/login', '/signup', '/termsofservice']
  const authRequired = !publicPages.includes(to.path)
  const loggedIn = localStorage.getItem('user')

  if (authRequired && !loggedIn) {
    return next('/login')
  }
  next()
})

export default router