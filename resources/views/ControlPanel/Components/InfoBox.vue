<script setup>
defineProps({
    type: {
        type: String,
        default: "info",
    },
});
</script>

<template>
    <div
        class="border rounded px-3 py-[6px] shadow-[inset_0_0_2px_1px_hsl(0,0%,0%,0.2)]"
        :class="{
            'border-sky-400 bg-sky-700 text-sky-50 dark:border-sky-300 dark:bg-sky-50 dark:text-sky-950':
                type == 'info',
            'border-green-400 bg-green-700 text-green-50 dark:border-green-300 dark:bg-green-50 dark:text-green-950':
                type == 'success',
            'border-red-400 bg-red-700 text-red-50 dark:border-red-300 dark:bg-red-50 dark:text-red-950':
                type == 'alert',
        }"
    >
        <slot />
    </div>
</template>
