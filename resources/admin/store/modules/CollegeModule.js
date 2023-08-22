import { defineStore } from "pinia";

// import { STATUS } from '@/store/baseTypes'
// import { setHeader } from './utils'
import axios from "../../plugins/axios";
import { setHeader } from "./utils";

const state = {
    status: "idle",
    last_fetched: null,
    data: {},
};

const actions = {
    async getCollege(id) {
        this.status = "fetching";
        try {
            let $params = "?"
            if (id) {
                $params += `id=${id}`
            }
            const response = axios.get(`/college${$params}`, setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
    async updateCollege(id,formData) {
        this.status = "fetching";
        try {
            const response = axios.patch(`/college/${id}`, formData ,setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
    async deleteCollege(id) {
        this.status = "fetching";
        try {
            const response = axios.delete(`/college/${id}`, setHeader());
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },
    async createCollege(formData) {
        this.status = "fetching";
        try {
            const response = axios.post("/college",formData, setHeader());
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

export const useCollegeStore = defineStore({
    id: "collegeStore",
    state: () => state,
    actions: actions,
    persist: persistenceConfig,
});
