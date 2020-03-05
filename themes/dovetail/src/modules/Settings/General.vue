<template>
  <admin>
    <page-header>
      <template v-slot:title v-text="trans('General Settings')"></template>
    </page-header>

    <v-row>
      <v-col cols="12" md="8">
        <v-card>
          <v-card-title v-text="trans('Displaying Data')"></v-card-title>
          <v-card-text>
            <p class="muted--text" v-text="trans('Formats')"></p>
            <v-text-field
              :label="trans('Global Date Format')"
              autofocus
              class="mb-3"
              outlined
              v-model="settings['formal:date']['value']"
            ></v-text-field>

            <v-text-field
              :label="trans('Items per Page')"
              class="mb-3"
              outlined
              v-model="settings['display:perpage']['value']"
            ></v-text-field>

            <language-switcher class="mb-6"></language-switcher>

            <div class="d-flex justify-end">
              <v-btn @click="saveSettings" :block="$vuetify.breakpoint.smAndDown" large color="primary" v-text="trans('Save Settings')"></v-btn>
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </admin>
</template>

<script>
export default {
  data: () => ({
    settings: {
      'formal:date': {
        key: 'formal:date',
        value: '',
      },
      'display:perpage': {
        key: 'display:perpage',
        value: 15,
      },
    },
  }),

  methods: {
    loadSettings () {
      // axios.get()
    },

    saveSettings () {
      let data = this.settings
      axios.post(
        `/api/v1/settings`, data
      ).then(response => {
        console.log(response)
      })
    },
  },
}
</script>
