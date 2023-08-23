<template>
    <div>
        <h4>Detail College</h4>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="formGroupExampleInput" class="form-label">
                            Name
                        </label>
                        <input
                            class="form-control"
                            type="text"
                            v-model="college.name"
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="formGroupExampleInput" class="form-label">
                            Link
                        </label>
                        <input
                            class="form-control"
                            type="text"
                            v-model="college.link"
                        />
                    </div>
                </div>
            </div>
        </div>

        <h4>List Study Program</h4>
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <router-link
                            :to="{ name: 'collegeManagement' }"
                            class="btn btn-secondary me-2"
                            >Back</router-link
                        >
                        <div
                            class="btn btn-success"
                            data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop"
                        >
                            Create
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input
                            @input="setSearch"
                            v-model="search"
                            class="form-control"
                            type="text"
                            placeholder="search..."
                        />
                    </div>
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
                    <tbody v-if="!onLoad">
                        <tr v-for="(list, id, index) in lists" :key="index">
                            <th scope="row">{{ (currentPage - 1) * 10 + index + 1 }}</th>
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

                <div
                    v-if="onLoad"
                    class="spinner-border mx-auto d-block mt-3"
                    role="status"
                >
                    <span class="visually-hidden">Loading...</span>
                </div>

                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li v-if="currentPage != 1" class="page-item">
                            <a class="page-link" href="#" v-on:click="() => currentPage--">Previous</a>
                        </li>
                        <li v-for="a in totalPage" class="page-item" :key="a">
                            <a :class="`page-link ${ (a == currentPage) ? 'active' : ''}`" v-on:click="() => currentPage = a" href="#">{{ a }}</a>
                        </li>
                        <li v-if="currentPage != totalPage" class="page-item">
                            <a v-on:click="() => currentPage++" class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
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
                            Update
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
                            Create
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
import { useStudyProgramStore } from "../../store/modules/StudyProgramModule";
import swal from "../../plugins/swal";

export default {
    data() {
        return {
            college: {},
            search: "",
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
                uuid_college: "",
            },
            id: "",
            lists: [],
            onLoad: true,
            typingTimer: "",
            currentPage: 1,
            totalPage: 0,
        };
    },

    watch: {
        currentPage(){
            this.onLoad = true;
            this.fetchData();
        }
    },

    methods: {
        fetchData() {
            const { getCollege } = useCollegeStore();
            const { getStudyProgram } = useStudyProgramStore();
            getCollege(this.id).then((response) => {
                if (response.data.data.length == 0) {
                    router.push({ name: "collegeManagement" });
                }
                this.college = response.data.data[this.id];
            });

            getStudyProgram(this.id, this.search, this.currentPage).then((response) => {
                this.lists = response.data.data;
                this.totalPage = response.data.page;
                this.onLoad = false;
                swal.close();
            });
        },

        setSearch(e) {
            clearTimeout(this.typingTimer);
            this.typingTimer = setTimeout(() => {
                this.currentPage = 1;
                this.search = e.target.value;
                this.onLoad = true;
                this.fetchData();
            }, 500);
        },

        createStudyProgram() {
            const { createStudyProgram } = useStudyProgramStore();

            createStudyProgram(this.formData).then((response) => {
                swal.toast("success", "Success Create Program Study");

                this.fetchData();

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
                        deleteStudyProgram(this.id, id).then((response) => {
                            this.fetchData();
                            swal.toast(
                                "success",
                                "Success Delete Program Study"
                            );
                        });
                    }
                }
            );
        },

        updateStudyProgram() {
            const { updateStudyProgram } = useStudyProgramStore();

            updateStudyProgram(this.idUpdate, this.updateData).then(
                (response) => {
                    swal.toast("success", "Success Update Program Study");
                    this.fetchData();
                }
            );
        },
    },

    mounted() {
        swal.showLoading();
        this.id = this.$route.params.id;
        this.formData.uuid_college = this.id;
        this.fetchData();
    },
};
</script>
