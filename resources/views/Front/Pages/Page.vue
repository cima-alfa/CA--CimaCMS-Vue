<script setup></script>

<template>
    <Head title="Page" />

    <Link href="/control-panel">Control Panel</Link>
    <br />
    <Link :href="permalink('')">Home</Link>
    <br />
    <Link :href="permalink('page1', { foo: 'bar' })">Page 1</Link>
    <br />
    <Link :href="permalink('page2')">Page 2</Link>
</template>
