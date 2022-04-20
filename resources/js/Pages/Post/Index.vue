<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
<!--            <div  :style="  {  'float' : 'left'} ">-->
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Post
            </h2>
<!--                </div>-->
<!--            <div  :style="  {  'float' : 'left'} ">-->
<!--                <div>-->
                <CustomModel/>
<!--                </div>-->
<!--            </div>-->

<!--            <Modal-->
<!--                v-model="isShow"-->
<!--                :close="closeModal"-->
<!--            >-->
<!--                <div class="modal">-->
<!--                    <p>-->
<!--                        Hello-->
<!--                    </p>-->
<!--                    <button @click="closeModal">-->
<!--                        close-->
<!--                    </button>-->
<!--                </div>-->
<!--            </Modal>-->
<!--            <div >-->

<!--                <button @click="open = true">modal-basic</button>-->
<!--            </div>&lt;!&ndash;            <custom-model></custom-model>&ndash;&gt;-->
            <div  :style="  {  'float' : 'right'} ">

            <form @submit.prevent="submit">
                <div>
                    <div class="input-group">
                        <div class="form-outline">

                        <input                         v-model="form.search"
                                                       type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            </div>

                        <button  type="submit" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
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
                            <div  :style="  {  'float' : 'left'} ">

                                <MainCategotyModel/>
<br>
                                <br>
                                <TreeBrowser
                                :nodes="root"
                                @onClick="nodeWasClicked"
                            />
                             </div>
                            <div  :style="  {  'float' : 'right', 'width':'70%'} " v-show="show">
                                <table class="table table-hover">
                                    <col style="width:10%">
                                    <col style="width:80%">
                                    <col style="width:10%">
                                    <thead>
                                    <tr>
                                        <!--                    <th class="px-4 py-2">Post Id</th>-->
                                        <th class="px-4 py-2">Title</th>
                                        <th  class="px-4 py-2">Description</th>
                                        <th class="px-4 py-2"></th>

                                    </tr>
                                    </thead>
                                    <tbody >
                                    <tr class="holder" v-for="post in searchRes" :key="post.id">
                                        <!--                    <td >{{ getPost(post) }}</td>-->
                                        <!--                    <td >{{ post.post_id }}</td>-->
                                        <td >{{ post.title }} <button  @click="filter(post)" class="badge btn-success">{{ post.tag }}</button></td>

                                        <td
                                            v-html="post.description"
                                        ></td>
<!--                                        <a @click="filter(post)" class="badge badge-info">{{ post.tag }}</a>-->
<!--                                        <button @click="filter(post)" type="button" class="btn btn-outline-info">{{ post.tag }}</button>-->
<!--                                        <a href="#" class="badge badge-info">Info</a>-->

<!--                                        <td @click="filter(post)">{{ post.tag }}</td>-->
                                        <td class='block'>
<!--                                            <PostModel />-->
<!--                                            <TitleModel :node="post"/>-->
<!--                                            <button-->
<!--                                                class="btn-rounded btn-outline-success"-->
<!--                                            ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">-->
<!--                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>-->
<!--                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>-->
<!--                                            </svg></button>-->
                                            <TableModel :node="post"/>
<br>
<!--                                            <Link-->
<!--                                                class="text-green-700"-->
<!--                                                :href="route('posts.show', post.id)"-->
<!--                                            >-->
<!--                                                Show-->
<!--                                            </Link>-->
                                            <button
                                                @click="destroy(post.id)"
                                                class="btn-rounded btn-outline-danger"
                                            ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                            </svg></button>
                                            
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
<div id="My">


<!--                        <form @submit.prevent="createNew()">-->
<!--<div>-->
<!--                            <label for="title">Title category</label>-->
<!--                            <input-->
<!--                                type="text"-->
<!--                                v-model="form2.categoryTitle"-->
<!--                                class="-->
<!--                                                    w-full-->
<!--                                                    px-4-->
<!--                                                    py-2-->
<!--                                                    mt-2-->
<!--                                                    border-->
<!--                                                    rounded-md-->
<!--                                                    focus:outline-none-->
<!--                                                    focus:ring-1-->
<!--                                                    focus:ring-blue-600-->
<!--                                                "-->
<!--                            />-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label for="title">Title main category</label>-->
<!--                            <input-->
<!--                                type="text"-->
<!--                                v-model="form2.mainCategoryTitle"-->
<!--                                class="-->
<!--                                                    w-full-->
<!--                                                    px-4-->
<!--                                                    py-2-->
<!--                                                    mt-2-->
<!--                                                    border-->
<!--                                                    rounded-md-->
<!--                                                    focus:outline-none-->
<!--                                                    focus:ring-1-->
<!--                                                    focus:ring-blue-600-->
<!--                                                "-->
<!--                            />-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label for="title">Title</label>-->
<!--                            <input-->
<!--                                type="text"-->
<!--                                v-model="form2.title"-->
<!--                                class="-->
<!--                                                    w-full-->
<!--                                                    px-4-->
<!--                                                    py-2-->
<!--                                                    mt-2-->
<!--                                                    border-->
<!--                                                    rounded-md-->
<!--                                                    focus:outline-none-->
<!--                                                    focus:ring-1-->
<!--                                                    focus:ring-blue-600-->
<!--                                                "-->
<!--                            />-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label for="title">Description</label>-->
<!--                            <textarea-->
<!--                                type="text"-->
<!--                                v-model="form2.description"-->
<!--                                class="-->
<!--                                                    w-full-->
<!--                                                    px-4-->
<!--                                                    py-2-->
<!--                                                    mt-2-->
<!--                                                    border-->
<!--                                                    rounded-md-->
<!--                                                    focus:outline-none-->
<!--                                                    focus:ring-1-->
<!--                                                    focus:ring-blue-600-->
<!--                                                "-->
<!--                            >-->
<!--                                            </textarea>-->
<!--                        </div>-->

