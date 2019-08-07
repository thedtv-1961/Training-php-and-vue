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
  .js('resources/js/swagger.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .sass('resources/sass/user.scss', 'public/css')
  .sass('resources/sass/announcements.scss', 'public/css')
  .sass('resources/sass/edit_announcement.scss', 'public/css')
  .sass('resources/sass/group.scss', 'public/css')
  .sass('resources/sass/change_email_requests.scss', 'public/css')
  .copy('resources/js/utils/upload_image.js', 'public/js')
  .copy('resources/images/*', 'public/images')
  .copyDirectory([
    'node_modules/swagger-ui-dist/swagger-ui-bundle.js',
    'node_modules/swagger-ui-dist/swagger-ui.css',
    'node_modules/swagger-ui-dist/favicon-32x32.png',
    'node_modules/swagger-ui-dist/favicon-16x16.png',
    'node_modules/swagger-ui-dist/swagger-ui-standalone-preset.js',
    'node_modules/swagger-ui-dist/swagger-ui-standalone-preset.js.map',
    'node_modules/swagger-ui-dist/swagger-ui.css.map',
    'node_modules/swagger-ui-dist/swagger-ui-bundle.js.map',
  ], 'public/swagger')
  .webpackConfig(config);
