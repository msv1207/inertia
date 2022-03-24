<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Post
            </h2>
<!--            <tree-view  id="my-tree" :initial-model="tree(dataModel)"></tree-view>-->

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
                        <pagination :links="posts.links" />
                    </div>
                </div>
<!--                {{tree(6)}}-->
<!--                {{dataModel1[0]["children"]}}-->
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";
import TreeView from "@grapoza/vue-tree";
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeNavLink,
        Link,
        TreeView
    },
    props: {
        posts: [],
        dataModel: []
    },
    data(){
        return {
            currentSort: 'id',
            currentSortDir: 'desc',
            dataModel1: [
                {id: "numberOrString", label: "Root Node", children: [
                        {id: 1, label: "Child Node",  children: [
                                {id: 1, label: "Child Node"},
                                {id: "node2", label: "Second Child"}]},
                        {id: "node2", label: "Second Child"}]
                }],
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
    methods: {


        // remove (arr, indexes) {
        //     var arrayOfIndexes = [].slice.call(arguments, 1);  // (1)
        //     return arr.filter(function (item, index) {         // (2)
        //         return arrayOfIndexes.indexOf(index) == -1;      // (3)
        //     });
        // },
        // tree(s)
        // { let sum='';
        //     for (let dataModelKey in this.dataModel) {
        //         this.dataModel1[dataModelKey]["label"]=this.dataModel[dataModelKey]["name"];
        //         // alert(this.dataModel1[dataModelKey]["label"])
        //         this.dataModel1[dataModelKey]["children"]=this.dataModel[dataModelKey]["team_of_people"];
        //         // alert(this.dataModel1[dataModelKey]["children"])
        //         for (let dataKey in this.dataModel1[dataModelKey]) {
        //             if (dataKey == 'label' || dataKey == 'children') {
        //                 this.dataModel1[dataModelKey]['children']['label'] = this.dataModel1[dataModelKey]['children']['name'];
        //                 this.dataModel1[dataModelKey]['children']['children'] = this.dataModel1[dataModelKey]['children']['department'];
        //             }
        //             else{
        //                 // this.dataModel1[dataModelKey]['children'].splice(dataKey, dataKey);
        //                 this.remove(this.dataModel1[dataModelKey]['children'], dataKey)
        //             }
        //         }


                    // this.dataModel1[dataModelKey]['children']['children']['label']=this.dataModel1[dataModelKey]['children']['children']['name']

                    // }
                // if (dataModelKey=)

             // this.dataModel1[0]["label"]=this.dataModel[0]["name"];
            // return sum;
        //     return this.dataModel1;
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
