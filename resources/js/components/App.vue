<script lang="ts" setup>
import {onMounted} from "vue";
import Notifications from "@/components/Notifications.vue";
import SidebarResponsive from "@/components/SidebarResponsive.vue";
import SidebarDesktop from "@/components/SidebarDesktop.vue";
import Header from "@/components/Header.vue";
import {useAuthentication} from "@/stores/authentication.ts";
import {subscribe} from "@/services/broadcasting.ts";

const authentication = useAuthentication();

onMounted(() => {
    if (authentication.is_authenticated) {
        // We need to reestablish the connection and subscribe to the required channels
        window.axios.defaults.headers.common["Authorization"] = `Bearer ${authentication.auth.bearer}`;
        subscribe(authentication.auth.user.id);
    }
})
</script>

<template>
    <div>
        <Notifications />
        <SidebarResponsive />
        <SidebarDesktop />

        <div :class="[authentication.is_authenticated ? 'lg:pl-72' : '']">
            <Header />

            <main class="py-10">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <router-view v-slot="{ Component, route }">
                        <div :key="route.name">
                            <Component :is="Component" />
                        </div>
                    </router-view>
                </div>
            </main>
        </div>
    </div>
</template>
