<template>
    <div>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/super-user">ADMIN | MMSU Website</a>
            <ul class="navbar-nav px-3">

                <li class="nav-item text-nowrap">
                    <a href="#" class="nav-link" @click="adminLogout">
                        Logout
                    </a>

                </li>

            </ul>
            <div class="mob">
                    <span @click="openNav" v-if="activeMob=== 0" style="font-size:30px;color:white; padding-left: 20px">&#9776;</span>
                    <span @click="openNav" v-if="activeMob=== 1" style="font-size:30px;color:white; padding-left: 20px">&times;</span>
                <span class="navm">ADMIN</span>
            </div>
        </nav>
        <admin-side-nav :auth="auth"></admin-side-nav>
        <div id="mySidenav" class="sidenav">
            <a class="closebtn" @click="openNav">&times;</a>
            <router-link v-if="auth.role === 1 || auth.role === 2 " to="/super-user">
                Home
            </router-link>
            <router-link v-if="auth.role === 1 || auth.role === 2 " to="/super-user/news">
                News
            </router-link>
            <router-link v-if="auth.role === 1 || auth.role === 2  || auth.role === 3 " to="/super-user/announcements">
                Announcements
            </router-link>
            <router-link v-if="auth.role === 1 || auth.role === 2 " to="/super-user/events">
                Events
            </router-link>
            <router-link v-if="auth.role === 1 || auth.role === 2 || auth.role === 3 " to="/super-user/opportunities">
                Opportunities
            </router-link>
            <router-link v-if="auth.role === 1 || auth.role === 2 " to="/super-user/publications">
                Publications
            </router-link>
            <router-link v-if="auth.role === 1 || auth.role === 2 " to="/super-user/publications">
                Downloads
            </router-link>
            <router-link v-if="auth.role === 1 || auth.role === 2 " to="/super-user/videos">
                Videos
            </router-link>
            <router-link v-if="auth.role === 1 || auth.role === 2 " to="/super-user/galleries">
                Gallery
            </router-link>
            <router-link v-if="auth.role === 1 || auth.role === 2 "  to="/super-user/calendar">
                Calendar
            </router-link>
            <hr>
            <router-link v-if="auth.role === 1"  to="/super-user/accounts">
                Accounts
            </router-link>
            <router-link v-if="auth.role === 1"  to="/super-user/pages">
                Pages
            </router-link>
            <a href="#" @click="adminLogout">
                Logout
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props:['auth'],
        data(){
            return{
                activeMob: 0
            }
        },
        methods: {
            adminLogout(){
                window.axios.post(`/super-user/logout`).then(({data}) => {
                    window.location.href = '/super-user';
                })
            },
            openNav(){
                if(this.activeMob === 0){
                    this.activeMob = 1
                    document.getElementById("mySidenav").style.width = "250px";
                } else {
                    this.activeMob = 0
                    document.getElementById("mySidenav").style.width = "0";
                }
            }
        },
        watch:{
            $route (to, from){
                if(screen.width < 766)
                    this.openNav();
            }
        }
    }
</script>

<style scoped>
    .mob {
        display: none;
    }
    @media only screen and (max-width: 766px) {
        .navbar-nav, .navbar-brand{
            display: none;
        }
        .mob{
            display: flex;
        }
        .navm{
            color: white;
            line-height: 50px;
            font-size: large;
            padding-left: 20px;
        }
    }
    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        z-index: 999;
    }

    .sidenav a {
        padding: 5px 5px 5px 32px;
        text-decoration: none;
        font-size: 20px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }
</style>
