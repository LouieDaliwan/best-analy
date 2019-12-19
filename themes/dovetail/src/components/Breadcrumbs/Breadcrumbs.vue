<template>
  <div>
    <v-breadcrumbs
      v-show="breadcrumbs.show"
      class="pl-0"
      divider="/"
      :items="crumbs"
      >
      <template v-slot:item="{ item }">
        <v-breadcrumbs-item
          exact
          :to="{name: item.name}"
          >
          <small v-text="item.text"></small>
        </v-breadcrumbs-item>
      </template>
    </v-breadcrumbs>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Breadcrumbs',

  computed: {
    ...mapGetters({
      breadcrumbs: 'breadcrumbs/breadcrumbs',
    }),

    crumbs: function () {
      return this.$route.matched.map(function (route) {
        return {
          name: route.name,
          text: trans(route.meta.title),
          disabled: false,
          href: route.path,
        }
      })
    }
  },
}
</script>
