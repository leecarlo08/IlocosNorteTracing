<template>
    <div>
        <h3>{{ $route.name }}</h3>

        <router-view :auth="auth"></router-view>
    </div>
</template>

<script>
    export default {
        props: ['auth']
    }
</script>
