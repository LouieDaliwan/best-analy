<template>
  <admin>
    <metatag :title="resource.data.displayname"></metatag>
    <template v-slot:appbar>
      <v-container class="py-0 px-0">
        <v-row justify="space-between" align="center">
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
                {{ trans('Update') }}
              </v-btn>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </template>

    <validation-observer ref="updateform" v-slot="{ handleSubmit, errors, invalid, passes }">
      <v-form ref="updateform-form" autocomplete="false" v-on:submit.prevent="handleSubmit(submit($event))" enctype="multipart/form-data">
        <button ref="submit-button" type="submit" class="d-none"></button>
        <page-header :back="{ to: { name: 'users.index' }, text: trans('Users') }">
          <template v-slot:title>
            {{ trans('Edit User') }}
          </template>
        </page-header>

        <!-- Alertbox -->
        <alertbox>
          <template v-slot:actions="{ type }">
            <template v-if="type === 'success'">
              <router-link tag="a" class="dt-link text--decoration-none mr-4" exact :to="{name: 'users.trashed'}">
                <v-icon small left>mdi-account-off-outline</v-icon>
                {{ trans('Deactivated Users') }}
              </router-link>
            </template>
          </template>
        </alertbox>
        <!-- Alertbox -->

        <v-row>
          <v-col cols="12" md="9">
            <v-card class="mb-3">
              <v-card-title>{{ trans('Personal Information') }}</v-card-title>
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
            </v-card>

            <!-- <can code="password.change"> -->
            <account-details v-model="resource"></account-details>
            <!-- </can> -->

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

            <role-picker :dense="isDense" class="mb-3" v-model="resource.data.roles"></role-picker>

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
  },

  data: () => ({
    resource: User,
  }),

  methods: {
    load (val = true) {
      this.resource.loading = val
    },

    parseResourceData (data) {
      data.details = Object.assign({}, data.details, data.details.more || {})
      delete data.details.more

      let formData = new FormData(this.$refs['updateform-form'].$el)

      formData.append('username', data.username)
      formData.append('email', data.email)

      for (var i in data.details) {
        let c = data.details[i]
        formData.append(`details[${c.key}][key]`, c.key)
        formData.append(`details[${c.key}][value]`, c.value)
        formData.append(`details[${c.key}][icon]`, c.icon)
      }

      formData.append('_method', 'put')

      data = formData

      // for (var d of formData.entries()) {
      //  console.log(d[0], d[1])
      // }

      return data
    },

    parseErrors (errors) {
      this.$refs['updateform'].setErrors(errors)
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

      // this.parseResourceData(this.resource.data)
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
      }).catch(err => {
        console.log(err.response)
        if (err.response.status == Response.HTTP_UNPROCESSABLE_ENTITY) {
          let errorCount = _.size(err.response.data.errors)

          this.$refs['updateform'].setErrors(err.response.data.errors)
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

    getResource: function () {
      axios.get($api.show(this.$route.params.id))
        .then(response => {
          this.resource.data = response.data.data
          this.resource.isPrestine = true
        }).finally(() => { this.resource.loading = false })
    },
  },

  mounted () {
    this.getResource()
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
