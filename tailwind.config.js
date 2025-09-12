import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './index.html', // Tambahkan jika file HTML ada
        './src/**/*.{js,ts,jsx,tsx}', // Tambahkan jika proyek melibatkan file JS/React/Vue
    ],

    darkMode: "class", // Tambahkan dark mode jika diperlukan

    theme: {
        extend: {
            container: {
                center: true, // Centered container
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans], // Prioritas Laravel
                Oswald: ["Oswald", "sans-serif"],
                Inter: ["Inter"],
                Poppins: ["Poppins"],
            },
            backgroundImage: {
                heroLight: "url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')",
                heroDark: "url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')",
            },
            colors: {
                primary: "#b033fd",
            },
        },
    },

    plugins: [forms], // Tetap gunakan plugin forms
};
