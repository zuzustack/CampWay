<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-2">
                <h3>List Buku</h3>
                <div class="d-flex flex-wrap">
                    <a
                        target="_blank"
                        v-for="item in bookLists"
                        :key="item"
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
                                            item.title.replace(
                                                /(.{28})..+/,
                                                "$1…"
                                            )
                                        }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <h3>List Article</h3>
                <a
                    v-for="item in articleList"
                    :key="item"
                    class="text-dark text-decoration-none"
                    :href="item.link"
                >
                    <div class="card mb-3 no-border shadow">
                        <div class="card-body p-0 d-flex">
                            <img
                                :src="item.imageLink"
                                width="150px"
                                alt="..."
                            />
                            <div class="px-3 py-4">
                                <h5 class="card-title">
                                    {{ item.title }}
                                </h5>
                                <p class="mb-0">
                                    {{ item.body }}
                                </p>
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
import { useArticleModule } from "../../store/modules/ArticleModule";

export default {
    data() {
        return {
            bookLists: [],
            articleList: [],
        };
    },

    mounted() {
        const { getBook } = useBookStore();
        const { getArticle } = useArticleModule();

        getBook().then((response) => {
            this.bookLists = response.data.data;
        });

        getArticle().then((response) => {
            this.articleList = response.data.data;
        });
    },
};
</script>
