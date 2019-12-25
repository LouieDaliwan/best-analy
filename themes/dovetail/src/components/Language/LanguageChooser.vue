<template>
  <v-select outlined :items="items"></v-select>
</template>

<script>
export default {
  name: 'LanguageChooser',

  data: () => ({
    items: [],
  }),

  beforeCreate: function () {
    axios.get('/api/v1/languages')
      .then(({ data }) => {
        this.items = data
      })
  },
}
</script>
