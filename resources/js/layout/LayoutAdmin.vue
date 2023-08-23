<template>
    <div>
        <navbar-vue/>
        <div class="d-flex h-full-nav">
            <sidebar-vue/>
            <div class="py-3 px-3 w-100">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import NavbarVue from '../../js/components/Navbar.vue'
import SidebarVue from '../../js/components/Sidebar.vue'

export default {
    components: {
        NavbarVue,SidebarVue
    }    
}
</script>