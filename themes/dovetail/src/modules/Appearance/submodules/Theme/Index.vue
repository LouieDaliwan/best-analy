<template>
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex xs12>
        <div class="mb-4">
          <h1 class="headline font-weight-bold">
            {{ __('Themes') }}
          </h1>
        </div>
      </v-flex>
      <template
        v-for="(resource, i) in resources.items"
        >
        <v-flex
          :key= "i"
          md4 sm6 xs12
          >
          <v-card :id="resource.code">
            <v-img
              class=""
              height="300"
              :src="resource.thumbnail"
              gradient="to top right, rgba(100,115,201,.45), rgba(25,32,72,.3)"
              >
              <v-container fluid fill-height>
                <v-layout row wrap justify-center align-start>
                  <v-card-text class="white--text">
                    <h3 class="mb-2" v-html="resource.name"></h3>
                    <p class="caption font-weight-bold">
                      <span>{{ __('Theme by: ') }} {{ resource.author.name }}</span>
                    </p>
                    <p v-html="resource.description"></p>
                  </v-card-text>
                </v-layout>
              </v-container>
            </v-img>
            <v-card-actions class="pa-3">
              <template v-if="resource.active">
                <v-btn flat disabled color="secondary">
                  {{ __('Currently Active') }}
                </v-btn>
              </template>
              <template v-else>
                <v-form
                  @submit.prevent="saveTheme({active_theme: resource.code})"
                  method="POST"
                  >
                  <input
                    type="hidden"
                    name="active_theme"
                    v-model="resource.code"
                    >
                  <v-btn
                    color="secondary"
                    flat
                    type="submit"
                    >
                    {{ __('Activate') }}
                  </v-btn>
                </v-form>
              </template>
              <v-spacer></v-spacer>
              <v-btn flat>
                {{ __('Details') }}
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </template>
    </v-layout>
  </v-container>
</template>

<script>
import store from '@/store'

export default {
  store,
  name: 'Index',

  data () {
    return {
      resources: {
        items: []
      },
      resource: {}
    }
  },

  created () {
    axios
      .get('/api/v1/themes/all')
      .then(response => {
        this.resources.items = response.data
      })
  },

  methods: {
    saveTheme(data) {
      axios
        .post('/api/v1/settings/store', data)
        .then((response) => {
          if (response.data == 'success') {
            this.$router.go({name: 'appearance.themes'})
          }
        })
    }
  },
}
</script>
