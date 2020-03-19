/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

require('./bootstrap');
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

window.Vue = require('vue');
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

const routes = [
     { path: '/home', component: require('./views-vue/Home.vue'), name: 'Home' },
  ];

const router = new VueRouter({
    routes 
  });

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('navtop', require('./components/navtop.vue').default);
Vue.component('navbottom', require('./components/navbottom.vue').default);
Vue.component('Home', require('./views-vue/Home.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
})