/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

import VueRouter from 'vue-router'
Vue.use(VueRouter);


import {routes} from "./routes";
const router = new VueRouter({
    mode: 'history',
    routes: routes
});
import Suggestions from 'v-suggestions';
import 'sweetalert';
import 'v-suggestions/dist/v-suggestions.css';

Vue.component('suggestions', Suggestions);

Vue.component('nav-bar', require('./components/NavBar.vue').default);
Vue.component('side-nav', require('./components/SideNav.vue').default);
Vue.component('in-banner', require('./components/InBanner').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data: {
        provReg: 0,
        cities: [],
        cityReg: 0,
        brgyReg: 0,
        brgys: []
    },
    methods: {
        getCity(){
            this.cityReg = 0;
            window.axios.get(`/get-cities/${this.provReg}`).then(({data}) => {
                this.cities = data;
            })
        },
        getBrgy(){
            this.cbrgyReg = 0;
            window.axios.get(`/get-brgys/${this.cityReg}`).then(({data}) => {
                this.brgys = data;
            })
        },
    }
});
