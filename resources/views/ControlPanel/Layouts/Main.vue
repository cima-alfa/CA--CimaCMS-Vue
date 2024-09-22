<script setup></script>

<template>
    <header class="bg-slate-800 text-white">
        <nav class="p-6 mx-auto max-w-screen-lg">
            <a :href="route('pages.show', { permalink: '' })">Front</a>
            <Link :href="route('cp.dashboard')">Dashboard</Link>
            <Link :href="route('cp.auth.logout')" as="button" method="post">
                Logout
            </Link>
        </nav>
    </header>

    <main class="p-6">
        <slot />
    </main>
</template>
