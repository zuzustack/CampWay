<template>
    <div
        v-if="show"
        class="modal fade"
        :id="id"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content py-3">
                <div class="modal-body">
                    <h2 class="text-center mb-4">Explorasi</h2>
                    <div class="d-flex">
                        <router-link
                            :to="{ name: 'explore.sbmptn' }"
                            class="d-grid justify-content-center card mx-auto text-black text-decoration-none shadow p-3"
                            style="width: 200px !important"
                        >
                            <div class="card-body" data-bs-dismiss="modal">
                                <img
                                    style="width: 100px"
                                    src="https://upload.wikimedia.org/wikipedia/commons/e/e1/Logo_sbmptn.jpg"
                                    alt="sbmptn_logo"
                                    class="mb-3"
                                />
                                <h4 class="mb-0">SBMPTN</h4>
                            </div>
                        </router-link>
                        <router-link
                            :to="{ name: 'explore.snbp' }"
                            class="d-grid justify-content-center card mx-auto text-black text-decoration-none shadow p-3"
                            style="width: 200px !important"
                        >
                            <div class="card-body" data-bs-dismiss="modal">
                                <div style="max-width: 100px; min-height: 100px;" class="mb-3 d-grid place-content-center">
                                    <img
                                        style="width: 100px;"
                                        src="https://pengumuman-snbp-snpmb.bppp.kemdikbud.go.id/img/snbp.png"
                                        alt="sbmptn_logo"
                                    />
                                </div>
                                <h4 class="mb-0 text-center">SNBP</h4>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        show: Boolean,
        id: String,
    },
};
</script>
