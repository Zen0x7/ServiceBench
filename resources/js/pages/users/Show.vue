<script lang="ts" setup>
import {onMounted, ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import {useNotifications} from "@/stores/notifications.ts";
import { MagnifyingGlassIcon, EllipsisVerticalIcon, CogIcon } from '@heroicons/vue/20/solid'
import {Gravatar} from "@sauromates/vue-gravatar";

const route = useRoute();
const router = useRouter();
const notifications = useNotifications();

const loading = ref(true)
const user = ref({})


onMounted(async () => {
    const response = await window.axios.get(`/api/users/${route.params.id}`)
    user.value = response.data;
    loading.value = false;
    console.log(response);
})
</script>

<template>
    <div class="bg-gradient-to-r from-gray-700 to-gray-900">
        <div v-if="!loading" class="mx-auto px-6">
            <div class="sm:flex sm:items-end sm:space-x-5 py-4">
                <div class="flex">
                    <Gravatar class="h-10 w-10 rounded-full ring-4 ring-white"
                              :email="user.email"
                              rating="g" />
                </div>
                <div class="sm:flex sm:min-w-0 sm:flex-1 sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                    <div class="min-w-0 flex-1 block">
                        <h1 class="truncate text-3xl font-bold text-white">{{ user.name }}</h1>
                    </div>
                    <div class="flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-x-4 sm:space-y-0">
                        <button type="button" class="inline-flex justify-center rounded-full py-2 px-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-emerald-700">
                            <MagnifyingGlassIcon class="h-5 w-5 text-white" aria-hidden="true" />
                        </button>
                        <button type="button" class="inline-flex justify-center rounded-full py-2 px-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-emerald-700">
                            <EllipsisVerticalIcon class="h-5 w-5 text-white" aria-hidden="true" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
