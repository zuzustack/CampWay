import { defineStore } from "pinia";

import users from "../../plugins/axiosUsers";
import admin from "../../plugins/axiosAdmin";
import { setHeader } from "./utils";

const state = {
    status: "idle",
    last_fetched: null,
    data: {},
};

const actions = {
    async getStudyProgram(id,search,page) {
        this.status = "fetching";
        try {
            const response = admin.get(`/studyProgram?id=${id}&search=${search}&page=${page}`, setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
    async updateStudyProgram(id,formData) {
        this.status = "fetching";
        try {
            const response = admin.patch(`/studyProgram/${id}`, formData ,setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
    async deleteStudyProgram(uuid,id) {
        this.status = "fetching";
        try {
            const response = admin.delete(`/studyProgram/${id}?id=${uuid}`, setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
    async createStudyProgram(formData) {
        this.status = "fetching";
        try {
            const response = admin.post(`/studyProgram`,formData, setHeader());
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

export const useStudyProgramStore = defineStore({
    id: "studyProgramStore",
    state: () => state,
    actions: actions,
    persist: persistenceConfig,
});
