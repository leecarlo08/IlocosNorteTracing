const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js/in-tourist.js')
    .js('resources/js/spot/spot.js', 'public/js/in-spot.js')
    .js('resources/js/admin/admin.js', 'public/js/admin.js')
    .sass('resources/sass/main.scss', 'public/css/main.css')
    .sass('resources/sass/app.scss', 'public/css/admin.css').version();
