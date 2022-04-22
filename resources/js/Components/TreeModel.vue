<template>

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create post
    </button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-green-700" id="exampleModalLabel">Create post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="createNew()">
                        <div>
                            <label for="title">Title category</label>
                            <input
                                type="text"
                                v-model="form2.categoryTitle"
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
                                v-model="form2.mainCategoryTitle"
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
                                v-model="form2.title"
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
                                type="text"
                                v-model="form2.description"
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
//importing bootstrap 5
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";

export default {
    data() {
        return {
            form2: this.$inertia.form({
                mainCategoryTitle: null,
                categoryTitle: null,
                title: null,
                description: null,
            }),
        }
    },
    methods: {
        createNew() {
            this.form2.post('/tree');
        },
    }
}
</script>
