<script setup lang="ts">
import { ref } from "vue";
import type { StyleMode } from "@control-panel/js/types";

import BaseButton from "@control-panel/views/Components/BaseButton.vue";

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

const handleClick = () => {
    const controledElement = document.querySelector(`#${controls}`);

    controledElement.toggleAttribute("hidden");

    ariaExpanded.value = controledElement.getAttribute("hidden") === null;

    //document.addEventListener("click", () => {});
};
</script>

<template>
    <component
        :is="is"
        :mode="is == BaseButton ? mode : undefined"
        :aria-expanded="ariaExpanded"
        :aria-controls="controls"
        @click.prevent="handleClick"
    >
        <slot />
    </component>
</template>
