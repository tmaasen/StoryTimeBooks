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
import VueMask from 'vue-masked-input'
import vueScrollto from 'vue-scrollto'
import VueFuse from 'vue-fuse'


window.Vue = require('vue')
window.Vue = require('./bootstrap')
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.router = router
Vue.use(VueRouter)
Vue.use(VueMask)
Vue.use(vueScrollto)
Vue.use(VueFuse)

Vue.use(VueProgressBar, {
  color: 'rgb(255, 141, 30)',
  failedColor: 'red',
  height: '4px',
})

Vue.use(VueAxios, Axios)
axios.defaults.baseURL = `http://127.0.0.1:8000/api/v1`

Vue.use(VueAuth, auth)

Vue.prototype.$cartCounter = 0;

const app = new Vue({
  router,
  mounted () {
    this.$Progress.finish()
  },
  created () {
    this.$Progress.start()
    this.$router.beforeEach((to, from, next) => {
      this.$Progress.start()
      next()
    })
    this.$router.afterEach((to, from) => {
      this.$Progress.finish()
    })
  }
}).$mount('#app')

