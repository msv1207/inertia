<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Post
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4">
                            <Link
                                class="
                                    px-6
                                    py-2
                                    mb-2
                                    text-green-100
                                    bg-green-500
                                    rounded
                                "
                                :href="route('posts.create')"
                            >
                                Posts Create
                            </Link>
                        </div>
                        <table>
                            <thead>
                            <tr>
                                <th @click="sort('id')">Id</th>
                                <th @click="sort('title')">Title</th>
                                <th >Description</th>
                                <th >Actions</th>
                            </tr>
<!--                            <td >Id</td>-->
<!--&lt;!&ndash;                            <p>Кнопка выше была нажата {{ counter }} раз</p>&ndash;&gt;-->
<!--                            <td>Title</td>-->
<!--                            <td>Description</td>-->
<!--                            <td class="px-4 py-2">Actions</td>-->
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
                        <pagination :links="posts.links" />
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
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeNavLink,
        Link,
    },
    props: {
        // sortBy: 'ID',
        // sortDirection: 'asc',
        posts: [],
    },
    data(){
        return {
            currentSort: 'id',
            currentSortDir: 'desc',
            counter: 0,
            pos: [],
        }
    },
    computed:{
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
    // computed: {
    //     sortedProducts: function(){
    //         return this.products.sort((p1,p2) => {
    //             let modifier = 1;
    //             if(this.sortDirection === 'desc') modifier = -1;
    //             if(p1[this.sortBy] < p2[this.sortBy]) return -1 * modifier; if(p1[this.sortBy] > p2[this.sortBy]) return 1 * modifier;
    //             return 0;
    //         });
    //     }
    // },
    // created:function() {
    //         .then(res => res.json())
    //         .then(res => {
    //             this.cats = res;
    //         })
    // },
    methods: {
        destroy(id) {
            this.$inertia.delete(route("posts.destroy", id));
        },
        sort: function(s){
            // alert(this.currentSort)
            if(s === this.currentSort) {
                this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
            }
            this.currentSort = s;
        }
    },
};
</script>
