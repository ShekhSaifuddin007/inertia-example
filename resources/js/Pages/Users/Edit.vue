<template>
    <app-layout>
        <div class="container mt-5">
            <form @submit.prevent="updateUser">
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
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../Layout/AppLayout";

export default {
    name: "Edit",
    props: ['user'],
    components : {
        AppLayout
    },
    data() {
        return {
            form: {
                name: this.user.name,
                email: this.user.email,
            }
        }
    },
    methods: {
        updateUser() {
            this.$inertia.patch(`/users/${this.user.id}`, this.form)
                .then(() => {
                    // code...
                })
        }
    }
}
</script>

<style scoped>

</style>
