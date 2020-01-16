<template>
  <v-card>
    <v-card-title>{{ trans('Roles') }}</v-card-title>
    <slot name="illustration">
      <div class="secondary--text text-center">
        <shield-with-check-mark-icon></shield-with-check-mark-icon>
      </div>
    </slot>
    <v-card-text>
      <validation-provider vid="roles" :name="trans('Role')" rules="required" v-slot="{ errors }">
        <v-select
          :dense="dense"
          :error-messages="errors"
          :hide-details="!errors.length"
          :items="['Superpektus', 'Admininwari', 'Edihardcodedto']"
          :label="trans('Select roles')"
          menu-props="offsetY"
          name="roles"
          outlined
          ref="roles"
          v-model="role"
          >
        </v-select>
      </validation-provider>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: 'RoleCard',

  props: ['value', 'dense'],

  computed: {
    role: {
      get () {
        return this.value
      },
      set (value) {
        this.$emit('input', value)
      },
    },
  },
}
</script>
