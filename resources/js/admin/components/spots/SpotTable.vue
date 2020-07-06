<template>
    <div class="row">
        <div class="col-md-12">
            <h2 align="center">Tourist Spots</h2>
            <hr>
            <router-link class="btn btn-primary" to="/super-user/spot/create">Create Tourist Spot</router-link>

            <table id="article-table" class="table table-bordered table-striped table-sm dataTable">
                <thead class="table-dark">
                <tr>
                    <th>Tourist Spot</th>
                    <th></th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="a in articles">
                    <td>{{ a.name }}</td>
                    <td><img :src="a.image" width="130px"/></td>
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
        data(){
            return{
                articles: []
            }
        },
        created() {
            this.initData();
        },
        methods: {
            initData(){
                window.axios.get(`/super-user/spot-data`).then(({data}) => {
                    if(data){
                        this.articles = data;
                    }
                    this.dataTab();
                });
            },
            dataTab(){
                $(function (){
                    $('#article-table').DataTable({
                        processing: true
                    });
                });
            },

            deleteArticle(val){
                $('#article-table').DataTable().destroy();
                let type = this.$route.path;
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this article!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        window.axios.post( type+'/delete/'+val).then(({data}) => {
                            if(data){
                                $('#article-table').DataTable().destroy();
                                this.dataTab();
                            }
                        });
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
