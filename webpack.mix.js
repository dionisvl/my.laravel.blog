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

mix
    .copy('packages/chat/src/resources/views/js/main.js', 'public/packages/chat/js')
mix
    .postCss('packages/chat/src/resources/views/css/main.css', 'public/packages/chat/css')
    .options({
        processCssUrls: false
    });

// if (mix.inProduction()) {
mix.version();
// }
