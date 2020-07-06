<template>
    <div class="row">
        <div class="col s12 l4 offset-l4" v-if="!edit">
            <div class="card">
                <div class="card-content">
                    <h5>Schedule Details</h5>
                    <div class="divider"></div>

                    <p>Arrival Date: <b>{{ schedule.arrivalm }}</b> </p>
                    <p>Departure Date: <b>{{ schedule.departurem }}</b> </p>
                    <p>Mode of Transportation: <b>{{ (schedule.transportation === 1)? 'BUS' : ((schedule.transportation === 2)? 'PRIVATE VEHICLE' : 'AIRLINE') }}</b> </p>
                    <div class="divider"></div>

                    <p>Accommodation: </p>
                    <p style="padding-left: 20px;"><b>{{ schedule.accommodation }}</b><br>
                        <small>{{ schedule.address }}</small></p>

                    <div class="divider"></div>
                    <div class="center" style="margin-top: 10px">
                        <button class="btn grey lighten-3 black-text waves-effect waves-light" @click="edit=1">Edit</button><br><br>
                        <router-link to="/profile/my-qr" class="btn blue darken-3">My QR Code</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 l12" v-if="edit">
            <h5>Update Schedule</h5>
            <form @submit.prevent="saveSchedule">

                <div class="row">
                    <div class="col l5 m12 s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="arrival" type="date" v-model="schedule.arrival" class="validate" required/>
                                <label for="arrival">Arrival</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="departure" type="date" v-model="schedule.departure" class="validate" required/>
                                <label for="departure">Departure</label>
                            </div>

                            <div class="input-field col s12 row">
                                <b>Transportation:</b><br>
                                <div class="col s4">
                                    <label>
                                        <input v-model="schedule.transportation" value="1" type="radio"/>
                                        <span>Bus</span>
                                    </label>
                                </div>
                                <div class="col s4">
                                    <label>
                                        <input v-model="schedule.transportation" value="2" type="radio"/>
                                        <span>Private Vehicle</span>
                                    </label>
                                </div>
                                <div class="col s4">
                                    <label>
                                        <input v-model="schedule.transportation" value="3" type="radio"/>
                                        <span>Airline</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l5 m12 s12 offset-l1">
                        <div class="row">
                            <div class="input-field col s12">
                                <p>Accommodation</p>
                                <suggestions
                                    v-model="schedule.accommodation"
                                    :options="options"
                                    :onItemSelected="onAccommItemSelected"
                                    :onInputChange="onAccommInputChange"
                                >

                                    <div slot="item" slot-scope="props" class="single-item">
                                        <span class="name"><strong>{{props.item.name}}</strong> <br><small>{{props.item.username}}</small></span>
                                    </div>
                                </suggestions>
                            </div>
                            <div class="input-field col s12">
                                <input id="address" type="text" v-model="schedule.address" class="validate" required/>
                                <label for="address">Address</label>
                            </div>


                            <div class="col s12 center">
                                <button class="btn blue darken-3" type="submit">SAVE</button>
                                <button class="btn btn-flat" @click="edit = 0">Cancel</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                edit: 0,
                schedule: []
            }
        },
        mounted(){
            $('.datepicker').datepicker();
            this.initData()
        },
        methods:{
            initData(){
                window.axios.get(`/profile/schedule-data/${this.$route.params.id}`).then(({data}) => {
                    this.schedule = data;
                })
            },
            onAccommInputChange (query) {
                if (query.trim().length < 3) {
                    return null
                }

                const url = '/get-accommodation-name?term='+query;

                return new Promise(resolve => {
                    axios.get(url).then(({data}) => {
                        const  items = [];
                        console.log(data);
                        data.forEach((item) => {
                            if (item) {
                                items.push(item)
                            }
                        });
                        resolve(items)
                    });
                });
            },
            onAccommItemSelected (data) {
                this.schedule.accommodation = data.name;
                this.schedule.accommodationId = data.id;
                this.schedule.address = data.address;
            },
            saveSchedule(){
                window.axios.post(`/profile/schedule/${this.schedule.id}/update`, this.schedule).then(({data}) => {
                    if(data){
                        this.initData();
                        swal('Schedule updated!');
                        this.edit = 0;
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
