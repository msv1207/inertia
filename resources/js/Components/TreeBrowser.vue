<template>

<!--        <template v-for="node in nodes">-->
    <VueDraggableNext class="dragArea list-group w-full" :group="{  put: true }"   v-for="node in nodes"
                      :key="node.title"
                      :style="{'margin-left': `${depth * 20}px`}"
                      :list="nodes"
                      @update="log(node)"
    >
<!--        v-for="node in nodes" :key="node.title">-->
<!--        v-model="nodes" item-key="node">-->
<!--        {{nodes.title}}-->
<!--        <template #item="{node}">-->
<!--            <div>{{node.title}}</div>-->

                        <div
            >
<!--        >-->

    <h5
          @click="nodeClicked(node)"
      >{{isExpanded(node) ? '&#8226 ' : ''}}{{node.title}}</h5>
<!--            <h5 > {{node.title}}</h5>-->
            <div :style="{'margin-left': `${depth * 20}px`}">
            <Link
                class="text-green-700"
                :href="route('posts.edit', node.id)"
            >
               Edit
            </Link>
</div>
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

            <div v-if="isShow">
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
                <Link
                    class="text-green-700"
                    :href="route('test.edit', node.id)"
                >
                    Create
                </Link>
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
                :nodes="node.posts"
                :depth="depth + 1"
                @onClick="(node) => $emit('onClick', node)"
            />
    <div>
        <div>
        <button @click="isShow = !isShow"> Create</button>
        </div>
        <div>
        <button @click="isOpen = !isOpen"> new tag</button>
        </div>
    </div>
    </div>
<!--        </template>-->

    </VueDraggableNext>

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
            // alert(this.form3.id)
            this.form3.post('/tag/'+ id);

        },
        log( id, /**Event*/evt){
            // alert("cecec")
            console.log(evt.);
            // console.log(id)
            // console.log(evt.newIndex)

        },
        createNew() {
            this.form2.post('/test');
        },
        isExpanded(node) {
            return this.expanded.indexOf(node) !== -1;
        },
        nodeClicked(node) {
            if (!this.isExpanded(node)) {
                // alert();
                this.expanded.push(node);
            } else {
                this.expanded.splice(this.expanded.indexOf(node));
            }
        },


    },

    computed: {},
};
</script>

<style scoped>
.node {
    text-align: left;
    font-size: 18px;
}
.type {
    margin-right: 10px;
}
</style>
