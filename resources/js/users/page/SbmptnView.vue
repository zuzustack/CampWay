<template>
    <div>
        <div class="container mt-3">
            <div class="card">
                <div class="card-body">
                    <h3>SBMPTN</h3>
                    <table class="table table-striped table-bordered shadow">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(list, id, index) in lists" :key="index">
                                <th class="text-center" scope="row">
                                    {{ index + 1 }}
                                </th>
                                <td>{{ list.name }}</td>
                                <td>
                                    <div
                                        v-on:click="detail(id)"
                                        class="btn btn-success me-2"
                                    >
                                        Detail
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import NavbarGuest from "../../components/NavbarGuest.vue";
import { useCollegeStore } from "../../store/modules/CollegeModule";
import swal from "../../plugins/swal";
import router from "../routes";

export default {
    data() {
        return {
            lists: [],
        };
    },

    components: {
        NavbarGuest,
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

        detail(id) {
            router.push({ name: "detail.sbmptn", params: { id: id } });
        },
    },

    mounted() {
        this.fetchData();
    },
};
</script>
