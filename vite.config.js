import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/Admin/create.css',
                'resources/css/Admin/edit.css',
                'resources/css/Admin/index.css',
                'resources/css/Admin/manage.css',
                'resources/css/Admin/login/login.css',
                'resources/css/Admin/login/register.css',
                'resources/css/captains/form.css',
                'resources/css/captains/manage.css',
                'resources/css/workout/index.css',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
