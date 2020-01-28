export default {
  list: function () {
    return '/api/v1/customers'
  },

  show: function (id = null) {
    return `/api/v1/customers/${id}`
  },
}
