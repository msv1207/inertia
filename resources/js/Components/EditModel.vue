<template>
    <div class="container p-5">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal3">
            Edit
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-green-700" id="exampleModalLabel">Create post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form @submit.prevent="submit">
                        <div>
                            <label for="title">Title category</label>
                            <input
                                type="text"
                                v-model="form.categoryTitle"
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
                                v-model="form.mainCategoryTitle"
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
                                v-model="form.title"
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
                                name="description"
                                type="text"
                                v-model="form.description"
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
                        <div class="flex items-center mt-4">
                            <button
                                class="
                                        px-6
                                        py-2
                                        text-white
                                        bg-gray-900
                                        rounded
                                    "
                            >
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
        components: {
            BreezeAuthenticatedLayout,
            Head,
        },
        setup(props) {
            const form = useForm({
                title: props.post.title,
                categoryTitle: props.post.categoryTitle,
                mainCategoryTitle: props.post.mainCategoryTitle,
                description: props.post.description,
            });

            return { form };
        },
        props: {
            post: Object,
        },
        methods: {
            submit() {
                this.form.put(route("posts.update", this.post.id));
            },
        },
    };
</script>

<style scoped>

</style>
