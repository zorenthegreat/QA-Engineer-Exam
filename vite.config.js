import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',

                'resources/js/app.js',
                
                'resources/js/plugins/jquery/jquery.min.js',
                'resources/js/dist/js/adminlte.js'
            ],
            refresh: true,
        }),
    ],
});
