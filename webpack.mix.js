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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'public/css/files/index.css',
    'public/css/files/list.css',
    'public/css/files/material.css',
    'public/css/files/product.css',
    'public/css/files/product.css',
    'public/css/files/styles.css',
    'public/css/files/shopping-cart.css'
], 'public/css/all.css');