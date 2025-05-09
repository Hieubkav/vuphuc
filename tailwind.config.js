/** @type {import('tailwindcss').Config} */
import preset from './vendor/filament/support/tailwind.config.preset'
export default {
    presets: [preset],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        'node_modules/preline/dist/*.js',
        "./node_modules/flowbite/**/*.js",
        '<path-to-vendor>/solution-forest/filament-tree/resources/**/*.blade.php',
    ],
    theme: {
        extend: {
            gridTemplateColumns: {
                'desktop': 'repeat(3, minmax(0, 1fr))',
                'tablet': 'repeat(2, minmax(0, 1fr))',
            },
            colors: {
                'furniture': {
                    light: '#ef4444',   // red-500
                    DEFAULT: '#dc2626', // red-600
                    dark: '#b91c1c',    // red-700
                },
                'gray': {
                    light: '#9ca3af',   // gray-400
                    DEFAULT: '#6b7280', // gray-500
                    dark: '#4b5563',    // gray-600
                }
            },
            fontFamily: {
                'heading': ['Montserrat', 'sans-serif']
            },
            textColor: theme => ({
                'heading': {
                    DEFAULT: theme('colors.gray.800')
                }
            }),
            keyframes: {
                slideIn: {
                    'from': { transform: 'translateX(-100%) scale(0.8)', opacity: '0', filter: 'blur(10px)' },
                    'to': { transform: 'translateX(0) scale(1)', opacity: '1', filter: 'blur(0)' }
                },
                slideInLeft: {
                    'from': {
                        transform: 'translateX(-100%) rotateY(-20deg)',
                        opacity: '0',
                        filter: 'blur(8px)'
                    },
                    'to': {
                        transform: 'translateX(0) rotateY(0)',
                        opacity: '1',
                        filter: 'blur(0)'
                    }
                },
                slideInRight: {
                    'from': {
                        transform: 'translateX(100%) rotateY(20deg)',
                        opacity: '0',
                        filter: 'blur(8px)'
                    },
                    'to': {
                        transform: 'translateX(0) rotateY(0)',
                        opacity: '1',
                        filter: 'blur(0)'
                    }
                },
                mergeLeft: {
                    'from': { transform: 'translateX(0)' },
                    '50%': { transform: 'translateX(-10%) scale(0.95)' },
                    'to': { transform: 'translateX(25%) scale(1)' }
                },
                mergeLeftMobile: {
                    'from': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10%) scale(0.95)' },
                    'to': { transform: 'translateY(25%) scale(1)', opacity: '0.5' }
                },
                mergeRight: {
                    'from': { transform: 'translateX(0)' },
                    '50%': { transform: 'translateX(10%) scale(0.95)' },
                    'to': { transform: 'translateX(-25%) scale(1)' }
                },
                mergeRightMobile: {
                    'from': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10%) scale(0.95)' },
                    'to': { transform: 'translateY(25%) scale(1)', opacity: '1' }
                },
                bounceIn: {
                    '0%': {
                        transform: 'translate(-50%, 100%) scale(0.8)',
                        opacity: '0',
                        filter: 'blur(8px)'
                    },
                    '60%': {
                        transform: 'translate(-50%, -20%) scale(1.1)',
                        opacity: '0.8',
                        filter: 'blur(4px)'
                    },
                    '80%': {
                        transform: 'translate(-50%, 10%) scale(0.95)',
                        opacity: '0.9',
                        filter: 'blur(2px)'
                    },
                    '100%': {
                        transform: 'translate(-50%, 0) scale(1)',
                        opacity: '1',
                        filter: 'blur(0)'
                    }
                }
            },
            animation: {
                'logo-slide': 'slideIn 1.5s cubic-bezier(0.4, 0, 0.2, 1) forwards',
                'slide-left': 'slideInLeft 1.2s cubic-bezier(0.4, 0, 0.2, 1) 1.5s forwards',
                'slide-right': 'slideInRight 1.2s cubic-bezier(0.4, 0, 0.2, 1) 2s forwards',
                'merge-left': 'mergeLeft 1.5s cubic-bezier(0.4, 0, 0.2, 1) 3s forwards',
                'merge-right': 'mergeRight 1.5s cubic-bezier(0.4, 0, 0.2, 1) 3s forwards',
                'bounce-in': 'bounceIn 1s cubic-bezier(0.4, 0, 0.2, 1) 4s forwards'
            }
        },
    },
    plugins: [
        require('preline/plugin'),
        require('flowbite/plugin')
    ],
    darkMode: 'class',
}
