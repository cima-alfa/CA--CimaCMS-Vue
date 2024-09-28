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
            white: {
                100: colors.neutral["100"],
                200: colors.neutral["200"],
                300: colors.neutral["300"],
            },
            black: {
                100: colors.neutral["950"],
                200: colors.neutral["900"],
                300: colors.neutral["800"],
            },
            primary: colors.sky,
            neutral: colors.stone,
            accent: colors.orange,
            "action-primary": colors.indigo,
            "action-secondary": colors.emerald,
            impartial: colors.neutral,
            info: colors.blue,
            success: colors.green,
            warning: colors.amber,
            alert: colors.red,
        },
    },
    plugins: [],
};
