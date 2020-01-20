<template>
  <admin>
    <template v-slot:appbar>
      <v-container class="py-0 px-0">
        <v-row justify="space-between" align="center">
          <v-col v-if="isDesktop" class="py-0" cols="auto">
            <v-toolbar-title class="muted--text">{{ trans('Unsaved user') }}</v-toolbar-title>
          </v-col>

          <v-spacer></v-spacer>
          <v-col class="py-0" cols="auto">
            <div class="d-flex justify-end">
              <v-spacer></v-spacer>
              <v-btn text class="ml-3 mr-0" large>{{ trans('Discard') }}</v-btn>
              <v-btn
                :disabled="isInvalid"
                :loading="resource.loading"
                @click.prevent="submitForm"
                class="ml-3 mr-0"
                color="primary"
                large
                type="submit"
                >
                <v-icon left>mdi-content-save-outline</v-icon>
                {{ trans('Save') }}
              </v-btn>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </template>

    <validation-observer ref="addform" v-slot="{ handleSubmit, errors, invalid, passes }">
      <v-form ref="addform-form" autocomplete="false" v-on:submit.prevent="handleSubmit(submit($event))" enctype="multipart/form-data">
        <button ref="submit-button" type="submit" class="d-none"></button>
        <page-header :back="{ to: { name: 'users.index' }, text: trans('Users') }">
          <template v-slot:title>
            {{ trans('Add User') }}
          </template>
        </page-header>

        <!-- Alertbox -->
        <alertbox v-if="invalid"></alertbox>
        <!-- Alertbox -->

        <v-row>
          <v-col cols="12" md="9">
            <v-card class="mb-3">
              <v-card-title>{{ trans('Account Information') }}</v-card-title>
              <v-card-text>
                <v-row justify="space-between">
                  <v-col cols="6" md="2">
                    <v-select hide-details :label="trans('Prefix')" class="dt-text-field" background-color="selects" outlined dense :items="['Mr.', 'Ms.', 'Mrs.']" v-model="resource.data.prefixname"></v-select>
                    <input type="hidden" name="prefixname" v-model="resource.data.prefixname">
                  </v-col>
                  <v-col cols="6" md="2">
                    <v-text-field hide-details :label="trans('Suffix')" class="dt-text-field" name="suffixname" outlined dense v-model="resource.data.suffixname"></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" md="4">
                    <validation-provider vid="firstname" :name="trans('first name')" rules="required" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
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
                    <birthday-picker v-model="resource.data.details['Birthday'].value"></birthday-picker>
                  </v-col>
                  <v-col cols="12" md="6">
                    <gender-picker
                      :items="resource.gender.items"
                      v-model="resource.data.details['Gender']"
                      >
                    </gender-picker>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12">
                    <marital-status-picker
                      :items="resource.maritalStatus.items"
                      v-model="resource.data.details['Marital Status']"
                      >
                    </marital-status-picker>
                  </v-col>
                </v-row>
              </v-card-text>

              <v-card-title>{{ trans('Account Details') }}</v-card-title>
              <v-card-subtitle class="muted--text">{{ trans('Fields will be used to sign in to the app') }}</v-card-subtitle>
              <v-card-text>
                <v-row>
                  <v-col cols="12">
                    <validation-provider vid="email" :name="trans('email address')" rules="required|email" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
                        :error-messages="errors"
                        :label="trans('Email address')"
                        class="dt-text-field"
                        name="email"
                        outlined
                        type="email"
                        v-model="resource.data.email"
                        >
                      </v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12">
                    <validation-provider vid="username" :name="trans('username')" rules="required|min:3" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
                        :error-messages="errors"
                        :label="trans('Username')"
                        autocomplete="off"
                        class="dt-text-field"
                        name="username"
                        outlined
                        v-model="resource.data.username"
                        >
                      </v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12" md="6">
                    <validation-provider vid="password" :name="trans('password')" rules="required|min:6" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
                        :error-messages="errors"
                        :label="trans('Password')"
                        autocomplete="new-password"
                        class="dt-text-field"
                        name="password"
                        outlined
                        ref="password"
                        type="password"
                        v-model="resource.data.password"
                        >
                      </v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col cols="12" md="6">
                    <validation-provider vid="password_confirmation" :name="trans('confirm password')" rules="required|confirmed:password|min:6" v-slot="{ errors }">
                      <v-text-field
                        :dense="isDense"
                        :error-messages="errors"
                        :label="trans('Retype Password')"
                        autocomplete="new-password"
                        class="dt-text-field"
                        name="password_confirmation"
                        outlined
                        type="password"
                        v-model="resource.data.password_confirmation"
                        >
                      </v-text-field>
                    </validation-provider>
                  </v-col>
                </v-row>
              </v-card-text>
            </v-card>

            <v-card>
              <v-card-title class="pb-0">{{ trans('Additional Background Details') }}</v-card-title>
              <v-card-text>
                <v-row align="center">
                  <v-col cols="12" md="4">
                    <v-text-field
                      :dense="isDense"
                      :prepend-inner-icon="resource.data.details['Mobile Phone']['icon']"
                      class="dt-text-field"
                      disabled
                      hide-details
                      outlined
                      v-model="resource.data.details['Mobile Phone']['key']"
                      >
                    </v-text-field>
                  </v-col>
                  <v-col cols="12" md="8">
                    <v-text-field
                      :dense="isDense"
                      class="dt-text-field"
                      hide-details
                      outlined
                      v-model="resource.data.details['Mobile Phone']['value']"
                    ></v-text-field>
                  </v-col>
                </v-row>

                <v-row>
                  <v-col cols="12" md="4">
                    <v-text-field
                      :dense="isDense"
                      :prepend-inner-icon="resource.data.details['Home Address']['icon']"
                      class="dt-text-field"
                      disabled
                      hide-details
                      outlined
                      v-model="resource.data.details['Home Address']['key']"
                      >
                    </v-text-field>
                  </v-col>
                  <v-col cols="12" md="8">
                    <v-text-field
                      :dense="isDense"
                      class="dt-text-field"
                      hide-details
                      outlined
                      v-model="resource.data.details['Home Address']['value']"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <repeater :dense="isDense" v-model="resource.data.details.more"></repeater>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="12" md="3">
            <v-card class="mb-3">
              <v-card-title class="pb-0">{{ __('Photo') }}</v-card-title>
              <v-card-text class="text-center">
                <upload-avatar name="photo" v-model="resource.data.photo"></upload-avatar>
              </v-card-text>
            </v-card>

            <role-picker lazy-load :dense="isDense" class="mb-3" v-model="resource.data.roles"></role-picker>

            <v-card class="mb-3">
              <v-card-title>{{ __('Metainfo') }}</v-card-title>
              <v-card-text>{{ trans('No information available') }}</v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-form>
    </validation-observer>
  </admin>
