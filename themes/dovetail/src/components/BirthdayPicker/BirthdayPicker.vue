<template>
  <v-menu
    :close-on-content-click="false"
    max-width="290px"
    min-width="290px"
    nudge-right="100%"
    offset-y
    origin="top right"
    ref="birthday-picker-menu"
    transition="scale-transition"
    v-model="menu"
    >
    <template v-slot:activator="{ on }">
      <validation-provider vid="details[birthday]" :name="trans('Birthday')" v-slot="{ errors }">
        <v-text-field
          :dense="isDense"
          :error-messages="errors"
          :hint="trans('MM/DD/YYYY format')"
          :label="trans('Birthday')"
          @blur="date = parseDate(dateFormatted)"
          autocomplete="off"
          class="dt-text-field"
          clearable
          name="details[birthday]"
          outlined
          prepend-inner-icon="mdi-cake-variant"
          v-mask="mask"
          v-model="dateFormatted"
        >
          <template v-slot:append>
            <v-icon v-on="on">mdi-calendar</v-icon>
          </template>
        </v-text-field>
      </validation-provider>
    </template>
    <v-date-picker v-model="date" no-title @input="menu = false"></v-date-picker>
  </v-menu>
</template>

<script>
import moment from 'moment'
import { mask } from 'vue-the-mask'

export default {
  directives: {
    mask,
  },

  data: vm => ({
    date: '',
    dateFormatted: '',
    mask: 'Aaa ##, ####',
    menu: false,
  }),

  computed: {
    computedDateFormatted () {
      return this.formatDate(this.date)
    },

    isDense: function () {
      return this.$vuetify.breakpoint.xlAndUp
    },
  },

  watch: {
    date (val) {
      this.dateFormatted = this.formatDate(this.date)
    },
  },

  methods: {
    formatDate (date) {
      return date ? moment(new Date(date)).format('MMM DD, YYYY') : null
    },

    parseDate (date) {
      return date ? moment(new Date(date), 'MMM DD, YYYY').format('YYYY-MM-DD') : null
    },
  },
}
</script>
