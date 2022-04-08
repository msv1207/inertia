<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Post
            </h2>
<!--{{root[1].title}}-->
            <form @submit.prevent="submit">
                <div>
                    <label for="search">search</label>
                    <input
                        type="text"
                        id="search"
                        v-model="form.search"
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

                <!-- submit -->
                    <button
                        class="
                                        px-6
                                        py-2
                                        text-white
                                        bg-gray-900
                                        rounded
                                    "
                    >
                        search
                    </button>

                <ul id="example-1">
                    <li v-for="item in searchRes" :key="item.title">
                        {{ item.title }}
                    </li>
                </ul>
            </form>
<!--            <tree-view  id="my-tree" :initial-model="tree(dataModel)"></tree-view>-->
        </template>
        <div id="app">




        </div>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4">
                        <div :style="  {  'float' : 'left',  'width': '600px'} ">
                            <TreeBrowser
                                :nodes="root"
                                @onClick="nodeWasClicked"
                            />
                        </div>
                        <div v-if="isOpen" :style="  {  'float' : 'right'} ">

                        <form @submit.prevent="createNew()">
<div>
                            <label for="title">Title category</label>
                            <input
                                type="text"
                                v-model="form2.categoryTitle"
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
                            <label for="title">Title main category</label>
                            <input
                                type="text"
                                v-model="form2.mainCategoryTitle"
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
                            <label for="title">Title</label>
                            <input
                                type="text"
                                v-model="form2.title"
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
                            <label for="title">Description</label>
                            <textarea
                                type="text"
                                v-model="form2.description"
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
                            >
                                            </textarea>
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
                                Save
                            </button>
                        </div>
                            </form>
</div>





                    </div>
                        <div :style="  {  'float' : 'left',  'width': '1000px', 'margin-right': '110'} ">
                            <div>
                                <div>
                                    <p  class="text-green-700" @click="isShow = !isShow"> Create</p>
                                </div>
<!--                            <Link-->
<!--                                class="-->
<!--                                    px-6-->
<!--                                    py-2-->
<!--                                    mb-2-->
<!--                                    text-green-100-->
<!--                                    bg-green-500-->
<!--                                    rounded-->
<!--                                "-->
<!--                                :href="route('posts.create')"-->
<!--                            >-->
<!--                                Posts Create-->
<!--                            </Link>-->
                            </div>
                        </div>
                    <br>
                    <br>
                            <div :style="  {  'float' : 'left',  'width': '600px', 'margin-right':' 200px'} " >
                        <table>
                            <thead class="font-bold bg-gray-300 border-b-2">
                            <tr>
                                <th class="px-4 py-2" @click="sort('id')">Id</th>
                                <th class="px-4 py-2" @click="sort('title')">Title</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="post in sortedPosts" :key="post.id">
                                <td >{{ post.id }}</td>
                                <td >{{ post.title }}</td>
                                <td >{{ post.description }}</td>
                                <td class="px-4 py-2 font-extrabold">
                                    <Link class="text-green-700" :href="route('posts.edit', post.id)">
                                        Edit
                                    </Link>
                                    <br>
                                    <Link
                                        class="text-green-700"
                                        :href="route('posts.show', post.id)"
                                    >
                                        Show
                                    </Link>
                                    <Link
                                        @click="destroy(post.id)"
                                        class="text-red-700"
                                    >Delete</Link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
<!--                        <pagination :links="posts.links" />-->
                    </div>
                </div>
                <tbody>
                <tr v-for="post in searchRes" :key="post.id">
                    <td >{{ post.id }}</td>
                    <td >{{ post.title }}</td>
                    <td >{{ post.description }}</td>
                    <td class="px-4 py-2 font-extrabold">
                    </td>
                </tr>
                </tbody>
<!--                {{searchRes.description}}-->

                <!--                {{sortedPosts}}-->
<!--                {{this.posts.sort}}-->
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


export default {

        setup () {
            const form = reactive({
                search: null,

            })

            function submit() {
                Inertia.post('/search', form)
            }

            return { form, submit }
        },
    name: "app",
    components: {
        BreezeAuthenticatedLayout,
        Head,
        TreeBrowser,
        BreezeNavLink,
        Link,
        draggable,
    },
    props: {
        posts: [],
        categories: [],
        searchRes: []
    },

    data(){
        return {
            root: this.categories,
            search: '',
            form2 : this.$inertia.form({
                mainCategoryTitle: null,
                categoryTitle: null,
                title: null,
                description: null,
            }),
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
        nodeWasClicked(node) {
            console.log(node.name);
        },
        sortedPosts:function() {
            return this.posts.data.sort((a,b) => {
                let modifier = 1;
                if(this.currentSortDir === 'desc') modifier = -1;
                if(this.currentSortDir === 'asc') modifier = +1;
                if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                return 0;
            });
        }
    },
    methods: {

        createNew() {
            this.form2.post('/tree');
        },
        destroy(id) {
            this.$inertia.delete(route("posts.destroy", id));
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
