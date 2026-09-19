import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                blush: {
                    50:  '#FEF6F8',
                    100: '#FDE9EE',
                    200: '#FBD3DC',
                    300: '#F6AFC0',
                    400: '#EF7E9B',
                    500: '#E8547C',
                    600: '#D33A66',
                    700: '#AF2B52',
                    800: '#8D2544',
                    900: '#73223B',
                },
                cream: '#FAF4EF',
                linen: '#F5EDE6',
                forest: '#22403D',
                ink: '#1C1A1B',
            },
            fontFamily: {
                sans:   ['Poppins', ...defaultTheme.fontFamily.sans],
                serif:  ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
                script: ['Caveat', 'cursive'],
            },
            boxShadow: {
                card: '0 10px 30px -18px rgba(116, 34, 59, 0.35)',
                soft: '0 2px 12px -6px rgba(28, 26, 27, 0.18)',
            },
            borderRadius: {
                '4xl': '2rem',
            },
        },
    },
    plugins: [forms, typography],
};