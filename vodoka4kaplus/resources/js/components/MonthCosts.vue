<template>
    <div>
        <h1 class="h1 mt-3">Стоимость за месяц</h1>
        <form @submit.prevent="month_costs_check">
            <div class="mb-3">
                <label for="month" class="form-label">Месяц</label>
                <input class="form-control" name="month" id="month" v-model="month" type="date">
            </div>
            <div class="mb-3">
                <label class="form-label" for="cost">Стоимость</label>
                <input class="form-control" v-model="number" name="costs" id="costs" type="text" @input="check_number">
            </div>
            <button class="btn btn-primary" type="submit">Отправить</button>
        </form>

        <h2 class="mt-3">Список всех тарифов</h2>
        <div class="row">
        <table class="table table-light table-striped mt-3">
        <thead>
            <tr>
                <th scope="col">Период</th>
                <th scope="col">Тариф</th>
            </tr>
        </thead>
        <tbody>
        <tr v-for="monthcost in monthcosts">
            <th>{{ monthcost.month.slice(0, 7) }}</th>
            <td>{{ monthcost.costs }} рублей</td>
        </tr>
        </tbody>
        </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';

export default {
    data(){ return{
        number: ref(),
        month: ref(),
        monthcosts: ref([])
    }},
    methods: {
        check_number(number){
            this.number = number.target.value.replace(/[^0-9]/g, "");
        },
        month_costs_check: function() {
            axios
                .post('/api/month_costs/check', {month: this.month, costs: this.number})
                .then((response) => {
                    //console.log(response.data)
                    if (response.data != 0)
                    {
                        this.monthcosts.push(response.data)
                    }
                });
            this.month_costs();
        },
        month_costs: function(){
            axios
                .get('/api/month_costs')
                .then((response) => {
                    this.monthcosts = response.data
                })
        }
    },
    mounted(){
        this.month_costs()
    }
    
}
</script>