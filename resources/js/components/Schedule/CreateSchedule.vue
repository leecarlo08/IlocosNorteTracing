<template>
    <div>
        <h5 class="center">New Schedule</h5>
        <form @submit.prevent="saveSchedule">

            <div class="row">
                <div class="col l5 m12 s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="arrival" type="date" v-model="schedule.arrival"  class="validate" required/>
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
                            <div v-if="err.transportation && !schedule.transportation" class="col s12 red-text">*Please Select one Mode Transportation</div>
                        </div>

                        <!--<div class="input-field col s12">-->
                            <!--<input id="accommodation" type="text" v-model="schedule.accommodation" class="validate" required/>-->
                            <!--<label for="accommodation">Accommodation</label>-->
                        <!--</div>-->
                        <!--<div class="input-field col s12">-->
                            <!--<input id="address" type="text" v-model="schedule.address" class="validate" required/>-->
                            <!--<label for="address">Address</label>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="col l5 m12 s12 offset-l1">
                    <div class="row">
                        <div class="input-field col s12">
                            <!--<input id="accommodation" type="text" v-model="schedule.accommodation" class="validate" required/>-->

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

                        <!--<div class="input-field col s12 row">-->
                            <!--<b>Traveling as a Group?</b><br>-->
                            <!--<div class="col s4">-->
                                <!--<label>-->
                                    <!--<input v-model.number="schedule.group" value="1" type="radio" required/>-->
                                    <!--<span>YES</span>-->
                                <!--</label>-->
                            <!--</div>-->
                            <!--<div class="col s4">-->
                                <!--<label>-->
                                    <!--<input v-model.number="schedule.group" value="0" type="radio" required/>-->
                                    <!--<span>NO</span>-->
                                <!--</label>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="input-field col s12" v-if="schedule.group === 1">-->
                            <!--<h6>Add Names</h6>-->
                            <!--<small class="red-text text-darken-3">Note: "Before adding names make sure each one on your group already registered on this system, otherwise you will not be able to add their name/s"</small>-->

                            <!--<div v-if="schedule.tourists.length > 0">-->
                                <!--<p class="tourist" v-for="(item, index) in schedule.tourists">-->
                                    <!--<b>{{ item.name }}</b><br>-->
                                    <!--<small>{{ item.username }}</small>-->
                                    <!--<button type="button" class="test" @click="removeTourist(index)">Remove</button>-->
                                <!--</p>-->
                            <!--</div>-->

                            <!--<suggestions-->
                                <!--v-model="query"-->
                                <!--:options="options"-->
                                <!--:onItemSelected="onSearchItemSelected"-->
                                <!--:onInputChange="onTouristInputChange"-->
                            <!--&gt;-->

                                <!--<div slot="item" slot-scope="props" class="single-item">-->
                                    <!--<span class="name"><strong>{{props.item.name}}</strong> <br><small>{{props.item.username}}</small></span>-->
                                <!--</div>-->
                            <!--</suggestions>-->
                        <!--</div>-->

                        <div class="col s12 center">
                            <button class="btn blue darken-3" type="submit">SAVE</button>
                            <router-link class="btn btn-flat" tag="a" to="/profile/schedule">Cancel</router-link>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                schedule: {
                    arrival: null,
                    departure: null,
                    transportation: null,
                    accommodationId: null,
                    accommodation: null,
                    address: null,
                    // group: null,
                    // tourists: []
                },
                query: '',
                options: {
                    // placeholder: 'Search & Select name by typing (Firstname Lastname)'
                    placeholder: 'Accommodation Name'
                },
                err: {
                    transportation: null
                }
            }
        },
        mounted(){
            $('.datepicker').datepicker();
        },
        methods: {
            onTouristInputChange (query) {
                if (query.trim().length < 3) {
                    return null
                }

                const url = '/get-tourist-name?term='+query;

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
            onSearchItemSelected (data) {
                this.query = null;
                this.schedule.tourists.push(data);
            },
            onAccommItemSelected (data) {
                this.schedule.accommodation = data.name;
                this.schedule.accommodationId = data.id;
                this.schedule.address = data.address;
            },
            removeTourist(val){
                this.schedule.tourists.splice(val, 1);
            },

            checkErr(){
                if(this.schedule.transportation){
                    this.err.transportation = 0;
                } else {
                    this.err.transportation = 1;
                }
            },

            saveSchedule(){
                if(this.schedule.transportation){
                    window.axios.post(`/profile/schedule/create`, this.schedule).then(({data}) => {
                        if(data){
                            this.$router.push('/profile/schedule');
                        }
                    })
                } else {
                    this.err.transportation = 1;
                }
            }
        },
    }
</script>

<style scoped>

    .single-item{
        padding: 10px 5px;
        font-size: 16px;
        background-color: #fafafa;
    }

    .tourist{
        margin: 5px;
        padding: 7px;
        line-height: 12px;
        background-color: rgba(0, 176, 255, 0.15);
    }
    .test{
        background-color: red;
        border: none;
        color: white;
        float: right;
        margin-top: -10px;
        font-weight: 600;
    }
</style>
