<template>
    <div class="row">
        <div class="col l8 s12 offset-l2">
            <h5 class="center">Welcome to {{ site.name }}</h5>
            <div class="divider"></div>
            <p class="error">{{ error }}</p>
            <qrcode-stream :camera="camera" @decode="onDecode" @init="onInit">
                <div class="loading-indicator" v-if="loading">
                    Loading...
                </div>
            </qrcode-stream>
            <div class="divider"></div>
            <div class="row">
                <h5 class="center">Announcements</h5>
                <div v-if="announcements.length > 0" class="col s12" v-for="a in announcements">
                    <div class="card">
                        <div class="card-content">
                            <b>{{ a.date }}</b>
                            <h6>{{ a.title }}</h6>
                        </div>
                    </div>
                </div>
                <div v-else class="center">
                    <h6>--No Announcement/s--</h6>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import { QrcodeStream } from 'vue-qrcode-reader'

    export default {
        props: ['site'],
        components: { QrcodeStream },

        data () {
            return {
                camera: 'auto',
                error: '',
                loading: false,
                destroyed: false,
                announcements: [],
            }
        },
        created(){
            window.axios.get(`/site-officer/get-announcements`).then(({data}) => {
                this.announcements = data
            })
        },
        methods: {
            onDecode (result) {
                window.axios.post(`/log-tourist/${result}`).then(({data}) => {
                    if(data.check_sched){
                        if(data.in){
                            swal({
                                title: `Welcome ${data.tourist.firstname} ${data.tourist.lastname} `,
                            });
                        } else {
                            swal({
                                title: `Thank you! Come Again next time!`,
                            });
                        }
                    } else {
                        swal({
                            title: `Sorry`,
                            text: `It seems that you have not book a visit today, kindly check your schedules first. Thank you`
                        });
                    }

                    this.reload();
                });
            },

            async onInit (promise) {
                await promise;
                try {
                    this.loading = true
                } catch (error) {
                    if (error.name === 'NotAllowedError') {
                        this.error = "ERROR: you need to grant camera access permisson"
                    } else if (error.name === 'NotFoundError') {
                        this.error = "ERROR: no camera on this device"
                    } else if (error.name === 'NotSupportedError') {
                        this.error = "ERROR: secure context required (HTTPS, localhost)"
                    } else if (error.name === 'NotReadableError') {
                        this.error = "ERROR: is the camera already in use?"
                    } else if (error.name === 'OverconstrainedError') {
                        this.error = "ERROR: installed cameras are not suitable"
                    } else if (error.name === 'StreamApiNotSupportedError') {
                        this.error = "ERROR: Stream API is not supported in this browser"
                    }
                } finally {
                    this.loading = false
                }
            },

            async reload () {
                this.destroyed = true

                await this.$nextTick()

                this.destroyed = false
            }
        }
    }
</script>

<style scoped>
    .error {
        font-weight: bold;
        color: red;
    }
</style>
