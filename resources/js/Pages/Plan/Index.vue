<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                plan
            </h2>
            <!--{{root[1].title}}-->
            <form>
            <div id="app">
                <date-picker
                    language="fr"
                    :dateInput="dateInput"
                    apply-button-label="use"
                    :show-helper-buttons="true"
                    :switch-button-initial="true"
                    :is-monday-first="true"
                    @date-applied="selectDate"
                    />
            </div>
            </form>
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
        // const form = reactive({
        //     search: null,
        //
        // })
        //
        // function submit() {
        //     Inertia.plan('/search', form)
        // }
        //
        // return { form, submit }
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
    arr.push(date1, date1);

    Inertia.post('/plans', arr)
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
