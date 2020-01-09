export default {
  list: function () {
    return '/api/v1/users'
  },

  store: function () {
    return '/api/v1/users'
  },

  delete: function (id = null) {
    return `/api/v1/users/${id}`
  },

  restore: function (id = null) {
    return `/api/v1/users/${id}`
  },

  trashed: function () {
    return '/api/v1/users/trashed'
  },

  show: function (id = null) {
    return `/api/v1/users/${id}`
  },

  update: function (id = null) {
    return `/api/v1/users/${id}`
  },

  destroy: function (id = null) {
    return `/api/v1/users/${id}`
  },
}
