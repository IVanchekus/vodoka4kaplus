<template>
    <div>
        <h1 class="mt-3">Регистрация</h1>
        <form @submit.prevent="handleRegister">
            <div class="mb-3 col-6">
                <label for="name" class="form-label">Имя</label>
                <input type="name" class="form-control" v-model="formData.name">
            </div>
            <div class="mb-3 col-6">
                <label for="name" class="form-label">Email</label>
                <input type="email" class="form-control" v-model="formData.email">
            </div>
            <div class="mb-3 col-6">
                <label for="name" class="form-label">Пароль</label>
                <input type="password" class="form-control" v-model="formData.password">
            </div>
            <div class="mb-3 col-6">
                <label for="name" class="form-label">Повторите пароль</label>
                <input type="password" class="form-control" v-model="formData.password_confirmation">
            </div>
                <button class="btn btn-primary" type="submit">Регистрация</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import { ref, reactive } from 'vue';

export default{
    data(){ return {
        formData: reactive({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        })
    }
    },
    methods: {
        handleRegister() {
            axios
                .get('/sanctum/csrf-cookie')
                .then(response => {
                    axios
                        .post('/register', this.formData)
                        .then(response => {
                            console.log('User registered in!')
                            this.$router.go({name: 'bills.filter'})
                        })
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}

</script>