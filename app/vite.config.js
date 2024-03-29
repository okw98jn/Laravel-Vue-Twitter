import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/ts/main.ts','resources/ts/index.css'],
            refresh: true,
        }),
        vue({
            script: {
                defineModel: true
            },
        })
    ],
    resolve: {
        alias: {
            '@': '/resources/ts',
        },
    },
    server: {
        host: true,
        hmr: {
            host: 'localhost'
        },
    },
});
