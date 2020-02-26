<template>
  <admin>
    <metatag :title="resource.data.name"></metatag>

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
                  {{ trans('Update') }}
                </v-btn>
              </v-badge>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </template>

    <v-form :disabled="isLoading" ref="updateform-form" autocomplete="false" v-on:submit.prevent="submit($event)">
      <button ref="submit-button" type="submit" class="d-none"></button>
      <page-header :back="{ to: { name: 'companies.index' }, text: trans('Companies') }">
        <template v-slot:title>
          {{ trans('Edit :name', {'name': `${resource.data.name}'s Input Data`}) }}
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
        <v-col cols="12" md="5">
          <h2 class="title mb-3">{{ trans('Company Information') }}</h2>
          <v-text-field
            :dense="isDense"
            :disabled="isLoading"
            :label="trans('Staff Strength')"
            autofocus
            class="dt-text-field"
            name="metadata[staffstrength]"
            outlined
            type="number"
            v-model="resource.data.metadata['staffstrength']"
            >
          </v-text-field>
          <v-text-field
            :dense="isDense"
            :disabled="isLoading"
            :label="trans('Industry')"
            class="dt-text-field"
            name="metadata[industry]"
            outlined
            v-model="resource.data.metadata['industry']"
            >
          </v-text-field>
        </v-col>
      </v-row>

      <!-- <v-row>
        <v-col cols="12" md="12">
          <h2 class="title">{{ trans('Financial Statement Input') }}</h2>
          <h4 class="subtitle mb-3">{{ trans('Quantitative Assessment 1') }}</h4>

          <v-simple-table class="transparent mb-3">
            <tbody>
              <tr>
                <td colspan="100%"></td>
                <td><strong>{{ trans('Year 1') }}</strong></td>
                <td><strong>{{ trans('Year 2') }}</strong></td>
                <td><strong>{{ trans('Year 3') }}</strong></td>
              </tr>
              <tr :key="i" v-for="(data, i) in resource.metadata['fps-qa1']">
                <td :colspan="data.length ? 1 : '100%'" v-html="trans(i)"></td>
                <td :key="k" v-for="(d, k) in data">
                  <v-text-field
                    :disabled="isLoading"
                    :name="`metadata[fps-qa1][${i}][${k}]`"
                    :value.sync="resource.metadata['fps-qa1'][i][k]"
                    class="dt-text-field"
                    dense
                    hide-details
                    outlined
                    >
                  </v-text-field>
                </td>
              </tr>
            </tbody>
          </v-simple-table>
        </v-col>
        <v-col cols="12" md="6">
          <h2 class="title">{{ trans('Financial Statement Input') }}</h2>
          <h4 class="subtitle mb-3">{{ trans('Quantitative Assessment 2') }}</h4>
        </v-col>
      </v-row> -->

    </v-form>

  </admin>
</template>

<script>
import $api from './routes/api'
import Company from './Models/Company'
import { mapGetters, mapActions } from 'vuex'

export default {
  beforeRouteLeave (to, from, next) {
    if (this.resource.isPrestine) {
      next()
    } else {
      this.askUserBeforeNavigatingAway(next)
    }
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
  },

  data: () => ({
    resource: new Company,
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
              this.$router.replace({name: 'companies.index'})
            },
          },
        }
      })
    },

    load (val = true) {
      this.resource.loading = val
    },

    parseResourceData (item) {
      let data = _.clone(item)
      let formData = new FormData(this.$refs['updateform-form'].$el)

      formData.append('_method', 'put')

      data = formData

      return data
    },

    parseErrors (errors) {
      this.$refs['updateform'].setErrors(errors)
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
        $api.update(this.resource.data.id),
        this.parseResourceData(this.resource.data),
      ).then(response => {
        this.showSnackbar({
          text: trans('Company updated successfully'),
        })

        this.showSuccessbox({
          text: trans('Company updated successfully'),
        })
      }).catch(err => {
        if (err.response && err.response.status == Response.HTTP_UNPROCESSABLE_ENTITY) {
          let errorCount = _.size(err.response.data.errors)

          this.$refs['updateform'].setErrors(err.response.data.errors)
          this.showErrorbox({
            text: trans(err.response.data.message),
            errors: err.response.data.errors,
          })
        }
      }).finally(() => { this.load(false) })
    },

    getResource () {
      this.resource.loading = true
      this.resource.isPrestine = false
      axios.get(
        $api.show(this.$route.params.id)
      ).then(response => {
        this.resource.data = response.data.data
        this.resource.metadata = _.merge({}, this.resource.metadata, this.resource.data.metadata)
        // console.log(this.resource.metadata)
      }).finally(() => { this.load(false) })
    },
  },

  mounted () {
    this.hideSidebar()
    this.getResource()
  },
}
</script>
