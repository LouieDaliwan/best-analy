<template>
  <section class="text-center mb-3">
    <v-row align="center" justify="center">
      <v-img
        class="mb-3"
        :src="app.logo"
        :lazy-src="app.logo"
        :max-width="brand"
      ></v-img>
    </v-row>
    <h3 class="mb-3" v-text="app.title"></h3>
    <p class="muted--text" v-text="app.tagline"></p>
  </section>
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

