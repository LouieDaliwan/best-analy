var exec = require('child_process').exec

const [, , theme, command] = process.argv;

var child = exec('npm run '+command+' -- --ansi --colors --color=always', {
  cwd: 'themes/'+theme,
  colors: true,
  silent: true,
  async: true,
});

child.stdout.on('data', function (data) {
  console.log(data);
})
