<template>
  <admin>
    <metatag :title="resource.data.title"></metatag>
    <back-to-top></back-to-top>

    <page-header :back="{ to: { name: 'companies.show', params: {id: $route.params.id}}, text: 'Back' }">
      <!-- <template v-slot:back>
        <div class="mb-2">
          <can code="customers.show">
            <router-link
              tag="a"
              exact
              :to="{ name: 'companies', params: {id: $route.params.id}, query: { from: $route.fullPath } }"
              class="text--decoration-none body-1 dt-link">
              <v-icon small class="mb-1">mdi mdi-chevron-left</v-icon>
              <span v-text="trans('Back')"></span>
            </router-link>
            <template v-slot:unpermitted>
              <router-link tag="a" exact :to="{ name: 'companies.owned' }" class="text--decoration-none body-1 dt-link">
                <v-icon small class="mb-1">mdi mdi-chevron-left</v-icon>
                <span v-text="trans('Back')"></span>
              </router-link>
            </template>
          </can>
        </div>
      </template> -->
      <template v-slot:title>{{ resource.data.title }}</template>
    </page-header>
    <template v-if="resource.loading">
      <v-row>
        <v-col cols="12"><skeleton type="article"></skeleton></v-col>
        <v-col cols="12"><skeleton type="article"></skeleton></v-col>
        <v-col cols="12"><skeleton type="article"></skeleton></v-col>
      </v-row>
    </template>

    <template v-else>
      <form ref="survey-submission-form" @submit.prevent="submit">
        <v-card>
          <criteria></criteria>
          <template v-for="(fields, f) in resource.data['fields:grouped']">
            <v-card-text class="text-center" :key="f">
              <v-row justify="center">
                <!-- group -->
                <v-col cols="12" md="10">
                  <p :class="$vuetify.breakpoint.smAndUp ? 'headline py-4' : 'subtitle-2'" class="mb-0 font-weight-bold">
                    {{ trans(f) }}
                  </p>
                </v-col>
                <!-- group -->

                <!-- fields -->
                <v-col cols="12" md="10" v-for="(field, i) in fields" :key="i">
                  <v-row>
                    <v-col cols="12" md="auto" :class="$vuetify.breakpoint.smAndUp ? '' : 'pa-0'">
                      <span
                        :class="$vuetify.breakpoint.smAndUp ? 'display-1' : 'title'"
                        class="text--text muted--text font-weight-bold"
                        v-html="field.metadata['sort']"
                      ></span>
                    </v-col>
                    <v-col :class="$vuetify.breakpoint.smAndUp ? '' : 'pa-0'">
                      <p :class="$vuetify.breakpoint.smAndUp ? 'title' : null">{{ trans(field.title) }}</p>
                    </v-col>
                  </v-row>

                  <!-- choices -->
                  <v-item-group :value="getAnswer(field)" active-class="primary" class="mb-4">
                    <v-container :class="$vuetify.breakpoint.smAndUp ? '' : 'pa-0'">
                      <v-row justify="space-around" no-gutters>
                        <v-col :id="`scrollto-${field.id+'-'+(i+1)}`" v-for="(rate, c) in rates" :key="c">
                          <v-tooltip bottom>
                            <template v-slot:activator="{ on }">
                              <v-item v-slot:default="{ active, toggle }">
                                <div
                                  :class="{'primary': rate.number == getAnswer(field)}"
                                  class="dt-chip"
                                  v-on="$vuetify.breakpoint.smAndUp ? on : null"
                                  v-ripple
                                  >
                                  <span :class="rate.number == getAnswer(field) ? 'white--text' : 'muted--text'">
                                    {{ rate.number }}
                                  </span>
                                </div>
                              </v-item>
                            </template>
                            <span>{{ rate.text }}</span>
                          </v-tooltip>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-item-group>
                  <!-- choices -->

                </v-col>
                <!-- fields -->
              </v-row>
            </v-card-text>
          </template>

          <template v-for="(answer, a) in answers">
            <input type="hidden" :name="`fields[${a}][id]`" :value="answer.item.id" >
            <input type="hidden" :name="`fields[${a}][submission][results]`" :value="answer.answer.number">
            <input type="hidden" :name="`fields[${a}][submission][submissible_id]`" :value="answer.item.id">
            <input type="hidden" :name="`fields[${a}][submission][submissible_type]`" value="Survey\Models\Field">
            <input type="hidden" :name="`fields[${a}][submission][user_id]`" :value="auth.id">
            <input type="hidden" :name="`fields[${a}][submission][customer_id]`" :value="companyId">
          </template>

          <!-- Submit -->
          <!-- <v-card-text class="text-center">
            <v-btn
              :disabled="progress < 100 || submitting"
              @click="submit();submitting = true"
              color="primary"
              x-large
              :loading="submitting"
              >
              {{ trans('Submit') }}
              <v-icon right>mdi-arrow-right</v-icon>
            </v-btn>
          </v-card-text> -->
          <!-- Submit -->
        </v-card>
      </form>
    </template>


    <!-- <bottom-navigation v-model="progress"></bottom-navigation> -->
  </admin>
