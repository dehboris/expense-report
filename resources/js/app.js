require('./bootstrap');

import App from "./components/App";
import VueRouter from 'vue-router';
import { routes } from './routes';

window.Vue = require('vue');

Vue.mixin({
    methods: {
        route: route
    }
});

/*#######################################################
 # Vue Router Settings
 ######################################################*/
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});
