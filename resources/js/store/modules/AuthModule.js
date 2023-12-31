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
    async authLogin(formData) {
        this.status = "fetching";
        try {
            const response = admin.post("/auth/login", {
                email: formData.email,
                password: formData.password,
                isAdmin: true,
            });
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },


    async authLoginUsers(formData) {
        this.status = "fetching";
        try {
            const response = admin.post("/user/login", {
                email: formData.email,
                password: formData.password,
            });
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },


    async authSigninUsers(formData) {
        this.status = "fetching";
        try {
            const response = admin.post("/user/signup", {
                email: formData.email,
                password: formData.password,
            });
            this.data = response.data;
            return response;
        } catch (e) {
            this.status = "idle";
            throw e;
        }
    },


    async me(formData) {
        this.status = "fetching";
        try {
            const response = admin.get("/auth/me", setHeader());
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

export const useAuthStore = defineStore({
    id: "auth",
    state: () => state,
    actions: actions,
    persist: persistenceConfig,
});
