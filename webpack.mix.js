const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.styles([
    'resources/css/main.css',
    'resources/css/app.min.css',
    'resources/css/components.css',
    'resources/css/custom.css',
    'resources/css/style.css',
    'resources/css/app.css',
    'resources/css/add-styles.css',
    'resources/js/bundles/pretty-checkbox/pretty-checkbox.min.css',
    'resources/js/bundles/izitoast/css/iziToast.min.css'
], 'public/css/app.css')

.scripts([
    'resources/js/theme/app.min.js',
    'resources/js/theme/custom.js',
    'resources/js/theme/scripts.js',
    'resources/js/bundles/izitoast/js/iziToast.min.js',
    'resources/js/theme/toastr.js'
], 'public/js/app.js')

.copy('resources/fonts', 'public/fonts')

mix.disableNotifications();
