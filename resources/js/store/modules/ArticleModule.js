import { defineStore } from "pinia";

// import { STATUS } from '@/store/baseTypes'
// import { setHeader } from './utils'
import users from "../../plugins/axiosUsers";
import admin from "../../plugins/axiosAdmin";
import { setHeader } from "./utils";

const state = {
    status: "idle",
    last_fetched: null,
    data: {},
};

const actions = {
    async getArticle() {
        this.status = "fetching";
        try {
            const response = admin.get("/article", setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
    async updateArticle(id,formData) {
        this.status = "fetching";
        try {
            const response = admin.patch(`/article/${id}`, formData ,setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
    async deleteArticle(id) {
        this.status = "fetching";
        try {
            const response = admin.delete(`/article/${id}`, setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
    async createArticle(formData) {
        this.status = "fetching";
        try {
            const response = admin.post("/article",formData, setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
};

const persistenceConfig = {
    beforeRestore: (context) => {
        console.log(`about to restore '${context.store.$id}'`);
    },
    paths: ["data"],
};

export const useArticleModule = defineStore({
    id: "Articles",
    state: () => state,
    actions: actions,
    persist: persistenceConfig,
});
