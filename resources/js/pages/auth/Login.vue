<script lang="ts" setup>
import {useForm} from 'laravel-precognition-vue';
import {useRoute, useRouter} from "vue-router";
import {useNotifications} from "@/stores/notifications.ts";
import {useAuthentication} from "@/stores/authentication.ts";
import {subscribe} from "@/services/broadcasting.ts";


const route = useRoute();
const router = useRouter();
const notifications = useNotifications();
const authentication = useAuthentication();

const form = useForm("post", "/api/auth/attempt", {
    email: "",
    password: "",
})

form.setValidationTimeout(1000);

const submit = () => form.submit()
    .then(response => {
        authentication.set_token(response.data.access_token);
        form.reset();
        notifications.push({
            type: 'success',
            title: "Authentication success",
            body: "You're welcome",
        });
        router.push({ path: '/dashboard' });
    })
    .catch(error => {
        notifications.push({
            type: 'warning',
            title: "Something went wrong",
            body: "Service cannot process the request"
        });
    });
</script>

<template>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-20 w-auto" src="/logo.svg"
                 alt="Service Bench"/>
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Authentication</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" @submit.prevent="submit">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input
                            v-model="form.email"
                            @change="form.validate('email')"
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            required=""
                            class=""
                            :class="[form.invalid('email') ?
                                'block w-full rounded-md border-0 py-1.5 text-red-900 shadow-sm ring-1 ring-inset ring-red-300 placeholder:text-red-300 focus:ring-2 focus:ring-inset focus:ring-red-500 sm:text-sm sm:leading-6' :
                                'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6']"
                        />
                    </div>


                    <p class="mt-2 text-sm text-red-600" id="email-error" v-if="form.invalid('email')">
                        {{ form.errors.email }}</p>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="hidden text-sm">
                            <a href="#" class="font-semibold text-emerald-600 hover:text-emerald-500">Forgot
                                password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input
                            v-model="form.password"
                            @change="form.validate('password')"
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required=""
                            :class="[form.invalid('password') ?
                                'block w-full rounded-md border-0 py-1.5 text-red-900 shadow-sm ring-1 ring-inset ring-red-300 placeholder:text-red-300 focus:ring-2 focus:ring-inset focus:ring-red-500 sm:text-sm sm:leading-6' :
                                'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6']" />
                    </div>

                    <p class="mt-2 text-sm text-red-600" id="password-error" v-if="form.invalid('password')">
                        {{ form.errors.password }}</p>
                </div>

                <div>
                    <button :disabled="form.processing" type="submit"
                            class="flex w-full justify-center rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                        Sign in
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Not a member?
                {{ ' ' }}
                <RouterLink to="/auth/register"
                            class="font-semibold leading-6 text-emerald-600 hover:text-emerald-500 ml-2">Register now
                </RouterLink>
            </p>
        </div>
    </div>
</template>
