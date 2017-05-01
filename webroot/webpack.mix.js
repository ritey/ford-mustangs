const { mix } = require('laravel-mix');

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
	.sass('resources/assets/sass/app.scss', 'public/css');
mix.combine([
		'resources/assets/css/main.css',
		'resources/assets/css/responsive.css'
	], 'public/css/build.css')
	.version();
mix.combine([
		'node_modules/masonry-layout/dist/masonry.pkgd.min.js',
		'node_modules/isotope-layout/dist/isotope.pkgd.min.js',
	], 'public/js/libraries.js')
	.version();
