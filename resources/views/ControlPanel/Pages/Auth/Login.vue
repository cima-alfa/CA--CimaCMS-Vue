<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import Auth from "@control-panel/views/Layouts/Auth.vue";
import TextLink from "@control-panel/views/Components/TextLink.vue";
import InputField from "@control-panel/views/Components/Forms/InputField.vue";
import SwitchBox from "@control-panel/views/Components/Forms/SwitchBox.vue";
import BaseButton from "@control-panel/views/Components/BaseButton.vue";
import FlashMessages from "@control-panel/views/Components/FlashMessages.vue";

defineOptions({
    layout: Auth,
    inheritAttrs: false,
});

defineProps({
    resetStatus: String,
});

const loginForm = useForm<{
    login: String;
    password: String;
    remember: String | Boolean | null;
    authError?: String;
}>({
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
                mode="success"
                class="mb-5"
            />

            <FlashMessages
                :messages="loginForm.errors.authError"
                mode="alert"
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
                    <TextLink :href="route('password.request')" mode="mono">
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
        <TextLink :href="route('cp.auth.create')" mode="mono">
            <span class="whitespace-nowrap">Don't have an account yet?</span>
            <span class="whitespace-nowrap">Register here!</span>
        </TextLink>
    </div>
</template>
