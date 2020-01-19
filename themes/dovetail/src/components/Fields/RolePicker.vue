<template>
  <v-card>
    <v-card-title>{{ trans('Roles') }}</v-card-title>
    <slot name="illustration">
      <div class="secondary--text text-center">
        <shield-with-check-mark-icon></shield-with-check-mark-icon>
      </div>
    </slot>
    <v-card-text>
      <validation-provider vid="roles" :name="trans('roles')" rules="required" v-slot="{ errors }">
        <v-select
          :dense="dense"
          :error-messages="errors"
          :hide-details="!errors.length"
          :items="roles"
          :label="$tc('Select role', multiple ? 2 : 1)"
          :multiple="multiple"
          @focus="getRolesData"
          menu-props="offsetY"
          name="roles"
          outlined
          ref="roles"
          v-model="role"
          >
        </v-select>
        <input type="hidden" name="roles" v-model="role">
      </validation-provider>
    </v-card-text>
  </v-card>
</template>

<script>
import $api from '@/modules/User/routes/api'

export default {
  name: 'RolePicker',

  props: {
    value: {
      type: [Array, Object, String, Number],
    },
    dense: {
      type: Boolean,
    },
    multiple: {
      type: [Boolean, Number],
    },
    errors: {
      type: [Array, Object],
    },
    lazyLoad: {
      type: Boolean,
    },
  },

  computed: {
    role: {
      get () {
        return this.value
      },
      set (value) {
        this.$emit('input', value)
      },
    },

    roles () {
      return this.items.map(function (role) {
        return {
          value: role.id,
          text: role.name,
        }
      })
    }
  },

  data: () => ({
    items: [],
  }),

  methods: {
    getRolesData () {
      if (window._.isEmpty(this.items)) {
        axios.get($api.roles.list(), { params: { per_page: '-1' } })
          .then(response => {
            this.items = response.data.data
          })
      }
    },
  },

  mounted () {
    if (!this.lazyLoad) {
      this.getRolesData();
    }
  }
}
</script>
