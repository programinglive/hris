import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Theme Css
                'resources/scss/app.scss',
                'resources/scss/icons.scss',
                'node_modules/animate.css/animate.min.css',
                'node_modules/animate.css/animate.compat.css',
                'node_modules/swiper/swiper-bundle.min.css',
                'node_modules/@simonwep/pickr/dist/themes/classic.min.css',
                'node_modules/@simonwep/pickr/dist/themes/monolith.min.css',
                'node_modules/@simonwep/pickr/dist/themes/nano.min.css',

                // Theme Js
                'resources/js/config.js',
                'resources/js/app.js',
                'resources/js/head.js',

            ],
            refresh: true
        }),
    ],
});