<template>
  <v-app v-cloak toolbar footer :dark="app.dark">
  <!-- :dark="app.dark" -->
    <!-- Sidebar -->
    <sidebar></sidebar>

    <!-- Snackbar -->
    <snackbar></snackbar>
    <!-- Snackbar -->

    <!-- Utilitybar -->
    <v-slide-y-transition>
      <utilitybar></utilitybar>
    </v-slide-y-transition>
    <!-- Utilitybar -->

    <!-- Main Content -->
    <v-content>
      <!-- Breadcrumbs -->
      <!-- <breadcrumbs></breadcrumbs> -->
      <!-- Breadcrumbs -->

      <!-- Main -->
      <v-slide-y-reverse-transition mode="out-in">
        <router-view></router-view>
      </v-slide-y-reverse-transition>
      <!-- Main -->
    </v-content>
    <!-- Main Content -->

    <!-- <v-footer app inset absolute>asd</v-footer> -->

    <!-- <progressbar></progressbar> -->
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
}
</script>
