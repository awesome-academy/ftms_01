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
    'resources/js/admin/add-to-course.js',
    'resources/js/admin/add_suppervisor_course.js'
    ], 'public/js/adminlte.min.js');
mix.copyDirectory('resources/fonts', 'public/fonts');
mix.styles([
    'resources/css/public/animate.css',
    'resources/css/public/font-awesome.min.css',
    'resources/css/public/magnific-popup.css',
    'resources/css/public/owl.carousel.css',
    'resources/css/public/style.css',
    'resources/css/public/themify-icons.css',
    ], 'public/css/unica.css');
mix.scripts([
    'resources/js/public/main.js',
    'resources/js/public/jquery.countdown.js',
    'resources/js/public/magnific-popup.min.js',
    'resources/js/public/map.js',
    'resources/js/public/masonry.pkgd.min.js',
    'resources/js/public/owl.carousel.min.js',
    ], 'public/js/public/main.js');
mix.js('resources/js/public/public.js', 'public/js/public');
mix.copyDirectory('resources/icon-fonts', 'public/icon-fonts');
mix.copy('resources/css/public/bootstrap.min.css', 'public/css');
mix.copy('resources/js/bootstrap.min.js', 'public/js');
