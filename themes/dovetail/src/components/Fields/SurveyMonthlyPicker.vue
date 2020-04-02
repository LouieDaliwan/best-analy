<template>
  <div>
    <div class="body-2 mb-2">{{ __('Generate Month') }}:</div>
    <v-menu
      :close-on-content-click="false"
      ref="survey"
      name="survey"
      v-model="resource.menu"
      transition="scale-transition"
      offset-y
      min-width="290px"
      >
      <template v-slot:activator="{ on }">
        <v-text-field
          background-color="selects"
          class="dt-text-field"
          dense
          hide-details
          outlined
          append-icon="mdi-calendar"
          readonly
          v-model="resource.date"
          v-on="on"
        ></v-text-field>
        <input type="hidden" name="remarks" :value="resource.date">
      </template>
      <v-date-picker
        v-model="resource.date"
        type="month"
        no-title
        scrollable
        @input="resource.menu = false"
        >
      </v-date-picker>
    </v-menu>
  </div>
</template>

<script>
export default {
  data: (vm) => ({
    resource: {
      date: new Date().toISOString().substr(0, 7),
      survey: false,
    },
  }),
}
</script>
