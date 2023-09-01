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
    async getAvgSnbp(avg) {
        this.status = "fetching";
        try {
            const response = admin.get(`?avgSnbp=${avg}`);
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

export const useUsersModule = defineStore({
    id: "usersModule",
    state: () => state,
    actions: actions,
    persist: persistenceConfig,
});
