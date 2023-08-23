<template>
    <div>
        <h4 class="mb-3">College Management</h4>
        <div class="card shadow">
            <div class="card-body">
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
                            <th scope="col">Name</th>
                            <th scope="col">Link</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list, id, index) in lists" :key="index">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ list.name }}</td>
                            <td>{{ list.link }}</td>
                            <td style="width: 280px">
                                <div
                                    v-on:click="detail(id)"
                                    class="btn btn-success me-2"
                                >
                                    Detail
                                </div>
                                <div
                                    v-on:click="showUpdateModal(id, list)"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal"
                                    class="btn btn-warning me-2"
                                >
                                    Update
                                </div>
                                <div
                                    v-on:click="deleteCollege(id)"
                                    class="btn btn-danger me-2"
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
                                Name
                            </label>
                            <input
                                v-model="formData.name"
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
                            v-on:click="createCollege"
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
                                v-model="updateData.name"
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
                            v-on:click="updateCollege"
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
import router from "../routes";
import { useCollegeStore } from "../../store/modules/CollegeModule";
import swal from "../../plugins/swal"

export default {
    data() {
        return {
            formData: {
                name: "",
                link: "",
            },

            updateData: {
                name: "",
                link: "",
            },
            idUpdate: "",

            lists: [],
        };
    },

    methods: {
        fetchData() {
            const { getCollege } = useCollegeStore();
            swal.showLoading();
            getCollege().then((response) => {
                this.lists = response.data.data;
                swal.close();
            });
        },

        createCollege() {
            const { createCollege } = useCollegeStore();

            createCollege(this.formData).then((response) => {
                swal.toast("success", "Success Create College");
                this.lists = response.data.data;
                this.formData = {
                    title: "",
                    link: "",
                    imageLink: "",
                };
            });
        },

        deleteCollege(id) {
            const { deleteCollege } = useCollegeStore();
            swal.confirm(
                "Are you sure you want to delete this data?",
                (result) => {
                    if (result.isConfirmed) {
                        deleteCollege(id).then((response) => {
                            this.lists = response.data.data;
                            swal.toast("success", "Success Delete College")
                        });
                    }
                }
            );
        },

        detail(id) {
            router.push({ name: "detailCollege", params: { id: id } });
        },

        showUpdateModal(id, list) {
            this.updateData = list;
            this.idUpdate = id;
        },

        updateCollege() {
            const { updateCollege } = useCollegeStore();

            updateCollege(this.idUpdate, this.updateData).then((response) => {
                swal.toast("success", "Success Edit College");
                this.lists = response.data.data;
            });
        },
    },

    mounted() {
        this.fetchData();
    },
};
</script>
