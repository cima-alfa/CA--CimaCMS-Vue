<script setup lang="ts">
import {
    StyleModeName,
    type StyleMode,
    type StyleModes,
} from "@control-panel/js/types";

interface Props {
    mode?: StyleMode;
}

const { mode = "info" } = defineProps<Props>();

const modes: StyleModes = {
    white: "text-black-100 bg-white-300 border-white-100",
    black: "text-white-100 bg-black-300 border-black-100",
    mono: "text-white-100 bg-black-300 border-black-100 dark:text-black-100 dark:bg-white-300 dark:border-white-100",
    primary:
        "border-primary-400 bg-primary-700 text-primary-50 dark:border-primary-300 dark:bg-primary-50 dark:text-primary-950",
    neutral:
        "border-neutral-400 bg-neutral-700 text-neutral-50 dark:border-neutral-300 dark:bg-neutral-50 dark:text-neutral-950",
    accent: "border-accent-400 bg-accent-700 text-accent-50 dark:border-accent-300 dark:bg-accent-50 dark:text-accent-950",
    actionPrimary:
        "border-action-primary-400 bg-action-primary-700 text-action-primary-50 dark:border-action-primary-300 dark:bg-action-primary-50 dark:text-action-primary-950",
    actionSecondary:
        "border-action-secondary-400 bg-action-secondary-700 text-action-secondary-50 dark:border-action-secondary-300 dark:bg-action-secondary-50 dark:text-action-secondary-950",
    impartial:
        "border-impartial-400 bg-impartial-700 text-impartial-50 dark:border-impartial-300 dark:bg-impartial-50 dark:text-impartial-950",
    info: "border-info-400 bg-info-700 text-info-50 dark:border-info-300 dark:bg-info-50 dark:text-info-950",
    success:
        "border-success-400 bg-success-700 text-success-50 dark:border-success-300 dark:bg-success-50 dark:text-success-950",
    warning:
        "border-warning-400 bg-warning-700 text-warning-50 dark:border-warning-300 dark:bg-warning-50 dark:text-warning-950",
    alert: "border-alert-400 bg-alert-700 text-alert-50 dark:border-alert-300 dark:bg-alert-50 dark:text-alert-950",
};
</script>

<template>
    <div
        class="border rounded px-3 py-[6px] shadow-[inset_0_0_2px_1px_hsl(0,0%,0%,0.2)]"
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
    </div>
</template>
