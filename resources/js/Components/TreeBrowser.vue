<template>
        <div
            v-for="node in nodes"
            :key="node.title"
            :style="{'margin-left': `${depth * 20}px`}"
            class="node"
        >
      <span

          class="type"
          @click="nodeClicked(node)"
      >{{isExpanded(node) ? '&#9660;' : '&#9658;'}}</span>
            <span class="type">&#9671;</span>
            <span>{{node.title}}</span>
            <div :style="{'margin-left': `${depth * 20}px`}">
            <Link
                class="text-green-700"
                :href="route('posts.edit', node.id)"
            >
               Edit
            </Link>
                <div v-if="isShow">
                    <form @submit.prevent="submit">
                        <div>
                            <label for="title">Title category</label>
                            <input
                                type="text"
                                v-model="category"
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
                                v-model="mainCategory"
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
                                v-model="node.title"
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
                                name="description"
                                type="text"
                                v-model="node.description"
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
        </div>
    <div>

        <button @click="isShow = !isShow">click Me</button>
    </div>
        </div>
</template>

<script>

import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import {Head, Link, useForm} from "@inertiajs/inertia-vue3";
import BreezeNavLink from "@/Components/NavLink";
import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";

export default {

    setup () {
        const form2 = reactive({
            mainCategoryTitle: this.mainCategory,
            title: this.form2.title,
            email: null,
        })

        function submit() {
            Inertia.post('/users', form2)
        }

        return { form, submit }

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
        Link
    },

    props: {
        nodes: Array,
        category: '',
        mainCategory: '',
        depth: {
            type: Number,
            default: 0,
        },
    },
    data() {
        return {
            expanded: [],
        };
    },
    methods: {
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

<style scoped>
.node {
    text-align: left;
    font-size: 18px;
}
.type {
    margin-right: 10px;
}
</style>
