<template>
    <div class="container mb-5 mt-3">
        <div v-if="$page.flash.success" class="alert alert-success">
            {{ $page.flash.success }}
        </div>
        <div class="d-flex w-100 mt-5 mb-2">
            <inertia-link :href="route('users.create')" class="btn btn-primary">Create User</inertia-link>
            <form class="w-50 ml-auto" @submit.prevent="search">
                <input v-model="form.search" type="text" class="form-control" placeholder="Search User">
            </form>
            <button class="button" @click="reset">Reset</button>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="text-center">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody class="text-center">
            <tr v-for="(user, index) in users.data" :key="user.id">
                <td>{{ index+1 }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>
                    <inertia-link :href="route('users.edit', user.id)" class="btn btn-sm btn-info text-white">
                        Edit
                    </inertia-link>
                    <button type="button" class="btn btn-sm btn-danger" @click="deleteUser(user)">
                        Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <div v-if="users.prev_page_url === null" style="border-radius: 5px; cursor: pointer; padding: 5px 7px; background: rgb(90 98 104 / 10%)">Prev</div>
            <inertia-link v-else :href="users.prev_page_url" style="border-radius: 5px; cursor: pointer; padding: 5px 7px; background: rgb(90 98 104 / 10%)">Prev</inertia-link>

            <div v-for="page in pages" :key="page" @click.prevent="changePage(page)" style="color: #1f6fb2; border-radius: 5px; cursor: pointer; padding: 5px 7px; background: rgb(90 98 104 / 10%)">
                {{ page }}
            </div>

            <div v-if="users.next_page_url === null" style="border-radius: 5px; cursor: pointer; padding: 5px 7px; background: rgb(90 98 104 / 10%)">Next</div>
            <inertia-link v-else :href="users.next_page_url" style="border-radius: 5px; cursor: pointer; padding: 5px 7px; background: rgb(90 98 104 / 10%)">Next</inertia-link>
        </div>

<!--        <pagination :links="users.links"/>-->
    </div>
</template>

<script>
import AppLayout from "../../Layout/AppLayout";
import {mapValues} from "lodash";
// import Pagination from "../../components/Pagination";

export default {
    name: "Index",
    layout: AppLayout,
    props: {
        users : Object,
        success: String
    },
    components: {
        //Pagination
    },

    data() {
        return {
            form: {
                search : ''
            },
            offset: 50
        }
    },

    computed: {
        pages() {
            let pages = [];

            let from = this.users.current_page - Math.floor(this.offset / 2);

            if (from < 1) {
                from = 1;
            }

            let to = from + this.offset -1;

            if (to > this.users.last_page) {
                to = this.users.last_page
            }

            while (from <= to) {
                pages.push(from);
                from++;
            }

            return pages;
        }
    },

    methods : {
        changePage(page) {
            this.users.current_page = page;
            console.log(this.users.current_page)
            this.$inertia.replace(`/users?page=${this.users.current_page}`)
        },
        deleteUser(user) {
            if (confirm('Are you sure to delete this record? this can\'t be undone')) {
                this.$inertia.delete(this.route('users.destroy', user.id))
            }
        },
        search() {
            this.$inertia.replace(this.route('users.index', { search: this.form.search }))
        },
        reset() {
            this.form = mapValues(this.form, () => null)
            this.$inertia.replace(this.route('users.index'))
        },
    }
}
</script>

<style scoped>
    .button {
        outline: none;
        border: none;
        background: transparent;
        margin-left: 10px;
        font-weight: 600;
    }
    .button:focus {
        outline: none;
        border: none;
    }
</style>
