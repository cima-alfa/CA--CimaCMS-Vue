<script setup>
defineProps({
    href: String,
});
</script>

<template>
    <Link :href="href" class="text-sky-800 dark:text-sky-200 hover:underline">
        <slot />
    </Link>
</template>
