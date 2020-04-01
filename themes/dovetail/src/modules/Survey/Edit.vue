<template>
  <admin>
    <metatag :title="resource.data.title"></metatag>

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

    <validation-observer ref="updateform" v-slot="{ handleSubmit, errors, invalid, passed }">
      <v-form :disabled="isLoading" ref="updateform-form" autocomplete="false" v-on:submit.prevent="handleSubmit(submit($event))" enctype="multipart/form-data">
        <button ref="submit-button" type="submit" class="d-none"></button>
        <page-header :back="{ to: { name: 'surveys.index' }, text: trans('Surveys') }">
          <template v-slot:title>
            {{ trans('Edit Survey') }}
          </template>
        </page-header>

        <!-- Alertbox -->
        <alertbox></alertbox>
        <!-- Alertbox -->

        <v-row>
          <v-col cols="12" md="9">
            <template v-if="isFetchingResource">
              <skeleton-edit></skeleton-edit>
            </template>

            <v-card v-show="isFinishedFetchingResource">
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
                    <v-text-field
                      :dense="isDense"
                      :disabled="isLoading"
                      :label="trans('Survey Title (arabic)')"
                      autofocus
                      class="dt-text-field"
                      name="metadata[title_arabic]"
                      outlined
                      v-model="resource.data.metadata.title_arabic"
                      >
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-textarea
                      :label="trans('Survey Description')"
                      auto-grow
                      class="dt-text-field"
                      hide-details
                      name="body"
                      outlined
                      v-model="resource.data.body"
                    ></v-textarea>
                  </v-col>
                  <v-col cols="12">
                    <v-textarea
                      :label="trans('Survey Description (arabic)')"
                      auto-grow
                      class="dt-text-field"
                      hide-details
                      name="metadata[body_arabic]"
                      outlined
                      v-model="resource.data.metadata.body_arabic"
                    ></v-textarea>
                  </v-col>
                </v-row>
                <input type="hidden" :value="slugify(resource.data.title)" name="code">
                <input type="hidden" name="type" value="survey">
                <input type="hidden" name="formable_type" value="Index\Models\Index">
                <input type="hidden" name="formable_id" :value="resource.data.surveys">
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
                <group-repeater :disabled="isLoading" v-model="resource.data.fields"></group-repeater>

                <template v-for="(group, g) in resource.data.fields">
                  <template v-for="(field, f) in group.children">
                    <input type="hidden" :name="`fields[${group.group+g+f}][id]`" :value="field.id">
                    <input type="hidden" :name="`fields[${group.group+g+f}][group]`" :value="group.group">
                    <input type="hidden" :name="`fields[${group.group+g+f}][type]`" value="likert">
                    <input type="hidden" :name="`fields[${group.group+g+f}][title]`" :value="field.title">
                    <input type="hidden" :name="`fields[${group.group+g+f}][code]`" :value="slugify(field.title || '')">
                    <input type="hidden" :name="`fields[${group.group+g+f}][metadata][total]`" :value="field.total">
                    <input type="hidden" :name="`fields[${group.group+g+f}][metadata][wts]`" :value="field.wts">
                    <input type="hidden" :name="`fields[${group.group+g+f}][metadata][comment]`" :value="field.comment">

                    <!-- Arabic -->
                    <input type="hidden" :name="`fields[${group.group+g+f}][metadata][group_arabic]`" :value="group.group_arabic">
                    <input type="hidden" :name="`fields[${group.group+g+f}][metadata][title_arabic]`" :value="field.title_arabic">
                    <input type="hidden" :name="`fields[${group.group+g+f}][metadata][comment_arabic]`" :value="field.comment_arabic">
                    <!-- Arabic -->

                    <!-- Categories -->
                    <input type="hidden" :name="`fields[${group.group+g+f}][metadata][category][Document]`" value="">
                    <input type="hidden" :name="`fields[${group.group+g+f}][metadata][category][Talent]`" value="">
                    <input type="hidden" :name="`fields[${group.group+g+f}][metadata][category][Technology]`" value="">
                    <input type="hidden" :name="`fields[${group.group+g+f}][metadata][category][Workflow Processes]`" value="">

                    <template v-for="category in field.categories">
                      <input type="hidden" :name="`fields[${group.group+g+f}][metadata][category][${category}]`" value="Y">
                    </template>
                    <!-- Categories -->
                  </template>
                </template>
              </v-card-text>
              <!-- Group and Field -->
            </v-card>
          </v-col>
          <v-col cols="12" md="3">
            <template v-if="isFetchingResource">
              <skeleton-index-picker></skeleton-index-picker>
            </template>
            <index-picker v-show="isFinishedFetchingResource" :dense="isDense" :disabled="isLoading" name="formable_id" v-model="resource.data.indices"></index-picker>

            <template v-if="isFetchingResource">
              <skeleton-metainfo-card></skeleton-metainfo-card>
            </template>
            <metainfo-card v-show="isFinishedFetchingResource" :list="metaInfoCardList"></metainfo-card>
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
import SkeletonEdit from './cards/SkeletonEdit'
import SkeletonIndexPicker from './cards/SkeletonIndexPicker'
import IndexPicker from './cards/IndexPicker'
import { mapActions, mapGetters } from 'vuex'

export default {
  beforeRouteLeave (to, from, next) {
    if (this.resource.isPrestine) {
      next()
    } else {
      this.askUserBeforeNavigatingAway(next)
    }
  },

  components: {
    IndexPicker,
    SkeletonEdit,
    SkeletonIndexPicker
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

  data: () => ({
    auth: $auth.getUser(),
    loading: true,
    resource: new Survey,
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
              this.$router.replace({name: 'surveys.index'})
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
          text: trans('Survey updated successfully'),
        })

        this.showSuccessbox({
          text: trans('Updated Survey {name}', { name: this.resource.data.title }),
          buttons: {
            show: {
              code: 'surveys.index',
              to: { name: 'surveys.index', params: { id: this.resource.data.id } },
              icon: 'mdi-account-search-outline',
              text: trans('View All Surveys'),
            },
            create: {
              code: 'surveys.create',
              to: { name: 'surveys.create' },
              icon: 'mdi-account-plus-outline',
              text: trans('Add New Survey'),
            },
          },
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

    getResource: function () {
      axios.get(
        $api.show(this.$route.params.id)
      ).then(response => {
        this.resource.data = Object.assign(this.resource.data, response.data.data)
        this.resource.data.metadata = Object.assign({}, this.resource.data.metadata)
        this.resource.data.indices = Object.assign([], [this.resource.data.formable_id])
        this.resource.data.fields = Object.values(
          this.resource.data['fields:grouped']
        ).map((i, k) => {
          return {
            group: i[0].group,
            group_arabic: i[0].metadata.group_arabic,
            type: i[0].type,
            children: i.map((j) => {
              let category = Object.keys(j.metadata['category']).filter(function (p) {
                return j.metadata['category'][p] == 'Y'
              })
              return {
                id: j.id,
                title: j.title,
                code: j.code,
                total: j.metadata['total'],
                wts: j.metadata['wts'],
                comment: j.metadata['comment'],
                comment_arabic: j.metadata['comment_arabic'],
                title_arabic: j.metadata['title_arabic'] || null,
                categories: category,
              }
            }),
          }
        })
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
