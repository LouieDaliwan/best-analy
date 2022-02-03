<template>
  <v-row>
    <v-col cols="6" v-text="label"> </v-col>
    <v-col cols="6">
      <v-text-field
        :name="name"
        class="text-right"
        dense
        hide-details
        outlined
        step="0.01"
        type="number"
        v-if="edit"
        v-model="dataset"
      ></v-text-field>
      <div v-else v-text="dataset" class="text-right"></div
    ></v-col>
  </v-row>
</template>

<script>
export default {
  props: ["label", "value", "edit", "name"],

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
