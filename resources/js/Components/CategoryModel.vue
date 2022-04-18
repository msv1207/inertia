<template>
    <!-- Button trigger modal -->
    <span> &nbsp;</span>

    <button type="button" class="btn-rounded btn-outline-success" data-bs-toggle="modal" data-bs-target="#Cate">
        <!--        <i class="fas fa-magic"></i>-->
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg> </button>

    <!-- Modal -->
    <div class="modal fade" id="Cate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-green-700" id="exampleModalLabel">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="createNew()">
                        <div>
                            <label for="title">Title Category</label>
                            <input
                                type="text"
                                v-model="form3.categoryTitle"
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

</template>
<script>
//importing bootstrap 5
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
export default {
    data(){
        return {
            form3 : this.$inertia.form({
                categoryTitle: null,
                sub_category_id : this.sub_category,
                // title: null,
                // description: null,
            }),
        }
    },
    props:{
        sub_category: null

    },
    methods:{
        createNew() {
            this.form3.post('/category');
        },
    }
}
</script>
