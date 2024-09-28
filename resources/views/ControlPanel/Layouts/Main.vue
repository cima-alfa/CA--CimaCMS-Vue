<script setup lang="ts">
import LogoLink from "@control-panel/views/Components/LogoLink.vue";
import BasePanel from "@control-panel/views/Components/BasePanel.vue";
import BaseButton from "@control-panel/views/Components/BaseButton.vue";
import ExpandButton from "@control-panel/views/Components/ExpandButton.vue";
</script>

<template>
    <div
        class="w-full h-dvh px-3 grid gap-3 lg:[grid-template-areas:'aside_header''aside_main''aside_footer'] lg:grid-cols-[auto_1fr] lg:grid-rows-[auto_1fr_auto]"
    >
        <!-- --- Aside --- -->

        <aside class="[grid-area:aside] relative lg:w-72">
            <div
                class="lg:sticky lg:top-0 lg:left-0 lg:h-dvh lg:py-3 lg:grid lg:gap-3 lg:grid-rows-[auto_auto_1fr_auto]"
            >
                <!-- --- Aside Header --- -->

                <BasePanel class="grid place-content-center lg:h-[8.75rem]">
                    <LogoLink />
                </BasePanel>

                <!-- --- Aside Primary Navigation --- -->

                <BasePanel is="section" aria-label="Primary Navigation">
                    <div class="grid h-96 place-content-center">Nav</div>
                </BasePanel>

                <!-- Filler -->
                <BasePanel class="opacity-65" />

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
            </div>
        </aside>

        <!-- --- Header --- -->

        <BasePanel class="[grid-area:header] lg:h-16 mt-3" is="header">
            <nav class="flex h-full justify-between items-center">
                <span>Breadcrumbs > ... > ...</span>

                <div class="relative h-full select-none">
                    <ExpandButton
                        class="flex gap-3 items-center h-full"
                        aria-label="User Panel"
                        controls="header-user-panel"
                    >
                        <span
                            class="text-sm font-bold text-neutral-800 dark:text-neutral-200 pointer-events-auto"
                        >
                            John Doe
                        </span>
                        <span
                            class="grid place-content-center h-full aspect-square rounded-full bg-impartial-700 dark:bg-impartial-300 border-2 border-impartial-500 text-sm font-bold text-neutral-200 dark:text-neutral-800 pointer-events-auto"
                        >
                            JD
                        </span>
                    </ExpandButton>

                    <div
                        id="header-user-panel"
                        class="absolute top-full right-0 min-w-full pt-3 grid gap-5"
                        hidden
                    >
                        <BasePanel class="text-nowrap" mode="primary">
                            test as das a as asda
                        </BasePanel>
                    </div>
                </div>
                <!-- <ul class="flex gap-5">
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
                </ul> -->
            </nav>
        </BasePanel>

        <!-- --- Main --- -->

        <BasePanel class="[grid-area:main]" is="main">
            <slot />
        </BasePanel>

        <!-- --- Footer --- -->

        <BasePanel class="[grid-area:footer] lg:mb-3" is="footer">
            Footer
        </BasePanel>
    </div>
</template>
