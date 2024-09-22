<script setup>
import { useForm } from "@inertiajs/vue3";

import Auth from "../../../Layouts/Auth.vue";
import InputField from "../../../Components/Forms/InputField.vue";
import BaseButton from "../../../Components/BaseButton.vue";
import FlashMessages from "../../../Components/FlashMessages.vue";

defineOptions({
    layout: Auth,
    inheritAttrs: false,
});

const props = defineProps({
    email: String,
    token: String,
    resetStatus: String,
});

const passwordResetForm = useForm({
    email: props.email,
    password: "",
    password_confirmation: "",
    token: props.token,
});

const submitPasswordResetForm = () => {
    passwordResetForm.reset("email");

    passwordResetForm.post(route("password.update"), {
        onFinish: () => {
            passwordResetForm.reset("password", "password_confirmation");
        },
    });
};
</script>

<template>
    <Head title="Password Recovery" />

    <h1 class="text-2xl font-bold text-balance">Password Recovery</h1>

    <div class="pt-5">
        <form @submit.prevent="submitPasswordResetForm" novalidate>
            <FlashMessages
                :messages="resetStatus"
                type="success"
                class="mb-5"
            />

            <FlashMessages
                :messages="passwordResetForm.errors.resetError"
                type="alert"
                class="mb-5"
            />

            <input
                name="token"
                type="hidden"
                autocomplete="off"
                v-model="passwordResetForm.token"
            />

            <div class="pb-5">
                <InputField
                    label="E-Mail"
                    type="email"
                    required
                    autocomplete="email"
                    readonly
                    :message="passwordResetForm.errors.email"
                    v-model="passwordResetForm.email"
                />
            </div>

            <div class="pb-5">
                <InputField
                    label="New Password"
                    type="password"
                    required
                    autocomplete="new-password"
                    :message="passwordResetForm.errors.password"
                    v-model="passwordResetForm.password"
                />
            </div>

            <div class="pb-5">
                <InputField
                    label="Password Confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    :error="'password' in passwordResetForm.errors"
                    v-model="passwordResetForm.password_confirmation"
                />
            </div>

            <div class="pt-2">
                <BaseButton
                    type="submit"
                    :disabled="passwordResetForm.processing"
                >
                    Reset Password
                </BaseButton>
            </div>
        </form>
    </div>
</template>
