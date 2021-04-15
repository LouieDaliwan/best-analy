<template>
  <tr>
    <td :colspan="'100%'" class="text-right"><strong v-text="title"></strong></td>
    <td :key="k" v-for="(d, k) in totals">
      <v-text-field
        :disabled="isLoading"
        label="Total"
        class="dt-text-field"
        dense
        hide-details
        :value="d"
        readonly
        >
      </v-text-field>
    </td>
  </tr>
</template>
<script>
export default {
  props: [ 'title', 'totals', 'isLoading' ],
}
</script>
