<script lang="ts" setup>
import { ref } from 'vue'
import {
    InformationCircleIcon,
    XCircleIcon,
    XMarkIcon,
} from '@heroicons/vue/24/outline'
import { useNotifications } from "@/stores/notifications.ts";

const notifications = useNotifications();

const show = ref(true)
</script>

<template>
    <!-- Global notification live region, render this permanently at the end of the document -->
    <div aria-live="assertive" class="z-30 pointer-events-none fixed inset-0 mt-14 flex items-end px-4 py-6 sm:items-start sm:p-6">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
            <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->

            <transition v-for="(event, index) in notifications.events" enter-active-class="transform ease-out duration-300 transition" enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" enter-to-class="translate-y-0 opacity-100 sm:translate-x-0" leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                <div v-if="event.visible" class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-black ring-opacity-5">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="ml-1 w-0 flex-1 pt-0.5">
                                <p v-if="event.type == 'warning'" class="text-md font-bold text-yellow-900">{{ event.title }}</p>
                                <p v-else-if="event.type == 'error'" class="text-md font-bold text-red-900">{{ event.title }}</p>
                                <p v-else-if="event.type == 'success'" class="text-md font-bold text-green-900">{{ event.title }}</p>
                                <p v-else class="text-md font-bold text-sky-900">{{ event.title }}</p>
                                <p class="mt-1 text-md text-gray-500">{{ event.body }}</p>
                            </div>
                            <div class="ml-4 flex flex-shrink-0">
                                <button type="button" @click="event.visible = false" class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                    <span class="sr-only">Close</span>
                                    <XMarkIcon class="h-5 w-5" aria-hidden="true" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>
