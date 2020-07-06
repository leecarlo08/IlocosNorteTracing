<template>
    <div class="row">
        <div class="col s12"  v-if="status === 1">
            <h5 class="center">My Schedules</h5>
            <router-link class="btn blue darken-3" to="/profile/schedule/create">New Schedule</router-link>

            <div class="divider" style="margin-top: 10px"></div>
            <div class="row" v-if="schedules.length > 0">
                <div v-for="s in schedules" class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <div class="row" style="margin-bottom: 0">
                                <router-link class="col" tag="div" :to="`/profile/schedule/${s.id}/view`">
                                    <h6 style="margin-top: 7px"><b>{{ s.arrival }} - {{ s.departure }}</b></h6>
                                </router-link>
                                <div class="col right">
                                    <button class="btn small red darken-2" @click="deleteSched(s)"><i class="material-icons">close</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="row">
                <div class="col s12">
                    <h6 class="center">--No Schedule Yet--</h6>
                </div>
            </div>
        </div>


        <div class="col l6 m12 s12 offset-l3" v-if="status === 0">
            <h6>Before Proceeding Kindly Answer this Quick Survey</h6> <br>
            <form @submit.prevent="updateAccount">
                <div class="row">
                    <b>Country(ies) worked, visited and transisted in the <u>last 30 days:</u></b>
                    <div class="input-field col s12">
                        <input id="country" type="text" v-model="account.country" class="validate"/>
                        <label for="country">Country</label>
                    </div>
                    <div class="input-field col s12 row">
                        <b>Have you been sick in the <u>past 30 days</u>?</b><br>
                        <div class="col s4">
                            <label>
                                <input v-model="account.sick" :value="1" type="radio" required/>
                                <span>YES</span>
                            </label>
                        </div>
                        <div class="col s4">
                            <label>
                                <input v-model="account.sick" :value="0" type="radio" required/>
                                <span>NO</span>
                            </label>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="divider"></div>
                    </div>
                    <div class="input-field col s12 row">
                        <b>DECLARATION:</b>
                        <p align="justify">The information I have given is true, correct and complete, i understand failure to answer any question may have serious consequences <b>(Article 171 and 172 of the Revised Penal Code of the Philippines)</b></p>
                        <div class="col s5">
                            <label>
                                <input v-model="account.agree" :value="1" type="radio" required/>
                                <span>I Agree</span>
                            </label>
                        </div>
                        <div class="col s5">
                            <label>
                                <input v-model="account.agree" :value="0" type="radio" required/>
                                <span>I Disagree</span>
                            </label>
                        </div>
                    </div>

                    <div  class="input-field col s12 center" v-if="account.agree === 1">
                        <button class="btn blue darken-3" type="submit" @click="updateAccount">save</button>
                    </div>
                    <div v-if="account.agree === 0" style="color: red">
                        Please click agree if you want to proceed.
                    </div>
                </div>

            </form>
        </div>
        <div class="col l6 m12 s12 offset-l3" v-if="status === 2">
            <h6>Sorry</h6> <br>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                schedules:[],
                status: null,
                account: {
                    country: null,
                    sick: null,
                    agree: null
                }
            }
        },
        mounted(){
            this.initData();
        },
        methods: {
            initData(){
                window.axios.get(`/profile/get-schedules`).then(({data}) => {
                    this.schedules = data.sched;
                    this.status = data.status;
                });
            },

            deleteSched(val){
                swal({
                    title: `Delete Schedule`,
                    text: `Are you sure you want to delete ${val.arrival}-${val.departure} schedule `,
                    icon: `warning`,
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if(willDelete){
                        window.axios.post(`/profile/delete-schedule/${val.id}`).then(({data}) => {
                            if(data){
                                this.initData();
                            }
                        })
                    }
                })
            },

            updateAccount(){
                window.axios.post('/profile/agree', this.account).then(({data}) => {
                    if(data){
                        this.initData();
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
