<template>
    <Head title="Dashboard"/>

    <BreezeAuthenticatedLayout>
        <template #header>

            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Plan
            </h2>

            <div :style="{'float': 'right'}">
                <PlanModel/>
            </div>
            <div>
                <a class="btn btn-success" :href="'/generate-pdf'"> Pdf generete</a>
            </div>
            <br>

            <table class="table table-hover">
                <col style="width:5%">
                <col style="width:55%">
                <col style="width:25%">
                <col style="width:5%">

                <thead>
                <tr>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Time</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr class="holder" v-for="plan in plans.data" :key="plan.id">
                    <td>{{ plan.name }}</td>
                    <td>{{ plan.description }}</td>
                    <td> {{ plan.started_at }} <br>
                        {{ plan.ended_at }}
                    </td>
                    <td class='block'>
                        <a type="button" :href="'/plans/' + plan.id + '/edit'" style="color: #198754">
                            <i class="bi bi-plus-circle-fill"></i>
                        </a>
                        <br>
                        <button style="color: #DC3545" @click="destroy(plan.id)">
                            <i class="bi bi-dash-circle-fill"></i>
                        </button>

                    </td>
                </tr>
                </tbody>
            </table>
            <pagination :data="plans" @pagination-change-page="getResults">
                <template #prev-nav>
                    <span> Previous</span>
                </template>
                <template #next-nav>
                    <span>Next </span>
                </template>
            </pagination>

        </template>

    </BreezeAuthenticatedLayout>
</template>


<script>

import 'bootstrap-icons/font/bootstrap-icons.css'
import pagination from 'laravel-vue-pagination';
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import {Head} from "@inertiajs/inertia-vue3";
import {Inertia} from '@inertiajs/inertia'
import {reactive} from 'vue'
import PlanModel from "@/Components/PlanModel";


class Event {
    constructor(name, value) {
        this.name = name;
        this.value = value;
        this.time = new Date();
    };
}

export default {

    setup() {
        const form = reactive({
            title: null,
            calendar: null,
            description: null,
            token: null,

        })

        return {form}
    },
    name: "app",
    components: {
        BreezeAuthenticatedLayout,
        Head,
        PlanModel,
        pagination
    },
    props: {
        plans: [],
        dateInput: {
            placeholder: 'Select Date',
        },
    },

    data() {
        return {}
    },
    watch: {
        root: {
            deep: true,
            handler: (newRoot) => {
                console.log(newRoot);
            },
        },
    },
    computed: {},
    methods: {
        getResults(page) {
            if (typeof page === 'undefined') {
                page = 1;
            }

            Inertia.get('/plans?page=' + page)

        },


        destroy(id) {
            this.$inertia.delete(route("plans.destroy", id));
        },

    },
};
</script>
<style scoped lang="css">
.block {
    display: none
}

.holder:hover .block {
    display: block;
}
</style>
