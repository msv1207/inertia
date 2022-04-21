<template>
    <!-- Button trigger modal -->
    <span> &nbsp;</span>

    <button @click="Show=!Show" type="button"            style="color: #198754"
            data-bs-toggle="modal" data-bs-target="#test">
        <i class="bi bi-plus-circle-fill"></i>
    </button>

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
                        <label for="title">Description</label>
                      <textarea type="text"
                                v-model="form4.description"
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
                                                ">

                      </textarea>

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
        VueEditor
    },
    data(){
        return {
            form4: this.$inertia.form({
              description: '',
              categoryId: this.id,
              title: '',
            }),
            Show:false,
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
