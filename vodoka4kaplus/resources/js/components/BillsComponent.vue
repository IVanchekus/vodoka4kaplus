<template>
    <div>
        <h1 class="mt-3">Добро пожаловать на Водокачка+</h1>
        <h2>Полный список счетов</h2>
        
        <form @submit.prevent="countBills">
            <div class="mb-3">
            <label class="form-label" for="period_id">Произвести перерасчет необходимого периода</label>
            <!-- <input class="form-control" type="number" id="period_id" name="period_id" placeholder="ID периода"> -->
            <select id="period_id" class="form-control" name="period_id" v-model="period_id">
                <option :value="null"></option>
                <option v-for="period in periods" :value="period.id">{{ period.begin_date.slice(0,7) }}</option>
            </select>
            </div>
            <button class="btn btn-primary" type="submit">Перерасчет</button>
        </form>

        <div class="mt-3">
            <label for="filter">Фильтрация</label>
            <select class="form-select" name="filter" id="filter" v-model="month">
                <option :value="null"></option>
                <option v-for="period in periods" :value="period.id">{{ period.begin_date.slice(0,7) }}</option>
            </select>
            <button @click="getFilter">Фильтр</button>
        </div>

        <table class="table table-light table-striped mt-3">
        <thead>
            <tr>
                <th scope="col">ФИО</th>
                <th scope="col">Месяц</th>
                <th scope="col">ID периода</th>
                <th scope="col">Сумма</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="bill in bills">
                <th>{{ bill.fio }}</th>
                <td>{{ bill.begin_date.slice(0,7) }}</td>
                <td>{{ bill.period_id }}</td>
                <td>{{ bill.amount_rub }}</td>
            </tr>
        </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios'
import { ref } from 'vue';

export default{
    data(){ return{
        bills: ref([]),
        month: ref(),
        periods: [],
        period_id: ref()
    }},
    methods: {
        getFilter: function(){
            //console.log(this.month)
            if (this.month != null){
                axios
                .get('/api/countBills/filter/' + this.month)
                .then((response) =>{
                    //console.log(response)
                    this.bills = response.data
                })
            }
            else{
                axios
                .get('/api/countBills/filter_null/')
                .then((response) =>{
                    //console.log(response)
                    this.bills = response.data
                });
                axios
                    .get('/api/months/get')
                    .then((response) => {
                        this.periods = response.data
                    })
            }
        },

        countBills: function() {
            axios
                .post('/countBills', {period_id: this.period_id})
                .then((response) => {
                    //console.log(response.data)
                    if (response.data != 0){
                        this.bills.push(response.data)
                    }
                });
            this.getFilter()
        }
    },
    mounted() {
        this.getFilter()
    },
}

</script>