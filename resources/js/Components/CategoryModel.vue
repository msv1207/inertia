<template>
    <!-- Button trigger modal -->
    <span> &nbsp;</span>

    <button @click="Show=!Show" type="button"             style="color: #198754"
            data-bs-toggle="modal" data-bs-target="#Cate">
        <!--        <i class="fas fa-magic"></i>-->
        <i class="bi bi-plus-circle-fill"></i>
    </button>

    <!-- Modal -->
    <div v-if="Show" class="modal fade" id="Cate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
import 'bootstrap-icons/font/bootstrap-icons.css'

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min.js";
export default {
    data(){
        return {
            Show:false,
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
