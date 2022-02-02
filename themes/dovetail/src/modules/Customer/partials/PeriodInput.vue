<template>
  <v-row>
    <v-col cols="6" v-text="label"> </v-col>
    <v-col cols="6">
      <v-text-field
        v-if="edit"
        outlined
        dense
        hide-details
        v-model="dataset"
        class="text-right"
        type="number"
        step="0.01"
      ></v-text-field>
      <div v-else v-text="dataset" class="text-right"></div
    ></v-col>
  </v-row>
</template>

<script>
export default {
  props: ["label", "value", "edit"],

  computed: {
    dataset: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("input", value);
      }
    }
  }
};
</script>
