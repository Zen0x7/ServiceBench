<script lang="ts" setup>
import { onMounted } from "vue";
import { useRoute } from "vue-router";
import { useNotifications } from "@/stores/notifications.ts";

const route = useRoute();
const notifications = useNotifications();


onMounted(async () => {
    try {
        await window.axios.post("/api/auth/verify", {
            token: route.params.token,
        })
        notifications.push({
            type: 'success',
            title: "Address verification success",
            body: "The account has been verified",
        });
    } catch (e) {
        if (e.response) {
            switch (e.response.status) {
                case 422:
                    notifications.push({
                        type: 'error',
                        title: "Address verification failed",
                        body: "The account doesn't exists",
                    });
                    // Token doesn't exists
                    break;
                case 403:
                    notifications.push({
                        type: 'warning',
                        title: "Your account is already verified",
                        body: "The link has been used previously"
                    });
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
