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
                'node_modules/glightbox/dist/css/glightbox.min.css',
                'node_modules/plyr/dist/plyr.css',
                'node_modules/nouislider/dist/nouislider.min.css',
                'node_modules/sweetalert2/dist/sweetalert2.min.css',
                'node_modules/swiper/swiper-bundle.min.css',
                'node_modules/tippy.js/dist/tippy.css',
                'node_modules/shepherd.js/dist/css/shepherd.css',
                'node_modules/quill/dist/quill.core.css',
                'node_modules/quill/dist/quill.bubble.css',
                'node_modules/quill/dist/quill.snow.css',
                'node_modules/dropzone/dist/min/dropzone.min.css',
                'node_modules/flatpickr/dist/flatpickr.min.css',
                'node_modules/@simonwep/pickr/dist/themes/classic.min.css',
                'node_modules/@simonwep/pickr/dist/themes/monolith.min.css',
                'node_modules/@simonwep/pickr/dist/themes/nano.min.css',
                'node_modules/nouislider/dist/nouislider.min.css',
                'node_modules/nice-select2/dist/css/nice-select2.css',
                'node_modules/glightbox/dist/css/glightbox.min.css',
                'node_modules/gridjs/dist/theme/mermaid.min.css',
                'node_modules/dropzone/dist/min/dropzone.min.js',

                // Theme Js
                'resources/js/config.js',
                'resources/js/app.js',
                'resources/js/head.js',

            ],
            refresh: true
        }),
    ],
});