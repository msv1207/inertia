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
    <p
          @click="nodeClicked(node)"
      >{{isExpanded(node) ? '&#8226 ' : ''}}{{node.title}}</p>

<div v-if="node.description">
            <Link
                              class=  "text-black"
                :href="route('posts.edit', node.id)"
            >
               Edit
            </Link>
                                <p class="active:bg-gray-100" @click="isOpen = !isOpen"> new tag</p>

            <div v-if="isOpen">
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

import { BButton } from 'bootstrap-vue-3'
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import {Head, Link, useForm} from "@inertiajs/inertia-vue3";
import BreezeNavLink from "@/Components/NavLink";
import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";
import { VueDraggableNext } from 'vue-draggable-next'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

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
        Link,
        VueDraggableNext,
        BButton

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


