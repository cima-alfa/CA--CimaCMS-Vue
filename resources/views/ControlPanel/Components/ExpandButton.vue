<script setup lang="ts">
import { ref } from "vue";
import type { StyleMode } from "@control-panel/js/types";

import BaseButton from "@control-panel/views/Components/BaseButton.vue";
import eventListener from "@app/js/events";

interface Props {
    is?: "button" | typeof BaseButton;
    mode?: StyleMode;
    controls: String;
    expanded?: Boolean;
}

const {
    is = "button",
    mode = "action-primary",
    controls,
    expanded = false,
} = defineProps<Props>();

const ariaExpanded = ref(expanded);

const handleClick = (event: MouseEvent) => {
    const button = (event.target as HTMLElement).closest(
        "[data-expand-button]"
    );

    eventListener.remove(
        document,
        `click.expandButtonTargetHandler.${controls}`
    );

    const controlledElement = document.querySelector(`#${controls}`);

    const toggleControlledElement = () => {
        controlledElement.toggleAttribute("hidden");

        ariaExpanded.value = controlledElement.getAttribute("hidden") === null;
    };

    toggleControlledElement();

    if (ariaExpanded.value === false) {
        return;
    }

    eventListener.add(
        document,
        `click.expandButtonTargetHandler.${controls}`,
        (event: MouseEvent) => {
            event.preventDefault();

            if (
                (event.target as HTMLElement).parentElement.closest(
                    `#${controls}`
                ) === controlledElement ||
                (event.target as HTMLElement).closest(
                    "[data-expand-button]"
                ) === button
            ) {
                return;
            }

            toggleControlledElement();

            eventListener.remove(
                document,
                `click.expandButtonTargetHandler.${controls}`
            );
        }
    );
};
</script>

<template>
    <component
        :is="is"
        :mode="is == BaseButton ? mode : undefined"
        :aria-expanded="ariaExpanded"
        :aria-controls="controls"
        @click.prevent="handleClick"
        data-expand-button
    >
        <slot />
    </component>
</template>
