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
    async getBook() {
        this.status = "fetching";
        try {
            const response = admin.get("/book", setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
    async updateBook(id,formData) {
        this.status = "fetching";
        try {
            const response = admin.patch(`/book/${id}`, formData ,setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
    async deleteBook(id) {
        this.status = "fetching";
        try {
            const response = admin.delete(`/book/${id}`, setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
    async createBook(formData) {
        this.status = "fetching";
        try {
            const response = admin.post("/book",formData, setHeader());
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

export const useBookStore = defineStore({
    id: "books",
    state: () => state,
    actions: actions,
    persist: persistenceConfig,
});
