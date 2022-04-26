<template>
    <Head title="Dashboard"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Post
            </h2>
            <TreeModel/>
            <div :style="  {  'float' : 'right', 'width': '50%'} ">
                <form @submit.prevent="submit">
                    <div class="input-group input-group-sm mb-3 ">
                        <input v-model="form.search"
                               type="search" class="form-control" placeholder="Search" aria-label="Search"
                               aria-describedby="search-addon"/>
                        <div class="input-group-append">
                            <button @click="isshow=true" type="submit" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>


                </form>
            </div>
        </template>
        <div id="app">


        </div>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white">
                        <div class="mb-4">
                            <div :style="  {  'float' : 'left'} ">

                                <MainCategotyModel/>
                                <br>
                                <br>
                                <TreeBrowser
                                    :nodes="root"
                                    @onClick="nodeWasClicked"
                                />
                            </div>
                            <div :style="  {  'float' : 'right', 'width':'70%'} " v-if="isshow">


                                <table class="table table-hover">
                                    <col style="width:10%">
                                    <col style="width:80%">
                                    <col style="width:10%">

                                    <thead>
                                    <tr>
                                        <th class="px-4 py-2">Title</th>
                                        <th class="px-4 py-2">Description</th>
                                        <th class="px-4 py-2"></th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr class="holder" v-for="post in searchRes" :key="post.id">

                                        <td>{{ post.title }}
                                            <button @click="filter(post)" class="badge btn-success">{{
                                                post.tag
                                                }}
                                            </button>
                                        </td>

                                        <td
                                            v-html="post.description"
                                        ></td>

                                        <td class='block'>

                                            <TableModel :node="post"/>
                                            <br>

                                            <button
                                                @click="destroy(post.id)"
                                                style="color: #DC3545"
                                            >
                                                <i class="bi bi-dash-circle-fill"></i>
                                            </button>

                                        </td>
                                    </tr>

                                    </tbody>

                                </table>

                            </div>
                        </div>

                        <div id="My">


                        </div>


                    </div>


                </div>


            </div>

        </div>


    </BreezeAuthenticatedLayout>
</template>

<script>
import 'bootstrap-icons/font/bootstrap-icons.css'
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TreeBrowser from "@/components/TreeBrowser.vue";
import {Inertia} from '@inertiajs/inertia'
import draggable from 'vuedraggable'
import MainCategotyModel from "@/Components/MainCategotyModel";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
import 'bootstrap-icons/font/bootstrap-icons.css'
import TreeModel from "@/Components/TreeModel";
import {reactive} from "vue";
import TableModel from "@/Components/TableModel";


export default {


    setup() {
        var isshow=false

        const form = reactive({
            search: null,
        })
        function submit() {
            Inertia.post('/search', form)

        }

        return {
            form, submit,

        }
    },
    name: "app",
    components: {
        BreezeAuthenticatedLayout,
        Head,
        TreeBrowser,
        draggable,
        MainCategotyModel,
        TableModel,
        TreeModel
    },
    props: {
        posts: [],
        categories: [],
        searchRes: Object
    },
    el: '#My',

    data() {
        return {
            pageNumber: 0,
            root: this.categories,
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
    computed: {
        nodeWasClicked(node) {
            console.log(node.name);
        },


    },

    methods: {

        filter(title) {
            Inertia.post('/filter', title)

        },


        destroy(id) {
            this.$inertia.delete(route("posts.destroy", id));
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
