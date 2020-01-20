<template>
  <v-menu
    :close-on-content-click="false"
    max-width="300px"
    min-width="300px"
    nude-right="100%"
    origin="top right"
    ref="birthday-picker-menu"
    transition="scale-transition"
    v-model="menu"
    >
    <template v-slot:activator="{ on }">
      <validation-provider vid="details[Birthday][value]" :name="trans('Birthday')" v-slot="{ errors }">
        <v-text-field
          :dense="isDense"
          :error-messages="errors"
          :label="trans('Birthday')"
          @blur="date = parseDate(dateFormatted)"
          autocomplete="off"
          class="dt-text-field"
          clear-icon="mdi mdi-close-circle-outline"
          clearable
          name="details[Birthday][value]"
          outlined
          prepend-inner-icon="mdi-cake-variant"
          v-mask="mask"
          v-model="dateFormatted"
        >
          <template v-slot:append>
            <v-icon v-on="on">mdi-calendar</v-icon>
          </template>
        </v-text-field>
        <input type="hidden" name="details[Birthday][key]" value="Birthday">
        <input type="hidden" name="details[Birthday][icon]" value="mdi-cake-variant">
      </validation-provider>
    </template>
    <v-date-picker v-model="date" width="300px" no-title @input="menu = false">
      <v-spacer></v-spacer>
      <v-btn text color="link" @click="menu = false">{{ trans('Cancel') }}</v-btn>
    </v-date-picker>
  </v-menu>
</template>

<script>
import moment from 'moment'
import { mask } from 'vue-the-mask'
import { mapGetters } from 'vuex'

export default {
  directives: {
    mask,
  },

  props: ['value'],

  data: vm => ({
    date: vm.value,
    dateFormatted: '',
    mask: 'Aaa ##, ####',
    menu: false,
  }),

  computed: {
    ...mapGetters({
      isDense: 'settings/fieldIsDense',
    }),
  },

  watch: {
    date (val) {
      this.dateFormatted = this.formatDate(this.date)
    },

    dateFormatted (val) {
      this.$emit('input', this.parseDate(val))
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
