<script setup>
import { computed } from "vue";

import InfoBox from "./InfoBox.vue";

const props = defineProps({
    type: {
        type: String,
        default: "info",
    },
    messages: [Array, Object, String],
});

const messages = computed(() =>
    typeof props.messages === "string" ? [props.messages] : props.messages
);
</script>

<template>
    <InfoBox v-if="messages" :type="type" class="font-semibold">
        <p v-for="(message, i) in messages" :key="i">{{ message }}</p>
    </InfoBox>
</template>
