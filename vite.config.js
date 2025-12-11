import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/quiz.css',
                'resources/js/quiz.js',
                'resources/css/homepage.css',
                'resources/css/navbar.css',
                'resources/css/fonts.css',
                'resources/css/guides.css'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
