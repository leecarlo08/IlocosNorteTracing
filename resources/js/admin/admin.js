try {
    require('bootstrap');
} catch (e) {}

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.Vue = require('vue');
import 'sweetalert';
import VueRouter from 'vue-router'
Vue.use(VueRouter);

import {routes} from "./routes";
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

//Import Froala Editor
import 'froala-editor/js/plugins.pkgd.min.js';
import 'froala-editor/js/third_party/embedly.min';
import 'froala-editor/js/third_party/font_awesome.min';
import 'froala-editor/js/third_party/spell_checker.min';
import 'froala-editor/js/third_party/image_tui.min';
import 'froala-editor/js/plugins/image.min.js';
import 'froala-editor/css/froala_editor.pkgd.min.css';

// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg'
Vue.use(VueFroala)
Vue.config.productionTip = false

Vue.component('admin-nav', require('./components/AdminNav').default);
Vue.component('admin-side-nav', require('./components/AdminSideNav').default);

const app = new Vue({
    el: '#app',
    router
});



