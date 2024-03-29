<template>
  <admin>
    <metatag :title="trans('Add Team')"></metatag>
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
      <v-form :disabled="isLoading" ref="addform-form" autocomplete="false" v-on:submit.prevent="handleSubmit(submit($event))">
        <button ref="submit-button" type="submit" class="d-none"></button>
        <page-header :back="{ to: { name: 'teams.index' }, text: trans('Teams') }">
          <template v-slot:title>{{ trans('Add Team') }}</template>
        </page-header>

        <!-- Alertbox -->
        <alertbox></alertbox>
        <!-- Alertbox -->

        <v-row>
          <v-col cols="12">
            <v-card class="mb-3">
              <v-card-text>
                <v-row>
                  <v-col cols="12">
                    <validation-provider vid="name" :name="trans('name')" rules="required" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
                        :disabled="isLoading"
                        :error-messages="errors"
                        :label="trans('Name')"
                        autofocus
                        class="dt-text-field"
                        name="name"
                        outlined
                        v-model="resource.data.name"
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
                        :label="trans('Code')"
                        :value="slugify(resource.data.name)"
                        class="dt-text-field"
                        name="code"
                        outlined
                      ></v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12">
                    <validation-provider vid="manager_id" rules="required" :name="trans('manager_id')" v-slot="{ errors }">
                      <manager-picker
                        :dense="isDense"
                        :disabled="isLoading"
                        name="manager_id"
                        v-model="resource.managers"
                      ></manager-picker>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12">
                    <v-textarea
                      :label="trans('Description')"
                      auto-grow
                      class="dt-text-field"
                      hide-details
                      name="description"
                      outlined
                    ></v-textarea>
                  </v-col>
                  <input type="hidden" name="user_id" :value="auth.id">
                </v-row>
              </v-card-text>

              <div class="d-flex mb-4">
                <v-divider></v-divider>
                <v-icon small color="muted" class="mx-3 mt-n2">mdi-account-settings</v-icon>
                <v-divider></v-divider>
              </div>

              <v-row>
                <v-col class="pt-0">
                  <v-card-text class="pt-0">
                    <h4 class="mb-5" v-text="trans('Select Members')"></h4>
                    <treeview-field v-model="search"></treeview-field>
                    <validation-provider vid="users" name="users[]" rules="required" v-slot="{ errors }">
                      <v-card-text :key="item" class="error--text" v-html="item" v-for="item in errors"></v-card-text>
                    </validation-provider>
                    <treeview-pagination
                      :items="resource.users"
                      :search="search"
                      :selectable="true"
                      v-model="resource.selected"
                    ></treeview-pagination>

                    <input type="hidden" v-for="item in resource.selected" name="users[]" :value="item.id">
                  </v-card-text>
                </v-col>

                <v-divider vertical class="d-none d-md-block"></v-divider>

                <v-col cols="12" md="6" class="pt-0">
                  <v-card-text v-if="resource.selected.length" class="pt-0">
                    <h4 class="mb-5" v-text="trans('Selected Members')"></h4>
                    <v-scroll-x-transition mode="in-out">
                      <div>
                        <v-scroll-x-transition group mode="in-out">
                          <div v-for="(member, i) in resource.selected" :key="i">
                            <div :class="{'d-none': member.active}" class="py-3 px-4">
                              <v-avatar class="mr-6" size="32" color="workspace">
                                <v-img :src="member.avatar"></v-img>
                              </v-avatar>
                              <span v-text="member.displayname"></span>
                            </div>
                          </div>
                        </v-scroll-x-transition>
                      </div>
                    </v-scroll-x-transition>
                  </v-card-text>
                  <v-card-text class="text-center" v-else>
                    <v-scroll-x-transition mode="out-in">
                      <div>
                        <checklist-icon height="100" class="primary--text" style="filter: grayscale(0.8) brightness(150%);"></checklist-icon>
                        <p class="muted--text pa-3">
                          {{ trans('Select members from the list to view details') }}
                        </p>
                      </div>
                    </v-scroll-x-transition>
                  </v-card-text>
                </v-col>
              </v-row>
            </v-card>
          </v-col>
        </v-row>
      </v-form>
    </validation-observer>
  </admin>
</template>

<script>
import $auth from '@/core/Auth/auth'
import $api from './routes/api'
import Team from './Models/Team'
import { mapActions, mapGetters } from 'vuex'

export default {
  beforeRouteLeave (to, from, next) {
    if (this.isFormPrestine) {
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
    filter () {
      return undefined
    },
  },

  data: () => ({
    auth: $auth.getUser(),
    resource: new Team,
    search: '',
    searchSelectedMember: '',
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
              this.$router.replace({ name: 'teams.index' })
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

    displayUsersList () {
      axios.get(
        $api.users.list(), { params: { per_page: '-1' } }
      ).then(response => {
        this.resource.users = Object.assign([], this.resource.users, response.data.data)
        this.resource.usersTotal = response.data.meta.last_page
        this.resource.users = this.resource.users.map(function (item, i) {
          return Object.assign(item, {
            key: item.id,
            name: item.displayname+' '+item.username+' '+item.email,
            order: i,
          })
        })
      })
    },

    submit (e) {
      this.load()
      e.preventDefault()
      this.hideAlertbox()

      axios.post(
        $api.store(), this.parseResourceData(this.resource.data)
      ).then(response => {
        this.resource.isPrestine = true

        this.showSnackbar({
          text: trans('Team created successfully'),
        })

        this.$router.push({
          name: 'teams.edit',
          params: {
            id: response.data.id
          },
          query: {
            success: true,
          },
        })

        this.showSuccessbox({
          text: trans('Created Team {name}', { name: response.data.name }),
          buttons: {
            show: {
              code: 'teams.index',
              to: { name: 'teams.index', params: { id: response.data.id } },
              icon: 'mdi-open-in-new',
              text: trans('View All Teams'),
            },
            create: {
              code: 'teams.create',
              to: { name: 'teams.create' },
              icon: 'mdi-shield-plus-outline',
              text: trans('Add New Team'),
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

  mounted () {
    this.displayUsersList()
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
