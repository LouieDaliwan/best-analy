<template>
  <admin>
    <metatag title="asd"></metatag>
    <back-to-top></back-to-top>

    <template v-if="resource.loading">
      <skeleton-show></skeleton-show>
    </template>

    <template v-else>
      <v-card outlined>
        <iframe width="100%" id="iframe-preview" src="/best/test" frameborder="0"></iframe>
      </v-card>
    </template>
  </admin>
</template>

<script>
import SkeletonShow from './cards/SkeletonShow'

export default {
  components: {
    SkeletonShow
  },

  data: () => ({
    resource: {
      loading: false,
    }
  }),

  methods: {
    setIframeHeight () {
      this.resource.loading = true

      document.querySelector('iframe').addEventListener('load', function (e) {
        var iframe = this
        var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow

        if (iframeWin.document.body) {
          iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight
        }
      });

      this.resource.loading = false
    }
  },

  mounted () {
    this.setIframeHeight()
  },
}
</script>
