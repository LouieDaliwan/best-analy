<template>
  <admin>
    <metatag :title="resource.data.title"></metatag>
    <back-to-top></back-to-top>

    <!-- TEST only -->
    <div v-shortkey.once="['ctrl', 'alt', '.']" @shortkey="saveDummyData"></div>
    <!-- TEST only -->
  
    <form ref="survey-submission-form" @submit.prevent="submit">

      <page-header>
        <template v-slot:back>
          <div class="mb-2">
            <can code="customers.show">
              <router-link tag="a" exact :to="{ name: 'companies.show', params: {id: $route.params.id} }" class="text--decoration-none body-1 dt-link">
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
        </template>
        <template v-slot:title>{{ resource.data.title }}</template>
        <template v-slot:action>
          <survey-monthly-picker></survey-monthly-picker>
        </template>
      </page-header>

      <template v-if="resource.loading">
        <v-row>
          <v-col cols="12"><skeleton type="article"></skeleton></v-col>
          <v-col cols="12"><skeleton type="article"></skeleton></v-col>
          <v-col cols="12"><skeleton type="article"></skeleton></v-col>
        </v-row>
      </template>

      <template v-else>
        <v-card v-if="taxonomy_item !== 'sdmi'">
          <criteria></criteria>
          <template v-for="(fields, f) in resource.data['fields:grouped']">
            <v-card-text class="text-center" :key="f">
              <v-row justify="center">
                <!-- group -->
                <v-col cols="12" md="10">
                  <p :class="$vuetify.breakpoint.smAndUp ? 'headline py-4' : 'subtitle-2'" class="mb-0 font-weight-bold">
                    {{ trans(f) }}
                  </p>
                  <p v-html="fields[0].metadata.group_arabic"></p>
                </v-col>
                <!-- group -->

                <!-- fields -->
                <v-col cols="12" md="10" v-for="(field, i) in fields" :key="i">
                  <v-row>
                    <v-col cols="12" md="auto" :class="$vuetify.breakpoint.smAndUp ? '' : 'pa-0'">
                      <span
                        :class="$vuetify.breakpoint.smAndUp ? 'display-1' : 'title'"
                        class="text--text muted--text font-weight-bold"
                        v-html="field.sort"
                      ></span>
                    </v-col>
                    <v-col :class="$vuetify.breakpoint.smAndUp ? '' : 'pa-0'">
                      <p :class="$vuetify.breakpoint.smAndUp ? 'title' : null">{{ trans(field.title) }}</p>
                      <p class="rtl-text" :class="$vuetify.breakpoint.smAndUp ? 'title' : null">{{ trans(field.metadata.title_arabic) }}</p>
                    </v-col>
                  </v-row>

                  <!-- choices -->
                  <v-item-group v-model="field.selected" active-class="primary" class="mb-4">
                    <v-container :class="$vuetify.breakpoint.smAndUp ? '' : 'pa-0'">
                      <v-row justify="space-around" no-gutters>
                        <v-col :id="`scrollto-${field.id+'-'+(i+1)}`" v-for="(rate, c) in rates" :key="c">
                          <v-tooltip bottom>
                            <template v-slot:activator="{ on }">
                              <v-item v-slot:default="{ active, toggle }">
                                <div
                                  :color="active ? 'primary' : null"
                                  @click="choose(field, rate, i);toggle()"
                                  class="dt-chip"
                                  v-on="$vuetify.breakpoint.smAndUp ? on : null"
                                  v-ripple
                                  v-scroll-to="{ el: `#scrollto-${field.id+'-'+(parseInt(i)+1)}`, duration: 700 }"
                                  >
                                  <span :class="active ? 'white--text' : 'muted--text'">
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
            <input type="hidden" :name="`fields[${a}][submission][score]`" :value="answer.answer.number">
            <input type="hidden" :name="`fields[${a}][submission][results]`" :value="answer.answer.number">
            <input type="hidden" :name="`fields[${a}][submission][submissible_id]`" :value="answer.item.id">
            <input type="hidden" :name="`fields[${a}][submission][submissible_type]`" value="Survey\Models\Field">
            <input type="hidden" :name="`fields[${a}][submission][user_id]`" :value="auth.id">
            <input type="hidden" :name="`fields[${a}][submission][customer_id]`" :value="companyId">
          </template>

          <!-- Submit -->
          <v-card-text class="text-center">
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
          </v-card-text>
          <!-- Submit -->
        </v-card>

        <div v-if="taxonomy_item == 'sdmi'">
          <div v-for="(fields, f) in resource.data['fields:grouped']" :key="f">
             <v-card :key="f">
               <fifth-criteria-one v-if="f === 'Business Expansion'"></fifth-criteria-one>
               <fifth-criteria-sec v-if="f !== 'Business Expansion' && f !== 'Marketing Strategies' && f  !== 'Capacity Utilisation' && f !== 'Endorsement, Certification & Standards'"></fifth-criteria-sec>
               <fifth-criteria-three v-if="f === 'Endorsement, Certification & Standards'"></fifth-criteria-three>

                <v-card-text class="text-center" :key="f">
                <v-row justify="center">
                  <!-- group -->
                  <v-col cols="12" md="10">
                    <p :class="$vuetify.breakpoint.smAndUp ? 'headline py-4' : 'subtitle-2'" class="mb-0 font-weight-bold">
                      {{ trans(f) }}
                    </p>
                    <p v-html="fields[0].metadata.group_arabic"></p>
                  </v-col>
                  <!-- group -->

                  <!-- fields -->
                  <v-col cols="12" md="10" v-for="(field, i) in fields" :key="i">
                    <v-row>
                      <v-col cols="12" md="auto" :class="$vuetify.breakpoint.smAndUp ? '' : 'pa-0'">
                        <span
                          :class="$vuetify.breakpoint.smAndUp ? 'display-1' : 'title'"
                          class="text--text muted--text font-weight-bold"
                          v-html="field.sort"
                        ></span>
                      </v-col>
                      <v-col :class="$vuetify.breakpoint.smAndUp ? '' : 'pa-0'">
                        <p :class="$vuetify.breakpoint.smAndUp ? 'title' : null">{{ trans(field.title) }}</p>
                        <p class="rtl-text" :class="$vuetify.breakpoint.smAndUp ? 'title' : null">{{ trans(field.metadata.title_arabic) }}</p>
                      </v-col>
                    </v-row>

                    <!-- choices -->
                    <v-item-group v-model="field.selected" active-class="primary" class="mb-4">
                      <v-container :class="$vuetify.breakpoint.smAndUp ? '' : 'pa-0'">
                        <v-row justify="space-around" no-gutters>
                          <v-col :id="`scrollto-${field.id+'-'+(i+1)}`" v-for="(rate, c) in getRates(f, field)" :key="c">
                            <v-tooltip bottom>
                              <template v-slot:activator="{ on }">
                                <v-item v-slot:default="{ active, toggle }">
                                  <div
                                    :color="active ? 'primary' : null"
                                    @click="choose(field, rate, f);toggle()"
                                    class="dt-chip"
                                    v-on="$vuetify.breakpoint.smAndUp ? on : null"
                                    v-ripple
                                    v-scroll-to="{ el: `#scrollto-${field.id+'-'+(parseInt(i)+1)}`, duration: 700 }"
                                    >
                                    <span :class="active ? 'white--text' : 'muted--text'">
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
             </v-card>
          </div>
          <v-card>
            <template v-if="taxonomy_item == 'sdmi'" v-for="(answer, a) in answers">
              <input type="hidden" :name="`fields[${a}][id]`" :value="answer.item.id" >
              <input type="hidden" :name="`fields[${a}][submission][fieldKey]`" :value="answer.keyField"> 
              <input type="hidden" :name="`fields[${a}][submission][taxonomy]`" :value="'sdmi'">
              <input type="hidden" :name="`fields[${a}][submission][score]`" :value="answer.answer.number">
              <input type="hidden" :name="`fields[${a}][submission][results]`" :value="answer.answer.text">
              <input type="hidden" :name="`fields[${a}][submission][submissible_id]`" :value="answer.item.id">
              <input type="hidden" :name="`fields[${a}][submission][submissible_type]`" value="Survey\Models\Field">
              <input type="hidden" :name="`fields[${a}][submission][user_id]`" :value="auth.id">
              <input type="hidden" :name="`fields[${a}][submission][customer_id]`" :value="companyId">
            </template>
            <template v-else v-for="(answer, a) in answers">
              <input type="hidden" :name="`fields[${a}][id]`" :value="answer.item.id" >
              <input type="hidden" :name="`fields[${a}][submission][score]`" :value="answer.answer.number">
              <input type="hidden" :name="`fields[${a}][submission][results]`" :value="answer.answer.number">
              <input type="hidden" :name="`fields[${a}][submission][submissible_id]`" :value="answer.item.id">
              <input type="hidden" :name="`fields[${a}][submission][submissible_type]`" value="Survey\Models\Field">
              <input type="hidden" :name="`fields[${a}][submission][user_id]`" :value="auth.id">
              <input type="hidden" :name="`fields[${a}][submission][customer_id]`" :value="companyId">
            </template>

            <!-- Submit -->
            <v-card-text class="text-center">
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
            </v-card-text>
            <!-- Submit -->
          </v-card>
        </div>          
      </template>
    </form>

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
    taxonomy_item: null,
    api: $api,
    rates: [
      { number: '1', text: 'No existing processes & practices' },
      { number: '2', text: 'Processes present but not practised' },
      { number: '3', text: 'Processes are poorly practiced' },
      { number: '4', text: 'Processes practised effectively by some' },
      { number: '5', text: 'Processes practised effectively by most' },
      { number: 'N/A', text: 'Not Applicable' },
    ],

    sdmiRatesOne: [
      { number: '1', text: 'Strongly Disagree' },
      { number: '2', text: 'Disagree' },
      { number: '3', text: 'Moderately Agree' },
      { number: '4', text: 'Agree' },
      { number: '5', text: 'Strongly Agree' },
    ],

    sdmiRatesTwo: [
      { number: '<10%', text: '<10%' },
      { number: '10% - 25%', text: '10% - 25%' },
      { number: '>25% - 50%', text: '>25% - 50%' },
      { number: '>50% - 75%', text: '>50% - 75%' },
      { number: '>75% - 100%', text: '>75% - 100%' },
    ],

    sdmiRatesThree: [
      { number: '1', text: 'Minimum standards required <br/> by the authorities are met' },
      { number: '1', text: 'Critical certifications and standards <br/> are acquired to maintain <br/> high standards in the business	' },
      { number: '3', text: 'Certifications and Standards <br/> acquired over and above <br/> requirements to drive <br/> business growth & innovation' },
      { number: '5', text: 'I am not aware of any <br/> industry standards or <br/> certifications required' },
      { number: 'NA', text: 'There are no industry standards <br/>required in my business' },
    ],

    sdmiRatesFour: [
      { number: '1', text: 'Least Satisfied' },
      { number: '2', text: 'Least Satisfied' },
      { number: '3', text: 'Satisfied' },
      { number: '4', text: 'Satisfied' },
      { number: '5', text: 'Very Satisfied' },
    ],

    extentServicesRates: [
      { number: '<10%', text: '<10%' },
      { number: '10% - 25%', text: '10% - 25%' },
      { number: '>25% - 50%', text: '>25% - 50%' },
      { number: '>50% - 75%', text: '>50% - 75%' },
      { number: '>75% - 100%', text: '>75% - 100%' },
      { number: 'N/A', text: 'NA'} 
    ],
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

    getRates(value, field) {
      
      if((value === 'Business Expansion' || value === 'Marketing Strategies') && field.title !== 'Extent products/or services are ready to be exported') {
        return this.sdmiRatesOne;
      }

      if(field.title === 'Extent products/or services are ready to be exported'){
        return this.extentServicesRates;
      }
      
      if(value === 'Capacity Utilisation') {
        return this.sdmiRatesTwo;
      }

      if(value === 'Endorsement, Certification & Standards') {
        return this.sdmiRatesThree;
      }

      return this.sdmiRatesFour;
    },

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
    }, 100),

    choose (item, answer, keyField) {
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
      this.answers.push({id: item.id, item, answer, keyField});
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

    saveDummyData () {
      let data = { fields: [] }
      let fieldData = this.resource.data.fields
      let total = fieldData.length

      for (var i = total - 1; i >= 0; i--) {
        data.fields.push({
          id: fieldData[i].id,
          submission: {
            results: Math.floor(Math.random() * 5) + 1,
            submissible_id: fieldData[i].id,
            submissible_type: "Survey\\Models\\Field",
            user_id: this.auth.id,
            customer_id: this.companyId,
          },
        })
      }

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
    },
  },

  mounted () {
    this.getResource()

    if (this.$route.params.taxonomy === '5th-module-strategy-development-and-management-index-(sdmi)') {
      this.taxonomy_item = 'sdmi'; 
    }
  },

  watch: {
    submitting: function (val) {
      if (!val) {
        this.hideDialog()
      }
    }
  }
}
</script>
