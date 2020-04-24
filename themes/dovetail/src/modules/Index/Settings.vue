<template>
  <admin>
    <metatag :title="__('Taxonomy')"></metatag>

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
                  {{ trans('Save') }}
                </v-btn>
              </v-badge>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </template>

    <validation-observer ref="updateform" v-slot="{ handleSubmit, errors, invalid, passed }">
      <v-form :disabled="isLoading" ref="updateform-form" autocomplete="false" v-on:submit.prevent="handleSubmit(submit($event))" enctype="multipart/form-data">
        <button ref="submit-button" type="submit" class="d-none"></button>
        <page-header>
          <template v-slot:title>
            {{ trans('Taxonomy') }}
          </template>
        </page-header>

        <!-- Alertbox -->
        <alertbox></alertbox>
        <!-- Alertbox -->

        <v-row>
          <v-col cols="12">
            <template v-if="isFetchingResource">
              <skeleton-edit></skeleton-edit>
            </template>

            <div v-show="isFinishedFetchingResource" class="mb-3">
              <div v-for="(items, head) in resource.data" :key="head">
                <div class="mb-3">
                  <h3 class="mb-3" v-html="head"></h3>
                  <div v-for="item in items">
                    <v-row>
                      <v-col cols="12" md="6">
                        <p class="mb-0">{{ item.en }}</p>
                      </v-col>
                      <v-col cols="12" md="6">
                        <v-text-field
                          :dense="isDense"
                          :disabled="isLoading"
                          :label="trans('Arabic')"
                          class="dt-text-field"
                          outlined
                          :name="`translations[${item.en}][ar]`"
                          hide-details
                          v-model="item.ar"
                          >
                        </v-text-field>
                      </v-col>
                    </v-row>
                  </div>
                </div>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-form>
    </validation-observer>
  </admin>
</template>

<script>
import $api from './routes/api'
import SkeletonEdit from './cards/SkeletonEdit'
import SkeletonIcon from './cards/SkeletonIcon'
import { mapActions, mapGetters } from 'vuex'

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
    isFetchingResource () {
      return this.loading
    },
    isFinishedFetchingResource () {
      return !this.loading
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
    metaInfoCardList () {
      return [
        { icon: 'mdi-calendar', text: trans('Created :date', { date: this.resource.data.created }) },
        { icon: 'mdi-calendar-edit', text: trans('Modified :date', { date: this.resource.data.modified }) },
      ]
    },
  },

  components: {
    SkeletonEdit,
    SkeletonIcon
  },

  data: () => ({
    loading: true,
    resource: {
      data: []
    },
    isValid: true,
  }),

  methods: {
    ...mapActions({
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

    load (val = true) {
      this.resource.loading = val
      this.loading = val
    },

    parseResourceData (item) {
      let data = _.clone(item)

      let formData = new FormData(this.$refs['updateform-form'].$el)

      // formData.append('_method', 'put')

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
      this.$refs['submit-button'].click()
      window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth',
      })
    },

    submit (e) {
      this.load()
      this.hideAlertbox()
      e.preventDefault()

      axios.post(
        $api.translation(),
        this.parseResourceData(this.resource.data),
      ).then(response => {
        this.showSnackbar({
          text: trans('Index Settings updated successfully'),
        })

        this.$refs['updateform'].reset()
        this.resource.isPrestine = true
      }).catch(err => {
        if (err.response.status == Response.HTTP_UNPROCESSABLE_ENTITY) {
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
      axios.get(
        $api.translation()
      ).then(response => {
        this.resource.data = response.data
      }).finally(() => {
        this.load(false)
        this.resource.isPrestine = true
      })
    },
  },

  mounted () {
    this.getResource()
  },

  watch: {
    'resource.data': {
      handler (val) {
        this.resource.isPrestine = false
        this.resource.hasErrors = this.$refs.updateform.flags.invalid

        if (!this.resource.hasErrors) {
          this.hideAlertbox()
        }
      },
      deep: true,
    },
  },
}
</script>
