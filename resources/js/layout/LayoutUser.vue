<template>
    <NavbarLogin/>


    <router-view class="p-3"></router-view>
</template>

<script>
import NavbarLogin from '../components/NavbarLogin.vue'


export default {
    components: {
        NavbarLogin
    }    
}
</script>