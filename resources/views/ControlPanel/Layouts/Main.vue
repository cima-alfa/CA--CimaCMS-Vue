<script setup lang="ts">
import LogoLink from "@control-panel/views/Components/LogoLink.vue";
import BasePanel from "@control-panel/views/Components/BasePanel.vue";
import BaseButton from "@control-panel/views/Components/BaseButton.vue";
</script>

<template>
    <div
        class="w-full h-dvh p-3 grid gap-3 lg:[grid-template-areas:'aside_header''aside_main''aside_footer'] lg:grid-cols-[auto_1fr] lg:grid-rows-[auto_1fr_auto]"
    >
        <!-- --- Header --- -->

        <BasePanel class="[grid-area:header] lg:h-16" is="header">
            <nav class="flex h-full justify-between items-center">
                <span>Breadcrumbs > ... > ...</span>

                <ul class="flex gap-5">
                    <li>
                        <BaseButton
                            :href="route('cp.userProfile.edit')"
                            is="Link"
                            mode="success"
                        >
                            Profile
                        </BaseButton>
                    </li>
                    <li>
                        <BaseButton
                            :href="route('cp.auth.logout')"
                            is="Link"
                            as="button"
                            method="post"
                            mode="warning"
                        >
                            Logout
                        </BaseButton>
                    </li>
                </ul>
            </nav>
        </BasePanel>

        <!-- --- Aside --- -->

        <aside
            class="[grid-area:aside] lg:grid lg:gap-3 lg:grid-rows-[auto_auto_1fr_auto] lg:w-72"
        >
            <!-- --- Aside Header --- -->

            <BasePanel class="grid place-content-center lg:h-[8.75rem]">
                <LogoLink />
            </BasePanel>

            <!-- --- Aside Primary Navigation --- -->

            <BasePanel is="section" aria-label="Primary Navigation"></BasePanel>

            <!-- Filler -->
            <BasePanel />

            <!-- --- Aside Seconary Navigation --- -->

            <BasePanel
                is="section"
                aria-label="Seconary Navigation"
                class="row-[span_1/-1]"
            >
                <BaseButton is="Link" :href="route('cp.dashboard.index')">
                    Settings
                </BaseButton>
            </BasePanel>
        </aside>

        <!-- --- Main --- -->

        <BasePanel class="[grid-area:main]" is="main">
            <slot />
        </BasePanel>

        <!-- --- Footer --- -->

        <BasePanel class="[grid-area:footer]" is="footer"> </BasePanel>
    </div>
</template>
