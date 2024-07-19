<script setup lang="ts">
import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import {BellIcon, XMarkIcon} from "@heroicons/vue/24/outline";
import {useNotifications} from "@/stores/notifications.ts";

const notifications = useNotifications();
</script>

<template>
    <Menu as="div" class="relative inline-block text-left">
        <div>
            <MenuButton class="p-2.5 text-gray-400 hover:text-gray-500 relative">
                <span class="sr-only">View notifications</span>
                <BellIcon class="h-6 w-6" aria-hidden="true"/>
                <div v-if="notifications.events.length > 0" class="absolute top-1 left-8 p-0 px-1.5 text-xs font-bold text-white bg-gradient-to-br from-emerald-700 to-green-900 rounded-full h-4">
                    {{ notifications.events.length }}
                </div>
            </MenuButton>
        </div>

        <transition enter-active-class="transition ease-out duration-100"
                    enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-75"
                    leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
            <MenuItems
                class="absolute right-0 z-10 mt-2 w-80 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-1 divide-y">
                    <MenuItem v-for="(notification, index) in notifications.events" :key="notification.id" as="div"
                              v-slot="{ active }">
                        <div :class="[active ? 'bg-gray-50' : '', 'cursor-pointer']"
                             class="flex items-start px-4 py-2">
                            <div class="ml-1 w-0 flex-1 pt-0.5">
                                <p class="text-xs text-gray-400">
                                    <timeago :datetime="notification.created_at"/>
                                </p>
                                <p v-if="notification.type == 'warning'" class="text-md font-bold text-yellow-900">
                                    {{ notification.title }}</p>
                                <p v-else-if="notification.type == 'error'" class="text-md font-bold text-red-900">
                                    {{ notification.title }}</p>
                                <p v-else-if="notification.type == 'success'" class="text-md font-bold text-green-900">
                                    {{ notification.title }}</p>
                                <p v-else class="text-md font-bold text-sky-900">{{ notification.title }}</p>
                                <p class="mt-1 text-sm text-gray-500">{{ notification.body }}</p>
                            </div>
                            <div class="ml-4 flex flex-shrink-0">
                                <button type="button" @click.prevent="notifications.events.splice(index, 1)"
                                        class="inline-flex rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                    <span class="sr-only">Close</span>
                                    <XMarkIcon class="h-5 w-5" aria-hidden="true"/>
                                </button>
                            </div>
                        </div>
                    </MenuItem>
                    <MenuItem v-if="notifications.events.length > 0" v-slot="{ active }">
                        <button type="button" @click.prevent="notifications.events = []"
                                :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block w-full px-4 py-4 text-center text-sm']">
                            Remove all notifications
                        </button>
                    </MenuItem>
                    <MenuItem v-else v-slot="{ active }">
                        <button type="button" @click.prevent=";"
                                :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block w-full px-4 py-4 text-center text-sm']">
                            There aren't notifications
                        </button>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<style scoped>

</style>
