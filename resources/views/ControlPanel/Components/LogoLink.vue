<script setup lang="ts">
import BaseLogo from "@control-panel/views/Components/BaseLogo.vue";

defineProps({
    href: {
        type: String,
        default: route("cp.dashboard.index"),
    },
    title: {
        type: String,
        default: "Control Panel",
    },
});
</script>

<template>
    <Link :href="href" :title="title">
        <BaseLogo />
    </Link>
</template>
