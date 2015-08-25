var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
      .scripts([
        'sweetalert/dist/sweetalert-dev.js',
        'dropzone/dist/dropzone.js'
      ], './public/js/libs.js', 'resources/components')
      .styles([
        'sweetalert/dist/sweetalert.css',
        'dropzone/dist/basic.css',
        'dropzone/dist/dropzone.css'
      ], './public/css/libs.css', 'resources/components');
});
