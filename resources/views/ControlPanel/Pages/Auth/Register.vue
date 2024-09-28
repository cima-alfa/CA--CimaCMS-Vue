<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import Auth from "@control-panel/views/Layouts/Auth.vue";
import InputField from "@control-panel/views/Components/Forms/InputField.vue";
import TextLink from "@control-panel/views/Components/TextLink.vue";
import BaseButton from "@control-panel/views/Components/BaseButton.vue";

defineOptions({
    layout: Auth,
    inheritAttrs: false,
});

const registerForm = useForm({
    username: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submitRegisterForm = () => {
    registerForm.post(route("cp.auth.store"), {
        onFinish: () => {
            registerForm.reset("password", "password_confirmation");
        },
    });
};
</script>

<template>
    <Head title="Registration" />

    <h1 class="text-2xl font-bold text-balance">Registration</h1>

    <div class="pt-5">
        <form @submit.prevent="submitRegisterForm" novalidate>
            <div class="pb-5">
                <InputField
                    label="Username"
                    required
                    autocomplete="username"
                    :message="registerForm.errors.username"
                    v-model="registerForm.username"
                />
            </div>

            <div class="pb-5">
                <InputField
                    label="E-Mail"
                    type="email"
                    required
                    autocomplete="email"
                    :message="registerForm.errors.email"
                    v-model="registerForm.email"
                />
            </div>

            <div class="pb-5">
                <InputField
                    label="Password"
                    type="password"
                    required
                    autocomplete="new-password"
                    :message="registerForm.errors.password"
                    v-model="registerForm.password"
                />
            </div>

            <div class="pb-5">
                <InputField
                    label="Password Confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    :error="'password' in registerForm.errors"
                    v-model="registerForm.password_confirmation"
                />
            </div>

            <div class="pt-2">
                <BaseButton type="submit" :disabled="registerForm.processing">
                    Register now
                </BaseButton>
            </div>
        </form>
    </div>

    <div class="pt-5 text-center text-sm sm:text-right">
        <TextLink :href="route('cp.auth.show')" mode="action-secondary">
            <span class="whitespace-nowrap">Already have an account?</span>
            <span class="whitespace-nowrap">Sign in here!</span>
        </TextLink>
    </div>
</template>
