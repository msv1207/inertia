<template>
    <!-- Button trigger modal -->

    <button @click="Show=true"
        class="btn-rounded btn-outline-success"
            type="button"  data-bs-toggle="modal" data-bs-target="#table"
    ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
    </svg></button>



    <!--     Modal -->
    <div v-if="Show"  class="modal fade" id="table" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div  class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-green-700" id="exampleModalLabel">{{node.title}}</h5>
                    <button @click="Show=false" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updatePost(node.id)">
                        <!--                        <form v-if="node.sub_category_id" @submit.prevent="updateCat(node.id)">-->
                        <!--                            <form v-if="node.sub_category_id == null && node.description==null" @submit.prevent="updateMainCat(node.id)">-->

                        <div>
                            <label for="title">Title Post</label>
                            <input
                                type="text"
                                v-model="form4.title"
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
                        <div >
                            <label for="discription">Description</label>
                            <vue-editor
                                v-model="form4.description"

                            >
                            </vue-editor>
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
                    <!--                        </form>-->
                    <!--                    </form>-->
<!--                    <form v-if="node.sub_category_id" @submit.prevent="updateCat(node.id)">-->
<!--                        &lt;!&ndash;                            <form v-if="node.sub_category_id == null && node.description==null" @submit.prevent="updateMainCat(node.id)">&ndash;&gt;-->

<!--                        <div>-->
<!--                            <label for="title">Title Post</label>-->
<!--                            <input-->
<!--                                type="text"-->
<!--                                v-model="form4.title"-->
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
<!--                        <div v-if="node.description">-->
<!--                            <label for="title">Description</label>-->
<!--                            <vue-editor-->
<!--                                v-model="form4.description"-->

<!--                            >-->
<!--                            </vue-editor>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; submit &ndash;&gt;-->
<!--                        <div class="modal-footer">-->
<!--                            <button-->
<!--                                class="btn btn-success"-->
<!--                            >-->
<!--                                Save-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                    &lt;!&ndash;                        </form>&ndash;&gt;-->
<!--                    &lt;!&ndash;                    </form>&ndash;&gt;-->
<!--                    <form v-if="node.sub_category_id == null && node.description==null" @submit.prevent="updateMainCat(node.id)">-->

<!--                        <div>-->
<!--                            <label for="title">Title Post</label>-->
<!--                            <input-->
<!--                                type="text"-->
<!--                                v-model="form4.title"-->
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
<!--                        <div v-if="node.description">-->
<!--                            <label for="title">Description</label>-->
<!--                            <vue-editor-->
<!--                                v-model="form4.description"-->

<!--                            >-->
<!--                            </vue-editor>-->
<!--                        </div>-->
<!--                        &lt;!&ndash; submit &ndash;&gt;-->
<!--                        <div class="modal-footer">-->
<!--                            <button-->
<!--                                class="btn btn-success"-->
<!--                            >-->
<!--                                Save-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->

<!--                &lt;!&ndash;                    <div class="modal-footer">&ndash;&gt;-->
<!--                &lt;!&ndash;                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>&ndash;&gt;-->
<!--                &lt;!&ndash;                    </div>&ndash;&gt;-->
            </div>
        </div>
    </div>
    </div>
</template>
<script>
//importing bootstrap 5
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
import { VueEditor } from "vue3-editor";

export default {
    components: {
        VueEditor
    },
    data(){
        return {
            form4 : this.$inertia.form({
                // categoryId:this.id,
                title: this.node.title,
                description: this.node.description,
            }),
            Show:false,
        }
    },
    props:{
        node:Object,
    },
    methods:{

        updatePost(id){
            this.form4.put('/post/' + id);
        },
    }
}
</script>
