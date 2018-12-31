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
mix.js('resources/js/styles.js', 'public/js');
mix.copy('resources/js/jquery-3.3.1.min.js', 'public/js/jquery.js');
mix.styles([
        'resources/css/admin/bootstrap.min.css',
        'resources/css/admin/font-awesome.min.css',
        'resources/css/admin/ionicons.min.css',
        'resources/css/admin/jquery-jvectormap.css',
        'resources/css/admin/AdminLTE.min.css',
        'resources/css/admin/_all-skins.min.css',
        'resources/css/admin/elements.css'
    ], 'public/css/admin.css');
mix.scripts([
        'resources/js/admin/adminlte.min.js',
        'resources/js/admin/add-to-course.js'
    ], 'public/js/adminlte.min.js')
mix.copyDirectory('resources/fonts', 'public/fonts');
