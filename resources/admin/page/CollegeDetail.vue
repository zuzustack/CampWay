<template>
    <div>
        <h4 class="mb-3">Detail College</h4>
        <div class="card shadow">
            <div class="card-body">
                <router-link :to="{name: 'collegeManagement'}" class="btn btn-secondary me-2">Back</router-link>
                <div
                    class="btn btn-success"
                    data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop"
                >
                    Create
                </div>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Link</th>
                            <th scope="col">Avg SBMPTN</th>
                            <th scope="col">Avg SNPMB</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list, id, index) in lists" :key="index">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ list.name }}</td>
                            <td>{{ list.link }}</td>
                            <td>{{ list.avgSbmptn }}</td>
                            <td>{{ list.avgSnpmb }}</td>
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
                                    v-on:click="deleteStudyProgram(id)"
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
            id="editModal"
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label
                                        for="formGroupExampleInput"
                                        class="form-label"
                                    >
                                        Name
                                    </label>
                                    <input
                                        v-model="updateData.name"
                                        type="text"
                                        class="form-control"
                                        id="formGroupExampleInput"
                                    />
                                </div>
                            </div>
                            <div class="col-md-12">
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label
                                        for="formGroupExampleInput"
                                        class="form-label"
                                    >
                                        Avg Nilai SNPMB
                                    </label>
                                    <input
                                        v-model="updateData.avgSnpmb"
                                        type="text"
                                        class="form-control"
                                        id="formGroupExampleInput"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label
                                        for="formGroupExampleInput"
                                        class="form-label"
                                    >
                                        Avg Nilai SBMPTN
                                    </label>
                                    <input
                                        v-model="updateData.avgSbmptn"
                                        type="text"
                                        class="form-control"
                                        id="formGroupExampleInput"
                                    />
                                </div>
                            </div>
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
                            v-on:click="updateStudyProgram"
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
            id="staticBackdrop"
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
                        <div class="row">
                            <div class="col-md-12">
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
                            </div>
                            <div class="col-md-12">
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label
                                        for="formGroupExampleInput"
                                        class="form-label"
                                    >
                                        Avg Nilai SNPMB
                                    </label>
                                    <input
                                        v-model="formData.avgSnpmb"
                                        type="text"
                                        class="form-control"
                                        id="formGroupExampleInput"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label
                                        for="formGroupExampleInput"
                                        class="form-label"
                                    >
                                        Avg Nilai SBMPTN
                                    </label>
                                    <input
                                        v-model="formData.avgSbmptn"
                                        type="text"
                                        class="form-control"
                                        id="formGroupExampleInput"
                                    />
                                </div>
                            </div>
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
                            v-on:click="createStudyProgram"
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
import { useCollegeStore } from "../store/modules/CollegeModule";
import { useStudyProgramStore } from "../store/modules/StudyProgramModule";
import swal from "../plugins/swal";

export default {
    data() {
        return {
            formData: {
                name: "",
                link: "",
                avgSbmptn: 0,
                avgSnpmb: 0,
                uuid_college: "",
            },

            updateData: {
                name: "",
                link: "",
                avgSbmptn: 0,
                avgSnpmb: 0,
            },
            id: "",
            lists: [],
        };
    },

    methods: {
        fetchData() {
            const { getCollege } = useCollegeStore();
            const { getStudyProgram } = useStudyProgramStore();
            swal.showLoading();
            getCollege(this.id).then((response) => {
                if (response.data.data.length == 0) {
                    router.push({ name: "collegeManagement" });
                }
            });

            getStudyProgram(this.id).then((response) => {
                this.lists = response.data.data;
                swal.close();
            });
        },

        createStudyProgram() {
            const { createStudyProgram } = useStudyProgramStore();

            createStudyProgram(this.formData).then((response) => {
                this.lists = response.data.data;

                this.formData = {
                    name: "",
                    link: "",
                    avgSbmptn: 0,
                    avgSnpmb: 0,
                    uuid_college: this.id,
                };
            });
        },

        showUpdateModal(id, list) {
            this.updateData = list;
            this.idUpdate = id;
        },

        deleteStudyProgram(id) {
            const { deleteStudyProgram } = useStudyProgramStore();
            swal.confirm(
                "Are you sure you want to delete this data?",
                (result) => {
                    if (result.isConfirmed) {
                        deleteStudyProgram(id).then((response) => {
                            this.lists = response.data.data;
                            swal.toast("success", "Success Delete Program Study")
                        });
                    }
                }
            );
        },

        updateStudyProgram() {
            const { updateStudyProgram } = useStudyProgramStore();

            updateStudyProgram(this.idUpdate, this.updateData).then(
                (response) => {
                    this.lists = response.data.data;
                }
            );
        },
    },

    mounted() {
        this.id = this.$route.params.id;
        this.formData.uuid_college = this.id;
        this.fetchData();
    },
};
</script>
