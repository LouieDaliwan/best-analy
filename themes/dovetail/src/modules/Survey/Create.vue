<template>
  <admin>
    <metatag :title="trans('Add Survey')"></metatag>

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
      <v-form :disabled="isLoading" ref="addform-form" autocomplete="false" v-on:submit.prevent="handleSubmit(submit($event))" enctype="multipart/form-data">
        <button ref="submit-button" type="submit" class="d-none"></button>
        <page-header :back="{ to: { name: 'surveys.index' }, text: trans('Surveys') }">
          <template v-slot:title>{{ trans('Add Survey') }}</template>
        </page-header>

        <!-- Alertbox -->
        <alertbox></alertbox>
        <!-- Alertbox -->

        <v-row>
          <v-col cols="12" md="9">
            <v-card>
              <v-card-text>
                <v-row>
                  <v-col cols="12">
                    <validation-provider vid="title" :name="trans('title')" rules="required" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
                        :disabled="isLoading"
                        :error-messages="errors"
                        :label="trans('Survey Title')"
                        autofocus
                        class="dt-text-field"
                        name="title"
                        outlined
                        v-model="resource.data.title"
                        >
                      </v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12">
                    <validation-provider vid="code" rules="required" :name="trans('code')" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
                        :disabled="isLoading"
                        :error-messages="errors"
                        :label="trans('Survey Code')"
                        :value="slugify(resource.data.title)"
                        class="dt-text-field"
                        name="code"
                        outlined
                      ></v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12">
                    <v-textarea
                      :label="trans('Survey Description')"
                      auto-grow
                      class="dt-text-field"
                      hide-details
                      name="body"
                      outlined
                    ></v-textarea>
                  </v-col>
                </v-row>
                <input type="hidden" name="type" value="survey">
                <input type="hidden" name="formable_type" value="Index\Models\Index">
                <input type="hidden" name="formable_id" :value="resource.data.indices">
                <input type="hidden" name="user_id" :value="auth.id">
              </v-card-text>

              <!-- Divider -->
              <div class="d-flex my-6">
                <v-divider></v-divider>
                <span class="muted--text mx-3 mt-n3"><strong>{{ trans('Fields') }}</strong></span>
                <v-divider></v-divider>
              </div>
              <!-- Divider -->

              <!-- Group and Field -->
              <v-card-text class="selects">
                <group-repeater :fields="1" :disabled="isLoading" v-model="resource.data.fields"></group-repeater>

                <template v-for="(group, g) in resource.data.fields">
                  <template v-for="(field, f) in group.children">
                    <input type="hidden" :name="`fields[${group.group+g+f}][group]`" :value="group.group">
                    <input type="hidden" :name="`fields[${group.group+g+f}][type]`" value="likert">
                    <input type="hidden" :name="`fields[${group.group+g+f}][title]`" :value="field.title">
                    <input type="hidden" :name="`fields[${group.group+g+f}][code]`" :value="slugify(field.title)">
                    <input type="hidden" :name="`fields[${group.group+g+f}][metadata][total]`" :value="field.total">
                    <input type="hidden" :name="`fields[${group.group+g+f}][metadata][wts]`" :value="field.wts">
                  </template>
                </template>
              </v-card-text>
              <!-- Group and Field -->
            </v-card>
          </v-col>

          <v-col cols="12" md="3">
            <index-picker :dense="isDense" :disabled="isLoading" name="formable_id" v-model="resource.data.indices"></index-picker>
          </v-col>
        </v-row>
      </v-form>
    </validation-observer>
  </admin>
</template>

<script>
import $auth from '@/core/Auth/auth'
import $api from './routes/api'
import Survey from './Models/Survey'
import IndexPicker from './cards/IndexPicker'
import { mapActions, mapGetters } from 'vuex'

export default {
  beforeRouteLeave (to, from, next) {
    if (this.isFormPrestine) {
      next()
    } else {
      this.askUserBeforeNavigatingAway(next)
    }
  },

  components: {
    IndexPicker
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
    isNotFormDisabled () {
      return !this.isFormDisabled
    },
    isFormPrestine () {
      return this.resource.isPrestine
    },
    isNotFormPrestine () {
      return !this.isFormPrestine
    },
    form () {
      return this.$refs['addform']
    },
  },

  data: () => ({
    auth: $auth.getUser(),
    resource: new Survey,
  }),

  methods: {
    ...mapActions({
      showAlertbox: 'alertbox/show',
      hideAlertbox: 'alertbox/hide',
      showDialog: 'dialog/show',
      hideDialog: 'dialog/hide',
      showSnackbar: 'snackbar/show',
      hideSnackbar: 'snackbar/hide',
      showSuccessbox: 'successbox/show',
      hideSuccessbox: 'successbox/hide',
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
              this.resource.isPrestine = true
              this.hideDialog()
              this.$router.replace({ name: 'surveys.index' })
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
      let formData = new FormData(this.$refs['addform-form'].$el)

      data = formData

      return data
    },

    parseErrors (errors) {
      this.form.setErrors(errors)
      errors = Object.values(errors).flat()
      this.resource.hasErrors = errors.length
      return errors
    },

    submitForm () {
      if (this.isNotFormDisabled) {
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
      this.hideAlertbox()

      axios.post(
        $api.store(), this.parseResourceData(this.resource.data)).then(response => {
        this.resource.isPrestine = true

        this.showSnackbar({
          text: trans('Survey created successfully'),
        })

        this.$router.push({
          name: 'surveys.edit',
          params: {
            id: response.data.id
          },
          query: {
            success: true,
          },
        })

        this.showSuccessbox({
          text: trans('Created Survey {name}', { name: response.data.title }),
          buttons: {
            show: {
              code: 'surveys.show',
              to: { name: 'surveys.show', params: { id: response.data.id } },
              icon: 'mdi-open-in-new',
              text: trans('View Details'),
            },
            create: {
              code: 'surveys.create',
              to: { name: 'surveys.create' },
              icon: 'mdi-shield-plus-outline',
              text: trans('Add New Survey'),
            },
          },
        })
      }).catch(err => {
        this.form.setErrors(err.response.data.errors)
      }).finally(() => {
        this.load(false)
      })
    },
  },

  watch: {
    'resource.data': {
      handler (val) {
        this.resource.isPrestine = false
        this.resource.hasErrors = this.$refs.addform.flags.invalid
        if (!this.resource.hasErrors) {
          this.hideAlertbox()
        }
      },
      deep: true,
    },
  },
}
</script>
