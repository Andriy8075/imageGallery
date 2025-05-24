import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/images/main.js',
                'resources/js/comments/addCommentsAuth.js',
                'resources/js/comments/addCommentsGuest.js',
                'resources/js/comments/loadComments.js'
            ],
            refresh: true,
        }),
    ],
});
