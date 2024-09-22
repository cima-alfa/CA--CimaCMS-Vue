<script setup></script>

<template>
    <div
        class="absolute left-0 top-0 grid min-h-full w-full place-items-center bg-zinc-300 p-5 dark:bg-zinc-900"
    >
        <div
            class="grid w-full max-w-lg rounded-lg bg-zinc-200 px-2 shadow dark:bg-zinc-800"
        >
            <header class="px-3 py-5 text-center">
                <span class="font-bold text-balance text-3xl">
                    Control<span class="text-sky-600 dark:text-sky-400"
                        >Panel</span
                    >
                </span>
            </header>

            <main
                class="border-y border-zinc-300 px-3 py-5 dark:border-zinc-900"
            >
                <slot />
            </main>

            <footer class="px-3 py-5 text-center text-xs font-bold">
                &copy; {{ new Date().getFullYear() }}
            </footer>
        </div>
    </div>
</template>
