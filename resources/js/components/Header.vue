<script setup lang="ts">
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
import {ChevronDownIcon, MagnifyingGlassIcon, UserCircleIcon} from "@heroicons/vue/20/solid";
import {Bars3Icon} from "@heroicons/vue/24/outline";
import {Gravatar} from '@sauromates/vue-gravatar'
import {useNavigation} from "@/stores/navigation.ts";
import {useAuthentication} from "@/stores/authentication.ts";
import NotificationsDropdown from "@/components/NotificationsDropdown.vue";

const navigation = useNavigation();
const authentication = useAuthentication();
</script>

<template>
    <div class="sticky top-0 z-40 lg:mx-auto lg:max-w-full lg:px-8 bg-white h-20">
        <div v-if="authentication.is_authenticated"
             class="flex h-16 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-0 lg:shadow-none">
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="navigation.open = true">
                <span class="sr-only">Open sidebar</span>
                <Bars3Icon class="h-6 w-6" aria-hidden="true"/>
            </button>

            <div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true"/>

            <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                <form class="relative flex flex-1" action="#" method="GET">
                    <label for="search-field" class="sr-only">Search</label>
                    <MagnifyingGlassIcon class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400"
                                         aria-hidden="true"/>
                    <input id="search-field"
                           class="block h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm"
                           placeholder="Search..." type="search" name="search"/>
                </form>
                <div class="flex items-center gap-x-4 lg:gap-x-6">

                    <NotificationsDropdown/>

                    <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true"/>

                    <Menu v-if="authentication.has_profile" as="div" class="relative">
                        <MenuButton class="-m-1.5 flex items-center p-1.5">
                            <span class="sr-only">Open user menu</span>
                            <Gravatar class="h-8 w-8 rounded-full"
                                      :email="authentication.auth.user.email"
                                      rating="g" />
                            <span class="hidden lg:flex lg:items-center">
                                <span class="ml-2 text-sm font-semibold leading-6 text-gray-900"
                                      aria-hidden="true">{{ authentication.auth.user.name }}</span>
                                <ChevronDownIcon class="ml-2 h-5 w-5 text-gray-400" aria-hidden="true"/>
                            </span>
                        </MenuButton>
                        <transition enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95">
                            <MenuItems
                                class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                                <MenuItem v-for="item in navigation.dropdown" :key="item.name" v-slot="{ active }">
                                    <RouterLink :to="item.href"
                                                :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900']">
                                        {{ item.name }}
                                    </RouterLink>
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </div>
        </div>
    </div>
</template>
