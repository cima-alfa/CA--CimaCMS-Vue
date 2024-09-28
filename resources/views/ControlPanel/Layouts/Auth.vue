<script setup lang="ts">
import LogoLink from "@control-panel/views/Components/LogoLink.vue";
</script>

<template>
    <div
        class="absolute left-0 top-0 grid min-h-full w-full place-items-center bg-neutral-300 p-5 dark:bg-neutral-900"
    >
        <div
            class="grid w-full max-w-lg rounded-lg bg-neutral-200 px-2 shadow dark:bg-neutral-800"
        >
            <header class="px-3 py-5 text-center">
                <LogoLink />
            </header>

            <main
                class="border-y border-neutral-300 px-3 py-5 dark:border-neutral-900"
            >
                <slot />
            </main>

            <footer class="px-3 py-5 text-center text-xs font-bold">
                &copy; {{ new Date().getFullYear() }}
            </footer>
        </div>
    </div>
</template>
