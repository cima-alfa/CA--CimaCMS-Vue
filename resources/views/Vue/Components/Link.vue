<script setup>
/* eslint "vue/multi-word-component-names": "off" */

import { Link } from "@inertiajs/vue3";

defineProps({
    href: String,
});
</script>

<template>
    <Link v-if="href !== '#url-error'" :href="href">
        <slot />
    </Link>

    <a v-else :href="href" disabled>
        <slot />
    </a>
</template>
