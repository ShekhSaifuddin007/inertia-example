<template>
    <app-layout>
        <div class="container mt-5">
            I'm from welcome page: {{ foo }}
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "../Layout/AppLayout";

    export default {
        name: "Welcome",
        props: ['foo'],

        components: {
            AppLayout
        }
    }
</script>

<style scoped>

</style>
