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
                    50:  '#EEF7ED',
                    100: '#DEF0DB',
                    200: '#BCE0B8',
                    300: '#9BD194',
                    400: '#7AC270',
                    500: '#58B34D',
                    600: '#478F3D',
                    700: '#356B2E',
                    800: '#23471F',
                    900: '#12240F',
                    950: '#0C190B',
                    bg: '#F7F7EE',
                },

                grayscale: {
                    50: '#F3F2F2',
                    100: '#E7E6E4',
                    200: '#CECCCA',
                    300: '#B6B3AF',
                    400: '#9D9A95',
                    500: '#85817A',
                    600: ''
                },
 
                card: {
                    border: '#E8F5EE',
                    bg: '#F4F4EE',
                },
 
                danger: {
                    DEFAULT: '#EE4643',
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
                sans: ['Lato', 'ui-sans-serif', 'system-ui', 'sans-serif'],
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