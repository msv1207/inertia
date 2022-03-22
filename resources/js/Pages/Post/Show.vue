<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{posts.title}}
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1>Description:</h1>
                        <div>
                            <p>{{posts.description}}</p>
                        </div>
                        <Link
                            class="text-green-700"
                            :href="route('posts.edit', posts.id)"
                        >Edit
                        </Link>

                        <div>
                        <Link
                            @click="destroy(posts.id)"
                            class="text-red-700"
                        >Delete</Link>
                        </div>
                        <div class="mb-4">
                            <Link
                                class="text-green-700"
                                :href="route('posts.create')"
                            >
                                Posts Create
                            </Link>

                        </div>
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
import { bTreeView } from 'vue3-treeview';
export default {


    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeNavLink,
        Link,
        bTreeView
    },
    props: {
        posts: Object,
    },
    data() {
        return {
            config: {
                roots: ["id1", "id2"],
            },
            nodes: {
                id1: {
                    text: "text1",
                    children: ["id11", "id12"],
                },
                id11: {
                    text: "text11",
                },
                id12: {
                    text: "text12",
                },
                id2: {
                    text: "text2",
                },
            },
        }
    },
    methods: {
        destroy(id) {
            this.$inertia.delete(route("posts.destroy", id));
        },
    },
};
</script>
