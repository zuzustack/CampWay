import { createRouter, createWebHistory } from "vue-router";
import DashboardGuest from "../page/DashboardGuest"
import ExploreSbmptn from "../page/ExploreSbmptn"
import ExploreSnbp from "../page/ExploreSnbp"
import DetailSbmptn from "../page/DetailSbmptn"
import LoginAuth from "../page/LoginAuth"
import SignupAuth from "../page/SignupAuth"
import DashboardLogin from "../page/DashboardLogin"
import BooksView from "../page/BooksView"
import ArticleView from "../page/ArticleView"
import SnbpView from "../page/SnbpView"
import SbmptnView from "../page/SbmptnView"


import LayoutUser from "../../layout/LayoutUser"

const routes =[
    {
        path: "/",
        beforeEnter: (to,from) => {
            let auth = localStorage.getItem('authUserToken') !== null && localStorage.getItem('authUserToken') !== "";
            console.log(auth);
            console.log("MANTAP");
        
            if (auth) {
                return {name: "dashboard-login"}   
            }
        },
        children: [
            {
                path: "/",
                name: "dashboard-guest",
                component: DashboardGuest
            },
            {
                path: "/sbmptn",
                name: "explore.sbmptn",
                component: ExploreSbmptn
            },
            {
                path: "/snbp",
                name: "explore.snbp",
                component: ExploreSnbp
            },
            {
                path: "/sbmptn/:id",
                name: "detail.sbmptn",
                component: DetailSbmptn
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
            },
        ]
    },
    {
        path: "/user",
        component: LayoutUser,
        beforeEnter: (to, from) => {
            let auth = localStorage.getItem('authUserToken') !== null && localStorage.getItem('authUserToken') !== "";
            console.log(auth);
        
            if (!auth) {
                return {name:'login-auth'}
            }
        },
        children: [
            {
                path: "/user/",
                name: "dashboard-login",
                component: DashboardLogin,
            },
            {
                path: "/user/books",
                name: "booksView",
                component: BooksView,
            },
            {
                path: "/user/articles",
                name: "articleView",
                component: ArticleView,
            },
            {
                path: "/user/snbp",
                name: "snbpView",
                component: SnbpView,
            },
            {
                path: "/user/sbmptn",
                name: "sbmptnView",
                component: SbmptnView,
            }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;