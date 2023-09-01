<template>
    <div class="container">
        <h1>Kumpulan Buku</h1>
        <div class="row">
            <div class="col-md-2" v-for="item in bookLists" :key="item">
                <a
                    target="_blank"
                    class="text-dark text-decoration-none book-cover me-3"
                    :href="item.link"
                >
                    <div
                        class="card mb-3 no-border shadow px-2"
                        style="width: fit-content"
                    >
                        <div class="card-body p-0">
                            <img
                                class="d-block mx-auto"
                                :src="item.imageLink"
                                style="width: 100%; max-height: 205px"
                            />
                            <div class="p-2">
                                <small class="card-title m-0">
                                    {{
                                        item.title.replace(/(.{28})..+/, "$1…")
                                    }}
                                </small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import { useBookStore } from "../../store/modules/BookModule";

export default {
    data() {
        return {
            bookLists: [],
        };
    },

    mounted() {
        const { getBook } = useBookStore();
        getBook().then((response) => {
            this.bookLists = response.data.data;
        });
    },
};
</script>
