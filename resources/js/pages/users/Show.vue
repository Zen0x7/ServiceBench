<script lang="ts" setup>
import {onMounted, ref, watch} from "vue";
import {useRoute, useRouter} from "vue-router";
import {useNotifications} from "@/stores/notifications.ts";
import { MagnifyingGlassIcon, EllipsisVerticalIcon, CogIcon } from '@heroicons/vue/20/solid'
import {Gravatar} from "@sauromates/vue-gravatar";
import Commenter from "@/components/Commenter.vue";
import {useChat} from "@/stores/chat.ts";
import {useAuthentication} from "@/stores/authentication.ts";

const route = useRoute();
const router = useRouter();
const notifications = useNotifications();
const chat = useChat();
const authentication = useAuthentication();

const loading = ref(true)
const user = ref({})
const messages = ref([])

const get_user = async () => {
    loading.value = true
    const response = await window.axios.get(`/api/users/${route.params.id}`)
    user.value = response.data;
    loading.value = false;
}

const get_messages = async () => {
    await chat.retrieve(route.params.id);
}

watch(() => route.params.id, async() => {
    await get_user()
    await get_messages();
})

onMounted(async () => {
    const items = [Number.parseInt(route.params.id), authentication.auth.user.id].sort();
    chat.set_on(items.join("_"));

    await get_user();
    await get_messages();

    const element = window.document.getElementById("chat-box")

    console.log(element)

    if (element) {
        element.scrollIntoView({behavior: 'smooth'});
    }
})
</script>

<style>
.autoscrollable-wrapper {
    overflow: auto;
    max-height: 100%;
    display: flex;
    flex-direction: column-reverse;
    height: calc(100vh - 4rem - 5rem - 12rem);
}
</style>

<template>
    <div>
        <div class="sticky top-16 bg-gradient-to-r from-gray-700 to-gray-900">
            <div v-if="!loading" class="mx-auto px-6">
                <div class="flex items-end space-x-5 py-4 h-16">
                    <div class="flex">
                        <Gravatar class="h-10 w-10 rounded-full ring-1 ring-white"
                                  :email="user.email"
                                  rating="g" />
                    </div>
                    <div class="flex min-w-0 flex-1 items-center justify-end space-x-6 pb-1">
                        <div class="min-w-0 flex-1 block">
                            <h1 class="truncate text-md font-bold text-white">{{ user.name }}</h1>
                        </div>
                        <div class="flex justify-stretch  flex-row space-x-4 space-y-0">
                            <button type="button" class="inline-flex justify-center rounded-full py-2 px-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-emerald-700">
                                <MagnifyingGlassIcon class="h-4 w-4 text-white" aria-hidden="true" />
                            </button>
                            <button type="button" class="inline-flex justify-center rounded-full py-2 px-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-emerald-700">
                                <EllipsisVerticalIcon class="h-4 w-4 text-white" aria-hidden="true" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="!loading" class="autoscrollable-wrapper px-6">
            <div class="grid">
                <div v-for="message in chat.events" class="flex items-start gap-2.5 mt-5">
                    <Gravatar class="w-8 h-8 rounded-full"
                              :email="message.from.email"
                              rating="g" />
                    <div class="flex flex-col w-full leading-1.5 border p-4 border-gray-200 rounded-e-xl rounded-es-xl">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-sm font-semibold text-gray-900">{{ message.from.name }}</span>
                            <span class="text-sm font-normal text-gray-500">{{ message.created_at }}</span>
                        </div>
                        <p class="text-sm font-normal py-2.5 text-gray-900">{{ message.body }}</p>
                        <!--                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Delivered</span>-->
                    </div>
<!--                    <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" data-dropdown-placement="bottom-start" class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600" type="button">-->
<!--                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">-->
<!--                            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>-->
<!--                        </svg>-->
<!--                    </button>-->
<!--                    <div id="dropdownDots" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40 dark:bg-gray-700 dark:divide-gray-600">-->
<!--                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">-->
<!--                            <li>-->
<!--                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reply</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Forward</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Copy</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
                </div>

                <div id="chat-box">&nbsp;</div>
            </div>
        </div>

        <commenter class="p-4" />

    </div>
</template>
