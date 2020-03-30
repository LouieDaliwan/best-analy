const mix = require('laravel-mix');
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');
require('laravel-mix-favicon');

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

mix.config.fileLoaderDirs.fonts = 'dist/fonts';
// mix.setPublicPath('dist/');
mix.setResourceRoot('/theme');

mix.sourceMaps();

mix
  .webpackConfig({
    output: {
      chunkFilename: 'dist/js/[name].js',
      publicPath: '/theme/',
    },
    plugins: [
      new VuetifyLoaderPlugin()
    ],
    module: {
      rules: [
        {
          test: /\.scss/,
          loader: 'import-glob-loader'
        },
        {
          test: /\.sass/,
          loader: 'import-glob-loader'
        },
      ]
    },
    resolve: {
      extensions: ['.js', '.vue', '.json'],
      alias: {
        'vue$': 'vue/dist/vue.esm.js',
        '@': __dirname + '/src',
      },
    },
  })

  .autoload({
    jquery: ['$', 'window.jQuery', 'window.$'],
  })

  .js('src/app.js', 'dist/js')

  .sass('src/sass/app.scss', 'dist/css')
  .sass('src/sass/fonts.scss', 'dist/css')

  .options({
    extractVueStyles: true,
  })

  // .favicon({
  //   inputPath: 'src/favicons',
  //   publicPath: 'dist',
  //   output: 'favicons',
  // })

  // .copy('src/favicons/logo.png', '../../public/logo.png')

  .browserSync({
    proxy: 'http://localhost:8000/',
    files: [
      'dist/css/{*,**/*}.css',
      'dist/js/{*,**/*}.js',
      'templates/{*,**/*}.html.twig'
    ],
    open: false
  })
