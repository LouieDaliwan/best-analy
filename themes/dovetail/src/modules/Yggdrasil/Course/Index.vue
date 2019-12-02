<template :dark="$store.getters['app/app'].dark">
  <div>
    <v-toolbar
      flat
      :class="app.dark ? 'emphasis--medium' : 'white'"
      >
      <v-icon v-if="page.icon">{{ page.icon }}</v-icon>
      <v-toolbar-title>{{ trans(page.title) }}</v-toolbar-title>
      <v-spacer></v-spacer>

      <!-- v-if="!empty"  -->
      <v-btn color="secondary" :to="{name: 'courses.create'}">
        <v-icon left>add</v-icon>
        {{ trans('New Course') }}
      </v-btn>

    </v-toolbar>
  </div>
</template>

<script>
import page from './config/sidebar'
import { mapGetters } from 'vuex'

export default {
  name: 'CourseIndex',

  computed: {
    page: function () {
      return this.$route.meta;
    },

    ...mapGetters({
      app: 'app/app'
    }),
  },
}
</script>
