import Vue from 'vue'
import { BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import 'es6-promise/auto'
import Axios from 'axios'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import auth from './auth'
import router from './router'
import VueProgressBar from 'vue-progressbar'

window.Vue = require('vue');
window.Vue = require('./bootstrap')
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.router = router
Vue.use(VueRouter)
Vue.use(VueProgressBar, {
  color: 'rgb(255, 141, 30)',
  failedColor: 'red',
  height: '4px',
})

Vue.use(VueAxios, Axios)
axios.defaults.baseURL = `http://127.0.0.1:8000/api/v1`

Vue.use(VueAuth, auth)

const app = new Vue({
  router,
  // mounted () {
  //   this.$Progress.finish()
  // },
  // created () {
  //   //  When vue is first loaded start the progress bar
  //   this.$Progress.start()
  //   //  hook the progress bar to start before we move router-view
  //   this.$router.beforeEach((to, from, next) => {
  //     //  does the page we want to go to have a meta.progress object
  //     if (to.meta.progress !== undefined) {
  //       let meta = to.meta.progress
  //       // parse meta tags
  //       this.$Progress.parseMeta(meta)
  //     }
  //     //  start the progress bar
  //     this.$Progress.start()
  //     //  continue to next page
  //     next()
  //   })
  //   //  hook the progress bar to finish after we've finished moving router-view
  //   this.$router.afterEach((to, from) => {
  //     //  finish the progress bar
  //     this.$Progress.finish()
  //   })
  // }
}).$mount('#app')

