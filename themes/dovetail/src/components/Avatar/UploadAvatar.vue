<template>
  <div class="dt-avatar-preview" :style="`background-image:url(${preview})`">
    <div class="d-flex justify-end ml-5 mt-4">
      <v-btn v-if="hasPreview" small fab @click="clearPreview">
        <v-icon small color="muted">mdi-close-circle-outline</v-icon>
      </v-btn>
      <v-btn small fab @click="openFileBrowser">
        <v-icon small color="muted">mdi-upload-outline</v-icon>
      </v-btn>
    </div>
    <input
      @change="onFileChange"
      accept="image/x-png,image/gif,image/jpeg"
      class="d-none"
      ref="fileupload"
      type="file"
      >
  </div>
</template>

<script>
export default {
  name: 'UploadAvatar',

  props: ['value'],

  computed: {
    hasPreview () {
      return !_.isEmpty(this.preview)
    }
  },

  data: () => ({
    file: null,
    preview: null,
  }),

  methods: {
    openFileBrowser () {
      this.$refs['fileupload'].click()
    },

    clearPreview () {
      this.preview = null
      this.file = null
    },

    onFileChange (e) {
      this.file = e.target.files[0]
      this.preview = URL.createObjectURL(this.file)
    },
  },

  watch: {
    file: function (val) {
      this.$emit('input', val)
      this.$emit('change', val)
    },
  },
}
</script>
