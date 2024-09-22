<script setup>
import { nanoid } from "nanoid";

import slugify from "slugify";

const model = defineModel();

defineOptions({
    inheritAttrs: false,
});

const props = defineProps({
    label: String,
    type: {
        type: String,
        default: "text",
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
    <label v-if="label" :for="id" class="mb-2 inline-block">
        {{ label }}
    </label>

    <input
        :id="id"
        :type="type"
        :name="name"
        class="w-full rounded outline outline-1 outline-offset-0 outline-slate-400 bg-slate-300 px-3 py-2 dark:outline-slate-500 dark:bg-slate-600 focus:outline-sky-500 focus:outline-2 transition-colors [&[data-error]]:outline-red-700 dark:[&[data-error]]:outline-red-300"
        v-model="model"
        v-bind="$attrs"
        :data-error="message || error ? true : null"
    />

    <div
        v-if="message"
        class="text-sm font-bold text-pretty mt-2 text-red-700 dark:text-red-300"
        data-error
    >
        {{ message }}
    </div>
</template>
