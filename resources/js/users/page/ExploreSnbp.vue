<template>
    <div>
        <NavbarGuest />

        <div class="container-fluid mt-3">
            <AvgSnbp/>
        </div>
    </div>
</template>

<script>
import NavbarGuest from "../../components/NavbarGuest.vue";
import AvgSnbp from "../../components/AvgSnbp.vue";

export default {
    components: {
        NavbarGuest,
        AvgSnbp
    },
};
</script>
