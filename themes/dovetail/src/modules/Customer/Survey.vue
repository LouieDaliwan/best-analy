<template>
  <admin>
    <metatag :title="resource.data.title"></metatag>

    <page-header :back="{ to: { name: 'customers.show' }, text: trans('Indexes') }">
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
          <template v-for="(fields, f) in resource.data['fields:grouped']">
            <v-card-text class="text-center" :key="f">
              <v-row justify="center">
                <!-- group -->
                <v-col cols="12" md="10">
                  <p class="headline py-4 mb-0 font-weight-bold">
                    {{ trans(f) }}
                  </p>
                </v-col>
                <!-- group -->

                <!-- fields -->
                <v-col cols="12" md="10" v-for="(field, i) in fields" :key="i">
                  <v-row>
                    <v-col cols="12" md="auto">
                      <span class="text--text muted--text display-1 font-weight-bold" v-html="field.metadata['sort']"></span>
                    </v-col>
                    <v-col>
                      <p class="title">{{ trans(field.title) }}</p>
                    </v-col>
                  </v-row>

                  <!-- choices -->
                  <v-item-group active-class="primary" class="mb-4">
                    <v-container>
                      <v-row justify="space-around" no-gutters>
                        <v-col :id="`scrollto-${field.id+'-'+i}`" v-for="(rate, c) in rates" :key="c">
                          <v-item v-slot:default="{ active, toggle }">
                            <div
                              :color="active ? 'primary' : null"
                              @click="choose(field, rate);toggle()"
                              class="dt-chip"
                              v-ripple
                              v-scroll-to="{ el: `#scrollto-${field.id+'-'+(parseInt(i)+1)}`, duration: 700 }"
                              >
                              <span :class="active ? 'white--text' : 'muted--text'">
                                {{ rate }}
                              </span>
                            </div>
                          </v-item>
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
            <input type="hidden" :name="`fields[${a}][submission][results]`" :value="answer.answer">
            <input type="hidden" :name="`fields[${a}][submission][submissible_id]`" :value="answer.item.id">
            <input type="hidden" :name="`fields[${a}][submission][submissible_type]`" value="Survey\Models\Field">
            <input type="hidden" :name="`fields[${a}][submission][user_id]`" :value="auth.id">
            <input type="hidden" :name="`fields[${a}][submission][customer_id]`" :value="customerId">
          </template>

          <!-- Submit -->
          <v-card-text class="text-center">
            <v-btn
              :disabled="progress < 1 || submitting"
              @click="submit();submitting = true"
              color="primary"
              x-large
              :loading="submitting"
              >
              {{ trans('Submit') }}
              <v-icon right>mdi-arrow-right</v-icon>
            </v-btn>
          </v-card-text>
          <!-- Submit -->
        </v-card>
      </form>
    </template>


    <bottom-navigation v-model="progress"></bottom-navigation>
  </admin>
</template>

<script>
import $auth from '@/core/Auth/auth'
import $api from './routes/api'
import Survey from '@/modules/Survey/Models/Survey'
import { mapActions } from 'vuex'

export default {
  computed: {
    _: function () {
      return window._
    },
    customerId () {
      return this.$route.params.id
    },
    progress () {
      let c = (this.answers.filter(function (i) {
        return !_.isEmpty(i)
      }).length * 100) / this.resource.data['fields'].length
      return parseFloat(c).toFixed(0)
    },
  },

  data: () => ({
    api: $api,
    rates: ['1', '2', '3', '4', '5', '6'],
    answers: [],
    resource: new Survey,
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
        $api.surveys.submit(this.$route.params.survey), data)
        .then(response => {
        }
      ).finally(() => {
        this.submitting = false
      })

      this.showSnackbar({
        text: trans('Survey successfully submitted'),
      })

      this.$router.push({
        name: 'customers.show',
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
      axios.get($api.surveys.show(this.$route.params.survey))
        .then(response => {
          this.resource.data = response.data.data
        }).finally(() => { this.resource.loading = false })
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
