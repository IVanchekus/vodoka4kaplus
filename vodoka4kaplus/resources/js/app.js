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
import MonthCosts from "./components/MonthCosts.vue";
import BaseLayout from "./components/BaseLayout.vue";
import PumpMeterRecords from "./components/PumpMeterRecordsComponent.vue";
import LoginComponent from "./components/auth/LoginComponent.vue";
import RegisterComponent from "./components/auth/RegisterComponent.vue";

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
    },
    {
        path: '/month_costs',
        name: 'month_costs',
        component: MonthCosts
    },
    {
        path: '/pump_meter_records',
        name: 'pump_meter_records',
        component: PumpMeterRecords
    },
    {
        path: '/login',
        name: 'auth.login',
        component: LoginComponent
    },
    {
        path: '/register',
        name: 'auth.register',
        component: RegisterComponent
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
})

const app = new Vue({
    el: '#residentapp',
    router: router,
    render: h => h(BaseLayout)
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
