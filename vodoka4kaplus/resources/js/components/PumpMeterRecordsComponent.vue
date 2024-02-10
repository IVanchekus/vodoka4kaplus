<template>
    <div>
    <h1 class="mt-3">Показания счетчиков</h1>
    <form @submit.prevent="insertPMR">
        <div class="mb-3">
            <label for="month" class="form-label">Месяц</label>
            <input class="form-control" name="month" id="month" type="date" v-model="month">
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Объем (м^3)</label>
            <input class="form-control" type="text" name="amount" id="amount" v-model="number">
        </div>

        <button class="btn btn-primary" type="submit">Отправить</button>
    </form>

    <h2 class="mt-3">Показания счетчиков</h2>
    <div class="alert alert-warning">Каждый месяц показания счетчиков должны увеличиваться</div>
    <table class="table table-light table-striped mt-3">
    <thead>
        <tr> 
            <th scope="col">Период</th>
            <th scope="col">Объем</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="pmr in pumpmeterrecords">
            <th>{{ pmr.begin_date.slice(0, 7) }}</th>
            <td>{{ pmr.amount_volume }} м<sup>3</sup></td>
        </tr>
    </tbody>
    </table>
    </div>
</template>

<script>
import axios from 'axios'
import { ref } from 'vue';

export default{
    data() {
        return{
            pumpmeterrecords: ref([]),
            number: ref(),
            month: ref()
        }
    },
    methods: {
        getPMR(){
            axios
                .get('/api/pump_meter_records')
                .then((response) => {
                    this.pumpmeterrecords = response.data
                })
        },
        insertPMR(){
            axios
                .post('/api/pump_meter_records/check', {month: this.month, amount: this.number})
                .then((response) => {
                    //console.log(response.data)
                    if (response.data != 0)
                    {
                        response.data.forEach(element => {
                            console.log(element)
                            this.pumpmeterrecords.push(element)  
                        });
                        //this.pumpmeterrecords.push(response.data)
                    }
                });
            this.getPMR();
        }
    },
    mounted(){
        this.getPMR();
    }
}
</script>