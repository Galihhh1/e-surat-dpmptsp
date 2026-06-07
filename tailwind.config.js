import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                dark: {
                    900: '#0f172a',
                    800: '#1e293b',
                    700: '#334155',
                    600: '#475569',
                },
                brand: {
                    teal: '#14b8a6',
                    purple: '#8b5cf6',
                    pink: '#ec4899',
                    cyan: '#06b6d4',
                },
            },
            backgroundImage: {
                'gradient-dark': 'linear-gradient(135deg, #1e293b 0%, #0f172a 100%)',
                'gradient-teal': 'linear-gradient(135deg, #14b8a6 0%, #06b6d4 100%)',
                'gradient-purple': 'linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%)',
            },
            boxShadow: {
                'glow-teal': '0 0 20px rgba(20, 184, 166, 0.3)',
                'glow-purple': '0 0 20px rgba(139, 92, 246, 0.3)',
                'glass': '0 8px 32px rgba(0, 0, 0, 0.4)',
            },
        },
    },

    plugins: [forms],
};
