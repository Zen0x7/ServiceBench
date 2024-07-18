<script lang="ts" setup>
import { onMounted } from "vue";
import { useRoute } from "vue-router";
import { useNotifications } from "@/stores/notifications.ts";

const route = useRoute();
const notifications = useNotifications();


onMounted(async () => {
})
</script>

<template>

</template>
