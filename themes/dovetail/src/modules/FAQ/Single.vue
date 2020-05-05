<template>
  <admin>
    <page-header :back="{ to: { name: 'faq.index' }, text: trans('Back') }">
      <template v-slot:title>
        <p>{{ title }}</p>
      </template>
    </page-header>

    <v-card>
      <video
        style="display: block;"
        controls
        height="100%"
        width="100%"
        >
        {{ trans('Your browser does not support HTML5 video.') }}
        <source :src="video">
      </video>
    </v-card>
  </admin>
</template>


<script>
import $api from './routes/api'

export default {
  data: (vm) => ({
    videos: [],
    video: vm.$route.query.url,
    title: vm.$route.query.title,
  }),

  mounted () {
    this.displayVideos()
  },

  methods: {
    displayVideos () {
      axios.get(
        $api.url()
      ).then(response => {
        this.videos = response.data.videos
      })
    },
  },
}
</script>
