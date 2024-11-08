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

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         require('tailwindcss'),
        
//     ])
//     .postCss('resources/css/login.css', 'public/css');

let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       tailwindcss('./tailwind.config.js'),
   ])
   .postCss('resources/css/login.css', 'public/css', [
       tailwindcss('./tailwind.config.js'),
   ]);
