<script setup>
defineProps({
    element: {
        type: String,
        default: "button",
    },
    mode: {
        type: String,
        default: "primary",
    },
});

const modes = ["secondary", "accent", "success", "warning", "alert"];
</script>

<template>
    <component
        :is="element"
        class="block w-full rounded p-3 text-lg text-center font-bold shadow-md transition-colors cursor-pointer disabled:text-zinc-100 disabled:bg-slate-500 dark:disabled:bg-slate-500 disabled:cursor-not-allowed"
        :class="{
            'text-zinc-100 bg-sky-600 hover:bg-sky-700 focus:bg-sky-700 dark:text-zinc-900 dark:bg-sky-400 dark:hover:bg-sky-300 dark:focus:bg-sky-300':
                !modes.includes(mode),
        }"
        :href="$attrs.href"
    >
        <slot />
    </component>
</template>
