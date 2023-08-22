import { defineStore } from "pinia";

import axios from "../../plugins/axios";
import { setHeader } from "./utils";

const state = {
    status: "idle",
    last_fetched: null,
    data: {},
};

const actions = {
    async getStudyProgram(id) {
        this.status = "fetching";
        try {
            const response = axios.get(`/studyProgram?id=${id}`, setHeader());
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
            const response = axios.patch(`/studyProgram/${id}`, formData ,setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
    async deleteStudyProgram(id) {
        this.status = "fetching";
        try {
            const response = axios.delete(`/studyProgram/${id}`, setHeader());
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
            const response = axios.post("/studyProgram",formData, setHeader());
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
