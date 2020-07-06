<template>
    <ul class="sidenav grey-text text-darken-4" id="mobile-demo">
        <li>
            <router-link to="/site-officer/">SCAN</router-link>
        </li>
        <li>
            <router-link to="/site-officer/reports">SITE REPORT</router-link>
        </li>
        <li>
            <a href="#" @click="logoutUser">LOGOUT</a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['user'],
        methods:{
            logoutUser(){
                this.$emit('logoutMe');
            }
        }
    }
</script>

<style scoped>

</style>
