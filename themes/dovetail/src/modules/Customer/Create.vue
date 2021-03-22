<template>
  <admin>
    <metatag :title="resource.data.name"></metatag>
    <back-to-top></back-to-top>

    <template v-slot:appbar>
      <v-container class="py-0 px-0">
        <v-row justify="space-between" align="center">
          <v-fade-transition>
            <v-col v-if="isNotFormPrestine" class="py-0" cols="auto">
              <v-toolbar-title class="muted--text">{{ trans('Unsaved changes') }}</v-toolbar-title>
            </v-col>
          </v-fade-transition>
          <v-spacer></v-spacer>
          <v-col class="py-0" cols="auto">
            <div class="d-flex justify-end">
              <v-spacer></v-spacer>
              <v-btn @click="askUserToDiscardUnsavedChanges" text class="ml-3 mr-0" large>{{ trans('Discard') }}</v-btn>
              <v-badge
                bordered
                bottom
                class="dt-badge"
                color="dark"
                content="s"
                offset-x="20"
                offset-y="20"
                tile
                transition="fade-transition"
                v-model="shortkeyCtrlIsPressed"
                >
                <v-btn
                  :disabled="isFormDisabled"
                  :loading="isLoading"
                  @click.prevent="submitForm"
                  @shortkey="submitForm"
                  class="ml-3 mr-0"
                  color="primary"
                  large
                  ref="submit-button-main"
                  type="submit"
                  v-shortkey.once="['ctrl', 's']"
                  >
                  <v-icon left>mdi-content-save-outline</v-icon>
                  {{ trans('Save') }}
                </v-btn>
              </v-badge>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </template>

    <validation-observer ref="addform" v-slot="{ handleSubmit, errors, invalid, passed }">
      <v-form :disabled="isLoading" ref="addform-form" autocomplete="false" @change="formIsChanged" v-on:submit.prevent="handleSubmit(submit($event))">
        <button :disabled="isFormDisabled" ref="submit-button" type="submit" class="d-none"></button>
        <page-header :back="{ to: { name: 'companies.owned' }, text: trans('Companies') }">
          <template v-slot:title>
            {{ trans(`Add Company Input Data`) }}
          </template>
          <template v-slot:action>
            <validation-provider vid="metadata[type]" :name="trans('Type')" rules="email" v-slot="{ errors }">
              <div>
                <label>Audited Financials</label>
                <input type="radio" :checked="resource.data.metadata.type == 'Audited'" name="metadata[type]" value="Audited">
                <span class="d-inline-block mx-3"></span>
                <label>In-House Financials</label>
                <input type="radio" :checked="resource.data.metadata.type == 'In-House'" name="metadata[type]" value="In-House">
                <!-- <v-radio-group v-model="resource.data.metadata.type" row mandatory>
                  <v-radio label="Audited Financials" name="metadata[type]" value="Audited"></v-radio>
                  <v-radio label="In-House Financials" name="metadata[type]" value="In-House"></v-radio>
                </v-radio-group> -->
              </div>
            </validation-provider>
            <!-- <div class="mt-3 text-right">
              <send-financial-data-to-crm-button
                :customer="resource.data.id"
                :user="resource.data.user_id"
              ></send-financial-data-to-crm-button>
            </div> -->
          </template>
        </page-header>

        <!-- Alertbox -->
        <alertbox></alertbox>
        <!-- Alertbox -->

        <input type="hidden" name="name" :value="resource.data.name">
        <input type="hidden" name="code" :value="resource.data.code">
        <input type="hidden" name="refnum" :value="resource.data.refnum">
        <input type="hidden" name="user_id" :value="resource.data.user_id">

        <v-row>
          <v-col cols="12" md="12">
            <v-card flat color="transparent">
              <tabs v-model="tabsModel">
                <template v-slot:item>
                  <v-tab-item key="tab-0">
                    <template v-if="isFetchingResource">
                      <skeleton-edit-company></skeleton-edit-company>
                    </template>

                    <v-card v-show="isFinishedFetchingResource">
                      <v-card-text>
                        <validation-provider vid="name" :name="trans('name')" rules="required" v-slot="{ errors }">
                          <v-text-field
                            :dense="isDense"
                            :disabled="isLoading"
                            :error-messages="errors"
                            :label="trans('Company Name')"
                            autofocus
                            class="dt-text-field"
                            name="name"
                            outlined
                            prepend-inner-icon="mdi-briefcase-outline"
                            v-model="resource.data.name"
                            >
                          </v-text-field>
                        </validation-provider>

                        <validation-provider vid="code" rules="required" :name="trans('code')" v-slot="{ errors }">
                          <v-text-field
                            :dense="isDense"
                            :disabled="isLoading"
                            :error-messages="errors"
                            :label="trans('Code')"
                            :value="slugify(resource.data.name)"
                            class="dt-text-field"
                            name="code"
                            outlined
                          ></v-text-field>
                        </validation-provider>

                        <validation-provider vid="refnum" rules="required" :name="trans('reference number')" v-slot="{ errors }">
                          <v-text-field
                            :dense="isDense"
                            :disabled="isLoading"
                            :error-messages="errors"
                            :label="trans('Reference Number')"
                            v-model="resource.data.refnum"
                            class="dt-text-field"
                            name="refnum"
                            outlined
                          ></v-text-field>
                        </validation-provider>

                        <validation-provider vid="metadata[email]" :name="trans('Email')" rules="email" v-slot="{ errors }">
                          <v-text-field
                            :dense="isDense"
                            :disabled="isLoading"
                            :error-messages="errors"
                            :label="trans('Company Email')"
                            class="dt-text-field"
                            name="metadata[email]"
                            outlined
                            prepend-inner-icon="mdi-email-outline"
                            v-model="resource.data.metadata['email']"
                            >
                          </v-text-field>
                        </validation-provider>

                        <validation-provider vid="metadata[address]" :name="trans('Company Address')" v-slot="{ errors }">
                          <v-text-field
                            :dense="isDense"
                            :disabled="isLoading"
                            :error-messages="errors"
                            :label="trans('Company Address')"
                            class="dt-text-field"
                            name="metadata[address]"
                            outlined
                            prepend-inner-icon="mdi-map-marker"
                            v-model="resource.data.metadata['address']"
                            >
                          </v-text-field>
                        </validation-provider>

                        <validation-provider vid="metadata[website]" :name="trans('Website')" v-slot="{ errors }">
                          <v-text-field
                            :dense="isDense"
                            :disabled="isLoading"
                            :error-messages="errors"
                            :label="trans('Website')"
                            class="dt-text-field"
                            name="metadata[website]"
                            outlined
                            prepend-inner-icon="mdi-earth"
                            v-model="resource.data.metadata['website']"
                            >
                          </v-text-field>
                        </validation-provider>

                        <validation-provider vid="metadata[staffstrength]" :name="trans('Staff Strength')" v-slot="{ errors }">
                          <v-text-field
                            :dense="isDense"
                            :disabled="isLoading"
                            :error-messages="errors"
                            :label="trans('Staff Strength')"
                            class="dt-text-field"
                            name="metadata[staffstrength]"
                            outlined
                            type="number"
                            v-model="resource.data.metadata['staffstrength']"
                            >
                          </v-text-field>
                        </validation-provider>

                        <validation-provider vid="metadata[industry]" :name="trans('Industry')" v-slot="{ errors }">
                          <v-text-field
                            :dense="isDense"
                            :disabled="isLoading"
                            :error-messages="errors"
                            :label="trans('Industry')"
                            class="dt-text-field"
                            name="metadata[industry]"
                            outlined
                            v-model="resource.data.metadata['industry']"
                            >
                          </v-text-field>
                        </validation-provider>

                        <!-- Metadata -->
                        <input
                          v-for="(meta, i) in resource.data.metadata"
                          type="hidden"
                          :name="`metadata[${i}]`"
                          :value="resource.data.metadata[i]"
                          >
                        <!-- Metadata -->
                      </v-card-text>
                    </v-card>
                  </v-tab-item>

                  <v-tab-item key="tab-1">
                    <template v-if="isFetchingResource">
                      <skeleton-edit-financial></skeleton-edit-financial>
                    </template>

                    <div v-show="isFinishedFetchingResource">
                      <v-card class="mb-3">
                        <v-card-title><span class="red--text mr-2">*</span> - Denotes compulsory items</v-card-title>
                        <v-card-title>{{ trans('Income Statement') }}</v-card-title>
                        <v-card-text style="overflow-x: auto;">
                          <v-simple-table style="min-width: 800px" class="transparent mb-3">
                            <tbody>
                              <tr style="vertical-align: top">
                                <td colspan="100%"></td>
                                <td><strong>{{ trans('Period 1') }}</strong></td>
                                <td><strong>{{ trans('Period 2') }}</strong></td>
                                <td><strong>{{ trans('Period 3') }}<br>{{ trans('(most recent)') }}</strong></td>
                              </tr>
                              <tr :key="i" v-for="(data, i) in resource.metadata['years']">
                                <td :colspan="data.length ? 1 : '100%'">
                                  <div class="year-label" v-html="trans(i)"></div>
                                </td>
                                <td :key="k" v-for="(d, k) in data">
                                  <v-text-field
                                    :disabled="isLoading"
                                    :name="`metadata[years][${i}][${k}]`"
                                    :label="trans(k)"
                                    class="dt-text-field"
                                    dense
                                    hide-details
                                    outlined
                                    v-model="resource.data.financials['years'][i][k]"
                                    >
                                  </v-text-field>
                                </td>
                              </tr>
                              <tr :key="i" v-for="(data, i) in resource.metadata['fps-qa1']">
                                <td :colspan="data.length ? 1 : '100%'" :class="{ compulsory: resource.checkIfCompulsoryItems( i ) }" v-html="trans(i)"></td>
                                <td :key="k" v-for="(d, k) in data">
                                  <v-text-field
                                    :disabled="isLoading"
                                    :name="`metadata[fps-qa1][${i}][${k}]`"
                                    class="dt-text-field"
                                    dense
                                    hide-details
                                    outlined
                                    v-model="resource.data.financials['fps-qa1'][i][k]"
                                    >
                                  </v-text-field>
                                </td>
                              </tr>
                              <!-- <tr :key="i" v-for="(data, i) in resource.metadata['financial-total']">
                                <td :colspan="data.length ? 1 : '100%'"><strong>Net Profit</strong></td>
                                <td :key="k" v-for="(d, k) in data">
                                  <v-text-field
                                    :disabled="isLoading"
                                    label="Total"
                                    class="dt-text-field"
                                    dense
                                    hide-details
                                    outlined
                                    v-model="resource.data.financials['financial-total'][i][k]"
                                    readonly
                                    >
                                  </v-text-field>
                                </td>
                              </tr> -->
                            </tbody>
                          </v-simple-table>
                        </v-card-text>
                      </v-card>
                      <v-card class="mb-3">
                        <v-card-title>{{ trans('Balance Sheet') }}</v-card-title>
                        <v-card-text style="overflow-x: auto;">
                          <v-simple-table style="min-width: 800px" class="transparent mb-3">
                            <tbody>
                              <tr style="vertical-align: top">
                                <td colspan="100%"></td>
                                <td><strong>{{ trans('Period 1') }}</strong></td>
                                <td><strong>{{ trans('Period 2') }}</strong></td>
                                <td><strong>{{ trans('Period 3') }}<br>{{ trans('(most recent)') }}</strong></td>
                              </tr>
                              <tr :key="i" v-for="(data, i) in resource.metadata['years']">
                                <td :colspan="data.length ? 1 : '100%'">
                                  <div class="year-label" v-html="trans(i)"></div>
                                </td>
                                <td :key="k" v-for="(d, k) in data">
                                  <v-text-field
                                    :disabled="isLoading"
                                    :name="`metadata[years][${i}][${k}]`"
                                    :label="trans(k)"
                                    class="dt-text-field"
                                    dense
                                    hide-details
                                    outlined
                                    v-model="resource.data.financials['years'][i][k]"
                                    >
                                  </v-text-field>
                                </td>
                              </tr>
                              <tr :key="i" v-for="(data, i) in resource.metadata['balance-sheet']">
                                <td :colspan="data.length ? 1 : '100%'" :class="{ compulsory: resource.checkIfCompulsoryItems( i ) }" v-html="trans(i)"></td>
                                <td :key="k" v-for="(d, k) in data">
                                  <v-text-field
                                    :disabled="isLoading"
                                    :name="`metadata[balance-sheet][${i}][${k}]`"
                                    class="dt-text-field"
                                    dense
                                    hide-details
                                    outlined
                                    v-model="resource.data.financials['balance-sheet'][i][k]"
                                    >
                                  </v-text-field>
                                </td>
                              </tr>
                              <!-- <tr :key="i" v-for="(data, i) in resource.metadata['balance-sheet-total']">
                                <td :colspan="data.length ? 1 : '100%'">
                                  <div class="year-label" v-html="trans(i)"></div>
                                </td>
                                <td :key="k" v-for="(d, k) in data">
                                  <v-text-field
                                    :disabled="isLoading"
                                    label="Total"
                                    class="dt-text-field"
                                    dense
                                    hide-details
                                    outlined
                                    v-model="resource.data.financials['balance-sheet-total'][i][k]"
                                    readonly
                                    >
                                  </v-text-field>
                                </td> -->
                              </tr>
                            </tbody>
                          </v-simple-table>
                        </v-card-text>
                      </v-card>
                    </div>
                  </v-tab-item>
                </template>
              </tabs>
            </v-card>
          </v-col>
        </v-row>
        <input type="hidden" name="user_id" :value="auth.id">
      </v-form>
    </validation-observer>
  </admin>
