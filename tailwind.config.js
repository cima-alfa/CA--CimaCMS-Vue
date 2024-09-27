/** @type {import('tailwindcss').Config} */

import colors from "tailwindcss/colors";

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
        colors: {
            primary: colors.emerald,
            neutral: colors.stone,
            accent: colors.orange,
            "action-primary": colors.cyan,
            "action-secondary": colors.purple,
            impartial: colors.neutral,
            info: colors.sky,
            success: colors.lime,
            warning: colors.amber,
            alert: colors.red,
        },
    },
    plugins: [],
};
