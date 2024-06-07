import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    //themeVariants({
      //themes: {
        //light: {
          //mediaQuery: prefersLight /* "@media (prefers-color-scheme: light)" */,
        //},
        //dark: {
         // mediaQuery: prefersDark /* "@media (prefers-color-scheme: dark)" */,
        //},
      //},
    //}),

    plugins: [
        forms,
      ],
};