<template>
  <v-app class="dovetail-app" v-cloak>
    <sidebar></sidebar>

    <snackbar></snackbar>

    <v-slide-y-transition>
      <appbar></appbar>
    </v-slide-y-transition>

    <!-- # Main Content -->
    <v-content>
      <v-container>
        <breadcrumbs></breadcrumbs>
      </v-container>

      <v-container>
        <v-slide-y-transition mode="out-in">
          <router-view></router-view>
        </v-slide-y-transition>
      </v-container>

      <v-card class="transparent" flat height="100"></v-card>
    </v-content>
    <!-- # Main Content -->
  </v-app>
</template>

<script>
export default {
  created: function () {
    window.axios.interceptors.response.use(undefined, function (err) {
      return new Promise(function (resolve, reject) {
        if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
          store.dispatch['auth/logout']
        }

        if (err.status === 403 && err.config && !err.config.__isRetryRequest) {
          this.$router.push({name: '403'})
        }

        throw err;
      });
    });
  },
}
</script>
