<script lang="ts" setup>
import {useForm} from 'laravel-precognition-vue';
import {onMounted} from "vue";
import {useRoute, useRouter} from "vue-router";
import {useNotifications} from "@/stores/notifications.ts";
import {useAuthentication} from "@/stores/authentication.ts";

const route = useRoute();
const router = useRouter();
const notifications = useNotifications();
const authentication = useAuthentication();

const form = useForm("post", "/api/auth/register", {
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
})

form.setValidationTimeout(1000);

const submit = () => form.submit()
    .then(response => {
        form.reset();
        notifications.push({
            type: 'success',
            title: "Registration success",
            body: "We sent an message to your email",
        });
        router.push({ path: '/auth/login' });
    })
    .catch(error => {
        notifications.push({
            type: 'warning',
            title: "Something went wrong",
            body: "Service cannot process the request"
        });
    });


onMounted(async () => {
    // try {
    //     await window.axios.post("/api/auth/verify", {
    //         token: route.params.token,
    //     })
    //     notifications.push({
    //         type: 'success',
    //         title: "Address verification success",
    //         body: "The account has been verified",
    //     });
    // } catch (e) {
    //     if (e.response) {
    //         switch (e.response.status) {
    //             case 422:
    //                 notifications.push({
    //                     type: 'error',
    //                     title: "Address verification failed",
    //                     body: "The account doesn't exists",
    //                 });
    //                 // Token doesn't exists
    //                 break;
    //             case 403:
    //                 notifications.push({
    //                     type: 'warning',
    //                     title: "Your account is already verified",
    //                     body: "The link has been used previously"
    //                 });
    //                 break;
    //         }
    //     } else {
    //         // Service unavailable
    //     }
    // }
})
</script>

<template>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=emerald&shade=600"
                 alt="Your Company"/>
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Registration</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" @submit.prevent="submit">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                        <input
                            v-model="form.name"
                            @change="form.validate('name')"
                            id="name"
                            name="name"
                            type="text"
                            autocomplete="name"
                            required=""
                            class=""
                            :class="[form.invalid('name') ?
                                'block w-full rounded-md border-0 py-1.5 text-red-900 shadow-sm ring-1 ring-inset ring-red-300 placeholder:text-red-300 focus:ring-2 focus:ring-inset focus:ring-red-500 sm:text-sm sm:leading-6' :
                                'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6']"
                        />
                    </div>


                    <p class="mt-2 text-sm text-red-600" id="name-error" v-if="form.invalid('name')">
                        {{ form.errors.name }}</p>
                </div>

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
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
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
                                'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6']"/>
                    </div>

                    <p class="mt-2 text-sm text-red-600" id="password-error" v-if="form.invalid('password')">
                        {{ form.errors.password }}</p>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password
                        confirmation</label>
                    <div class="mt-2">
                        <input
                            v-model="form.password_confirmation"
                            @change="form.validate('password_confirmation')"
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            autocomplete="current-password"
                            required=""
                            :class="[form.invalid('password_confirmation') ?
                                'block w-full rounded-md border-0 py-1.5 text-red-900 shadow-sm ring-1 ring-inset ring-red-300 placeholder:text-red-300 focus:ring-2 focus:ring-inset focus:ring-red-500 sm:text-sm sm:leading-6' :
                                'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6']"/>
                    </div>

                    <p class="mt-2 text-sm text-red-600" id="password_confirmation-error"
                       v-if="form.invalid('password_confirmation')">
                        {{ form.errors.password_confirmation }}</p>
                </div>

                <div>
                    <button :disabled="form.processing" type="submit"
                            class="flex w-full justify-center rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                        Sign in
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Already registered?
                {{ ' ' }}
                <RouterLink to="/auth/login"
                            class="font-semibold leading-6 text-emerald-600 hover:text-emerald-500 ml-2">Attempt now
                </RouterLink>
            </p>
        </div>
    </div>
</template>
