export default {
  list: function () {
    return '/api/v1/surveys'
  },

  store: function () {
    return '/api/v1/surveys'
  },

  delete: function (id = null) {
    return `/api/v1/surveys/delete/${id}`
  },

  restore: function (id = null) {
    return `/api/v1/surveys/restore/${id}`
  },

  trashed: function () {
    return '/api/v1/surveys/trashed'
  },

  show: function (id = null) {
    return `/api/v1/surveys/${id}`
  },

  update: function (id = null) {
    return `/api/v1/surveys/${id}`
  },

  destroy: function (id = null) {
    return `/api/v1/surveys/${id}`
  },

  submit: function (id = null) {
    return `/api/v1/surveys/${id}/submit`
  },
}
