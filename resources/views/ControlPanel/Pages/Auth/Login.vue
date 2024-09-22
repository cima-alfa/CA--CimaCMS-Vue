<script setup>
import { useForm } from "@inertiajs/vue3";

import Auth from "../../Layouts/Auth.vue";
import TextLink from "../../Components/TextLink.vue";
import InputField from "../../Components/Forms/InputField.vue";
import SwitchBox from "../../Components/Forms/SwitchBox.vue";
import BaseButton from "../../Components/BaseButton.vue";
import FlashMessages from "../../Components/FlashMessages.vue";

defineOptions({
    layout: Auth,
    inheritAttrs: false,
});

defineProps({
    resetStatus: String,
});

const loginForm = useForm({
    login: "",
    password: "",
    remember: null,
});

const submitLoginForm = () => {
    loginForm.post(route("cp.auth.login"), {
        onFinish: () => {
            loginForm.reset("password");
        },
    });
};
</script>

<template>
    <Head title="Login" />

    <h1 class="text-2xl font-bold text-balance">Login</h1>

    <div class="pt-5">
        <form @submit.prevent="submitLoginForm" novalidate>
            <FlashMessages
                :messages="resetStatus"
                type="success"
                class="mb-5"
            />

            <FlashMessages
                :messages="loginForm.errors.authError"
                type="alert"
                class="mb-5"
            />

            <div class="pb-5">
                <InputField
                    label="E-Mail or Username"
                    type="email"
                    required
                    autocomplete="username"
                    :message="loginForm.errors.login"
                    v-model="loginForm.login"
                />
            </div>

            <div class="pb-5">
                <InputField
                    label="Password"
                    type="password"
                    required
                    autocomplete="new-password"
                    :message="loginForm.errors.password"
                    v-model="loginForm.password"
                />
                <div class="mt-2 text-sm">
                    <TextLink :href="route('password.request')">
                        Forgot password?
                    </TextLink>
                </div>
            </div>

            <div class="pb-5">
                <SwitchBox label="Remember me" />
            </div>

            <BaseButton type="submit" :disabled="loginForm.processing">
                Login
            </BaseButton>
        </form>
    </div>

    <div class="pt-5 text-center text-sm sm:text-right">
        <TextLink :href="route('cp.auth.create')">
            <span class="whitespace-nowrap">Don't have an account yet?</span>
            <span class="whitespace-nowrap">Register here!</span>
        </TextLink>
    </div>
</template>
