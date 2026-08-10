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
                display: ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                sans: ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'panas-primary': '#f8fafc', // slate-50
                'panas-cream': '#f1f5f9',   // slate-100
                'panas-light': '#ffffff',   // white
                'panas-ember': '#fb923c',   // orange-400
                'panas-ember-dark': '#f97316', // orange-500
                'panas-dark': '#0f172a',    // slate-900
                'panas-border': '#e2e8f0',  // slate-200
            },
            boxShadow: {
                'panas-sm': '0 1px 2px 0 rgba(15, 23, 42, 0.05)',
                'panas-card': '0 4px 20px -2px rgba(15, 23, 42, 0.08)',
                'panas-lift': '0 20px 40px -12px rgba(15, 23, 42, 0.15)',
                'panas-glow': '0 8px 24px -6px rgba(249, 115, 22, 0.25)',
            },
        },
    },

    plugins: [forms],
};