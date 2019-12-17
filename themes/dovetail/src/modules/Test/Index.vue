<template>
  <div>
    <h3 class="mb-2">Toast/Snackbar</h3>
    <p>Click the button to run a sample toast.</p>
    <v-btn @click="runSnackbar">Run Toast</v-btn>
    <snackbar></snackbar>

    <br><p></p><p></p>

    <h3 class="mb-2 mt-9">Repeater</h3>
    <v-card class="mt-3">
      <v-card-title>Metadata</v-card-title>
      <v-card-text>
        <repeater v-model="repeaters"></repeater>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
export default {
  name: 'TestIndex',

  data () {
    return {
      repeaters: []
      //   {key: 'app:title', value: 'BEST Analytics'},
      //   {key: 'app:year', value: '2020'},
      //   {key: 'app:theme', value: 'dovetail'},
      // ],
    }
  },

  methods: {
    runSnackbar () {
      this.$store.dispatch('snackbar/toggle', {
        show: true,
        text: 'This is a sample toast message'
      })
    }
  },
}
</script>
