<script setup lang="ts">
import {Cog6ToothIcon} from "@heroicons/vue/24/outline";
import {useNavigation} from "@/stores/navigation.ts";
import {useAuthentication} from "@/stores/authentication.ts";
import {Gravatar} from "@sauromates/vue-gravatar";

const navigation = useNavigation();
const authentication = useAuthentication();
</script>

<template>
    <!-- Static sidebar for desktop -->
    <div v-if="authentication.is_authenticated" class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4">
            <div class="flex h-16 shrink-0 items-center">
                <img class="h-10 w-auto" src="/logo.svg" alt="Your Company" />
            </div>
            <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1">
                            <li v-for="item in navigation.links" :key="item.name">
                                <a :href="item.href" :class="[item.current ? 'bg-gray-50 text-emerald-600' : 'text-gray-700 hover:bg-gray-50 hover:text-emerald-600', 'group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6']">
                                    <component :is="item.icon" :class="[item.current ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-600', 'h-6 w-6 shrink-0']" aria-hidden="true" />
                                    {{ item.name }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div class="text-xs font-semibold leading-6 text-gray-400">Your teams</div>
                        <ul role="list" class="-mx-2 mt-2 space-y-1">
                            <li v-for="team in authentication.teams" :key="team.name">
                                <a :href="team.href" :class="[team.current ? 'bg-gray-50 text-emerald-600' : 'text-gray-700 hover:bg-gray-50 hover:text-emerald-600', 'group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6']">
                                    <span :class="[team.current ? 'border-emerald-600 text-emerald-600' : 'border-gray-200 text-gray-400 group-hover:border-emerald-600 group-hover:text-emerald-600', 'flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border bg-white text-[0.625rem] font-medium']">{{ team.initial }}</span>
                                    <span class="truncate">{{ team.name }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div class="text-xs font-semibold leading-6 text-gray-400">Users</div>
                        <ul role="list" class="-mx-2 mt-2 space-y-1">
                            <li v-for="user in authentication.users" :key="user.name">
                                <a :href="'#' + user.id" :class="['text-gray-700 hover:bg-gray-50 hover:text-emerald-600', 'group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-9']">

                                    <span class="relative inline-flex">
                                        <button type="button" class="inline-flex rounded-lg items-center font-semibold leading-6 text-sm rounded-md text-sky-500 bg-white transition ease-in-out duration-150 cursor-not-allowed" disabled="">
                                            <Gravatar class="h-8 w-8 rounded-full"
                                                      :class="[authentication.is_connected(user) ? 'border-emerald-600 text-emerald-600' : 'border-gray-200 text-gray-400 group-hover:border-emerald-600 group-hover:text-emerald-600']"
                                                      :email="user.email"
                                                      rating="g"
                                                      force-default="y"/>
                                        </button>
                                        <span v-if="authentication.is_connected(user)" class="flex absolute h-3 w-3 bottom-0 -right-0.5 -mt-3 -mr-1">
                                            <span class="absolute animate-ping inline-flex h-full w-full rounded-full bg-emerald-500 opacity-25"></span>
                                            <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                                        </span>
                                    </span>

                                    <span class="truncate">{{ user.name }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="mt-auto">
                        <a href="#" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-emerald-600">
                            <Cog6ToothIcon class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-emerald-600" aria-hidden="true" />
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<style scoped>

</style>
