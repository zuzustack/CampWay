<template>
    <div>
        <NavbarGuest />

        <div class="container mt-3">
            <div class="card">
                <div class="card-body">
                    <h3>{{ college.name }}</h3>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <router-link
                                :to="{ name: 'explore.sbmptn' }"
                                class="btn btn-secondary me-2"
                                >Back</router-link
                            >
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
                    <table
                        class="table table-striped table-bordered shadow mb-3"
                    >
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">PG</th>
                            </tr>
                        </thead>
                        <tbody v-if="!onLoad">
                            <tr
                                von
                                v-for="(list, id, index) in lists"
                                :key="index"
                            >
                                <th class="text-center" scope="row">
                                    {{ (currentPage - 1) * 10 + index + 1 }}
                                </th>
                                <td>{{ list.name }}</td>
                                <td>{{ list.avgSbmptn }}</td>
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
                                <a
                                    class="page-link text-black"
                                    href="#"
                                    v-on:click="() => currentPage--"
                                    >Previous</a
                                >
                            </li>
                            <li
                                v-for="a in totalPage"
                                class="page-item"
                                :key="a"
                            >
                                <a
                                    :class="`page-link ${
                                        a == currentPage ? 'active text-white' : 'text-black'
                                    }`"
                                    v-on:click="() => (currentPage = a)"
                                    href="#"
                                    >{{ a }}</a
                                >
                            </li>
                            <li
                                v-if="currentPage != totalPage"
                                class="page-item"
                            >
                                <a
                                    v-on:click="() => currentPage++"
                                    class="page-link text-black"
                                    href="#"
                                    >Next</a
                                >
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import NavbarGuest from "../../components/NavbarGuest.vue";
import { useCollegeStore } from "../../store/modules/CollegeModule";
import { useStudyProgramStore } from "../../store/modules/StudyProgramModule";
import swal from "../../plugins/swal";

export default {
    data() {
        return {
            onLoad: true,
            college: {},
            lists: [],
            search: "",
            currentPage: 1,
            totalPage: 0,
        };
    },

    watch: {
        currentPage() {
            this.onLoad = true;
            this.fetchData();
        },
    },

    components: {
        NavbarGuest,
    },

    methods: {
        setSearch(e) {
            clearTimeout(this.typingTimer);
            this.typingTimer = setTimeout(() => {
                this.currentPage = 1;
                this.search = e.target.value;
                this.onLoad = true;
                this.fetchData();
            }, 500);
        },

        fetchData() {
            const { getCollege } = useCollegeStore();
            const { getStudyProgram } = useStudyProgramStore();
            getCollege(this.id).then((response) => {
                if (response.data.data.length == 0) {
                    router.push({ name: "explore.sbmptn" });
                }
                this.college = response.data.data[this.id];
            });

            getStudyProgram(this.id, this.search, this.currentPage).then(
                (response) => {
                    this.lists = response.data.data;
                    this.totalPage = response.data.page;
                    this.onLoad = false;
                    swal.close();
                }
            );
        },
    },

    mounted() {
        swal.showLoading();
        this.id = this.$route.params.id;
        this.fetchData();
    },
};
</script>
