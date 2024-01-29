/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';

// window.Vue = require('vue');
//import ExampleComponent from './components/ExampleComponent.vue';
import VueRouter from 'vue-router';
import ResidentsComponent from "./components/ResidentsComponent.vue";
import ResidentInfoComponent from "./components/ResidentInfoComponent.vue";
import BillsComponent from "./components/BillsComponent.vue";

Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const routes = [
    {
        path: '/residents',
        name: 'residents.residents',
        component: ResidentsComponent
    },
    {
        path: '/residents/:resident',
        name: 'residents.resident',
        component: ResidentInfoComponent
    },
    {
        path: '/',
        name: 'bills.filter',
        component: BillsComponent
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
})

const app = new Vue({
    el: '#residentapp',
    router: router
});


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))



const month_costs = new Vue({
    el: '#numbers_check_app',
    data: {
        number: null
    },
    methods: {
        check_number(number){
            this.number = number.target.value.replace(/[^0-9]/g, "");
        }
    },
})



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
