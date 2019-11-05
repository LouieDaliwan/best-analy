'use strict';

require('dotenv').config();

module.exports = {
  themepath: process.env.APP_THEME === 'default' ? 'resources/' : 'themes/' + process.env.APP_THEME + '/',
  distpath: process.env.APP_THEME === 'default' ? 'public/' : 'themes/' + process.env.APP_THEME + '/dist/',
  env: process.env,
}
