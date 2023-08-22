<template>
    <div>
        <h1>Hello</h1>
    </div>
</template>


<script>
import { useAuthStore } from '../store/modules/AuthModule'

export default {
    mounted(){
        const {me} = useAuthStore();

        me().then((response) => {
            console.log(response);
        })
    }
}
</script>