<template>
  <div class="text-center mb-3">
    <v-row align="center" justify="center">
      <v-img
        class="mb-3"
        :src="app.logo"
        :lazy-src="app.logo"
        :max-width="brand"
      ></v-img>
    </v-row>
    <h3 class="mb-3">{{ app.title }}</h3>
  </div>
</template>

<script>
import app from '@/config/app'

export default {
  data: () => ({
    app,
    brand: 120,
  }),
}
</script>

