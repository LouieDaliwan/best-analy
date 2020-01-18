<template>
  <v-slide-y-transition mode="out-in">
    <!-- <v-app-bar v-if="!$store.getters['appbar/show']" app fixed elevate-on-scroll> -->
      <v-container>
        <v-row>
          <v-col class="py-0" cols="12">
            <div class="d-flex justify-end">
              <v-spacer></v-spacer>
              <v-btn class="ml-3 mr-0" large>Discard</v-btn>
              <v-btn class="ml-3 mr-0" large color="primary">
                <v-icon left>mdi-content-save-outline</v-icon>
                Save
              </v-btn>
            </div>
          </v-col>
        </v-row>
      </v-container>
    <!-- </v-app-bar> -->
  </v-slide-y-transition>
</template>

<script>
export default {
  name: 'Actionbar',

  beforeDestroy () {
    // this.$store.dispatch('appbar/toggle', true)
  },

  mounted () {
    // this.$store.dispatch('appbar/toggle', false)
  },
}
</script>
