<template>
  <v-app :dark="true">
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
        <v-slide-y-reverse-transition mode="out-in">
          <router-view></router-view>
        </v-slide-y-reverse-transition>
      </v-container>
    </v-content>
    <!-- # Main Content -->
  </v-app>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,

  computed: {
    ...mapGetters({
      app: 'app/app',
    }),
  },

  created: function () {
    window.axios.interceptors.response.use(undefined, function (err) {
      return new Promise(function (resolve, reject) {
        if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
          store.dispatch['auth/logout']
        }
        throw err;
      });
    });
  }
}
</script>
