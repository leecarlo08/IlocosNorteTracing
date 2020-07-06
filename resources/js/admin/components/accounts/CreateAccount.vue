<template>
    <div class="row">
        <div class="col-md-12">
            <h2>Create Account</h2>
            <hr>
            <form @submit.prevent="save">
                <div class="form-group">
                    <label>Tourist Spot</label>
                    <select class="form-control" v-model="account.tourist_spot_id">
                        <option>--Select Tourist spot--</option>
                        <option v-for="s in spots" :value="s.id" >{{ s.name }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" v-model="account.username" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" v-model="account.password" placeholder="Enter password" required>
                    <p style="color: red" v-if="err.pass">Password did not match</p>
                </div>
                <div class="form-group">
                    <label for="rpassword">Retype Password</label>
                    <input @keyup="checkPass" type="password" class="form-control" id="rpassword" v-model="account.rpassword" placeholder="Verify password" required>

                </div>
                <div align="center">
                    <router-link to="." class="btn btn-default">Back</router-link>
                    <button class="btn btn-secondary" type="submit">Next</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                spots: '',
                account: {
                    tourist_spot_id: null,
                    username: null,
                    password: null,
                    rpassword: '',

                },
                err: {
                    pass: 0
                }
            }
        },
        mounted(){
            this.initData();
        },
        methods: {
            initData(){
                window.axios.get(`/super-user/spot-data`).then(({data}) => {
                    if(data){
                        this.spots = data;
                    }
                });
            },
            checkPass(){
                if(this.account.password !== this.account.rpassword){
                    this.err.pass = 1;
                } else {
                    this.err.pass = 0;
                }
            },
            save() {
                let uri = this.$route.path;
                window.axios.post( uri , this.account).then(({data}) => {
                    if(data){
                        this.$router.push(`/super-user/accounts`);
                    }
                })
            },
        }
    }
</script>

<style scoped>

</style>
