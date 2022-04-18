<template>
    <div class="container p-5">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Create tag
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-green-700" id="exampleModalLabel">Create post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="createNewTag(node.id)">
                            <div>
                                <label for="title">Title tag</label>
                                <input
                                    type="text"
                                    :id="node.id"
                                    v-model="form3.tag"
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
                    <!--                    <div class="modal-footer">-->
                    <!--                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>-->
                    <!--                    </div>-->
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
    data(){
        return {
            form3 : this.$inertia.form({
                tag: this.tag,
                id: this.id
            }),
        }
    },
    methods:{
        createNewTag(id)
        {
            this.form3.post('/tag/'+ id);

        },
    }
}
</script>
