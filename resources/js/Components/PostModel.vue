<template>
    <!-- Button trigger modal -->
    <span> &nbsp;</span>

    <button @click="Show=!Show" type="button"            style="color: #198754"
            data-bs-toggle="modal" data-bs-target="#test">
        <!--        <i class="fas fa-magic"></i>-->
        <i class="bi bi-plus-circle-fill"></i>
    </button>

    <!-- Modal -->
    <div v-if="Show" class="modal fade " id="test" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-lg">
                    <h5 class="modal-title text-green-700" id="exampleModalLabel">Create Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-lg">
                    <form @submit.prevent="createNew()">
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
                        <div>
                            <label for="title">Description</label>
                            <vue-editor
                                v-model="form4.description"

                            >
                                            </vue-editor>
                        </div>
                        <!-- submit -->
                        <div class="modal-footer modal-lg">
                            <button
                                class="btn btn-success"
                            >
                                Save
                            </button>
                        </div>
                    </form>

                </div>
                <!--                    <div class="modal-footer">-->
                <!--                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>-->
                <!--                    </div>-->
            </div>
        </div>
    </div>

</template>
<script>
//importing bootstrap 5
import 'bootstrap-icons/font/bootstrap-icons.css'

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
                categoryId:this.id,
                title: null,
                description: null,
            }),
            Show:false

        }
    },
    props:{
        id:null,
    },
    methods:{
        createNew() {
            this.form4.post('/post');
        },
    }
}
</script>
