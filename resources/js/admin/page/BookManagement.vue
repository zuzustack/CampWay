<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h3 class="mb-3">Book Management</h3>
                <div
                    class="ms-auto btn btn-success mb-2"
                    data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop"
                >
                    Create
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Link</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list, id, index) in lists" :key="index">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ list.title }}</td>
                            <td>{{ list.link }}</td>
                            <td>{{ list.imageLink }}</td>
                            <td style="width: 200px">
                                <div
                                    v-on:click="showUpdateModal(id, list)"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal"
                                    class="btn btn-warning me-2"
                                >
                                    Update
                                </div>
                                <div
                                    v-on:click="deleteBook(id)"
                                    class="btn btn-danger"
                                >
                                    Delete
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div
            :class="`modal fade`"
            id="staticBackdrop"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">
                            Create
                        </h1>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label
                                for="formGroupExampleInput"
                                class="form-label"
                            >
                                Title
                            </label>
                            <input
                                v-model="formData.title"
                                type="text"
                                class="form-control"
                                id="formGroupExampleInput"
                            />
                        </div>
                        <div class="mb-3">
                            <label
                                for="formGroupExampleInput"
                                class="form-label"
                            >
                                Link
                            </label>
                            <input
                                v-model="formData.link"
                                type="text"
                                class="form-control"
                                id="formGroupExampleInput"
                            />
                        </div>
                        <div class="mb-3">
                            <label
                                for="formGroupExampleInput"
                                class="form-label"
                            >
                                Image Link
                            </label>
                            <input
                                v-model="formData.imageLink"
                                type="text"
                                class="form-control"
                                id="formGroupExampleInput"
                            />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            data-bs-dismiss="modal"
                            v-on:click="createBook"
                            class="btn btn-success"
                        >
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div
            :class="`modal fade`"
            id="editModal"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">
                            Update
                        </h1>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label
                                for="formGroupExampleInput"
                                class="form-label"
                            >
                                Title
                            </label>
                            <input
                                v-model="updateData.title"
                                type="text"
                                class="form-control"
                                id="formGroupExampleInput"
                            />
                        </div>
                        <div class="mb-3">
                            <label
                                for="formGroupExampleInput"
                                class="form-label"
                            >
                                Link
                            </label>
                            <input
                                v-model="updateData.link"
                                type="text"
                                class="form-control"
                                id="formGroupExampleInput"
                            />
                        </div>
                        <div class="mb-3">
                            <label
                                for="formGroupExampleInput"
                                class="form-label"
                            >
                                Image Link
                            </label>
                            <input
                                v-model="updateData.imageLink"
                                type="text"
                                class="form-control"
                                id="formGroupExampleInput"
                            />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            data-bs-dismiss="modal"
                            v-on:click="updateBook"
                            class="btn btn-success"
                        >
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useBookStore } from "../../store/modules/BookModule";
import swal from "../../plugins/swal";

export default {
    data() {
        return {
            formData: {
                title: "",
                link: "",
                imageLink: "",
            },

            updateData: {
                title: "",
                link: "",
                imageLink: "",
            },
            idUpdate: "",

            lists: [],
        };
    },

    methods: {
        fetchData() {
            const { getBook } = useBookStore();
            swal.showLoading();
            getBook().then((response) => {
                this.lists = response.data.data;
                swal.close();
            });
        },

        createBook() {
            const { createBook } = useBookStore();

            createBook(this.formData).then((response) => {
                swal.toast("success", "Success Create Book");
                this.lists = response.data.data;

                this.formData = {
                    title: "",
                    link: "",
                    imageLink: "",
                };
            });
        },

        deleteBook(id) {
            const { deleteBook } = useBookStore();

            deleteBook(id).then((response) => {
                swal.toast("success", "Success Delete Books");
                this.lists = response.data.data;
            });
        },

        showUpdateModal(id, list) {
            this.updateData = list;
            this.idUpdate = id;
        },

        updateBook() {
            const { updateBook } = useBookStore();

            updateBook(this.idUpdate, this.updateData).then((response) => {
                swal.toast("success", "Success Update Book");
                this.lists = response.data.data;
            });
        },
    },

    mounted() {
        this.fetchData();
    },
};
</script>
