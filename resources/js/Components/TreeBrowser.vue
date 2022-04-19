<template>

    <VueDraggableNext class="dragArea list-group w-full"
                      v-model="nodes"
                      :group="{  name: 'categories', put: true }"
                      @change="log"
    >

                        <div  v-for="node in nodes"
                              :key="node.title"
                              :style="{'margin-left': `${depth * 20}px`}"
            >
<!--    <button-->
<!--          @click="nodeClicked(node)"-->
<!--      >{{isExpanded(node) ? '- ' : '+ '}}</button>-->
                            <div >
                            <button  @click="nodeClicked(node)" v-if="isExpanded(node) && node.description==null " >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg>

                            </button>
                            </div>
                            <button @click="nodeClicked(node)" v-else-if="node.description==null">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                                </svg>


                            </button>
                            <span> &nbsp;</span>

                            <!--                            <CButton color="dark" variant="ghost">Dark</CButton>-->

                            <TitleModel   :node="node"/>
<!--                           <button class="btn-rounded btn-outline-dark" @click="editPost(node.id)">{{node.title}}</button>-->
<!--                            <div v-if="node.sub_category_id == null && node.description==null">-->
                                <CategoryModel :sub_category="node.id" v-if="node.sub_category_id == null && node.description==null"/>
<!--                                </div>-->
                            <PostModel :id="node.id" v-if="node.sub_category_id"/>

<!--                            <div >-->
<!--            <Link-->
<!--                              class=  "text-black"-->
<!--                :href="route('posts.edit', node.id)"-->
<!--            >-->
<!--               Edit-->
<!--            </Link>-->
<!--    <EditModel/>-->
<!--    <div >-->
        <!-- Button trigger modal -->
                            <span> &nbsp;</span>
                            <button  v-if="node.description" type="button" class="btn-rounded btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal2">
            <!--        <i class="fas fa-magic"></i>-->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
                            </button>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-green-700" id="exampleModalLabel">Create tag</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="createNewTag(node.id)">
                            <div>
                                <label for="title">Title tag</label>
                                <input
                                    type="text"
                                    :id="node.id"
                                    v-model="form3.tag"
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
                            <div class="modal-footer">
                                <button
                                    class="btn btn-success"
                                >
                                    Save
                                </button>
                            </div>
                        </form>

<!--                    </div>-->
                    <!--                    <div class="modal-footer">-->
                    <!--                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>-->
                    <!--                    </div>-->
                </div>
            </div>
        </div>
<!--    <TagModel :node="node"/>-->
<!--                                <p class="active:bg-gray-100" @click="isOpen = !isOpen"> new tag</p>-->

<!--            <div v-if="isOpen">-->
<!--                    <form @submit.prevent="createNewTag(node.id)">-->
<!--                        <div>-->
<!--                            <label for="title">Title tag</label>-->
<!--                            <input-->
<!--                                type="text"-->
<!--                                :id="node.id"-->
<!--                                v-model="form3.tag"-->
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

<!--                </form>-->
</div>



    <TreeBrowser
                v-if="isExpanded(node) && node.categories"
                :mainCategory="node.title"
                :nodes="node.categories"
                :depth="depth + 1"
                @onClick="(node) => $emit('onClick', node)"
            />
            <TreeBrowser
                v-if="isExpanded(node) && node.posts"
                :category="node.title"
                :categoryid="node.id"
                :nodes="node.posts"
                :depth="depth + 1"
                @onClick="(node) => $emit('onClick', node)"
            />

    </div>

    </VueDraggableNext>
    <div>



    </div>


</template>

<script>
import { CButton } from '@coreui/vue'

import { BButton } from 'bootstrap-vue-3'
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import {Head, Link, useForm} from "@inertiajs/inertia-vue3";
import BreezeNavLink from "@/Components/NavLink";
import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";
import { VueDraggableNext } from 'vue-draggable-next'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import TagModel from "@/Components/TagModel";
import EditModel from "@/Components/EditModel";
import CategoryModel from "@/Components/CategoryModel";
import PostModel from "@/Components/PostModel";
import TitleModel from "@/Components/TitleModel";

export default {

    props: {
        nodes: Array,
        category: '',
        categoryid: null,
        mainCategory: '',
        itemKey: null,
        tag: '',
        id: null,
        depth: {
            type: Number,
            default: 0,
        },
    },
    setup () {

        const form = reactive({
            search: null,

        })

        function submit() {
            Inertia.post('/search', form)
        }

        return { form, submit }
    },
    name: "TreeBrowser",
    components: {
        TitleModel,
        EditModel,
        Link,
        VueDraggableNext,
        BButton,
        TagModel,
        CategoryModel,
        CButton,
        PostModel

    },


    data() {
        return {
            drag: false,
            form2 : this.$inertia.form({
                mainCategoryTitle: this.mainCategory,
                categoryTitle: this.category,
                title: null,
                description: null,
            }),
            form3 : this.$inertia.form({
                tag: this.tag,
                id: this.id
            }),


            expanded: [],
        };
    },
    methods: {
        editPost(id)
        {
// Inertia.post()
        },
        createNewTag(id)
        {
            this.form3.post('/tag/'+ id);

        },
        log(/**Event*/evt){
            evt.added.element.category_id=this.categoryid;
            Inertia.put('tree/1', evt.added.element)

        },
        createNew() {
            this.form2.post('/tree');
        },
        isExpanded(node) {
            return this.expanded.indexOf(node) !== -1;
        },
        nodeClicked(node) {
            if (!this.isExpanded(node)) {
                this.expanded.push(node);
            } else {
                this.expanded.splice(this.expanded.indexOf(node));
            }
        },


    },

    computed: {},
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
