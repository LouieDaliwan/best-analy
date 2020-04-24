export default {
  list: function () {
    return '/api/v1/indices'
  },

  store: function () {
    return '/api/v1/indices'
  },

  delete: function (id = null) {
    return `/api/v1/indices/delete/${id}`
  },

  restore: function (id = null) {
    return `/api/v1/indices/restore/${id}`
  },

  trashed: function () {
    return '/api/v1/indices/trashed'
  },

  show: function (id = null) {
    return `/api/v1/indices/${id}`
  },

  update: function (id = null) {
    return `/api/v1/indices/${id}`
  },

  destroy: function (id = null) {
    return `/api/v1/indices/${id}`
  },

  translation: function () {
    return '/api/v1/best/settings/translations/keys'
  }
}
