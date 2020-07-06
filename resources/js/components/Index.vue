<template>
    <div>
        <div class="left">
            <button class="btn-floating waves-effect waves-light grey lighten-4" type="button" @click="$router.go(-1)"><i class="material-icons grey-text text-darken-3">arrow_back</i></button>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
    }
</script>
