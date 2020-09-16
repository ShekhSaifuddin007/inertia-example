<template>
    <app-layout>
        <div class="container mt-5">
            <form @submit.prevent="createUser">
                <div class="form-group">
                    <label>Name</label>
                    <input v-model="form.name" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                    <div v-if="$page.errors.name" class="text-danger">{{ $page.errors.name }}</div>
                </div>

                <div class="form-group">
                    <label>Email address</label>
                    <input v-model="form.email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter email">
                    <div v-if="$page.errors.email" class="text-danger">{{ $page.errors.email }}</div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input v-model="form.password" type="password" class="form-control" placeholder="Password">
                    <div v-if="$page.errors.password" class="text-danger">{{ $page.errors.password }}</div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../Layout/AppLayout";

export default {
    name: "Create",
    // props: ['errors'],
    components: {
        AppLayout
    },
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
            }
        }
    },
    methods : {
        createUser() {
            this.$inertia.post('/users', this.form)
                .then(() => {
                    // code...
                })
        }
    }
}
</script>

<style scoped>

</style>
