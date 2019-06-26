'use strict';

const config = require('./resources/build/config.js');
const path = require('path');

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
  }
}
