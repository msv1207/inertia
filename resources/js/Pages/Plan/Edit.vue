<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
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
                                    send
                                </button>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>

                        </form>
                    </div>
                </div>
            </div>
        </div>
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
import 'vue-time-date-range-picker/dist/vdprDatePicker.min.css';
export default {
    setup () {
        const form = reactive({
            title: null,
            calendar:null,
            description:null

        })
        //
        function submit() {
            // Inertia.put('plans'+ this.plan, this.form)
            // this.form.put('', this.plan));
        }
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
        plan: Object,
        dateInput: {
            placeholder: 'Select Date',
        },
    },
    methods: {
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
        submit() {
            Inertia.put('/plans/'+ this.plan, this.form)
        },
    },
};
</script>
