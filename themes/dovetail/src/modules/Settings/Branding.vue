<template>
  <section>
    <v-form
      @submit.prevent="saveBranding"
      method="POST"
      >
      <v-card
        flat
        class="sticky emphasis--bg toolbar-mobile"
        >
        <v-container grid-list-lg>
          <v-layout row wrap justify-space-between>
            <h1 class="display-1">
              {{ __('Branding') }}
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
          <v-btn exact :to="{name: 'settings.branding.email'}">{{ __('Email') }}</v-btn>
        </v-card-text>
      </v-card>

      <v-container grid-list-lg>
        <v-layout row wrap>
          <v-flex md9 xs12>
            <v-card>
              <v-card-text>
                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Site Name') }}
                </h1>
                <v-text-field
                  box
                  name="site_title"
                  placeholder="Site Name"
                  single-line
                  v-model="resource.site_title"
                  >
                </v-text-field>

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Site Tagline / Description') }}
                </h1>
                <v-text-field
                  box
                  name="site_tagline"
                  placeholder="Site Tagline"
                  single-line
                  v-model="resource.site_tagline"
                  >
                </v-text-field>

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Site Author') }}
                </h1>
                <v-text-field
                  box
                  name="site_author"
                  placeholder="Site Author"
                  single-line
                  v-model="resource.site_author"
                  >
                </v-text-field>

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Site Email') }}
                </h1>
                <v-text-field
                  box
                  name="site_email"
                  placeholder="Site Email"
                  single-line
                  v-model="resource.site_email"
                  >
                </v-text-field>

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Year Established') }}
                </h1>
                <v-text-field
                  box
                  name="site_year"
                  placeholder="Year Established"
                  single-line
                  v-model="resource.site_year"
                  >
                </v-text-field>
              </v-card-text>
            </v-card>
          </v-flex>

          <v-flex md3 xs12>
            <v-card height="300" class="upload-image emphasis--border">
              <v-card-text>
                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Site Logo') }}
                </h1>
              </v-card-text>
              <v-card-text>
                {{ __('Upload Logo') }}
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
  name: 'Branding',

  data () {
    return {
      resource: {}
    }
  },

  created() {
    axios
      .get('/api/v1/settings/branding')
      .then((response) => {
        this.resource = response.data
      })
  },

  methods: {
    saveBranding() {
      axios
        .post('/api/v1/settings/store', this.resource)
        .then((response) => {
          this.$router.go({name: 'settings.branding.general'})
        })
    },
  }
}
</script>
