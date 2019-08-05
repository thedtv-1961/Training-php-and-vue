const mix = require('laravel-mix');
const config = require('./webpack.config');

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

mix.sourceMaps()
  .js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .sass('resources/sass/user.scss', 'public/css')
  .sass('resources/sass/announcements.scss', 'public/css')
  .sass('resources/sass/edit_announcement.scss', 'public/css')
  .sass('resources/sass/group.scss', 'public/css')
  .copy('resources/js/utils/upload_image.js', 'public/js')
  .copy('resources/images/*', 'public/images')
  .webpackConfig(config);
