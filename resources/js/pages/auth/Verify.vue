<script lang="ts" setup>
import { onMounted } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();

onMounted(async () => {
    try {
        await window.axios.post("/api/auth/verify", {
            token: route.params.token,
        })
    } catch (e) {
        if (e.response) {
            switch (e.response.status) {
                case 401:
                    // Token doesn't exists
                    break;
                case 403:
                    // Token used
                    break;
            }
        } else {
            // Service unavailable
        }
    }
})
</script>

<template>

</template>
