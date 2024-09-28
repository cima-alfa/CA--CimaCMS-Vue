<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

import Auth from "@control-panel/views/Layouts/Auth.vue";
import InputField from "@control-panel/views/Components/Forms/InputField.vue";
import BaseButton from "@control-panel/views/Components/BaseButton.vue";
import FlashMessages from "@control-panel/views/Components/FlashMessages.vue";

defineOptions({
    layout: Auth,
    inheritAttrs: false,
});

defineProps({
    notificationStatus: String,
});

const passwordResetRequest = useForm({
    email: "",
});

const submitPasswordResetRequestForm = () => {
    passwordResetRequest.post(route("password.email"));
};
</script>

<template>
    <Head title="Password Recovery" />

    <h1 class="text-2xl font-bold text-balance">Password Recovery</h1>

    <div class="pt-5 text-pretty">
        <p>
            Forgot your password? Fill in your e-mail down below to start the
            password recovery process.
        </p>
    </div>

    <div class="pt-5">
        <form @submit.prevent="submitPasswordResetRequestForm" novalidate>
            <FlashMessages
                :messages="notificationStatus"
                mode="success"
                class="mb-5"
            />

            <div class="pb-5">
                <InputField
                    label="E-Mail"
                    type="email"
                    required
                    autocomplete="email"
                    :message="passwordResetRequest.errors.email"
                    v-model="passwordResetRequest.email"
                />
            </div>

            <div class="pt-2">
                <BaseButton
                    type="submit"
                    :disabled="passwordResetRequest.processing"
                >
                    Recover Password
                </BaseButton>
            </div>
        </form>
    </div>
</template>
