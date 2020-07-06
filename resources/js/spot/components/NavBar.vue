<template>
    <div>
        <nav class="blue darken-3">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="/site-officer/" class="brand-logo">
                        <div class="row">
                            <div class="col in-logo">
                                <img class="in-image" src="https://ilocosnorte.gov.ph/img/pgin-logo-scaled.png">
                            </div>
                            <div class="col label-logo">
                                <p  class="rp">
                                    T<small>OURTIST</small>
                                    R<small>EGISTRATION</small> & <br>
                                    I<small>NFORMATION</small> S<small>YSTEM</small>
                                </p>
                            </div>
                        </div>
                    </a>


                    <a v-if="auth" href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                    <ul class="right hide-on-med-and-down">
                        <li v-if="auth">
                            <router-link to="/site-officer/reports">
                                SITE REPORT
                            </router-link>
                        </li>
                        <li v-if="auth">
                            <a class="dropdown-trigger" href="#!" data-target="dropdown1">{{ auth.username }}<i class="material-icons right">arrow_drop_down</i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <ul id='dropdown1' class='dropdown-content' style="top: 50px">
            <li><a class="blue-text text-darken-3" href="#!" @click="logout"><b>LOGOUT</b></a></li>
        </ul>
        <side-nav :user="auth" @logoutMe="logout"></side-nav>
    </div>
</template>

<script>
    export default {
        props: ['auth'],
        mounted() {
            $('.sidenav').sidenav();
            $('.dropdown-trigger').dropdown({
                hover: true,
            });
        },
        methods:{
            logout(){
                window.axios.post('/site-officer/logout', {_token: document.head.querySelector('meta[name="csrf-token"]')}).then(({data}) => {
                    window.location.href = '/site-officer/login';
                })
            }
        }
    }
</script>

<style scoped>
    .in-logo{
        max-height: 90px !important;
        padding-right: 7px !important;
    }
    .in-image{
        max-height: 60px;
        margin-top: 5px;
    }
    .rp{
        font-size: 18px;
        line-height: 14px;
        font-weight: 600;
    }

    @media only screen and (max-width: 992px){
        .label-logo{
            display: none;
        }
        nav{
            position: fixed;
            z-index: 999;
        }
    }
</style>
