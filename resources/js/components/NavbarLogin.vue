<template>
    <nav class="navbar navbar-expand-lg bg-violet border-bottom">
        <div class="container">
            <a class="navbar-brand text-white" href="#">CampWay</a>

            <div class="d-flex ms-auto" role="search">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li>
                        <router-link
                            :to="{ name: 'dashboard-login' }"
                            id="navbar-1"
                            class="nav-link text-white"
                            aria-current="page"
                        >
                            Home
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'sbmptnView' }"
                            id="navbar-1"
                            class="nav-link text-white"
                            aria-current="page"
                        >
                            Sbmptn
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'snbpView' }"
                            id="navbar-1"
                            class="nav-link text-white"
                            aria-current="page"
                        >
                            Snbp
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'booksView' }"
                            id="navbar-1"
                            class="nav-link text-white"
                            aria-current="page"
                        >
                            Buku
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'articleView' }"
                            id="navbar-1"
                            class="nav-link text-white"
                            aria-current="page"
                        >
                            Article
                        </router-link>
                    </li>
                </ul>
            </div>

            <div class="d-flex ms-auto" role="search">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a
                            v-on:click="logout"
                            href="#"
                            class="nav-link text-white"
                            aria-current="page"
                            >Log Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import adminRouter from "../admin/routes";

export default {
    methods: {
        logout() {
            localStorage.setItem("authToken", "");
            adminRouter.push({ name: "login-auth" });
        },
    },
};
</script>
