<template>
    <div class="container">
        <h3>Kumpulan Artikel</h3>
        <div class="row">
            <div class="col-12" v-for="item in articleList" :key="item">
                <a
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
import { useArticleModule } from "../../store/modules/ArticleModule";

export default {
    data() {
        return {
            articleList: [],
        };
    },

    mounted() {
        const { getArticle } = useArticleModule();
        getArticle().then((response) => {
            this.articleList = response.data.data;
        });
    },
};
</script>
