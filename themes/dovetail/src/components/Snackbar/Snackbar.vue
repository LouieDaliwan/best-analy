<template>
  <v-slide-y-transition mode="out-in">
    <v-snackbar
      v-model="model"
      :bottom="snackbar.y === 'bottom'"
      :color="snackbar.color"
      :left="snackbar.x === 'left'"
      :multi-line="snackbar.mode === 'multi-line'"
      :right="snackbar.x === 'right'"
      :timeout="snackbar.timeout"
      :top="snackbar.y === 'top'"
      :vertical="snackbar.mode === 'vertical'"
      >

      <v-icon v-if="snackbar.icon" dark small>{{ snackbar.icon }}</v-icon>
      {{ snackbar.text }}

      <v-btn
        v-if="snackbar.button.show"
        @click="snackbarCallback()"
        dark
        small
        text
        >
        <v-icon v-if="snackbar.button.icon" small>{{ snackbar.button.icon }}</v-icon>
        <template v-else>{{ snackbar.button.text }}</template>
      </v-btn>
    </v-snackbar>
  </v-slide-y-transition>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Snackbar',

  computed: {
    ...mapGetters({
      snackbar: 'snackbar/snackbar'
    }),

    model: {
      get () {
        return this.snackbar.show
      },
      set (show) {
        this.$store.dispatch('snackbar/toggle', {show})
        return show
      }
    }
  },

  methods: {
    snackbarCallback: function () {
      this.snackbar.button.callback()
    }
  }
}
</script>
