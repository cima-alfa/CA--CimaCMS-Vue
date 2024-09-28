<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

import Auth from "@control-panel/views/Layouts/Auth.vue";
import BaseButton from "@control-panel/views/Components/BaseButton.vue";
import FlashMessages from "@control-panel/views/Components/FlashMessages.vue";

defineOptions({
    layout: Auth,
    inheritAttrs: false,
});

const props = defineProps({
    verificationStatus: String,
    notifyTimeout: {
        type: Number,
        required: true,
    },
});

const verificationForm = useForm({});

const disableSubmitTimer = ref(false);

const submitVerificationForm = () => {
    verificationForm.post(route("verification.send"), {
        onFinish: () => {
            disableSubmitTimer.value = true;

            setTimeout(() => {
                disableSubmitTimer.value = false;
            }, props.notifyTimeout * 60 * 1000);
        },
    });
};
</script>

<template>
    <Head title="User Verification" />

    <h1 class="text-2xl font-bold text-balance">Verify your e-mail</h1>

    <div class="pt-5 text-pretty">
        <p>
            Before you start using your account, your e-mail address needs to be
            verified by clicking the link we've just sent you.
        </p>
        <p class="mt-2">
            Didn't receive any e-mail from us? Don't worry, click the button
            below to resend you the verification link.
        </p>
    </div>

    <div class="pt-5">
        <FlashMessages
            :messages="verificationStatus"
            mode="success"
            class="mb-5"
        />

        <form @submit.prevent="submitVerificationForm" novalidate>
            <BaseButton
                type="submit"
                :disabled="verificationForm.processing || disableSubmitTimer"
            >
                Resend verification e-mail
            </BaseButton>
        </form>
    </div>
</template>
