import Vue from 'vue';
import Router from 'vue-router';
import Main from'./components/Main';
import routes from './routes.js';
import axios from 'axios';

Vue.use(Router);
const router = new Router(routes);

new Vue({
    el: '#app',
   	components:{
    	appMain: Main
    },
    router,
    axios,
    template: `<app-main></app-main>`,
    //render: h => h(Main)
});
