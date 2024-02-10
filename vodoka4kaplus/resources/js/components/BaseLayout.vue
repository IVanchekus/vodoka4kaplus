<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <div v-if="name">
                <router-link class="navbar-brand" :to="{name: 'bills.filter'}">Главная</router-link>
                <router-link class="navbar-brand" :to="{name: 'month_costs'}">Тариф</router-link>
                <router-link class="navbar-brand" :to="{name: 'pump_meter_records'}">Показания счетчиков</router-link>
                <router-link class="navbar-brand" :to="{name: 'residents.residents'}">Дачники</router-link>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                        <li v-if="!name" class="nav-item">
                            <router-link class="nav-link" :to="{name: 'auth.login'}">Логин</router-link>
                        </li>
                        <li v-if="!name" class="nav-item">
                            <router-link class="nav-link" :to="{name: 'auth.register'}">Регистрация</router-link>
                        </li>
                        <li v-if="name" class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"
                                    href="/logout">
                                    Выйти
                            </a>
                            </div>
                        </li>
                </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';

export default{
    data(){ return{
        name: ref()
    }},
    methods:{
        getName(){
            axios
                .get('/api/user')
                .then((response) => {
                    this.name = response.data.name
                })
        }
    },
    mounted(){
        this.getName()
    }
}
</script>