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
                'node_modules/jsvectormap/dist/css/jsvectormap.min.css',
                'node_modules/glightbox/dist/css/glightbox.min.css',
                'node_modules/gridjs/dist/theme/mermaid.min.css',
                // 'node_modules/dropzone/dist/min/dropzone.min.js',
                'node_modules/dropzone/dist/min/dropzone.min.js',

                // Theme Js
                'resources/js/config.js',
                'resources/js/app.js',
                'resources/js/head.js',

                'resources/js/pages/dashboard.js',
                'resources/js/pages/apps-calendar.js',
                'resources/js/pages/apps-kanban.js',
                'resources/js/pages/extended-animation.js',
                'resources/js/pages/extended-sortable.js',
                'resources/js/pages/extended-plyr.js',
                'resources/js/pages/extended-sweetalert.js',
                'resources/js/pages/extended-swiper.js',
                'resources/js/pages/extended-tippy.js',
                'resources/js/pages/extended-tour.js',
                'resources/js/pages/form-inputmask.js',
                'resources/js/pages/form-fileupload.js',
                'resources/js/pages/form-flatpickr.js',
                'resources/js/pages/extended-ratings.js',
                'resources/js/pages/form-editor.js',
                'resources/js/pages/extended-lightbox.js',
                'resources/js/pages/form-color-pickr.js',
                'resources/js/pages/form-rangeslider.js',
                'resources/js/pages/form-select.js',
                'resources/js/pages/form-validation.js',
                'resources/js/pages/icons-material-symbols.js',
                'resources/js/pages/icons-mingcute.js',
                'resources/js/pages/maps-google.js',
                'resources/js/pages/maps-vector.js',
                'resources/js/pages/gallery.js',
                'resources/js/pages/table-gridjs.js',
                'resources/js/pages/charts-apex.js',

                // Code Highlight Js
                'resources/js/pages/highlight.js',
            ],
            refresh: true
        }),
    ],
});
