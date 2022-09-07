import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin';
import Pages from 'vite-plugin-pages'

export default defineConfig({
    plugins: [
        vue(),
        ,
    Pages({
      dirs: [{ dir: 'resources/src/pages', baseRoute: '' }]
    }),

        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
