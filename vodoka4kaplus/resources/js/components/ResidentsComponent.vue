<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { onMounted } from 'vue';

const residents = ref([])

let resident_fio = ref()
let resident_area = ref()
let resident_start_date = ref()

const getResidents = () => {
    axios
        .get('/api/residents')
        .then((response) => {
            residents.value = response.data;
        })
}

const createResident = () => {
    console.log(resident_fio.value)
    axios
        .post('/api/residents/create/', {
                        fio: resident_fio.value,
                        area: resident_area.value,
                        start_date: resident_start_date.value
                    })
        .then((response) => {
            residents.value.push(response.data)
            console.log(response.data)
        })
}

onMounted(() => {
    getResidents();
})

</script>

<template>
    <div>
        <h1 class="mt-3">Список подключенных дачников</h1>
        <p v-for="res in residents">
            <router-link :to="{name: 'residents.resident', params: { resident: res['id']}}">{{ res['fio'] }}</router-link>
        </p>

        <h2>Добавить дачника</h2>

        <form @submit.prevent="createResident">
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

            <button class="btn btn-primary" type="submit">Сохранить</button>
        </form>
    </div>
</template>