<script lang="ts" setup>
import {onMounted} from "vue";
import {useRoute, useRouter} from "vue-router";
import {useNotifications} from "@/stores/notifications.ts";
import {useAuthentication} from "@/stores/authentication.ts";

const route = useRoute();
const router = useRouter();
const notifications = useNotifications();
const authentication = useAuthentication();


onMounted(async () => {
    await authentication.revoke();

    notifications.push({
        type: 'success',
        title: "Logout success",
        body: "Thanks for visit us",
    });

    await router.push({
        path: '/auth/login'
    })
})
</script>

<template>

</template>
