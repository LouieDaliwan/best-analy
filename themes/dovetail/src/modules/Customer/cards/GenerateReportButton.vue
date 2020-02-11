<template>
  <v-menu open-on-hover offset-y bottom transition="slide-y-transition">
    <template v-slot:activator="{ on }">
      <v-btn v-on="on" large color="primary">
        <v-icon small left>mdi-download</v-icon>
        {{ trans('Export Reports') }}
      </v-btn>
    </template>
    <v-list dense>
      <template>
        <v-list-item v-for="(resource, i) in resources.data" :key="i">
          <v-list-item-content>
            <v-list-item-title v-text="resource.name"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </template>
    </v-list>
  </v-menu>
</template>

<script>
import $api from '../routes/api'

export default {
  mounted () {
    this.displayIndexes()
  },

  methods: {
    displayIndexes () {
      axios.get(
        $api.indices.list()
      ).then(response => {
        this.resources.data = Object.assign([], this.resources.data, response.data.data)
      })
    },
  },

  data: () => ({
    api: $api,
    resources: {
      data: []
    }
  }),
}
</script>
