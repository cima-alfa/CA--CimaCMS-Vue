<script setup lang="ts">
import {
    StyleModeName,
    type StyleMode,
    type StyleModes,
} from "@control-panel/js/definitions";

interface Props {
    href: String;
    mode?: StyleMode;
}

const { href, mode = "action-primary" } = defineProps<Props>();

const modes: StyleModes = {
    white: "text-white-100",
    black: "text-black-100",
    mono: "text-black-100 dark:text-white-100",
    primary: "text-primary-800 dark:text-primary-200",
    neutral: "text-neutral-800 dark:text-neutral-200",
    accent: "text-accent-800 dark:text-accent-200",
    actionPrimary: "text-action-primary-800 dark:text-action-primary-200",
    actionSecondary: "text-action-secondary-800 dark:text-action-secondary-200",
    impartial: "text-impartial-800 dark:text-impartial-200",
    info: "text-info-800 dark:text-info-200",
    success: "text-success-800 dark:text-success-200",
    warning: "text-warning-800 dark:text-warning-200",
    alert: "text-alert-800 dark:text-alert-200",
};
</script>

<template>
    <Link
        :href="href"
        class="hover:underline"
        :class="{
            [modes.white]: mode == StyleModeName.white,
            [modes.black]: mode == StyleModeName.black,
            [modes.mono]: mode == StyleModeName.mono,
            [modes.primary]: mode == StyleModeName.primary,
            [modes.neutral]: mode == StyleModeName.neutral,
            [modes.accent]: mode == StyleModeName.accent,
            [modes.actionPrimary]: mode == StyleModeName.actionPrimary,
            [modes.actionSecondary]: mode == StyleModeName.actionSecondary,
            [modes.impartial]: mode == StyleModeName.impartial,
            [modes.info]: mode == StyleModeName.info,
            [modes.success]: mode == StyleModeName.success,
            [modes.warning]: mode == StyleModeName.warning,
            [modes.alert]: mode == StyleModeName.alert,
        }"
    >
        <slot />
    </Link>
</template>
