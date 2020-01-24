<template>
  <admin>
    <metatag :title="resource.data.displayname"></metatag>
    <template v-slot:appbar>
      <v-container class="py-0 px-0">
        <v-row justify="space-between" align="center">
          <v-fade-transition>
            <v-col v-if="!resource.isPrestine" class="py-0" cols="auto">
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
                v-model="$store.getters['shortkey/ctrlIsPressed']"
                >
                <v-btn
                  :disabled="isUpdateDisabled"
                  :loading="resource.loading"
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

    <validation-observer ref="updateform" v-slot="{ handleSubmit, errors, invalid, passed }">
      <v-form :disabled="resource.loading" ref="updateform-form" autocomplete="false" v-on:submit.prevent="handleSubmit(submit($event))" enctype="multipart/form-data">
        <button ref="submit-button" type="submit" class="d-none"></button>
        <page-header :back="{ to: { name: 'users.index' }, text: trans('Users') }">
          <template v-slot:title>
            {{ trans('Edit User') }}
          </template>
        </page-header>

        <!-- Alertbox -->
        <alertbox>
          <template v-slot:utilities="{ type }">
            <template v-if="type === 'success'">
              <can code="users.show">
                <router-link tag="a" class="dt-link text--decoration-none mr-4" exact :to="{name: 'users.show', params: { id: $route.params.id }}">
                  <v-icon small left>mdi-account-search-outline</v-icon>
                  {{ trans('View user detail page') }}
                </router-link>
              </can>
              <can code="users.create">
                <router-link tag="a" class="dt-link text--decoration-none mr-4" exact :to="{name: 'users.create'}">
                  <v-icon small left>mdi-account-plus-outline</v-icon>
                  {{ trans('Create another user') }}
                </router-link>
              </can>
            </template>
          </template>
        </alertbox>
        <!-- Alertbox -->

        <v-row>
          <v-col cols="12" md="9">
            <v-card class="mb-3">
              <v-card-title>{{ trans('Account Information') }}</v-card-title>
              <v-card-text>
                <v-row justify="space-between">
                  <v-col cols="6" md="2">
                    <v-select :disabled="resource.loading" hide-details :label="trans('Prefix')" class="dt-text-field" background-color="selects" outlined dense :items="['Mr.', 'Ms.', 'Mrs.']" v-model="resource.data.prefixname"></v-select>
                    <input type="hidden" name="prefixname" v-model="resource.data.prefixname">
                  </v-col>
                  <v-col cols="6" md="2">
                    <v-text-field :disabled="resource.loading" hide-details :label="trans('Suffix')" class="dt-text-field" name="suffixname" outlined dense v-model="resource.data.suffixname"></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" md="4">
                    <validation-provider vid="firstname" :name="trans('first name')" rules="required" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
                        :disabled="resource.loading"
                        :error-messages="errors"
                        :label="trans('First name')"
                        autofocus
                        class="dt-text-field"
                        name="firstname"
                        outlined
                        prepend-inner-icon="mdi-account-outline"
                        v-model="resource.data.firstname"
                        >
                      </v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12" md="4">
                    <validation-provider vid="middlename" :name="trans('middle name')" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
                        :disabled="resource.loading"
                        :error-messages="errors"
                        :label="trans('Middle name')"
                        class="dt-text-field"
                        name="middlename"
                        outlined
                        v-model="resource.data.middlename"
                      ></v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12" md="4">
                    <validation-provider vid="lastname" :name="trans('last name')" rules="required" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
                        :disabled="resource.loading"
                        :error-messages="errors"
                        :label="trans('Last name')"
                        class="dt-text-field"
                        name="lastname"
                        outlined
                        v-model="resource.data.lastname"
                      ></v-text-field>
                    </validation-provider>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" md="6">
                    <birthday-picker v-model="resource.data.details['Birthday']"></birthday-picker>
                  </v-col>
                  <v-col cols="12" md="6">
                    <gender-picker
                      :items="resource.gender.items"
                      v-model="resource.data.details['Gender']"
                      >
                    </gender-picker>
                  </v-col>
                </v-row>
                <v-row align="center">
                  <v-col cols="12" md="6">
                    <validation-provider vid="details[Mobile Phone]" :name="trans('Mobile phone')" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
                        :disabled="resource.loading"
                        :error-messages="errors"
                        :label="trans('Mobile phone')"
                        class="dt-text-field"
                        name="details[Mobile Phone][value]"
                        outlined
                        prepend-inner-icon="mdi-cellphone-android"
                        v-model="resource.data.details['Mobile Phone'].value"
                        >
                      </v-text-field>
                    </validation-provider>
                    <input type="hidden" name="details[Mobile Phone][key]" :value="trans(resource.data.details['Mobile Phone'].key)">
                    <input type="hidden" name="details[Mobile Phone][icon]" :value="resource.data.details['Mobile Phone'].icon">
                  </v-col>
                  <v-col cols="12" md="6">
                    <marital-status-picker
                      :items="resource.maritalStatus.items"
                      v-model="resource.data.details['Marital Status']"
                      >
                    </marital-status-picker>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12">
                    <validation-provider vid="details[Home Address]" :name="trans('Home address')" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
                        :disabled="resource.loading"
                        :error-messages="errors"
                        :label="trans('Home address')"
                        class="dt-text-field"
                        name="details[Home Address][value]"
                        outlined
                        prepend-inner-icon="mdi-cellphone-android"
                        v-model="resource.data.details['Home Address'].value"
                        >
                      </v-text-field>
                    </validation-provider>
                    <input type="hidden" name="details[Home Address][key]" :value="trans(resource.data.details['Home Address'].key)">
                    <input type="hidden" name="details[Home Address][icon]" :value="resource.data.details['Home Address'].icon">
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>

            <can code="password.change">
            <account-details v-model="resource"></account-details>
            </can>

            <v-card>
              <v-card-title class="pb-0">{{ trans('Additional Background Details') }}</v-card-title>
              <v-card-text>
                <repeater :dense="isDense" :disabled="resource.loading" v-model="resource.data.details.others"></repeater>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="12" md="3">
            <v-card class="mb-3">
              <v-card-title class="pb-0">{{ __('Photo') }}</v-card-title>
              <v-card-text class="text-center">
                <upload-avatar name="photo" v-model="resource.data.avatar"></upload-avatar>
              </v-card-text>
            </v-card>

            <role-picker :dense="isDense" :disabled="resource.loading" class="mb-3" v-model="resource.data.roles"></role-picker>

            <v-card class="mb-3">
              <v-card-title>{{ __('Metainfo') }}</v-card-title>
              <v-card-text>
                <p class="muted--text" v-html="`Created ${resource.data.created}`"></p>
                <p class="muted--text" v-html="`Last modified ${resource.data.modified}`"></p>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-form>
    </validation-observer>
  </admin>
