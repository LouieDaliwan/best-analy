<template>
  <admin>
    <page-header>
      <template v-slot:utilities>
        <p>{{ __('Instructional videos of the app.') }}</p>
      </template>
    </page-header>

    <!-- <div v-html="videos"></div> -->
    <template v-for="(contents, header) in videos">
      <h3 class="my-4" v-html="header"></h3>

      <ul>
        <template v-for="video in contents">
          <can :code="video.code">
            <li class="mb-4">
              <router-link class="title font-weight-normal text--decoration-none" tag="a" :to="{ name: 'faq.single', query: { url: video.url } }">{{ video.title }}</router-link>
            </li>
          </can>
        </template>
      </ul>
      <div style="height: 30px;"></div>
    </template>
  </admin>
</template>


<script>
import $api from './routes/api'

export default {
  data: () => ({
    videos: [],
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