<!--                        &lt;!&ndash; submit &ndash;&gt;-->
<!--                        <div class="flex items-center mt-4">-->
<!--                            <button-->
<!--                                class="-->
<!--                                                    px-6-->
<!--                                                    py-2-->
<!--                                                    text-white-->
<!--                                                    bg-gray-900-->
<!--                                                    rounded-->
<!--                                                "-->
<!--                            >-->
<!--                                Save-->
<!--                            </button>-->
<!--                        </div>-->
<!--                            </form>-->

<!--                        </div>-->
                        </div>





                    </div>


<!--                            <div :style="  {  'float' : 'right'} " >-->
<!--                        <table>-->
<!--                            <thead class="font-bold bg-gray-300 border-b-2">-->
<!--                            <tr>-->
<!--&lt;!&ndash;                                <th class="px-4 py-2" @click="sort('id')">Id</th>&ndash;&gt;-->
<!--                                <th class="px-4 py-2" @click="sort('title')">Title</th>-->
<!--                                <th class="px-4 py-2">Description</th>-->
<!--                                <th class="px-4 py-2">Tag</th>-->
<!--                                <th class="px-4 py-2">Actions</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            <tr v-for="post in sortedPosts" :key="post.id">-->
<!--&lt;!&ndash;                                <td >{{ post.id }}</td>&ndash;&gt;-->
<!--                                <td >{{ post.title }}</td>-->
<!--                                <td v-html="post.description"></td>-->
<!--                                <td > {{ getTag(post.tags[0]) }}</td>-->

<!--                                <td class="px-4 py-2 font-extrabold">-->
<!--                                    <Link class="text-green-700" :href="route('posts.edit', post.id)">-->
<!--                                        Edit-->
<!--                                    </Link>-->
<!--                                    <br>-->
<!--                                    <Link-->
<!--                                        class="text-green-700"-->
<!--                                        :href="route('posts.show', post.id)"-->
<!--                                    >-->
<!--                                        Show-->
<!--                                    </Link>-->
<!--                                    <Link-->
<!--                                        @click="destroy(post.id)"-->
<!--                                        class="text-red-700"-->
<!--                                    >Delete</Link>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
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
import Modal from "@/Jetstream/Modal";
import { ref } from 'vue'
import VueUniversalModal from 'vue-universal-modal'
import CustomModel from "@/Components/TreeModel";
import MainCategotyModel from "@/Components/MainCategotyModel";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
import PostModel from "@/Components/PostModel";
import TitleModel from "@/Components/TitleModel";
import TagModel from "@/Components/TagModel";
import TableModel from "@/Components/TableModel";
// app.use(VueUniversalModal, {
//     teleportTarget: '#modals'
// })

export default {


        setup () {
            const show = ref(false)
            const isShow = ref(false)

            function showModal () {
                isShow.value = true
            }

            function closeModal () {
                isShow.value = false
            }

            const form = reactive({
                search: null,

            })

            function submit() {
                show.value=true
                Inertia.post('/search', form)
            }

            return { form, submit, show, isShow,
                showModal,
                closeModal }
        },
    name: "app",
    components: {
        PostModel,
        Modal,
        BreezeAuthenticatedLayout,
        Head,
        TreeBrowser,
        BreezeNavLink,
        Link,
        draggable,
        CustomModel,
        MainCategotyModel,
        TitleModel,
        TagModel,
        TableModel
    },
    props: {
        posts: [],
        categories: [],
        searchRes: []
    },
    el: '#My',

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
            filter(title)
            {
                Inertia.post('/filter', title)

            },
            getPost(post)
            {
                if (typeof post.post_id === 'undefined')
                    return post.id
                else
                    return post.post_id
            },
            getTag(tag){
                if (typeof tag === 'undefined') {

                }
                else
                    return tag.title
            },
        // createNew() {
        //     this.form2.post('/tree');
        // },
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
<style scoped lang="css">
.block{
    /*position:absolute;*/
    /*left:0;*/
    /*bottom:0;*/
    /*right:0;*/
    /*background:rgba(255,255,255, 0.7);*/
    /*padding:20px;*/
    display:none
}
.holder:hover .block{
    display:block;
}
</style>