</template>

<script>
import $api from './routes/api'
import AccountDetails from './cards/AccountDetails'
import User from './Models/User'
import { mapGetters } from 'vuex'

export default {
  beforeRouteLeave (to, from, next) {
    if (this.resource.isPrestine) {
      next()
    } else {
      this.askUserBeforeNavigatingAway(next)
    }
  },

  components: {
    AccountDetails,
  },

  computed: {
    ...mapGetters({
      isDense: 'settings/fieldIsDense',
    }),
    isDesktop () {
      return this.$vuetify.breakpoint.mdAndUp
    },
    isInvalid () {
      return this.resource.isPrestine || this.resource.loading
    },
    isUpdateDisabled () {
      return this.isInvalid || this.resource.isPrestine
    },
  },

  data: () => ({
    resource: new User,
    isValid: true,
  }),

  methods: {
    askUserBeforeNavigatingAway (next) {
      this.$store.dispatch('dialog/show', {
        illustration: () => import('@/components/Icons/WorkingDeveloperIcon.vue'),
        title: trans('Unsaved changes will be lost'),
        text: trans('You have unsaved changes on this page. If you navigate away from this page, data will not be recovered.'),
        buttons: {
          cancel: {
            text: trans('Go Back'),
            callback: () => {
              this.$store.dispatch('dialog/close')
            },
          },
          action: {
            text: trans('Discard'),
            callback: () => {
              next()
              this.$store.dispatch('dialog/close')
            },
          },
        }
      })
    },

    askUserToDiscardUnsavedChanges () {
      this.$store.dispatch('dialog/show', {
        illustration: () => import('@/components/Icons/WorkingDeveloperIcon.vue'),
        title: trans('Discard changes?'),
        text: trans('You have unsaved changes on this page. If you navigate away from this page, data will not be recovered.'),
        buttons: {
          cancel: {
            text: trans('Cancel'),
            callback: () => {
              this.$store.dispatch('dialog/close')
            },
          },
          action: {
            text: trans('Discard'),
            callback: () => {
              this.resource.isPrestine = true
              this.$store.dispatch('dialog/close')
              this.$router.replace({name: 'users.index'})
            },
          },
        }
      })
    },

    beforeUserNavigatesAway (e) {
      // this.askUserBeforeNavigatingAway()
      // e.preventDefault()
      // e.returnValue = ''
    },

    load (val = true) {
      this.resource.loading = val
    },

    parseResourceData (item) {
      let data = _.clone(item)
      data.details = Object.assign({}, data.details, data.details.others || {})
      delete data.details.others

      let formData = new FormData(this.$refs['updateform-form'].$el)

      formData.append('username', data.username)
      formData.append('email', data.email)

      for (var i in data.details) {
        let c = data.details[i]
        let key = c.key
        let icon = c.icon
        let value = c.value == 'null' ? null : c.value
        formData.append(`details[${c.key}][key]`, key)
        formData.append(`details[${c.key}][icon]`, icon)
        formData.append(`details[${c.key}][value]`, value)
      }

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
      if (!this.isUpdateDisabled) {
        this.$refs['submit-button'].click()
        window.scrollTo({
          top: 0,
          left: 0,
          behavior: 'smooth',
        });
      }
    },

    submit (e) {
      this.load()
      e.preventDefault()
      this.$store.dispatch('alertbox/hide')

      // var formData = this.parseResourceData(this.resource.data)
      // for (var d of formData.entries()) {
      //  console.log(d[0], d[1])
      // }
      // return;

      axios.post(
        $api.update(this.resource.data.id),
        this.parseResourceData(this.resource.data),
      ).then(response => {
        this.$store.dispatch('snackbar/show', {
          text: trans('User updated successfully'),
        })

        this.$store.dispatch('alertbox/show', {
          type: 'success',
          text: this.$t('Updated user {name}', {name: this.resource.data.displayname})
        })

        this.$refs['updateform'].reset()
        this.resource.isPrestine = true
      }).catch(err => {
        if (err.response.status == Response.HTTP_UNPROCESSABLE_ENTITY) {
          let errorCount = _.size(err.response.data.errors)

          this.$refs['updateform'].setErrors(err.response.data.errors)
          this.$store.dispatch('alertbox/show', {
            text: this.$tc('There is {number} invalid field in this page', errorCount, {number: errorCount}),
            type: 'error',
            list: err.response.data.errors,
          })
        }
      }).finally(() => { this.load(false) })
    },

    getResource: function () {
      axios.get($api.show(this.$route.params.id))
        .then(response => {
          this.resource.data = Object.assign(response.data.data, { details: Object.assign(this.resource.data.details, response.data.data.details)})
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
          this.$store.dispatch('alertbox/hide')
        }
      },
      deep: true,
    },
  },
}
</script>
