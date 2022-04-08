<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Plan
            </h2>
            <!--{{root[1].title}}-->
            <div :style="{'float': 'right', 'margin-right': '0'}">
                <H1>Create new </H1>
            <form @submit.prevent="submit()">
                <div>
                    <label for="title">title</label>
                    <input
                        v-model="form.title"
                        type="text"
                        id="title"
                        class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                    />
                </div>
                <div>
                    <label for="description">description</label>
                    <input
                        v-model="form.description"
                        type="text"
                        id="description"
                        class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                    />
                </div>
                <div id="app">
                    <date-picker
                        language="fr"
                        :dateInput="dateInput"
                        :show-helper-buttons="true"
                        :switch-button-initial="true"
                        :is-monday-first="true"
                        @date-applied="selectDate"
                    />
                </div>

                <!-- submit -->
                <div class="flex items-center mt-4">
                    <button
                        class="
                                        px-6
                                        py-2
                                        text-white
                                        bg-gray-900
                                        rounded
                                    "
                    >
                        Send
                    </button>
                </div>
            </form>
                </div>

            <br>

            <div>
            <a class="px-6
                                    py-2
                                    mb-2
                                    text-green-100
                                    bg-green-500
                                    rounded" v-bind:href="'/generate-pdf'"> Pdf generete</a>
</div>
            <br>

            <table>
                <thead class="font-bold bg-gray-300 border-b-2">
                <tr>
                    <th class="px-4 py-2">Id</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Time</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="plan in plans" :key="plan.id">
                    <td >{{ plan.id }}</td>
                    <td >{{ plan.name }}</td>
                    <td >{{ plan.description }}</td>
                    <td >From {{ plan.started_at}} to {{ plan.ended_at}}</td>
                    <td class="px-4 py-2 font-extrabold">
                        <Link class="text-green-700" :href="route('plans.edit', plan.id)">
                            Edit
                        </Link>
                        <br>

                        <Link
                            @click="destroy(plan.id)"
                            class="text-red-700"
                        >Delete</Link>
                    </td>
                </tr>
            </tbody>
            </table>

        </template>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";
import TreeBrowser from "@/components/TreeBrowser.vue";
import { Inertia } from '@inertiajs/inertia'
import { reactive } from 'vue'
import draggable from 'vuedraggable'
import DatePicker, { CalendarDialog } from 'vue-time-date-range-picker/dist/vdprDatePicker'
import 'vue-time-date-range-picker/dist/vdprDatePicker.min.css'
class Event {
    constructor(name, value) {
        this.name = name;
        this.value = value;
        this.time = new Date();
    }
}

export default {

    setup () {
        const form = reactive({
            title: null,
            calendar:null,
            description:null

        })
        //
        // function submit() {
        //     Inertia.post('/plans', form)
        // }
        //
        return { form }
    },
    name: "app",
    components: {
        BreezeAuthenticatedLayout,
        Head,
        TreeBrowser,
        BreezeNavLink,
        Link,
        draggable,
        DatePicker,
        CalendarDialog
    },
    props: {
        plans: [],
        dateInput: {
            placeholder: 'Select Date',
        },
    },

    data() {
        return {
            events: [],

        }
    },
    watch: {
        root: {
            deep: true,
            handler: (newRoot) => {
                console.log(newRoot);
            },
        },
    },
    computed:{
        // nodeWasClicked(node) {
        //     console.log(node.name);
        // },
        // sortedplans:function() {
        //     return this.plans.data.sort((a,b) => {
        //         let modifier = 1;
        //         if(this.currentSortDir === 'desc') modifier = -1;
        //         if(this.currentSortDir === 'asc') modifier = +1;
        //         if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
        //         if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
        //         return 0;
        //     });
        // }
    },
    methods: {
        submit() {
            Inertia.post('/plans', this.form)
        },
        selectDate(date1, date2)
{
    let arr=[]
    // // console.log(req)
    // this.events.push(
    //     new Event('select-date', `${date1.toString()} - ${date2.toString()}`),
    // );
    // Inertia.post('/plans', date1
    // )
    // this.events.push(
    //     new Event('select-date', `${date1.toString()} - ${date2.toString()}`),
    // );
    // Inertia.post('/plans', z)
    arr.push(date1, date2);
    this.form.calendar=arr;
    // Inertia.post('/plans', arr)
},


        destroy(id) {
            this.$inertia.delete(route("plans.destroy", id));
        },

        sort: function(s){
            if(s === this.currentSort) {
                this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
            }
            this.currentSort = s;
        }
    },
};
</script>
