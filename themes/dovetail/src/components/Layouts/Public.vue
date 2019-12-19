<template>
  <v-app v-cloak class="dovetail-app" :dark="true">

    <!-- Main Content -->
    <v-content>
      <v-container>
        <breadcrumbs></breadcrumbs>
      </v-container>

      <v-container>
        <v-slide-y-transition mode="out-in">
          <router-view></router-view>
        </v-slide-y-transition>
      </v-container>
    </v-content>
    <!-- Main Content -->
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

