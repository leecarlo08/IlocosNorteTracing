<template>
    <div class="row">
        <div class="col s12">
            <h5 class="center">Tourist Spot Tourist Reporting</h5>
            <div class="divider"></div>
            <table class="table striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="l in logs">
                    <td>{{l.name}}</td>
                    <td>{{l.date}}</td>
                    <td>{{l.time_in}}</td>
                    <td>{{l.time_out}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                logs: []
            }
        },
        created() {
            this.initData();
        },
        methods: {
            initData(){
                window.axios.get(`/site-officer/get-logs`).then(({data}) => {
                    this.logs = data
                })
            }
        }
    }
</script>

<style scoped>

</style>
