import { createRouter, createWebHistory } from "vue-router";
import LoginAuth from "../page/LoginAuth"
import HomePage from "../page/HomePage"
import BookManagement from "../page/BookManagement"
import CollegeManagement from "../page/CollegeManagement"
import CollegeDetail from "../page/CollegeDetail"
import LayoutAdmin from "../layout/LayoutAdmin"



const routes =[
    {
        path: "/",
        name: "login-auth",
        component: LoginAuth
    },
    {
        path: "/",
        component: LayoutAdmin,
        children: [
            {
                path: "/collegeManagement",
                component: CollegeManagement,
                name: "collegeManagement"
            },

            {
                path: "/college/:id",
                component: CollegeDetail,
                name: "detailCollege"
            },

            {
                path: "/bookManagement",
                component: BookManagement,
                name: "bookManagement"
            },

            {
                path: "/articleManagement",
                component: HomePage,
                name: "articleManagement"
            },
        ],
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})


router.beforeEach(async (to,from) => {
    let auth = localStorage.getItem('authToken') !== null && localStorage.getItem('authToken') !== "";
    console.log(auth);

    if (!auth && to.name !== "login-auth") {
        return {name:'login-auth'}
    }else if (auth && to.name === "login-auth") {
        return {name: "collegeManagement"}
    }
})

export default router;