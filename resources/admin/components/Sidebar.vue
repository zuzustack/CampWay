<template>
    <div
        class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark bg-violet"
        style="width: 260px"
    >
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <router-link :to="{name:'collegeManagement'}" class="nav-link text-white" aria-current="page">
                    <i class="bi bi-house-fill"></i>
                    College Management
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{name:'bookManagement'}" class="nav-link text-white" aria-current="page">
                    <i class="bi bi-house-fill"></i>
                    Book Management
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{name:'articleManagement'}" class="nav-link text-white" aria-current="page">
                    <i class="bi bi-house-fill"></i>
                    Article Management
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    },
};
</script>