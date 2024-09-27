<script setup>
import BaseButton from "../Components/BaseButton.vue";
import BaseLogo from "../Components/BaseLogo.vue";
import BasePanel from "../Components/BasePanel.vue";
</script>

<template>
    <div
        class="w-full h-dvh p-3 grid gap-3 lg:[grid-template-areas:'aside_header''aside_main''aside_footer'] lg:grid-cols-[auto_1fr] lg:grid-rows-[auto_1fr_auto]"
    >
        <BasePanel class="[grid-area:header] lg:h-16" is="header"> </BasePanel>

        <aside
            class="[grid-area:aside] lg:grid lg:gap-3 lg:grid-rows-[auto_auto_1fr_auto] lg:w-72"
        >
            <BasePanel class="grid place-content-center lg:h-16">
                <Link :href="route('cp.dashboard.index')" title="Control Panel">
                    <BaseLogo />
                </Link>
            </BasePanel>

            <BasePanel is="section" aria-label="Primary Navigation"></BasePanel>

            <BasePanel />

            <BasePanel
                is="section"
                aria-label="Settings"
                class="row-[span_1/-1]"
            >
                <BaseButton
                    is="button"
                    :href="route('cp.dashboard.index')"
                    mode="alert"
                    >Settings</BaseButton
                >
            </BasePanel>
        </aside>

        <BasePanel class="[grid-area:main]" is="main">
            <slot />
        </BasePanel>

        <BasePanel class="[grid-area:footer]" is="footer"> </BasePanel>
    </div>
</template>
