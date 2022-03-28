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
                <Link
                    class="text-green-700"
                    :href="route('test.edit', node.id)"
                >
                    Create
                </Link>
            </div>

            <TreeBrowser
                v-if="isExpanded(node) && node.categories"
                :nodes="node.categories"
                :depth="depth + 1"
                @onClick="(node) => $emit('onClick', node)"
            />
            <TreeBrowser
                v-if="isExpanded(node) && node.posts"
                :nodes="node.posts"
                :depth="depth + 1"
                @onClick="(node) => $emit('onClick', node)"
            />
        </div>
</template>

<script>

import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import {Head, Link} from "@inertiajs/inertia-vue3";
import BreezeNavLink from "@/Components/NavLink";

export default {
    name: "TreeBrowser",
    components: {
        Link
    },
    props: {
        nodes: Array,
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
