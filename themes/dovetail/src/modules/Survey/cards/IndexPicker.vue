<template>
  <v-card class="mb-3">
    <v-card-title>{{ trans('Indexes') }}</v-card-title>
      <div class="primary--text text-center">
        <checklist-icon width="100" height="100"></checklist-icon>
      </div>
    <v-card-text>
      <validation-provider vid="indices" :name="trans('indices')" rules="required" v-slot="{ errors }">
        <v-select
          :dense="dense"
          :error-messages="errors"
          :hide-details="!errors.length"
          :items="indices"
          :label="$tc('Select...')"
          @focus="getIndexsData"
          background-color="selects"
          class="dt-text-field"
          menu-props="offsetY"
          name="indices"
          outlined
          ref="indices"
          v-model="index"
          >
        </v-select>
      </validation-provider>
      <input type="hidden" name="indices[]" v-model="index">
    </v-card-text>
  </v-card>
</template>

<script>
import $api from '@/modules/Index/routes/api'

export default {
  name: 'IndexPicker',

  props: {
    value: {
      type: [Array, Object, String, Number],
    },
    dense: {
      type: Boolean,
    },
    errors: {
      type: [Array, Object],
    },
    lazyLoad: {
      type: Boolean,
    },
  },

  computed: {
    index: {
      get () {
        return this.value[0]
      },
      set (value) {
        this.$emit('input', [value])
      },
    },

    indices () {
      return this.items.map(function (index) {
        return {
          value: index.id,
          text: index.name,
        }
      })
    }
  },

  data: () => ({
    items: [],
  }),

  methods: {
    getIndexsData () {
      if (window._.isEmpty(this.items)) {
        axios.get($api.list(), { params: { per_page: '-1' } })
          .then(response => {
            this.items = response.data.data
          })
      }
    },
  },

  mounted () {
    if (!this.lazyLoad) {
      this.getIndexsData()
    }
  }
}
</script>
