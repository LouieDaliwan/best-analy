<template>
  <v-slide-y-transition mode="out-in">
    <router-view></router-view>
  </v-slide-y-transition>
</template>

<script>
import axios from 'axios'

export default {
  created: function () {}
}
</script>
