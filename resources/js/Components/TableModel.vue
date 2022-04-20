<template>

    <button @click="Show=true"
            style="color: #198754"

            type="button"  data-bs-toggle="modal" data-bs-target="#table"
    >
        <i class="bi bi-plus-circle-fill"></i>

    </button>
    <div v-if="Show"  class="modal fade" id="table" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div  class="modal-dialog modal-lg">
            <div class="modal-content">
                <div  class="modal-header">
                    <h5 class="modal-title text-green-700" id="exampleModalLabel">{{node.title}}</h5>
                    <button @click="Show=false" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updatePost(node.id)">

                        <div>
                            <label for="title">Title Post</label>
                            <input
                                type="text"
                                v-model="formT.title"
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
                            <label for="description">Description</label>
                            <vue-editor
                                v-model="formT.description"

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

            </div>
        </div>
    </div>
    </div>
</template>
<script>
import 'bootstrap-icons/font/bootstrap-icons.css'
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
import { VueEditor } from "vue3-editor";

export default {
    components: {
        VueEditor,
    },
    data(){
        return {
            formT : this.$inertia.form({
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
            this.formT.put('/post/' + id);
        },
    }
}
</script>
