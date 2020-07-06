<template>
    <ul class="sidenav grey-text text-darken-4" id="mobile-demo">
        <li>
            <router-link to="/profile">HOME</router-link>
        </li>
        <li>
            <router-link to="/profile/my-qr">MY QR</router-link>
        </li>
        <li>
            <router-link to="/profile/schedule">MY SCHEDULE</router-link>
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
