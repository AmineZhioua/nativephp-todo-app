import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { nativephpMobile, nativephpHotFile } from './vendor/nativephp/mobile/resources/js/vite-plugin.js'; 
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            hotFile: nativephpHotFile(), 
        }),
        tailwindcss(),
        nativephpMobile(), 
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js'
        }
    }
});
