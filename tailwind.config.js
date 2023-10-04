/** @type {import('tailwindcss').Config} */
export default {
    daisyui: {
        themes: ["light", "dark"],
    },
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                serif: ["Inter", "system-ui", "serif"],
                sans: ["Quicksand", "quicksand", "sans-serif"],
            },
        },
    },
    plugins: [require("daisyui")],
};
