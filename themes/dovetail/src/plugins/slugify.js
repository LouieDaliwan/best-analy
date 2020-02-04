import slugify from 'slugify'

window.slugify = function (string, separator = '-') {
  return slugify(string, separator)
}
