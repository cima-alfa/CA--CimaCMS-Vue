<script setup lang="ts">
defineProps({
    is: {
        type: String,
        default: "div",
    },
});
</script>

<template>
    <component
        :is="is"
        class="p-3 bg-neutral-200 dark:bg-neutral-800 rounded-lg shadow"
    >
        <slot />
    </component>
</template>
