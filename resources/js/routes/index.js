import { createRouter, createWebHistory } from "vue-router";
import DashboardGuest from "../page/DashboardGuest"
import LoginAuth from "../page/LoginAuth"
import SignupAuth from "../page/SignupAuth"


const routes =[
    {
        path: "/",
        name: "dashboard-guest",
        component: DashboardGuest
    },
    {
        path: "/login",
        name: "login-auth",
        component: LoginAuth
    },
    {
        path: "/signup",
        name: "signup-auth",
        component: SignupAuth
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;