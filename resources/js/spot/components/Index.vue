<template>
    <router-view :site="siteOfficer"></router-view>
</template>
<script>
    export default {
        data(){
            return {
                siteOfficer: null
            }
        },
        mounted() {
            this.initData();
        },
        methods: {
            initData(){
                window.axios.get(`/site-officer/site-info`).then(({data}) => {
                    this.siteOfficer = data;
                })
            }
        }
    }
</script>
