<template>
    <div>
        <h2 class="mt-3">Изменить запись</h2>
        <form @submit.prevent="updateResident">
            <div class="mb-3">
                <label class="form-label" for="fio">Фамилия</label>
                <input class="form-control" type="text" name="fio" id="fio" v-model="resident_fio">
            </div>

            <div class="mb-3">
                <label class="form-label" for="area">Площадь</label>
                <input class="form-control" type="text" name="area" id="area" v-model="resident_area">
            </div>

            <div class="mb-3">
                <label class="form-label" for="date">Дата регистрации</label>
                <input class="form-control" type="date" name="start_date" id="start_date" v-model="resident_start_date">
            </div>

            <button class="btn btn-primary mb-3" type="submit">Сохранить</button>
        </form>
        <button @click="deleteResident" class="btn btn-danger">Удалить</button>

        <div v-show="isNotDelete" class="alert alert-danger mt-3">Не удалось удалить пользователя (на него выставлены счета)</div>

        <h2 class="mt-3">Список выставленных счетов</h2>
        <table class="table table-light table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">Период</th>
                    <th scope="col">Сумма</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="bill in bills">
                    <th>{{ bill.begin_date.slice(0,7) }}</th> 
                    <td>{{ bill.amount_rub }} рубля</td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    import axios from 'axios';
    import 'vue-router';

    export default{
        data() { return{
            resident_fio: null,
            resident_area: null,
            resident_start_date: null,
            resident_id: null,

            isNotDelete: false,

            bills: []
        }},
        methods: {
            getResident: function() {
                axios
                    .get('/api/residents/' + this.$route.params.resident)
                    .then((response) => {
                        this.resident_fio = response.data['fio'];
                        this.resident_area = response.data['area'];
                        this.resident_id = response.data['id'];
                        this.resident_start_date = new Date(response.data['start_date']).toISOString().slice(0, 10);
                    });
                axios
                    .get('/api/bills/' + this.$route.params.resident)
                    .then((response) => {
                        console.log(response)
                        this.bills = response.data
                    })
            },
            updateResident: function(){
                axios
                    .put('/api/residents/' + this.resident_id, {
                        id: this.resident_id,
                        fio: this.resident_fio,
                        area: this.resident_area,
                        start_date: this.resident_start_date
                    })
                    .then((response) => {
                        this.$router.push({name: 'residents.residents'})
                });
            },
            deleteResident: function(){
                axios
                    .delete('/api/residents/'+ this.resident_id)
                    .then((response) => {
                        if (response.data) {
                            this.$router.push({name: 'residents.residents'})   
                        }
                        this.isNotDelete = true
                    })
            }
        },
        mounted() {
            this.getResident()
        },
    }    
</script>