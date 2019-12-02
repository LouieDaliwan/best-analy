<template>
  <section>
    <v-form
      @submit.prevent="saveDisplay"
      method="POST"
      >
      <v-card
        flat
        class="sticky emphasis--bg toolbar-mobile"
        >
        <v-container grid-list-lg>
          <v-layout row wrap justify-space-between>
            <h1 class="display-1">
              {{ __('Displaying Data') }}
            </h1>
            <v-btn class="mx-0" color="secondary" type="submit">
              {{ __('Save') }}
            </v-btn>
          </v-layout>
        </v-container>
      </v-card>

      <v-container grid-list-lg>
        <v-layout row wrap>
          <v-flex xs12>
            <v-card>
              <v-card-text>
                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Global Date Format') }}
                </h1>
                <v-text-field
                  box
                  name="date_format"
                  placeholder="Date Format"
                  single-line
                  v-model="resource.date_format"
                  >
                </v-text-field>

                <h1 class="body-2 font-weight-bold mb-2">
                  {{ __('Items per Page') }}
                </h1>
                <v-text-field
                  box
                  name="items_per_page"
                  placeholder="Items per Page"
                  single-line
                  v-model="resource.items_per_page"
                  >
                </v-text-field>

                <v-checkbox
                  label="Center the main content when possible."
                  v-model="resource.center_main_content"
                  >
                </v-checkbox>
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
  name: 'Display',

  data () {
    return {
      resource: {}
    }
  },

  created() {
    axios
      .get('/api/v1/settings/display')
      .then((response) => {
        this.resource = response.data
      })
  },

  methods: {
    saveDisplay() {
      axios
        .post('/api/v1/settings/store', this.resource)
        .then((response) => {
          this.$router.go({name: 'settings.general.display'})
        })
    },
  }
}
</script>
