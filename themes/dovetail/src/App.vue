<template>
  <v-slide-y-transition mode="out-in">
    <router-view></router-view>
  </v-slide-y-transition>
</template>

<script>
import $api from '@/routes/api'

export default {
  created: function () {
    window.axios.get($api.settings.app)
      .then(response => {
        this.$store.dispatch('app/set', response.data)
      })
  }
}
</script>
