export default {
  name: 'page',
  computed: {
    page: function () {
      const route = this.$router.currentRoute

      return {
        title: route.meta.title,
        icon: route.meta.icon,
        text: route.meta.description,
        description: route.meta.description,
      }
    }
  }
}