</template>

<script>
import $auth from '@/core/Auth/auth'
import $api from './routes/api'
import Survey from '@/modules/Survey/Models/Survey'
import Criteria from '@/modules/Survey/cards/Criteria'
import { mapActions } from 'vuex'

export default {
  components: {
    Criteria,
  },

  computed: {
    _: function () {
      return window._
    },
    companyId () {
      return this.$route.params.id
    },
    progress () {
      let c = Object.values(this.resource.data['fields:grouped'] || {}).map(function (group) {
        return group
      }).flat().filter(function (field) {
        return field.selected !== undefined
      }).map(function (field) {
        return field.selected
      })

      return parseFloat((c.length * 100) / this.resource.data['fields'].length).toFixed(0)
    },
  },

  data: () => ({
    api: $api,
    rates: [
      { number: '1', text: 'No existing processes & practices' },
      { number: '2', text: 'Processes present but not practised' },
      { number: '3', text: 'Processes are poorly practiced' },
      { number: '4', text: 'Processes practised effectively by some' },
      { number: '5', text: 'Processes practised effectively by most' },
      { number: 'N/A', text: 'Not Applicable' },
    ],
    answers: [],
    resource: new Survey,
    responses: [],
    auth: $auth.getUser(),
    submitting: false,
  }),

  methods: {
    ...mapActions({
      showDialog: 'dialog/show',
      hideDialog: 'dialog/hide',
      errorDialog: 'dialog/error',
      showSnackbar: 'snackbar/show',
      loadDialog: 'dialog/loading',
    }),

    submit: _.debounce(function (event) {
      let data = new FormData(this.$refs['survey-submission-form'])
      axios.post(
        $api.surveys.submit(this.$route.params.survey), data
      ).then(response => {
        this.showSnackbar({
          text: trans('Survey successfully submitted'),
        })

        this.$router.push({
          name: 'companies.show',
          params: { id: this.$route.params.id },
        })
      }).finally(() => {
        this.submitting = false
      })

    }, 2000),

    choose (item, answer) {
      if (this.answers.filter(function (a) {
        return a.id == item.id
      }).length) {
        this.answers.forEach(function (a) {
          if (a.id == item.id) {
            a.answer = answer
          }
        })
        return
      }
      this.answers.push({id: item.id, item, answer})
    },

    getResource () {
      this.resource.loading = true
      axios.get(
        `/api/v1/surveys/${this.$route.params.survey}/submissions/get?customer_id=${this.$route.params.id}&taxonomy_id=${this.$route.params.taxonomy}&month=${this.$route.query.month}`
      ).then(response => {
        this.responses = response.data
        // console.log(this.responses)

        axios.get(
          $api.surveys.show(this.$route.params.survey)
        ).then(response => {
          this.resource.data = response.data.data
        }).finally(() => { this.resource.loading = false })

      }).finally(() => { this.resource.loading = false })
    },

    getAnswer (item) {
      let f = this.responses.filter(function (i) {
        return i.submissible_id == item['id']
      }).map(function (i) {
        return i.results
      })
      return f[0]
    },

    askUserToDestroyResource (resource) {
      this.showDialog({
        color: 'warning',
        illustration: () => import('@/components/Icons/ManThrowingAwayPaperIcon.vue'),
        illustrationWidth: 200,
        illustrationHeight: 160,
        width: '420',
        title: trans('You are about to move to trash the selected survey.'),
        text: [trans('Some data related to survey will still remain.'), trans('Are you sure you want to deactivate and move :name to Trash?', {name: resource.data.name})],
        buttons: {
          cancel: { show: true, color: 'link' },
          action: {
            text: trans('Move to Trash'),
            color: 'warning',
            callback: (dialog) => {
              this.loadDialog(true)
              this.destroyResource(resource)
            }
          }
        }
      })
    },

    destroyResource (item) {
      item.loading = true
      axios.delete(
        $api.destroy(item.data.id)
      ).then(response => {
        this.hideDialog()
        this.showSnackbar({
          show: true,
          text: trans_choice('Survey successfully moved to trash', 1)
        })
        this.$router.push({ name: 'surveys.index' })
      }).catch(err => {
        this.errorDialog({
          width: 400,
          buttons: { cancel: { show: false } },
          title: trans('Whoops! An error occured'),
          text: err.response.data.message,
        })
      }).finally(() => { item.loading = false })
    },
  },

  mounted () {
    this.getResource()
  },
}
</script>
