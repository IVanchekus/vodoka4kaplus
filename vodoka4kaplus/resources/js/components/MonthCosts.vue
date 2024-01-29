<template>
    
</template>

<script>
    export default {
        data(){ return{
            number: null
        }},
        methods: {
            check_number(number){
                this.number = number.target.value.replace(/[^0-9]/g, "");
            }
        }
        
    }
</script>