</template>

<script>
import $auth from '@/core/Auth/auth'
import $api from './routes/api'
import Company from './Models/Company'
import SendFinancialDataToCrmButton from './cards/SendFinancialDataToCrmButton'
import SkeletonEditCompany from './cards/SkeletonEditCompany'
import SkeletonEditFinancial from './cards/SkeletonEditFinancial'
import { mapGetters, mapActions } from 'vuex'

export default {
  beforeRouteLeave (to, from, next) {
    if (this.resource.isPrestine) {
      next()
    } else {
      this.askUserBeforeNavigatingAway(next)
    }
  },

  components: {
    SkeletonEditCompany,
    SkeletonEditFinancial,
    SendFinancialDataToCrmButton,
  },

  computed: {
    ...mapGetters({
      isDense: 'settings/fieldIsDense',
      shortkeyCtrlIsPressed: 'shortkey/ctrlIsPressed',
    }),
    isDesktop () {
      return this.$vuetify.breakpoint.mdAndUp
    },
    isInvalid () {
      return this.resource.isPrestine || this.resource.loading
    },
    isLoading () {
      return this.resource.loading
    },
    isFormDisabled () {
      return this.isInvalid || this.resource.isPrestine
    },
    isFormPrestine () {
      return this.resource.isPrestine
    },
    isNotFormPrestine () {
      return !this.isFormPrestine
    },
    isFetchingResource () {
      return this.loading
    },
    isFinishedFetchingResource () {
      return !this.loading
    },
  },

  data: (vm) => ({
    auth: $auth.getUser(),
    resource: new Company,
    loading: true,
    tabsModel: 1,
  }),

  methods: {
    ...mapActions({
      hideSidebar: 'sidebar/hide',
      hideAlertbox: 'alertbox/hide',
      hideDialog: 'dialog/hide',
      hideErrorbox: 'errorbox/hide',
      hideSnackbar: 'snackbar/hide',
      hideSuccessbox: 'successbox/hide',
      showAlertbox: 'alertbox/show',
      showDialog: 'dialog/show',
      showErrorbox: 'errorbox/show',
      showSnackbar: 'snackbar/show',
      showSuccessbox: 'successbox/show',
    }),

    askUserBeforeNavigatingAway (next) {
      this.showDialog({
        illustration: () => import('@/components/Icons/WorkingDeveloperIcon.vue'),
        title: trans('Unsaved changes will be lost'),
        text: trans('You have unsaved changes on this page. If you navigate away from this page, data will not be recovered.'),
        buttons: {
          cancel: {
            text: trans('Go Back'),
            callback: () => {
              this.hideDialog()
            },
          },
          action: {
            text: trans('Discard'),
            callback: () => {
              next()
              this.hideDialog()
            },
          },
        }
      })
    },

    askUserToDiscardUnsavedChanges () {
      this.showDialog({
        illustration: () => import('@/components/Icons/WorkingDeveloperIcon.vue'),
        title: trans('Discard changes?'),
        text: trans('You have unsaved changes on this page. If you navigate away from this page, data will not be recovered.'),
        buttons: {
          cancel: {
            text: trans('Cancel'),
            callback: () => {
              this.hideDialog()
            },
          },
          action: {
            text: trans('Discard'),
            callback: () => {
              this.hideDialog()
              this.$router.replace({name: 'companies.owned'})
            },
          },
        }
      })
    },

    load (val = true) {
      this.resource.loading = val
      this.loading = val
    },

    formIsChanged () {
      this.resource.isPrestine = false
    },

    parseResourceData (item) {
      let data = _.clone(item)
      let formData = new FormData(this.$refs['addform-form'].$el)

      formData.append('_method', 'post')

      data = formData

      return data
    },

    parseErrors (errors) {
      this.$refs['addform'].setErrors(errors)
      errors = Object.values(errors).flat()
      this.resource.hasErrors = errors.length
      return this.resource.errors
    },

    getParseErrors (errors) {
      errors = Object.values(errors).flat()
      this.resource.hasErrors = errors.length
      return errors
    },

    submitForm () {
      if (!this.isFormDisabled) {
        this.$refs['submit-button'].click()
        window.scrollTo({
          top: 0,
          left: 0,
          behavior: 'smooth',
        })
      }
    },

    submit (e) {
      this.load()
      e.preventDefault()

      axios.post(
        $api.store(),
        this.parseResourceData(this.resource.data),
      ).then(response => {
        this.resource.isPrestine = true

        this.showSnackbar({
          text: trans('Company created successfully'),
        })

        this.$router.push({
          name: 'companies.edit',
          params: {
            id: response.data.id
          },
          query: {
            success: true,
          },
        })

        this.showSuccessbox({
          text: trans('Created Company {name}', { name: response.data.name }),
          buttons: {
            show: {
              code: 'customers.show',
              to: { name: 'companies.show', params: { id: response.data.id } },
              icon: 'mdi-briefcase-search-outline',
              text: trans('Go to Survey Page'),
            },
            create: {
              code: 'customers.create',
              to: { name: 'companies.create' },
              icon: 'mdi-briefcase-plus-outline',
              text: trans('Add Another Company'),
            },
          },
        })
      }).catch(err => {
        if (err.response && err.response.status == Response.HTTP_UNPROCESSABLE_ENTITY) {
          let errorCount = _.size(err.response.data.errors)

          this.$refs['addform'].setErrors(err.response.data.errors)
          this.showErrorbox({
            text: trans(err.response.data.message),
            errors: err.response.data.errors,
          })
        }
      }).finally(() => { this.load(false) })
    },

    activateTab () {
      this.tabsModel = parseInt(this.$route.query.tab || 0)
    },

    calculateTotals () {
      let currentFinancialTotal = this.resource.data.financials[ 'financial-total' ].Total
      const financialTotal = this.resource.calculateThreeYears( this.resource.data.financials[ 'fps-qa1' ] )

      if( Object.entries( currentFinancialTotal ).toString() !== Object.entries( financialTotal ).toString() )
        this.resource.data.financials[ 'financial-total' ].Total = financialTotal

      let currentBalanceTotal = this.resource.data.financials[ 'balance-sheet-total' ].Total
      const balanceTotal = this.resource.calculateThreeYears( this.resource.data.financials[ 'balance-sheet' ] )

      if( Object.entries( currentBalanceTotal ).toString() !== Object.entries( balanceTotal ).toString() )
        this.resource.data.financials[ 'balance-sheet-total' ].Total = balanceTotal
    }
  },

  mounted () {
    this.hideSidebar()
    this.load(false)
    this.activateTab()
    // this.calculateTotals()
  },

  watch: {
    'resource.data': {
      handler (val) {
        this.resource.isPrestine = false
        this.resource.hasErrors = this.$refs.addform.flags.invalid

        // this.calculateTotals()

        if (!this.resource.hasErrors) {
          this.hideAlertbox()
        }
      },
      deep: true,
    },
  },
}
</script>
