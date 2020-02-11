<template>
  <v-app class="dovetail-app" v-cloak>
    <sidebar></sidebar>

    <snackbar></snackbar>

    <v-slide-y-transition mode="out-in">
      <router-view></router-view>
    </v-slide-y-transition>

    <dialogbox></dialogbox>
  </v-app>
</template>

<script>
export default {
  name: 'Blank',

  created: function () {
    window.axios.interceptors.response.use(undefined, (err) => {
      return new Promise((resolve, reject) => {
        if (err.response.status === 401 && err.config && !err.config.__isRetryRequest) {
          this.$store.dispatch('auth/logout')
        }

        if (err.response.status === 403 && err.config && !err.config.__isRetryRequest) {
          this.$store.dispatch('dialog/error', {
            show: true,
            width: 400,
            color: 'error',
            buttons: { cancel: { show: false } },
            title: err.response.statusText,
            text: err.response.data.message,
          })
        }

        if (err.response.status === 404) {
          this.$router.push({ name: 'error.404' })
        }

        if (err.response.status == Response.HTTP_UNPROCESSABLE_ENTITY) {
          this.$store.dispatch('errorbox/show', {
            text: this.$t(err.response.data.message),
            errors: err.response.data.errors,
          })
        }

        if (err.response.status === Response.HTTP_INTERNAL_SERVER_ERROR) {
          this.$store.dispatch('dialog/error', {
            show: true,
            width: 400,
            buttons: { cancel: { show: false } },
            title: err.response.statusText,
            text: err.response.data.message,
          })
        }

        throw err;
      });
    });
  },

  mounted () {
    this.$store.dispatch('alertbox/hide')
  },
}
</script>

