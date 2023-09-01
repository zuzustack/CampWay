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
                                v-model="formData.email"
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
                                v-model="formData.password"
                                type="password"
                                class="form-control"
                                id="inputPassword4"
                            />
                        </div>
                        <div class="col-md-12 mt-3">
                            <p class="mb-0 text-danger">{{ message_confirm_password }}</p>
                            <label for="inputPassword4" class="form-label m-0"
                                >Confirm Password</label
                            >
                            <input
                                v-model="formData.c_password"
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
                            <a
                                v-on:click="signin"
                                class="ms-1 w-fit btn btn-outline-dark d-inline px-3"
                            >
                                Buat Akun
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import swal from "../../plugins/swal";
import router from "../routes";
import { useAuthStore } from "../../store/modules/AuthModule";
export default {
    data() {
        return {
            formData: {
                email: "",
                password: "",
                c_password: "",
            },

            message_confirm_password: "",
        };
    },

    watch: {
        'formData.password'() {
            if (this.formData.c_password != this.formData.password) {
                this.message_confirm_password = "Confirm Password Not Match"
            } else {
                this.message_confirm_password = ""
            }
        },

        'formData.c_password'() {
            if (this.formData.c_password != this.formData.password) {
                this.message_confirm_password = "Confirm Password Not Match"
            } else {
                this.message_confirm_password = ""
            }
        }
    },

    methods: {
        signin() {
            const { authSigninUsers } = useAuthStore();

            if (this.formData.email == "" || this.formData.c_password == "" || this.formData.password == "") {
                return swal.toast("error", "The Input Form is Incomplete");
            }


            if (this.formData.c_password != this.formData.password) {
                return swal.toast("error", "Confirm Password not Match");
            }


            authSigninUsers(this.formData).then((response) => {
                swal.toast("success", "Success Create Account");
                router.push({name: "login-auth"})
            }).catch((response) => {
                swal.toast("error", "Email Sudah Digunakan");
            })

            this.formData = {
                email: "",
                c_password: "",
                password: "",
            };
        },
    },

    mounted() {},
};
</script>
