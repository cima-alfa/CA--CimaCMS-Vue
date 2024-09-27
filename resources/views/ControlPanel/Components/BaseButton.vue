<script setup lang="ts">
interface Props {
    is?: String;
    mode?:
        | "primary"
        | "neutral"
        | "accent"
        | "action-primary"
        | "action-secondary"
        | "impartial"
        | "info"
        | "success"
        | "warning"
        | "alert";
}

const { is = "button", mode = "action-primary" } = defineProps<Props>();

const modes = {
    primary:
        "bg-action-primary-600 hover:bg-action-primary-700 focus:bg-action-primary-700 active:bg-action-primary-800 dark:bg-action-primary-400 dark:hover:bg-action-primary-300 dark:focus:bg-action-primary-300 dark:active:bg-action-primary-200",
    neutral:
        "bg-primary-600 hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-800 dark:bg-primary-400 dark:hover:bg-primary-300 dark:focus:bg-primary-300 dark:active:bg-primary-200",
    accent: "bg-neutral-600 hover:bg-neutral-700 focus:bg-neutral-700 active:bg-neutral-800 dark:bg-neutral-400 dark:hover:bg-neutral-300 dark:focus:bg-neutral-300 dark:active:bg-neutral-200",
    actionPrimary:
        "bg-accent-600 hover:bg-accent-700 focus:bg-accent-700 active:bg-accent-800 dark:bg-accent-400 dark:hover:bg-accent-300 dark:focus:bg-accent-300 dark:active:bg-accent-200",
    actionSecondary:
        "bg-action-secondary-600 hover:bg-action-secondary-700 focus:bg-action-secondary-700 active:bg-action-secondary-800 dark:bg-action-secondary-400 dark:hover:bg-action-secondary-300 dark:focus:bg-action-secondary-300 dark:active:bg-action-secondary-200",
    impartial:
        "bg-impartial-600 hover:bg-impartial-700 focus:bg-impartial-700 active:bg-impartial-800 dark:bg-impartial-400 dark:hover:bg-impartial-300 dark:focus:bg-impartial-300 dark:active:bg-impartial-200",
    info: "bg-info-600 hover:bg-info-700 focus:bg-info-700 active:bg-info-800 dark:bg-info-400 dark:hover:bg-info-300 dark:focus:bg-info-300 dark:active:bg-info-200",
    success:
        "bg-success-600 hover:bg-success-700 focus:bg-success-700 active:bg-success-800 dark:bg-success-400 dark:hover:bg-success-300 dark:focus:bg-success-300 dark:active:bg-success-200",
    warning:
        "bg-warning-600 hover:bg-warning-700 focus:bg-warning-700 active:bg-warning-800 dark:bg-warning-400 dark:hover:bg-warning-300 dark:focus:bg-warning-300 dark:active:bg-warning-200",
    alert: "bg-alert-600 hover:bg-alert-700 focus:bg-alert-700 active:bg-alert-800 dark:bg-alert-400 dark:hover:bg-alert-300 dark:focus:bg-alert-300 dark:active:bg-alert-200",
};
</script>

<template>
    <component
        :is="is"
        class="block w-full p-3 rounded transition-colors cursor-pointer text-lg text-center font-bold text-neutral-50 disabled:bg-impartial-500 disabled:cursor-not-allowed dark:text-neutral-950"
        :class="{
            [modes.primary]: mode == 'primary',
            [modes.neutral]: mode == 'neutral',
            [modes.accent]: mode == 'accent',
            [modes.actionPrimary]: mode == 'action-primary',
            [modes.actionSecondary]: mode == 'action-secondary',
            [modes.impartial]: mode == 'impartial',
            [modes.info]: mode == 'info',
            [modes.success]: mode == 'success',
            [modes.warning]: mode == 'warning',
            [modes.alert]: mode == 'alert',
        }"
        :href="$attrs.href"
    >
        <slot />
    </component>
</template>
