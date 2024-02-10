<template>
    <div>
        <h1 class="mt-3">Войти в профиль</h1>
        <form @submit.prevent="handleLogin">
            <div class="mb-3 col-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" v-model="formData.email">
            </div>
            <div class="mb-3 col-6">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" v-model="formData.password">
            </div>
            <button class="btn btn-primary" type="submit">Логин</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import { ref, reactive } from 'vue';

export default {
    data() {
        return {
            formData: reactive({
                email: '',
                password: ''
            })
        }
    },
    methods: {
        handleLogin() {
            axios
                .get('/sanctum/csrf-cookie')
                .then(response => {
                    axios
                        .post('/login', this.formData)
                        .then(response => {
                            console.log('User signed in!');
                            this.$router.go({name: 'bills.filter'});
                        })
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>