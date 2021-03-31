<template>
  <!-- <v-slide-y-transition mode="out-in"> -->
    <router-view></router-view>
  <!-- </v-slide-y-transition> -->
</template>

<script>
import app from './config/app'
import multiguard from 'vue-router-multiguard';
import permissions from '@/routes/middleware/permissions'

export default {
  name: 'App',

  // beforeRouteEnter: function () {
  //   alert('asd')
  // },
  mounted () {
    const favicons = document.querySelectorAll('.favicon')
    favicons.forEach( favicon => favicon.href = app.logo )
  }
}
</script>
