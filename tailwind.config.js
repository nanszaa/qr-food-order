/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    50:  '#F0F7F4',
                    100: '#D8F3DC',
                    200: '#B7E4C7',
                    300: '#95D5B2',
                    400: '#52B788',
                    500: '#40916C',
                    600: '#2D6A4F',
                    700: '#1B4332',
                    800: '#122B22',
                    900: '#081C15',
                },
 
                card: {
                    border: '#E8F5EE',
                },
 
                danger: {
                    DEFAULT: '#E63946',
                    dark:    '#B71C2A',
                },
 
                neutral: {
                    hint:    '#9CA3AF',
                    muted:   '#6B7280',
                    body:    '#374151',
                    heading: '#1B1B1B',
                },
            },
 
            borderRadius: {
                'pill': '9999px',
            },
 
            boxShadow: {
                'card':       '0 1px 4px 0 rgba(27, 67, 50, 0.08)',
                'card-hover': '0 4px 16px 0 rgba(27, 67, 50, 0.14)',
                'header':     '0 4px 24px 0 rgba(27, 67, 50, 0.25)',
            },
 
            fontFamily: {
                sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
 
            backgroundImage: {
                'brand-gradient': 'linear-gradient(135deg, #1B4332 0%, #2D6A4F 100%)',
            },
        },
    },
    plugins: [
        require('tailwind-scrollbar-hide'),
    ],
}