<script setup lang="ts">
import {
    StyleModeName,
    type StyleMode,
    type StyleModes,
} from "@control-panel/js/definitions";

interface Props {
    is?: String;
    mode?: StyleMode | "skeleton";
}

const { is = "div", mode = "skeleton" } = defineProps<Props>();

const modes: StyleModes & { skeleton: string } = {
    skeleton: "bg-neutral-200 dark:bg-neutral-800",
    white: "text-black-100 bg-white-100 border-neutral-300",
    black: "text-white-100 bg-black-100 border-neutral-700",
    mono: "text-white-100 bg-black-100 border-neutral-700 dark:text-black-100 dark:bg-white-100 dark:border-neutral-300",
    primary: "bg-primary-700 border-primary-500 dark:bg-primary-300",
    neutral: "bg-neutral-700 border-neutral-500 dark:bg-neutral-300",
    accent: "bg-accent-700 border-accent-500 dark:bg-accent-300",
    actionPrimary:
        "bg-action-primary-700 border-action-primary-500 dark:bg-action-primary-300",
    actionSecondary:
        "bg-action-secondary-700 border-action-secondary-500 dark:bg-action-secondary-300",
    impartial: "bg-impartial-700 border-impartial-500 dark:bg-impartial-300",
    info: "bg-info-700 border-info-500 dark:bg-info-300",
    success: "bg-success-700 border-success-500 dark:bg-success-300",
    warning: "bg-warning-700 border-warning-500 dark:bg-warning-300",
    alert: "bg-alert-700 border-alert-500 dark:bg-alert-300",
};
</script>

<template>
    <component
        :is="is"
        class="p-3 rounded-lg shadow"
        :class="{
            'text-white-100 dark:text-black-100':
                mode != 'skeleton' &&
                mode != StyleModeName.white &&
                mode != StyleModeName.black &&
                mode != StyleModeName.mono,
            border: mode != 'skeleton',
            [modes.skeleton]: mode == 'skeleton',
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
    </component>
</template>
