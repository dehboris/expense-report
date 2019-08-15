require('./bootstrap');

import App from "./components/App";
import VueRouter from 'vue-router';
import { routes } from './routes';

window.Vue = require('vue');

/*#######################################################
 # Vue Router Settings
 ######################################################*/
Vue.use(VueRouter);

const router = new VueRouter({
    routes // short for `routes: routes`
});

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});
