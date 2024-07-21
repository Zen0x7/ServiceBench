<script lang="ts" setup>
import {onMounted} from "vue";
import Notifications from "@/components/Notifications.vue";
import SidebarResponsive from "@/components/SidebarResponsive.vue";
import SidebarDesktop from "@/components/SidebarDesktop.vue";
import Header from "@/components/Header.vue";
import {useAuthentication} from "@/stores/authentication.ts";
import {subscribe} from "@/services/broadcasting.ts";

const authentication = useAuthentication();

onMounted(async () => {
    if (authentication.is_authenticated) {
        // We need to reestablish the connection and subscribe to the required channels
        window.axios.defaults.headers.common["Authorization"] = `Bearer ${authentication.auth.bearer}`;
        subscribe(authentication.auth.user.id);
        await authentication.get_users();
    }
})
</script>

<template>
    <div class="h-full">
        <Notifications />
        <SidebarResponsive />
        <SidebarDesktop />

        <div :class="[authentication.is_authenticated ? 'lg:pl-72' : '', 'h-full']">
            <Header />

            <main>
                <div class="mx-auto">
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
