<template>
    <div>
        <NavbarGuest/>
        <section class="mb-5">
            <div class="hero">
                <div class="hero-img"></div>
                <div class="hero-label d-flex jjc pic">
                    <div class="text-center">
                        <h4>Cari Perguruan Tinggi Negeri dengan Mudah</h4>
                        <h4 class="mb-4">Lewat Semua Jalur Indonesia!</h4>
                        <div class="btn btn-violet" data-bs-toggle="modal" :data-bs-target="'#' + modalExplore">Eksplorasi</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-4">
            <h1 class="text-center mb-5">Artikel & Buku</h1>
            <div class="mx-5 row container">
                <div class="col-7">
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
                <div class="col-5 d-flex flex-wrap">
                    <a
                        target="_blank"
                        v-for="item in bookLists"
                        :key="item"
                        class="text-dark text-decoration-none book-cover me-3"
                        :href="item.link"
                    >
                        <div class="card mb-3 no-border shadow px-2 " style="width: fit-content;">
                            <div class="card-body p-0">
                                <img
                                    class="d-block mx-auto"
                                    :src="item.imageLink"
                                    style="width: 100%; max-height: 205px;"
                                />
                                <div class="p-2">
                                    <small class="card-title m-0">
                                        {{ item.title.replace(/(.{28})..+/, "$1…") }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <ModalExplore :show="true" :id="modalExplore"/>
    </div>
</template>

<script>
import NavbarGuest from '../../components/NavbarGuest.vue';
import ModalExplore from '../../components/ModalExplore.vue';
import { useBookStore } from '../../store/modules/BookModule';
import { useArticleModule } from '../../store/modules/ArticleModule';

export default {
    data(){
        return{
            modalExplore: "modalExplore",
            bookLists: [],
            articleList: [],
        }
    },

    mounted(){
        const {getBook} = useBookStore();
        const {getArticle} = useArticleModule();


        getBook().then((response) => {
            this.bookLists = response.data.data
        })

        getArticle().then((response) => {
            this.articleList = response.data.data
        })

    },


    components: {
        NavbarGuest,
        ModalExplore
    },
}
</script>