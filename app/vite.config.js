import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/ts/main.ts'],
            refresh: true,
        }),
        vue({
            script: {
                defineModel: true
            }
        })
    ],
    server: {
        host: true,
        hmr: {
            host: 'localhost'
        },
    },
});
