import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Theme Css
                'resources/scss/app.scss',
                'resources/scss/icons.scss',

                // Theme Js
                'resources/js/config.js',
                'resources/js/app.js',

            ],
            refresh: true
        }),
    ],
});