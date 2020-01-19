<template>
  <v-menu
    :close-on-content-click="false"
    max-width="300px"
    min-width="300px"
    nude-right="100%"
    v-model="menu"
    transition="slide-y-transition"
    >
    <template v-slot:activator="{ on }">
      <v-text-field
        :dense="isDense"
        :label="trans('Select Icon')"
        class="dt-text-field"
        clear-icon="mdi mdi-close-circle-outline"
        clearable
        outlined
        >
        <template v-slot:prepend-inner>
          <v-icon class="mb-0" v-on="on">mdi-home</v-icon>
        </template>
      </v-text-field>
    </template>
    <v-list @input="menu = false">
      <v-list-item-group color="primary">
        <v-list-item>
          <v-list-item-icon>
            <v-icon small>mdi-home</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title color="muted">mdi-home</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-menu>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data: vm => ({
    menu: false,
  }),

  computed: {
    ...mapGetters({
      isDense: 'settings/fieldIsDense',
    }),
  },
}
</script>
