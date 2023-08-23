<template>
    <div class="w-full filter-bg h-full bg-login bg-absolute"></div>

    <div class="row h-full">
        <div class="col-6"></div>
        <div class="col-5 pt-5 pe-5">
            <div class="card">
                <div class="card-body p-5">
                    <h1>Sign Up</h1>
                    <small
                        >Sudah Punya Akun?
                        <router-link
                            :to="{ name: 'login-auth' }"
                            class="text-decoration-none"
                        >
                            Masuk
                        </router-link>
                    </small>

                    <form method="get" class="row mt-3">
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label m-0"
                                >Email</label
                            >
                            <input
                                type="email"
                                class="form-control"
                                id="inputEmail4"
                            />
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="inputPassword4" class="form-label m-0"
                                >Password</label
                            >
                            <input
                                type="password"
                                class="form-control"
                                id="inputPassword4"
                            />
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="inputPassword4" class="form-label m-0"
                                >Confirm Password</label
                            >
                            <input
                                type="password"
                                class="form-control"
                                id="inputPassword4"
                            />
                        </div>
                        <div class="col-md-12 mt-4 d-flex">
                            <router-link
                                :to="{ name: 'dashboard-guest' }"
                                class="ms-auto w-fit btn btn-outline-dark px-3"
                            >
                                Back
                            </router-link>
                            <button
                                type="submit"
                                class="ms-1 w-fit btn btn-outline-dark d-inline px-3"
                            >
                                Buat Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
