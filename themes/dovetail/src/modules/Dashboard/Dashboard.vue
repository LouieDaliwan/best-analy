<template>
  <admin>
    <page-header></page-header>
    <template v-if="resources.loading">
      <v-row>
        <v-col cols="12" sm="6">
          <v-skeleton-loader type="image" height="200"></v-skeleton-loader>
        </v-col>
        <v-col cols="12" sm="6">
          <v-skeleton-loader type="image" height="200"></v-skeleton-loader>
        </v-col>
        <v-col cols="12" sm="6">
          <v-skeleton-loader type="image" height="200"></v-skeleton-loader>
        </v-col>
        <v-col cols="12" sm="6">
          <v-skeleton-loader type="image" height="200"></v-skeleton-loader>
        </v-col>
      </v-row>
    </template>

    <template v-else>
      <div v-show="resourcesIsNotEmpty">
        <v-row>
          <v-col cols="12" sm="6" v-for="(resource, i) in resources.data" :key="i">
            <v-card
              :hover="$vuetify.breakpoint.smAndUp"
              :to="$vuetify.breakpoint.smAndUp ? { name: 'companies.find' } : null"
              class="text-center"
              exact
              height="100%"
              v-ripple="$vuetify.breakpoint.smAndUp ? { class: 'primary--text' } : null"
              >
              <v-card-text>
                <div class="mb-4"><img height="80" :src="resource.icon" alt=""></div>
                <h4 class="mb-1 text-uppercase" v-text="resource.name"></h4>
                <p class="text-uppercase muted--text" v-text="('Performance Indexes')"></p>
              </v-card-text>
              <v-card-actions v-if="$vuetify.breakpoint.xsOnly">
                <v-spacer></v-spacer>
                <v-btn block large text color="primary" :to="{ name: 'companies.find' }" exact>{{ __('Start Survey') }}</v-btn>
                <v-spacer></v-spacer>
              </v-card-actions>
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
    </template>
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
      this.resources.loading = true
      axios.get(
        $api.list()
      ).then(response => {
        this.resources.data = Object.assign([], this.resources.data, response.data.data)
      }).finally(() => { this.resources.loading = false })
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
