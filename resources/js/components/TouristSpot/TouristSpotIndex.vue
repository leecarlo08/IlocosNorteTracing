<template>
    <div class="row">
        <div class="col s12 col">
            <div class="col s6 center"><router-link to="/profile/my-qr" class="btn-test">My QR</router-link></div>
            <div class="col s6 center"><router-link to="/profile/schedule" class="btn-test">My Schedules</router-link></div>

        </div>
        <div class="col s12">
            <div class="divider"></div>
            <h5 class="center">Tourist Spots</h5>
        </div>
        <div class="col l4 m4 s6" v-for="s in spots">
            <div class="card">
                <div class="card-image">
                    <img :src="s.image">
                </div>
                <div class="card-content">
                    <p>
                        {{ s.name }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                spots: []
            }
        },
        mounted(){
            this.initData();
        },
        methods: {
            initData(){
                window.axios.get(`/get-spots`).then(({data}) => {
                    this.spots = data;
                })
            }
        }
    }
</script>

<style scoped>
    .btn-test{
        padding: 20px 10px;
        border: #0D47A1 solid 2px;
        color: #0D47A1;
        font-weight: 600;
        display: block;
        text-transform: uppercase;
        margin: 10px;
    }
    .card{
        height: 250px;
    }
    .card-image{
         max-height: 150px;
         overflow: hidden;
     }
    @media only screen and (max-width: 992px){
        .card-image{
            max-height: 120px;
        }
        .card{
            height: 200px;
        }
    }
    @media only screen and (max-width: 660px){
        .card-image{
            max-height: 110px;
        }
    }

</style>
