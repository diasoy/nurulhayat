import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: "#563B14",
                    light: "#7A5520",
                    dark: "#3F2B0E",
                },
                secondary: {
                    DEFAULT: "#FFB627",
                    light: "#FFC655",
                    dark: "#E69F00",
                },
            },
        },
    },

    plugins: [forms],
};
