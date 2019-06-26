'use strict';

const path = require('path');
const rules = require('./build/rules');
const plugins = require('./build/plugins');

module.exports = (env, arg) => {
  return {
    cache: true,
    devtool: 'inline-source-map',
    watchOptions: {
      poll: true
    },
    entry: {
      /**
       * JS files
       */
      app: './src/app.js',
      vendor: './src/vendor.js',

      critical: './src/sass/critical.scss',

      /**
       * Sass files
       */
      fonts: './src/sass/fonts.scss',
    },
    output: {
      path: path.resolve(__dirname, 'dist'),
      filename: 'js/[name].js',
      sourceMapFilename: '[ext]/[name].[ext]',
    },
    resolve: {
      extensions: ['.js', '.css', '.scss', '.json'],
      alias: {
        '@': path.join(__dirname, 'src'),
      },
    },
    module: {
      rules,
    },
    plugins,
    stats: {
      entrypoints: false,
      modules: false,
    },
  };
}
