<template>
  <section>
    <v-container grid-list-lg>
      <v-layout row wrap justify-center align-center>
        <v-flex xs12>
          <v-card flat class="transparent">
            <v-card-text>
              <p class="mb-2">
                {{ __('Listed here are the system specific informations of your application.') }}
              </p>
              <p class="mb-2">
                {{ __('Some are configurable while others are either read-only or editable only on the server.') }}
              </p>

              <!-- create api for app/debug -->
              <div class="py-3">
                <v-alert
                  :value="true"
                  type="error"
                  class="red lighten-1"
                  dismissible
                  transition="slide-y-transition"
                  >
                  {{ __('You are in debug mode. Set environment to `production` and debug to `off` if deployed on a live server.') }}
                </v-alert>
              </div>
            </v-card-text>
          </v-card>

          <v-card flat class="transparent">
            <v-card-text>
              <application></application>
            </v-card-text>

            <v-card-text>
              <theme></theme>
            </v-card-text>

            <v-card-text>
              <profile></profile>
            </v-card-text>

            <v-card-text>
              <server></server>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </section>
</template>

<script>
import store from '@/store'
import Application from './widgets/Application.vue'
import Theme from './widgets/Theme.vue'
import Profile from './widgets/Profile.vue'
import Server from './widgets/Server.vue'

export default {
  store,
  name: 'System',

  components: {
    Application,
    Theme,
    Profile,
    Server,
  },

  data () {
    return {
      resource: {}
    }
  },

  created() {
    axios
      .get('/api/v1/settings/system')
      .then((response) => {
        this.resource = response.data
      })
  },
}
</script>
