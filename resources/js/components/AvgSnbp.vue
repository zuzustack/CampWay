<template>
    <div>
        <NavbarGuest />

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-striped table-bordered shadow">
                        <thead>
                            <tr>
                                <th scope="col">Mapel</th>
                                <th scope="col">Semester 1</th>
                                <th scope="col">Semester 2</th>
                                <th scope="col">Semester 3</th>
                                <th scope="col">Semester 4</th>
                                <th scope="col">Semester 5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(list, id, index) in listsRapor"
                                :key="index"
                            >
                                <td scope="row">
                                    <input
                                        class="form-control"
                                        v-model="list.mapel"
                                        type="text"
                                    />
                                </td>
                                <td>
                                    <input
                                        @input="avgSum"
                                        style="width: 70px"
                                        class="mx-auto text-center form-control"
                                        v-model="list.semester1"
                                        type="text"
                                    />
                                </td>
                                <td>
                                    <input
                                        @input="avgSum"
                                        style="width: 70px"
                                        class="mx-auto text-center form-control"
                                        v-model="list.semester2"
                                        type="text"
                                    />
                                </td>
                                <td>
                                    <input
                                        @input="avgSum"
                                        style="width: 70px"
                                        class="mx-auto text-center form-control"
                                        v-model="list.semester3"
                                        type="text"
                                    />
                                </td>
                                <td>
                                    <input
                                        @input="avgSum"
                                        style="width: 70px"
                                        class="mx-auto text-center form-control"
                                        v-model="list.semester4"
                                        type="text"
                                    />
                                </td>
                                <td class="d-flex position-relative">
                                    <input
                                        @input="avgSum"
                                        style="width: 70px"
                                        class="mx-auto text-center form-control"
                                        v-model="list.semester5"
                                        type="text"
                                    />

                                    <div v-if="id !== 0" v-on:click="deleteList(id)" class="btn btn-danger btn-sm position-absolute delete-position">-</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button v-on:click="addListRapor" class="btn btn-success">
                        +
                    </button>
                </div>

                <div class="col-md-4">
                    <div
                        class="card mb-3"
                        style="width: fit-content !important"
                    >
                        <div class="card-body">
                            <h6 class="m-0">Rata-rata : {{ avgRapor }}</h6>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h6 class="m-0 text-center">Rekomendasi PTN</h6>
                            <hr />
                            <div
                                style="
                                    height: 60vh;
                                    overflow-y: scroll;
                                    overflow-x: hidden;
                                "
                            >
                                <div v-for="(list, id) in lists" :key="id">
                                    <div class="row">
                                        <div class="col-md-8 border-end">
                                            <h6>{{ list.college.name }}</h6>
                                            <p>{{ list.name }}</p>
                                        </div>
                                        <div
                                            class="col-md-4 d-grid place-content-center mb-3"
                                        >
                                            <h6 class="text-center">
                                                Avg : {{ list.avgSnbp }}
                                            </h6>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { useUsersModule } from "../store/modules/UsersModule";
import swal from "../plugins/swal";
import router from "../users/routes";

export default {
    data() {
        return {
            listsRapor: [
                {
                    mapel: "",
                    semester1: 0,
                    semester2: 0,
                    semester3: 0,
                    semester4: 0,
                    semester5: 0,
                },
            ],
            lists: [],
            typingTimer: "",
            avgRapor: 0,
        };
    },

    methods: {
        fetchData() {
            // const { getCollege } = useCollegeStore();
            // swal.showLoading();
            // getCollege().then((response) => {
            //     this.lists = response.data.data;
            //     swal.close();
            // });
        },

        getAvgSnbp() {
            const { getAvgSnbp } = useUsersModule();

            getAvgSnbp(this.avgRapor).then((response) => {
                this.lists = response.data.data;
            });
        },

        deleteList(id) {
            this.listsRapor.splice(id,1);
        },

        avgSum(e) {
            clearTimeout(this.typingTimer);
            this.typingTimer = setTimeout(() => {
                let sum = 0;
                let total = 0;
                this.listsRapor.forEach((e) => {
                    for (let i = 1; i <= 5; i++) {
                        // console.log(e[`semester${i}`]);
                        if (parseInt(e[`semester${i}`])) {
                            console.log(Number.parseFloat(e[`semester${i}`]));
                            total += Number.parseFloat(e[`semester${i}`]);
                            sum += 1;
                        }
                    }
                });
                this.avgRapor = (total / sum).toFixed(2);
                this.getAvgSnbp();
            }, 1000);
        },

        detail(id) {
            router.push({ name: "detail.sbmptn", params: { id: id } });
        },

        addListRapor() {
            this.listsRapor.push({
                mapel: "",
                semester1: 0,
                semester2: 0,
                semester3: 0,
                semester4: 0,
                semester5: 0,
            });
        },
    },

    mounted() {
        this.fetchData();
    },
};
</script>
