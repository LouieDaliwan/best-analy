<template>
  <admin>
    <metatag :title="resource.data.name"></metatag>

    <page-header :back="{ to: { name: 'customers.index' }, text: trans('Customers') }">
      <template v-slot:title>
        <h2 class="mb-3">{{ trans("Let's Start!") }}</h2>
        <p class="font-weight-regular">
          {{ trans('Please select the type of survey evaluation that you would like to do for customer') }}
          <strong>{{ resource.data.name }}</strong>.
        </p>
      </template>

      <template v-slot:action>
        <!-- Export button -->
        <div class="text-right mb-4">
          <generate-report-button></generate-report-button>
        </div>
        <!-- Export button -->
      </template>
    </page-header>


    <template v-if="resource.loading">
      <v-row>
        <v-col cols="12" sm="6"><skeleton type="card"></skeleton></v-col>
        <v-col cols="12" sm="6"><skeleton type="card"></skeleton></v-col>
        <v-col cols="12" sm="6"><skeleton type="card"></skeleton></v-col>
        <v-col cols="12" sm="6"><skeleton type="card"></skeleton></v-col>
      </v-row>
    </template>

    <template v-else>
      <div v-show="resourcesIsNotEmpty">
        <v-row>
          <v-col cols="12" sm="6" v-for="(resource, i) in resources.data" :key="i">
            <v-card
              :to="goToCustomerSurveyPage(resource)"
              class="text-center card-carded"
              exact
              height="100%"
              hover
              v-ripple="{ class: 'primary--text' }"
              >
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
    </template>
  </admin>
</template>

<script>
import $api from './routes/api'
import Survey from '@/modules/Survey/Models/Survey'
import GenerateReportButton from './cards/GenerateReportButton'

export default {
  components: {
    GenerateReportButton
  },

  computed: {
    resourcesIsNotEmpty () {
      return !this.resourcesIsEmpty
    },

    resourcesIsEmpty () {
      return window._.isEmpty(this.resource.data) && !this.resource.loading
    },
  },

  data: () => ({
    api: $api,

    resource: new Survey,

    resources: {
      data: []
    }
  }),

  methods: {
    getResource () {
      this.resource.loading = true
      axios.get(
        $api.show(this.$route.params.id)
      ).then(response => {
        this.resource.data = response.data.data
      }).finally(() => { this.resource.loading = false })
    },

    displayIndexes () {
      this.resource.loading = true
      axios.get(
        $api.indices.list()
      ).then(response => {
        this.resources.data = Object.assign([], this.resources.data, response.data.data)
      }).finally(() => { this.resource.loading = false })
    },

    goToCustomerSurveyPage (index) {
      const customer = this.$route.params.id
      return {
        name: 'customers.survey', params: {
          id: customer,
          taxonomy: index.code,
          survey: index.survey && index.survey.id  || null,
        }
      }
    },
  },

  mounted () {
    this.getResource()
    this.displayIndexes()
  },
}
</script>
