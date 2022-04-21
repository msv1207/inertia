<template>

    <button @click="Show=true" type="button" class="btn-rounded btn-outline-dark" data-bs-toggle="modal"
            data-bs-target="#tests">
        {{ node.title }}
    </button>


    <div v-if="Show" class="modal fade" id="tests" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title text-green-700" id="exampleModalLabel">{{ node.title }}</h5>
                    <button @click="Show=false" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form v-if="node.description" @submit.prevent="updatePost(node.id)">

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
                        <div v-if="node.description">
                            <label for="title">Description</label>
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
                    <form v-if="node.sub_category_id" @submit.prevent="updateCat(node.id)">

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
                        <div v-if="node.description">
                            <label for="title">Description</label>
                            <vue-editor
                                v-model="form4.description"

                            >
                            </vue-editor>
                        </div>
                        <div class="modal-footer">
                            <button
                                class="btn btn-success"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                    <form v-if="node.sub_category_id == null && node.description==null"
                          @submit.prevent="updateMainCat(node.id)">
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
                        <div v-if="node.description">
                            <label for="title">Description</label>
                            <vue-editor
                                v-model="form4.description"

                            >
                            </vue-editor>
                        </div>
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
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
import {VueEditor} from "vue3-editor";

export default {
    components: {
        VueEditor
    },
    data() {
        return {
            form4: this.$inertia.form({
                title: this.node.title,
                description: this.node.description,
            }),
            Show: false,
        }
    },
    props: {
        node: Object,
    },
    methods: {
        updateCat(id) {
            this.form4.put('/category/' + id);
        },
        updateMainCat(id) {
            this.form4.put('/maincat/' + id);
        },
        updatePost(id) {
            this.form4.put('/post/' + id);
        },
    }
}
</script>
