'use strict';

const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const config = require('./resources/build/config.js');
const path = require('path');
const StyleLintPlugin = require('stylelint-webpack-plugin');

module.exports = (env, arg) => {
  return {
    entry: {
      app: path.resolve(config.themepath, 'js/app.js'),
      vendor: path.resolve(config.themepath, 'js/vendor.js'),
    },
    output: {
      path: path.resolve(config.distpath),
      filename: 'js/[name].js',
    },
    cache: true,
    devtool: 'source-map',
    plugins: [
      new StyleLintPlugin(),
      new BrowserSyncPlugin({
        host: 'localhost',
        port: 3000,
        open: false,
        proxy: 'http://localhost:8000/',
      }),
    ],
  }
}
