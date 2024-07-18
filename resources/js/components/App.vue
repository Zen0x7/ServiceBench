<script lang="ts" setup>
import Notifications from "@/components/Notifications.vue";
import SidebarResponsive from "@/components/SidebarResponsive.vue";
import SidebarDesktop from "@/components/SidebarDesktop.vue";
import Header from "@/components/Header.vue";
import {useAuthentication} from "@/stores/authentication.ts";

const authentication = useAuthentication();
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
