<script setup>
import { nanoid } from "nanoid";

import slugify from "slugify";

const model = defineModel();

defineOptions({
    inheritAttrs: false,
});

const props = defineProps({
    label: {
        type: String,
        required: true,
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
    <label
        :for="id"
        class="inline-grid grid-cols-[auto_1fr] items-center gap-x-3 gap-y-1 cursor-pointer"
    >
        <span
            class="relative w-10 h-5 rounded-full outline outline-1 outline-offset-0 outline-slate-400 bg-slate-300 dark:outline-slate-500 dark:bg-slate-600 [&[data-error]]:outline-red-700 dark:[&[data-error]]:outline-red-300"
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
                class="absolute top-[0.125rem] left-[0.125rem] w-4 h-4 bg-red-600 dark:bg-red-400 rounded-full transition-[background-color,transform] peer-checked:translate-x-[calc(100%_+_4px)] peer-checked:bg-green-700 peer-checked:dark:bg-green-300"
            ></div>
        </span>

        <span class="select-none leading-none">{{ label }}</span>

        <div
            v-if="message"
            class="col-span-2 text-sm font-bold text-pretty mt-2 text-red-700 dark:text-red-300"
            data-error
        >
            {{ message }}
        </div>
    </label>
</template>
