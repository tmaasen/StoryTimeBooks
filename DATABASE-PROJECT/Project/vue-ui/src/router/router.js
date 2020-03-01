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
    redirect: '/home'
  },
  {
    path: '/home',
    name: 'Home',
    component: Home,
    meta: {
      auth: true,
      title: 'StoryTime Books'
    }
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      auth: true,
      title: 'Login'
    }
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: SignUp,
    meta: {
      auth: true,
      title: 'Create Account'
    }
  },
  {
    path: '/termsofservice',
    name: 'TermsOfService',
    component: TermsOfService,
    meta: {
      auth: true,
      title: 'Terms of Service'
    }
  },
  {
    path: '*',
    name: 'PageNotFound',
    component: PageNotFound
  }
]

const router = new VueRouter({
  mode: 'history',
  //linkExactActiveClass: 'active',
  //base: process.env.HOME, // WHERE THE HOME PAGE IS SPECIFIED
  routes: baseRoutes
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title; // renders the correct router title associated with its view

  //redirect to login page if not logged in and trying to access a restricted page
  const publicPages = ['/login', '/signup', '/termsofservice', '/home']
  const authRequired = !publicPages.includes(to.path)
  const loggedIn = localStorage.getItem('user')

  if (authRequired && !loggedIn) {
    return next('/login')
  }
  next()
})

export default router