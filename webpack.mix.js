let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')

   .styles([
            'resources/assets/css/admincss/bootstrap.min.css',
            'resources/assets/css/admincss/dashboard.css'
          ], 'public/css/dashboard.css')

    .scripts([
              'resources/assets/js/adminjs/jquery-3.2.1.min.js',
              'resources/assets/js/adminjs/bootstrap.min.js',
              'resources/assets/js/adminjs/material.min.js',
              'resources/assets/js/adminjs/bootstrap-notify.js',
              'resources/assets/js/adminjs/material-dashboard.js',
              'resources/assets/js/adminjs/chartist.min.js',
          ], 'public/js/dashboard.js');
