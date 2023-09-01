<template>
    <nav class="navbar navbar-expand-lg bg-violet border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">CampWay</a>
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
        </div>
    </nav>
</template>

<script>
import adminRouter from '../admin/routes';



export default {
    methods: {
        logout(){
            localStorage.setItem('authToken', "");
            adminRouter.push({name:"login-auth"})
        }
    }
}
</script>
