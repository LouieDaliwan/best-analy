<template>
  <admin>
    <page-header></page-header>

    <div v-show="resourcesIsNotEmpty">
      <v-row>
        <v-col cols="12" sm="6" v-for="(resource, i) in resources.data" :key="i">
          <v-card height="100%" exact :to="{ name: 'customers.generate' }" v-ripple="{ class: 'primary--text' }" hover class="text-center">
            <v-card-text>
              <div class="mb-4"><img height="80" :src="resource.icon" alt=""></div>
              <h4 class="mb-1 text-uppercase" v-text="resource.name"></h4>
              <p class="text-uppercase muted--text" v-text="('Performance Indexes')"></p>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </div>

    <!-- Empty state -->
    <div v-if="resourcesIsEmpty">
      <empty-state>
        <template v-slot:actions>
          <v-btn
            large
            color="primary"
            exact
            :to="{name: 'indices.create'}">
            <v-icon small left>mdi-account-plus-outline</v-icon>
            {{ trans('Add Index') }}
          </v-btn>
        </template>
      </empty-state>
    </div>
    <!-- Empty state -->
  </admin>
</template>

<script>
import $api from './routes/api'

export default {
  computed: {
    resourcesIsNotEmpty () {
      return !this.resourcesIsEmpty
    },

    resourcesIsEmpty () {
      return window._.isEmpty(this.resources.data) && !this.resources.loading
    },
  },

  mounted () {
    this.displayIndexes()
  },

  methods: {
    displayIndexes () {
      axios.get(
        $api.list()
      ).then(response => {
        this.resources.data = Object.assign([], this.resources.data, response.data.data)
      })
    },
  },

  data: () => ({
    api: $api,
    resources: {
      data: [],
      loading: true
    }
  }),
}
</script>
