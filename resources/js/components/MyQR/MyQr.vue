<template>
    <div class="row">
        <div class="col s12 ">
            <h5 class="center">My QR</h5>
            <div class="divider"></div>
            <div class="qr-box" v-if="status === 1">
                <div class="qr-container">
                    <q-r-code :text="my_qr"></q-r-code>
                </div>
            </div>
            <div class="col l6 m12 s12 offset-l3" v-if="status === 0">
                <p>
                    Hello! It seem that you have not created an schedule yet.
                    To view your "QR Code" kindly Create at least one schedule.
                    Your QR serves as your Pass to enter the province and different tourist spots.
                    To create Schedule you may open the menu button then select "MY SCHEDULE" or you may
                    click <router-link to="/profile/schedule">HERE</router-link>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import QRCode from "vue-qr-generator";
    export default {
        components: {QRCode},
        data() {
            return {
                my_qr: null,
                status:  null
            }
        },
        created() {
            this.initData();
        },
        methods: {
            initData(){
                window.axios.get('/get-my-qr').then(({data}) => {
                        this.my_qr = data.username;
                        this.status = data.status;
                })
            }
        }
    }
</script>

<style scoped>
    .qr-box{
        padding: 80px 10px;
        border: #dddddd 1px;
    }
</style>
