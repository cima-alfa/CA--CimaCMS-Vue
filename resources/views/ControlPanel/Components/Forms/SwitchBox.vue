<script setup lang="ts">
import { nanoid } from "nanoid";

import slugify from "slugify";

const model = defineModel();

defineOptions({
    inheritAttrs: false,
});

const props = defineProps({
    label: {
        type: String,
        requialert: true,
    },
    message: String,
    error: Boolean,
});

const name = slugify(props.label ?? "", {
    lower: true,
    strict: true,
});

const id = nanoid(10) + "-" + name;
</script>

<template>
    <div
        class="inline-grid grid-cols-[auto_1fr] items-center gap-x-3 gap-y-1 cursor-pointer"
    >
        <span
            class="relative w-10 h-5 rounded-full outline outline-1 outline-offset-0 outline-neutral-400 bg-neutral-300 dark:outline-neutral-500 dark:bg-neutral-600 focus-within:outline-action-primary-600 focus-within:outline-2 dark:focus-within:outline-action-primary-400 [&[data-error]]:outline-2 [&[data-error]]:outline-alert-700 dark:[&[data-error]]:outline-alert-300"
            :data-error="message || error ? true : null"
        >
            <input
                :id="id"
                type="checkbox"
                :name="name"
                v-model="model"
                v-bind="$attrs"
                class="peer appearance-none sr-only"
            />
            <div
                class="absolute top-[0.125rem] left-[0.125rem] w-4 h-4 bg-alert-600 dark:bg-alert-400 rounded-full transition-[background-color,transform] peer-checked:translate-x-[calc(100%_+_4px)] peer-checked:bg-success-700 peer-checked:dark:bg-success-300"
            ></div>
        </span>

        <label :for="id" class="select-none leading-none">{{ label }}</label>

        <div
            v-if="message"
            class="col-span-2 text-sm font-bold text-pretty mt-2 text-alert-700 dark:text-alert-300"
            data-error
        >
            {{ message }}
        </div>
    </div>
</template>
