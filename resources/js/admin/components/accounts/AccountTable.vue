<template>
    <div class="row">
        <div class="col-md-12">
            <h2 align="center">Tourist Spot Accounts</h2>
            <hr>
            <router-link class="btn btn-primary" to="/super-user/accounts/create">Create Tourist Spot</router-link>

            <table id="article-table" class="table table-bordered table-striped table-sm dataTable">
                <thead class="table-dark">
                <tr>
                    <th>username</th>
                    <th>Tourist Spot</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="a in accounts">
                    <td>{{ a.username }}</td>
                    <td>{{ a.spot }}</td>
                    <td>
                        <router-link class="btn btn-sm btn-dark" :to="`${$route.path}/${a.id}/edit`">View</router-link>
                        <!--<button id="del" class="btn btn-sm btn-danger" @click="deleteArticle(a.id)">Delete</button>-->
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                accounts: []
            }
        },
        created() {
            this.initData()
        },
        methods:{
            initData(){
                window.axios.get(`${this.$route.path}-data`).then(({data}) => {
                    if(data){
                        this.accounts = data;
                    }
                    this.dataTab();
                });
            },
        }
    }
</script>

<style scoped>

</style>
