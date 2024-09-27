import globals from "globals";
import pluginJs from "@eslint/js";
import pluginVue from "eslint-plugin-vue";

export default [
    {
        files: ["**/*.{js,mjs,cjs,vue}"],
    },
    {
        languageOptions: {
            globals: {
                ...globals.browser,
                route: "writable",
                FrontMainLayout: "writable",
            },
        },
    },
    pluginJs.configs.recommended,
    ...pluginVue.configs["vue3-essential"],
    {
        files: ["**/views/**/Pages/**/*.vue", "**/views/**/Layouts/**/*.vue"],
        rules: {
            "vue/multi-word-component-names": "off",
        },
    },
];
