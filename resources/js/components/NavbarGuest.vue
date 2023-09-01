<template>
    <nav class="navbar navbar-expand-lg sticky-top bg-violet">
        <div class="container">
            <router-link class="navbar-brand text-white bg-none" :to="{name:'dashboard-guest'}">CampWay</router-link>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex ms-auto" role="search">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link
                                class="nav-link text-white"
                                aria-current="page"
                                :to="{name: 'login-auth'}"
                            >
                                Masuk
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>
