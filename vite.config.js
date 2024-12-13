import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss', // Mudança aqui para o arquivo SCSS
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
