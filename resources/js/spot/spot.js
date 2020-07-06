
try {
    // window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('materialize-css');
} catch (e) {}


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue');

import VueRouter from 'vue-router'
Vue.use(VueRouter);

import 'sweetalert';

import {routes} from "./routes";
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

Vue.component('nav-bar', require('./components/NavBar.vue').default);
Vue.component('side-nav', require('./components/SideNav.vue').default);

const app = new Vue({
    el: '#app',
    router
});