</template>

<script>
import User from './Models/User'
import $api from './routes/api'
import { mapGetters } from 'vuex'

export default {
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
  },

  data: () => ({
    resource: new User,
  }),

  methods: {
    load (val = true) {
      this.resource.loading = val
    },

    parseResourceData (data) {
      data.details = Object.assign({}, data.details, data.details.more || {})
      delete data.details.more

      let formData = new FormData(this.$refs['addform-form'].$el)

      for (var i in data.details) {
        let c = data.details[i]
        formData.append(`details[${c.key}][key]`, c.key)
        formData.append(`details[${c.key}][value]`, c.value)
        formData.append(`details[${c.key}][icon]`, c.icon)
      }

      data = formData

      return data
    },

    parseErrors (errors) {
      this.$refs['addform'].setErrors(errors)
      errors = Object.values(errors).flat()
      this.resource.hasErrors = errors.length
      return errors
    },

    submitForm () {
      this.$refs['submit-button'].click()
    },

    submit (e) {
      this.load()
      e.preventDefault()
      this.$store.dispatch('alertbox/hide')
      axios.post(
        $api.store(),
        this.parseResourceData(this.resource.data),
        { headers: {'Content-Type': 'multipart/form-data'} }
      ).then(response => {
        this.$store.dispatch('snackbar/show', {
          text: trans('User created successfully'),
        })

        this.$router.push({
          name: 'users.edit',
          params: {
            id: response.data.data.id
          },
        })

        this.$store.dispatch('alertbox/show', {
          type: 'success',
          text: this.$t('Created user {name}', {name: response.data.data.displayname})
        })
      }).catch(err => {
        if (err.response.status == Response.HTTP_UNPROCESSABLE_ENTITY) {
          let errorCount = _.size(err.response.data.errors)

          this.$refs['addform'].setErrors(err.response.data.errors)
          this.$store.dispatch('alertbox/show', {
            text: this.$tc('There is {number} invalid field in this page', errorCount, {number: errorCount}),
            type: 'error',
            list: err.response.data.errors,
          })
        }
      }).finally(() => {
        this.load(false)
      })
    },
  },

  watch: {
    'resource.data': {
      handler (val) {
        this.resource.isPrestine = false
      },
      deep: true,
    },
  },
}
</script>
