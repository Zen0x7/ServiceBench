<script lang="ts" setup>
import {onMounted, ref, watch} from "vue";
import {useRoute, useRouter} from "vue-router";
import {useNotifications} from "@/stores/notifications.ts";
import { MagnifyingGlassIcon, EllipsisVerticalIcon, CogIcon } from '@heroicons/vue/20/solid'
import {Gravatar} from "@sauromates/vue-gravatar";
import Commenter from "@/components/Commenter.vue";

const route = useRoute();
const router = useRouter();
const notifications = useNotifications();

const loading = ref(true)
const user = ref({})

const get_user = async () => {
    loading.value = true
    const response = await window.axios.get(`/api/users/${route.params.id}`)
    user.value = response.data;
    loading.value = false;
}

watch(() => route.params.id, async() => {
    await get_user()
})

onMounted(async () => {
    await get_user();
})
</script>

<template>
    <div>
        <div class="bg-gradient-to-r from-gray-700 to-gray-900">
            <div v-if="!loading" class="mx-auto px-6">
                <div class="flex items-end space-x-5 py-4">
                    <div class="flex">
                        <Gravatar class="h-10 w-10 rounded-full ring-1 ring-white"
                                  :email="user.email"
                                  rating="g" />
                    </div>
                    <div class="flex min-w-0 flex-1 items-center justify-end space-x-6 pb-1">
                        <div class="min-w-0 flex-1 block">
                            <h1 class="truncate text-md sm:text-lg md:text-2xl font-bold text-white">{{ user.name }}</h1>
                        </div>
                        <div class="flex justify-stretch space-y-3 flex-row space-x-4 space-y-0">
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

        <div class="fixed bottom-0 p-6">
            <commenter />
        </div>
    </div>
</template>
