<script setup lang="ts">
import { computed } from "vue";
import InfoBox from "@control-panel/views/Components/InfoBox.vue";
import type { StyleMode } from "@control-panel/js/definitions";

interface Props {
    messages: String[] | Object | String;
    mode?: StyleMode;
}

const { messages: _messages, mode } = defineProps<Props>();

const messages = computed(() =>
    typeof _messages === "string" ? [_messages] : _messages
);
</script>

<template>
    <InfoBox v-if="messages" :mode="mode" class="font-semibold">
        <p v-for="(message, i) in messages" :key="i">{{ message }}</p>
    </InfoBox>
</template>
