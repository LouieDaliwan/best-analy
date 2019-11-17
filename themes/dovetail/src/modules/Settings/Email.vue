<template>
  <section>
    <v-form
      @submit.prevent="saveEmail"
      method="POST"
      >
      <v-card
        flat
        class="sticky emphasis--bg toolbar-mobile"
        >
        <v-container grid-list-lg>
          <v-layout row wrap justify-space-between>
            <h1 class="display-1">
              {{ __('Email Options') }}
            </h1>
            <v-btn class="mx-0" color="secondary" type="submit">
              {{ __('Save') }}
            </v-btn>
          </v-layout>
        </v-container>
      </v-card>

      <!-- todo: move to sidebar -->
      <v-card flat class="transparent">
        <v-card-text>
          <v-btn exact :to="{name: 'settings.branding.general'}">Branding</v-btn>
        </v-card-text>
      </v-card>

      <v-card>

      </v-card>

      <v-container grid-list-lg>
        <v-layout row wrap>
          <v-flex xs12>
            <v-card>
              <v-card-text>
                <h1 class="subheading grey--text text--darken-1 mb-3 text-uppercase">
                  <strong>{{ __('Sender') }}</strong>
                </h1>

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('From Name') }}
                </h1>
                <v-text-field
                  box
                  name="mail_from_name"
                  single-line
                  v-model="resource.mail_from_name"
                  >
                </v-text-field>

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('From Email Address') }}
                </h1>
                <v-text-field
                  box
                  name="mail_from_address"
                  single-line
                  v-model="resource.mail_from_address"
                  >
                </v-text-field>
              </v-card-text>

              <v-card-text>
                <h1 class="subheading grey--text text--darken-1 mb-3 text-uppercase">
                  <strong>{{ __('Mail Setup') }}</strong>
                </h1>

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Driver') }}
                </h1>
                <v-text-field
                  box
                  name="mail_driver"
                  single-line
                  v-model="resource.mail_driver"
                  >
                </v-text-field>

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Host') }}
                </h1>
                <v-text-field
                  box
                  name="mail_host"
                  single-line
                  v-model="resource.mail_host"
                  >
                </v-text-field>

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Port') }}
                </h1>
                <v-text-field
                  box
                  name="mail_port"
                  single-line
                  v-model="resource.mail_port"
                  >
                </v-text-field>

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Username') }}
                </h1>
                <v-text-field
                  box
                  name="mail_username"
                  single-line
                  v-model="resource.mail_username"
                  >
                </v-text-field>

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Password') }}
                </h1>
                <v-text-field
                  box
                  name="mail_password"
                  single-line
                  type="password"
                  v-model="resource.mail_password"
                  >
                </v-text-field>

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Encryption') }}
                </h1>
                <v-text-field
                  box
                  name="mail_encryption"
                  single-line
                  v-model="resource.mail_encryption"
                  >
                </v-text-field>
              </v-card-text>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-form>
  </section>
</template>

<script>
import store from '@/store'

export default {
  store,
  name: 'Email',

  data () {
    return {
      resource: {}
    }
  },

  created() {
    axios
      .get('/api/v1/settings/email')
      .then((response) => {
        this.resource = response.data
      })
  },

  methods: {
    saveEmail() {
      axios
        .post('/api/v1/settings/store', this.resource)
        .then((response) => {
          this.$router.go({name: 'settings.email'})
        })
    },
  }
}
</script>
